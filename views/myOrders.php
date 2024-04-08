<?php
require_once "templates/userNav.php";
require_once "../controllers/orderController.php";

$getStartDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$getEndDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';

$orderController = new OrderController();
$data = $orderController->getOrdersByUserId($getStartDate, $getEndDate, $_SESSION['user']['id']);
$totalPrice = 0;
$orders = [];

foreach ($data as $row) {
  $orderId = $row['id'];
  $totalPrice += $row['total_price'];
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

  $data = $orderController->getProductsByOrderId($orderId);
  array_push($orders[$orderId]['products'], $data);
}

?>

<div class="container mt-5">
  <h2>My Orders</h2>
  <!-- Search date -->
  <div class="row">
    <div class="col-md-6" id="errorDateFrom">
      <div class="input-group date " id="datepickerOne">
        <?php echo "<input type='text' class='form-control' id='dateFrom' value='{$getStartDate}' />"; ?>
        <span class="input-group-append">
          <span class="input-group-text h-100 bg-light d-block">
            <i class="fa fa-calendar"></i>
          </span>
        </span>
      </div>
    </div>
    <div class="col-md-6" id="errorDateTo">
      <div class="input-group date" id="datepickerTwo">
        <?php echo "<input type='text' class='form-control' id='dateTo' value='{$getEndDate}' />"; ?>
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
      <?php foreach ($orders as $order) { ?>
        <div class="accordion-item border-0 p-0 m-0">
          <div class="row">
            <div class="col-3 border border-2 pt-3 d-flex justify-content-between">
              <span>
                <?php echo date("Y/m/d g:i A", strtotime($order['order_date']))  ?>
              </span>
              <span id="heading-<?php echo $order['id'] ?>">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $order['id'] ?>" aria-expanded="true" aria-controls="collapse-<?php echo $order['id'] ?>">
                </button>
              </span>
            </div>
            <div class="col-3 border border-2 pt-3">
              <?php echo $order['status'] ?>
            </div>
            <div class="col-3 border border-2 pt-3">
              <?php echo (int) $order['total_price'] ?> EGP
            </div>
            <div class="col-3 border border-2 py-2 text-center">
              <?php
              if ($order['status'] == 'processing') {
                echo "<button type='button' class='btn text-white text-decoration-none' data-bs-toggle='modal' data-bs-target='#confirmModal_{$order['id']}' style='background-color: #362517;'>CANCEL</button>";
              }
              ?>
            </div>
            <!-- Modal for each order -->
            <div class="modal fade text-capitalize" id="confirmModal_<?= $order['id'] ?>" data-bs-backdrop="static" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancellation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <lla class="fs-5">Confirm order cancellation</lla>
                  </div>
                  <div class="modal-footer">
                    <a class="btn button text-decoration-none" href="../controllers/orderController.php?id=<?= $order['id'] ?>&action=cancel">yes</a>
                    <button type="button" class="btn btn-secondary" id="close-modal" data-bs-dismiss="modal">No</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal end -->
          </div>
          <div id="collapse-<?php echo $order['id'] ?>" class="accordion-collapse collapse row border border-2" aria-labelledby="heading-<?php echo $order['id'] ?>" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <div class="row row-cols-sm-2 row-cols-md-5 g-3 fs-5 px-3 text-capitalize">
                <?php foreach ($order['products'][0] as $product) { ?>
                  <div class="col mt-4">
                    <div class="w-75 mx-sm-auto position-relative text-center">
                      <img src="../public/images/<?php echo $product['image'] ?>" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
                      <div class="product-price" style='width: 50px; height: 50px; left: 70%'>
                        <span class="d-flex justify-content-center align-items-center h-100 fw-bold" style='font-size: 1rem;'>
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
</div>


<div class="row justify-content-center">
  <div class="total-price mt-4 fs-2 d-flex px-5">
    <p style="margin: auto;">Total: <span>
        <?php echo $totalPrice ?>
      </span> EGP </p>
  </div>
</div>
<!-- End Table -->

<script>
  function initializeDatepicker(datepickerId) {
    $(function() {
      $(datepickerId).datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
      });
    });
  }

  initializeDatepicker('#datepickerOne');
  initializeDatepicker('#datepickerTwo');

  const startDate = document.getElementById("dateFrom");
  const endDate = document.getElementById("dateTo");
  const divStartDate = document.getElementById("errorDateFrom");
  const divEndDate = document.getElementById("errorDateTo");
  var messageTag = document.createElement("div");

  startDate.onchange = function(e) {
    if (startDate.value || startDate.value < endDate.value) {
      messageTag.remove();
    }
    if (endDate.value == "") {
      messageError(divEndDate, "Please enter End Date");
      return;
    }
    validate(startDate, endDate);
  };

  endDate.onchange = function(e) {
    if (endDate.value || startDate.value < endDate.value) {
      messageTag.remove();
    }
    if (startDate.value == "") {
      messageError(divStartDate, "Please enter Start Date");

      return;
    }
    validate(startDate, endDate);

  };


  function validate(startDate, endDate) {
    if (startDate.value >= endDate.value) {
      messageError(divEndDate, "Start Date Must Be Smaller Than End Date");
      return;
    }
    if (startDate.value && endDate.value && startDate.value < endDate.value) {
      window.location.assign(
        `${window.location.origin}/Cafateria_Management_System/views/myOrders.php?startDate=${startDate.value}&endDate=${endDate.value}`
      );
    }
  }

  function messageError(place, message) {
    messageTag.textContent = message;
    messageTag.style.cssText = "color:red";
    place.appendChild(messageTag);
  }
</script>