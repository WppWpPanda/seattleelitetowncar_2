<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
defined('ABS_PATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

// Проверка AJAX
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Forbidden']);
    exit;
}

// Подключаем классы
$auth = new Auth();
$db = Database::connect();

// Валидация данных
$requiredFields = [
    'name', 'address', 'email', 'mobile_phone',
    'vehicle', 'service', 'date', 'time',
    'passengers', 'bags'
];

// Проверка обязательных полей
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['success' => false, 'message' => "Please fill in all required fields"]);
        exit;
    }
}

// Обработка пользователя
try {
    $userId = null;
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Если пользователь не аутентифицирован
    if (!$auth->isLoggedIn()) {
        // Регистрируем нового пользователя
        $password = bin2hex(random_bytes(8)); // Генерируем случайный пароль
        $auth->register($email, $password, $_POST['name']);

        // Авторизуем пользователя
        $auth->login($email, $password);
        $userId = $_SESSION['user']['id'];

        // Отправляем письмо с паролем (опционально)
        sendWelcomeEmail($email, $password);
    } else {
        $userId = $_SESSION['user']['id'];
        $email = $_SESSION['user']['email'];
    }

    // Обновляем профиль пользователя
    $updateData = [
        'name' => htmlspecialchars($_POST['name']),
        'address' => htmlspecialchars($_POST['address']),
        'company' => htmlspecialchars($_POST['company'] ?? ''),
        'city' => htmlspecialchars($_POST['city'] ?? ''),
        'state' => htmlspecialchars($_POST['state'] ?? ''),
        'zip' => htmlspecialchars($_POST['zip'] ?? ''),
        'mobile_phone' => htmlspecialchars($_POST['mobile_phone']),
        'daytime_phone' => htmlspecialchars($_POST['daytime_phone'] ?? ''),
        'card_name' => htmlspecialchars($_POST['card_name'] ?? ''),
        'card_number' => htmlspecialchars($_POST['card_number'] ?? ''),
        'exp_date' => htmlspecialchars($_POST['exp_date'] ?? ''),
        'cvv' => htmlspecialchars($_POST['cvv'] ?? '')
    ];

    $setParts = [];
    $params = [];
    foreach ($updateData as $field => $value) {
        $setParts[] = "{$field} = ?";
        $params[] = $value;
    }
    $params[] = $userId;

    $sql = "UPDATE users SET " . implode(', ', $setParts) . " WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);

    // Обновляем данные в сессии
    $_SESSION['user']['name'] = $updateData['name'];

    $updateData['passenger']['email'] = $_POST['email'];

    // Подготовка данных заказа
    $orderData = [
        'passenger' => $updateData,
        'ride' => [
            'vehicle' => htmlspecialchars($_POST['vehicle']),
            'service' => htmlspecialchars($_POST['service']),
            'date' => htmlspecialchars($_POST['date']),
            'time' => htmlspecialchars($_POST['time']),
            'passengers' => htmlspecialchars($_POST['passengers']),
            'bags' => htmlspecialchars($_POST['bags']),
            'pickup_type' => htmlspecialchars($_POST['pickup']),
            'pickup_details' => $_POST['pickup'] === 'street' ? [
                'address' => htmlspecialchars($_POST['pickup_address']),
                'phone' => htmlspecialchars($_POST['pickup_phone'] ?? '')
            ] : [
                'airport' => htmlspecialchars($_POST['pickup_airport']),
                'airline' => htmlspecialchars($_POST['pickup_airline']),
                'flight_number' => htmlspecialchars($_POST['pickup_flight_number']),
                'greeting' => htmlspecialchars($_POST['pickup_greeting'] ?? '')
            ],
            'destination_type' => htmlspecialchars($_POST['destination']),
            'destination_details' => $_POST['destination'] === 'street' ? [
                'address' => htmlspecialchars($_POST['destination_address']),
                'phone' => htmlspecialchars($_POST['destination_phone'] ?? '')
            ] : [
                'airport' => htmlspecialchars($_POST['destination_airport']),
                'airline' => htmlspecialchars($_POST['destination_airline']),
                'flight_number' => htmlspecialchars($_POST['destination_flight_number'])
            ]
        ],
        'payment' => [
            'method' => htmlspecialchars($_POST['payment']),
            'details' => $_POST['payment'] === 'credit_card' ? [
                'card_name' => htmlspecialchars($_POST['card_name']),
                'card_number' => htmlspecialchars($_POST['card_number']),
                'exp_date' => htmlspecialchars($_POST['exp_date']),
                'cvv' => htmlspecialchars($_POST['cvv']),
                'billing_address' => htmlspecialchars($_POST['billing_address'] ?? ''),
                'billing_city' => htmlspecialchars($_POST['billing_city'] ?? ''),
                'billing_state' => htmlspecialchars($_POST['billing_state'] ?? ''),
                'billing_zip' => htmlspecialchars($_POST['billing_zip'] ?? '')
            ] : []
        ],
        'additional_info' => nl2br(htmlspecialchars($_POST['additional_info'] ?? '')),
        'ip' => $_SERVER['REMOTE_ADDR'],
        'timestamp' => date('Y-m-d H:i:s')
    ];

    // Сохраняем заказ в таблицу new_orders
    $serializedOrder = serialize($orderData);
    $insertOrderQuery = "INSERT INTO new_orders (user_ID, order_data) VALUES (?, ?)";
    $stmt = $db->prepare($insertOrderQuery);
    $stmt->execute([$userId, $serializedOrder]);

    // Отправка email и логирование

    $htmlTemplate = '';

   // try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;
        $mail->SMTPSecure = MAIL_ENCRYPTION;
        $mail->Port = MAIL_PORT;

        $mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
        //$mail->addAddress($orderData['passenger']['email']);
        $mail->addAddress(MAIL_RECIPIENT_ADDRESS, 'Admin');
        $mail->addReplyTo($_POST['email'], $_POST['name']);
        $mail->Subject = 'Order Confirmation: ' . $orderData['ride']['service'];

        $htmlTemplate = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        .section-title { font-size: 18px; margin: 20px 0 10px; color: #333; }
    </style>
</head>
<body>
<h1>New Reservation Request</h1>
<p>Submitted on: {$orderData['timestamp']}</p>

<div class="section-title">Passenger Information</div>
<table>
    <tr><th>Name</th><td>{$orderData['passenger']['name']}</td></tr>
    <tr><th>Company</th><td>{$orderData['passenger']['company']}</td></tr>
    <tr><th>Address</th><td>{$orderData['passenger']['address']}</td></tr>
    <tr><th>Email</th><td>{$orderData['passenger']['email']}</td></tr>
    <tr><th>Mobile Phone</th><td>{$orderData['passenger']['mobile_phone']}</td></tr>
    <tr><th>Daytime Phone</th><td>{$orderData['passenger']['daytime_phone']}</td></tr>
</table>

<div class="section-title">Ride Details</div>
<table>
    <tr><th>Vehicle Type</th><td>{$orderData['ride']['vehicle']}</td></tr>
    <tr><th>Service Type</th><td>{$orderData['ride']['service']}</td></tr>
    <tr><th>Date/Time</th><td>{$orderData['ride']['date']} at {$orderData['ride']['time']}</td></tr>
    <tr><th>Passengers</th><td>{$orderData['ride']['passengers']}</td></tr>
    <tr><th>Bags</th><td>{$orderData['ride']['bags']}</td></tr>
</table>

<div class="section-title">Pickup Information</div>
<table>
    <tr><th>Type</th><td>{$orderData['ride']['pickup_type']}</td></tr>
HTML;

// Динамические строки для pickup_details
        foreach ($orderData['ride']['pickup_details'] as $key => $value) {
            $htmlTemplate .= <<<HTML
    <tr><th>{$key}</th><td>{$value}</td></tr>
HTML;
        }

        $htmlTemplate .= <<<HTML
</table>

<div class="section-title">Destination Information</div>
<table>
    <tr><th>Type</th><td>{$orderData['ride']['destination_type']}</td></tr>
HTML;

// Динамические строки для destination_details
        foreach ($orderData['ride']['destination_details'] as $key => $value) {
            $htmlTemplate .= <<<HTML
    <tr><th>{$key}</th><td>{$value}</td></tr>
HTML;
        }

        $htmlTemplate .= <<<HTML
</table>

<div class="section-title">Payment Information</div>
<table>
    <tr><th>Method</th><td>{$orderData['payment']['method']}</td></tr>
HTML;

// Условный блок для кредитной карты
        if ($orderData['payment']['method'] === 'credit_card') {
            foreach ($orderData['payment']['details'] as $key => $value) {
                if (!empty($value)) {
                    $htmlTemplate .= <<<HTML
            <tr><th>{$key}</th><td>{$value}</td></tr>
HTML;
                }
            }
        }

        $htmlTemplate .= <<<HTML
</table>
HTML;

// Дополнительная информация (условно)
        if (!empty($orderData['additional_info'])) {
            $htmlTemplate .= <<<HTML
    <div class="section-title">Additional Information</div>
    <p>{$orderData['additional_info']}</p>
HTML;
        }

        $htmlTemplate .= <<<HTML
<p><small>IP Address: {$orderData['ip']}</small></p>
</body>
</html>
HTML;


        $mail->Body = $htmlTemplate;
        $mail->isHTML(true);

        $v = $mail->send();

        // Логирование заказа
        $logDir = 'submits/reserv/' . date('Y/m/d');
        if (!file_exists($logDir)) {
            mkdir($logDir, 0777, true);
        }
        file_put_contents($logDir . '/' . date('H-i-s') . '.txt', json_encode($orderData, JSON_PRETTY_PRINT));

  //  } catch (Exception $e) {
        //error_log("Order confirmation email error: " . $e->getMessage());
   // }

    echo json_encode([
        'success' => true,
        'message' => 'Order submitted successfully',
        'user' => array_merge(['email' => $email], $updateData),
        'email' => $email,
        'bb' => $htmlTemplate
    ]);

} catch (Exception $e) {
    error_log("Order submission error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}