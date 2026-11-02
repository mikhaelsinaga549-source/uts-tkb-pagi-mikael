<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/_validate.php';
require_login();
$title = 'Tambah Produk'; $base = '../'; $heading = 'Tambah Produk Baru';
$errors = [];
$p = ['name'=>'','category'=>'','price'=>'','stock'=>'','description'=>''];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $p = read_product_input($errors);
    if (!$errors) {
        $pdo->prepare("INSERT INTO products (name,category,price,stock,description) VALUES (?,?,?,?,?)")
            ->execute([$p['name'],$p['category'],(int)$p['price'],(int)$p['stock'],$p['description']]);
        $_SESSION['flash'] = 'Produk berhasil ditambahkan.';
        header('Location: dashboard.php'); exit;
    }
}
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/_form.php';
include __DIR__ . '/../includes/footer.php';
