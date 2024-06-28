<?php
session_start();

$koneksi = mysqli_connect("localhost", "root", "", "portofolioo");

// Check connection
if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password_input = $_POST['password'];

    $query = "SELECT password FROM tb_admin WHERE username = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hashed_password);
    mysqli_stmt_fetch($stmt);

    if ($hashed_password) {  
        // Verifikasi kata sandi
        if (password_verify($password_input, $hashed_password)) {
            $_SESSION['username'] = $username;
            header("Location: admin.php");
            exit();
        } else {
            header("Location: log-admin.php?pesan=gagal");
        }
    } else {
        // Pengguna tidak ditemukan atau ada kesalahan lain
        header("Location: log-admin.php?pesan=gagallogin");
        exit();
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($koneksi);
?>
