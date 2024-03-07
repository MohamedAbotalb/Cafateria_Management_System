  <?php
  require_once "templates/adminNav.php";
  ?>


  <div class="container my-5">
    <h1>Add Product</h1>
    <form class="my-5" action="process_form.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="productName" class="form-label">Product</label>
        <input type="text" class="form-control" id="productName" placeholder="Enter product name" pattern="[A-Za-z]+" title="Product name must contain only letters" required>
      </div>
      <div class="mb-3">
        <label for="productPrice" class="form-label">Price</label>
        <input type="number" class="form-control" id="productPrice" placeholder="Enter product price" min="1" max="100" required>
      </div>
      <div class="mb-3">
        <label for="productCategory" class="form-label">Category</label>
        <select class="form-select" id="productCategory">
          <option selected>Select category</option>
          <option value="electronics">Electronics</option>
          <option value="clothing">Clothing</option>
          <option value="home">Home</option>
          <option value="beauty">Beauty</option>
        </select>
        <button type="button" class="btn button mt-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button>
      </div>
      <div class="mb-3">
        <label for="productImage" class="form-label">Product Image</label>
        <input type="file" class="form-control" id="productImage" required>
      </div>
      <div class="mb-3">
        <button type="submit" class="btn button">Save</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
    </form>
  </div>

  <!-- Modal -->
  <div class="modal" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="newCategoryName" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="newCategoryName" placeholder="Enter category name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="saveCategory">Save</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('saveCategory').addEventListener('click', function() {

        var categoryName = document.getElementById('newCategoryName').value;
        var selectElement = document.getElementById('productCategory');
        var newOption = document.createElement('option');
        newOption.textContent = categoryName;
        newOption.value = categoryName.toLowerCase(); 
        selectElement.appendChild(newOption);
        var modal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
        modal.hide();
        document.getElementById('newCategoryName').value = '';

      });
    });
  </script>