<?php 
$connection=new mysqli("localhost","root","","iti"); 
if($connection->connect_error){ 
    die("connection fail..."); 
} 

$stm=$connection->prepare("INSERT INTO users (fname, lname, email, password, country) VALUES(?,?,?,?,?)"); 
$stm->execute([$_GET['fname'],$_GET['lname'],$_GET['email'],$_GET['password'],$_GET['country']]); 

$connection->close(); 
header("Location: allusers.php") 
?>
