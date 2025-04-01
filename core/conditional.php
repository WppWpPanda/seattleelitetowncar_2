<?php
defined('ABS_PATH') or exit('No direct script access allowed');
function is_home_page() {
    // Проверяем несколько возможных вариантов главной страницы
    $script_name = basename($_SERVER['SCRIPT_FILENAME']);
    $request_uri = trim($_SERVER['REQUEST_URI'], '/');

    return ($request_uri === '' ||
        $request_uri === 'index.php' ||
        $script_name === 'index.php' && empty($request_uri));
}