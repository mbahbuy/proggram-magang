<?php require_once 'program/Constant.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
    
    <div class="container mt-4">

        <h1 class="mt-4">Pilih Paket Pembelajaran</h1>

        <div class="form-floating mt-3">
            <select class="form-select" id="training">
                <option value="english">Bahasa Inggris</option>
                <option value="arabic">Bahasa Arab</option>
                <option value="spanish">Bahasa Spanyol</option>
                <option value="japan">Bahasa Jepang</option>
                <option value="frontend">FrontEnd WEB Developer</option>
                <option value="backend">BackEnd WEB Developer</option>
                <option value="autocad">Desainer AutoCAD</option>
            </select>
            <label for="training">Pilih Jenis Training:</label>
        </div>

        <div class="form-floating mt-3">
            <select class="form-select" id="trainingTime">
                <option value="1" selected>Satu Bulan</option>
                <option value="2">Dua Bulan</option>
                <option value="3">Tiga Bulan</option>
                <option value="4">Empat Bulan</option>
                <option value="5">Lima Bulan</option>
                <option value="6">Satu Semester</option>
                <option value="7">Tujuh Bulan</option>
                <option value="8">Delapan Bulan</option>
                <option value="9">Sembilan Bulan</option>
                <option value="10">Sepuluh Bulan</option>
                <option value="11">Sebelas Bulan</option>
                <option value="12">Dua Semester</option>
            </select>
            <label for="trainingTime">Waktu Training:</label>
        </div>
        <div class="form-floating mt-3">
            <select class="form-select" id="trainingStart">
                <option value="1" selected>Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">Nopember</option>
                <option value="12">Desember</option>
            </select>
            <label for="trainingStart">Training dimulai pada bulan:</label>
        </div>

        <button type="button" class="btn btn-primary mt-3 col-sm-3" id="book">Book</button>

    </div>




<script src="assets/js/bootstrap.js"></script>
<script>

document.getElementById( 'book' ).onclick = function()
{

    var data = {
        pelanggan : "gugyudgfydgfygdy", // mengambil data.token dari _cookie
        training : document.getElementById( 'training' ).value,
        trainingTime : document.getElementById( 'trainingTime' ).value,
        trainingStart : document.getElementById( 'trainingStart' ).value
    };

    var jsonData = JSON.stringify(data);
    var xhttp = new XMLHttpRequest();
    // xhttp.onreadystatechange = function() {
        
    // };
    xhttp.open( "POST", "program/Database.php", true );
    xhttp.setRequestHeader( "Content-Type", "application/json" );
    xhttp.send( jsonData );

};

</script>
</body>
</html>