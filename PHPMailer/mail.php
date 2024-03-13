<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($user, $email, $resetCode)
{
  require 'vendor/autoload.php';

  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'mohamed.abotalb277@gmail.com';
    $mail->Password   = 'qgxvhgceljtfpkql';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    $mail->setFrom("mohamed.abotalb277@gmail.com", "ITI Cafeteria");
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Code from ITI Cafeteria';
    $mail->Body    = emailHTML($user, $resetCode);

    $mail->send();
    return true;
  } catch (Exception $e) {
    error_log("Error sending email: " . $mail->ErrorInfo);
    return false;
  }
}

function emailHTML($user, $resetCode)
{
  return
    "
  <div style='width: 40rem; border: 1px solid lightgray; border-radius: 10px; padding: 20px; margin: 100px auto; text-align: center;'>
    <h1 style='text-transform: capitalize;'>Hello $user</h1>
    <p style='font-weight: bold; font-size: 1.5rem; '>Password Reset Code</p>
    <div>
      <p style='font-size: 1.2rem; line-height: 1.5;'>
        We received a request from you to reset your password!<br>
        This is a 6-digits code, please enter it in the reset password page
      </p> 
      <div style='width: 25%; font-size: 1.4rem; background-color: green; color: white; margin: 20px auto; border-radius: 10px;'>
        <h2>$resetCode</h2>
      </div>
    </div>
    <h3>ITI Cafeteria Admin</h3>
  </div>
  ";
}
