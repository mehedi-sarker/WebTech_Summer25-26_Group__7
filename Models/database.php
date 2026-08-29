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
    
        function getAllOrders($connection)
        {
            $sql = "SELECT * FROM orders ORDER BY OrderID DESC";

            return $connection->query($sql);
        }
        function getOrderById($connection, $orderId)
{
    $orderId = intval($orderId);

    $sql = "SELECT * FROM orders WHERE OrderID = " . $orderId;

    return $connection->query($sql);
}


function getOrderItems($connection, $orderId)
{
    $orderId = intval($orderId);

    $sql = "SELECT orderitems.*, Products.ProductName, Products.Image
            FROM orderitems
            JOIN Products ON orderitems.ProductID = Products.ProductID
            WHERE orderitems.OrderID = " . $orderId;

    return $connection->query($sql);
}


function addProduct($connection, $data)
{
    $name     = $connection->real_escape_string($data['ProductName']);
    $club     = $connection->real_escape_string($data['Club']);
    $edition  = $connection->real_escape_string($data['Edition']);
    $category = $connection->real_escape_string($data['Category']);
    $image    = $connection->real_escape_string($data['Image']);

    $price = intval($data['Price']);
    $stock = intval($data['Stock']);

    $sql = "INSERT INTO Products
            (ProductName, Club, Edition, Category, Price, Stock, Image)
            VALUES
            ('" . $name . "', '" . $club . "', '" . $edition . "', '" . $category . "', '" . $price . "', '" . $stock . "', '" . $image . "')";

    return $connection->query($sql);
}


function updateProduct($connection, $id, $data)
{
    $id       = intval($id);
    $name     = $connection->real_escape_string($data['ProductName']);
    $club     = $connection->real_escape_string($data['Club']);
    $edition  = $connection->real_escape_string($data['Edition']);
    $category = $connection->real_escape_string($data['Category']);
    $image    = $connection->real_escape_string($data['Image']);

    $price = intval($data['Price']);
    $stock = intval($data['Stock']);

    $sql = "UPDATE Products SET
            ProductName = '" . $name . "',
            Club = '" . $club . "',
            Edition = '" . $edition . "',
            Category = '" . $category . "',
            Price = '" . $price . "',
            Stock = '" . $stock . "',
            Image = '" . $image . "'
            WHERE ProductID = " . $id;

    return $connection->query($sql);
}


function deleteProduct($connection, $id)
{
    $id = intval($id);

    $sql = "DELETE FROM Products WHERE ProductID = " . $id;

    return $connection->query($sql);
}
    function signup($connection, $username, $password, $role)
    {
        $username = $connection->real_escape_string($username);
        $password = $connection->real_escape_string($password);
        $role     = $connection->real_escape_string($role);

        $sql = "INSERT INTO users (Username, Password, Role)
                VALUES ('" . $username . "', '" . $password . "', '" . $role . "')";

        return $connection->query($sql);
    }


    function signin($connection, $username, $password)
    {
        $username = $connection->real_escape_string($username);
        $password = $connection->real_escape_string($password);

        $sql = "SELECT * FROM users
                WHERE Username = '" . $username . "'
                AND Password = '" . $password . "'";

        return $connection->query($sql);
    }


    function usernameExists($connection, $username)
    {
        $sql = "SELECT * FROM users WHERE Username = '".$username."'";
        $result = $connection->query($sql);
        return $result->num_rows > 0;
    }


}


?>
