<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
defined('ABS_PATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

// Проверка AJAX запроса
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Forbidden']);
    exit;
}

// Валидация данных
$requiredFields = ['name', 'phone', 'email', 'vehicle', 'service', 'date', 'time'];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['success' => false, 'message' => "Please fill in all required fields"]);
        exit;
    }
}

// Подготовка данных
$data = [
    'name' => htmlspecialchars($_POST['name']),
    'company' => !empty($_POST['company']) ? htmlspecialchars($_POST['company']) : 'Not specified',
    'phone' => htmlspecialchars($_POST['phone']),
    'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
    'brief' => nl2br(htmlspecialchars($_POST['brief'] ?? '')),
    'vehicle' => htmlspecialchars($_POST['vehicle']),
    'service' => htmlspecialchars($_POST['service']),
    'date' => htmlspecialchars($_POST['date']),
    'time' => htmlspecialchars($_POST['time']),
    'ip' => $_SERVER['REMOTE_ADDR'],
    'timestamp' => date('Y-m-d H:i:s')
];

try {
    // Создаем директорию для логов
    $logDir = 'submits/quotes/' . date('Y/m/d');
    if (!file_exists($logDir)) {
        mkdir($logDir, 0777, true);
    }

    $logFile = $logDir . '/' . date('H-i-s') . '.txt';

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = MAIL_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = MAIL_USERNAME;
    $mail->Password = MAIL_PASSWORD;
    $mail->SMTPSecure = MAIL_ENCRYPTION;
    $mail->Port = MAIL_PORT;

    $mail->setFrom(
        MAIL_FROM_ADDRESS,
        MAIL_FROM_NAME
    );
    $mail->addAddress(MAIL_RECIPIENT_ADDRESS, 'Admin');
    $mail->addReplyTo($data['email'], $data['name']);

    // HTML письмо
    $mail->isHTML(true);
    $mail->Subject = 'New Quote Request: ' . $data['service'] . ' - ' . $data['vehicle'];

    $mail->Body = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; }
                table { width: 100%; border-collapse: collapse; }
                th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
                th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <h2>New Quote Request</h2>
            <table>
                <tr><th>Field</th><th>Details</th></tr>
                <tr><td>Name</td><td>{$data['name']}</td></tr>
                <tr><td>Company</td><td>{$data['company']}</td></tr>
                <tr><td>Phone</td><td>{$data['phone']}</td></tr>
                <tr><td>Email</td><td>{$data['email']}</td></tr>
                <tr><td>Vehicle Type</td><td>{$data['vehicle']}</td></tr>
                <tr><td>Service Type</td><td>{$data['service']}</td></tr>
                <tr><td>Date/Time</td><td>{$data['date']} at {$data['time']}</td></tr>
                <tr><td>IP Address</td><td>{$data['ip']}</td></tr>
                <tr><td>Request Date</td><td>{$data['timestamp']}</td></tr>
            </table>
            <h3>Request Details:</h3>
            <p>{$data['brief']}</p>
        </body>
        </html>
    ";

    // Альтернативное текстовое содержимое
    $mail->AltBody = "New Quote Request\n\n" . print_r($data, true);

    // Отправка письма
    $mail->send();

    // Логирование в файл
    $logContent = "[" . $data['timestamp'] . "]\n";
    foreach ($data as $key => $value) {
        $logContent .= ucfirst($key) . ": " . str_replace("\n", "\\n", $value) . "\n";
    }
    $logContent .= "Status: Sent successfully\n\n";

    file_put_contents($logFile, $logContent);

    echo json_encode(['success' => true, 'message' => 'Thank you! Your quote request has been submitted.']);

} catch (Exception $e) {
    // Логирование ошибки
    $errorLog = $logDir . '/error_' . date('H-i-s') . '.txt';
    file_put_contents($errorLog, "Error: " . $e->getMessage() . "\nData: " . print_r($data, true));

    echo json_encode(['success' => false, 'message' => 'Failed to send request. Please try again later.']);
}

