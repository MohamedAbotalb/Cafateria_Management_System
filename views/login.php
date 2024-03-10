<?php
require_once "templates/head.php";
?>

<div class="container my-5">
  <h1 class="text-center">Cafeteria</h1>
  <form action="#" method="" class="w-50 m-auto text-bg-light my-5 p-3 rounded shadow-lg bg-body-tertiary" novalidate>
    <div class="row g-3 align-items-center my-3">
      <div class="mb-3">
        <label for="inputEmail" class="col-form-label d-block">Email</label>
        <input type="email" id="inputEmail" class="form-control" aria-describedby="emailHelpInline" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
        <div class="invalid-feedback">Please enter a valid email.</div>
      </div>
    </div>
    <div class="row g-3 align-items-center mb-3">
      <div class="mb-3">
        <label for="inputPassword" class="col-form-label">Password</label>
        <div class="input-group">
          <input type="password" id="inputPassword" class="form-control" pattern="\S{6,}" aria-describedby="passwordHelpInline" required>
          <button class="btn btn-outline-secondary" type="button" id="togglePassword">
            <i class="fa fa-eye-slash"></i>
          </button>
          <div class="invalid-feedback">Please enter a valid password.</div>
        </div>
      </div>
    </div>
    <div class="row m-auto text-center">
      <button type="submit" class="btn btn-primary mb-3 w-25 m-auto">Log In</button><br>
    </div>
    <div class="row m-auto text-center">
      <a href="./confirmPass.php" class="link-primary">Forgot Password?</a>
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