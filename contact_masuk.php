<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: log-admin.php?pesan=gagallagi");
    exit();
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "portofolioo";

// Create connection
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}

$id_contact = "";
$nama_pengguna = "";
$email = "";
$pesan = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

// Delete operation
if ($op == 'delete' && isset($_GET['id_contact'])) {
    $id_contact = $_GET['id_contact'];
    $sql1 = "DELETE FROM contact WHERE id_contact = '$id_contact'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal melakukan hapus data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Steller landing page.">
    <meta name="author" content="Devcrud">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + Steller main styles -->
	<link rel="stylesheet" href="assets/css/steller.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <!-- Page navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" data-spy="affix" data-offset-top="0">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="assets/imgs/logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kelola_article.php">Kelola Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact_masuk.php">Contact Masuk</a>
                    </li>
                </ul>
            </div>
        </div>          
    </nav>

     <!-- Blog Section -->
     <section id="blog" class="section">
            <h2 STYLE="text-align:center;">Contact Masuk</h2>
            <div class="mx-auto">

                <!-- Tabel data -->
                <div class="card mt-3">
                    <div class="card-header text-white bg-secondary">
                        Data Contact
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Pesan</th>
                                    <th scope="col">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql2 = "SELECT * FROM contact ORDER BY id_contact DESC";
                                $q2 = mysqli_query($koneksi, $sql2);
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $id_contact = $r2['id_contact'];
                                    $nama_pengguna = $r2['nama_pengguna'];
                                    $email = $r2['email'];
                                    $pesan = $r2['pesan'];
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $id_contact ?></th>
                                        <td><?php echo $nama_pengguna ?></td>
                                        <td><?php echo $email ?></td>
                                        <td><?php echo $pesan ?></td>
                                        <td>
                                            <a href="contact_masuk.php?op=delete&id_contact=<?php echo $id_contact ?>" onclick="return confirm('Yakin mau hapus data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
