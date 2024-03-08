<?php
require_once "templates/adminNav.php";
?>

<div class="container my-5">
  <h1>Add User</h1>
  <form class="my-5 needs-validation" action="#" method="" enctype="multipart/form-data" novalidate>
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" pattern="[A-Za-z][A-Za-z\s]*" title="Name must start with a letter and can contain only letters and spaces" required>
      <div class="invalid-feedback">
        Please enter a valid name.
      </div>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Please enter a valid email address" required>
      <div class="invalid-feedback">
        Please enter a valid email address.
      </div>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <div class="input-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
        <span class="input-group-text" id="togglePassword">
          <i class="far fa-eye"></i>
        </span>
      </div>
    </div>
    <div class="mb-3">
      <label for="confirmPassword" class="form-label">Confirm Password</label>
      <div class="input-group">
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" required>
        <span class="input-group-text" id="toggleConfirmPassword">
          <i class="far fa-eye"></i>
        </span>
      </div>
      <div class="invalid-feedback">
        Passwords do not match.
      </div>
    </div>
    <div class="mb-3">
      <label for="roomNum" class="form-label">Room Number</label>
      <input type="number" class="form-control" id="roomNum" name="roomNum" placeholder="Enter room number" min="1" required>
      <div class="invalid-feedback">
        Please enter a valid room number.
      </div>
    </div>
    <div class="mb-3">
      <label for="ext" class="form-label">Extension</label>
      <input type="number" class="form-control" id="ext" name="ext" placeholder="Enter Ext number" min="1" required>
      <div class="invalid-feedback">
        Please enter a valid extension number.
      </div>
    </div>
    <div class="mb-3">
      <label for="profilePicture" class="form-label">Profile Picture</label>
      <input type="file" class="form-control" id="profilePicture" name="profilePicture">
    </div>
    <div class="mb-3">
      <button type="submit" class="btn button">Save</button>
      <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
  </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.needs-validation');

    forms.forEach(function(form) {
      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add('was-validated');
      }, false);

      const resetBtn = form.querySelector('[type="reset"]');
      if (resetBtn) {
        resetBtn.addEventListener('click', function() {
          form.classList.remove('was-validated');
          const invalidFeedbacks = form.querySelectorAll('.invalid-feedback');
          invalidFeedbacks.forEach(function(feedback) {
            feedback.style.display = 'none';
          });
        });
      }
    });

    // Password confirmation validation
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    const confirmPasswordFeedback = document.querySelector("#confirmPassword ~ .invalid-feedback");

    confirmPassword.addEventListener("input", function () {
      if (password.value !== confirmPassword.value) {
        confirmPassword.setCustomValidity("Passwords do not match");
        confirmPasswordFeedback.style.display = "block";
      } else {
        confirmPassword.setCustomValidity("");
        confirmPasswordFeedback.style.display = "none";
      }
    });

    // Toggle password visibility
    const togglePassword = document.getElementById("togglePassword");
    const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");

    togglePassword.addEventListener("click", function () {
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      this.querySelector("i").classList.toggle("fa-eye-slash");
    });

    toggleConfirmPassword.addEventListener("click", function () {
      const type = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
      confirmPassword.setAttribute("type", type);
      this.querySelector("i").classList.toggle("fa-eye-slash");
    });
  });
</script>
