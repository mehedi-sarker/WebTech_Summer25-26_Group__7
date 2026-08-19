<?php
session_start();
$name="";
$email="";
$password="";
$confirm_password="";
$address="";
$message="";
$remember=false;
 
if(isset($_COOKIE["remember_user"])){
    $name=$_COOKIE["remember_user"];
}
 
if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name=trim($_POST["name"] ?? "");
        $email=trim($_POST["email"] ?? "");
        $password=trim($_POST["password"] ?? "");
        $confirm_password=trim($_POST["confirm_password"] ?? "");
        $address=trim($_POST["address"] ?? ""); 
        $remember=isset($_POST["remember"]) && $_POST["remember"] == "1";
 
        $valid=true;
 
        if(empty($name)){
            $valid=false;
        }
        if(empty($email)){
            $valid=false;
        }
        if(empty($password)){
            $valid=false;
        }
        if(empty($confirm_password)){
            $valid=false;
        }
        if(empty($address)){
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
                 $jsonfile="../Model/user.json";
        $users=[];
        if(file_exists($jsonfile)){
            $jsonData=file_get_contents($jsonfile);
            $users = json_decode($jsonData, true) ?? [];
            $users []=[
                'username' =>$name,
                'email' =>$email,
                'password' =>$password,
                'confirm_password' =>$confirm_password,
                'address' =>$address,
                'timestamp' => time()
            ];
        file_put_contents($jsonfile, json_encode($users, JSON_PRETTY_PRINT));
        }
            }
            
    }
?>
 