<?php include 'inc/header.php';
$st = $db->prepare("SELECT * FROM spots WHERE id=?"); $id = (int)($_GET['id'] ?? 0);
$st->bind_param('i', $id); $st->execute(); $s = $st->get_result()->fetch_assoc();
if (!$s) { echo '<section class="page"><h2>Spot not found</h2><a class="btn" href="spots.php">Back</a></section>'; include 'inc/footer.php'; exit; } ?>
<section class="detail">
  <div class="side" style="<?= spot_bg($s) ?>">
    <h2><?= e($s['name']) ?></h2>
    <p><?= e($s['tagline']) ?></p>
    <a class="btn light" href="spots.php">&larr; All spots</a>
  </div>
  <div class="info">
    <div class="tabs">
      <button class="tab on" data-t="t1">Overview</button>
      <button class="tab" data-t="t2">How to get there</button>
      <button class="tab" data-t="t3">Tips</button>
    </div>
    <div class="pane on" id="t1"><?= nl2br(e($s['description'])) ?></div>
    <div class="pane" id="t2"><?= nl2br(e($s['how_to_get'])) ?></div>
    <div class="pane" id="t3"><?= nl2br(e($s['tips'])) ?></div>
  </div>
</section>
<?php include 'inc/footer.php'; ?>
