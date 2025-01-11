<?php

use Helpers\HTTP;
use Libs\Database\MYSQL;
use Libs\Database\UsersTable;

include "../vendor/autoload.php";
$data = [
    "name" => $_POST['name'] ?? "Unknown",
    "email" => $_POST['email'] ?? "Unknown",
    "phone" => $_POST['phone'] ?? "Unknown",
    "address" => $_POST['address'] ?? "Unknown",
    "password" =>  password_hash($_POST['password'] , PASSWORD_BCRYPT) ?? "Unknown",
    "role_id" => 1,
];

$table = new UsersTable(new MYSQL);
if (isset($table)) {

    $table->insert($data);
    HTTP::redirect("/index.php", "registered=true");
} else {
    HTTP::redirect("/register.php", "error=true");
}