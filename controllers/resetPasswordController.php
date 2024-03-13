<?php

require_once "../models/db.php";
require_once "../PHPMailer/mail.php";

session_start();
$errors = [];
$db = new DB();
$connection = $db->getConnection();

// Check if the call is from the forgetPassword page
if (isset($_POST["send"])) {
  $email = $_POST['email'];
  $condition = ['email'];
  $values = ["$email"];

  $user = $db->select("user", $condition, $values, true);

  // Check if the user is registered on the system
  if ($user) {
    $user_password = $user["password"];
    // Generate a random 6-digit code
    $code = mt_rand(100000, 999999);

    $_SESSION['reset_code'] = $code;
    $_SESSION['email'] = $user['email'];

    // Send email with the reset code to user email
    sendMail($user['name'], $user['email'], $code);

    // Redirect to resetCode page
    header("Location:../views/resetCode.php");
  } else {
    $errors['forgetPassword'] = "This email is not registered, please enter a valid one";
    $_SESSION['errors'] = $errors;
    header("Location:../views/forgetPassword.php");
  }
}

// Check if the call is from the resetCode page
if (isset($_POST["validate"])) {
  $resetCode = (int) $_POST["resetCode"];

  if ($resetCode !== $_SESSION['reset_code']) {
    $errors['resetCode'] = "This code is invalid, please enter a valid one";
    $_SESSION['errors'] = $errors;

    // Redirect to the resetCode page
    header("Location:../views/resetCode.php");
  } else {
    // Redirect to the updatePassword page
    header("Location:../views/updatePassword.php");
  }
}

// Check if the call if from the updatePassword page
if (isset($_POST["update"])) {
  $updatedPassword = password_hash($_POST["updatePassword"], PASSWORD_DEFAULT);

  $condition = [
    "email" => $_SESSION['email'],
  ];
  $values = [
    "password" => $updatedPassword
  ];

  // update the password in the database
  $db->update('user', $condition, $values);

  // Redirect to login page
  header("Location:../views/login.php");
}
