<?php
require_once 'Constant.php';
$conn = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );

$datajson = file_get_contents( "php://input" );
$data = json_decode( $datajson, true );
$data_nik = $data['pasien_nik'];
$data_need = $data['pasien_need'];
$data_token = $data['pasien_token'];
$date = date( 'Y-m-d' );
$textantrian = poli( $data_need ); 

if( $data['pasien_token'] !== '' )
{
    if( $data['pasien_nik'] !== '' )
    {
        if( $data['pasien_need'] !== '' )
        {
            if( date( 'H:i:s' ) > "15:00:00" )
            {
                
                $alert['alert'] = 'danger';
                $alert['text'] = 'Data tidak diterima.<br/>Pendaftaran Pasien telah habis.<br/>Daftar lagi besok!!!';
                echo json_encode($alert); 
            } elseif( date( 'H:i:s' ) < "04:00:00" )
            {
                
                $alert['alert'] = 'danger';
                $alert['text'] = 'Data tidak diterima.<br/>Pendaftaran Pasien belum dibuka!!!';
                echo json_encode($alert);
            } else {
                $sqlcheck = $conn->query( "SELECT * FROM book WHERE ( tanggal LIKE '%$date%' AND book_payment = $data_nik AND produk_id = $data_need ) ");
                // echo "SELECT * FROM book WHERE ( tanggal LIKE '%$date%' AND book_payment = $data_nik AND produk_id = $data_need ) ";die;
                if( $sqlcheck->num_rows > 0 )
                {
                    // echo 'ada';die; 
                    
                    $alert['alert'] = 'danger';
                    $alert['text'] = 'Maaf, Data tidak diterima.<br/>Anda telah mendapatkan nomor antrian hari ini.';
                    echo json_encode($alert);
                } else {
                    // echo 'tidak ada';die;
                    $dataAntrian = $conn->query( "SELECT book_timer FROM book WHERE ( tanggal LIKE '%$date%' AND produk_id = $data_need ) ORDER BY book_timer DESC LIMIT 1 " );
                    if( $dataAntrian->num_rows > 0 )
                    {
                        while( $p = $dataAntrian->fetch_assoc() )
                        {
                            $nomorAntrian = $p['book_timer'] + 1 ;

                            $sql = "INSERT INTO book( user_token, produk_id, book_timer, book_payment )
                                VALUES (
                                    '$data_token',
                                    '$data_need',
                                    '$nomorAntrian',
                                    '$data_nik'
                                )
                            ";
                            mysqli_query( $conn, $sql );
                            $alert['data'] = $textantrian . " " . $nomorAntrian ;
                            $alert['alert'] = 'success';
                            $alert['text'] = 'Data diterima.';
                            echo json_encode($alert);
                        };
    
                    } else {
                        $sql = "INSERT INTO book( user_token, produk_id, book_timer, book_payment )
                            VALUES (
                                '$data_token',
                                '$data_need',
                                '1',
                                '$data_nik'
                            )
                        ";
                        mysqli_query( $conn, $sql );
                        $alert['data'] = $textantrian . " 1" ;
                        $alert['alert'] = 'success';
                        $alert['text'] = 'Data diterima.';
                        echo json_encode($alert);
                    };
    
                };
            };
        } else {
            
            $alert['alert'] = 'danger';
            $alert['text'] = 'Maaf, Data tidak diterima.<br/>Lengkapi form pendaftaran terlebih dahulu.';
            echo json_encode($alert);
        }
    } else {
        
        $alert['alert'] = 'danger';
        $alert['text'] = 'Maaf, Data tidak diterima.<br/>Lengkapi form pendaftaran terlebih dahulu.';
        echo json_encode($alert);
    }
} else {
    
    $alert['alert'] = 'danger';
    $alert['text'] = 'Maaf, Data tidak diterima.<br/>Anda belum login.';
    echo json_encode($alert);
}
function poli( $tuyul )
{
    $pemikat = [
        "01" => "Rapit Test",
        "02" => "Vaksin",
        "03" => "Poli Umum",
        "04" => "Poli Gigi",
        "05" => "Poli Penyakit Kulit",
        "06" => "Poli Ibu dan Anak",
        "07" => "Poli Kangker",
        "08" => "Poli Psychology",
    ];
    return $pemikat[ $tuyul ];
}