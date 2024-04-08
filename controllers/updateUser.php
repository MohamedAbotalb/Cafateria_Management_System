<?php
// Include DB class
require_once "../models/db.php";
require_once "../models/allProducts&usersModel.php";

// Function to validate email
function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate image
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

// Function to validate data
function validateData($data)
{
    $data = trim($data);
    $data = addslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to check if room exists
function roomExists($roomId, $db)
{
    // Check if the room exists in the database
    return $db->exists("room", ["id" => $roomId]);
}

// Function to check if extension exists
function extensionExists($extension, $db)
{
    // Check if the extension exists in the database
    return $db->exists("room", ["ext" => $extension]);
}

// Function to add error to the errors array
function addError(&$errors, $key, $message)
{
    $errors[$key] = $message;
}
// Function to handle file upload
function handleFileUpload($file)
{
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Validate the uploaded image
        if (!validateImage($file)) {
            // Handle image validation error
            throw new Exception('Only PNG, JPEG, and JPG files with size less than 2 MB are allowed.');
        }
        $tempFile = $file['tmp_name'];
        $targetPath = '../public/images/';
        $newFileName = uniqid() . '_' . $file['name'];
        // Generate unique file name to avoid conflicts 
        $targetFile = $targetPath . $newFileName;
        if (move_uploaded_file($tempFile, $targetFile)) {
            // File uploaded successfully, return the new file name
            return $newFileName;
        } else { // File upload failed, handle error accordingly 
            throw new Exception('File upload failed');
        }
    } else {
        // No file uploaded or upload error occurred
        return null;
    }
}

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Initialize an array to store errors
        $errors = [];

        // Get the form data
        $name = validateData($_POST["name"]);
        $email = validateData(validateEmail($_POST["email"]));
        $roomNum = validateData($_POST["roomNum"]);
        $ext = validateData($_POST["ext"]);
        $userId = validateData($_POST["userId"]);

        // Instantiate the DB class
        $db = DB::getInstance();
        $db2 = new UsersandProducts();

        // Check if the room exists
        if (!roomExists($roomNum, $db2)) {
            addError($errors, 'room', 'Room not found. Please select a valid room.');
        }

        // Check if the extension exists
        if (!extensionExists($ext, $db2)) {
            addError($errors, 'ext', 'Extension not found. Please select a valid extension.');
        }

        // Check if the room assigned to the user already has the given extension
        // $roomWithExtExists = $db2->exists("room", ["id" => $roomNum, "ext" => $ext]);
        // if (!$roomWithExtExists) {
        //     addError($errors, 'room&ex', 'The room assigned to the user doesn\'t have the provided extension.');
        // }

        // Check if the email already exists in the database
        $currentUserEmail = $db2->select(
            "SELECT email FROM user WHERE id = :id",
            [":id" => $userId]
        )[0]['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            addError($errors, 'invalidEmail', 'Invalid email. Please write valid email.');
        } else {
            if ($email !== $currentUserEmail) {
                // If the email is different from the current user's email, check if it exists
                $emailExists = $db2->exists("user", ["email" => $email]);
                if ($emailExists) {
                    // Email already exists, add error to array
                    addError($errors, 'existEmail', 'Email already exists. Please choose a different email.');
                }
            }
        }

        // Handle file upload 
        $uploadedFileName = handleFileUpload($_FILES['profilePicture']);

        // If there are errors, throw an exception with the errors array
        if (!empty($errors)) {
            // Update response with errors
            $response['message'] = "Validation failed.";
            $response['errors'] = $errors;
            echo json_encode($response);
            exit();
        }

        // Update user data in the database
        $updateData["name"] = $name;
        $updateData["email"] = $email;
        $updateData["room_id"] = $roomNum;
        // If file uploaded successfully, update the database record with the new image file name
        if ($uploadedFileName !== null) {
            $updateData['image'] = $uploadedFileName;
        }
        $db->update("user", ["id" => $userId], $updateData);

        // Update the extension in the room table
        $db->update("room", ["id" => $roomNum], ["ext" => $ext]);

        // Fetch the updated user data from the database (from both tables)
        $updatedUser = $db2->select(
            "SELECT u.*, r.ext FROM user u INNER JOIN room r ON u.room_id = r.id WHERE u.id = :id",
            [":id" => $userId]
        );

        // Update response with success data
        $response['success'] = true;
        $response['message'] = 'User updated successfully';
        $response['updatedUser'] = $updatedUser; // Return updated user data for displaying changes

        // Return the success flag and updated user data in JSON format
        echo json_encode($response);
        exit();
    } catch (Exception $e) {
        // Error occurred, handle it
        $response['message'] = $e->getMessage();
        echo json_encode($response);
        exit();
    }
}

// if error during processing
echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit();
