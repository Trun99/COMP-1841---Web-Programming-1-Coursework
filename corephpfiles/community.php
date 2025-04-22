<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php'; 


$users = getAllUsersBasic($pdo); 
$modules = getAllModulesBasic($pdo); 
$questions = getAllQuestionsBasic($pdo); 


ob_start();
include '../templates/addquestion.html.php'; 
include '../templates/questions.html.php';   
$content = ob_get_clean();

include '../templates/layout.html.php'; 
?>
