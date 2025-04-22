<?php
require_once 'DatabaseConnection.php';

function getAllModules(PDO $pdo) {
    return $pdo->query('SELECT * FROM modules ORDER BY name')->fetchAll();
}

function addModule(PDO $pdo, $modulename) {
    $stmt = $pdo->prepare('INSERT INTO modules (name) VALUES (?)');
    $stmt->execute([$modulename]);
}

function deleteModule(PDO $pdo, $id) {
    $stmt = $pdo->prepare('DELETE FROM questions WHERE module_id = ?');
    $stmt->execute([$id]);

    $stmt = $pdo->prepare('DELETE FROM modules WHERE id = ?');
    $stmt->execute([$id]);
}


function getAllUsers(PDO $pdo) {
    return $pdo->query('SELECT * FROM users ORDER BY username')->fetchAll();
}

function getAllUsersBasic(PDO $pdo) {
    return $pdo->query('SELECT id, username FROM users')->fetchAll();
}

function getAllModulesBasic(PDO $pdo) {
    return $pdo->query('SELECT id, name FROM modules')->fetchAll();
}

function getAllQuestionsBasic(PDO $pdo) {
    return $pdo->query('
        SELECT q.*, u.username, m.name AS module_name
        FROM questions q
        LEFT JOIN users u ON q.user_id = u.id
        LEFT JOIN modules m ON q.module_id = m.id
        ORDER BY q.date_posted DESC
    ')->fetchAll();
}


function addUser(PDO $pdo, $username, $email) {
    $stmt = $pdo->prepare('INSERT INTO users (username, email) VALUES (?, ?)');
    $stmt->execute([$username, $email]);
}

function deleteUser(PDO $pdo, $id) {
    $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
    $stmt->execute([$id]);
}

function getUserByEmail(PDO $pdo, $email) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    return $stmt->fetch();
}

function registerUser(PDO $pdo, $username, $email, $hashed_password, $role = 'user') {
    $stmt = $pdo->prepare("INSERT INTO users (username, email, hashed_password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $email, $hashed_password, $role]);
    return $pdo->lastInsertId();
}


function insertQuestion(PDO $pdo, $title, $content, $user_id, $module_id, $imagePath = null) {
    $stmt = $pdo->prepare('INSERT INTO questions (title, content, user_id, module_id, image_path, date_posted) VALUES (?, ?, ?, ?, ?, NOW())');
    $stmt->execute([$title, $content, $user_id, $module_id, $imagePath]);
}

function deleteQuestion(PDO $pdo, $id) {
    $stmt = $pdo->prepare('DELETE FROM questions WHERE id = ?');
    $stmt->execute([$id]);
}

function getAllQuestions(PDO $pdo) {
    return $pdo->query('
        SELECT q.*, u.username, m.name AS module_name
        FROM questions q
        LEFT JOIN users u ON q.user_id = u.id
        LEFT JOIN modules m ON q.module_id = m.id
        ORDER BY q.date_posted DESC
    ')->fetchAll();
}

function getQuestionById(PDO $pdo, $id) {
    $stmt = $pdo->prepare('SELECT * FROM questions WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function updateQuestion(PDO $pdo, $title, $content, $user_id, $module_id, $imagePath, $id) {
    $stmt = $pdo->prepare('UPDATE questions SET title = ?, content = ?, user_id = ?, module_id = ?, image_path = ? WHERE id = ?');
    $stmt->execute([$title, $content, $user_id, $module_id, $imagePath, $id]);
}

function userExists(PDO $pdo, $user_id) {
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn() > 0;
}


function uploadImage($image) {
    if ($image && $image['error'] === UPLOAD_ERR_OK) {
        
        $imageTmpPath = $image['tmp_name'];
        $imageName = time() . '_' . basename($image['name']);
        $targetDir = '../uploads/';
        $targetPath = $targetDir . $imageName;

        
        $allowed = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($image['type'], $allowed)) {
            
            if (move_uploaded_file($imageTmpPath, $targetPath)) {
                return 'uploads/' . $imageName;
            } else {
                error_log("Image upload failed for: $imageName");
            }
        } else {
            error_log("Invalid image type: " . $image['type']);
        }
    }

    return null;  
}


function uploadImageEQ($image) {
    $imagePath = null;
    if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $image['tmp_name'];
        $imageName = basename($image['name']);
        $targetDir = 'uploads/';
        $targetPath = $targetDir . $imageName;
        
        if (move_uploaded_file($imageTmpPath, $targetPath)) {
            $imagePath = $targetPath;
        }
    }
    return $imagePath;
}
