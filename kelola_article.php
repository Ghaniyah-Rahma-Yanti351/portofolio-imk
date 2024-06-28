<?php
session_start();

// Check if user is not logged in, redirect to login page
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
    die("Tidak bisa terkoneksi ke database: " . mysqli_connect_error());
}

$id_article = "";
$judul = "";
$gambar = "";
$deskripsi = "";
$ringkasan = "";
$error = "";
$sukses = "";

// Function to safely handle file uploads
function handleFileUpload($uploadDir, $fileField, $existingFilename = null) {
    $uploadedFilename = !empty($_FILES[$fileField]['name']) ? $_FILES[$fileField]['name'] : $existingFilename;

    // Create upload directory if not exists
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Handle file upload if a new file is selected
    if (isset($_FILES[$fileField]) && $_FILES[$fileField]['error'] === UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES[$fileField]['tmp_name'], $uploadDir . $uploadedFilename);
    }

    return $uploadedFilename;
}

// Delete operation
if (isset($_GET['op']) && $_GET['op'] == 'delete' && isset($_GET['id_article'])) {
    $id_article = $_GET['id_article'];
    $stmt = $koneksi->prepare("DELETE FROM article WHERE id_article = ?");
    $stmt->bind_param("i", $id_article);
    if ($stmt->execute()) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal melakukan hapus data: " . $stmt->error;
    }
    $stmt->close();
}

// Edit operation: Fetch data to be edited
if (isset($_GET['op']) && $_GET['op'] == 'edit' && isset($_GET['id_article'])) {
    $id_article = $_GET['id_article'];
    $stmt = $koneksi->prepare("SELECT * FROM article WHERE id_article = ?");
    $stmt->bind_param("i", $id_article);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $r1 = $result->fetch_assoc();
        $judul = $r1['judul'];
        $gambar = $r1['gambar'];
        $deskripsi = $r1['deskripsi'];
        $ringkasan = $r1['ringkasan'];
    } else {
        $error = "Data tidak ditemukan";
    }
    $stmt->close();
}

// Save operation: Update or insert data
if (isset($_POST['simpan'])) {
    $id_article = $_POST['id_article'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $ringkasan = $_POST['ringkasan'];
    $existing_gambar = $_POST['existing_gambar']; // Keep track of existing image

    // Handle file upload
    $uploadDir = __DIR__ . '/uploads/';
    $gambar = handleFileUpload($uploadDir, 'gambar', $existing_gambar);

    // Update or insert data
    if (!empty($id_article)) {
        // Update existing article
        $stmt = $koneksi->prepare("UPDATE article SET judul=?, gambar=?, deskripsi=?, ringkasan=? WHERE id_article=?");
        $stmt->bind_param("ssssi", $judul, $gambar, $deskripsi, $ringkasan, $id_article);
    } else {
        // Insert new article
        $stmt = $koneksi->prepare("INSERT INTO article (judul, gambar, deskripsi, ringkasan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $judul, $gambar, $deskripsi, $ringkasan);
    }

    if ($stmt->execute()) {
        $sukses = "Data berhasil disimpan";
    } else {
        $error = "Gagal menyimpan data: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin Dashboard">
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
    <h2 style="text-align: center;">Article</h2>
    <div class="mx-auto">
        <!-- Form untuk memasukkan atau mengedit data -->
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
                <?php header("refresh:5;url=kelola_article.php"); } ?>
                <form action="kelola_article.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="id_article" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="id_article" name="id_article" value="<?php echo $id_article ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $judul ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="gambar" name="gambar">
                            <input type="hidden" name="existing_gambar" value="<?php echo $gambar; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="deskripsi" id="deskripsi"><?php echo $deskripsi ?></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ringkasan" class="col-sm-2 col-form-label">Ringkasan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="ringkasan" id="ringkasan"><?php echo $ringkasan ?></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel data artikel -->
        <div class="card mt-3">
            <div class="card-header text-white bg-secondary">
                Data Article
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Ringkasan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM article ORDER BY id_article DESC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_assoc($q2)) {
                            $id_article = $r2['id_article'];
                            $judul = $r2['judul'];
                            $gambar = $r2['gambar'];
                            $deskripsi = $r2['deskripsi'];
                            $ringkasan = $r2['ringkasan'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td><?php echo $judul ?></td>
                                <td><img src="uploads/<?php echo $gambar ?>" style="max-width: 100px;"></td>
                                <td><?php echo $deskripsi ?></td>
                                <td><?php echo $ringkasan ?></td>
                                <td>
                                    <a href="kelola_article.php?op=edit&id_article=<?php echo $id_article ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="kelola_article.php?op=delete&id_article=<?php echo $id_article ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
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

    <!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>
    <!-- bootstrap 3 affix -->
    <script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- steller js -->
    <script src="assets/js/steller.js"></script>

</body>
</html>
