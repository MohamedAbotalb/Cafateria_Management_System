<?php
require("db.php");
$db = new Database();
$connection=$db->getConnection();

if(isset($_POST['register'])){
//Query
$email=validate_data($_POST['email']);
$password=validate_data($_POST['password']);
$errors = [];

echo "<pre>";
var_dump($_FILES);
echo $_FILES["img"]["size"]."<br>";
echo $_FILES["img"]["name"]."<br>";
echo $_FILES["img"]["tmp_name"]."<br>";
echo "</pre>";

move_uploaded_file($_FILES["img"]["tmp_name"],"./imgs/".$_FILES["img"]["name"]);

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
  $errors["email"]="Invalid Email.";
}
if(empty($password)){
  $errors["password"] = "Password is required.";
}
if(count($errors)>0){
  session_start();
  $_SESSION['errors'] = $errors;
  $errors=json_encode($errors);
  header("Location:register.php?error=".$errors);
}else{
  
  $db->insert_data("emp", "email,password", "'$email','$password'");
  }
}
//close
else if(isset($_POST['login'])){
  $stm=$connection->prepare("select * from emp where email=? and password=?");
  $stm->execute([$_POST['email'],$_POST['password']]);

  $result=$stm->fetch();
  if($result){
    var_dump($result);
    header("location:list.php");
  }else{
    echo "no data found";
    header("Location:login.php");
  }
}
function validate_data($data){
  $data = trim($data);
  // $data =addslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?> 
<!-- <button><a href='list.php'>List Employees</a></button>   -->
