<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
defined('ABS_PATH') or exit('No direct script access allowed');
header('Content-Type: application/json');


if (!isset($_GET['email'])) {
    echo json_encode(['exists' => false]);
    exit;
}

$auth = new Auth();
echo json_encode([
    'exists' => $auth->emailExists($_GET['email'])
]);