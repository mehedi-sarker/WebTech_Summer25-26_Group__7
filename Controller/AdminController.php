<?php

require_once __DIR__ . "/../Models/database.php";


class AdminController
{

    /* ==================================================
                    ADMIN DASHBOARD
    ================================================== */

    public function dashboard()
    {
        $this->checkAdmin();

        require __DIR__ . "/../View/Admin/admin.php";
    }


    /* ==================================================
                    MANAGE PRODUCTS
    ================================================== */

    public function manageProducts()
    {
        $this->checkAdmin();

        $database   = new db();
        $connection = $database->connection();

        /*
         * Search Product
         */
        if (isset($_GET['search']) && trim($_GET['search']) !== "")
        {
            $search = trim($_GET['search']);

            $products = $database->searchProducts(
                $connection,
                $search
            );
        }
        else
        {
            /*
             * Show All Products
             */
            $products = $database->getAllProducts($connection);
        }

        require __DIR__ . "/../View/Admin/manageproduct.php";
    }


    /* ==================================================
                    ADD PRODUCT
    ================================================== */

    public function addProduct()
    {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            $this->redirectToProducts();
        }


        /*
         * Receive Form Data
         */

        $productName = trim($_POST['productName'] ?? "");
        $club        = trim($_POST['club'] ?? "");
        $edition     = trim($_POST['edition'] ?? "");
        $price       = trim($_POST['price'] ?? "");
        $stock       = trim($_POST['stock'] ?? "");
        $image       = trim($_POST['image'] ?? "");


        /*
         * Validation
         */

        if ($productName === "")
        {
            $this->redirectWithMessage(
                "product",
                "Product name is required."
            );
        }


        if ($club === "")
        {
            $this->redirectWithMessage(
                "product",
                "Club name is required."
            );
        }


        if ($edition === "")
        {
            $this->redirectWithMessage(
                "product",
                "Edition is required."
            );
        }


        if ($price === "" || !is_numeric($price) || $price < 0)
        {
            $this->redirectWithMessage(
                "product",
                "Please enter a valid price."
            );
        }


        if (
            $stock === "" ||
            filter_var($stock, FILTER_VALIDATE_INT) === false ||
            intval($stock) < 0
        )
        {
            $this->redirectWithMessage(
                "product",
                "Stock must be a valid number greater than or equal to 0."
            );
        }


        /*
         * Database Connection
         */

        $database   = new db();
        $connection = $database->connection();


        /*
         * Escape Values
         */

        $productName = $connection->real_escape_string($productName);
        $club        = $connection->real_escape_string($club);
        $edition     = $connection->real_escape_string($edition);
        $price       = floatval($price);
        $stock       = intval($stock);
        $image       = $connection->real_escape_string($image);


        /*
         * Insert Product
         */

        $sql = "INSERT INTO Products
                (ProductName, Club, Edition, Price, Stock, Image)
                VALUES
                (
                    '$productName',
                    '$club',
                    '$edition',
                    '$price',
                    '$stock',
                    '$image'
                )";


        if ($connection->query($sql))
        {
            $this->redirectWithMessage(
                "product",
                "Product added successfully."
            );
        }
        else
        {
            $this->redirectWithMessage(
                "product",
                "Failed to add product."
            );
        }
    }


    /* ==================================================
                    UPDATE PRODUCT
    ================================================== */

    public function updateProduct()
    {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            $this->redirectToProducts();
        }


        $productId   = intval($_POST['productId'] ?? 0);

        $productName = trim($_POST['productName'] ?? "");
        $club        = trim($_POST['club'] ?? "");
        $edition     = trim($_POST['edition'] ?? "");
        $price       = trim($_POST['price'] ?? "");
        $stock       = trim($_POST['stock'] ?? "");
        $image       = trim($_POST['image'] ?? "");


        /*
         * Validate Product ID
         */

        if ($productId <= 0)
        {
            $this->redirectWithMessage(
                "product",
                "Invalid product ID."
            );
        }


        /*
         * Validate Product Name
         */

        if ($productName === "")
        {
            $this->redirectWithMessage(
                "product",
                "Product name is required."
            );
        }


        /*
         * Validate Club
         */

        if ($club === "")
        {
            $this->redirectWithMessage(
                "product",
                "Club name is required."
            );
        }


        /*
         * Validate Edition
         */

        if ($edition === "")
        {
            $this->redirectWithMessage(
                "product",
                "Edition is required."
            );
        }


        /*
         * Validate Price
         */

        if ($price === "" || !is_numeric($price) || $price < 0)
        {
            $this->redirectWithMessage(
                "product",
                "Invalid price."
            );
        }


        /*
         * Validate Stock
         */

        if (
            $stock === "" ||
            filter_var($stock, FILTER_VALIDATE_INT) === false ||
            intval($stock) < 0
        )
        {
            $this->redirectWithMessage(
                "product",
                "Invalid stock value."
            );
        }


        $database   = new db();
        $connection = $database->connection();


        /*
         * Escape Values
         */

        $productName = $connection->real_escape_string($productName);
        $club        = $connection->real_escape_string($club);
        $edition     = $connection->real_escape_string($edition);
        $image       = $connection->real_escape_string($image);

        $price = floatval($price);
        $stock = intval($stock);


        /*
         * Update Product
         */

        $sql = "UPDATE Products
                SET
                    ProductName = '$productName',
                    Club = '$club',
                    Edition = '$edition',
                    Price = '$price',
                    Stock = '$stock',
                    Image = '$image'
                WHERE ProductID = $productId";


        if ($connection->query($sql))
        {
            $this->redirectWithMessage(
                "product",
                "Product updated successfully."
            );
        }
        else
        {
            $this->redirectWithMessage(
                "product",
                "Failed to update product."
            );
        }
    }


    /* ==================================================
                    DELETE PRODUCT
    ================================================== */

    public function deleteProduct()
    {
        $this->checkAdmin();

        $productId = intval($_POST['productId'] ?? 0);


        if ($productId <= 0)
        {
            $this->redirectWithMessage(
                "product",
                "Invalid product ID."
            );
        }


        $database   = new db();
        $connection = $database->connection();


        /*
         * Check Product Exists
         */

        $result = $database->getProductById(
            $connection,
            $productId
        );


        if (!$result || $result->num_rows === 0)
        {
            $this->redirectWithMessage(
                "product",
                "Product not found."
            );
        }


        /*
         * Delete Product
         */

        $sql = "DELETE FROM Products
                WHERE ProductID = $productId";


        if ($connection->query($sql))
        {
            $this->redirectWithMessage(
                "product",
                "Product deleted successfully."
            );
        }
        else
        {
            $this->redirectWithMessage(
                "product",
                "Unable to delete product."
            );
        }
    }


    /* ==================================================
                    MANAGE ORDERS
    ================================================== */

    public function manageOrders()
    {
        $this->checkAdmin();

        $database   = new db();
        $connection = $database->connection();


        /*
         * Search Available Products
         */

        if (
            isset($_GET['order_search']) &&
            trim($_GET['order_search']) !== ""
        )
        {
            $search = trim($_GET['order_search']);

            $products = $database->searchProducts(
                $connection,
                $search
            );
        }
        else
        {
            $products = $database->getAllProducts(
                $connection
            );
        }


        /*
         * Only Available Products
         *
         * Stock > 0
         */

        $availableProducts = array();

        if ($products)
        {
            while ($row = $products->fetch_assoc())
            {
                if (intval($row['Stock']) > 0)
                {
                    $availableProducts[] = $row;
                }
            }
        }


        /*
         * Get Order Count
         */

        $orderResult = $connection->query(
            "SELECT COUNT(*) AS total
             FROM orders"
        );

        $totalOrders = 0;

        if ($orderResult)
        {
            $orderRow = $orderResult->fetch_assoc();

            $totalOrders = intval(
                $orderRow['total']
            );
        }


        $totalProducts = 0;

        $productResult = $connection->query(
            "SELECT COUNT(*) AS total
             FROM Products"
        );

        if ($productResult)
        {
            $productRow = $productResult->fetch_assoc();

            $totalProducts = intval(
                $productRow['total']
            );
        }


        $availableCount = count($availableProducts);


        require __DIR__ . "/../View/Admin/manageorder.php";
    }


    /* ==================================================
                    PLACE ORDER
    ================================================== */

    public function placeOrder()
    {
        $this->checkAdmin();


        $productId = intval(
            $_POST['product_id'] ?? 0
        );

        $quantity = intval(
            $_POST['quantity'] ?? 0
        );


        /*
         * Validate Product
         */

        if ($productId <= 0)
        {
            $this->redirectWithMessage(
                "order",
                "Invalid product."
            );
        }


        /*
         * Validate Quantity
         */

        if ($quantity <= 0)
        {
            $this->redirectWithMessage(
                "order",
                "Quantity must be greater than 0."
            );
        }


        $database   = new db();
        $connection = $database->connection();


        /*
         * Get Product
         */

        $result = $database->getProductById(
            $connection,
            $productId
        );


        if (!$result || $result->num_rows === 0)
        {
            $this->redirectWithMessage(
                "order",
                "Product not found."
            );
        }


        $product = $result->fetch_assoc();


        /*
         * Check Stock
         */

        $stock = intval($product['Stock']);


        if ($stock <= 0)
        {
            $this->redirectWithMessage(
                "order",
                "This product is out of stock."
            );
        }


        if ($quantity > $stock)
        {
            $this->redirectWithMessage(
                "order",
                "Requested quantity is greater than available stock."
            );
        }


        /*
         * Product Price
         */

        $unitPrice = floatval(
            $product['Price']
        );

        $productTotal = $unitPrice * $quantity;


        /*
         * Admin Order Information
         *
         * These values are used because this
         * dashboard is directly placing the order.
         */

        $orderData = array(

            "customername"   => "Admin",

            "phone"          => "",

            "billingaddress" => "Admin Order",

            "deliveryarea"   => "Admin",

            "deliverycharge" => 0,

            "producttotal"   => $productTotal

        );


        /*
         * Create Order
         */

        $orderId = $database->createOrder(
            $connection,
            $orderData
        );


        /*
         * Add Order Item
         */

        $database->addOrderItem(
            $connection,
            $orderId,
            $productId,
            $quantity,
            $unitPrice
        );


        /*
         * Reduce Product Stock
         */

        $database->reduceStock(
            $connection,
            $productId,
            $quantity
        );


        /*
         * Success
         */

        $this->redirectWithMessage(
            "order",
            "Order placed successfully. Order ID: " . $orderId
        );
    }


    /* ==================================================
                    ADMIN ACCESS CHECK
    ================================================== */

    private function checkAdmin()
    {
        if (
            !isset($_SESSION['user_type']) ||
            $_SESSION['user_type'] !== 'admin'
        )
        {
            header(
                "Location: ../index.php?page=login"
            );

            exit();
        }
    }


    /* ==================================================
                    PRODUCT REDIRECT
    ================================================== */

    private function redirectToProducts()
    {
        header(
            "Location: ../index.php?page=manage-products"
        );

        exit();
    }


    /* ==================================================
                    MESSAGE REDIRECT
    ================================================== */

    private function redirectWithMessage(
        $page,
        $message
    )
    {
        $message = urlencode($message);

        if ($page === "product")
        {
            header(
                "Location: ../index.php?page=manage-products&message=" . $message
            );
        }
        else
        {
            header(
                "Location: ../index.php?page=manage-orders&message=" . $message
            );
        }

        exit();
    }

}


/* ==================================================
                REQUEST HANDLER
================================================== */

session_start();

$adminController = new AdminController();


/*
 * Add Product
 */

if (isset($_POST['add_product']))
{
    $adminController->addProduct();
}


/*
 * Update Product
 */

elseif (isset($_POST['update_product']))
{
    $adminController->updateProduct();
}


/*
 * Delete Product
 */

elseif (isset($_POST['delete_product']))
{
    $adminController->deleteProduct();
}


/*
 * Place Order
 */

elseif (isset($_POST['place_order']))
{
    $adminController->placeOrder();
}


/*
 * Search Product
 */

elseif (isset($_GET['search']))
{
    $adminController->manageProducts();
}


/*
 * Search Order Products
 */

elseif (isset($_GET['order_search']))
{
    $adminController->manageOrders();
}


/*
 * Default
 */

else
{
    header(
        "Location: ../index.php?page=admin-dashboard"
    );

    exit();
}

?>