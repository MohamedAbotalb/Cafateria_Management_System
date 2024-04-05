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

<body style="background: url(../public/images/bg.jpg) center/100%;">
  <div class=" container my-5 text-white">
    <h1 class="text-center">Cafeteria</h1>
    <form action="../controllers/authenticateController.php" method="post" class="col-md-4 m-auto my-5 p-3 rounded" style="border: 1px solid #634322" novalidate>
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
            <input type="password" name="password" id="inputPassword" class="form-control p-2" pattern="\S{6,}" aria-describedby="passwordHelpInline" required>
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
              <i class="fa fa-eye-slash"></i>
            </button>
            <div class="invalid-feedback">Please enter a valid password</div>
          </div>
        </div>
      </div>
      <?php if (isset($errors['login'])) : ?>
        <p class="fs-5 alert alert-danger rounded text-center p-2 mb-4"><?= $errors['login'] ?></p>
      <?php endif; ?>
      <div class="row m-auto text-center">
        <button type="submit" name="login" class="btn btn-primary mb-4 w-25 m-auto">Log In</button>
        <a href="forgetPassword.php" class="link-primary">Forgot Password?</a>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const form = document.querySelector('form');

      form.addEventListener('submit', (e) => {
        if (!form.checkValidity()) {
          e.preventDefault();
          e.stopPropagation();
        }
        form.classList.add('was-validated');
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
      togglePasswordButton.addEventListener('click', () => {
        togglePasswordVisibility('inputPassword', 'togglePassword');
      });

    });
  </script>
</body>