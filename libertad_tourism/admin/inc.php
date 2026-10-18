<?php
require __DIR__.'/../config.php';
function need_login() { if (empty($_SESSION['admin'])) { header('Location: login.php'); exit; } }
function ahead($title) { need_login(); $p = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin - <?= e($title) ?></title><link rel="stylesheet" href="admin.css"></head><body>
<aside>
  <h3>&#9881; Admin</h3>
  <a href="index.php" class="<?= $p=='index.php'?'on':'' ?>">Dashboard</a>
  <a href="spots.php" class="<?= $p=='spots.php'?'on':'' ?>">Manage Spots</a>
  <a href="settings.php" class="<?= $p=='settings.php'?'on':'' ?>">Site Content</a>
  <a href="messages.php" class="<?= $p=='messages.php'?'on':'' ?>">Messages</a>
  <a href="../index.php" target="_blank">View Website</a>
  <a href="logout.php">Logout</a>
</aside><main><h2><?= e($title) ?></h2>
<?php }
function afoot() { echo '</main></body></html>'; }
