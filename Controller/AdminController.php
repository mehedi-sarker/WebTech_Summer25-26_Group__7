<?php

require_once __DIR__ . "/../Models/database.php";


class AdminController
{

    private $db;


    public function __construct()
    {
        $this->db = new db();
    }


    /* =========================
              DASHBOARD
    ========================= */

    public function dashboard()
    {
        require __DIR__ . "/../View/Admin/dashboard.php";
    }


    /* =========================
            MANAGE PRODUCTS
    ========================= */

    public function products()
    {
        $connection = $this->db->connection();

        if (isset($_POST['addproduct']))
        {
            $this->db->addProduct($connection, $_POST);

            header("Location: index.php?page=admin-products");
            exit();
        }

        if (isset($_POST['updateproduct']))
        {
            $this->db->updateProduct($connection, $_POST['ProductID'], $_POST);

            header("Location: index.php?page=admin-products");
            exit();
        }

        if (isset($_GET['delete']))
        {
            $this->db->deleteProduct($connection, $_GET['delete']);

            header("Location: index.php?page=admin-products");
            exit();
        }

        $editProduct = null;

        if (isset($_GET['edit']))
        {
            $result      = $this->db->getProductById($connection, $_GET['edit']);
            $editProduct = $result->fetch_assoc();
        }

        $products = $this->db->getAllProducts($connection);

        require __DIR__ . "/../View/Admin/products.php";
    }


    /* =========================
            MANAGE ORDERS
    ========================= */

    public function orders()
    {
        $connection = $this->db->connection();

        $orders = $this->db->getAllOrders($connection);

        require __DIR__ . "/../View/Admin/orders.php";
    }


    /* =========================
            ORDER DETAILS
    ========================= */

    public function orderDetails($orderId)
    {
        $connection = $this->db->connection();

        $result = $this->db->getOrderById($connection, $orderId);
        $order  = $result->fetch_assoc();

        $items = $this->db->getOrderItems($connection, $orderId);

        require __DIR__ . "/../View/Admin/orderDetails.php";
    }

}

?>
