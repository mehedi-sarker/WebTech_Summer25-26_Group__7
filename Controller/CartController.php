<?php

require_once __DIR__ . "/../Config/Connection.php";
require_once __DIR__ . "/../Models/Product.php";
require_once __DIR__ . "/../Models/Order.php";


class CartController
{
    private $product;
    private $order;

    public function view()
{
    $cartItems = array();

    if (isset($_SESSION['cart']))
    {
        foreach ($_SESSION['cart'] as $index => $item)
        {
            $result =
                $this->product->getProductById(
                    $item['ProductID']
                );

            $row = mysqli_fetch_assoc($result);

            if ($row)
            {
                $row['Size'] =
                    $item['Size'];

                $row['Quantity'] =
                    $item['Quantity'];

                $row['Index'] =
                    $index;

                $cartItems[] =
                    $row;
            }
        }
    }

    require __DIR__ .
            "/../View/Cart/index.php";
}
    public function __construct()
    {
        global $conn;

        $this->product = new Product($conn);
        $this->order   = new Order($conn);
    }


    /* =========================
            ADD TO CART
    ========================= */

    public function add()
    {
        if (isset($_POST['productid'], $_POST['size'], $_POST['quantity']))
        {
            if (!isset($_SESSION['cart']))
            {
                $_SESSION['cart'] = array();
            }

            $item = array(
                "ProductID" => intval($_POST['productid']),
                "Size"      => $_POST['size'],
                "Quantity"  => intval($_POST['quantity'])
            );

            $_SESSION['cart'][] = $item;
        }

        header("Location: cart.php");
        exit();
    }


    /* =========================
          INCREASE QUANTITY
    ========================= */

    public function increase($index)
    {
        $index = intval($index);

        if (isset($_SESSION['cart'][$index]))
        {
            $_SESSION['cart'][$index]['Quantity']++;
        }

        header("Location: cart.php");
        exit();
    }


    /* =========================
          DECREASE QUANTITY
    ========================= */

    public function decrease($index)
    {
        $index = intval($index);

        if (isset($_SESSION['cart'][$index]) && $_SESSION['cart'][$index]['Quantity'] > 1)
        {
            $_SESSION['cart'][$index]['Quantity']--;
        }

        header("Location: cart.php");
        exit();
    }


    /* =========================
            REMOVE ITEM
    ========================= */

    public function remove($index)
    {
        $index = intval($index);

        if (isset($_SESSION['cart'][$index]))
        {
            unset($_SESSION['cart'][$index]);

            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }

        header("Location: cart.php");
        exit();
    }


    /* =========================
              CHECKOUT
    ========================= */
/*========================================
              CHECKOUT
========================================*/

public function checkout()
{
    if (empty($_SESSION['cart']))
    {
        header("Location: cart.php");
        exit();
    }


    /*====================================
          CUSTOMER INFORMATION
    ====================================*/

    $customername = $_POST['customername'] ?? "";

    $phone = $_POST['phone'] ?? "";

    $division = $_POST['division'] ?? "";

    $district = $_POST['district'] ?? "";

    $area = $_POST['area'] ?? "";

    $address = $_POST['address'] ?? "";

    $deliveryArea = $_POST['delivery_area'] ?? "";


    /*====================================
          CREATE BILLING ADDRESS
    ====================================*/

    $billingAddress =
        "Division: " . $division .
        ", District: " . $district .
        ", Area: " . $area .
        ", Address: " . $address;


    /*====================================
          DELIVERY CHARGE
    ====================================*/

    if ($deliveryArea == "Inside Dhaka")
    {
        $deliveryCharge = 80;
    }
    elseif ($deliveryArea == "Outside Dhaka")
    {
        $deliveryCharge = 130;
    }
    else
    {
        $deliveryCharge = 0;
    }


    /*====================================
              CALCULATE PRODUCT TOTAL
    ====================================*/

    $productTotal = 0;


    foreach ($_SESSION['cart'] as $item)
    {
        $result =
            $this->product->getProductById(
                $item['ProductID']
            );


        $row = mysqli_fetch_assoc($result);


        if ($row)
        {
            $productTotal +=
                $row['Price'] * $item['Quantity'];
        }
    }


    /*====================================
              ORDER DATA
    ====================================*/

    $data = array(

        "customername"   => $customername,

        "phone"          => $phone,

        "billingAddress" => $billingAddress,

        "deliveryArea"   => $deliveryArea,

        "deliveryCharge" => $deliveryCharge,

        "productTotal"   => $productTotal

    );


    /*====================================
              CREATE ORDER
    ====================================*/

    $orderId =
        $this->order->createOrder($data);


    /*====================================
              CREATE ORDER ITEMS
    ====================================*/

    foreach ($_SESSION['cart'] as $item)
    {

        $productId =
            $item['ProductID'];

        $quantity =
            $item['Quantity'];


        $result =
            $this->product->getProductById(
                $productId
            );


        $row =
            mysqli_fetch_assoc($result);


        if ($row)
        {

            $unitPrice =
                $row['Price'];


            $this->order->addOrderItem(
                $orderId,
                $productId,
                $quantity,
                $unitPrice
            );


            /*
            Reduce stock
            */

            $this->product->reduceStock(
                $productId,
                $quantity
            );

        }

    }


    /*====================================
              CLEAR CART
    ====================================*/

    unset($_SESSION['cart']);


    /*====================================
              SUCCESS PAGE
    ====================================*/

    header(
        "Location: ordersuccess.php?order=" .
        $orderId
    );

    exit();
}}
?>
