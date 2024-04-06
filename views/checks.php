<?php
require_once "templates/adminNav.php";
require_once "../models/checksValidation.php";
require_once "../models/db.php";
$db = new DB();


// $checks = new CurrentOrdersController();
$checks = new Checks();
// Get all 
// $orders = $checks->getChecksOrders();

$getStartDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$getEndDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
$getUserId = isset($_GET['user_id']) ? $_GET['user_id'] : '';
?>
<style>
  body {
    height: 100vh;
  }

  .product {
    min-height: 20vh;
  }

  h1 {
    color: #da9f5b;
    font-size: 75px;
    font-family: "Pacifico", cursive;
    font-weight: bold;
  }

  h2,
  .price {
    color: #da9f5b;
    font-family: "Pacifico", cursive;
  }

  .product-quantity {
    border: 2px solid black;
    background-color: #da9f5b;
    margin: 0px 10px;

  }

  a {
    text-decoration: none;
  }

  .data {
    box-shadow: 10px 10px 10px #afacac;
  }
</style>




<div class="container">
  <h1 class="text-center my-3">Checks</h1>
  <form action="" method="post">
    <div class="row">
      <div class="col-md-6" id="errorDateFrom">
        <div class="input-group date" id="datepickerOne">
          <?php
          echo "<input type='text' placeholder='Date From' class='form-control' id='dateFrom' value='{$getStartDate}' />";
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
          echo "<input type='text' placeholder='Date To' class='form-control' id='dateTo' value='{$getEndDate}' />";
          ?>
          <span class="input-group-append">
            <span class="input-group-text h-100 bg-light d-block">
              <i class="fa fa-calendar"></i>
            </span>
          </span>
        </div>
      </div>

      <div class="col-md-6 my-3">
        <select class="form-select mb-3" name="user" id="selectUser">
          <option selected disabled>Select User</option>
          <?php foreach ($users as $user) : ?>
            <option value="<?php echo $user['id']; ?>">
              <?php echo $user['name']; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-12">
        <?php if (isset($error)) { ?>
          <div class="alert alert-danger">
            <?php echo $error; ?>
          </div>
        <?php } ?>
        <?php if (!empty($message)) : ?>
          <div class="alert alert-danger">
            <?php echo $message; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </form>
  <!-- Display list of users and their total amounts -->
  <h2 class="text-center">List of Users and Total Amounts</h2>


  <!-- Table -->
  <div class="container mt-5 text-center" style="background-color: white; ">
    <div class="row text-white" style="background-color: #362517; ">
      <div class="col-6 border border-2 text-center py-2">
        <h4>Name</h4>
      </div>
      <div class="col-6 border border-2 text-center py-2">
        <h4>Total amount</h4>
      </div>

    </div>
    <div id="accordionExample">
      <?php
      $query = $checks->getUsersWithTotalAmount();
      $result = $db->getConnection()->query($query);
      $users = $result->fetchAll(PDO::FETCH_ASSOC); ?>
      <?php foreach ($users as $user) : ?>

        <div class="accordion-item border-0 p-0 m-0">
          <div class="row">
            <div class="col-6 border border-2 pt-3 d-flex justify-content-between">
              <span>
                <?php echo $user['name']; ?>
              </span>
              <span id="heading-<?php echo $user['id'] ?>">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $user['id'] ?>" aria-expanded="true" aria-controls="collapse-<?php echo $user['id'] ?>"></button>
              </span>
            </div>

            <div class="col-6 border border-2 pt-3">
              <?php echo $user['total_amount']; ?> EGP
            </div>

          </div>

        </div>
        <div id="collapse-<?php echo $user['id'] ?>" class="accordion-collapse collapse row border border-2" aria-labelledby="heading-<?php echo $user['id'] ?>" data-bs-parent="#accordionExample2">

          <?php
          $query = $checks->getOrdersByUserId($user['id']);
          $result = $db->getConnection()->query($query);
          $orders = $result->fetchAll(PDO::FETCH_ASSOC); ?>
          <?php foreach ($orders as $order) : ?>
            <div class="row text-white" style="background-color: #362517; ">
              <div class="col-6 border border-2 text-center py-2">
                <h4>Order Date</h4>
              </div>
              <div class="col-6 border border-2 text-center py-2">
                <h4>Amount</h4>
              </div>
            </div>
            <div class="col">
              <div class="row">
                <div class="col-6 border border-2 pt-3 d-flex justify-content-between">
                  <span>
                    <?php echo $order['order_date']; ?>
                  </span>
                  <span id="heading-<?php echo $order['id'] ?>">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $order['id'] ?>" aria-expanded="true" aria-controls="collapse-<?php echo $order['id'] ?>">
                    </button>
                  </span>
                </div>
                <div class="col-6 border border-2 pt-3">
                  <?php echo $order['total_price']; ?> EGP
                  <br>
                </div>
                <div id="collapse-<?php echo $order['id'] ?>" class="accordion-collapse collapse row border " aria-labelledby="heading-<?php echo $order['id'] ?>" data-bs-parent="#accordionExample2">
                  <div class="row row-cols-sm-2 row-cols-md-5 g-3 fs-5 px-3 text-capitalize">

                    <?php
                    $orderId = $order['id'];


                    $query = $checks->getProducts($orderId);
                    $result = $db->getConnection()->query($query);
                    $products = $result->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($products as $product) { ?>

                      <div class="col mt-4">
                        <div class="w-75 mx-sm-auto position-relative text-center">
                          <img src="../public/images/<?php echo $product['image'] ?>" class="product-image rounded-circle" style="width: 140px; height: 140px" alt="product" />
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
          <?php endforeach ?>
        </div>
      <?php endforeach ?>
    </div>

  </div>
  <!--End Table-->



</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.accordion-toggle').forEach(item => {
      item.addEventListener('click', event => {
        const targetId = item.getAttribute('data-target');
        const target = document.querySelector(targetId);
        if (target.classList.contains('collapse')) {
          document.querySelectorAll('.user-accordion').forEach(accordion => {
            if (!accordion.classList.contains('collapse')) {
              accordion.classList.add('collapse');
            }
          });
          target.classList.remove('collapse');
        } else {
          target.classList.add('collapse');
        }
      });
    });

    document.querySelector('form').addEventListener('submit', function(event) {
      event.preventDefault();

      var startDate = document.querySelector('#dateFrom').value;
      var endDate = document.querySelector('#dateTo').value;
      console.log("Searching from", startDate, "to", endDate);

      // Perform the search or submit the form
      this.submit();
    });
  });

  $(function() {
    $('#datepickerOne').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });

  });
  $(function() {
    $('#datepickerTwo').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });

  });
  const startDate = document.getElementById("dateFrom");
  const endDate = document.getElementById("dateTo");
  const divStartDate = document.getElementById("errorDateFrom");
  const divEndDate = document.getElementById("errorDateTo");
  var messageTag = document.createElement("div");

  selectUser.onchange = function(e) {
    if (selectUser.value && startDate.value == "" && endDate.value == "") {
      window.location.assign(
        `http://localhost:8080/Cafateria_Management_System/views/checks.php?user_id=${selectUser.value}`
      );

    } else {
      window.location.assign(
        `http://localhost:8080/Cafateria_Management_System/views/checks.php?startDate=${startDate.value}&endDate=${endDate.value}&user_id=${selectUser.value}`
      );
    }
  };

  startDate.onchange = function(e) {
    if (startDate.value || startDate.value < endDate.value) {
      messageTag.remove();
    }
    if (endDate.value == "") {
      messageTag.textContent = "Please enter End Date";
      messageTag.style.cssText = "color:red";
      divEndDate.appendChild(messageTag);
      return;
    }
    if (startDate.value >= endDate.value) {
      messageTag.textContent = "Start Date Must Be Smaller Than End Date";
      messageTag.style.cssText = "color:red";
      divEndDate.appendChild(messageTag);
      return;
    }
    if (startDate.value && endDate.value && startDate.value < endDate.value) {
      if (selectUser.value != "") {
        window.location.assign(
          `http://localhost:8080/Cafateria_Management_System/views/checks.php?startDate=${startDate.value}&endDate=${endDate.value}&user_id=${selectUser.value}`
        );
      } else {
        window.location.assign(
          `http://localhost:8080/Cafateria_Management_System/views/checks.php?startDate=${startDate.value}&endDate=${endDate.value}`
        );
      }
    }
  };

  endDate.onchange = function(e) {
    if (endDate.value || startDate.value < endDate.value) {
      messageTag.remove();
    }
    if (startDate.value == "") {
      messageTag.textContent = "Please enter Start Date";
      messageTag.style.cssText = "color:red";
      divStartDate.appendChild(messageTag);
      return;
    }
    if (startDate.value >= endDate.value) {
      messageTag.textContent = "Start Date Must Be Smaller Than End Date";
      messageTag.style.cssText = "color:red";
      divEndDate.appendChild(messageTag);
      return;
    }
    if (startDate.value && endDate.value && startDate.value < endDate.value) {
      if (selectUser.value != "") {
        window.location.assign(
          `http://localhost:8080/Cafateria_Management_System/views/checks.php?startDate=${startDate.value}&endDate=${endDate.value}&user_id=${selectUser.value}`
        );
        console.log("true")
      } else {
        window.location.assign(
          `http://localhost:8080/Cafateria_Management_System/views/checks.php?startDate=${startDate.value}&endDate=${endDate.value}`
        );
        console.log("false")

      }

    }
  };
</script>