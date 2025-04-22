<?php if (!empty($error)): ?>
  <div class="error-message" role="alert" style="color: red; margin-bottom: 1em;">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<div class="register-box">
  <form action="../authentication/register.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" id="confirm_password" required>

    <input type="submit" value="Sign Up">
  </form>
</div>
