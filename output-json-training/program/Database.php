<?php require_once 'Constant.php'; $conn = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );

$data = file_get_contents( "php://input" );
$data = json_decode( $data, true );

$sumtimer = $data['trainingStart'] + $data['trainingTime'] - 01;
if( $sumtimer <= 12 ){
    $timeEnd = $sumtimer;
    $options = 0;
} else {
    $timeEnd = $sumtimer - 12;
    $options = 1;
}

if( $data['trainingStart'] < date('n')  ) {
    $option = 1;
} else {
    $option = 0;
}

$datastart = date( '01-' . $data['trainingStart'] . '-20' . 'y' );
$dataend = '30-' .
    $timeEnd
    . "-20" . (date( 'y' ) + $options + $option) 
;

$sql = "INSERT INTO book( user_token, produk_id, book_timer, book_start, book_end)
        VALUES (
            '$data[pelanggan]',
            '$data[training]',
            '$data[trainingTime]',
            '$datastart',
            '$dataend'
        )
";

if( $conn->query( $sql ) === true ) {
    echo 'Data booking sudah tersimpan. silahkan melakukan pembayaran';
} else {
    echo 'Data gagal dimuat. Coba periksa dan lengkapi data yg dibutuhkan';
}