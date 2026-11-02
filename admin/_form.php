<?php /* form bersama create & edit: $p, $errors, $heading */ ?>
<div class="row justify-content-center"><div class="col-lg-7">
<div class="card shadow-sm"><div class="card-header"><strong><?= e($heading) ?></strong></div>
<div class="card-body">
  <?php foreach ($errors as $er): ?><div class="alert alert-danger py-2"><?= e($er) ?></div><?php endforeach; ?>
  <form method="post">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
    <div class="mb-3"><label class="form-label">Nama Produk</label>
      <input name="name" class="form-control" value="<?= e($p['name']) ?>" required></div>
    <div class="mb-3"><label class="form-label">Kategori</label>
      <input name="category" class="form-control" value="<?= e($p['category']) ?>" required></div>
    <div class="row">
      <div class="col-md-6 mb-3"><label class="form-label">Harga (Rp)</label>
        <input type="number" min="0" name="price" class="form-control" value="<?= e($p['price']) ?>" required></div>
      <div class="col-md-6 mb-3"><label class="form-label">Stok</label>
        <input type="number" min="0" name="stock" class="form-control" value="<?= e($p['stock']) ?>" required></div>
    </div>
    <div class="mb-3"><label class="form-label">Deskripsi</label>
      <textarea name="description" rows="3" class="form-control"><?= e($p['description']) ?></textarea></div>
    <a href="dashboard.php" class="btn btn-secondary">Batal</a>
    <button class="btn btn-success">Simpan</button>
  </form>
</div></div></div></div>
