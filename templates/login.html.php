<?php if (!empty($error)): ?>
  <div class="error-message" role="alert" style="color: red; margin-bottom: 1em;">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<div class="login-box">
  <form action="../authentication/login.php" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required autocomplete="email">

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required autocomplete="current-password">

    <input type="submit" value="Log In">
  </form>
</div>
