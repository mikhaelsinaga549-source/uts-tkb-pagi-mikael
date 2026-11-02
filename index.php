<?php
require_once __DIR__ . '/includes/db.php';
$title = 'Beranda'; $base = '';
$q = trim($_GET['q'] ?? '');
$st = $pdo->prepare("SELECT * FROM products WHERE name LIKE ? OR category LIKE ? ORDER BY id DESC");
$st->execute(["%$q%", "%$q%"]);
$products = $st->fetchAll();
include __DIR__ . '/includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="mb-0">Katalog Produk</h3>
  <form class="d-flex" method="get">
    <input class="form-control me-2" name="q" value="<?= e($q) ?>" placeholder="Cari produk...">
    <button class="btn btn-dark">Cari</button>
  </form>
</div>
<div class="row g-3">
<?php foreach ($products as $p): ?>
  <div class="col-sm-6 col-lg-3">
    <div class="card h-100 shadow-sm">
      <div class="card-body">
        <span class="badge text-bg-secondary mb-2"><?= e($p['category']) ?></span>
        <h6 class="card-title"><?= e($p['name']) ?></h6>
        <p class="small text-muted"><?= e($p['description']) ?></p>
      </div>
      <div class="card-footer bg-white d-flex justify-content-between">
        <strong class="text-success"><?= rupiah($p['price']) ?></strong>
        <small>Stok: <?= (int)$p['stock'] ?></small>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<?php if (!$products): ?><p class="text-muted">Produk tidak ditemukan.</p><?php endif; ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
