<?php

require_once __DIR__ . "/../Models/database.php";


class ProductController
{

    /* =========================
          PRODUCTS PAGE
    ========================= */

    public function index()
    {
        $database   = new db();
        $connection = $database->connection();

        if (isset($_GET['search']) && $_GET['search'] != "")
        {
            $products = $database->searchProducts($connection, $_GET['search']);
        }
        else
        {
            $products = $database->getAllProducts($connection);
        }

        require __DIR__ . "/../View/Products/index.php";
    }


    /* =========================
          LATEST PRODUCTS
    ========================= */

    public function latestProducts()
    {
        $database   = new db();
        $connection = $database->connection();

        return $database->getLatestProducts($connection);
    }


    /* =========================
          PRODUCT DETAILS
    ========================= */

    public function details($id)
    {
        $database   = new db();
        $connection = $database->connection();

        $result = $database->getProductById($connection, $id);

        $product = $result->fetch_assoc();

        require __DIR__ . "/../View/Products/details.php";
    }

}

?>
