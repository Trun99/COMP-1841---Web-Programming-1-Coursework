<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = getUserByEmail($pdo, $email);

    if ($user && password_verify($password, $user['hashed_password'])) {
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email']    = $user['email'];
        $_SESSION['role']     = $user['role'];

        header('Location: ../corephpfiles/community.php');
        exit;
    } else {
        $error = 'Invalid email or password.';
    }
}

ob_start();
include '../templates/login.html.php';
$content = ob_get_clean();
include '../templates/layout.html.php';
?>
