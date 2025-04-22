<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';  


$user_id = $_SESSION['user_id'] ?? null;  
if (!$user_id) {
    die("Error: User is not logged in.");
}


if (!userExists($pdo, $user_id)) {
    die("Error: User does not exist in the database.");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $module_id = $_POST['module_id'] ?? null;

    
    $imagePath = uploadImage($_FILES['image'] ?? null);

    
    insertQuestion($pdo, $title, $content, $user_id, $module_id, $imagePath);

   
    header('Location: ../corephpfiles/community.php');
    exit;
} else {
    
    $users = $pdo->query('SELECT id, username FROM users')->fetchAll();
    $modules = $pdo->query('SELECT id, name FROM modules')->fetchAll();

    
    ob_start();
    include '../templates/addquestion.html.php';
    $content = ob_get_clean();

    include '../templates/layout.html.php';
}
