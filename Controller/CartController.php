<?php

require_once __DIR__ . "/../Models/database.php";


class CartController
{

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

        header("Location: index.php?page=cart");
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

        header("Location: index.php?page=cart");
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

        header("Location: index.php?page=cart");
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

        header("Location: index.php?page=cart");
        exit();
    }


    /* =========================
              CHECKOUT
    ========================= */

    public function checkout()
    {
        if (empty($_SESSION['cart']))
        {
            header("Location: index.php?page=cart");
            exit();
        }

        $database   = new db();
        $connection = $database->connection();

        $subtotal = 0;

        foreach ($_SESSION['cart'] as $item)
        {
            $result = $database->getProductById($connection, $item['ProductID']);

            $row = $result->fetch_assoc();

            if ($row)
            {
                $subtotal += $row['Price'] * $item['Quantity'];
            }
        }

        $deliveryCharge = intval($_POST['delivery']);

        $deliveryArea = ($deliveryCharge == 130) ? "Outside Dhaka" : "Inside Dhaka";

        $billingAddress =
            $_POST['address'] . ", " .
            $_POST['area'] . ", " .
            $_POST['district'] . ", " .
            $_POST['division'];

        if (!empty($_POST['note']))
        {
            $billingAddress .= " (Note: " . $_POST['note'] . ")";
        }

        $data = array(
            "customername"   => $_POST['customername'],
            "phone"          => $_POST['phone'],
            "billingaddress" => $billingAddress,
            "deliveryarea"   => $deliveryArea,
            "deliverycharge" => $deliveryCharge,
            "producttotal"   => $subtotal
        );

        $orderId = $database->createOrder($connection, $data);

        foreach ($_SESSION['cart'] as $item)
        {
            $result = $database->getProductById($connection, $item['ProductID']);

            $row = $result->fetch_assoc();

            if ($row)
            {
                $database->addOrderItem(
                    $connection,
                    $orderId,
                    $item['ProductID'],
                    $item['Quantity'],
                    $row['Price']
                );

                $database->reduceStock($connection, $item['ProductID'], $item['Quantity']);
            }
        }

        unset($_SESSION['cart']);

        header("Location: index.php?page=ordersuccess&order=" . $orderId);
        exit();
    }


    /* =========================
            VIEW CART
    ========================= */

    public function view()
    {
        $database   = new db();
        $connection = $database->connection();

        $cartItems = array();

        if (isset($_SESSION['cart']))
        {
            foreach ($_SESSION['cart'] as $index => $item)
            {
                $result = $database->getProductById($connection, $item['ProductID']);

                $row = $result->fetch_assoc();

                if ($row)
                {
                    $row['Size']     = $item['Size'];
                    $row['Quantity'] = $item['Quantity'];
                    $row['Index']    = $index;

                    $cartItems[] = $row;
                }
            }
        }

        require __DIR__ . "/../View/Cart/index.php";
    }

}

?>
