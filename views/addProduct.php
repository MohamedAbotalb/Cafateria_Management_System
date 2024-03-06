<?php
require_once "templates/adminNav.php";
?>

<head>
  <title>Add Product Form</title>
</head>
 <div class="container">
    <h1>Add Product</h1>
    <form>
      <div class="mb-3">
        <label for="productName" class="form-label">Product</label>
        <input type="text" class="form-control" id="productName" placeholder="Enter product name">
      </div>
      <div class="mb-3">
        <label for="productPrice" class="form-label">Price</label>
        <input type="text" class="form-control" id="productPrice" placeholder="Enter product price">
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
        <button type="button" class="btn btn-primary mt-2">Add Category</button>
      </div>
      <div class="mb-3">
        <label for="productImage" class="form-label">Product Image</label>
        <input type="file" class="form-control" id="productImage">
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
    </form>
  </div>
