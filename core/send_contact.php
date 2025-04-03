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
$requiredFields = ['name', 'phone', 'email', 'brief'];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['success' => false, 'message' => "Field $field is required"]);
        exit;
    }
}

// Подготовка данных
$data = [
    'name' => htmlspecialchars($_POST['name']),
    'company' => !empty($_POST['company']) ? htmlspecialchars($_POST['company']) : 'Not specified',
    'phone' => htmlspecialchars($_POST['phone']),
    'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
    'brief' => nl2br(htmlspecialchars($_POST['brief'])),
    'date' => date('Y-m-d H:i:s'),
    'ip' => $_SERVER['REMOTE_ADDR']
];

try {
    // Создаем директорию для логов
    $logDir = 'submits/' . date('Y/m/d');
    if (!file_exists($logDir)) {
        mkdir($logDir, 0777, true);
    }

    // Генерируем имя файла для лога
    $logFile = $logDir . '/' . date('H-i-s') . '.txt';

    // Создаем PHPMailer
    $mail = new PHPMailer(true);

    // Настройки сервера (замените на свои)
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
    $mail->addReplyTo($data['email'], $data['name']);

    $mail->isHTML(true);
    $mail->Subject = 'New Contact Request from ' . $data['name'];

    // HTML шаблон письма
    $mail->Body = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #f8f9fa; padding: 10px; text-align: center; }
                .content { padding: 20px; }
                .footer { margin-top: 20px; font-size: 0.9em; color: #666; }
                table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                th { background-color: #f2f2f2; text-align: left; padding: 8px; }
                td { padding: 8px; border-bottom: 1px solid #ddd; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>New Contact Request</h2>
                </div>
                <div class='content'>
                    <table>
                        <tr><th>Field</th><th>Details</th></tr>
                        <tr><td>Name</td><td>{$data['name']}</td></tr>
                        <tr><td>Company</td><td>{$data['company']}</td></tr>
                        <tr><td>Phone</td><td>{$data['phone']}</td></tr>
                        <tr><td>Email</td><td>{$data['email']}</td></tr>
                        <tr><td>Request Date</td><td>{$data['date']}</td></tr>
                        <tr><td>IP Address</td><td>{$data['ip']}</td></tr>
                    </table>
                    <h3>Brief Description:</h3>
                    <p>{$data['brief']}</p>
                </div>
                <div class='footer'>
                    <p>This request was submitted through the contact form on your website.</p>
                </div>
            </div>
        </body>
        </html>
    ";

    // Альтернативное текстовое содержимое
    $mail->AltBody = "Contact Request\n\n" .
        "Name: {$data['name']}\n" .
        "Company: {$data['company']}\n" .
        "Phone: {$data['phone']}\n" .
        "Email: {$data['email']}\n\n" .
        "Brief Description:\n{$data['brief']}\n\n" .
        "Submitted on: {$data['date']}\n" .
        "IP Address: {$data['ip']}";

    // Отправка письма
    $mail->send();

    // Логирование отправки
    $logContent = "[" . $data['date'] . "]\n" .
        "Name: {$data['name']}\n" .
        "Company: {$data['company']}\n" .
        "Phone: {$data['phone']}\n" .
        "Email: {$data['email']}\n" .
        "IP: {$data['ip']}\n" .
        "Brief:\n{$data['brief']}\n" .
        "Status: Sent successfully\n\n";

    file_put_contents($logFile, $logContent);

    echo json_encode(['success' => true, 'message' => 'Your message has been sent successfully!']);

} catch (Exception $e) {
    // Логирование ошибки
    $errorLogContent = "[" . date('Y-m-d H:i:s') . "]\n" .
        "Error: " . $e->getMessage() . "\n" .
        "Data: " . print_r($data, true) . "\n\n";

    file_put_contents($logDir . '/error_' . date('H-i-s') . '.txt', $errorLogContent);

    echo json_encode(['success' => false, 'message' => 'Message could not be sent. Please try again later.']);
}