<?php

session_start();

require_once "Controller/CartController.php";

$controller = new CartController();

if (isset($_POST['addcart']))
{
    $controller->add();
}
elseif (isset($_POST['checkout']))
{
    $controller->checkout();
}
elseif (isset($_GET['increase']))
{
    $controller->increase($_GET['increase']);
}
elseif (isset($_GET['decrease']))
{
    $controller->decrease($_GET['decrease']);
}
elseif (isset($_GET['remove']))
{
    $controller->remove($_GET['remove']);
}
else
{
    $controller->view();
}

?>
