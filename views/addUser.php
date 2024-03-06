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
          <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group row">
              <label for="name" class="col-sm-3 col-form-label">Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="confirmPassword" class="col-sm-3 col-form-label">Confirm Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="roomNum" class="col-sm-3 col-form-label">Room Number</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="roomNum" name="roomNum">
              </div>
            </div>
            <div class="form-group row">
              <label for="ext" class="col-sm-3 col-form-label">Extension</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="ext" name="ext">
              </div>
            </div>
            <div class="form-group row">
              <label for="profilePicture" class="col-sm-3 col-form-label">Profile Picture</label>
              <div class="col-sm-9">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="profilePicture" name="profilePicture">
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>