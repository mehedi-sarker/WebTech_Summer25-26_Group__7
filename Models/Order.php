<?php

class Order
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    /*========================================
              CREATE ORDER
    ========================================*/

    public function createOrder($data)
    {
        $customername = mysqli_real_escape_string(
            $this->conn,
            $data['customername']
        );

        $phone = mysqli_real_escape_string(
            $this->conn,
            $data['phone']
        );

        $billingAddress = mysqli_real_escape_string(
            $this->conn,
            $data['billingAddress']
        );

        $deliveryArea = mysqli_real_escape_string(
            $this->conn,
            $data['deliveryArea']
        );

        $deliveryCharge = intval($data['deliveryCharge']);

        $productTotal = intval($data['productTotal']);

        $grandTotal = $productTotal + $deliveryCharge;

        $orderDate = date("Y-m-d H:i:s");

        $status = "Pending";


        $query = "INSERT INTO Orders
        (
            CustomerName,
            Phone,
            BillingAddress,
            DeliveryArea,
            DeliveryCharge,
            ProductTotal,
            GrandTotal,
            OrderDate,
            Status
        )
        VALUES
        (
            '$customername',
            '$phone',
            '$billingAddress',
            '$deliveryArea',
            '$deliveryCharge',
            '$productTotal',
            '$grandTotal',
            '$orderDate',
            '$status'
        )";


        $result = mysqli_query($this->conn, $query);


        if (!$result)
        {
            die("Order Creation Failed: " . mysqli_error($this->conn));
        }


        /*
        MySQL automatically generates OrderID
        */

        return mysqli_insert_id($this->conn);
    }


    /*========================================
              ADD ORDER ITEM
    ========================================*/

    public function addOrderItem(
        $orderId,
        $productId,
        $quantity,
        $unitPrice
    )
    {
        $orderId = intval($orderId);

        $productId = intval($productId);

        $quantity = intval($quantity);

        $unitPrice = intval($unitPrice);

        $subTotal = $quantity * $unitPrice;


        $query = "INSERT INTO OrderItems
        (
            OrderID,
            ProductID,
            Quantity,
            UnitPrice,
            SubTotal
        )
        VALUES
        (
            '$orderId',
            '$productId',
            '$quantity',
            '$unitPrice',
            '$subTotal'
        )";


        $result = mysqli_query($this->conn, $query);


        if (!$result)
        {
            die("Order Item Creation Failed: " . mysqli_error($this->conn));
        }
    }

}

?>