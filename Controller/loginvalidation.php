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
        $name     = trim($_POST["name"] ?? "");
        $password = trim($_POST["password"] ?? "");
        $remember = isset($_POST["remember"]) && $_POST["remember"] == "1";

        $message = "";
        $valid   = true;

        if (empty($name) || strlen($name) < 5)
        {
            $message .= "Username must be at least 5 characters. ";
            $valid = false;
        }

        if (empty($password) || strlen($password) < 5)
        {
            $message .= "Password must be at least 5 characters.";
            $valid = false;
        }

        if (!$valid)
        {
            $activeTab = "login";

            require __DIR__ . "/../View/Auth/index.php";

            return;
        }

        $database   = new db();
        $connection = $database->connection();

        $result = $database->signin($connection, "users", $name, $password);

        if ($result && $result->num_rows > 0)
        {
            $row = $result->fetch_assoc();

            $_SESSION["login"]    = true;
            $_SESSION["username"] = $row["Username"];

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

            if ($remember)
            {
                setcookie("remember_user", $name, time() + 60 * 60 * 24 * 7, "/");
            }
            else
            {
                setcookie("remember_user", "", time() - 3600, "/");
            }

            if ($_SESSION["user_type"] == "admin")
            {
                header("Location: index.php?page=admin-dashboard");
            }
            elseif ($_SESSION["user_type"] == "deliveryman")
            {
                header("Location: index.php?page=delivery-dashboard");
            }
            else
            {
                header("Location: index.php");
            }

            exit();
        }
        else
        {
            $message   = "Invalid name or password!";
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

        setcookie("remember_user", "", time() - 3600, "/");

        header("Location: index.php?page=login");
        exit();
    }

}

?>
