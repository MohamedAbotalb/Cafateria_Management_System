<?php
require_once "templates/userNav.php";
require_once "../controllers/myOrdersController.php";

$getStartDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$getEndDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';


$myOrdersController = new MyOrdersController();

$data = $myOrdersController->getOrdersByUserId($getStartDate,$getEndDate,2);
$totalPrice = 0;
$orders = [];

foreach ($data as $row) {
  $orderId = $row['id'];

  if (!isset($orders[$orderId])) {
    $orders[$orderId] = [
      'id' => $row['id'],
      'note' => $row['note'],
      'status' => $row['status'],
      'order_date' => $row['order_date'],
      'room_id' => $row['room_id'],
      'user_id' => $row['user_id'],
      'total_price' => $row['total_price'],
      'products' => [],
    ];
  }

  $data = $myOrdersController->getProductsByOrderId($orderId);
  array_push($orders[$orderId]['products'], $data);
}

?>

<div class="container mt-5">
  <h2>My Orders</h2>
  <!-- Search date -->
  <div class="row">
    <div class="col-md-6" id="errorDateFrom">
      <div class="input-group date " id="datepickerOne">

        <?php
        echo "<input type='text' class='form-control' id='dateFrom' value='{$getStartDate}' />";

        ?>
        <span class="input-group-append">
          <span class="input-group-text h-100 bg-light d-block">
            <i class="fa fa-calendar"></i>
          </span>
        </span>
      </div>
    </div>
    <div class="col-md-6" id="errorDateTo">
      <div class="input-group date" id="datepickerTwo">
        <?php
        echo "<input type='text' class='form-control' id='dateTo' value='{$getEndDate}' />";

        ?>
        <span class="input-group-append">
          <span class="input-group-text h-100 bg-light d-block">
            <i class="fa fa-calendar"></i>
          </span>
        </span>
      </div>
    </div>
  </div>



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

      <?php
      foreach ($orders as $order) {
        ?>

        <div class="accordion-item border-0 p-0 m-0">
          <div class="row">
            <div class="col-3 border border-2 pt-3 d-flex justify-content-between">
              <span>
                <?php echo $order['order_date'] ?> PM
              </span>
              <span id="heading-<?php  echo $order['id'] ?>">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $order['id'] ?>"
                  aria-expanded="true" aria-controls="collapse-<?php echo $order['id'] ?>">
                </button>
              </span>
            </div>
            <div class="col-3 border border-2 pt-3">
              <?php echo $order['status'] ?>
            </div>
            <div class="col-3 border border-2 pt-3">
              <?php echo $order['total_price'] ?> EGP
            </div>
            <div class="col-3 border border-2 py-2 text-center">
              <?php
              if ($order['status'] == 'processing') {

                echo "<a class='btn text-white text-decoration-none' href='deleteOrder.php?id={$order['id']}' style='background-color: #362517;'>CANCEL</a>";
              }
              ?>
            </div>
          </div>
          <div id="collapse-<?php echo $order['id']?>" class="accordion-collapse collapse row border border-2" aria-labelledby="heading-<?php echo $order['id'] ?>"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">

              <div class="row row-cols-sm-2 row-cols-md-5 g-3 fs-5 px-3 text-capitalize">
                <?php

                foreach ($order['products'][0] as $product) {
                  ?>

                  <div class="col mt-4">
                    <div class="w-75 mx-sm-auto position-relative text-center">
                      <img src="../public/images/<?php echo $product['image'] ?>" class="product-image rounded-circle"
                        style="width: 140px; height: 140px" alt="product" />
                      <div class="product-price">
                        <span class="d-flex justify-content-center align-items-center h-100">
                          <?php echo $product['price'] ?> LE
                        </span>
                      </div>
                      <div class="my-4">
                        <p class="product-name">
                          <?php echo $product['name'] ?>
                        </p>
                        <p class="product-quantity">
                          <?php echo $product['quantity'] ?>
                        </p>
                      </div>
                    </div>
                  </div>


                <?php } ?>

              </div>


            </div>
          </div>
        </div>

      <?php } ?>


    </div>
  </div>

  <!--End Table-->






  <div class="row justify-content-center">
    <div class="total-price mt-4 fs-2 d-flex px-5">
      <p style="margin: auto;">Total: <span>
          <?php echo $totalPrice ?>
        </span> EGP </p>
    </div>
  </div>
  <!-- End Table -->

  <script>
    $(function () {
      $('#datepickerOne').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
      });

    });
    $(function () {
      $('#datepickerTwo').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
      });

    });

  </script>