<?php
include "templates/adminNav.php"
?>

<!-- Orders start -->
<div class="container my-5 py-5">
  <h2 class="mb-5 fs-1">Orders</h2>
  <div>
    <table class="table table-bordered border-secondary text-center">
      <thead>
        <tr>
          <th>Order Date</th>
          <th>Name</th>
          <th>Room</th>
          <th>Ext</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr class="text-capitalize fs-5">
          <td>2024-03-05 08.30 PM</td>
          <td>mohamed abotalb</td>
          <td>2026</td>
          <td>2345</td>
          <td>
            <a class="btn btn-primary text-decoration-none" href="">deliver</a>
          </td>
        </tr>
        <tr>
          <td colspan="5">
            <div class="row row-cols-sm-2 row-cols-md-5 g-3 fs-5 px-3 text-capitalize">

              <div class="col mt-4">
                <div class="w-75 mx-sm-auto position-relative text-center">
                  <img src="../public/images/item1.jpg" class="product-image rounded-circle " style="width: 140px; height: 140px;" alt="product">
                  <div class="product-price rounded-circle position-absolute" style="width: 60px; height: 60px; top: 0; left: 70%;">
                    <span class="d-flex justify-content-center align-items-center h-100">4 LE</span>
                  </div>
                  <div class="my-4">
                    <p class="product-name">tea</p>
                    <p class="product-quantity">2</p>
                  </div>
                </div>
              </div>

              <div class="col mt-4">
                <div class="w-75 mx-sm-auto position-relative text-center">
                  <img src="../public/images/item2.jpg" class="product-image rounded-circle " style="width: 140px; height: 140px;" alt="product">
                  <div class="product-price rounded-circle position-absolute" style="width: 60px; height: 60px; top: 0; left: 70%;">
                    <span class="d-flex justify-content-center align-items-center h-100">3 LE</span>
                  </div>
                  <div class="my-4">
                    <p class="product-name">cola</p>
                    <p class="product-quantity">3</p>
                  </div>
                </div>
              </div>

              <div class="col mt-4">
                <div class="w-75 mx-sm-auto position-relative text-center">
                  <img src="../public/images/item3.jpg" class="product-image rounded-circle " style="width: 140px; height: 140px;" alt="product">
                  <div class="product-price rounded-circle position-absolute" style="width: 60px; height: 60px; top: 0; left: 70%;">
                    <span class="d-flex justify-content-center align-items-center h-100">6 LE</span>
                  </div>
                  <div class="my-4">
                    <p class="product-name">coffee</p>
                    <p class="product-quantity">2</p>
                  </div>
                </div>
              </div>

              <div class="col mt-4">
                <div class="w-75 mx-sm-auto position-relative text-center">
                  <img src="../public/images/item4.jpg" class="product-image rounded-circle " style="width: 140px; height: 140px;" alt="product">
                  <div class="product-price rounded-circle position-absolute" style="width: 60px; height: 60px; top: 0; left: 70%;">
                    <span class="d-flex justify-content-center align-items-center h-100">8 LE</span>
                  </div>
                  <div class="my-4">
                    <p class="product-name">tea</p>
                    <p class="product-quantity">1</p>
                  </div>
                </div>
              </div>

              <div class="col mt-4">
                <div class="w-75 mx-sm-auto position-relative text-center">
                  <img src="../public/images/item5.jpg" class="product-image rounded-circle " style="width: 140px; height: 140px;" alt="product">
                  <div class="product-price rounded-circle position-absolute" style="width: 60px; height: 60px; top: 0; left: 70%;">
                    <span class="d-flex justify-content-center align-items-center h-100">9 LE</span>
                  </div>
                  <div class="my-4">
                    <p class="product-name">coffee</p>
                    <p class="product-quantity">2</p>
                  </div>
                </div>
              </div>

            </div>
            <div class="total-price mt-4 fs-2 d-flex flex-row-reverse px-5">
              <p>Total: EGP <span>35</span></p>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<!-- Orders end -->
