<?php
require_once "templates/adminNav.php";
?>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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

  .data {
    box-shadow: 10px 10px 10px #afacac;
  }
</style>

<div class="container">

  <h1 class="text-center my-3">Checks</h1>
  <form action="" class="w-50 m-auto text-bg-light my-5 p-3 rounded shadow-lg bg-body-tertiary">

    <div class="input-group my-3">
      <input type="text" class="form-control" placeholder="Date From" disabled>
      <input type="date" name="date" id="" class="form-control">

    </div>
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Date To" disabled>
      <input type="date" name="date" id="" class="form-control">
    </div>
    <select class="form-select mb-3">
      <option selected>User</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
  </form>
  <div class="data">
    <table class="table text-center table-light table-striped my-5 shadow-lg">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Total Amount</th>
        </tr>
      </thead>
      <tbody>
        <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
          <th scope="row"><button class="btn btn-dark btn-xs">+ </button></th>
          <td>Otto</td>
        </tr>
        <tr>
          <td colspan="3" class="hiddenRow">
            <div class="accordian-body collapse" id="demo1">
              <table class="table table-striped table-warning">
                <thead>
                  <tr>
                    <th>Order Date</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr data-toggle="collapse" class="accordion-toggle" data-target="#demo10">
                    <td><button class="btn btn-dark btn-xs">+ </button> 20-08-2023</td>
                    <td>5</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="hiddenRow">
                      <div class="accordian-body collapse" id="demo10">
                        <table class="table table-striped table-light text-center">
                          <thead>
                            <tr>
                              <th>Products</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <div class="order text-center">
                                  <img src="../public/images/item1.jpg" alt="" srcset="" width="200" height="200" class="rounded-circle">
                                  <img src="../public/images/item2.jpg" alt="" srcset="" width="200" height="200" class="rounded-circle">
                                  <img src="../public/images/item3.jpg" alt="" srcset="" width="200" height="200" class="rounded-circle">
                                  <img src="../public/images/item4.jpg" alt="" srcset="" width="200" height="200" class="rounded-circle">
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>