<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
defined('ABS_PATH') or exit('No direct script access allowed');

session_start();
header('Content-Type: application/json');

// Проверка AJAX-запроса
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Forbidden']);
    exit;
}

// Проверка CSRF-токена (если используете)
/*if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Invalid CSRF token']);
    exit;
}*/

// Подключение к БД и загрузка необходимых классов

$response = ['success' => false, 'message' => ''];

try {
    $auth = new Auth();
    $db = Database::connect();

    // Проверка аутентификации пользователя
    if (!$auth->isLoggedIn()) {
        throw new Exception("User not authenticated");
    }

    $userId = $_SESSION['user']['id'];
    $email = $_SESSION['user']['email'];

    // Валидация данных
    $requiredFields = ['name', 'address', 'city', 'state', 'zip', 'mobile_phone'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Field " . ucfirst(str_replace('_', ' ', $field)) . " is required");
        }
    }

    // Подготовка данных для обновления
    $updateData = [
        'name' => $_POST['name'],
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

    // Если указан пароль - обновляем его
    if (!empty($_POST['password'])) {
        if (strlen($_POST['password']) < 8) {
            throw new Exception("Password must be at least 8 characters");
        }
        $updateData['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    // Формируем SQL-запрос
    $setParts = [];
    $params = [];
    foreach ($updateData as $field => $value) {
        if ($value !== null) {
            $setParts[] = "{$field} = ?";
            $params[] = $value;
        }
    }
    $params[] = $userId;

    $sql = "UPDATE users SET " . implode(', ', $setParts) . " WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);

    // Обновляем данные в сессии
    $_SESSION['user']['name'] = $updateData['name'];

    // Формируем ответ
    $response = [
        'success' => true,
        'message' => 'Profile updated successfully',
        'user' => array_merge(['email' => $email], $updateData)
    ];

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
