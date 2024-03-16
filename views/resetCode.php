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

<div class="container my-5">
  <h1 class="text-center">Cafeteria</h1>
  <form action="../controllers/authenticateController.php" method="post" class="col-md-4 m-auto text-bg-light my-5 p-3 rounded shadow-lg bg-body-tertiary" novalidate>
    <div class="row g-3 align-items-center my-3">
      <h3 class="text-center my-3">Password Reset Code</h3>
      <p class="text-center my-3">We have sent your email a 6-digits code, please fill it here</p>
      <div class="mb-3">
        <input type="text" name="resetCode" id="resetCode" class="form-control" aria-describedby="resetCodeHelpInline" pattern="[0-9]{6}" required>
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
  });
</script>