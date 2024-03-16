<?php
require_once "templates/adminNav.php";

$errorMessages = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$successMessage = isset($_SESSION['success']) ? $_SESSION['success'] : '';

unset($_SESSION['errors']);
unset($_SESSION['success']);
?>

<div class="container my-4 col-md-6">
  <h1 class="mb-1">Add User</h1>
  <?php if (!empty($errorMessages)) : ?>
    <div class="fs-5 alert alert-danger rounded text-center p-2 mb-4" role="alert">
      <?php foreach ($errorMessages as $error) : ?>
        <p><?= htmlspecialchars($error) ?></p>
      <?php endforeach; ?>
    </div>  
  <?php endif; ?>
  <?php if ($successMessage) : ?>
    <div class="fs-5 alert alert-success rounded text-center p-2 mb-4" role="alert">
      <?= htmlspecialchars($successMessage) ?>
    </div>
  <?php endif; ?>
  <form class="my-4 needs-validation row" action="../controllers/addUserController.php" method="post" enctype="multipart/form-data" novalidate>
    <div class="row">
      <div class="col-md-12">
        <div class="mb-3">
          <label for="name" class="form-label h6">Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" pattern="^[A-Za-z]+(?:\s[A-Za-z]+)*$" title="Enter a valid name" required>
          <div class="invalid-feedback">
            Please provide a valid name.
          </div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label h6">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Please enter a valid email address" required>
          <div class="invalid-feedback">
            Please provide a valid email address.
          </div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label h6">Password</label>
          <div class="input-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" pattern="\S{6,}" required>
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
              <i class="fa fa-eye-slash"></i>
            </button>
            <div class="invalid-feedback">Please provide a valid password.</div>
          </div>
        </div>
        <div class="mb-3">
          <label for="confirmPassword" class="form-label h6">Confirm Password</label>
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
      </div>
      <div class="col-md-12">
        <div class="mb-3">
          <label for="roomNum" class="form-label h6">Room Number</label>
          <input type="number" class="form-control" id="roomNum" name="roomNum" placeholder="Enter room number" min="1" max="50" required>
          <div class="invalid-feedback">
            Please provide a valid room number.
          </div>
        </div>
        <div class="mb-3">
          <label for="ext" class="form-label h6">Extension</label>
          <input type="number" class="form-control" id="ext" name="ext" placeholder="Enter Ext number" min="1" max="50" required>
          <div class="invalid-feedback">
            Please provide a valid extension number.
          </div>
        </div>
        <div class="mb-3">
          <label for="profilePicture" class="form-label h6">Profile Picture</label>
          <input type="file" class="form-control" id="profilePicture" name="profilePicture">
        </div>
      </div>
    </div>
    <div class="mb-3">
      <button type="submit" class="btn button">Save</button>
      <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
  </form>
</div>
<script src="../public/js/addUser.js"></script>
