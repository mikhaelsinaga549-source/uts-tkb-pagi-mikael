<?php
require_once __DIR__ . '/db.php';

function require_login() {
    if (empty($_SESSION['admin'])) {
        header('Location: ../login.php');
        exit;
    }
}
function csrf_token() {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
    return $_SESSION['csrf'];
}
function csrf_check() {
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(400);
        exit('Token tidak valid.');
    }
}
