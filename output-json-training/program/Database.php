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

// Token pendaftaran
$dataToken = hash( 'sha256', $data['pelanggan'] . md5( date( 'Y-m-d' ) ) );

// Checking DB
$checksql = $conn->query("SELECT *
            FROM book
            WHERE (
                user_token = '$data[pelanggan]'
                AND
                produk_id = '$data[training]'
                AND
                book_payment = 2
                )
                AND
                (
                    ( 
                        book_start
                        BETWEEN
                        '$datastart'
                        AND
                        '$dataend'
                    )
                    OR
                    (
                        book_end
                        BETWEEN
                        '$datastart'
                        AND
                        '$dataend'
                    )
                )
        ");
if( $checksql->num_rows > 0 )
{
    while( $x = $checksql->fetch_assoc() )
    {
        $get_token = $x['book_token'];
        $get_start = $x['book_start'];
        $get_end = $x['book_end'];
    }
    $alert['alert'] = 'warning';
    $alert['text'] = 'Anda sudah terdaftar pada pelatihan tersebut, dengan token :<br/>' . $get_token . '<br/>Dari tanggal ' . $get_start . ', sampai tanggal ' . $get_end . '.' ;
    echo json_encode($alert);
} else { // Memasukkan data
    $sql = "INSERT INTO book( user_token, produk_id, book_timer, book_start, book_end, book_token )
            VALUES (
                '$data[pelanggan]',
                '$data[training]',
                '$data[trainingTime]',
                '$datastart',
                '$dataend',
                '$dataToken'
            )
    ";
    if( $conn->query( $sql ) === true ) {
        $alert['data'] = BASEURL . 'payment/' . $dataToken;
        $alert['alert'] = 'success';
        $alert['text'] = 'Pendaftaran pelatihan berhasil.<br/>Silakan melengkapi Administrasi dibawah ini.';
        echo json_encode($alert);
    } else {
        $alert['alert'] = 'danger';
        $alert['text'] = 'Pendaftaran pelatihan gagal.<br/>Silakan melengkapi form pendaftaran dengan benar.';
        echo json_encode($alert);
    }

};