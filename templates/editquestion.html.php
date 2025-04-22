<h2>Edit Question</h2>
<form action="../postsmanagement/editquestion.php?id=<?= $question['id'] ?>" method="post" enctype="multipart/form-data">
  <label for="title">Title:</label>
  <input type="text" name="title" id="title" value="<?= htmlspecialchars($question['title']) ?>" required>

  <label for="content">Content:</label>
  <textarea name="content" id="content" rows="5" required><?= htmlspecialchars($question['content']) ?></textarea>

  <label for="image">Replace Image (optional):</label>
  <input type="file" name="image" id="image" accept="image/*">
  <?php if (!empty($question['image_path'])): ?>
    <p>Current Image:</p>
    <img src="/coursework1841/<?= htmlspecialchars($question['image_path']) ?>" style="max-width: 300px; border-radius: 8px;">
  <?php endif; ?>

  <label for="module_id">Module:</label>
  <select name="module_id" id="module_id" required>
    <?php foreach ($modules as $module): ?>
      <option value="<?= $module['id'] ?>" <?= $module['id'] == $question['module_id'] ? 'selected' : '' ?>><?= htmlspecialchars($module['name']) ?></option>
    <?php endforeach; ?>
  </select>

  <input type="submit" value="Update Question">
  <a href="../corephpfiles/community.php" style="margin-left: 1em; padding: 0.75em 1.5em; background-color: #eee; border-radius: 8px; text-decoration: none; color: #333;">Cancel</a>
</form>