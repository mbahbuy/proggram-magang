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
    <div id="dataProduk"></div>
</div>
  <script src="assets/js/bootstrap.js"></script>
<script>
    function outputData( dataJson = '' )
    {
        var tempatTampilan = document.getElementById( 'dataProduk' );
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function()
        {
            var JSONdata = JSON.parse( this.responseText );
            for( let i = 0; i < JSONdata.length; i++ )
            {
                // console.log( JSONdata[i] );
                let dataArray = document.createElement( 'div' );
                dataArray.className = "card mt-4";
                dataArray.innerHTML = "<div class='card-header'>" + JSONdata[i].list + "</div><div class='card-body'><h5 class='card-title'>" + JSONdata[i].name + "</h5><p class='card-text'>" + JSONdata[i].deskripsi + "</p><a class='btn btn-primary'>" + JSONdata[i].harga + "</a></div>";
                tempatTampilan.appendChild( dataArray );

            };
        };
        xhttp.open( "GET", "program/DataProduk.php" + dataJson, true );
        xhttp.send();
    }
    outputData();
</script>
</body>
</html>