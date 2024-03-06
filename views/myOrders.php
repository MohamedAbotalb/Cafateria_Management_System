<?php
require_once "templates/userNav.php";
require_once "templates/head.php";

?>
<style>
      .container {
        margin-top: 50px;
      }
      .product-price {
        background-color: #9d7647;
        color: white;
        font-weight: 500;
      }
      .input-group-text {
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h2>My Orders</h2>
      <!-- Search date -->
      <div class="row">
        <div class="col-md-6">
          <div class="input-group">
            <input
              type="text"
              class="form-control datepicker"
              id="startDate"
              placeholder="From Date"
            />
            <div class="input-group-append">
              <span class="input-group-text"
                ><i class="fa fa-calendar"></i
              ></span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group">
            <input
              type="text"
              class="form-control datepicker"
              id="endDate"
              placeholder="To Date"
            />
            <div class="input-group-append">
              <span class="input-group-text"
                ><i class="fa fa-calendar"></i
              ></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
      $(document).ready(function () {
        $(".datepicker").datepicker({
          format: "yyyy-mm-dd",
          autoclose: true,
        });
      });

      function handleSearch() {
        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();
        console.log("Searching from", startDate, "to", endDate);
        // You can perform your search logic here
      }
    </script>
    <!-- End Search Date -->
    <!-- Table -->
    <div class="container">
      <table class="table table-bordered border-secondary text-center">
        <thead>
          <tr style="background-color: #362517;color:white ">
            <th>Order Date</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr class="text-capitalize fs-5" >
            <td>2024-03-05 08.30 PM</td>
            <td>Processing</td>
            <td>35EGP</td>
            <td>
              <a class="btn text-white text-decoration-none" href="" style="background-color: #362517;">CANCEL</a>
            </td>
          </tr>
          <tr class="text-capitalize fs-5">
            <td>2024-03-05 08.30 PM</td>
            <td>Done</td>
            <td>35EGP</td>
            <td></td>
          </tr>
          <tr>
            <td colspan="5">
              <div
                class="row row-cols-sm-2 row-cols-md-5 g-3 fs-5 px-3 text-capitalize"
              >
                <div class="col mt-4">
                  <div class="w-75 mx-sm-auto position-relative text-center">
                    <img
                      src="../public/images/item1.jpg"
                      class="product-image rounded-circle"
                      style="width: 140px; height: 140px"
                      alt="product"
                    />
                    <div
                      class="product-price rounded-circle position-absolute"
                      style="width: 60px; height: 60px; top: 0; left: 70%"
                    >
                      <span
                        class="d-flex justify-content-center align-items-center h-100"
                        >4 LE</span
                      >
                    </div>
                    <div class="my-4">
                      <p class="product-name">tea</p>
                      <p class="product-quantity">2</p>
                    </div>
                  </div>
                </div>

                <div class="col mt-4">
                  <div class="w-75 mx-sm-auto position-relative text-center">
                    <img
                      src="../public/images/item2.jpg"
                      class="product-image rounded-circle"
                      style="width: 140px; height: 140px"
                      alt="product"
                    />
                    <div
                      class="product-price rounded-circle position-absolute"
                      style="width: 60px; height: 60px; top: 0; left: 70%"
                    >
                      <span
                        class="d-flex justify-content-center align-items-center h-100"
                        >3 LE</span
                      >
                    </div>
                    <div class="my-4">
                      <p class="product-name">cola</p>
                      <p class="product-quantity">3</p>
                    </div>
                  </div>
                </div>

                <div class="col mt-4">
                  <div class="w-75 mx-sm-auto position-relative text-center">
                    <img
                      src="../public/images/item3.jpg"
                      class="product-image rounded-circle"
                      style="width: 140px; height: 140px"
                      alt="product"
                    />
                    <div
                      class="product-price rounded-circle position-absolute"
                      style="width: 60px; height: 60px; top: 0; left: 70%"
                    >
                      <span
                        class="d-flex justify-content-center align-items-center h-100"
                        >6 LE</span
                      >
                    </div>
                    <div class="my-4">
                      <p class="product-name">coffee</p>
                      <p class="product-quantity">2</p>
                    </div>
                  </div>
                </div>

                <div class="col mt-4">
                  <div class="w-75 mx-sm-auto position-relative text-center">
                    <img
                      src="../public/images/item4.jpg"
                      class="product-image rounded-circle"
                      style="width: 140px; height: 140px"
                      alt="product"
                    />
                    <div
                      class="product-price rounded-circle position-absolute"
                      style="width: 60px; height: 60px; top: 0; left: 70%"
                    >
                      <span
                        class="d-flex justify-content-center align-items-center h-100"
                        >8 LE</span
                      >
                    </div>
                    <div class="my-4">
                      <p class="product-name">tea</p>
                      <p class="product-quantity">1</p>
                    </div>
                  </div>
                </div>

                <div class="col mt-4">
                  <div class="w-75 mx-sm-auto position-relative text-center">
                    <img
                      src="../public/images/item5.jpg"
                      class="product-image rounded-circle"
                      style="width: 140px; height: 140px"
                      alt="product"
                    />
                    <div
                      class="product-price rounded-circle position-absolute"
                      style="width: 60px; height: 60px; top: 0; left: 70%"
                    >
                      <span
                        class="d-flex justify-content-center align-items-center h-100"
                        >9 LE</span
                      >
                    </div>
                    <div class="my-4">
                      <p class="product-name">coffee</p>
                      <p class="product-quantity">2</p>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="row justify-content-center">
    <div class="total-price mt-4 fs-2 d-flex px-5">
      <p style="margin: auto;">Total: EGP <span>35</span></p>
    </div>
  </div>
    <!-- End Table -->
  </body>
</html>
