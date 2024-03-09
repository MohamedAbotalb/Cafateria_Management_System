<?php
require_once "templates/userNav.php";
?>

<div class="container mt-5">
  <h2>My Orders</h2>
  <!-- Search date -->
  <div class="row">
    <div class="col-md-6" id="errorDateFrom">
      <div class="input-group date " id="datepickerOne">
        <input type="text" class="form-control" id="dateFrom" />
        <span class="input-group-append">
          <span class="input-group-text h-100 bg-light d-block">
            <i class="fa fa-calendar"></i>
          </span>
        </span>
      </div>
    </div>
    <div class="col-md-6" id="errorDateTo">
      <div class="input-group date" id="datepickerTwo">
        <input type="text" class="form-control" id="dateTo" />
        <span class="input-group-append">
          <span class="input-group-text h-100 bg-light d-block">
            <i class="fa fa-calendar"></i>
          </span>
        </span>
      </div>
    </div>
  </div>
  <!-- end search -->
  <!-- Table -->

  <div class="container mt-5 text-center">
    <div class="row text-white" style="background-color: #362517; ">
      <div class="col-3 border border-2 text-center py-2">
        <h4>Order Date</h4>
      </div>
      <div class="col-3 border border-2 text-center py-2">
        <h4>Status</h4>
      </div>
      <div class="col-3 border border-2 text-center py-2">
        <h4>Amount</h4>
      </div>
      <div class="col-3 border border-2 text-center py-2">
        <h4>Action</h4>
      </div>
    </div>

    <div id="accordionExample">
      <div class="accordion-item border-0 p-0 m-0">
        <div class="row">
          <div class="col-3 border border-2 pt-3 d-flex justify-content-between">
            <span>2024-03-05 08.30 PM</span>
            <span id="headingOne">
              <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              </button>
            </span>
          </div>
          <div class="col-3 border border-2 pt-3">Processing</div>
          <div class="col-3 border border-2 pt-3">35 EGP</div>
          <div class="col-3 border border-2 py-2 text-center">
            <a class="btn text-white text-decoration-none" href="" style="background-color: #362517; ">CANCEL</a>
          </div>
        </div>
        <div id="collapseOne" class="accordion-collapse collapse row border border-2" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="row row-cols-sm-2 row-cols-md-5 g-3 fs-5 px-3 text-capitalize">
              <div class="col mt-4">
                <div class="w-75 mx-sm-auto position-relative text-center">
                  <img src="../public/images/item1.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
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
                  <img src="../public/images/item2.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
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
                  <img src="../public/images/item3.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
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
                  <img src="../public/images/item4.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
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
                  <img src="../public/images/item5.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
                    <span class="d-flex justify-content-center align-items-center h-100">9 LE</span>
                  </div>
                  <div class="my-4">
                    <p class="product-name">coffee</p>
                    <p class="product-quantity">2</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="accordion-item border-0 p-0 m-0">
        <div class="row">
          <div class="col-3 border border-2 pt-3 d-flex justify-content-between">
            <span>2024-03-05 08.30 PM</span>
            <span id="headingTwo">
              <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              </button>
            </span>
          </div>
          <div class="col-3 border border-2 pt-3">Processing</div>
          <div class="col-3 border border-2 pt-3">35 EGP</div>
          <div class="col-3 border border-2 py-2 text-center">
            <a class="btn text-white text-decoration-none" href="" style="background-color: #362517;">CANCEL</a>
          </div>
        </div>
        <div id="collapseTwo" class="accordion-collapse collapse row border border-2" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="row row-cols-sm-2 row-cols-md-5 g-3 fs-5 px-3 text-capitalize">
              <div class="col mt-4">
                <div class="w-75 mx-sm-auto position-relative text-center">
                  <img src="../public/images/item1.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
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
                  <img src="../public/images/item2.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
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
                  <img src="../public/images/item3.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
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
                  <img src="../public/images/item4.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
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
                  <img src="../public/images/item5.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
                    <span class="d-flex justify-content-center align-items-center h-100">9 LE</span>
                  </div>
                  <div class="my-4">
                    <p class="product-name">coffee</p>
                    <p class="product-quantity">2</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="accordion-item border-0 p-0 m-0">
        <div class="row">
          <div class="col-3 border border-2 pt-3 d-flex justify-content-between">
            <span>2024-03-05 08.30 PM</span>
            <span id="headingThree">
              <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
              </button>
            </span>
          </div>
          <div class="col-3 border border-2 pt-3">Processing</div>
          <div class="col-3 border border-2 pt-3">35 EGP</div>
          <div class="col-3 border border-2 py-2 text-center">
            <a class="btn text-white text-decoration-none" href="" style="background-color: #362517; ">CANCEL</a>
          </div>
        </div>
        <div id="collapseThree" class="accordion-collapse collapse row border border-2" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="row row-cols-sm-2 row-cols-md-5 g-3 fs-5 px-3 text-capitalize">
              <div class="col mt-4">
                <div class="w-75 mx-sm-auto position-relative text-center">
                  <img src="../public/images/item1.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
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
                  <img src="../public/images/item2.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
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
                  <img src="../public/images/item3.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
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
                  <img src="../public/images/item4.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
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
                  <img src="../public/images/item5.jpg" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                  <div class="product-price">
                    <span class="d-flex justify-content-center align-items-center h-100">9 LE</span>
                  </div>
                  <div class="my-4">
                    <p class="product-name">coffee</p>
                    <p class="product-quantity">2</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--End Table-->
  <div class="row justify-content-center">
    <div class="total-price mt-4 fs-2 d-flex px-5">
      <p style="margin: auto;">Total: EGP <span>35</span></p>
    </div>
  </div>
  <!-- End Table -->

  <script>
    $(function() {
      $("#datepickerOne").datepicker();

    });
    $(function() {
      $("#datepickerTwo").datepicker();
    });
  </script>