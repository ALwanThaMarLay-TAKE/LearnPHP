<?php

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MYSQL;
use Libs\Database\UsersTable;

include "../vendor/autoload.php";
$auth = Auth::check();
$table = new UsersTable(new MYSQL);
$id = $_GET['id'];
$table->delete($id);
HTTP::redirect("/admin.php");