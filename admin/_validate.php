<?php
function read_product_input(&$errors) {
    $p = [
        'name' => trim($_POST['name'] ?? ''),
        'category' => trim($_POST['category'] ?? ''),
        'price' => $_POST['price'] ?? '',
        'stock' => $_POST['stock'] ?? '',
        'description' => trim($_POST['description'] ?? ''),
    ];
    if ($p['name'] === '') $errors[] = 'Nama produk wajib diisi.';
    if ($p['category'] === '') $errors[] = 'Kategori wajib diisi.';
    if (!ctype_digit((string)$p['price'])) $errors[] = 'Harga harus angka >= 0.';
    if (!ctype_digit((string)$p['stock'])) $errors[] = 'Stok harus angka >= 0.';
    return $p;
}
