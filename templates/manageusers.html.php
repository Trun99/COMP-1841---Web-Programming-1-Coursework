<h2>Manage Users</h2>
<form action="" method="post">
  <label for="username">Username:</label>
  <input type="text" name="username" required>

  <label for="email">Email:</label>
  <input type="email" name="email" required>

  <input type="submit" name="add" value="Add User">
</form>

<h3>Existing Users</h3>
<ul>
  <?php foreach ($users as $user): ?>
    <li>
      <?= htmlspecialchars($user['username']) ?> 
      (<?= htmlspecialchars($user['email']) ?> - <?= htmlspecialchars($user['role']) ?>)
      <form action="" method="post" style="display:inline">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <input type="submit" name="delete" value="Delete">
      </form>
    </li>
  <?php endforeach; ?>
</ul>
