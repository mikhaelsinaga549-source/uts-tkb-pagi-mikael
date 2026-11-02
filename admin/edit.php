<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/_validate.php';
require_login();
$title = 'Edit Produk'; $base = '../'; $heading = 'Edit Produk';
$id = (int)($_GET['id'] ?? 0);
$st = $pdo->prepare("SELECT * FROM products WHERE id = ?"); $st->execute([$id]);
$p = $st->fetch();
if (!$p) { $_SESSION['flash'] = 'Produk tidak ditemukan.'; header('Location: dashboard.php'); exit; }
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $p = read_product_input($errors);
    if (!$errors) {
        $pdo->prepare("UPDATE products SET name=?, category=?, price=?, stock=?, description=? WHERE id=?")
            ->execute([$p['name'],$p['category'],(int)$p['price'],(int)$p['stock'],$p['description'],$id]);
        $_SESSION['flash'] = 'Produk berhasil diperbarui.';
        header('Location: dashboard.php'); exit;
    }
}
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/_form.php';
include __DIR__ . '/../includes/footer.php';
