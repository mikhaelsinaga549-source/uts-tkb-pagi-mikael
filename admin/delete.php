<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $pdo->prepare("DELETE FROM products WHERE id = ?")->execute([(int)($_POST['id'] ?? 0)]);
    $_SESSION['flash'] = 'Produk berhasil dihapus.';
}
header('Location: dashboard.php');
