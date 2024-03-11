<?php
require_once "templates/adminNav.php";
require_once "../controllers/currentOrdersController.php";

$currentOrders = new CurrentOrdersController();

// Get all current orders
$orders = $currentOrders->getCurrentOrders();

?>

<!-- Orders start -->
<div class="container my-5 py-5">
  <h2 class="mb-5 fs-1">Orders</h2>
  <div>
    <?php if (count($orders) > 0) : ?>
      <?php foreach ($orders as $order) : ?>
        <table class="table table-bordered border-secondary text-center text-capitalize fs-5">
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
            <tr>
              <td> <?php echo $order['order_date'] ?> </td>
              <td> <?php echo $order['username'] ?> </td>
              <td> <?php echo $order['room_num'] ?> </td>
              <td> <?php echo $order['ext'] ?> </td>
              <td>
                <a class="btn button text-decoration-none" href="deliverOrder.php?id=<?php echo $order['order_id'] ?>">deliver</a>
              </td>
            </tr>
            <tr>
              <td colspan="5">
                <div class="row row-cols-sm-2 row-cols-md-5 g-3 fs-5 px-3 ">
                  <?php $products = json_decode($order['products'], true); ?>
                  <?php foreach ($products as $product) : ?>
                    <div class="col mt-4">
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
                  <p>Total: EGP <span><?php echo (int)$order['total_price'] ?></span></p>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      <?php endforeach; ?>
    <?php else : ?>
      <div class="text-center fs-2">
        <p>There is no current orders</p>
      </div>
    <?php endif; ?>

  </div>
</div>
<!-- Orders end -->