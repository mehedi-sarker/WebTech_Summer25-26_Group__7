<?php
require_once __DIR__ . "/../Models/database.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$name = "";
$password = "";
$message = "";
$remember = false;

if(isset($_COOKIE["remember_user"]))
{
    $name = $_COOKIE["remember_user"];
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = trim($_POST["name"] ?? "");
    $password = trim($_POST["password"] ?? "");

    $remember = isset($_POST["remember"]) && $_POST["remember"] == "1";

    $valid = true;

    if(empty($name))
    {
        $valid = false;
    }

    if(empty($password))
    {
        $valid = false;
    }

    if($valid)
    {
        $jsonfile = "../Model/user.json";

        $login_success = false;

        if(file_exists($jsonfile))
        {
            $jsonData = file_get_contents($jsonfile);
            $users = json_decode($jsonData, true) ?? [];

            foreach($users as $user)
            {
                if($user["name"] == $name && $user["password"] == $password)
                {
                    $login_success = true;

                    $_SESSION["login"] = true;
                    $_SESSION["username"] = $user["username"];

                    $message = "Login successful! Welcome, " . $user["username"] . "!";

                    if($remember)
                    {
                        setcookie(
                            "remember_user",
                            $name,
                            time() + 60*60*24*7,
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

                    break;
                }
            }

            if(!$login_success)
            {
                $message = "Invalid name or password!";
            }
        }
        else
        {
            $message = "User file not found!";
        }
    }
}
?>