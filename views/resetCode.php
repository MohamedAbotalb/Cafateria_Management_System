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
        <h3 class="text-center my-3">Password Reset Code</h3>
        <p class="text-center my-3">We have sent your email a 6-digits code, please fill it here</p>
        <div class="mb-3">
          <input type="text" name="resetCode" id="resetCode" class="form-control p-2" aria-describedby="resetCodeHelpInline" pattern="[0-9]{6}" required>
          <div class="invalid-feedback">Please enter a 6-digits code</div>
        </div>
      </div>
      <?php if (isset($errors['resetCode'])) : ?>
        <p class="fs-5 alert alert-danger rounded text-center p-2 mb-4"><?= $errors['resetCode'] ?></p>
      <?php endif; ?>
      <div class="row m-auto text-center">
        <button type="submit" name="validate" class="btn btn-primary mb-3 w-25 m-auto">Send</button><br>
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
    });
  </script>
</body>