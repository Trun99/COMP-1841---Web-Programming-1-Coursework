<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Student Q&A Board</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <header>
    <h1>Student Q&A Board</h1>
  </header>
  <nav>
    <ul class="main-nav">
      <li><a href="../corephpfiles/community.php">Home</a></li>

      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <li><a href="../admin/manageusers.php">Manage Users</a></li>
        <li><a href="../admin/managemodules.php">Manage Modules</a></li>
      <?php endif; ?>

      <li><a href="../corephpfiles/contact.php">Contact Admin</a></li>
      
      <?php include '../templates/logout.html.php'; ?>
    </ul>
  </nav>

  <main>
    <?php if (isset($output)) echo $output; ?>
    <?php if (isset($content)) echo $content; ?>
  </main>

  <footer>
    <p>&copy; <?= date('Y') ?> Student Q&A Board</p>
  </footer>
</body>
</html>
