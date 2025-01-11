<?php

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MYSQL;
use Libs\Database\UsersTable;

include "../vendor/autoload.php";
$auth = Auth::check();
$id = $_GET['id'];
$table = new UsersTable(new MYSQL);
$table->suspend($id);
HTTP::redirect("/admin.php");