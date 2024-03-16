<?php
require_once "../models/db.php";
session_start();

class UserHandler {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function isEmailUnique($email) {
        $result = $this->db->select('user', ['email'], [$email], true);
        return !$result;
    }

    public function validateImage($file) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($file['type'], $allowedTypes) || $file['size'] > 2 * 1024 * 1024) {
            return false;
        }
        return true;
    }

    public function addUser($name, $email, $password, $roomNum, $ext, $profilePicture) {
        try {
            if (!$this->validateEmail($email)) {
                throw new Exception("Invalid email format.");
            }

            if (!$this->isEmailUnique($email)) {
                throw new Exception("Email already exists.");
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $this->db->insert('room', ['id' => $roomNum, 'ext' => $ext]);

            $fileName = $defaultImagePath = "../public/images/user1.png";
            
            if ($profilePicture['error'] !== UPLOAD_ERR_NO_FILE) {
                if (!$this->validateImage($profilePicture)) {
                    throw new Exception("Invalid image file.");
                }
                
                $targetDir = "../public/images/";
                $fileName = uniqid() . '_' . basename($profilePicture['name']);
                $targetPath = $targetDir . $fileName;
                if (!move_uploaded_file($profilePicture['tmp_name'], $targetPath)) {
                    throw new Exception("Failed to upload image.");
                }
            }

            $this->db->insert('user', [
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
}

$userHandler = new UserHandler();
$userHandler->addUser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['roomNum'], $_POST['ext'], $_FILES['profilePicture']);
?>
