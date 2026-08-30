<?php
require_once __DIR__ . "/../Models/database.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = trim($_POST["name"] ?? "");
    $new_password = trim($_POST["new_password"] ?? "");
    $confirm_password = trim($_POST["confirm_password"] ?? "");

    $valid = true;

    if (empty($username) || empty($new_password) || empty($confirm_password)) {
        $message = "All fields are required";
        $valid = false;
    }
    else if (strlen($new_password) < 5) {
        $message = "New password must be at least 5 characters";
        $valid = false;
    }
    else if ($new_password !== $confirm_password) {
        $message = "New password and confirm password do not match";
        $valid = false;
    }

    if ($valid)
    {
        $database = new db();
        $connection = $database->connection();

        if ($database->usernameExists($connection, $username))
        {
            $database->changePassword($connection, $username, $new_password);
            $message = "Password reset successfully. You can now log in.";
        }
        else
        {
            $message = "Username not found";
        }
    }
}
?>