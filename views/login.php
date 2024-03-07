<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/styles/main.css">
    <style>
body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h1{
            color:#da9f5b;
            font-size:65px;
            font-family: "Pacifico", cursive;
            font-weight:bold;
            text-shadow:3px 3px 3px #afacac;
        }
        a{
            color:#da9f5b;
        }
        .button:hover{
            color:#da9f5b;
        }
    </style>
</head>
  <body>
    <div class="container my-5">
        <h1 class="text-center">Cafeteria</h1>
        <form action="./templates/validation.php" method="post" class="w-50 m-auto text-bg-light my-5 p-3 rounded shadow-lg bg-body-tertiary needs-validation" validate>
        <div class="row g-3 align-items-center my-3">
            <div class="col-3">
                <label class="col-form-label">Email</label>
            </div>
            <div class="col-8">
                <input type="email" name="email"  class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="invalid-tooltip">
                please enter Email!
            </div>

        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-3">
                <label for="inputPassword6" class="col-form-label">Password</label>
            </div>
            <div class="col-8">
                <input type="password" name="password" id="inputPassword6" class="form-control " placeholder="Enter your password" required>
            </div>
            <div class="invalid-feedback">
                please enter Password!
            </div>
        </div>
        <div class="row m-auto text-center">
            <button class="btn mb-3 w-25 m-auto button" value="login" name="login">Log IN</button><br>
            <a href="./confirmPass.php" target="_blank" rel="noopener noreferrer" class="text-center">Forget Password?</a>
        </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        
</body>
</html>