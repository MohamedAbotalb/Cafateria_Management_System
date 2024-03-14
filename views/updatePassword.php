<?php
require_once "templates/head.php";
?>

<div class="container my-5">
  <h1 class="text-center">Cafeteria</h1>
  <form action="../controllers/authenticateController.php" method="post" class="col-md-4 m-auto text-bg-light my-5 p-3 rounded shadow-lg bg-body-tertiary" novalidate>
    <div class="row g-3 align-items-center my-3">
      <div class="mb-3">
        <label for="inputPassword" class="col-form-label">Enter New Password</label>
        <div class="input-group">
          <input type="password" name="updatePassword" id="inputPassword" class="form-control" pattern="\S{6,}" aria-describedby="passwordHelpInline" pattern=".{6,}" title="Password must contain at least 3 characters" required>
          <button class="btn btn-outline-secondary" type="button" id="togglePassword">
            <i class="fa fa-eye-slash"></i>
          </button>
          <div class="invalid-feedback">Please enter a valid password with at least 6 characters.</div>
        </div>
      </div>
    </div>
    <div class="mb-3">
      <label for="confirmPassword" class="col-form-label">Confirm New Password</label>
      <div class="input-group">
        <input type="password" id="confirmPassword" class="form-control" aria-describedby="passwordHelpInline" required>
        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
          <i class="fa fa-eye-slash"></i>
        </button>
        <div class="invalid-feedback">Passwords do not match.</div>
      </div>
    </div>
    <div class="row m-auto text-center">
      <div class="col">
        <button type="submit" name="update" class="btn btn-primary">Update</button>
      </div>
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

    // Password confirmation validation
    const password = document.getElementById("inputPassword");
    const confirmPassword = document.getElementById("confirmPassword");
    const confirmPasswordFeedback = document.querySelector("#confirmPassword ~ .invalid-feedback");

    confirmPassword.addEventListener("input", function() {
      if (password.value !== confirmPassword.value) {
        confirmPassword.setCustomValidity("Passwords do not match");
        confirmPasswordFeedback.style.display = "block";
      } else {
        confirmPassword.setCustomValidity("");
        confirmPasswordFeedback.style.display = "none";
      }
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
    const toggleConfirmPasswordButton = document.getElementById('toggleConfirmPassword');
    togglePasswordButton.addEventListener('click', function() {
      togglePasswordVisibility('inputPassword', 'togglePassword');
    });
    toggleConfirmPasswordButton.addEventListener('click', function() {
      togglePasswordVisibility('confirmPassword', 'toggleConfirmPassword');
    });

  });
</script>