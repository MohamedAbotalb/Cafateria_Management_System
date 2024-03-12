<?php 
require_once "../models/db.php";

$id=$_GET['id'];

$DB = new DB();
$DB->Delete('orders','id' , $id);
header("Location:myOrders.php");


?>