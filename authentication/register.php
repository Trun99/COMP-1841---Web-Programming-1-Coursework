<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php'; 

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $role = 'user'; // default
        $user_id = registerUser($pdo, $username, $email, $hashed_password, $role);

        $_SESSION['user_id']  = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['email']    = $email;
        $_SESSION['role']     = $role;

        header('Location: ../corephpfiles/community.php');
        exit;
    }
}

ob_start();
include '../templates/register.html.php';
$content = ob_get_clean();
include '../templates/layout.html.php';
?>
