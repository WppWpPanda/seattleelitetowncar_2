<?php
defined('ABS_PATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function is_home_page() {
    // Проверяем несколько возможных вариантов главной страницы
    $script_name = basename($_SERVER['SCRIPT_FILENAME']);
    $request_uri = trim($_SERVER['REQUEST_URI'], '/');

    return ($request_uri === '' ||
        $request_uri === 'index.php' ||
        $script_name === 'index.php' && empty($request_uri));
}
function is_ratese_page()
{
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $parts = explode('/', trim($path, '/'));

    return ( in_array('rates', $parts) || in_array('rates.php', $parts));
}

function is_quote_page()
{
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $parts = explode('/', trim($path, '/'));

    return ( in_array('quote', $parts) || in_array('quote.php', $parts));
}

function is_reserv_page()
{
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $parts = explode('/', trim($path, '/'));

    return ( in_array('reservation', $parts) || in_array('reservation.php', $parts));
}

function is_mobile_device() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

// Добавляем класс wpp-mobile, если устройство мобильное
$mobile_class = is_mobile_device() ? 'wpp-mobile' : '';


// Функция отправки приветственного письма
function sendWelcomeEmail($email, $password) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;
        $mail->SMTPSecure = MAIL_ENCRYPTION;
        $mail->Port = MAIL_PORT;

        $mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
        $mail->addAddress($email);
        $mail->Subject = 'Welcome to Our Service';

        $mail->isHTML(true);
        $mail->Body = "
            <h1>Welcome!</h1>
            <p>Your account has been created successfully.</p>
            <p>Email: {$email}</p>
            <p>Password: {$password}</p>
            <p>Please change your password after first login.</p>
        ";

        $mail->send();
    } catch (Exception $e) {
        error_log("Welcome email error: " . $e->getMessage());
    }
}

// Функция отправки подтверждения заказа
function sendOrderConfirmation($orderData) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;
        $mail->SMTPSecure = MAIL_ENCRYPTION;
        $mail->Port = MAIL_PORT;

        $mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
        $mail->addAddress($orderData['passenger']['email']);
        $mail->addAddress(MAIL_RECIPIENT_ADDRESS);
        $mail->Subject = 'Order Confirmation: ' . $orderData['ride']['service'];

        ob_start();
        include $_SERVER['DOCUMENT_ROOT'] . '/templates/reservation_email_template.php';
        $mail->Body = ob_get_clean();
        $mail->isHTML(true);

        $mail->send();

        // Логирование заказа
        $logDir = 'submits/reserv/' . date('Y/m/d');
        if (!file_exists($logDir)) {
            mkdir($logDir, 0777, true);
        }
        file_put_contents($logDir . '/' . date('H-i-s') . '.txt', json_encode($orderData, JSON_PRETTY_PRINT));

    } catch (Exception $e) {
        error_log("Order confirmation email error: " . $e->getMessage());
    }
}

function formatOrderDetails(array $order): string {
    // Extract data from the array
    $passenger = $order['passenger'] ?? [];
    $ride = $order['ride'] ?? [];
    $payment = $order['payment'] ?? [];
    $additionalInfo = $order['additional_info'] ?? '';

    // Start building the HTML
    $html = '<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">';
    $html .= '<h2 style="color: #2c3e50; border-bottom: 1px solid #eee; padding-bottom: 10px;">Order Details</h2>';

    // Passenger Information
    $html .= '<h3 style="color: #3498db;">Passenger Information</h3>';
    $html .= '<p><strong>Full Name:</strong> ' . htmlspecialchars($passenger['name'] ?? '') . '</p>';
    $html .= '<p><strong>Address:</strong> ' . htmlspecialchars($passenger['address'] ?? '') . '</p>';
    if (!empty($passenger['company'])) {
        $html .= '<p><strong>Company:</strong> ' . htmlspecialchars($passenger['company']) . '</p>';
    }
    $html .= '<p><strong>Phone:</strong> ' . htmlspecialchars($passenger['mobile_phone'] ?? '') .
        (!empty($passenger['daytime_phone']) ? ' (mobile), ' . htmlspecialchars($passenger['daytime_phone']) . ' (daytime)' : '') . '</p>';

    // Payment Information
    $html .= '<h3 style="color: #3498db; margin-top: 20px;">Payment Information</h3>';
    $html .= '<p><strong>Payment Method:</strong> ' . ucfirst(str_replace('_', ' ', $payment['method'] ?? '')) . '</p>';
    if (!empty($payment['details'])) {
        $details = $payment['details'];
        $html .= '<p><strong>Cardholder Name:</strong> ' . htmlspecialchars($details['card_name'] ?? '') . '</p>';
        $html .= '<p><strong>Card Number:</strong> ' . chunk_split(htmlspecialchars($details['card_number'] ?? ''), 4, ' ') . '</p>';
        $html .= '<p><strong>Expiration Date:</strong> ' . htmlspecialchars($details['exp_date'] ?? '') . '</p>';
        $html .= '<p><strong>CVV:</strong> ' . htmlspecialchars($details['cvv'] ?? '') . '</p>';
        if (!empty($details['billing_state'])) {
            $html .= '<p><strong>Billing State:</strong> ' . htmlspecialchars($details['billing_state']) . '</p>';
        }
    }

    // Ride Details
    $html .= '<h3 style="color: #3498db; margin-top: 20px;">Ride Details</h3>';
    $html .= '<p><strong>Vehicle Type:</strong> ' . htmlspecialchars($ride['vehicle'] ?? '') . '</p>';
    $html .= '<p><strong>Service Type:</strong> ' . htmlspecialchars($ride['service'] ?? '') . '</p>';
    $html .= '<p><strong>Date:</strong> ' . htmlspecialchars($ride['date'] ?? '') . '</p>';
    $html .= '<p><strong>Time:</strong> ' . htmlspecialchars($ride['time'] ?? '') . '</p>';
    $html .= '<p><strong>Passengers:</strong> ' . htmlspecialchars($ride['passengers'] ?? '') . '</p>';
    $html .= '<p><strong>Bags:</strong> ' . htmlspecialchars($ride['bags'] ?? '') . '</p>';

    // Pickup Location
    $html .= '<h3 style="color: #3498db; margin-top: 20px;">Pickup Location</h3>';
    $html .= '<p><strong>Type:</strong> ' . ucfirst(htmlspecialchars($ride['pickup_type'] ?? '')) . '</p>';
    if (!empty($ride['pickup_details'])) {
        $html .= '<p><strong>Address:</strong> ' . htmlspecialchars($ride['pickup_details']['address'] ?? '') . '</p>';
        $html .= '<p><strong>Phone:</strong> ' . htmlspecialchars($ride['pickup_details']['phone'] ?? '') . '</p>';
    }

    // Destination
    $html .= '<h3 style="color: #3498db; margin-top: 20px;">Destination</h3>';
    $html .= '<p><strong>Type:</strong> ' . ucfirst(htmlspecialchars($ride['destination_type'] ?? '')) . '</p>';
    if (!empty($ride['destination_details'])) {
        $html .= '<p><strong>Address:</strong> ' . htmlspecialchars($ride['destination_details']['address'] ?? '') . '</p>';
        $html .= '<p><strong>Phone:</strong> ' . htmlspecialchars($ride['destination_details']['phone'] ?? '') . '</p>';
    }

    // Additional Notes
    if (!empty($additionalInfo)) {
        $html .= '<h3 style="color: #3498db; margin-top: 20px;">Additional Notes</h3>';
        $html .= '<p>' . nl2br(htmlspecialchars($additionalInfo)) . '</p>';
    }

    $html .= '</div>';

    return $html;
}

// Usage example:
// $order = [...]; // Your order array
// echo formatOrderDetails($order);

function formatDateTime($inputDateTime) {
    // Создаем объект DateTime из входной строки
    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $inputDateTime);

    // Проверяем, что дата корректна
    if (!$dateTime) {
        return 'Invalid date format';
    }

    // Форматируем дату в нужный формат
    return $dateTime->format('d.m.Y H:i A');
}
