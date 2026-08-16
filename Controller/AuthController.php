<?php

require_once __DIR__ . "/../Models/database.php";


class AuthController
{

    /* =========================
            SHOW LOGIN FORM
    ========================= */

    public function showLogin()
    {
        $error = isset($_GET['error']) ? $_GET['error'] : null;

        require __DIR__ . "/../View/Auth/login.php";
    }


    /* =========================
            SHOW SIGNUP FORM
    ========================= */

    public function showSignup()
    {
        $error = isset($_GET['error']) ? $_GET['error'] : null;

        require __DIR__ . "/../View/Auth/signup.php";
    }


    /* =========================
                LOGIN
    ========================= */

    public function login()
    {
        $role     = $_POST['role'];
        $username = trim($_POST['userid']);
        $password = $_POST['password'];

        $tablename = ($role == "customer") ? "customers" : "staff";

        $database   = new db();
        $connection = $database->connection();

        $result = $database->signin($connection, $tablename, $username, $password);

        if ($result && $result->num_rows > 0)
        {
            $row = $result->fetch_assoc();

            if ($role == "customer")
            {
                $_SESSION['user_type'] = "customer";
            }
            else
            {
                $_SESSION['user_type'] = ($row['Role'] == "Admin") ? "admin" : "deliveryman";
            }

            $_SESSION['username'] = $row['Username'];

            if ($_SESSION['user_type'] == "admin")
            {
                Header("Location: index.php?page=admin-dashboard");
            }
            elseif ($_SESSION['user_type'] == "deliveryman")
            {
                Header("Location: index.php?page=delivery-dashboard");
            }
            else
            {
                Header("Location: index.php");
            }
        }
        else
        {
            Header("Location: index.php?page=login&error=Invalid username or password");
        }

        exit();
    }


    /* =========================
                SIGNUP
    ========================= */

    public function signup()
    {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $confirm  = $_POST['confirm_password'];

        if ($password !== $confirm)
        {
            Header("Location: index.php?page=signup&error=Passwords do not match");
            exit();
        }

        $database   = new db();
        $connection = $database->connection();

        if ($database->usernameExists($connection, "customers", $username))
        {
            Header("Location: index.php?page=signup&error=Username already taken");
            exit();
        }

        $result = $database->signup($connection, "customers", $username, $password);

        if ($result)
        {
            $_SESSION['user_type'] = "customer";
            $_SESSION['username']  = $username;

            Header("Location: index.php");
        }
        else
        {
            Header("Location: index.php?page=signup&error=Please try again");
        }

        exit();
    }


    /* =========================
                LOGOUT
    ========================= */

    public function logout()
    {
        session_unset();
        session_destroy();

        Header("Location: index.php?page=login");
        exit();
    }

}

?>
