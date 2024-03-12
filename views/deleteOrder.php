<?php 
require_once "../models/db.php";

$id=$_GET['id'];

$DB = new DB();
$DB->delete('orders',['id'] , [$id]);
header("Location:myOrdersView.php");


?>