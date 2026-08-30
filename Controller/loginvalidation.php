<?php

require_once __DIR__ . "/../Models/database.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


class loginvalidation
{

    /*=========================
            SHOW LOGIN
    =========================*/

    public function showLogin()
    {
        $activeTab = "login";

        require __DIR__ . "/../View/Auth/index.php";
    }


    /*=========================
              LOGIN
    =========================*/

    public function login()
    {

        $name = trim($_POST["name"] ?? "");

        $password = trim($_POST["password"] ?? "");

        $remember = isset($_POST["remember"]) &&
                    $_POST["remember"] == "1";


        $valid = true;


        if (empty($name))
        {
            $valid = false;
        }


        if (empty($password))
        {
            $valid = false;
        }


        if (!$valid)
        {

            $message = "Please enter name and password.";

            $activeTab = "login";

            require __DIR__ . "/../View/Auth/index.php";

            return;
        }


        /*=========================
              DATABASE LOGIN
        =========================*/

        $database = new db();

        $connection = $database->connection();


        $result = $database->signin(
            $connection,
            $name,
            $password
        );


        /*=========================
          CHECK LOGIN RESULT
        =========================*/

        if ($result && $result->num_rows > 0)
        {

            $row = $result->fetch_assoc();


            $_SESSION["login"] = true;

            $_SESSION["username"] = $row["Username"];


            /*=========================
                  CHECK USER ROLE
            =========================*/

            if ($row["Role"] == "Admin")
            {
                $_SESSION["user_type"] = "admin";
            }

            elseif ($row["Role"] == "DeliveryMan")
            {
                $_SESSION["user_type"] = "deliveryman";
            }

            else
            {
                $_SESSION["user_type"] = "customer";
            }


            /*=========================
                REMEMBER ME
            =========================*/

            if ($remember)
            {

                setcookie(
                    "remember_user",
                    $name,
                    time() + 60 * 60 * 24 * 7,
                    "/"
                );

            }

            else
            {

                setcookie(
                    "remember_user",
                    "",
                    time() - 3600,
                    "/"
                );

            }


            /*=========================
                  REDIRECT BY ROLE
            =========================*/

            if ($_SESSION["user_type"] == "admin")
            {

                header(
                    "Location: index.php?page=admin-dashboard"
                );

            }

            elseif ($_SESSION["user_type"] == "deliveryman")
            {

                header(
                    "Location: index.php?page=delivery-dashboard"
                );

            }

            else
            {

                header(
                    "Location: index.php"
                );

            }


            exit();

        }


        /*=========================
              LOGIN FAILED
        =========================*/

        else
        {

            $message = "Invalid name or password!";

            $activeTab = "login";

            require __DIR__ . "/../View/Auth/index.php";

        }

    }


    /*=========================
              LOGOUT
    =========================*/

    public function logout()
    {

        $_SESSION = array();

        session_destroy();


        setcookie(
            "remember_user",
            "",
            time() - 3600,
            "/"
        );


        header(
            "Location: index.php?page=login"
        );

        exit();

    }

}

?>