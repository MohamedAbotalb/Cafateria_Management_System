<?php
require_once "../models/db.php";
$db=new db();
var_dump($_POST);
$note=$_POST['note'];
if(isset($_POST['room'])){
    $roomId=$_POST['room'];
}else{
    $roomId=2;
}
$invoicePrice=$_POST['invoicePrice'];

$db->insert("orders",["note"=>$note,"status"=>"processing","room_id"=>$roomId,"total_price"=>$invoicePrice,"user_id"=>2]);
