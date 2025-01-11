<?php
include "../vendor/autoload.php";

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MYSQL;
use Libs\Database\UsersTable;

$auth = Auth::check();
$table = new UsersTable(new MYSQL);

$error = $_FILES["photo"]["error"];
$tmp = $_FILES["photo"]["tmp_name"];
$type = $_FILES['photo']['type'];
$name = $_FILES['photo']['name'];

if ($error) {
    HTTP::redirect('/index.php', "error=file");
}

if ($type === "image/png" or $type === 'image/jpeg') {

    $table->updatePhoto($auth->id, $name);
    move_uploaded_file($tmp , "photos/$name");
    $auth->photo = $name;
    HTTP::redirect("/profile.php");
} else {
    HTTP::redirect("/profile.php", "error=type");
}