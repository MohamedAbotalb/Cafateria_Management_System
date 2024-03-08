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
                            <button class="add-btn fs-5 rounded p-2">Add Product</button>
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
                    <tr >
                        <td>tea</td>
                        <td>20</td>
                        <td><img src='./imgs/' alt='User Image' style='max-width: 50px; max-height: 50px;'></td>
                        <td><a  class=" btn btn-success fs-5 " >
                               Available
</a>
</td>
                        <td class='text-center'>
                            <!-- Button trigger modal***edit*** -->
                            <a  class=" btn justify-content-center  d-inline-flex align-items-center rounded-circle fs-5  editborder " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-regular fa-pen-to-square"></i>
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
                                            <!-- ...add product -->
                                            <form class="my-5" action="" method="" enctype="multipart/form-data">
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
   
  </form>
                                            <!--  -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class=' mx-1 btn justify-content-center  d-inline-flex  align-items-center  rounded-circle fs-5  delborder'data-bs-target="#deleteModal" data-bs-toggle="modal">
                                <i class="fa-regular fa-trash-can"></i>
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

                            <!-- <button class=' mx-1 fs-5 rounded btn btn-success'>
                                Available
                            </button> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>