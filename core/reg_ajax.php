<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
defined('ABS_PATH') or exit('No direct script access allowed');
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    // Проверяем, что запрос AJAX
   /* if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        throw new Exception("Invalid request");
    }*/

    // Проверяем отправку формы
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['send_reg'])) {
        throw new Exception("Form not submitted");
    }

    $auth = new Auth();

    // Валидация обязательных полей
    $requiredFields = ['name', 'email', 'password', 'address', 'city', 'state', 'zip', 'mobile_phone'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Поле " . ucfirst(str_replace('_', ' ', $field)) . " обязательно для заполнения");
        }
    }

    // Валидация email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Некорректный email");
    }

    // Валидация пароля
    if (strlen($_POST['password']) < 8) {
        throw new Exception("Пароль должен содержать минимум 8 символов");
    }

    // Подготовка данных
    $userData = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'address' => $_POST['address'],
        'company' => $_POST['company'] ?? null,
        'city' => $_POST['city'],
        'state' => $_POST['state'],
        'zip' => $_POST['zip'],
        'mobile_phone' => $_POST['mobile_phone'],
        'daytime_phone' => $_POST['daytime_phone'] ?? null,
        'card_name' => $_POST['card_name'] ?? null,
        'card_number' => $_POST['card_number'] ?? null,
        'exp_date' => $_POST['exp_date'] ?? null,
        'cvv' => $_POST['cvv'] ?? null
    ];

    // Регистрация
    $auth->register($userData['email'], $userData['password'], $userData['name']);

    // Сохранение дополнительных данных
    $userId = $auth->egetUser_by_email($userData['email']);
    $db = Database::connect();
    $db->query(
        "UPDATE users SET 
            address = ?s,
            company = ?s,
            city = ?s,
            state = ?s,
            zip = ?s,
            mobile_phone = ?s,
            daytime_phone = ?s,
            card_name = ?s,
            card_number = ?s,
            exp_date = ?s,
            cvv = ?s
        WHERE id = ?i",
        [
            $userData['address'],
            $userData['company'],
            $userData['city'],
            $userData['state'],
            $userData['zip'],
            $userData['mobile_phone'],
            $userData['daytime_phone'],
            $userData['card_name'],
            $userData['card_number'],
            $userData['exp_date'],
            $userData['cvv'],
            $userId
        ]
    );

    // Успешный ответ
    $response = [
        'success' => true,
        'redirect' => 'registration_success.php',
        'message' => 'Регистрация успешно завершена!'
    ];

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);