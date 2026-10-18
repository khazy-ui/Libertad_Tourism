<?php require 'inc.php'; need_login();
if (isset($_GET['del'])) { $st = $db->prepare("DELETE FROM messages WHERE id=?"); $st->bind_param('i', $_GET['del']); $st->execute(); }
ahead('Messages'); $r = $db->query("SELECT * FROM messages ORDER BY id DESC"); ?>
<table><tr><th>From</th><th>Message</th><th>Date</th><th></th></tr>
<?php while ($m = $r->fetch_assoc()): ?>
<tr><td><?= e($m['name']) ?><br><small><?= e($m['email']) ?></small></td><td><?= nl2br(e($m['message'])) ?></td><td><?= e($m['created_at']) ?></td>
<td><a class="btn red" href="?del=<?= $m['id'] ?>" onclick="return confirm('Delete?')">Delete</a></td></tr>
<?php endwhile; ?></table>
<?php afoot();
