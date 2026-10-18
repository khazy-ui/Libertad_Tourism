<?php require __DIR__.'/../config.php'; $page = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e(setting('site_title')) ?></title>
<link rel="stylesheet" href="assets/css/style.css">
</head><body>
<header class="top">
  <a class="logo" href="index.php">&#9968; <?= e(setting('site_title')) ?></a>
  <nav>
    <a href="index.php" class="<?= $page=='index.php'?'on':'' ?>">Home</a>
    <a href="spots.php" class="<?= in_array($page,['spots.php','spot.php'])?'on':'' ?>">Tourist Spots</a>
    <a href="about.php" class="<?= $page=='about.php'?'on':'' ?>">About</a>
    <a href="contact.php" class="<?= $page=='contact.php'?'on':'' ?>">Contact</a>
  </nav>
</header>
<main>
