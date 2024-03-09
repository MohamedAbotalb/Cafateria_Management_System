<?php
require_once "templates/adminNav.php";
?>

<div class="container my-5">
    <h1 class="text-center">Cafeteria</h1>
    <form action="#" method="post" class="w-50 m-auto text-bg-light my-5 p-3 rounded shadow-lg bg-body-tertiary" novalidate>
        <div class="row g-3 align-items-center my-3">
            <div class="col-5">
                <label for="inputEmail" class="col-form-label">Enter Email</label>
            </div>
            <div class="col-6">
                <input type="email" id="inputEmail" class="form-control" aria-describedby="emailHelpInline" required>
                <div class="invalid-feedback">Please enter a valid email.</div>
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-5">
                <label for="inputPassword" class="col-form-label">Enter Password</label>
            </div>
            <div class="col-6">
                <input type="password" id="inputPassword" class="form-control" aria-describedby="passwordHelpInline" required>
                <div class="invalid-feedback">Please enter your password.</div>
            </div>
        </div>
        <div class="row m-auto text-center">
            <button type="submit" class="btn btn-primary mb-3 w-25 m-auto">Log In</button><br>
        </div>
        <div class="row m-auto text-center">
            <a href="./confirmPass.php" class="link-primary">Forgot Password?</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form');

        forms.forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    });
</script>
