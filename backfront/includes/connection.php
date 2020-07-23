<?php
//require("../../connections.php");
require_once $_SERVER['DOCUMENT_ROOT'].'/sites/all/modules/travel/connections.php';
//echo "ok";

$con = mysqli_connect($db_host, $db_user, $db_password, $db_base);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/*
$con = mysql_connect(DB_SERVER,DB_USER, DB_USER) or die(mysql_error().". Set credentials to DB");
	mysql_select_db(DB_NAME) or die("Cannot select DB");
echo "ok";
*/
	?>