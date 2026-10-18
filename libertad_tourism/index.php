<?php include 'inc/header.php'; $spots = $db->query("SELECT * FROM spots ORDER BY sort_order,id"); ?>
<section class="hero">
  <h1><?= e(setting('site_title')) ?></h1>
  <p><?= e(setting('tagline')) ?></p>
  <a class="btn" href="spots.php">Explore the Spots</a>
  <div class="chips">
    <?php while ($s = $spots->fetch_assoc()): ?>
      <a href="spot.php?id=<?= $s['id'] ?>"><?= e($s['name']) ?></a>
    <?php endwhile; ?>
  </div>
</section>
<?php include 'inc/footer.php'; ?>
