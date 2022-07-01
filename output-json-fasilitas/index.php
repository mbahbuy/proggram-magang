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
    
<div class="container">

    <h1 class="mt-4 mb-4">Pilih Penyewaan</h1>

    <div class="input-group mb-3">
        <label class="input-group-text" for="fasilitasID">Fasilitas :</label>
        <select class="form-select" id="fasilitasID">
            <option value="1" selected>Gedung Serba Guna</option>
            <option value="2">Masjid</option>
            <option value="3">Gereja</option>
            <option value="4">Kelenteng</option>
            <option value="5">Vihara</option>
            <option value="6">Pura</option>
            <option value="7">Lapangan Futsal</option>
            <option value="8">Lapangan Sepak Bola</option>
            <option value="9">Lapangan Volly</option>
            <option value="10">Lapangan Batminton</option>
            <option value="11">Lapangan Sepak Takrow</option>
            <option value="12">Rumah Prasmanan</option>
        </select>
    </div>

    <div class="input-group mb-3">
        <label class="input-group-text" for="tanggalFasilitas">Tanggal :</label>
        <input type="date" class="form-control" id="tanggalFasilitas">
    </div>

    <div class="input-group mb-3">
        <label class="input-group-text" for="waktuFasilitas">Waktu :</label>
        <select class="form-select" id="waktuFasilitas">
            <option value="1" selected>08:00 - 11:30</option>
            <option value="2">12:30 - 16:00</option>
            <option value="3">17:00 - 21:00</option>
        </select>
    </div>

    <button type="button" class="btn btn-primary mt-3 col-sm-3" id="book">Book</button>

</div>
<div id="notif"></div>

<script src="assets/js/bootstrap.js"></script>
<script>

function notif( data = null, alert = 'danger', texts = '' )
{
    if( data == null )
    {
        var notifPlace = document.getElementById('notif');
        var text = document.createElement('div');
        text.innerHTML = '<div class="alert alert-'+ alert +' alert-dismissible fade show" role="alert">'+ texts +'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        text.classList.add('container');
        notifPlace.appendChild(text);
    } else{
        var notifPlace = document.getElementById('notif');
        var text = document.createElement('div');
        text.innerHTML = '<div class="alert alert-'+ alert +' alert-dismissible fade show" role="alert">'+ texts + '<br/>' + data + '</div>';
        text.classList.add('container');
        notifPlace.appendChild(text);
    }
};

document.getElementById( 'book' ).onclick = function()
{
    var checking = new Date( document.getElementById( 'tanggalFasilitas' ).value );
    var nowDate = new Date();
    if( checking >= nowDate )
    {
        var data = {
            fasilitasID : document.getElementById( 'fasilitasID' ).value,
            tanggalFasilitas : document.getElementById( 'tanggalFasilitas' ).value,
            waktuFasilitas : document.getElementById( 'waktuFasilitas' ).value
        };
        var dataJson = JSON.stringify( data );
        var xxx = new XMLHttpRequest();
        xxx.onreadystatechange = function()
        {
            if( this.readyState == 4 && this.status == 200 )
            {
                var dataphp = JSON.parse(this.responseText);
                notif( dataphp.data, dataphp.alert, dataphp.text );
                // alert( this.responseText );
            };
        };
        xxx.open( "POST", "program/Database.php", true );
        xxx.setRequestHeader( "Content-Type", "application/json" );
        xxx.send( dataJson );
    } else {
        var data = null;
        var alert = 'danger';
        var text = 'Kalo mau mesen itu diteliti ya kakak!!!'
        notif( data, alert, text );
    }
};

</script>
</body>
</html>