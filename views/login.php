<?php
require_once "templates/head.php";

// Check if session is not already started
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Get errors from session or initialize empty array
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];

// Unset session errors to prevent them from being displayed again
unset($_SESSION['errors']);
?>

<!-- Styles -->
<link rel="stylesheet" href="../public/style.css">
<style>
  h1{
        color:#da9f5b;
        font-size:75px;
        font-family: "Pacifico", cursive;
        font-weight:bold;
    }
    h3{
      color:#da9f5b;
      font-family: "Pacifico", cursive;
    }
</style>
<div class="container my-5">
  <h1 class="text-center">Cafeteria</h1>
  <form action="../controllers/authenticateController.php" method="post" class="col-md-4 m-auto text-bg-light my-5 p-3 rounded shadow-lg bg-body-tertiary" novalidate>
    <div class="row g-3 align-items-center my-3">
      <h3 class="text-center my-3">Log in</h3>
      <div class="mb-3">
        <label for="inputEmail" class="col-form-label d-block">Email</label>
        <input type="email" name="email" id="inputEmail" class="form-control p-2" aria-describedby="emailHelpInline" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
        <div class="invalid-feedback">Please enter a valid email.</div>
      </div>
    </div>
    <div class="row g-3 align-items-center mb-3">
      <div class="mb-3">
        <label for="inputPassword" class="col-form-label">Password</label>
        <div class="input-group">
          <input type="password" name="password" id="inputPassword" class="form-control" pattern="\S{6,}" aria-describedby="passwordHelpInline" required>
          <button class="btn btn-outline-secondary" type="button" id="togglePassword">
            <i class="fa fa-eye-slash"></i>
          </button>
          <div class="invalid-feedback">Please enter a valid password.</div>
        </div>
      </div>
    </div>
    <?php if (isset($errors['login'])) : ?>
      <p class="fs-5 alert alert-danger rounded text-center p-2 mb-4"><?= $errors['login'] ?></p>
    <?php endif; ?>
    <div class="row m-auto text-center">
      <button type="submit" name="login" class="btn button mb-4 w-25 m-auto">Log In</button>
      <a href="forgetPassword.php" class="link-primary">Forgot Password?</a>
    </div>
  </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');

    forms.forEach(function(form) {
      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });

    // Toggle password visibility
    function togglePasswordVisibility(inputId, buttonId) {
      const passwordInput = document.getElementById(inputId);
      const button = document.getElementById(buttonId);
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);

      if (type === 'password') {
        button.innerHTML = '<i class="fa fa-eye-slash"></i>';
      } else {
        button.innerHTML = '<i class="fa fa-eye"></i>';
      }
    }

    // Add event listener to toggle password visibility button
    const togglePasswordButton = document.getElementById('togglePassword');
    togglePasswordButton.addEventListener('click', function() {
      togglePasswordVisibility('inputPassword', 'togglePassword');
    });

  });
</script>