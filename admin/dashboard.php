<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();
$title = 'Dashboard Admin'; $base = '../';
$q = trim($_GET['q'] ?? '');
$st = $pdo->prepare("SELECT * FROM products WHERE name LIKE ? OR category LIKE ? ORDER BY id DESC");
$st->execute(["%$q%", "%$q%"]);
$products = $st->fetchAll();
$total = (int)$pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$stok  = (int)$pdo->query("SELECT COALESCE(SUM(stock),0) FROM products")->fetchColumn();
$kat   = (int)$pdo->query("SELECT COUNT(DISTINCT category) FROM products")->fetchColumn();
$flash = $_SESSION['flash'] ?? ''; unset($_SESSION['flash']);
include __DIR__ . '/../includes/header.php';
?>
<h3 class="mb-3">Dashboard Admin</h3>
<?php if ($flash): ?><div class="alert alert-success py-2"><?= e($flash) ?></div><?php endif; ?>
<div class="row g-3 mb-4">
  <div class="col-md-4"><div class="card text-bg-primary"><div class="card-body"><div class="small">Total Produk</div><div class="fs-2"><?= $total ?></div></div></div></div>
  <div class="col-md-4"><div class="card text-bg-success"><div class="card-body"><div class="small">Total Stok</div><div class="fs-2"><?= $stok ?></div></div></div></div>
  <div class="col-md-4"><div class="card text-bg-warning"><div class="card-body"><div class="small">Kategori</div><div class="fs-2"><?= $kat ?></div></div></div></div>
</div>
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <strong>Data Produk</strong>
    <div class="d-flex gap-2">
      <form class="d-flex" method="get"><input class="form-control form-control-sm me-2" name="q" value="<?= e($q) ?>" placeholder="Cari..."><button class="btn btn-sm btn-outline-dark">Cari</button></form>
      <a href="create.php" class="btn btn-sm btn-success"><i class="bi bi-plus-lg"></i> Tambah Produk</a>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-hover mb-0 align-middle">
      <thead class="table-dark"><tr><th>#</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th class="text-end">Aksi</th></tr></thead>
      <tbody>
      <?php foreach ($products as $i => $p): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= e($p['name']) ?></td>
          <td><span class="badge text-bg-secondary"><?= e($p['category']) ?></span></td>
          <td><?= rupiah($p['price']) ?></td>
          <td><?= (int)$p['stock'] ?></td>
          <td class="text-end">
            <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Edit</a>
            <form method="post" action="delete.php" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
              <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
              <input type="hidden" name="id" value="<?= $p['id'] ?>">
              <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (!$products): ?><tr><td colspan="6" class="text-center text-muted">Tidak ada data.</td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
