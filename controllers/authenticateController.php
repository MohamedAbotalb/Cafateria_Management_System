<?php

require_once "../models/db.php";
require_once "../PHPMailer/mail.php";

session_start();

class AuthenticateController
{
  private $db;

  public function __construct()
  {
    $this->db = new DB();
  }

  public function login()
  {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $condition = ['email'];
    $values = ["$email"];

    $user = $this->db->select("user", $condition, $values, true);

    if ($user && password_verify($password, $user["password"])) {
      $this->setLoggedInUser($user);
      $this->redirectToHomePage($user['role']);
    } else {
      $this->redirectToLoginPage("Your email or password is incorrect");
    }
  }

  public function logout()
  {
    session_unset();
    session_destroy();
    $this->redirectToLoginPage();
  }

  public function forgetPassword()
  {
    $email = $_POST['email'];
    $condition = ['email'];
    $values = ["$email"];

    $user = $this->db->select("user", $condition, $values, true);

    if ($user) {
      $resetCode = mt_rand(100000, 999999);
      $_SESSION['reset_code'] = $resetCode;
      $_SESSION['email'] = $user['email'];

      $this->sendResetCode($user['name'], $user['email'], $resetCode);
      $this->redirectToResetCodePage();
    } else {
      $this->redirectToForgetPasswordPage("This email is not registered");
    }
  }

  public function validateResetCode()
  {
    $resetCode = (int) $_POST["resetCode"];

    if ($resetCode !== $_SESSION['reset_code']) {
      $this->redirectToResetCodePage("The reset code is incorrect");
    } else {
      $this->redirectToUpdatePasswordPage();
    }
  }

  public function updatePassword()
  {
    $updatedPassword = password_hash($_POST["updatePassword"], PASSWORD_DEFAULT);
    $condition = ["email" => $_SESSION['email']];
    $values = ["password" => $updatedPassword];

    $this->db->update('user', $condition, $values);
    $this->redirectToLoginPage();
  }

  private function setLoggedInUser($user)
  {
    unset($user['password']);
    $_SESSION['logged_in'] = true;
    $_SESSION['user'] = $user;
  }

  private function redirectToHomePage($role)
  {
    $location = $role == 'admin' ? 'adminHome.php' : 'userHome.php';
    header("Location:../views/$location");
    exit();
  }

  private function redirectToLoginPage($errorMessage = null)
  {
    if ($errorMessage) {
      $_SESSION['errors']['login'] = $errorMessage;
    }
    header("Location:../views/login.php");
    exit();
  }

  private function sendResetCode($name, $email, $resetCode)
  {
    sendMail($name, $email, $resetCode);
  }

  private function redirectToResetCodePage($errorMessage = null)
  {
    if ($errorMessage) {
      $_SESSION['errors']['resetCode'] = $errorMessage;
    }
    header("Location:../views/resetCode.php");
    exit();
  }

  private function redirectToForgetPasswordPage($errorMessage)
  {
    $_SESSION['errors']['forgetPassword'] = $errorMessage;
    header("Location:../views/forgetPassword.php");
    exit();
  }

  private function redirectToUpdatePasswordPage()
  {
    header("Location:../views/updatePassword.php");
    exit();
  }
}

$authController = new AuthenticateController();

if (isset($_POST["login"])) {
  $authController->login();
} else if (isset($_POST["forget"])) {
  $authController->forgetPassword();
} else if (isset($_POST["validate"])) {
  $authController->validateResetCode();
} else if (isset($_POST["update"])) {
  $authController->updatePassword();
} else {
  $authController->logout();
}
