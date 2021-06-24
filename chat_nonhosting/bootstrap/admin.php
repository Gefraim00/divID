<?php
require "function.php";
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location:index.php");
}

$query = "SELECT * FROM tb_user ";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery.js"></script>
    <style>
        table tr td img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <h1 class="text-center">Selamat datang admin</h1>
    <div class="container">
        <table class="table text-center" border="1">
            <thead class="thead-dark">
                <th scope="row">No</th>
                <th>username</th>
                <th>password</th>
                <th>profile</th>
                <th>Aksi</th>
            </thead>
            <?php foreach ($result as $row) : ?>
                <tr>
                    <td><?= $row['id_user']; ?></td>
                    <td><?= $row['user']; ?></td>
                    <td><?= $row['pass']; ?></td>
                    <td><img src="img/profile/<?= $row['profile']; ?>"></td>
                    <td><a href="hapus.php?id=<?= $row['id_user']; ?>"><button class="btn btn-danger">Hapus</button></td></a>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="logout.php"><button class="btn btn-danger">Logout</button></a>
    </div>
    <script src="js/bootstrap.js"></script>
</body>

</html>