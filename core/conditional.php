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