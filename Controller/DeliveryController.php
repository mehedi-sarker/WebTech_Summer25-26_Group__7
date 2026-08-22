<?php
include __DIR__ . "/../Models/database.php";
session_start();

$database = new db();
$connection = $database->connection();

$username = $_SESSION["username"] ?? "Delivery Man";
$message = "";

// tab to show — remember it with a cookie
$status = "Pending";
if(isset($_GET["view"])){
    $status = trim($_GET["view"]);
    setcookie("last_tab", $status, time() + 60*60*24*7, "/");
}
else if(isset($_COOKIE["last_tab"])){
    $status = $_COOKIE["last_tab"];
}

$valid_status = ["Pending", "Shipped", "Delivered"];
if(!in_array($status, $valid_status)){
    $status = "Pending";
}

// update an order status
if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $order_id = trim($_POST["order_id"] ?? "");
        $new_status = trim($_POST["delivery_status"] ?? "");

        if(!empty($order_id) && is_numeric($order_id) && in_array($new_status, $valid_status))
            {
                $database->updateStatus($connection, $order_id, $new_status);
                $message = "Order #".$order_id." marked as ".$new_status."!";
            }
        else{
            $message = "Invalid update";
        }
    }

$orders = $database->getOrders($connection, $status);
?>