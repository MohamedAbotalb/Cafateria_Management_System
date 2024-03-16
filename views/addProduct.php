<?php
require_once "templates/adminNav.php";
require_once "../models/db.php";

$db = new DB();
$categories = $db->select("category", [], [], false);

$errorMessages = isset($_SESSION['fails']) ? $_SESSION['fails'] : [];
$successMessage = isset($_SESSION['done']) ? $_SESSION['done'] : '';

unset($_SESSION['fails']);
unset($_SESSION['done']);
?>

<div class="container my-5 col-md-6">
  <h1 class="mb-1">Add Product</h1>
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
  <form id="addProductForm" class="my-5 needs-validation row" action="../controllers/addProductController.php" method="POST" enctype="multipart/form-data" novalidate>
    <div class="col-md-12">
      <div class="mb-3">
        <label for="productName" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" pattern="^[A-Za-z]{3,}(?:\s[A-Za-z]+)*$" title="Product name must be at least three characters long and must start with a letter" required>
        <div class="invalid-feedback">
          Product name must be at least three characters.
        </div>
      </div>
      <div class="mb-3">
        <label for="productPrice" class="form-label">Price</label>
        <div class="input-group">
          <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter product price" min="1" max="100" required>
          <span class="m-2 fs-5">EGP</span>
          <div class="invalid-feedback">
            Please enter a valid price between 1 and 100.
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="mb-3">
        <label for="productCategory" class="form-label">Category</label>
        <div class="input-group">
          <select class="form-select" id="productCategory" name="productCategory" required>
            <option value="" selected disabled>Select category</option>
            <?php foreach ($categories as $category) : ?>
              <option value="<?= htmlspecialchars($category['name']) ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
          </select>
          <button type="button" class="btn button" id="addCategoryBtn" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add New Category</button>
          <div class="invalid-feedback">Please select a category.</div>
        </div>
      </div>
      <div class="mb-3">
        <label for="productImage" class="form-label">Product Image</label>
        <input type="file" class="form-control" id="productImage" name="productImage" required>
        <div class="invalid-feedback">
          Please upload a product image.
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="mb-3">
        <button type="submit" class="btn button">Save</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
    </div>
  </form>
</div>
<!-- Modal for Adding New Category -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="newCategoryName" class="form-label">Category Name</label>
          <input type="text" class="form-control" id="newCategoryName" placeholder="Enter category name" pattern="^[A-Za-z]+(?:\s[A-Za-z]+)*$" required>
          <div class="invalid-feedback">
            Enter a valid category name.
          </div>
          <div id="categoryError" class="text-danger" style="display: none;"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn button" id="saveCategory">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="../public/js/addProduct.js"></script>
