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

// Валидация данных
$requiredFields = [
    'name', 'address', 'email', 'mobile_phone',
    'vehicle', 'service', 'date', 'time',
    'passengers', 'bags'
];

// Добавляем поля в зависимости от выбранного типа pickup
if ($_POST['pickup'] === 'street') {
    $requiredFields[] = 'pickup_address';
} elseif ($_POST['pickup'] === 'airport') {
    array_push($requiredFields, 'pickup_airport', 'pickup_airline', 'pickup_flight_number');
}

// Добавляем поля в зависимости от выбранного типа destination
if ($_POST['destination'] === 'street') {
    $requiredFields[] = 'destination_address';
} elseif ($_POST['destination'] === 'airport') {
    array_push($requiredFields, 'destination_airport', 'destination_airline', 'destination_flight_number');
}

// Добавляем поля для кредитной карты если выбран этот способ оплаты
if ($_POST['payment'] === 'credit_card') {
    array_push($requiredFields, 'card_name', 'card_number', 'exp_date', 'cvv');
}

foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['success' => false, 'message' => "Please fill in all required fields"]);
        exit;
    }
}

// Подготовка данных
$data = [
    'passenger' => [
        'name' => htmlspecialchars($_POST['name']),
        'company' => htmlspecialchars($_POST['company'] ?? ''),
        'address' => htmlspecialchars($_POST['address']),
        'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
        'mobile_phone' => htmlspecialchars($_POST['mobile_phone']),
        'daytime_phone' => htmlspecialchars($_POST['daytime_phone'] ?? '')
    ],
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

try {
    // Создаем директорию для логов
    $logDir = 'submits/reserv/' . date('Y/m/d');
    if (!file_exists($logDir)) {
        mkdir($logDir, 0777, true);
    }

    // Имя файла лога
    $logFile = $logDir . '/' . date('H-i-s') . '.txt';

    // Создаем PHPMailer
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = MAIL_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = MAIL_USERNAME;
    $mail->Password = MAIL_PASSWORD;
    $mail->SMTPSecure = MAIL_ENCRYPTION;
    $mail->Port = MAIL_PORT;

    // Настройки письма
    $mail->setFrom(
        MAIL_FROM_ADDRESS,
        MAIL_FROM_NAME
    );
    $mail->addAddress(MAIL_RECIPIENT_ADDRESS, 'Admin');

    $mail->addReplyTo($data['passenger']['email'], $data['passenger']['name']);

    // HTML письмо
    $mail->isHTML(true);
    $mail->Subject = 'New Reservation: ' . $data['ride']['service'] . ' - ' . $data['ride']['vehicle'];

    // Генерация HTML письма
    ob_start();
    ?>
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
    <p>Submitted on: <?= $data['timestamp'] ?></p>

    <div class="section-title">Passenger Information</div>
    <table>
        <tr><th>Name</th><td><?= $data['passenger']['name'] ?></td></tr>
        <tr><th>Company</th><td><?= $data['passenger']['company'] ?: 'N/A' ?></td></tr>
        <tr><th>Address</th><td><?= $data['passenger']['address'] ?></td></tr>
        <tr><th>Email</th><td><?= $data['passenger']['email'] ?></td></tr>
        <tr><th>Mobile Phone</th><td><?= $data['passenger']['mobile_phone'] ?></td></tr>
        <tr><th>Daytime Phone</th><td><?= $data['passenger']['daytime_phone'] ?: 'N/A' ?></td></tr>
    </table>

    <div class="section-title">Ride Details</div>
    <table>
        <tr><th>Vehicle Type</th><td><?= $data['ride']['vehicle'] ?></td></tr>
        <tr><th>Service Type</th><td><?= $data['ride']['service'] ?></td></tr>
        <tr><th>Date/Time</th><td><?= $data['ride']['date'] ?> at <?= $data['ride']['time'] ?></td></tr>
        <tr><th>Passengers</th><td><?= $data['ride']['passengers'] ?></td></tr>
        <tr><th>Bags</th><td><?= $data['ride']['bags'] ?></td></tr>
    </table>

    <div class="section-title">Pickup Information</div>
    <table>
        <tr><th>Type</th><td><?= ucfirst($data['ride']['pickup_type']) ?></td></tr>
        <?php foreach ($data['ride']['pickup_details'] as $key => $value): ?>
            <tr><th><?= ucfirst(str_replace('_', ' ', $key)) ?></th><td><?= $value ?></td></tr>
        <?php endforeach; ?>
    </table>

    <div class="section-title">Destination Information</div>
    <table>
        <tr><th>Type</th><td><?= ucfirst($data['ride']['destination_type']) ?></td></tr>
        <?php foreach ($data['ride']['destination_details'] as $key => $value): ?>
            <tr><th><?= ucfirst(str_replace('_', ' ', $key)) ?></th><td><?= $value ?></td></tr>
        <?php endforeach; ?>
    </table>

    <div class="section-title">Payment Information</div>
    <table>
        <tr><th>Method</th><td><?= ucfirst(str_replace('_', ' ', $data['payment']['method'])) ?></td></tr>
        <?php if ($data['payment']['method'] === 'credit_card'): ?>
            <?php foreach ($data['payment']['details'] as $key => $value): ?>
                <?php if (!empty($value)): ?>
                    <tr><th><?= ucfirst(str_replace('_', ' ', $key)) ?></th><td><?= $key === 'card_number' ? '•••• •••• •••• ' . substr($value, -4) : $value ?></td></tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

    <?php if (!empty($data['additional_info'])): ?>
        <div class="section-title">Additional Information</div>
        <p><?= $data['additional_info'] ?></p>
    <?php endif; ?>

    <p><small>IP Address: <?= $data['ip'] ?></small></p>
    </body>
    </html>
<?php
    $mail->Body = ob_get_clean();

    // Альтернативное текстовое содержимое
    $mail->AltBody = print_r($data, true);

    // Отправка письма
    $mail->send();

    // Логирование в файл
    file_put_contents($logFile, json_encode($data, JSON_PRETTY_PRINT));

    echo json_encode(['success' => true, 'message' => 'Your reservation has been submitted successfully!']);

} catch (Exception $e) {
    // Логирование ошибки
    $errorLog = $logDir . '/error_' . date('H-i-s') . '.txt';
    file_put_contents($errorLog, "Error: " . $e->getMessage() . "\nData: " . print_r($data, true));

    echo json_encode(['success' => false, 'message' => 'Failed to submit reservation. Please try again later.']);
}