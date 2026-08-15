<?php

require_once __DIR__ . "/../Config/Connection.php";

require_once __DIR__ . "/../Models/Product.php";


class ProductController
{
    private $product;


    public function __construct()
    {
        global $conn;

        $this->product = new Product($conn);
    }


    /* =========================
          PRODUCTS PAGE
    ========================= */

    public function index()
    {
        if (isset($_GET['search']) && $_GET['search'] != "")
        {
            $search = $_GET['search'];

            $products =
                $this->product->searchProducts($search);
        }
        else
        {
            $products =
                $this->product->getAllProducts();
        }


        require __DIR__ . "/../View/Products/index.php";
    }


    /* =========================
          LATEST PRODUCTS
    ========================= */

    public function latestProducts()
    {
        return $this->product->getLatestProducts();
    }


    /* =========================
          PRODUCT DETAILS
    ========================= */

    public function details($id)
    {
        $result =
            $this->product->getProductById($id);

        $product = mysqli_fetch_assoc($result);

        require __DIR__ . "/../View/Products/details.php";
    }
}

?>