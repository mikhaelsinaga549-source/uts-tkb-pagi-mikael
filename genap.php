<?php
// Sambungan Soal 3: menampilkan angka genap dari 2 sampai 20
$title = 'Angka Genap'; $base = '';
require_once __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/header.php';
?>
<h3>Angka Genap dari 2 sampai 20</h3>
<p>
<?php for ($i = 2; $i <= 20; $i += 2): ?>
  <span class="badge text-bg-primary fs-6"><?= $i ?></span>
<?php endfor; ?>
</p>
<?php include __DIR__ . '/includes/footer.php'; ?>
