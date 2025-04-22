<style>
  .ask-form {
    display: none;
    background-color: #f9f9f9;
    padding: 1em;
    border: 1px solid #ccc;
    border-radius: 8px;
    margin-top: 1em;
  }

  .ask-toggle {
    display: inline-block;
    cursor: pointer;
    padding: 0.5em 1em;
    background-color:#38a169;
    color: white;
    border-radius: 8px;
    font-weight: bold;
  }

  .ask-toggle:hover {
    background-color:rgb(214, 147, 83);
  }

  .ask-form input[type="text"], .ask-form textarea, .ask-form select {
    width: 100%;
    padding: 0.75em;
    margin: 0.5em 0;
    border-radius: 5px;
    border: 1px solid #ccc;
  }

  .ask-form input[type="submit"], .ask-form button {
    background-color:#38a169;
    color: white;
    padding: 0.75em 1.5em;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 1em;
  }

  .ask-form input[type="submit"]:hover, .ask-form button:hover {
    background-color:rgb(214, 147, 83);
  }

  .ask-form button {
    background-color: transparent;
    border: 1px solid #ccc;
    margin-left: 1em;
  }
</style>

<div class="ask-toggle" onclick="document.getElementById('questionForm').style.display = 'block'; this.style.display = 'none'; document.getElementById('questionForm').scrollIntoView({behavior: 'smooth'});">
  Post your question..
</div>

<div id="questionForm" class="ask-form">
  <h2>Add a New Question</h2>
  <form action="../postsmanagement/addquestion.php" method="post" enctype="multipart/form-data">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="content">Content:</label>
    <textarea name="content" id="content" rows="5" required></textarea>

    <label for="image">Upload Image:</label>
    <input type="file" name="image" id="image" accept="image/*">

    <label for="module_id">Module:</label>
    <select name="module_id" id="module_id" required>
      <?php foreach ($modules as $module): ?>
        <option value="<?= $module['id'] ?>"><?= htmlspecialchars($module['name']) ?></option>
      <?php endforeach; ?>
    </select>

    <input type="submit" value="Post Question">
    <button type="button" 
        onclick="document.getElementById('questionForm').style.display = 'none'; document.querySelector('.ask-toggle').style.display = 'block';" 
        style="background-color: #007bff; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
  Cancel
</button>

  </form>
</div>
