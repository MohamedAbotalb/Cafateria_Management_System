<?php
require_once "templates/adminNav.php";

$errorMessages = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$successMessage = isset($_SESSION['success']) ? $_SESSION['success'] : '';

unset($_SESSION['errors']);
unset($_SESSION['success']);
?>

<div class="container my-5">
  <h1 class="mb-4">Add User</h1>
  <?php if (!empty($errorMessages)) : ?>
    <div class="alert alert-danger" role="alert">
      <?php foreach ($errorMessages as $error) : ?>
        <p><?= htmlspecialchars($error) ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  <form class="needs-validation" action="../controllers/addUserController.php" method="post" enctype="multipart/form-data" novalidate>
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" pattern="^[A-Za-z]+(?:\s[A-Za-z]+)*$" title="Enter a valid name" required>
      <div class="invalid-feedback">
        Please provide a valid name.
      </div>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Please enter a valid email address" required>
      <div class="invalid-feedback">
        Please provide a valid email address.
      </div>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <div class="input-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" pattern="\S{6,}" required>
        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
          <i class="fa fa-eye-slash"></i>
        </button>
        <div class="invalid-feedback">Please provide a valid password.</div>
      </div>
    </div>
    <div class="mb-3">
      <label for="confirmPassword" class="form-label">Confirm Password</label>
      <div class="input-group">
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" required>
        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
          <i class="fa fa-eye-slash"></i>
        </button>
        <div class="invalid-feedback">
          Passwords do not match.
        </div>
      </div>
    </div>
    <div class="mb-3">
      <label for="roomNum" class="form-label">Room Number</label>
      <input type="number" class="form-control" id="roomNum" name="roomNum" placeholder="Enter room number" min="1" required>
      <div class="invalid-feedback">
        Please provide a valid room number.
      </div>
    </div>
    <div class="mb-3">
      <label for="ext" class="form-label">Extension</label>
      <input type="number" class="form-control" id="ext" name="ext" placeholder="Enter Ext number" min="1" required>
      <div class="invalid-feedback">
        Please provide a valid extension number.
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
  (function() {

    let forms = document.querySelectorAll('.needs-validation');
    // Function to check if a number starts with 0
    function startsWithZero(value) {
      return /^0/.test(value);
    }

    // Function to check the validity of room number and extension number
    function validateRoomAndExtension() {
      let roomNumInput = document.getElementById('roomNum');
      let extInput = document.getElementById('ext');

      if (startsWithZero(roomNumInput.value)) {
        roomNumInput.setCustomValidity('Room number must not start with 0.');
      } else {
        roomNumInput.setCustomValidity('');
      }

      if (startsWithZero(extInput.value)) {
        extInput.setCustomValidity('Extension number must not start with 0.');
      } else {
        extInput.setCustomValidity('');
      }
    }

    // Function to check if password and confirm password match
    function validatePasswordConfirmation() {
      let passwordInput = document.getElementById('password');
      let confirmPasswordInput = document.getElementById('confirmPassword');

      if (passwordInput.value !== confirmPasswordInput.value) {
        confirmPasswordInput.setCustomValidity('Passwords do not match.');
      } else {
        confirmPasswordInput.setCustomValidity('');
      }
    }

    // Function to check if password is at least 6 characters and does not contain spaces
    function validatePasswordLength() {
      let passwordInput = document.getElementById('password');

      if (passwordInput.value.length < 6 || /\s/.test(passwordInput.value)) {
        passwordInput.setCustomValidity('Password must be at least 6 characters long and must not contain spaces.');
      } else {
        passwordInput.setCustomValidity('');
      }
    }
    // Toggle password visibility
    function togglePasswordVisibility(inputId, buttonId) {
      let passwordInput = document.getElementById(inputId);
      let button = document.getElementById(buttonId);
      let type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
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


    Array.prototype.slice.call(forms)
      .forEach(function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }

          form.classList.add('was-validated');
        }, false);

        form.querySelector('button[type="reset"]').addEventListener('click', function() {
          form.classList.remove('was-validated');
        });

        form.querySelector('#roomNum').addEventListener('input', validateRoomAndExtension);
        form.querySelector('#ext').addEventListener('input', validateRoomAndExtension);

        form.querySelector('#confirmPassword').addEventListener('input', validatePasswordConfirmation);

        form.querySelector('#password').addEventListener('input', validatePasswordLength);

        form.querySelector('#togglePassword').addEventListener('click', function() {
          togglePasswordVisibility('password', 'togglePassword');
        });

        form.querySelector('#toggleConfirmPassword').addEventListener('click', function() {
          togglePasswordVisibility('confirmPassword', 'toggleConfirmPassword');
        });
      });
  })();

</script>
