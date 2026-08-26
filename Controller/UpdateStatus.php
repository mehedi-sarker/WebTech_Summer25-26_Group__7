<?php
include "../Models/database.php";

$order_id = $_POST["order_id"] ?? "";
$status = $_POST["status"] ?? "";

if(!$order_id || !$status)
{
    echo "Invalid update";
}
else
{
    $database = new db();
    $connection = $database->connection();
    $database->updateStatus($connection, $order_id, $status);
    echo "Order #".$order_id." marked as ".$status;
}
?>