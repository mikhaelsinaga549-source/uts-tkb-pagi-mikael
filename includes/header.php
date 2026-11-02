<?php /* variabel: $title, $base ('' atau '../') */ ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title ?? 'My Store') ?> - My Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?= $base ?>index.php"><i class="bi bi-shop"></i> My Store</a>
    <div class="ms-auto d-flex gap-2">
      <?php if (!empty($_SESSION['admin'])): ?>
        <a class="btn btn-outline-light btn-sm" href="<?= $base ?>admin/dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a class="btn btn-danger btn-sm" href="<?= $base ?>logout.php"><i class="bi bi-box-arrow-right"></i> Logout (<?= e($_SESSION['admin']) ?>)</a>
      <?php else: ?>
        <a class="btn btn-warning btn-sm" href="<?= $base ?>login.php"><i class="bi bi-person-lock"></i> Login Admin</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<main class="container py-4">
