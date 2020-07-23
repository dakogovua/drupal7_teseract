<?php
require_once '../includes/connection.php';
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'aaaclients';
$table2 = 'aaapolis';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'id', 'dt' => 0 ),
	array( 'db' => 'nomerpolisa',  'dt' => 1 ),
	array( 'db' => 'name',   'dt' => 2 ),
	array( 'db' => 'sirname',     'dt' => 3 ),
	array( 'db' => 'date_birth',     'dt' => 4 ),
	array( 'db' => 'inn',     'dt' => 5 ),
	array( 'db' => 'passport',     'dt' => 6 ),
	array( 'db' => 'email',     'dt' => 7 ),
	array( 'db' => 'phone',     'dt' => 8 ),
	array( 'db' => 'date_zapisi',     'dt' => 9 ),
	array( 'db' => 'idpolis',     'dt' => 10 ),
	array( 'db' => 'days',     'dt' => 11 ),
	array( 'db' => 'dateStart',     'dt' => 12 ),
	array( 'db' => 'dateStop',     'dt' => 13 ),
	array( 'db' => 'franshiza',     'dt' => 14 ),
	array( 'db' => 'terittory',     'dt' => 15 ),
	array( 'db' => 'type',     'dt' => 16 ),
	array( 'db' => 'sum_complex',     'dt' => 17 ),
	array( 'db' => 'currency',     'dt' => 18 ),
	array( 'db' => 'sum_accident',     'dt' => 19 ),
	array( 'db' => 'oplata',     'dt' => 20 ),
	array( 'db' => 'transaction_id',     'dt' => 21),
	array( 'db' => 'tariff',     'dt' => 22 ),
	array( 'db' => 'sales',     'dt' => 23 ),
	array( 'db' => 'SPzag',     'dt' => 24 ),
	array( 'db' => 'SPnv',     'dt' => 25 ),
	array( 'db' => 'SPtr',     'dt' => 26 ),
	array( 'db' => 'nonrezident',     'dt' => 27 ),


/*	array(
		'db'        => 'start_date',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return date( 'jS M y', strtotime($d));
		}
	),
	array(
		'db'        => 'salary',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return '$'.number_format($d);
		}
	)*/

);

// SQL server connection information
/* $sql_details = array(
	'user' => 'drda01_voyo',
	'pass' => '8kdp42te',
	'db'   => 'drda01_voyo',
	'host' => 'drda01.mysql.ukraine.com.ua'
); */

$sql_details = array(
	'user' => $db_user,
	'pass' => $db_password,
	'db'   => $db_base,
	'host' => $db_host
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $table2, $primaryKey, $columns )
);


