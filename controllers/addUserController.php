<?php
require_once "../models/db.php";
session_start();
$db = new DB();

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isEmailUnique($email)
{
    global $db; 
    $result = $db->select('user', ['email'], [$email], true);
    return !$result;
}

function validateImage($file)
{
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!in_array($file['type'], $allowedTypes)) {
        return false;
    }

    if ($file['size'] > 2 * 1024 * 1024) {
        return false;
    }

    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $roomNum = $_POST['roomNum'];
    $ext = $_POST['ext'];
    $profilePicture = $_FILES['profilePicture'];

    $errors = [];

    try {
        if (!validateEmail($email)) {
            throw new Exception("Invalid email format.");
        }

        if (!isEmailUnique($email)) {
            throw new Exception("Email already exists.");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $db->insert('room', ['id' => $roomNum, 'ext' => $ext]);

        $fileName = $defaultImagePath = "../public/images/user1.png";
        
        if ($profilePicture['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!validateImage($profilePicture)) {
                throw new Exception("Invalid image file.");
            }
            
            $targetDir = "../public/images/";
            $fileName = uniqid() . '_' . basename($profilePicture['name']);
            $targetPath = $targetDir . $fileName;
            if (!move_uploaded_file($profilePicture['tmp_name'], $targetPath)) {
                throw new Exception("Failed to upload image.");
            }
        }

        $db->insert('user', [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'image' => $fileName,
            'room_id' => $roomNum
        ]);

        $_SESSION['success'] = "User added successfully!";
        header("Location: ../views/adminUsers.php");
    } catch (Exception $e) {
        $_SESSION['errors'] = ["general" => "Error adding user: " . $e->getMessage()];
        header("Location: ../views/addUser.php");
    }
}
?>
