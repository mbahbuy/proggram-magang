<?php include 'program/Database.php'; 

if( isset( $data ) ){
    $value['username'] = 'value="' . $data[0] . '"' ;
    $value['email'] = 'value="' . $data[1] . '"';
    $value['no_hp'] = 'value="' . $data[2] . '"';
    $value['pass'] = 'value="' . $data[3] . '"';
    $value['pass2'] = 'value="' . $data[4] . '"';
} else {
    $value['username'] = '';
    $value['email'] = '';
    $value['no_hp'] = '';
    $value['pass'] = '';
    $value['pass2'] = '';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempat Daftar</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>

    <div class="container mt-4">

        <div class="row">
            <div class="col-lg-6">
                <?php 
                    Flasher::flash(); 
                ?>
            </div>
        </div>

        <h1 class="mb-4">Register :</h1>
        <form action="./?action=daftar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">#</span>
            <input type="text" class="form-control" name="username" placeholder="Username" <?= $value['username'];?> autocomplete="off" required>
        </div>
        
        <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" <?= $value['email'];?> autocomplete="off" required>
            <span class="input-group-text" id="basic-addon2">@example.com</span>
        </div>     

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">(+62)</span>
            <input type="text" class="form-control" name="no_hp" placeholder="No HP/WA" <?= $value['no_hp'];?> autocomplete="off" required>
        </div>

        <div class="input-group mb-3">
            <input type="password" class="form-control" name="pass" <?= $value['pass'];?> placeholder="Password" required>
        </div>
        
        <div class="input-group mb-3">
            <input type="password" class="form-control" name="pass2" <?= $value['pass2'];?> placeholder="Confirm Password" required>
        </div>

        <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>


<script src="assets/js/bootstrap.js"></script>
</body>
</html>