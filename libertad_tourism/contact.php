<?php include 'inc/header.php'; $sent = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && trim($_POST['message'] ?? '') !== '') {
  $st = $db->prepare("INSERT INTO messages (name,email,message) VALUES (?,?,?)");
  $st->bind_param('sss', $_POST['name'], $_POST['email'], $_POST['message']); $st->execute(); $sent = true;
} ?>
<section class="page contact">
  <div>
    <h2>Contact Us</h2>
    <p><strong><?= e(setting('contact_name')) ?></strong></p>
    <p>&#128205; <?= e(setting('contact_address')) ?></p>
    <p>&#128222; <?= e(setting('contact_phone')) ?></p>
    <p>&#9993; <?= e(setting('contact_email')) ?></p>
  </div>
  <form method="post">
    <?php if ($sent): ?><div class="ok">Thank you! Your message was sent.</div><?php endif; ?>
    <input name="name" placeholder="Your name" required>
    <input name="email" type="email" placeholder="Your email" required>
    <textarea name="message" rows="3" placeholder="Message" required></textarea>
    <button class="btn">Send</button>
  </form>
</section>
<?php include 'inc/footer.php'; ?>
