<?php
require 'function.php';

if (isset($_POST["submit"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "<script>
                alert('Berhasil Mendaftar');
                document.location.href = 'indexLogin.php';
            </script>";
    } else {
        echo "<script>
                alert('Gagal Mendaftar');
                document.location.href = 'index-signin.php';
            </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>div ID (daftar)</title>
    <link rel="icon" href="img/Logo.png" type="image/png" sizes="32x32">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/daftar.css">
    <script src="js/jquery.js"></script>
</head>

<body>
    <center>
        <br><br>
        <div class="container">
            <div class="form">
                <h2>Daftar</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="masukan username anda" id="user" name="user" autocomplete="off" required>
                    <br>
                    <input type="password" placeholder="masukan password anda" id="pass" name="pass" autocomplete="off" required>
                    <br>
                    <input type="file" placeholder="foto profil" name="profile" id="image" autocomplete="off" onchange="return fileValidation()">
                    <div id="gambar">
                        <img src="#">
                    </div>
                    <br>
                    <button type="submit" name="submit" class="btn btn-success btn-block">Daftar</button>
                </form>
                <br>
                <p style="color: white;">sudah punya akun? <a href="indexLogin.php">Login</a></p>
            </div>
        </div>
    </center>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript">
        function fileValidation() {
            var fileInput = document.getElementById('image');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
                alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
                fileInput.value = '';
                return false;
            } else {
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('gambar').innerHTML = '<img src="' + e.target.result + '" width="200" height="200"/>';
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
    </script>

    <footer>
        <center>
            <span>&copy; Kelompok 1 (2021)</span>
        </center>
    </footer>
</body>

</html>