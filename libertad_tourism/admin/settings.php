<?php require 'inc.php'; need_login(); $msg = '';
$fields = ['site_title'=>'Website title','tagline'=>'Tagline','about'=>'About text','contact_name'=>'Contact name','contact_phone'=>'Phone','contact_email'=>'Email','contact_address'=>'Address'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $st = $db->prepare("INSERT INTO settings (k,v) VALUES (?,?) ON DUPLICATE KEY UPDATE v=VALUES(v)");
  foreach ($fields as $k => $l) { $v = $_POST[$k] ?? ''; $st->bind_param('ss', $k, $v); $st->execute(); }
  if (!empty($_POST['new_password'])) {
    $h = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $u = $db->prepare("UPDATE admins SET password=? WHERE username=?"); $u->bind_param('ss', $h, $_SESSION['admin']); $u->execute();
  }
  $msg = 'Saved.';
}
ahead('Site Content');
if ($msg) echo '<div class="ok">'.$msg.'</div>';
$cur = []; $r = $db->query("SELECT k,v FROM settings"); while ($x = $r->fetch_assoc()) $cur[$x['k']] = $x['v']; ?>
<div class="box"><form method="post">
<?php foreach ($fields as $k => $l): ?><label><?= $l ?></label>
  <?php if ($k === 'about'): ?><textarea name="<?= $k ?>" rows="5"><?= e($cur[$k] ?? '') ?></textarea>
  <?php else: ?><input name="<?= $k ?>" value="<?= e($cur[$k] ?? '') ?>"><?php endif; endforeach; ?>
<label>New admin password (leave blank to keep)</label><input type="password" name="new_password">
<button class="btn">Save</button></form></div>
<?php afoot();
