<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

define("UPLOAD_DIR", "./upload/");
require_once("utils/functions.php");
require_once('db/database.php');
$dbh = new DatabaseHelper("localhost", "root", "", "traintrack", 3306);
?>