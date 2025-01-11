<?php
include "../vendor/autoload.php";

use Helpers\HTTP;
use Libs\Database\MYSQL;
use Libs\Database\UsersTable;

session_start();
$email = $_POST["email"];
$password = $_POST['password'];
$table = new UsersTable(new MYSQL);

$user = $table->findByEmailAndPassword($email, $password);
if ($user) {
    if ($user->suspensed) {
        HTTP::redirect('/index.php', "suspensed=1");
    }
    $_SESSION["user"] = $user;
    HTTP::redirect("/profile.php");
} else {
    HTTP::redirect("/index.php", "incorrect=1");
}
