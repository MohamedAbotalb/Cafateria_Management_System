<?php
require_once "templates/adminNav.php";
require_once "../models/db.php";
require_once "../models/allProducts&usersModel.php";

// Instantiate the DB class
$db = new DB();
$db2 = new UsersandProducts();
// Fetch all products ()
$allProducts = $db2->select("SELECT* from product");
// $allproducts = $db->select("product");
// Fetch all categories
$categories = $db->select("category");
// var_dump($allProducts);
// Pagination 
$rows_per_page = 6;
$page = isset($_GET["page-nr"]) ? $_GET["page-nr"] : 1;
$start = ($page - 1) * $rows_per_page;
// Fetch total number of rows
$total_rows = count($allProducts);
// Calculate total number of pages
$pages = ceil($total_rows / $rows_per_page);
//selected row in one page with limit
$products = $db2->select("SELECT* from product LIMIT $start, $rows_per_page");
// //Debugging output
// echo "Total Rows: $total_rows<br>";
// echo "Pages: $pages<br>";
// echo "Start: $start<br>";
// var_dump($products);

?>

<div class="container">
  <div class="row">
    <div class="table-responsive">
      <table class="table table-striped w-75 m-auto table-hover table-bordered my-5 border-secondary">
        <!-- Table header -->
        <thead>
          <tr class="border-0">
            <th class="border-0" colspan="4">
              <h2>All Products</h2>
            </th>
            <th class="border-0 text-end">
              <a href="./addProduct.php" class=" use-btn btn fs-5 rounded p-1">Add Product</a>
            </th>
          </tr>
          <tr class='text-center text-white fs-5' style="background-color: #362517;">
            <th>Product</th>
            <th>Price</th>
            <th>Image</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <!-- Table body -->
        <tbody id="productContainer" class="text-center align-middle">
          <?php foreach ($products as $product) : ?>
            <tr id="productRow<?= $product['id']; ?>">
              <td><?= $product['name']; ?></td>
              <td><?= $product['price']; ?></td>
              <!-- <?php
                    // Debug statement: Print out the image URL
                    $imageUrl = '../public/images/' . $product['image'];
                    echo "Image URL: $imageUrl";
                    ?> -->
              <td><img src='../public/images/<?= $product['image']; ?>' alt='Product Image' style='max-width: 50px; max-height: 50px;'></td>
              <!-- change statuse -->

              <td id="status<?= $product['id']; ?>">
                <?php
                $btnClass = ($product['available'] == "available") ? "btn-success" : "btn-danger";
                ?>
                <a class="btn <?= $btnClass; ?> fs-5" onclick="changeStatus(<?= $product['id']; ?>)"><?= ucfirst($product['available']); ?></a>
              </td>
              <!-- actions -->
              <td class='text-center'>
                <!-- Button trigger modal***edit*** -->
                <a class="btn justify-content-center  d-inline-flex align-items-center rounded-circle fs-5  editborder " data-bs-toggle="modal" data-bs-target="#editModal<?= $product['id']; ?>">
                  <i class="fa-regular fa-pen-to-square"></i>
                </a>
                <!-- modal edit -->
                <!-- editModal<?= $product['id']; ?> -->
                <div class="modal fade" id="editModal<?= $product['id']; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" data-bs-backdrop="static">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel"> Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form class="needs-validation Form mb-0" action="../controllers/updateProductController.php" method="post" enctype="multipart/form-data" id="editProductForm<?= $product['id']; ?>" novalidate>
                          <div class="mb-3">
                            <label for="productName" class="form-label">Product</label>
                            <input type="hidden" name="productId" value="<?= $product['id']; ?>">
                            <input type="text" value="<?= $product['name']; ?>" class="form-control" id="productName" name="productName" placeholder="Enter product name" pattern="[A-Za-z][A-Za-z\s]*" title="Product name must start with a letter and not contain numbers" required>
                            <div class="invalid-feedback">
                              Please enter a valid product name.
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" value="<?= $product['price']; ?>" class="form-control" id="productPrice" name="productPrice" placeholder="Enter product price" min="1" max="100" required>
                            <div class="invalid-feedback">
                              Please enter a valid price.
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="productCategory" class="form-label">Category</label>
                            <div class="input-group">
                              <select class="form-select" id="productCategory" name="productCategory" required>
                                <!-- -->
                                <?php foreach ($categories as $category) : ?>
                                  <option value="<?= $category['id']; ?>" <?= ($category['id'] == $product['category_id']) ? 'selected' : ''; ?>>
                                    <?= $category['name']; ?>
                                  </option>
                                <?php endforeach; ?>
                              </select>
                              <!-- trigger add new category -->
                              <button type="button" class="btn use-btn" id="addCategoryBtn" data-bs-target="#addNewCategory<?= $category['id']; ?>" data-bs-toggle="modal" data-bs-dismiss="modal">Add New Category</button>
                              <div class="invalid-feedback">Please select a category.</div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="productImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="productImage" name="productImage">
                            <div class="invalid-feedback">
                              Please upload a product image.
                            </div>
                          </div>
                          <div>
                            <div class=" modal-footer">
                              <button type="submit" class="btn use-btn">Save</button>
                              <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end of modal edit -->
                <!-- modal to add new ctegory -->
                <?php foreach ($categories as $category) : ?>
                  <div class="modal fade" id="addNewCategory<?= $category['id']; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1" data-bs-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalToggleLabel2">Add New Category</h5>
                          <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#editModal<?= $product['id']; ?>" aria-label="Close"></button>
                        </div>
                        <div class="modal-body Form">
                          <div>
                            <form class="mb-0" action="../controllers/insertCategory.php" method="post" id="newCtegoryForm<?= $category['id']; ?>">
                              <label for=" newCategoryName" class="form-label">Category Name</label>
                              <input type="text" class="form-control mb-2" id="newCategoryName" name="newCategoryName" placeholder=" Enter category name">
                              <div class="invalid-feedback ">
                                Enter a valid category name.
                              </div>
                              <div class="invalid-feedback existCategory">

                              </div>
                              <div class="modal-footer pb-0">
                                <button type="submit" data-bs-target="#editModal<?= $product['id']; ?>" class="btn use-btn" id="saveCategory">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editModal<?= $product['id']; ?>">Cancel</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>

                <!-- end to modal to add new ctegory -->

                <a class=' mx-1 btn justify-content-center  d-inline-flex  align-items-center  rounded-circle fs-5  delborder' data-bs-target="#deleteModal<?= $product['id']; ?>" data-bs-toggle="modal">
                  <i class="fa-regular fa-trash-can"></i>
                </a>
                <!-- delete modal -->
                <div class="modal fade" id="deleteModal<?= $product['id']; ?>" data-bs-backdrop="static" aria-hidden="true">
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
                        <a href="#" class="btn btn-danger delete" data-product-id="<?= $product['id']; ?>">Yes</a>
                        <button type=" button" class="btn btn-secondary" id="close-modal" data-bs-dismiss="modal">No</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end to delete modal -->
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



<!-- JavaScript code -->
<script>
  <?php foreach ($products as $product) : ?>

    function updateStatusButton(id, status) {
      var $statusButton = $("#status" + id);
      var $button = $statusButton.find("a");

      var btnClass = (status === "available") ? "btn-success" : "btn-danger";
      $button.removeClass("btn-success btn-danger").addClass(btnClass);
      $button.text(status);
    }

    function changeStatus(id) {
      $.ajax({
        type: "POST",
        url: "../controllers/status.php",
        data: {
          id: id
        },
        success: function(data) {
          updateStatusButton(id, data.trim());
        },
        error: function(xhr, status, error) {
          console.error("AJAX Error: " + error);
        }
      });
    }

    // Call the function to update the status button when the page loads
    updateStatusButton(<?= $product['id']; ?>, "<?= $product['available']; ?>");

    // AJAX form submission for updating product
    $("#editProductForm<?= $product['id']; ?>").submit(function(event) {
      event.preventDefault(); // Prevent default form submission

      let formData = new FormData(this);
      let formIsValid = true; // Flag to track overall form validity

      // Validate product name
      let productNameInput = document.getElementById('productName');
      let productName = productNameInput.value.trim();
      if (!/^[A-Za-z][A-Za-z\s]*$/.test(productName)) {
        productNameInput.classList.add('is-invalid');
        formIsValid = false;
      } else {
        productNameInput.classList.remove('is-invalid');
      }

      // Validate product price
      let productPriceInput = document.getElementById('productPrice');
      let productPrice = parseFloat(productPriceInput.value);
      if (isNaN(productPrice) || productPrice <= 0 || productPrice > 100) {
        productPriceInput.classList.add('is-invalid');
        formIsValid = false;
      } else {
        productPriceInput.classList.remove('is-invalid');
      }

      $.ajax({
        type: "POST",
        url: "../controllers/updateProduct.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          // console.log(response);
          let data = response;
          // console.log(response);
          if (data.success) {
            // console.log(response);
            // Display success message
            $('#editModal<?= $product['id']; ?>').modal('hide');
            //  update the table row with new product data
            let updatedProduct = data.updateProduct[0];
            // console.log(data.updateProduct[0]);
            // let productId = updatedProduct.id;
            $("tr#productRow<?= $product['id']; ?> td:eq(0)").text(updatedProduct.name);
            $("tr#productRow<?= $product['id']; ?> td:eq(1)").text(updatedProduct.price);
            $("tr#productRow<?= $product['id']; ?> td:eq(2) img").attr("src", "../public/images/" + updatedProduct.image);
            // console.log($("tr#productRow<?= $product['id']; ?> td:eq(2) img").attr("src", "../public/images/" + updatedProduct.image));
          } else {
            // Display error message
            alert("Error: " + message);
          }
        },
        error: function(xhr, status, error) {
          // Handle AJAX errors
          console.error(xhr.responseText);
          alert("AJAX Error: " + error);
        }
      });
    });

    // Function to handle deletion confirmation
    function confirmDelete(productId) {
      // Prevent the default behavior of the anchor element
      event.preventDefault();

      // Send an AJAX request to delete.php with the provided user ID
      fetch("../controllers/deleteProduct.php?id=" + productId, {
          method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
          // Check if deletion was successful
          if (data.success) {
            // If successful, hide the modal
            $('#deleteModal' + productId).modal('hide');
            // Optionally, you can remove the deleted user from the page immediately
            $('#productRow' + productId).remove();
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
        let productId = $(this).data("product-id");
        console.log(productId);
        // Call confirmDelete function
        confirmDelete(productId);
      });
    });
  <?php endforeach; ?>

  // Function to handle insert new category

  $("#newCtegoryForm<?= $category['id']; ?>").submit(function(event) {
    event.preventDefault(); // Prevent default form submission
    event.stopPropagation();
    let formData = new FormData(this);
    let errorMessageDiv = $(this).closest('.modal-content').find('.existCategory');

    $.ajax({
      type: "POST",
      url: "../controllers/insertCategory.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        let data = JSON.parse(response);
        // console.log(data);
        if (data.success) {
          // Display success message
          $('#addNewCategory<?= $category['id']; ?>').modal('hide');
          $('#editModal<?= $product['id']; ?>').modal('show');
          //  update the table row with new product data
          let insrtedCategory = data.insertedCategory[0];
          console.log(insrtedCategory.id);
          // Create a new option element
          let newOption = $('<option></option>').attr('value', insrtedCategory.id).text(insrtedCategory.name);
          // Append the new option to the select dropdown
          $('#productCategory').append(newOption);
          console.log(newOption);
          // select the newly added option
          // newOption.prop('selected', true);

        } else {
          // Display error message
          errorMessageDiv.html(data.message).show();
          // alert("Error: " + data.message);
        }
      },
      error: function(xhr, status, error) {
        // Handle AJAX errors
        console.error(xhr.responseText);
        alert("AJAX Error: " + error);
      }
    });
  });
</script>