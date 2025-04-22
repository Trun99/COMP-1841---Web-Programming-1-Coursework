<?php
// NOTE: No session_start() here! It’s already started in the controller.
?>

<?php if ($status): ?>
  <p style="color: green;"><strong><?= htmlspecialchars($status) ?></strong></p>
<?php elseif ($error): ?>
  <p style="color: red;"><strong><?= htmlspecialchars($error) ?></strong></p>
<?php endif; ?>

<h2>Contact the Admin</h2>

<form action="../corephpfiles/contact.php" method="post">
  <?php if (!isset($_SESSION['user_id'])): ?>
    <label for="name">Your Name:</label>
    <input type="text"
           id="name"
           name="name"
           value="<?= htmlspecialchars($name) ?>"
           required>

    <label for="email">Your Email:</label>
    <input type="email"
           id="email"
           name="email"
           value="<?= htmlspecialchars($email) ?>"
           required>
  <?php else: ?>
    <p><strong>Name:</strong>  <?= htmlspecialchars($name) ?></p>
    <p><strong>Your Email:</strong> <?= htmlspecialchars($email) ?></p>
    <input type="hidden" name="name"  value="<?= htmlspecialchars($name) ?>">
    <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
  <?php endif; ?>

  <label for="to_email">Send to:</label>
  <input type="email"
         id="to_email"
         name="to_email"
         required
         placeholder="Enter recipient’s email">

  <label for="message">Your Message:</label>
  <textarea id="message"
            name="message"
            rows="5"
            required
            placeholder="Write your message here"></textarea>

  <button type="submit">Send Message</button>
</form>
