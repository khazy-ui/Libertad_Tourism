<?php require 'inc.php'; need_login(); $msg = '';
if (isset($_GET['del'])) { $st = $db->prepare("DELETE FROM spots WHERE id=?"); $st->bind_param('i', $_GET['del']); $st->execute(); $msg = 'Spot deleted.'; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)$_POST['id']; $img = $_POST['old_image'] ?? null;
  if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === 0) {
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg','jpeg','png','webp'])) {
      $img = uniqid('spot_').'.'.$ext; move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.'/../uploads/'.$img);
    }
  }
  if ($id) {
    $st = $db->prepare("UPDATE spots SET name=?,tagline=?,description=?,how_to_get=?,tips=?,color=?,sort_order=?,image=? WHERE id=?");
    $st->bind_param('ssssssisi', $_POST['name'], $_POST['tagline'], $_POST['description'], $_POST['how_to_get'], $_POST['tips'], $_POST['color'], $_POST['sort_order'], $img, $id);
  } else {
    $st = $db->prepare("INSERT INTO spots (name,tagline,description,how_to_get,tips,color,sort_order,image) VALUES (?,?,?,?,?,?,?,?)");
    $st->bind_param('ssssssis', $_POST['name'], $_POST['tagline'], $_POST['description'], $_POST['how_to_get'], $_POST['tips'], $_POST['color'], $_POST['sort_order'], $img);
  }
  $st->execute(); $msg = 'Spot saved.';
}
ahead('Manage Spots');
if ($msg) echo '<div class="ok">'.e($msg).'</div>';
if (isset($_GET['edit']) || isset($_GET['new'])):
  $s = ['id'=>0,'name'=>'','tagline'=>'','description'=>'','how_to_get'=>'','tips'=>'','color'=>'#1f7a8c','sort_order'=>0,'image'=>''];
  if (isset($_GET['edit'])) { $st = $db->prepare("SELECT * FROM spots WHERE id=?"); $st->bind_param('i', $_GET['edit']); $st->execute(); $s = $st->get_result()->fetch_assoc() ?: $s; } ?>
<div class="box"><form method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $s['id'] ?>"><input type="hidden" name="old_image" value="<?= e($s['image']) ?>">
  <label>Name</label><input name="name" value="<?= e($s['name']) ?>" required>
  <label>Tagline</label><input name="tagline" value="<?= e($s['tagline']) ?>">
  <label>Overview</label><textarea name="description" rows="4"><?= e($s['description']) ?></textarea>
  <label>How to get there</label><textarea name="how_to_get" rows="3"><?= e($s['how_to_get']) ?></textarea>
  <label>Tips</label><textarea name="tips" rows="3"><?= e($s['tips']) ?></textarea>
  <label>Theme color</label><input type="color" name="color" value="<?= e($s['color']) ?>">
  <label>Order</label><input type="number" name="sort_order" value="<?= (int)$s['sort_order'] ?>">
  <label>Photo (jpg, png, webp)</label><input type="file" name="image" accept="image/*">
  <div><button class="btn">Save</button> <a class="btn gray" href="spots.php">Cancel</a></div>
</form></div>
<?php else: $r = $db->query("SELECT * FROM spots ORDER BY sort_order,id"); ?>
<p style="margin-bottom:12px"><a class="btn" href="?new=1">+ Add Spot</a></p>
<table><tr><th>Name</th><th>Tagline</th><th>Actions</th></tr>
<?php while ($s = $r->fetch_assoc()): ?>
<tr><td><?= e($s['name']) ?></td><td><?= e($s['tagline']) ?></td>
<td><a class="btn" href="?edit=<?= $s['id'] ?>">Edit</a> <a class="btn red" href="?del=<?= $s['id'] ?>" onclick="return confirm('Delete this spot?')">Delete</a></td></tr>
<?php endwhile; ?></table>
<?php endif; afoot();
