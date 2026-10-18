<?php include 'inc/header.php'; $spots = $db->query("SELECT * FROM spots ORDER BY sort_order,id"); ?>
<section class="page">
  <h2>Tourist Spots</h2>
  <div class="cards">
    <?php while ($s = $spots->fetch_assoc()): ?>
      <a class="card" href="spot.php?id=<?= $s['id'] ?>" style="<?= spot_bg($s) ?>">
        <h3><?= e($s['name']) ?></h3>
        <p><?= e($s['tagline']) ?></p>
        <span>View details &rarr;</span>
      </a>
    <?php endwhile; ?>
  </div>
</section>
<?php include 'inc/footer.php'; ?>
