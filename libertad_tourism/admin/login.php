<?php require __DIR__.'/../config.php'; $err = '';
if ($db->query("SELECT COUNT(*) c FROM admins")->fetch_assoc()['c'] == 0) {
  $h = password_hash('admin123', PASSWORD_DEFAULT);
  $db->query("INSERT INTO admins (username,password) VALUES ('admin','$h')");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $st = $db->prepare("SELECT * FROM admins WHERE username=?"); $st->bind_param('s', $_POST['username']); $st->execute();
  $u = $st->get_result()->fetch_assoc();
  if ($u && password_verify($_POST['password'], $u['password'])) { $_SESSION['admin'] = $u['username']; header('Location: index.php'); exit; }
  $err = 'Wrong username or password.';
} ?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Admin Login</title><link rel="stylesheet" href="admin.css"></head>
<body><div class="login"><h2>Admin Login</h2>
<?php if ($err): ?><p class="err"><?= e($err) ?></p><?php endif; ?>
<form method="post"><input name="username" placeholder="Username" required><input name="password" type="password" placeholder="Password" required>
<button class="btn">Login</button></form><p style="margin-top:12px"><a href="../index.php">&larr; Back to website</a></p></div></body></html>
