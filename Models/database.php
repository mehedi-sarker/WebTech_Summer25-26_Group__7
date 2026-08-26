<?php

class db
{

    /* ==================================================
                        CONNECTION
    ================================================== */

    function connection()
    {
        $db_host     = "localhost";
        $db_user     = "root";
        $db_password = "";
        $db_name     = "golazobd";

        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

        if ($connection->connect_error)
        {
            die("Please Connect The Database");
        }

        return $connection;
    }


    /* ==================================================
                AUTH (works for customers or staff)
    ================================================== */
  

    /* ==================================================
                        PRODUCTS
    ================================================== */

    function getAllProducts($connection)
    {
        $sql = "SELECT * FROM Products";

        return $connection->query($sql);
    }


    function getLatestProducts($connection)
    {
        $sql = "SELECT * FROM Products LIMIT 4";

        return $connection->query($sql);
    }


    function searchProducts($connection, $search)
    {
        $search = $connection->real_escape_string($search);

        $sql = "SELECT * FROM Products
                WHERE ProductName LIKE '%" . $search . "%'
                OR Club LIKE '%" . $search . "%'
                OR Edition LIKE '%" . $search . "%'";

        return $connection->query($sql);
    }


    function getProductById($connection, $id)
    {
        $id = intval($id);

        $sql = "SELECT * FROM Products WHERE ProductID = " . $id;

        return $connection->query($sql);
    }


    function reduceStock($connection, $id, $quantity)
    {
        $id       = intval($id);
        $quantity = intval($quantity);

        $sql = "UPDATE Products
                SET Stock = Stock - " . $quantity . "
                WHERE ProductID = " . $id;

        return $connection->query($sql);
    }


    /* ==================================================
                    ORDERS / CART CHECKOUT
    ================================================== */

    function createOrder($connection, $data)
    {
        $customername = $connection->real_escape_string($data['customername']);
        $phone        = $connection->real_escape_string($data['phone']);
        $billingaddr  = $connection->real_escape_string($data['billingaddress']);
        $deliveryarea = $connection->real_escape_string($data['deliveryarea']);

        $deliverycharge = intval($data['deliverycharge']);
        $producttotal   = intval($data['producttotal']);
        $grandtotal     = $producttotal + $deliverycharge;

        $date   = date("Y-m-d H:i:s");
        $status = "Pending";

        $sql = "INSERT INTO orders
                (CustomerName, Phone, BillingAddress, DeliveryArea, DeliveryCharge, ProductTotal, GrandTotal, OrderDate, Status)
                VALUES
                ('" . $customername . "', '" . $phone . "', '" . $billingaddr . "', '" . $deliveryarea . "', '" . $deliverycharge . "', '" . $producttotal . "', '" . $grandtotal . "', '" . $date . "', '" . $status . "')";

        $result = $connection->query($sql);

        if (!$result)
        {
            die("Order Insert Failed: " . $connection->error);
        }

        return $connection->insert_id;
    }


    function addOrderItem($connection, $orderId, $productId, $quantity, $unitPrice)
    {
        $orderId   = intval($orderId);
        $productId = intval($productId);
        $quantity  = intval($quantity);
        $unitPrice = intval($unitPrice);
        $subtotal  = $unitPrice * $quantity;

        $sql = "INSERT INTO orderitems
                (OrderID, ProductID, Quantity, UnitPrice, SubTotal)
                VALUES
                ('" . $orderId . "', '" . $productId . "', '" . $quantity . "', '" . $unitPrice . "', '" . $subtotal . "')";

        $result = $connection->query($sql);

        if (!$result)
        {
            die("Order Item Insert Failed: " . $connection->error);
        }
    }

    /* ==================================================
                    DELIVERY
    ================================================== */

    function getOrders($connection, $status)
    {
        $sql = "SELECT * FROM orders WHERE Status = '".$status."'";
        $result = $connection->query($sql);
        return $result;
    }

    function updateStatus($connection, $orderId, $status)
    {
        $sql = "UPDATE orders SET Status = '".$status."' WHERE OrderID = '".$orderId."'";
        $result = $connection->query($sql);
        return $result;
    }

}


?>
