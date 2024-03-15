<?php
require_once "templates/adminNav.php"
?>

<div class="container">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped w-75 m-auto table-hover table-bordered my-5 border-secondary">
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
                <tbody class="text-center align-middle ">
                    <tr>
                        <td>tea</td>
                        <td>20</td>
                        <td><img src='./imgs/' alt='User Image' style='max-width: 50px; max-height: 50px;'></td>
                        <td><a class=" btn btn-success fs-5 ">
                                Available
                            </a>
                        </td>
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
                                            <form class="needs-validation Form mb-0" action="#" method="post" enctype="multipart/form-data" novalidate>
                                                <div class="mb-3">
                                                    <label for="productName" class="form-label">Product</label>
                                                    <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" pattern="[A-Za-z][A-Za-z\s]*" title="Product name must start with a letter and not contain numbers" required>
                                                    <div class="invalid-feedback">
                                                        Please enter a valid product name.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="productPrice" class="form-label">Price</label>
                                                    <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter product price" min="1" max="100" required>
                                                    <div class="invalid-feedback">
                                                        Please enter a valid price.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="productCategory" class="form-label">Category</label>
                                                    <div class="input-group">
                                                        <select class="form-select" id="productCategory" name="productCategory" required>
                                                            <?php foreach ($categories as $category) : ?>
                                                                <option value="<?= $category['id']; ?>" <?= ($category['id'] == $product['category_id']) ? 'selected' : ''; ?>>
                                                                    <?= $category['name']; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <!-- trigger add new category -->
                                                        <button type="button" class="btn use-btn" id="addCategoryBtn" data-bs-target="#addNewCategory<?= $product['id']; ?>" data-bs-toggle="modal" data-bs-dismiss="modal">Add New Category</button>
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
                                                <div>
                                                    <div class=" modal-footer">
                                                        <button type="submit" class="btn use-btn">Save</button>
                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end of modal edit -->
                            <!-- modal to add new ctegory -->
                            <div class="modal fade" id="addNewCategory<?= $product['id']; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalToggleLabel2">Add New Category</h5>
                                            <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#editModal<?= $product['id']; ?>" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body Form">
                                            <div class="mb-3">
                                                <label for="newCategoryName" class="form-label">Category Name</label>
                                                <input type="text" class="form-control" id="newCategoryName" placeholder="Enter category name" required>
                                                <div class="invalid-feedback">
                                                    Enter a valid category name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn use-btn" id="saveCategory">Save</button>
                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editModal<?= $product['id']; ?>">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end to modal to add new ctegory -->

                            <a class=' mx-1 btn justify-content-center  d-inline-flex  align-items-center  rounded-circle fs-5  delborder' data-bs-target="#deleteModal<?= $product['id']; ?>" data-bs-toggle="modal">
                                <i class="fa-regular fa-trash-can"></i>
                            </a>
                            <!-- delete Modal -->
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
                                            <button type="button" class="btn btn-danger">Yes</button>
                                            <button type="button" class="btn btn-secondary" id="close-modal" data-bs-dismiss="modal">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end to delete modal -->
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.getElementById('saveCategory').addEventListener('click', function() {
        const categoryNameInput = document.getElementById('newCategoryName');
        const categoryName = categoryNameInput.value.trim();

        if (!/^[A-Za-z][A-Za-z\s]*$/.test(categoryName)) {
            categoryNameInput.classList.add('is-invalid');
        } else {
            categoryNameInput.classList.remove('is-invalid');
        }
    });

    // Custom validation for the product price to ensure it doesn't start with 0
    document.getElementById('productPrice').addEventListener('input', function() {
        const productPriceInput = this;
        const productPriceValue = productPriceInput.value;

        if (/^0/.test(productPriceValue) || productPriceValue < 1 || productPriceValue > 100) {
            productPriceInput.setCustomValidity('Please enter a valid price between 1 and 100 without starting with 0.');
            productPriceInput.classList.add('is-invalid');
        } else {
            productPriceInput.setCustomValidity('');
            productPriceInput.classList.remove('is-invalid');
        }
    });
</script>