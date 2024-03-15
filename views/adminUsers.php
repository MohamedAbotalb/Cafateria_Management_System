<?php
require_once "templates/adminNav.php";
require_once "../models/db.php";
require_once "../models/allProducts&usersModel.php";

// Instantiate the DB class
$db = new DB();
$db2 = new allup();
$adminId = 1;
// Fetch all users with room information from the 'user' and 'room' tables using a join
$allUsers = $db2->select1("SELECT u.*, r.ext FROM user u INNER JOIN room r ON u.room_id = r.id WHERE u.id != $adminId");

// Pagination
$rows_per_page = 3;
$page = isset($_GET["page-nr"]) ? $_GET["page-nr"] : 1;
$start = ($page - 1) * $rows_per_page;
// Fetch total number of rows
$total_rows = count($allUsers);
// Calculate total number of pages
$pages = ceil($total_rows / $rows_per_page);
//selected row in one page with limit
$users = $db2->select1("SELECT u.*, r.ext FROM user u INNER JOIN room r ON u.room_id = r.id WHERE u.id != $adminId LIMIT $start, $rows_per_page");
// select1("SELECT p.*, c.name AS category_name FROM product p INNER JOIN category c ON p.category_id = c.id LIMIT $start, $rows_per_page");
?>

<div class="container">
  <div class="row">
    <div class="table-responsive">
      <table class="table table-striped w-75 m-auto my-5 table-hover table-bordered border-secondary">
        <thead>
          <tr class="border-0">
            <th class="border-0" colspan="5">
              <h2>All Users</h2>
            </th>
            <th class="border-0 text-end">
              <a href="./addUser.php" class=" use-btn btn fs-5 rounded p-1">Add User</a>
            </th>
          </tr>
          <tr class='text-center text-white fs-5' style="background-color: #362517;">
            <th>Name</th>
            <th>Email</th>
            <th>Room</th>
            <th>Ext</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class='text-center align-middle'>
          <?php foreach ($users as $user) : ?>
            <tr id="userRow<?= $user['id']; ?>">
              <td><?= $user['name']; ?></td>
              <td><?= $user['email']; ?></td>
              <td><?= $user['room_id']; ?></td>
              <td><?= $user['ext']; ?></td>
              <td><img src='../public/images/<?= $user['image']; ?>' alt='User Image' style='max-width: 50px; max-height: 50px;'></td>
              <td class='text-center'>
                <!-- Buttons for edit and delete actions -->
                <!-- Button trigger modal for edit -->
                <a class="btn justify-content-center align-items-center d-inline-flex rounded-circle fs-5 editborder" data-bs-toggle="modal" data-bs-target="#editModal<?= $user['id']; ?>">
                  <i class='fa-solid fa-user-pen'></i>
                </a>
                <!-- Button trigger modal for delete -->
                <a class='mx-1 btn justify-content-center d-inline-flex align-items-center rounded-circle fs-5 delborder' data-bs-target="#deleteModal<?= $user['id']; ?>" data-bs-toggle="modal">
                  <i class="fa-solid fa-user-xmark"></i>
                </a>


                <!-- Modal delet-->
                <div class="modal fade" id="deleteModal<?= $user['id']; ?>" data-bs-backdrop="static" aria-hidden="true">
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
                        <a href="#" class="btn btn-danger delete" data-user-id="<?= $user['id']; ?>">Yes</a>
                        <button type=" button" class="btn btn-secondary" id="close-modal" data-bs-dismiss="modal">No</button>
                      </div>
                    </div>
                  </div>
                </div>


              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- pagination -->
  <div id="paginationContainer">

    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center ">
        <li class="page-item">
          <a class="page-link" href="?page-nr=1" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <?php for ($i = 1; $i <= $pages; $i++) { ?>
          <li class="page-item"><a class="page-link" href="?page-nr=<?= $i ?>"><?= $i ?></a></li>
        <?php } ?>

        <li class="page-item">
          <a class="page-link " href="?page-nr=<?= $pages ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <!-- end pagination -->
</div>

<!-- Edit Modals -->
<?php foreach ($users as $user) : ?>
  <div class="modal fade" id="editModal<?= $user['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $user['id']; ?>" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel<?= $user['id']; ?>">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form for editing user -->
          <form id="editUserForm<?= $user['id']; ?>" class="needs-validation Form" action="../controllers/updateUserController.php" method="post" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="userId" value="<?= $user['id']; ?>">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name<?= $user['id']; ?>" name="name" placeholder="Enter name" value="<?= $user['name']; ?>" pattern="[A-Za-z][A-Za-z\s]*" title="Enter a valid name" required>
              <div class="invalid-feedback">
                Please provide a valid name.
              </div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email<?= $user['id']; ?>" name="email" placeholder="Enter email" value="<?= $user['email']; ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title=" Please enter a valid email address" required>
              <div class="invalid-feedback">
                Please provide a valid email address.
              </div>
              <!-- Notification email exist -->
              <div id="emailNotification" class="invalid-feedback"></div>
            </div>
            <div class=" mb-3">
              <label for="roomNum" class="form-label">Room Number</label>
              <input type="number" class="form-control" id="roomNum<?= $user['id']; ?>" name="roomNum" placeholder="Enter room number" value="<?= $user['room_id']; ?>" min="1" required>
              <div class="invalid-feedback">
                Please provide a valid room number.
              </div>
              <!-- Notification room exist -->
              <div id="roomNotification" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="ext" class="form-label">Extension</label>
              <input type="number" class="form-control" id="ext<?= $user['id']; ?>" name="ext" placeholder="Enter Ext number" value="<?= $user['ext']; ?>" min="1" required>
              <div class="invalid-feedback">
                Please provide a valid extension number.
              </div>
            </div>
            <div class="mb-3">
              <label for="profilePicture" class="form-label">Profile Picture</label>
              <input type="file" class="form-control" id="profilePicture<?= $user['id']; ?>" name="profilePicture">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn use-btn">Save</button>
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Add this script to handle deletion and update page -->
  <script>
    // Function to handle deletion confirmation
    function confirmDelete(userId) {
      // Prevent the default behavior of the anchor element
      event.preventDefault();

      // Send an AJAX request to delete.php with the provided user ID
      fetch("../controllers/delete.php?id=" + userId, {
          method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
          // console.log(data);
          // Check if deletion was successful0
          if (data.success) {
            // If successful, hide the modal
            $('#deleteModal' + userId).modal('hide');
            // Optionally, you can remove the deleted user from the page immediately
            $('#userRow' + userId).remove();
          } else {
            // If deletion failed, display an error message
            alert(data.error);
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
    $(document).ready(function() {
      $(".delete ").click(function(event) {
        // Extract user ID from the data attribute
        console.log(this);
        var userId = $(this).data("user-id");
        // Call confirmDelete function
        confirmDelete(userId);
      });
    });
  </script>
  <!-- handel edit user form -->
  <script>
    // AJAX form submission
    $("#editUserForm<?= $user['id']; ?>").submit(function(event) {
      event.preventDefault(); // Prevent default form submission
      // Clear existing notifications
      $('#emailNotification').hide();
      $('#roomNotification').hide();
      // console.log(this);
      var formData = new FormData(this);
      $.ajax({
        type: "POST",
        url: "../controllers/updateUserController.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          // Parse JSON response
          var data = JSON.parse(response);
          console.log(data);

          if (data.success) {
            // Display success message
            $('#editModal<?= $user['id']; ?>').modal('hide');
            // Update table row with new user data
            var updatedUser = data.updatedUser[0];
            // Access the first element of the array
            $("tr#userRow<?= $user['id']; ?> td:eq(0)").text(updatedUser.name);
            $("tr#userRow<?= $user['id']; ?> td:eq(1)").text(updatedUser.email);
            $("tr#userRow<?= $user['id']; ?> td:eq(2)").text(updatedUser.room_id);
            $("tr#userRow<?= $user['id']; ?> td:eq(3)").text(updatedUser.ext);
            $("tr#userRow<?= $user['id']; ?> td:eq(4) img").attr("src", "../public/images/" + updatedUser.image);

            // console.log(updatedUser.image);
          } else {
            // Display error message

            if (data.message === "Email already exists. Please choose a different email.") {
              $('#emailNotification').text(data.message).show();
            }
            if (data.message === 'Room not found') {
              $('#roomNotification').text(data.message).show();
            }

            // alert("Error: " + data.error);
          }
        },
        error: function(xhr, status, error) {
          // Handle AJAX errors
          console.error(xhr.responseText);
        }
      });
    });
  </script>
  <!-- ******** -->

<?php endforeach; ?>