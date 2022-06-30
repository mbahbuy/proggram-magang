<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>output-json-antrian</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
<div class="container">
  <div class="row row justify-content-md-center mt-5">
    <div class="col-md-auto mt-5 mb-5">
      <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#formTombol">
        Ambil Antrian
      </button>
    </div>
  </div>
</div>

<div id="notif"></div>

<div class="modal fade" id="formTombol" tabindex="-1" aria-labelledby="formTombolLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formTombolLabel">Pendaftaran Pasien</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="input-group mb-3">
            <input type="text" class="form-control" id="nik" placeholder="KTP/No Induk Kesehatan Nasional" autocomplete="off" required>
        </div>

        <div class="form-floating mt-3">
            <select class="form-select" id="menuKesehatan">
                <option value="01" selected>Rapit Test</option>
                <option value="02">Vaksin</option>
                <option value="03">Poli Umum</option>
                <option value="04">Poli Gigi</option>
                <option value="05">Poli Penyakit Kulit</option>
                <option value="06">Poli Ibu dan Anak</option>
                <option value="07">Poli Kangker</option>
                <option value="08">Poli Psychology</option>
            </select>
            <label for="menuKesehatan">Tes Kesehatan Ke :</label>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="daftar">Daftar</button>
      </div>
    </div>
  </div>
</div>

<script src="assets/js/bootstrap.js"></script>
<script>
    function alerts( data = null ,alert = 'danger', texts = '' )
    {
      if( data == null )
      {
        var notifPlace = document.getElementById('notif');
        var text = document.createElement('div');
        text.innerHTML = '<div class="alert alert-'+ alert +' alert-dismissible fade show" role="alert">'+ texts +'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        text.classList.add('container');
        notifPlace.appendChild(text);
      } else {
        var notifPlace = document.getElementById('notif');
        var text = document.createElement('div');
        text.innerHTML = '<div class="alert alert-'+ alert +' alert-dismissible fade show" role="alert">'+ texts +', Nomor Antrian Anda<br/><h2>' + data + '</h2></div>';
        text.classList.add('container');
        notifPlace.appendChild(text);
      }
    };

    document.getElementById('daftar').onclick = function()
    {
        // console.log( document.getElementById('nik').value );
        var data = {
            pasien_token : 'hjdhfjhsdihfisduhdfu',// diambil dari cookie/sessien
            pasien_nik : document.getElementById('nik').value,
            pasien_need : document.getElementById('menuKesehatan').value
        };
        var jsonData = JSON.stringify(data);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if( this.readyState == 4 && this.status == 200 ){

              var dataphp = JSON.parse(this.responseText);
              // alert(this.responseText);

              alerts(dataphp.data, dataphp.alert, dataphp.text);

            };
        };
        xhttp.open( "POST", "program/Database.php", true );
        xhttp.setRequestHeader( "Content-Type", "application/json" );
        xhttp.send( jsonData );
    };
</script>
</body>
</html>