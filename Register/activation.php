<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activation Email</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>

    <div class="container mt-4">

        <div class="row">
            <div class="col-lg-6">
<?php require_once 'program/Constant.php';
$conn = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );

$token = $_GET[ 't' ];
$sql_cek = mysqli_query( $conn, "SELECT * FROM user WHERE token='".$token."' and active='0'" );
$jml_data = mysqli_num_rows( $sql_cek );
if( $jml_data > 0 ) {
    if( mysqli_query( $conn, "UPDATE user SET active='1' WHERE token='".$token."' and active='0'" ) === TRUE ) {
        echo '
        <div class="alert alert-success">
            Akun anda sudah aktif, silahkan <a href="' . BASEURL . '">login</a>
        </div>
        ';
    } else {
        echo '
        <div class="alert alert-warning">
            Token sudah terpakai, silahkan <a href="' . BASEURL . '">kembali</a>
        </div>
        ';
    }
} else {
    echo '
    <div class="alert alert-success">
        Token tidak dikenal, silahkan <a href="' . BASEURL . '">kembali</a>
    </div>
    ';
}

?>
            </div>
        </div>
    
    </div>
<script src="assets/js/bootstrap.js"></script>
</body>
</html>