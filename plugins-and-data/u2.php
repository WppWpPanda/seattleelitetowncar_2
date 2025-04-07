<?php
/**
 * Скрипт для импорта данных из экспортированного файла в таблицу
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

// Проверяем, существует ли массив $user_data
if (!isset($user_data) || !is_array($user_data)) {
    die("Invalid data format: \$user_data array not found");
}

// UPDATE query
$update_query = "UPDATE users 
    SET address = ?,
        company = ?,
        city = ?,
        state = ?,
        zip = ?,
        mobile_phone = ?,
        daytime_phone = ?,
        card_name = ?,
        card_number = ?,
        exp_date = ?,
        cvv = ?
    WHERE email = ?";

$stmt = $mysqli->prepare($update_query);
if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
}

// Field length limits from your table structure
$field_limits = [
    'address' => 255,
    'company' => 255,
    'city' => 100,
    'state' => 2,
    'zip' => 20,
    'mobile_phone' => 20,
    'daytime_phone' => 20,
    'card_name' => 100,
    'card_number' => 20,
    'exp_date' => 10,
    'cvv' => 4
];

$updated_count = 0;
foreach ($user_data as $user) {
    if (!isset($user['basic_info']['email']) || !isset($user['meta_fields'])) {
        error_log("Skipping user - missing required fields");
        continue;
    }

    $email = $user['basic_info']['email'];
    $meta = $user['meta_fields'];

    // Process and trim values according to field limits
    $address = trimToLength($meta['address'] ?? null, $field_limits['address']);
    $company = trimToLength($meta['company'] ?? null, $field_limits['company']);
    $city = trimToLength($meta['city'] ?? null, $field_limits['city']);
    $state = trimToLength($meta['state'] ?? null, $field_limits['state']);
    $zip = trimToLength($meta['zip'] ?? null, $field_limits['zip']);
    $mobile_phone = trimToLength($meta['phone'] ?? null, $field_limits['mobile_phone']);
    $daytime_phone = trimToLength($meta['daytime_phone'] ?? null, $field_limits['daytime_phone']);
    $card_name = trimToLength($meta['card_name'] ?? null, $field_limits['card_name']);
    $card_number = trimToLength($meta['card_number'] ?? null, $field_limits['card_number']);
    $exp_date = trimToLength($meta['exp_date'] ?? null, $field_limits['exp_date']);
    $cvv = trimToLength($meta['cvv'] ?? null, $field_limits['cvv']);

    $stmt->bind_param(
        "ssssssssssss",
        $address,
        $company,
        $city,
        $state,
        $zip,
        $mobile_phone,
        $daytime_phone,
        $card_name,
        $card_number,
        $exp_date,
        $cvv,
        $email
    );

    if ($stmt->execute()) {
        $updated_count++;
    } else {
        error_log("Error updating user {$email}: " . $stmt->error);
    }
}

$stmt->close();
$mysqli->close();

echo "Import completed. Updated {$updated_count} records.\n";

/**
 * Trims string to specified maximum length
 */
function trimToLength($value, $max_length) {
    if ($value === null) {
        return null;
    }
    return mb_substr($value, 0, $max_length);
}