<?php

session_start();

require_once __DIR__ . '/../includes/DatabaseConnection.php';
require __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$status = $_SESSION['status'] ?? '';
$error  = $_SESSION['error']  ?? '';
unset($_SESSION['status'], $_SESSION['error']);


$name  = $_SESSION['username'] ?? '';
$email = $_SESSION['email']    ?? '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $name     = trim($_POST['name']     ?? $name);
    $email    = trim($_POST['email']    ?? $email);
    $to_email = trim($_POST['to_email'] ?? '');
    $message  = trim($_POST['message']  ?? '');

  
    if (empty($name) || empty($email) || empty($to_email) || empty($message)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)
           || !filter_var($to_email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter valid email addresses.';
    } else {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ngthtrungogjz@gmail.com';    
            $mail->Password   = 'vbpu njol wdvx easp';       
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->SMTPDebug  = 2; 
            
            
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            
            $mail->setFrom('ngthtrungogjz@gmail.com', $name);
            $mail->addAddress($to_email);
            
            $mail->isHTML(false);
            $mail->Subject = "Message from $name";
            $mail->Body    = "Name: $name\nEmail: $email\n\n$message";
            
            
            $mail->send();
            $status = 'Message sent successfully!';
        } catch (Exception $e) {
            $error = 'Mailer Error: ' . $mail->ErrorInfo;
        }
    } 

    
    $_SESSION['status'] = $status;
    $_SESSION['error']  = $error;
    header('Location: ' . basename(__FILE__));
    exit;
}


ob_start();
include __DIR__ . '/../templates/contact.html.php';
$content = ob_get_clean();
include __DIR__ . '/../templates/layout.html.php';
