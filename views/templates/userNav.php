<?php
require_once "head.php";
?>

<!-- Navbar start -->
<div class="container-fluid p-0 nav-bar" style="background-color: #362517; ">
  <nav class="navbar navbar-expand-lg navbar-dark py-1 fs-5 d-flex justify-content-sm-evenly">
    <a class="navbar-brand px-lg-4 me-5">
      <h1 class="m-0 display-4 fs-1 text-white">ITI Cafeteria</h1>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
      <div class="navbar-nav px-5">
        <a href="/user-home" class="nav-item nav-link mx-3">Home</a>
        <a href="/user-orders" class="nav-item nav-link mx-3">My Orders</a>
      </div>
      <ul class="navbar-nav mx-5">
        <li class="nav-item ">
          <a class="nav-link" href="/user" id="navbarDropdown" aria-expanded="false">
            <img class="nav-img rounded-circle" src="" width="60px" />
            <span class="nav-user small">Username</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</div>
<!-- Navbar End -->