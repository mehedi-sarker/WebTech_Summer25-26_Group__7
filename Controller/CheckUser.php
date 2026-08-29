<?php
include __DIR__ . "/../Models/database.php";
$username=$_POST["username"] ?? "";
if(!$username)
    {
        echo "Username Required";
    }
    else{
        $database= new db();
        $connection=$database->connection();
        if($database->usernameExists($connection, $username))
            {
                echo "UserName Already Taken";
            }
            else{
                echo "User Name Available";
            }
    }
?>