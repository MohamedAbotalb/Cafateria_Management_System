<?php
require_once "templates/adminNav.php";
require_once "../models/db.php";

$db = DB::getInstance();
?>

<!-- start of search -->
<div class="container mt-3">
  <div class="row">
    <div class="col-9"></div>
    <div class="col-3">
      <div class="input-group mb-1">
        <div class="input-group mb-3 border rounded">
          <span class="input-group-text bg-transparent border-0"><i class="fas fa-search"></i></span>
          <input id="searchInput" type="text" name="product" class="form-control border-0" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
        </div>
      </div>
    </div>

  </div>
</div>
<!-- end of search -->

<!-- start of menu -->
<div class="container-fluid mt-1">
  <div class="container">
    <div class="row">
      <!-- start of order -->
      <div class="col-5">
        <div class="card">
          <div class="card-body">
            <!-- start of product order -->
            <div class="list"></div>
            <!-- end of product order -->
            <form action="../controllers/orderController.php" method="post" class="order-details">
              <input type="hidden" name="sourcePage" value="admin">
              <div class="form-floating my-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="note"></textarea>
                <label for="floatingTextarea">Notes</label>
              </div>
              <select class="form-select " aria-label="Default select example" name='room'>
                <option selected disabled>Select Room</option>
                <?php
                $rooms = $db->select("room");
                foreach ($rooms as $room) {
                  if ($room['id'] != 0) {
                    echo "<option value='{$room['id']}' >{$room['id']}</option>";
                  }
                }
                ?>
              </select>
              <input type="hidden" name="productDetails" class="productDetails">
              <input type="hidden" name="invoicePrice" class="invoicePriceInput">

              <hr class="my-4" />
              <p class="fs-4">EGP <span class="invoice-price">0</span></p>
              <?php
              if (isset($_SESSION['order_added']) && $_SESSION['order_added']) {
                echo '<div class="alert alert-success successAlert">Order Added Successfully</div>';
                $_SESSION['order_added'] = false;
              }
              ?>
              <input type="submit" class="btn button" value="confirm" disabled />
            </form>
          </div>
        </div>
      </div>
      <!-- end of order -->
      <!-- start of menu -->
      <div class="col-7 text-capitalize">
        <h5 class="text-muted "> Add to user</h5>
        <div class="selectOptionUser">
          <select class="form-select w-50 mt-5 mb-2 userSelect" aria-label="Default select example">
            <option selected disabled>Select user</option>
            <?php
            $users = $db->select("user", ["role"], ["user"]);
            foreach ($users as $user) {
              echo "<option value='{$user['id']}' class='text-capitalize'>{$user['name']}</option>";
            }
            ?>
          </select>
        </div>
        <hr class="my-5" />
        <div class="section-title">
          <p class="display-5">Menu</p>
        </div>
        <div id="product-card" class="d-flex flex-wrap">
          <?php
          $products = $db->select("product", ["available"], ["available"]);
          foreach ($products as $product) {
            echo "<div class='card m-3 product' style='width: 9rem'>
                <img src='../public/images/{$product['image']}' class='card-img-top' alt='...' />
                <h6 class='menu-price' style='width: 50px; height: 50px; left: 80%'><span class='productPrice '>{$product['price']}</span>LE</h6>
                <div class='card-body'>
                    <p class='card-text'>
                        {$product['name']}
                        <input type='hidden' class='productId' value='{$product['id']}'>

                    </p>
                </div>
            </div>";
          }
          ?>
        </div>
        <!-- end of menu -->
      </div>
    </div>
  </div>

  <script>
    const searchInput = document.getElementById("searchInput");
    const card = document.getElementById("product-card")

    searchInput.addEventListener('keyup', function(e) {
      e.preventDefault();

      const productName = e.target.value.trim();
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          showProduct(this.responseText);
        }
      };
      xmlhttp.open("GET", "../controllers/searchProductController.php?p=" + productName, true);
      xmlhttp.send();
    });

    function showProduct(products) {
      const productsArray = JSON.parse(products);
      card.innerHTML = "";
      if (Array.isArray(productsArray) && productsArray.length > 0) {
        productsArray.forEach(product => {
          card.innerHTML += `
        <div class='card m-3 product' style='width: 9rem'>
          <img src='../public/images/${product.image}' class='card-img-top' alt='...' />
          <h6 class='menu-price' style='width: 50px; height: 50px; left: 80%'><span class='productPrice '>${product.price}</span>LE</h6>
          <div class='card-body'>
            <p class='card-text'>
              ${product.name}
              <input type='hidden' class='productId' value='${product.id}'>
            </p>
          </div>
        </div>`;
        });
      } else {
        card.innerHTML = "<p>No products found.</p>";
      }
    }
  </script>