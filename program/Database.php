<?php

if( !empty( $_GET[ 'action' ] ) ) {
    if( $_GET[ 'action' ] == "daftar" ) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $no_hp = $_POST['no_hp'];
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];

        if( !empty( $username ) && !empty( $email ) && !empty( $no_hp ) && !empty( $pass ) && !empty( $pass2 ) ) {
            $conn = new Database();
            
        }
    }
}


class Database {
    private $host, $user, $pass, $db_name, $dbh ;// dbh = database handler
    public function __construct() {
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->pass = DB_PASS;
        $this->db_name = DB_NAME;

        $this->dbh = new mysqli( $this->host, $this->user, $this->pass, $this->db_name );
        if ($this->dbh->connect_error) {
            die("Connection failed: " . $this->dbh->connect_error);
        }
    }
}