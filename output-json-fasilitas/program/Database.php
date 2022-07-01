<?php require_once 'Constant.php';

$data = file_get_contents( "php://input" );
$data = json_decode( $data, true);

$dataToken = hash( 'sha256', $data['tanggalFasilitas'] . $data['waktuFasilitas'] );
$url = BASEURL . 'payment/' . $dataToken;

$alert['data'] = $url;
$alert['alert'] = 'success';
$alert['text'] = 'Pendaftaran pelatihan berhasil. Silakan melengkapi Administrasi dibawah ini.';
echo json_encode($alert);