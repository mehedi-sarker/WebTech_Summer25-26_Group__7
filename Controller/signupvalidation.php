<?php
require_once __DIR__ . "/../Models/database.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$name="";
$password="";
$confirm_password="";
$message="";
$remember=false;
 
if(isset($_COOKIE["remember_user"])){
    $name=$_COOKIE["remember_user"];
}
 
if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name=trim($_POST["name"] ?? "");
        $password=trim($_POST["password"] ?? "");
        $confirm_password=trim($_POST["confirm_password"] ?? "");
        $remember=isset($_POST["remember"]) && $_POST["remember"] == "1";
 
        $valid=true;
 
        if(empty($name)){
            $valid=false;
        }
        if(empty($password)){
            $valid=false;
        }
        if(empty($confirm_password)){
            $valid=false;
        }
        if(empty($confirm_password) || $confirm_password !== $password){
            $valid=false;
        }
        if($valid)
            {
                $_SESSION["sign_up"]=true;
                $_SESSION["username"]=$name;
                $message="Sign up successful! Session created! Welcome, $name!";
 
                if($remember){
                    setcookie("remember_user", $name, time() + 60*60*24*7, "/");
                }
                else{
                    setcookie("remember_user", "", time() - 3600, "/");
                }
                 
        }
            }
            
?>
 