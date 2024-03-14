<?php
require_once "../models/db.php";
session_start(); 

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isEmailUnique($email) {
    $db = new DB();
    $result = $db->select('user', ['email'], [$email], true);
    return !$result; 
}

function validateImage($file) {
    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
        return ['valid' => true];
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['valid' => false, 'error' => 'Upload error.']; 
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!in_array($file['type'], $allowedTypes)) {
        return ['valid' => false, 'error' => 'Invalid file type.']; 
    }

    if ($file['size'] > 2 * 1024 * 1024) {
        return ['valid' => false, 'error' => 'File too large.']; 
    }

    return ['valid' => true];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new DB();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $roomNum = $_POST['roomNum'];
    $ext = $_POST['ext'];
    $profilePicture = $_FILES['profilePicture'];

    // Validate data
    $errors = [];
    if (!validateEmail($email)) {
        $errors['email'] = "Invalid email format.";
    }
    if (!isEmailUnique($email)) {
        $errors['email'] = "Email already exists.";
    }
    $imageValidation = validateImage($profilePicture);
    if (!$imageValidation['valid']) {
        $errors['profilePicture'] = $imageValidation['error'];
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $fileName = '';

        if ($profilePicture['error'] !== UPLOAD_ERR_NO_FILE) {
            $targetDir = "../public/images/";
            $fileName = uniqid() . '_' . basename($profilePicture['name']);
            $targetPath = $targetDir . $fileName;
            move_uploaded_file($profilePicture['tmp_name'], $targetPath);
        } else {
            $targetPath = "../public/images/user1.png"; 
        }

        // Insert user data into the database
        $db->insert('user', [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'image' => $targetPath,
            'room_id' => $roomNum,
            'ext' => $ext
        ]);

        $_SESSION['success'] = "User added successfully!";
    } else {
        $_SESSION['errors'] = $errors;
    }

    header("Location: ../views/addUser.php");
    exit();
}
?>
