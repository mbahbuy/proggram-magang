<?php require_once 'Constant.php'; require_once 'Flasher.php'; 
if( !session_id() ) session_start();
$conn = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );

if( !empty( $_GET[ 'action' ] ) ) {
    if( $_GET[ 'action' ] == "daftar" ) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $no_hp = $_POST['no_hp'];
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];
        if( !empty( $username ) && !empty( $email ) && !empty( $no_hp ) && !empty( $pass ) && !empty( $pass2 ) ) {

            $sql_cek = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
            $r_cek = mysqli_num_rows($sql_cek);
            if ( $r_cek > 0 ) {

                Flasher::setFlash( 'gagal', 'ditambahkan <br/> Email Anda sudah pernah terdaftar', 'warning' );
                $data = [ $username, $email, $no_hp, $pass, $pass2 ];
                return $data;

            }else{

                $user_cek = mysqli_query($conn, "SELECT * FROM user WHERE user_name = '$username'");
                $rr_cek = mysqli_num_rows($user_cek);  
                if( $rr_cek > 0 ){

                    Flasher::setFlash( 'gagal', 'ditambahkan <br/> username yang anda masukan sudah terpakai', 'warning' );
                    $data = [ $username, $email, $no_hp, $pass, $pass2 ];
                    return $data;

                } else {

                    if( $pass === $pass2 ){
                            
                        $passfix = password_hash( $pass, PASSWORD_DEFAULT );

                        $token = hash( 'sha256', md5( $username . "\/" . date('Y-m-d') ) );

                        $sql = "INSERT INTO `user`( `user_name`, `email`, `no_hp`, `pass`, `token` ) VALUES ( '$username', '$email', '$no_hp', '$passfix', '$token' )";

                        if ($conn->query($sql) === TRUE) {

                            

                            $to = $email;
                            $subject = "Activation Email.";
                            
                            $message = "<b>Pengaktifan Akun di</b>";
                            $message .= "<h1>WARKOP MBAH BUY.</h1>";
                            $message .= "Selemat, anda berhasil membuat akun. Untuk mengaktifkan akun anda silahkan klik link dibawah ini.";
                            $message .= " <a href='" . BASEURL . "activation.php?t=".$token."'>" . BASEURL . "activation.php?t=".$token."</a> ";
                            
                            $header = "From:mbahbagonku@gmail.com \r\n";
                            $header .= "MIME-Version: 1.0\r\n";
                            $header .= "Content-type: text/html\r\n";
                            
                            $retval = mail ($to,$subject,$message,$header);
                            
                            Flasher::setFlash( 'berhasil', 'ditambahkan. <br/> Silahkan cek email anda untuk aktifasi.', 'success' );
                            $data = [ "", "", "", "", "" ];
                            return $data;
                        }
                        
                    } else {
                        
                        Flasher::setFlash( 'gagal', 'ditambahkan. <br/> Password yang anda masukan <span>berbeda</span>.', 'danger' );
                        $data = [ $username, $email, $no_hp, $pass, $pass2 ];
                        return $data;
                        
                    }
                }
            }
        } else {

            Flasher::setFlash( 'gagal', 'ditambahkan. <br/> Lengkapi Form Pendaftaran', 'danger' );
            $data = [ $username, $email, $no_hp, $pass, $pass2 ];
            return $data;

        }
    }
}