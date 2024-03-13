<?php
require_once "head.php";
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

<!-- Navbar start -->
<div class="container-fluid p-0 nav-bar" style="background-color: #362517; ">
  <nav class="navbar navbar-expand-lg navbar-dark py-1 fs-5 d-flex justify-content-sm-evenly">
    <a class="navbar-brand px-lg-4 me-5">
      <h1 class="m-0 fs-1 display-4 text-white ">ITI Cafeteria</h1>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
      <div class="navbar-nav px-5">
        <a href="/admin-home.php" class="nav-item nav-link mx-3 small">Home</a>
        <a href="./adminProducts.php" class="nav-item nav-link mx-3 small">Products</a>
        <a href="./adminUsers.php" class="nav-item nav-link mx-3 small">Users</a>
        <a href="/admin-manual.php" class="nav-item nav-link mx-3 small">Manual Orders</a>
        <a href="/admin-checks.php" class="nav-item nav-link mx-3 small">Checks</a>
      </div>
      <ul class="navbar-nav mx-5">
        <li class="nav-item d-flex align-items-center">
          <a class="nav-link" id="navbarDropdown" aria-expanded="false">
            <img class="nav-img rounded-circle ms-1" src="../public/images/user1.png" width="60px" />
            <span class="nav-user small">Admin</span>
          </a>
          <a href="../controllers/logout.php" class="nav-link ms-2">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
</div>
<!-- Navbar End -->