<?php require 'inc.php'; ahead('Dashboard');
$n1 = $db->query("SELECT COUNT(*) c FROM spots")->fetch_assoc()['c'];
$n2 = $db->query("SELECT COUNT(*) c FROM messages")->fetch_assoc()['c']; ?>
<div class="stats"><div class="stat"><?= $n1 ?><small>Tourist spots</small></div><div class="stat"><?= $n2 ?><small>Messages</small></div></div>
<?php afoot();
