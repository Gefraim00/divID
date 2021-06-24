<?php
require "function.php";
session_start();
if (!isset($_SESSION['id'])) {
    header("Location:indexLogin.php");
}

// session
$id_user = $_SESSION['id'];
$nama_user = $_SESSION['user'];
$profile = $_SESSION['profile'];
// waktu 
date_default_timezone_set("Asia/Hong_kong");
$waktu = date("H:i");

// query form pesan
if (isset($_POST["post"])) {
    $pesan = $_POST['pesan'];
    $tema = $_POST['tema'];
    $insert = "INSERT INTO pesan VALUES ('','$id_user','$nama_user','$pesan','$waktu','$tema')";
    mysqli_query($conn, $insert);
}

// menampilkan selain yang login
$select = "SELECT * FROM tb_user WHERE id_user != $id_user";
$select_result = mysqli_query($conn, $select);

// isi data ke dalam tabel komentar
if (isset($_POST["komen"])) {
    $id_pesan = $_POST['id_pesan'];
    $komentar = $_POST['komentar'];
    $insert_komentar = "INSERT INTO comment VALUES ('','$id_user','$id_pesan','$nama_user','$komentar','$profile','$waktu')";
    mysqli_query($conn, $insert_komentar);
}

// tampilkan komentar
$select_komentar = "SELECT * FROM pesan JOIN comment ON comment.id_pesan = pesan.id_pesan";
$result_komentar = mysqli_query($conn, $select_komentar);
$cek_komen = mysqli_fetch_assoc($result_komentar);

if (isset($_POST['cari'])) {
    $cari = $_POST['keyword'];
    $query = "SELECT * FROM tb_user JOIN pesan ON pesan.id_user = tb_user.id_user WHERE tema LIKE '%$cari%'";
    $result = mysqli_query($conn, $query);
} else {
    $query = "SELECT * FROM tb_user JOIN pesan ON pesan.id_user = tb_user.id_user";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

// cek member yang terdaftar
$member = mysqli_query($conn, "SELECT * FROM tb_user");
$cek_member = mysqli_num_rows($member);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>div ID</title>
    <link rel="icon" href="img/Logo.png" type="image/png" sizes="32x32">
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.8/typed.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- button posting -->
    <a href="#posting"><button type="button" class="btn btn-success buttonPost" onclick="show_hide2()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle mr-2" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>add Post</button></a>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <img src="img/Logo.png" width="64" height="64" alt="">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link active" href="#">Home</a>
                    <a class="nav-link" href="#">About</a>
                    <a href="logout.php"><button type="button" class="btn btn-outline-danger mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                            </svg>
                            Logout</button>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!--jumbotron -->
    <div class="jumbotron jumbotron-fluid">
        <div class="jumboDesc mt-4">
            <h1>Tempat-nya <span id="typed"></span> <br> Belajar dan Berdiskusi bersama </h1>
            <form action="" method="POST">
                <button class="btn btn-success" style="border-radius: 50%;" type="submit" name="cari">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
                <input type="text" name="keyword" placeholder="example : Web Development ect...  " class="text-center">
            </form>
        </div>
    </div>

    <!-- body -->
    <div class="content">
        <div class="rowContent">
            <div class="displayForm">
                <div class="container">
                    <h3 class="text-center">Discussion Form</h3>
                    <hr>
                    <?php foreach ($result as $data) : ?>
                        <div class="isi">
                            <table>
                                <tr>
                                    <td><img src="img/profile/<?= $data['profile']; ?>" class="profile_user"></td>
                                    <td>
                                        <h4 id="nama_user"><?= $data['user']; ?></h4>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <div class="tema text-center" style="width:200px; background-color:cadetblue; color:white; padding:5px; box-sizing: border-box; border-radius:20px;">
                                <span><?= $data['tema']; ?></span>
                            </div>
                            <br>
                            <div class="post" style="position: relative;">
                                <table>
                                    <tr>
                                        <td>
                                            <p><?= $data['pesan']; ?></p>
                                        </td>
                                    </tr>
                                </table>
                                <span style="position:absolute; right:0; bottom:0;"><?= $data['waktu']; ?></span>
                                <div class="comment">
                                    <hr style="width: 100%; border: 1px solid grey">
                                    <span style="color: grey;">komentar...</span>
                                    <div class=" isi_komen">
                                        <table>
                                            <?php foreach ($result_komentar as $komen) : ?>
                                                <?php if ($komen['id_pesan'] == $data['id_pesan']) : ?>
                                                    <tr>
                                                        <td><img src="img/profile/<?= $komen['profile']; ?> " class="gambar_komen">
                                                            <span style="font-weight: 600;"><?= $komen['nama_user']; ?></span>
                                                        </td>
                                                        <td><?= $komen['komentar']; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </table>
                                    </div>
                                    <div id="komen">
                                        <br>
                                        <form action="" method="POST">
                                            <img src="img/profile/<?= $profile; ?>" id="users"><span>
                                                <input type="text" name="id_pesan" value="<?= $data['id_pesan']; ?>" hidden>
                                                <textarea name="komentar" cols="80" rows="1" style="border: none; outline:none; border-bottom:1px solid cornflowerblue;" placeholder="tulis disini...."></textarea>
                                                <span><button type="submit" name="komen"><img src="img/send.png" width="24" height="24"></button></span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="communityMembers">
                <h3 class="text-center">Community Members</h3>
                <hr>
                <div class="container">
                    <p class="text-center">Member's : <span style="color:#42ba96;"><?= $cek_member; ?></span></p>
                    <table>
                        <?php foreach ($select_result as $member) : ?>
                            <tr>
                                <td><img src="img/profile/<?= $member['profile']; ?>"></td>
                                <td><span><?= $member['user'];  ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Users -->
    <div class="user" id="posting" style="display: none;">
        <div class="userContainer">
            <div class="container">
                <img src="img/profile/<?= $profile; ?>" width="64" height="64" class="rounded-circle mr-3"><span><?= $nama_user; ?></span>
                <br><br>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="tema">Pilih Tema :</label><br>
                        <select class="form-control" id="posting" name="tema">
                            <option value="Web Development">Web Development</option>
                            <option value="Graphic Design">Graphic Design</option>
                            <option value="Mobile Programming">Mobile Programming</option>
                            <option value="Data Analyst">Data Analyst</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="posting">bingung? ayo langsung tanyakan</label><br>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="pesan"></textarea>
                    </div>
                    <input type="submit" class="btn btn-block btn-success" value="Post" name="post">
            </div>
        </div>
        </form>
    </div>

    <script>
        new Typed('#typed', {
            strings: ['"Web Developer"', '"Graphic Designer"', '"Mobile Programmer"', '"Data Analyst"'],
            typeSpeed: 40,
            delaySpeed: 90,
            loop: true
        });
    </script>
    <script>
        var b;

        function show_hide2() {
            if (b == 1) {
                document.getElementById("posting").style.display = "inline";
                return b = 0;
            } else {
                document.getElementById("posting").style.display = "none";
                return b = 1;
            }
        }
    </script>
    <script src="js/bootstrap.js"></script>
    <footer>
        <center>
            <span>&copy; Kelompok 1 (2021)</span>
        </center>
    </footer>
</body>

</html>