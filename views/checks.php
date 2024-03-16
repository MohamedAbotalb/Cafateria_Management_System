<?php
    require_once "templates/adminNav.php";
    require_once "../models/checksValidation.php";
    // $checks = new CurrentOrdersController();

    // Get all 
    // $orders = $checks->getChecksOrders();

    $getStartDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
    $getEndDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
    $getUserId = isset($_GET['user_id'])? $_GET['user_id'] : '';
?>
<style>
    body{
        height: 100vh;
    }
    .product{
        min-height:20vh;
    }
    h1{
        color:#da9f5b;
        font-size:75px;
        font-family: "Pacifico", cursive;
        font-weight:bold;
    }
    h2,.price{
      color:#da9f5b;
      font-family: "Pacifico", cursive;
    }
    .product-quantity{
      border:2px solid black;
      background-color:#da9f5b;
      margin:0px 10px;

    }
    a{
      text-decoration:none;
    }
    .data{
        box-shadow:10px 10px 10px #afacac;
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
              <?php foreach ($users as $user): ?>
                  <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
              <?php endforeach; ?>
          </select>
          </div>
          <div class="col-md-12">
            <?php if (isset($error)) { ?>
              <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
            <?php if (!empty($message)): ?>
                    <div class="alert alert-danger"><?php echo $message; ?></div>
                <?php endif; ?>
          </div>
      </div>
    </form>
    <!-- Display list of users and their total amounts -->
<h2 class="text-center">List of Users and Total Amounts</h2>
<div class="container">
    <table class="table text-center">
        <thead>
            <th>Name</th>
            <th>Total Amount</th>
        </thead>
        <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><a href="?user_id=<?php echo $user['id']; ?>&startDate=<?php echo $getStartDate; ?>&endDate=<?php echo $getEndDate; ?>">
                    <span>+ </span><?php echo $user['name']; ?>
                </a></td>
                <td><?php echo $user['total_amount']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php if (isset($_GET['user_id'])) : ?>
    <!-- Display order details for the selected user -->
    <h2 class="text-center">Order Details</h2>
    <div class="container mx-4">
        <table class="table text-center">
            <thead>
                <th>Order Date</th>
                <th>Amount</th>
            </thead>
            <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><a href="?user_id=<?php echo $user['id']; ?>&startDate=<?php echo $getStartDate; ?>&endDate=<?php echo $getEndDate; ?>">
                        <span>+ </span><?php echo $order['order_date']; ?>
                    </a></td>
                    <td><?php echo $order['total_price']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
    <?php if (!empty($users)): ?> 
    <table class="table text-center table-dark table-striped mt-5">
      <thead>
          <tr>
              <th scope="col">Name</th>
              <th scope="col">Total Amount</th>
          </tr>
      </thead>
      <tbody>
      <?php foreach ($users as $user): ?>
          <tr>
              <th scope="row">
                  <button class="btn btn-dark btn-xs accordion-toggle" data-target="#demo-<?php echo $user['id']; ?>" data-toggle="collapse">+</button>
                  <a href="?user_id=<?php echo $user['id']; ?>&startDate=<?php echo $getStartDate; ?>&endDate=<?php echo $getEndDate; ?>">
                    <?php echo $user['name']; ?>
                  </a>
              </th>
              <td>
                  <?php echo $user['total_amount']; ?>
              </td>
          </tr>

          <tr>
          <td colspan="2">
          <?php //var_dump($orders); ?> 
          <?php if (isset($_GET['user_id']) && count($orders) > 0) : ?>
            <?php foreach ($orders as $order) : ?>
              <div id="demo-<?php echo $user['id']; ?>" class="accordion-body collapse mx-3 user-accordion">
                <table class="table table-striped table-warning text-center m-auto">
                  <thead>
                      <tr>
                          <th>Order Date</th>
                          <th>Amount</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>
                            <button class="btn btn-dark btn-xs accordion-toggle" data-toggle="collapse" data-target="#demo<?php echo $order['order_id']; ?>">+</button>
                            <?php echo date("Y/m/d g:i A", strtotime($order['order_date']))  ?> 
                        </td>
                        <td><?php echo $order['total_price']; ?></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <div id="demo<?php echo $order['order_id']; ?>" class="accordion-body collapse mx-3">
                          <h2 class="text-center">Products</h2>
                            <div class="row row-cols-sm-2 row-cols-md-5 g-3 fs-5 px-3 m-auto">
                                <?php $products = json_decode($order['products'], true); ?>
                                <?php foreach ($products as $product) : ?>
                                  <div class="col">
                                    <div class="w-75 mx-sm-auto position-relative text-center">
                                      <img src="../public/images/<?php echo $product['image'] ?>" class="product-image rounded-circle " style="width: 140px; height: 140px;" alt="product">
                                      <div class="product-price">
                                        <span class="d-flex justify-content-center align-items-center h-100"><?php echo $product['price'] ?> LE</span>
                                      </div>
                                      <div class="my-4">
                                        <p class="product-name"><?php echo $product['name'] ?></p>
                                        <p class="product-quantity"><?php echo $product['quantity'] ?></p>
                                      </div>
                                    </div>
                                  </div>
                                <?php endforeach; ?>
                              </div>
                              <div class="total-price mt-4 fs-2 d-flex flex-row-reverse px-5">
                                <p class="price">Total: EGP <span><?php echo (int)$order['total_price'] ?></span></p>
                              </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            <?php endforeach; ?>
            <?php else : ?>
              <div class="text-center fs-2">
                <p>There is no checks orders</p>
              </div>
            <?php endif; ?>
          </td>
          </tr>
      </tbody>
      <?php endforeach; ?>
    </table>
    <?php else: ?>
        <div class="text-center fs-2">
            <p>No users found</p>
        </div>
    <?php endif; ?>
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
  const startDate = document.getElementById("dateFrom");
  const endDate = document.getElementById("dateTo");
  const divStartDate = document.getElementById("errorDateFrom");
  const divEndDate = document.getElementById("errorDateTo");
  var messageTag = document.createElement("div");
  
  selectUser.onchange = function (e) {
    if (selectUser.value &&  startDate.value=="" && endDate.value=="") {
        window.location.assign(
          `http://localhost:8080/Cafateria_Management_System/views/checks.php?user_id=${selectUser.value}`
        );
    
      }else{
        window.location.assign(
          `http://localhost:8080/Cafateria_Management_System/views/checks.php?startDate=${startDate.value}&endDate=${endDate.value}&user_id=${selectUser.value}`
        );
    }
  };

  startDate.onchange = function (e) {
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
      if(selectUser.value !=""){
        window.location.assign(
        `http://localhost:8080/Cafateria_Management_System/views/checks.php?startDate=${startDate.value}&endDate=${endDate.value}&user_id=${selectUser.value}`
      );
      }else {
        window.location.assign(
        `http://localhost:8080/Cafateria_Management_System/views/checks.php?startDate=${startDate.value}&endDate=${endDate.value}`
      );
      }
    }
  };

  endDate.onchange = function (e) {
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
      if(selectUser.value !=""){
        window.location.assign(
        `http://localhost:8080/Cafateria_Management_System/views/checks.php?startDate=${startDate.value}&endDate=${endDate.value}&user_id=${selectUser.value}`
      );
      console.log("true")
      }else {
        window.location.assign(
        `http://localhost:8080/Cafateria_Management_System/views/checks.php?startDate=${startDate.value}&endDate=${endDate.value}`
      );
      console.log("false")

      }
   
    }
  };
</script>