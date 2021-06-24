<?php
require "function.php";
session_start();
if (isset($_POST["login"])) {

    $username = $_POST['user'];
    $password = $_POST['pass'];

    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE user = '$username'");
    $cek = mysqli_num_rows($result);
    // cek username
    if ($cek > 0 || $username == "admin" && $password == "admin") {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if ($row['pass'] == $password) {
            // set session
            $_SESSION['user'] = $username;
            $_SESSION['pass'] = $password;
            $_SESSION['admin'] = "berhasil_login";
            $_SESSION['id'] = $row['id_user'];
            $_SESSION['profile'] = $row['profile'];
            header("Location: user.php");
            exit;
        } else {
            $_SESSION['admin'] = "berhasil_login";
            header('Location:admin.php');
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>div ID (Login)</title>
    <link rel="icon" href="img/Logo.png" type="image/png" sizes="32x32">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="js/jquery.js"></script>
</head>

<!-- navbar -->

<body>
    <?php
    if (isset($error)) {
        echo "<script>
        alert('Username/Password salah');
        document.location.href = 'index.php';
        </script>";
        exit;
    }

    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 daftar text-center">
                <div id="desc" style="margin-top: 80px;">
                    <img src="img/Logo.png" alt="" width="150" height="125">
                    <h4 class="lead" style="margin-top: -10px;">Division ID</h4>
                </div>
            </div>
            <div class="col-lg-6 login">
                <h4 class="text-center">Login Here</h4>
                <hr style="border: 1px solid white;">
                <form action="" method="POST">
                    <input type="text" placeholder="Username" name="user" autocomplete="off">
                    <br><br>
                    <input type="password" placeholder="Password" name="pass" autocomplete="off">
                    <br><br>
                    <button type="submit" name="login" class="btn btn-success btn-block">Login</button>
                    <br>
                </form>
                <p>belum punya akun ?<a href="index-signin.php" class="ml-1">sign-in</a></p>
            </div>
        </div>
        <a href="index.php"><button class="btn btn-danger" style="margin-left: 20px;">Dashboard</button></a>
    </div>



    <footer>
        <center>
            <span>&copy; Kelompok 1 (2021)</span>
        </center>
    </footer>
    <script src="js/bootstrap.js"></script>
</body>

</html>