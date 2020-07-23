<?php 
ini_set('display_errors','On');
error_reporting('E_ALL');

require_once 'functions.php';
require_once 'LiqPay/LiqPay.php';
require_once 'connections.php';
require_once 'tesseract/tesseract.php';

$var_array = get_var();

$SPzag = $var_array["var_array"]['SPzag'];

$orderid=time()."-".rand(1, 9);


// $public_key = 'i69930799562'; //Anton
//$public_key = 'i61109306451';
// $private_key = 'rRZfFUKEnYTzXG0pgadJRKCdiQr9OAeW0au5gtAH'; //koss
//$private_key = 'fXeKlQQQeYgH3ZR5s7CEez8XW2UnMkPHE4Y7XNqV';

$liqpay = new LiqPay($public_key, $private_key);


$html = $liqpay->cnb_form(array(
'action'         => 'pay',
'amount'         => $SPzag,
'currency'       => 'UAH',
'description'    => 'Оплата за поліс '.$orderid,
'order_id'       => $orderid,
'version'        => '3',
'sandbox'        => '1',
));

//echo $html; //выводим форму ликпея


new_insert($var_array, $orderid, $link);
 
////////////////////////////////////////////////////////////
	echo "<hr>";
	kossfiles ($orderid, $link); //Функция обрабатывает файлы и вызывает тессеракт
	echo "<hr>";

///////////////////////////////////////////////////////////

// print_r($_FILES);
 print_r($_POST);

?>