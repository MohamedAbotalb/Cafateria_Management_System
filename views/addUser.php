<?php
require_once "templates/adminNav.php";
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h4 class="mb-0">Add User</h4>
        </div>
        <div class="card-body"> 
          <form action="" method="" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="mb-3 row">
              <label for="name" class="col-sm-3 col-form-label">Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="name" name="name" required pattern="[A-Za-z]+" title="Name must contain only letters">
                <div class="invalid-feedback">Name must contain only letters.</div>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="email" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">Please enter a valid email address.</div>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="password" class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="invalid-feedback">Please enter a password.</div>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="confirmPassword" class="col-sm-3 col-form-label">Confirm Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                <div class="invalid-feedback">Please confirm your password.</div>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="roomNum" class="col-sm-3 col-form-label">Room Number</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" id="roomNum" name="roomNum">
                <div class="invalid-feedback">Room number must be a number.</div>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="ext" class="col-sm-3 col-form-label">Extension</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" id="ext" name="ext">
                <div class="invalid-feedback">Extension must be a number.</div>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="profilePicture" class="col-sm-3 col-form-label">Profile Picture</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <input type="file" class="form-control" id="profilePicture" name="profilePicture">
                  <label class="input-group-text" for="profilePicture">Upload</label>
                </div>
              </div>
            </div>
            <div class="mb-3 row">
              <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn button">Save</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
