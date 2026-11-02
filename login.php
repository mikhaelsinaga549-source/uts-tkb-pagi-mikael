<?php
require_once __DIR__ . '/includes/auth.php';
$title = 'Login Admin'; $base = '';
if (!empty($_SESSION['admin'])) { header('Location: admin/dashboard.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $st = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $st->execute([trim($_POST['username'] ?? '')]);
    $a = $st->fetch();
    if ($a && password_verify($_POST['password'] ?? '', $a['password'])) {
        session_regenerate_id(true);
        $_SESSION['admin'] = $a['username'];
        header('Location: admin/dashboard.php'); exit;
    }
    $error = 'Username atau password salah.';
}
include __DIR__ . '/includes/header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-5 col-lg-4">
    <div class="card shadow">
      <div class="card-body p-4">
        <h4 class="text-center mb-1"><i class="bi bi-shield-lock"></i> Login Admin</h4>
        <p class="text-center text-muted small">Masuk untuk mengelola produk</p>
        <?php if ($error): ?><div class="alert alert-danger py-2"><?= e($error) ?></div><?php endif; ?>
        <form method="post">
          <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
          <div class="mb-3"><label class="form-label">Username</label>
            <input name="username" class="form-control" required autofocus></div>
          <div class="mb-3"><label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required></div>
          <button class="btn btn-dark w-100">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
