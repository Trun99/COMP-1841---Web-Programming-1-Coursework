<?php if (isset($_SESSION['user_id'])): ?>
  <li><a href="../authentication/logout.php">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a></li>
<?php else: ?>
  <li><a href="../authentication/login.php">Log In</a></li>
  <li><a href="../authentication/register.php">Sign Up</a></li>
<?php endif; ?>
