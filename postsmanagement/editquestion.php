<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';  

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ../corephpfiles/community.php');
    exit;
}


$users = $pdo->query('SELECT id, username FROM users')->fetchAll();
$modules = $pdo->query('SELECT id, name FROM modules')->fetchAll();


$stmt = $pdo->prepare('SELECT * FROM questions WHERE id = ?');
$stmt->execute([$id]);
$question = $stmt->fetch();

if (!$question) {
    echo "Question not found.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $user_id = $_SESSION['user_id'];
    $module_id = $_POST['module_id'] ?? null;

    
    $imagePath = uploadImageEQ($_FILES['image'] ?? null);  

    
    updateQuestion($pdo, $id, $title, $content, $user_id, $module_id, $imagePath);  

    
    header('Location: ../corephpfiles/community.php');
    exit;
}


ob_start();
include '../templates/editquestion.html.php';
$content = ob_get_clean();

include '../templates/layout.html.php';
