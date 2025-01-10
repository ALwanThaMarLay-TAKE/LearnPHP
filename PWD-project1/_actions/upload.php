<?php 
$error = $_FILES["photo"]["error"];
$tmp = $_FILES["photo"]["tmp_name"];
$type = $_FILES['photo']['type'];

if($error) {
    header('location: ../profile.php?error=file');
    exit();
    }
    
if($type === "image/png" or $type === 'image/jpeg'){

    move_uploaded_file($tmp , 'photos/profile.png');
    header("location: ../profile.php");
}else{
    header("location: ../profile.php?error=type");
    
}