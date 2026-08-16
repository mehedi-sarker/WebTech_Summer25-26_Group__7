<?php

session_start();

require_once "Controller/ProductController.php";
require_once "Controller/CartController.php";
require_once "Controller/AuthController.php";


/* ==============================================
        FIGURE OUT WHICH PAGE TO SHOW
   ============================================== */

$page = isset($_GET['page']) ? $_GET['page'] : 'home';


switch ($page)
{

    /* ---------- HOME ---------- */

    case 'home':

        $productController = new ProductController();

        $products = $productController->latestProducts();

        require "View/Home/index.php";

        break;


    /* ---------- PRODUCTS LIST / SEARCH ---------- */

    case 'products':

        $productController = new ProductController();

        $productController->index();

        break;


    /* ---------- PRODUCT DETAILS ---------- */

    case 'productdetails':

        $productController = new ProductController();

        $productController->details($_GET['id']);

        break;


    /* ---------- ABOUT US ---------- */

    case 'about':

        require "View/About/index.php";

        break;


    /* ---------- CART / CHECKOUT ---------- */

    case 'cart':

        $cartController = new CartController();

        if (isset($_POST['addcart']))
        {
            $cartController->add();
        }
        elseif (isset($_POST['checkout']))
        {
            $cartController->checkout();
        }
        elseif (isset($_GET['increase']))
        {
            $cartController->increase($_GET['increase']);
        }
        elseif (isset($_GET['decrease']))
        {
            $cartController->decrease($_GET['decrease']);
        }
        elseif (isset($_GET['remove']))
        {
            $cartController->remove($_GET['remove']);
        }
        else
        {
            $cartController->view();
        }

        break;


    /* ---------- LOGIN ---------- */

    case 'login':

        $authController = new AuthController();

        if (isset($_POST['login']))
        {
            $authController->login();
        }
        else
        {
            $authController->showLogin();
        }

        break;


    /* ---------- SIGNUP ---------- */

    case 'signup':

        $authController = new AuthController();

        if (isset($_POST['signup']))
        {
            $authController->signup();
        }
        else
        {
            $authController->showSignup();
        }

        break;


    /* ---------- LOGOUT ---------- */

    case 'logout':

        $authController = new AuthController();

        $authController->logout();

        break;


    /* ---------- ADMIN DASHBOARD ---------- */

    case 'admin-dashboard':

        if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin')
        {
            header("Location: index.php?page=login");
            exit();
        }

        require "View/Admin/dashboard.php";

        break;


    /* ---------- DELIVERY DASHBOARD ---------- */

    case 'delivery-dashboard':

        if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'deliveryman')
        {
            header("Location: index.php?page=login");
            exit();
        }

        require "View/Delivery/dashboard.php";

        break;


    /* ---------- ORDER SUCCESS ---------- */

    case 'ordersuccess':

        $orderId = isset($_GET['order']) ? intval($_GET['order']) : null;

        require "View/Order/success.php";

        break;


    /* ---------- UNKNOWN PAGE ---------- */

    default:

        header("Location: index.php");
        exit();

}

?>
