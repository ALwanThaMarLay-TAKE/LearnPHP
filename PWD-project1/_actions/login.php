<?php 
session_start();
$email = $_POST["email"];
$password = $_POST['password'];
if($email === "take@gmail.com" and $password === '1234'){
    $_SESSION['user'] = [ 'userName' => "takemachi"];
    header("location: ../profile.php"); 
    exit();
}else{
    header('location: ../index.php?incorrect=1 ');
    exit();
    
}