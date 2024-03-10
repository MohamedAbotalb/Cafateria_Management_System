<?php
require_once "templates/adminNav.php"
?>

<div class="container">
  <div class="row">
    <div class="table-responsive">
      <table class="table table-striped w-75 m-auto my-5 table-hover table-bordered border-secondary">
        <thead>
          <tr class="border-0">
            <th class="border-0" colspan=" 4">
              <h2>All Users</h2>
            </th>
            <th class="border-0 text-end">
              <a href="./addUser.php" class=" use-btn btn fs-5 rounded p-1">Add User</a>
            </th>
          </tr>
          <tr class='text-center text-white fs-5' style="background-color: #362517;">
            <th>Name</th>
            <th>Room</th>
            <th>Image</th>
            <th>Ext</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class='text-center align-middle'>
          <tr>
            <td>naglaa saad</td>
            <td>2</td>
            <td><img src='./imgs/' alt='User Image' style='max-width: 50px; max-height: 50px;'></td>
            <td>3526</td>
            <td class='text-center'>
              <!-- Button trigger modal***edit*** -->
              <a class=" btn justify-content-center align-items-center d-inline-flex rounded-circle fs-5 editborder  " data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class='fa-solid fa-user-pen'></i>
              </a>
              <!--end edit btn -->

              <!-- Modal -->
              <div class=" modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <!-- ...our form -->
                      <form class="needs-validation Form" action="#" method="" enctype="multipart/form-data" novalidate>
                        <div class="mb-3">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" pattern="[A-Za-z][A-Za-z\s]*" title="Enter a valid name" required>
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
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" pattern=".{6,}" required>
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
                        <!-- </form> -->
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn use-btn">Save</button>
                      <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <a class=' mx-1 btn justify-content-center  d-inline-flex  align-items-center  rounded-circle fs-5  delborder' data-bs-target="#deleteModal" data-bs-toggle="modal">
                <i class="fa-solid fa-user-xmark"></i>
              </a>
              <!-- Modal -->
              <div class="modal fade" id="deleteModal" data-bs-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">confirm delete</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to delete?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger">Yes</button>
                      <button type="button" class="btn btn-secondary" id="close-modal" data-bs-dismiss="modal">No</button>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  const togglePassword = document.getElementById("togglePassword");
  const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");

  function showHidePassword(toggler, input) {
    const icon = toggler.querySelector("i");

    if (input.type === "password") {
      input.type = "text";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    } else {
      input.type = "password";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    }
  }

  togglePassword.addEventListener("click", function() {
    const passwordInput = document.getElementById("password");
    showHidePassword(togglePassword, passwordInput);
  });

  toggleConfirmPassword.addEventListener("click", function() {
    const confirmPasswordInput = document.getElementById("confirmPassword");
    showHidePassword(toggleConfirmPassword, confirmPasswordInput);
  });
</script>