<?php
$db_host='localhost';
$db_user='travel';
$db_base='travel';
$db_password='TRAVELroot23';

$public_key = 'i61109306451';
$private_key = 'fXeKlQQQeYgH3ZR5s7CEez8XW2UnMkPHE4Y7XNqV';

$date = date("Y-m-d H:i:s");
$link = mysqli_connect($db_host, $db_user, $db_password, $db_base);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


//mysqli_connect($db_host, $db_user, $db_password) or die("Could not connect to $db_host");
//mysqli_select_db($db_base) or die ("Could not select $db_base database in connections.php!");
mysqli_query($link, "SET NAMES utf8");



?>