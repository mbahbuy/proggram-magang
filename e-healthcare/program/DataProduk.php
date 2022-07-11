<?php

require_once 'Constant.php';
$conn = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );
// $data = [];
// $p = [];
// $p['angka'] = 1;
// $p['terbilang'] = 'satu';
// $x['angka'] = 2;
// $x['terbilang'] = 'dua';
// $data[] = $p;
// $data[] = $x;

// echo json_encode( ['result' => $data] );
// die;
if( empty( $_GET['poli'] ) && empty( $_GET['name'] ) )
{
    $sql = "SELECT * FROM produk WHERE ( produk_kategori = 1 AND produk_active = 1 )";
    $result = $conn->query($sql);
    if( $result->num_rows > 0 )
    {
        while( $x = $result->fetch_assoc() )
        {
            $data['name'] = $x['produk_name'];
            $data['list'] = $x['produk_child'];
            $data['deskripsi'] = $x['produk_deskripsi'];
            $data['harga'] = 'Rp ' . number_format( $x['produk_harga'], 0, ',', '.' );
            $datafix[] = $data;
        }
        echo json_encode( $datafix );
    } else {
        $data['data'] = 'null';
        echo json_encode( $data );
    }
} elseif( empty( $_GET['name'] ) )
{
    $sql = "SELECT * FROM produk WHERE ( produk_kategori = 1 AND produk_active = 1 ) AND produk_child LIKE '%$_GET[poli]%'";
    $result = $conn->query($sql);
    if( $result->num_rows > 0 )
    {
        $p = 1;
        while( $x = $result->fetch_assoc() )
        {
            $data['name'] = $x['produk_name'];
            $data['list'] = $x['produk_child'];
            $data['deskripsi'] = $x['produk_deskripsi'];
            $data['harga'] = 'Rp ' . number_format( $x['produk_harga'], 0, ',', '.' );;
            $datafix[] = $data;
        }
        echo json_encode( $datafix );
    } else {
        $data['data'] = 'null';
        echo json_encode( $data );
    }
} elseif( empty( $_GET['poli'] ))
{
    $sql = "SELECT * FROM produk WHERE (produk_kategori = 1 AND produk_active = 1) AND produk_name LIKE '%$_GET[name]%'";
    $result = $conn->query($sql);
    if( $result->num_rows > 0 )
    {
        $p = 1;
        while( $x = $result->fetch_assoc() )
        {
            $data['name'] = $x['produk_name'];
            $data['list'] = $x['produk_child'];
            $data['deskripsi'] = $x['produk_deskripsi'];
            $data['harga'] = 'Rp ' . number_format( $x['produk_harga'], 0, ',', '.' );;
            $datafix[] = $data;
        }
        echo json_encode( $datafix );
    } else {
        $data['data'] = 'null';
        echo json_encode( $data );
    }
} else {
    $sql = "SELECT * FROM produk WHERE ( produk_kategori = 1 AND produk_active = 1 ) AND ( produk_name LIKE '%$_GET[name]%' AND produk_child LIKE '%$_GET[poli]%' )";
    $result = $conn->query($sql);
    if( $result->num_rows > 0 )
    {
        $p = 1;
        while( $x = $result->fetch_assoc() )
        {
            $data['name'] = $x['produk_name'];
            $data['list'] = $x['produk_child'];
            $data['deskripsi'] = $x['produk_deskripsi'];
            $data['harga'] = 'Rp ' . number_format( $x['produk_harga'], 0, ',', '.' );;
            $datafix[] = $data;
        }
        echo json_encode( $datafix );
    } else {
        $data['data'] = 'null';
        echo json_encode( $data );
    }

}
header('Content-Type: application/json');