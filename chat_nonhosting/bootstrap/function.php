<?php
$conn = mysqli_connect("localhost", "root", "", "chat");


function tambah($data)
{
    global $conn;

    $user = htmlspecialchars($data['user']);
    $pass  = htmlspecialchars($data['pass']);

    // upload profile terlebih dahulu sebelum menjalankan query
    $profile = upload();
    if (!$profile) {
        return false;
    }


    $query = "INSERT INTO tb_user VALUES ('','$user','$pass','$profile')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $nama_file = $_FILES['profile']['name'];
    $ukuran_file = $_FILES['profile']['size'];
    $error = $_FILES['profile']['error'];
    $tmpName = $_FILES['profile']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
        alert('Masukan foto profil dahulu');
        document.location.href = 'index-signin.php';
        </script>";

        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $nama_file);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Yang anda masukan bukan gambar');
        document.location.href = 'index-signin.php';
        </script>";

        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuran_file > 2000000) {
        echo "<script>
        alert('Ukuran gambar terlalu besar');
        document.location.href = 'index-signin.php';
        </script>";

        return false;
    }

    // setelah gambar di upload masukan ke dalam file
    // generate nama gambar baru
    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/profile/' . $nama_file_baru);
    return $nama_file_baru;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_user WHERE id_user = $id");
    return mysqli_affected_rows($conn);
}
