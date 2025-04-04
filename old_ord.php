<?php
/**
 * Скрипт для сохранения старых заказов в таблицу Old_Orders
 * с проверкой на пустые заказы и сериализацией данных
 */

// Подключение к базе данных
$db_host = '127.0.0.1';
$db_user = 'wp_panda';
$db_pass = '12345';
$db_name = 'wp_panda_seatle';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Путь к экспортированному файлу
$export_file = $_SERVER['DOCUMENT_ROOT'] . '/user_export_20250403_204728.php';

// Подключаем файл с данными
if (!file_exists($export_file)) {
    die("Exported file not found: $export_file");
}

require_once $export_file;

// Проверяем данные
if (!isset($user_data) || !is_array($user_data)) {
    die("Invalid data format: \$user_data array not found");
}

// Подготовка запроса для вставки в Old_Orders
$insert_order_query = "INSERT INTO old_orders (user_ID, orders) VALUES (?, ?)";
$stmt_insert = $mysqli->prepare($insert_order_query);
if (!$stmt_insert) {
    die("Prepare failed for orders insert: " . $mysqli->error);
}

// Подготовка запроса для получения ID пользователя по email
$get_user_id_query = "SELECT ID FROM users WHERE email = ?";
$stmt_get_id = $mysqli->prepare($get_user_id_query);
if (!$stmt_get_id) {
    die("Prepare failed for user ID query: " . $mysqli->error);
}

$saved_count = 0;
foreach ($user_data as $user) {
    if (!isset($user['basic_info']['email']) || !isset($user['orders'])) {
        error_log("Skipping user - missing required fields");
        continue;
    }

    $email = $user['basic_info']['email'];
    $orders_data = $user['orders'];

    // Пропускаем пустые заказы
    if (empty($orders_data) || (is_array($orders_data) && empty($orders_data[0]))) {
        error_log("Skipping empty orders for user: $email");
        continue;
    }

    // Получаем ID пользователя
    $stmt_get_id->bind_param("s", $email);
    $stmt_get_id->execute();
    $result = $stmt_get_id->get_result();

    if ($result->num_rows === 0) {
        error_log("User not found with email: $email");
        continue;
    }

    $user_row = $result->fetch_assoc();
    $user_id = $user_row['ID'];

    // Сериализуем данные заказов
    $serialized_orders = serialize($orders_data);

    // Сохраняем в таблицу Old_Orders
    $stmt_insert->bind_param("is", $user_id, $serialized_orders);

    if ($stmt_insert->execute()) {
        $saved_count++;
    } else {
        error_log("Error saving orders for user ID {$user_id}: " . $stmt_insert->error);
    }
}

$stmt_insert->close();
$stmt_get_id->close();
$mysqli->close();

echo "Orders backup completed. Saved {$saved_count} records to Old_Orders.\n";