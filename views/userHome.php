<?php
require_once "templates/userNav.php";
?>

<!-- start of search -->
<div class="container mt-3">
  <div class="row">
    <div class="col-9"></div>

    <div class="col-3">
      <form method="" action="">
        <div class="input-group mb-1">
          <input type="text" class="form-control" placeholder="Enter item" aria-label="Recipient's username" aria-describedby="button-addon2" />
          <input type="submit" class="btn btn-outline-secondary" type="button" id="button-addon2" value="search" />
        </div>
      </form>
    </div>

  </div>
</div>
<!-- end of search -->

<!-- start of menu -->
<div class="container-fluid mt-1">
  <div class="container">
    <div class="row">
      <!-- start of order -->
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <!-- start of product order -->
            <div class="container container-fluid">
              <div class="d-flex">
                <p class="">tea</p>
                <div class="">5</div>
                <div>+</div>
                <div>-</div>
                <div>X</div>
              </div>
            </div>
          <!-- end of product order -->
            <form>
              <div class="form-floating my-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Notes</label>
              </div>
              <select class="form-select" aria-label="Default select example">
                <option selected>Select Room</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
              <hr class="my-4" />
              <p class="fw-bold">55 EGP</p>
              <input type="submit" class="btn button" value="confirm" />
            </form>
          </div>
        </div>
      </div>
      <!-- end of order -->
      <!-- start of menu -->
      <div class="col-8 ">
        <h5 class="text-muted "> latest order</h5>
        <div class="d-flex flex-wrap">
          <div class="card m-3 " style="width: 9rem">
            <img src="../public/images/item1.jpg" class="card-img-top" alt="..." />
           
            <div class="card-body">
              <p class="card-text">
                tea
              </p>
            </div>
          </div>
          <div class="card m-3 " style="width: 9rem">
            <img src="../public/images/item2.jpg" class="card-img-top" alt="..." />
            <div class="card-body">
              <p class="card-text">
                cola
              </p>
            </div>
          </div>
        </div>
        <hr class="my-4" />
        <div class="section-title">
          <p class="display-5">Menu</p>
        </div>
        <div class="d-flex flex-wrap">
          <div class="card m-3 product" style="width: 9rem">
            <img src="../public/images/item3.jpg" class="card-img-top" alt="..." />
            <h5 class="menu-price">$10</h5>
            <div class="card-body">
              <p class="card-text">
                tea
              </p>
            </div>
          </div>
          <div class="card m-3 product" style="width: 9rem">
            <img src="../public/images/item4.jpg" class="card-img-top" alt="..." />
            <h5 class="menu-price">$15</h5>
            <div class="card-body">
              <p class="card-text">
                coffee
              </p>
            </div>
          </div>
          <div class="card m-3 product" style="width: 9rem">
            <img src="../public/images/item5.jpg" class="card-img-top" alt="..." />
            <h5 class="menu-price">$20</h5>
            <div class="card-body">
              <p class="card-text">
                hot chocolate
              </p>
            </div>
          </div>
          <div class="card m-3 product" style="width: 9rem">
            <img src="../public/images/item6.jpg" class="card-img-top" alt="..." />
            <h5 class="menu-price">$7</h5>
            <div class="card-body">
              <p class="card-text">
                cola
              </p>
            </div>
          </div>
          <div class="card m-3 product" style="width: 9rem">
            <img src="../public/images/item7.jpg" class="card-img-top" alt="..." />
            <h5 class="menu-price">$7</h5>
            <div class="card-body">
              <p class="card-text">
                nescofe
              </p>
            </div>
          </div>
          <div class="card m-3 product" style="width: 9rem">
            <img src="../public/images/item8.jpg" class="card-img-top" alt="..." />
            <h5 class="menu-price">$7</h5>
            <div class="card-body">
              <p class="card-text">
                spreso
              </p>
            </div>
          </div>
          <div class="card m-3 product" style="width: 9rem">
            <img src="../public/images/item1.jpg" class="card-img-top" alt="..." />
            <h5 class="menu-price">$20</h5>
            <div class="card-body">
              <p class="card-text">
                tea
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- end of menu -->
    </div>
  </div>
</div>