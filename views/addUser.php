<?php
require_once "templates/adminNav.php";
?>

<div class="container my-5">
  <h1>Add User</h1>
  <form class="my-5 needs-validation" action="#" method="" enctype="multipart/form-data" novalidate>
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" pattern="[^\s].+" title="Name must not start with a space" required>
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
  // Function to validate password and confirm password fields
  function validatePassword() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    if (password != confirmPassword) {
      document.getElementById("confirmPassword").setCustomValidity("Passwords do not match");
    } else {
      document.getElementById("confirmPassword").setCustomValidity('');
    }
  }

  // Add event listener to confirm password field to trigger validation
  document.getElementById("confirmPassword").addEventListener("input", validatePassword);


  // Function to toggle password visibility
  function togglePasswordVisibility(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const passwordIcon = document.getElementById(iconId);

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      passwordIcon.innerHTML = '<i class="far fa-eye-slash"></i>';
    } else {
      passwordInput.type = "password";
      passwordIcon.innerHTML = '<i class="far fa-eye"></i>';
    }
  }

  // Add event listeners to toggle password visibility when the eye icon is clicked
  document.getElementById("togglePassword").addEventListener("click", function() {
    togglePasswordVisibility("password", "togglePassword");
  });

  document.getElementById("toggleConfirmPassword").addEventListener("click", function() {
    togglePasswordVisibility("confirmPassword", "toggleConfirmPassword");
  });
</script>