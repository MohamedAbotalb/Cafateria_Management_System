<?php
require_once "templates/userNav.php";
require_once "../models/db.php";
$db=new DB();

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
      <div class="col-5">
        <div class="card">
          <div class="card-body">
            <!-- start of product order -->
            <div class="list mx-3"></div>
            <!-- end of product order -->
            <form>
              <div class="form-floating my-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Notes</label>
              </div>
              <select class="form-select" aria-label="Default select example">
                <option selected>Select Room</option>
                <?php
                $rooms=$db->selectAll("room");
                var_dump($rooms);
                foreach($rooms as $room){
                  echo "<option value='{$room['id']}'>{$room['id']}</option>";
                }
                ?>
              </select>
              <hr class="my-4" />
              <p class="fw-bold"><span class="invoice-price">0</span> EGP</p>
              <input type="submit" class="btn button" value="confirm" />
            </form>
          </div>
        </div>
      </div>
      <!-- end of order -->
      <!-- start of menu -->
      <div class="col-7 ">
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
            <h5 class="menu-price">$<span class="productPrice">15</span></h5>
            <div class="card-body">
              <p class="card-text">
                tea
              </p>
            </div>
          </div>
          <div class="card m-3 product" style="width: 9rem">
            <img src="../public/images/item4.jpg" class="card-img-top" alt="..." />
            <h5 class="menu-price">$<span class="productPrice">12</span></h5>
            <div class="card-body">
              <p class="card-text">
                coffee
              </p>
            </div>
          </div>
          <div class="card m-3 product" style="width: 9rem">
            <img src="../public/images/item5.jpg" class="card-img-top" alt="..." />
            <h5 class="menu-price">$<span class="productPrice">20</span></h5>
            <div class="card-body">
              <p class="card-text">
                spreso
              </p>
            </div>
          </div>
          <div class="card m-3 product" style="width: 9rem">
            <img src="../public/images/item6.jpg" class="card-img-top" alt="..." />
            <h5 class="menu-price">$<span class="productPrice">7</span></h5>
            <div class="card-body">
              <p class="card-text">
                cola
              </p>
            </div>
          </div>
          <div class="card m-3 product" style="width: 9rem">
            <img src="../public/images/item7.jpg" class="card-img-top" alt="..." />
            <h5 class="menu-price">$<span class="productPrice">7</span></h5>
            <div class="card-body">
              <p class="card-text">
                nescofe
              </p>
            </div>
          </div>
          <div class="card m-3 product" style="width: 9rem">
            <img src="../public/images/item8.jpg" class="card-img-top" alt="..." />
            <h5 class="menu-price">$<span class="productPrice">30</span></h5>
            <div class="card-body">
              <p class="card-text">
                spreso
              </p>
            </div>
          </div>
          <div class="card m-3 product" style="width: 9rem">
            <img src="../public/images/item1.jpg" class="card-img-top" alt="..." />
            <h5 class="menu-price">$<span class="productPrice">20</span></h5>
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