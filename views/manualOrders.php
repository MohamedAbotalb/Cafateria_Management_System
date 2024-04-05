<?php
require_once "templates/adminNav.php";
require_once "../controllers/orderController.php";

$orderController = new OrderController();

// Get all current orders
$orders = $orderController->getCurrentOrders();

?>

<!-- Orders start -->
<div class="container my-5 py-5">
  <h2 class="mb-5 fs-1">Orders</h2>
  <div>
    <?php if (count($orders) > 0) : ?>
      <?php foreach ($orders as $order) : ?>
        <table class="table table-bordered border-secondary text-center text-capitalize fs-5">
          <thead class="text-white fs-4" style="background-color: #362517;">
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
              <td class="align-middle"> <?= date("Y/m/d g:i A", strtotime($order['order_date']))  ?> </td>
              <td class="align-middle"> <?= $order['username'] ?> </td>
              <td class="align-middle"> <?= $order['room_num'] ?> </td>
              <td class="align-middle"> <?= $order['ext'] ?> </td>
              <td>
                <button type="button" class="btn button fs-5 mx-auto" data-bs-toggle="modal" data-bs-target="#confirmModal_<?= $order['order_id'] ?>">Deliver</button>
              </td>
            </tr>
            <tr>
              <td colspan="5">
                <div class="row row-cols-sm-2 row-cols-md-5 g-3 fs-5 px-3 ">
                  <?php $products = json_decode($order['products'], true); ?>
                  <?php foreach ($products as $product) : ?>
                    <div class="col mt-4">
                      <div class="w-75 mx-sm-auto position-relative text-center">
                        <img src="../public/images/<?= $product['image'] ?>" class="product-image rounded-circle " style="width: 140px; height: 140px;" alt="product">
                        <div class="product-price" style='width: 50px; height: 50px;'>
                          <span class="d-flex justify-content-center align-items-center h-100 fw-bold" style='font-size: 1rem;'><?= $product['price'] ?>LE</span>
                        </div>
                        <div class="my-4">
                          <p class="product-name"><?= $product['name'] ?></p>
                          <p class="product-quantity"><?= $product['quantity'] ?></p>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
                <div class="total-price mt-4 fs-2 d-flex flex-row-reverse px-5">
                  <p>Total: EGP <span><?= (int)$order['total_price'] ?></span></p>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- Modal for each order -->
        <div class="modal fade text-capitalize" id="confirmModal_<?= $order['order_id'] ?>" data-bs-backdrop="static" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="fs-5">Confirm order delivery</p>
              </div>
              <div class="modal-footer">
                <a class="btn button text-decoration-none" href="../controllers/orderController.php?id=<?= $order['order_id'] ?>&action=deliver">yes</a>
                <button type="button" class="btn btn-secondary" id="close-modal" data-bs-dismiss="modal">No</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal end -->

      <?php endforeach; ?>
    <?php else : ?>
      <div class="text-center fs-2">
        <p>There is no current orders</p>
      </div>
    <?php endif; ?>
  </div>
</div>
<!-- Orders end -->