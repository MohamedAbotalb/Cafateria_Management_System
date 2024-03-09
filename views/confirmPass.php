<?php
require_once "templates/adminNav.php";
?>

<div class="container my-5">
    <h1 class="text-center">Cafeteria</h1>
    <form method="" action="#" class="w-50 m-auto text-bg-light my-5 p-3 rounded shadow-lg bg-body-tertiary" novalidate>
        <div class="row g-3 align-items-center my-3">
            <div class="col-5">
                <label for="inputPassword" class="col-form-label">Enter New Password</label>
            </div>
            <div class="col-7">
                <input type="password" id="inputPassword" class="form-control" aria-describedby="passwordHelpInline" pattern=".{6,}" title="Password must contain at least 3 characters" required>
                <div class="invalid-feedback">Please enter a valid password with at least 6 characters.</div>
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-5">
                <label for="confirmPassword" class="col-form-label">Confirm New Password</label>
            </div>
            <div class="col-7">
                <input type="password" id="confirmPassword" class="form-control" aria-describedby="passwordHelpInline" required>
                <div class="invalid-feedback">Passwords do not match.</div>
            </div>
        </div>
        <div class="row m-auto text-center">
            <button type="submit" class="btn btn-primary mb-3 w-50 m-auto">Update Password</button><br>
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

        // Password confirmation validation
        const password = document.getElementById("inputPassword");
        const confirmPassword = document.getElementById("confirmPassword");
        const confirmPasswordFeedback = document.querySelector("#confirmPassword ~ .invalid-feedback");

        confirmPassword.addEventListener("input", function() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity("Passwords do not match");
                confirmPasswordFeedback.style.display = "block";
            } else {
                confirmPassword.setCustomValidity("");
                confirmPasswordFeedback.style.display = "none";
            }
        });
    });
</script>
