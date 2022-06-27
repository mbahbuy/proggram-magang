<?php require_once 'Constant.php'; $conn = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );

$data = file_get_contents( "php://input" );
$data = json_decode( $data, true );
var_dump( $data['pelanggan'] );