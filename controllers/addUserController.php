<?php
require_once "../models/db.php";
session_start();
function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isEmailUnique($email)
{
    $db = new DB();
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

    // Validate data
    $errors = [];
    if (!isEmailUnique($email)) {
        $_SESSION['errors'] = ["email" => "Email already exists."];
        header("Location: ../views/addUser.php");
        exit();
    }

    $defaultImagePath = "../public/images/user1.png";

    if (empty($errors)) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $db = new DB();

        // Check if room number already exists
        $existingRoom = $db->select('room', ['id'], [$roomNum], true);
        if (!$existingRoom) {
            $db->insert('room', ['id' => $roomNum, 'ext' => $ext]);
        }

        // Insert data into database
        $fileName = '';
        if ($profilePicture['error'] !== UPLOAD_ERR_NO_FILE) {
            $targetDir = "../public/images/";
            $fileName = uniqid() . '_' . basename($profilePicture['name']);
            $targetPath = $targetDir . $fileName;
            move_uploaded_file($profilePicture['tmp_name'], $targetPath);
        } else {
            $targetPath = $defaultImagePath;
        }

        // Insert user data
        $db->insert('user', ['name' => $name, 'email' => $email, 'password' => $hashedPassword, 'image' => $targetPath, 'room_id' => $roomNum]);

        $_SESSION['success'] = "User added successfully!";
        header("Location: ../views/adminUsers.php");
        exit();
    } else {
        $_SESSION['errors'] = ["general" => "Error adding product: " . $e->getMessage()];

        exit();
    }
}
?>
