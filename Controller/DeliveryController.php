<?php
include __DIR__ . "/../Models/database.php";
session_start();

$database = new db();
$connection = $database->connection();

$username = $_SESSION["username"] ?? "Delivery Man";

$status = "Pending";
if(isset($_POST["view"])){
    $status = trim($_POST["view"]);
    setcookie("last_tab", $status, time() + 60*60*24*7, "/");
}
else if(isset($_COOKIE["last_tab"])){
    $status = $_COOKIE["last_tab"];
}

$valid_status = ["Pending", "Shipped", "Delivered"];
if(!in_array($status, $valid_status)){
    $status = "Pending";
}

$orders = $database->getOrders($connection, $status);
?>