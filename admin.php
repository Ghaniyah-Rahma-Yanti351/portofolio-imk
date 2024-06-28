<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: log-admin.php?pesan=gagallagi");
    exit();
}

$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "portofolioo";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

$id_admin   = "";
$nama_admin = "";
$username   = "";
$password   = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id_admin   = $_GET['id_admin'];
    $sql1       = "delete from tb_admin where id_admin = '$id_admin'";
    $q1         = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error  = "Gagal melakukan hapus data";
    }
}

if ($op == 'edit') {
    $id_admin   = $_GET['id_admin'];
    $sql1       = "select * from tb_admin where id_admin = '$id_admin'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    if ($r1) {
        $nama_admin = $r1['nama_admin'];
        $username   = $r1['username'];
        $password   = $r1['password'];
    } else {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama_admin = $_POST['nama_admin'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];

    if ($nama_admin && $username && $password) {
        if ($op == 'edit') {
            $sql1   = "update tb_admin set nama_admin='$nama_admin', username='$username', password='$password' where id_admin='$id_admin'";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else {
            $sql1   = "insert into tb_admin(nama_admin, username, password) values ('$nama_admin', '$username', '$password')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error  = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
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
        <div class="container">
            <h2 style="text-align:center;">ADMIN</h2>
            <div class="mx-auto">
                <!-- untuk memasukkan data -->
                <div class="card">
                    <div class="card-header">
                        Create / Edit Data
                    </div>
                    <div class="card-body">
                        <?php if ($error) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error ?>
                            </div>
                        <?php } ?>
                        <?php if ($sukses) { ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $sukses ?>
                            </div>
                        <?php } ?>
                        <form action="admin.php" method="POST">
                            <div class="mb-3 row">
                                <label for="id_admin" class="col-sm-2 col-form-label">Id Admin</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="id_admin" name="id_admin" value="<?php echo $id_admin ?>" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama_admin" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_admin" name="nama_admin" value="<?php echo $nama_admin ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                            </div>
                        </form>
                    </div>
                </div>

                <!-- untuk mengeluarkan data -->
                <div class="card mt-4">
                    <div class="card-header text-white bg-secondary">
                        Data Admin
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql2   = "select * from tb_admin order by id_admin desc";
                                $q2     = mysqli_query($koneksi, $sql2);
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $id_admin     = $r2['id_admin'];
                                    $nama_admin   = $r2['nama_admin'];
                                    $username     = $r2['username'];
                                    $password     = $r2['password'];
                                ?>
                                    <tr>
                                        <td><?php echo $id_admin ?></td>
                                        <td><?php echo $username ?></td>
                                        <td><?php echo $nama_admin ?></td>
                                        <td><?php echo $password ?></td>
                                        <td>
                                            <a href="admin.php?op=edit&id_admin=<?php echo $id_admin ?>" class="btn btn-warning">Edit</a>
                                            <a href="admin.php?op=delete&id_admin=<?php echo $id_admin ?>" class="btn btn-danger" onclick="return confirm('Yakin mau delete data?')">Delete</a>
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
        </div>
    </section>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
