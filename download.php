<?php
session_start();

require_once 'functions.php';
require_once 'connections.php';



$order_id = ($_SESSION['downloadnum']);

		if ($_GET['download'] == $order_id) {
		
		$polis_array = get_polis($order_id, $link);
		$clients_array = get_clients($order_id, $link);
		
		require_once 'make_pdf.php';
		}
else echo "you are not logged";
exit();
?>
