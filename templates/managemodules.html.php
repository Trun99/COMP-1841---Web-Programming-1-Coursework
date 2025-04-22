<h2>Manage Modules</h2>

<form action="" method="post">
  <label for="modulename">Module Name:</label>
  <input type="text" name="modulename" required>
  <input type="submit" name="add" value="Add Module">
</form>

<h3>Existing Modules</h3>
<ul>
  <?php foreach ($modules as $module): ?>
    <li>
      <?= htmlspecialchars($module['name']) ?>
      <form action="" method="post" style="display:inline">
        <input type="hidden" name="id" value="<?= $module['id'] ?>">
        <input type="submit" name="delete" value="Delete">
      </form>
    </li>
  <?php endforeach; ?>
</ul>
