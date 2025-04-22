<h2>Newest Feeds</h2>
<?php foreach ($questions as $question): ?>
  <blockquote>
    <p><strong><?= htmlspecialchars($question['title']) ?></strong><br>
      <?= nl2br(htmlspecialchars($question['content'])) ?><br>
      <small>Posted by <?= htmlspecialchars($question['username']) ?> in <?= htmlspecialchars($question['module_name']) ?> on <?= $question['date_posted'] ?></small>
    </p>

    <?php if (!empty($question['image_path'])): ?>
      <img src="/CW_PHPupdate/<?= htmlspecialchars($question['image_path']) ?>" alt="Question Image" style="max-width:200px; display:block; margin-top:10px;">
    <?php endif; ?>

    <?php if (isset($_SESSION['user_id']) && (int)$_SESSION['user_id'] === (int)$question['user_id']): ?>
      <div class="question-actions">
        <a href="../postsmanagement/editquestion.php?id=<?= $question['id'] ?>" class="edit-button">Edit</a>
        <form action="../postsmanagement/deletequestion.php" method="post" class="delete-form">
          <input type="hidden" name="id" value="<?= $question['id'] ?>">
          <input type="submit" class="delete-button" value="Delete">
        </form>
      </div>
    <?php endif; ?>

  </blockquote>
<?php endforeach; ?>
