<?php

require_once __DIR__ . "/../Models/database.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


class signupvalidation
{

    /*=========================
            SHOW SIGNUP
    =========================*/

    public function showSignup()
    {
        $activeTab = "signup";

        require __DIR__ . "/../View/Auth/index.php";
    }


    /*=========================
              SIGNUP
    =========================*/

    public function signup()
    {
        $name             = trim($_POST["name"] ?? "");
        $password         = trim($_POST["password"] ?? "");
        $confirm_password = trim($_POST["confirm_password"] ?? "");

        $valid = true;

        if (empty($name))
        {
            $valid = false;
        }

        if (empty($password) || strlen($password) < 8)
        {
            $valid = false;
        }

        if (empty($confirm_password) || $confirm_password !== $password)
        {
            $valid = false;
        }

        if (!$valid)
        {
            $message   = "Please fill every field correctly (password needs 8+ characters, and must match).";
            $activeTab = "signup";

            require __DIR__ . "/../View/Auth/index.php";

            return;
        }

        $database   = new db();
        $connection = $database->connection();

        if ($database->usernameExists($connection, $name))
        {
            $message   = "That username is already taken.";
            $activeTab = "signup";

            require __DIR__ . "/../View/Auth/index.php";

            return;
        }

        $result = $database->signup($connection, $name, $password, "Customer");

        if ($result)
        {
            $_SESSION["login"]     = true;
            $_SESSION["username"]  = $name;
            $_SESSION["user_type"] = "customer";

            header("Location: index.php");
            exit();
        }
        else
        {
            $message   = "Sign up failed, please try again.";
            $activeTab = "signup";

            require __DIR__ . "/../View/Auth/index.php";
        }
    }

}

?>