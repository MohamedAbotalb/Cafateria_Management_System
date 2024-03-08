<?php
require_once "templates/adminNav.php"
?>

<div class="container">

    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped w-75 m-auto table-hover table-bordered border-secondary">
                <thead>
                    <tr class="border-0">

                        <th class="border-0" colspan=" 4">
                            <h2>All Users</h2>
                        </th>
                        <th class="border-0 text-end">
                            <button class="add-btn fs-5 rounded p-2">Add User</button>
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
                <tbody class="text-center align-middle" >
                    <tr >
                        <td>naglaa saad</td>
                        <td>2</td>
                        <td><img src='./imgs/' alt='User Image' style='max-width: 50px; max-height: 50px;'></td>
                        <td>3526</td>
                        <td class='text-center'>
                            <!-- Button trigger modal***edit*** -->
                            <a  class="btn d-inline-flex  justify-content-center align-items-center  rounded-circle fs-5  editborder " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class='fa-solid fa-user-pen'></i>
</a>

                            <!--end edit btn -->

                            <!-- Modal -->
                            <div class=" modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- ...our form -->
                                                 <form action="" method="" enctype="multipart/form-data">
            <div class="mb-3 row">
              <label for="name" class="col-sm-3 col-form-label">Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="email" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="password" class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="confirmPassword" class="col-sm-3 col-form-label">Confirm Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="roomNum" class="col-sm-3 col-form-label">Room Number</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="roomNum" name="roomNum">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="ext" class="col-sm-3 col-form-label">Extension</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="ext" name="ext">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="profilePicture" class="col-sm-3 col-form-label">Profile Picture</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <input type="file" class="form-control" id="profilePicture" name="profilePicture">
                </div>
              </div>
            </div>
          </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class='mx-1  btn justify-content-center align-items-center  d-inline-flex rounded-circle fs-5  delborder'data-bs-target="#deleteModal" data-bs-toggle="modal">
                                <i class="fa-solid fa-user-xmark"></i>
                            </a>
                            <!-- Modal -->
<div class="modal fade" id="deleteModal" data-bs-backdrop="static" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close-modal" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger">Yes</button>
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