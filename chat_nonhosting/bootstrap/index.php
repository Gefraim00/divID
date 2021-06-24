<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>div ID</title>
    <link rel="icon" href="img/Logo.png" type="image/png" sizes="32x32">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.8/typed.min.js"></script>
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
            <a class="navbar-brand" href="#">
                <a class="navbar-brand" href="#">
                    <img src="img/Logo.png" width="64" height="64" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto">
                        <a class="nav-link active" href="#">Home</a>
                        <a class="nav-link" href="#">About</a>
                        <a href="indexLogin.php"><button type="button" class="btn btn-outline-success mr-2">Login</button></a>
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
        </div>
    </div>

    <!-- body -->
    <div class="content">
        <div class="rowContent">
            <div class="displayForm">
                <div class="container">
                    <h3 class="text-center">Discussion Form</h3>
                    <hr>
                    <div class="discussion">
                        <table>
                            <tr>
                                <td>
                                    <img src="img/User.png">
                                </td>
                                <td>User0001</td>
                            </tr>
                        </table>
                        <p>Selamat Datang di Div#!</p>
                        <p>di dalam website ini kalian dapat berdiskusi dan belajar bersama dengan orang lain yang memilik skill yang berbeda-beda</p>
                        <p>untuk dapat mengakses fitur chat/diskusi silahkan bergabung terlebih dahulu</p>
                    </div>
                </div>
            </div>
            <div class="communityMembers">
                <h3 class="text-center">Community Members</h3>
                <hr>
                <p class="text-center">Buat akun sekarang juga dan mulai belajar serta berdiskusi bersama</p>
                <div class="onlineJoinButton text-center">
                    <a href="index-signin.php"><button type="button" class="btn btn-light">Bergabung</button></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Users -->
    <div class="user" id="posting" style="display: none;">
        <form action="" method="">
            <div class="userContainer">
                <div class="container">
                    <img src="img/User.png" width="64" height="64"><span>User0001</span>
                    <br><br>
                    <div class="form-group">
                        <label for="tema">Pilih Tema :</label><br>
                        <select class="form-control" id="posting" name="posting">
                            <option>Web Development</option>
                            <option>Graphic Design</option>
                            <option>Mobile Programming</option>
                            <option>Data Analyst</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="posting">bingung? ayo langsung tanyakan</label><br>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <input type="submit" class="btn btn-block btn-success" value="Post">
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
        var a;

        function show_hide() {
            if (a == 1) {
                document.getElementById("komen").style.display = "inline";
                return a = 0;
            } else {
                document.getElementById("komen").style.display = "none";
                return a = 1;
            }
        }
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

    <footer>
        <center>
            <span>&copy; Kelompok 1 (2021)</span>
        </center>
    </footer>
    <script src="js/bootstrap.js"></script>
</body>

</html>