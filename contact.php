<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "portofolioo";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}

$nama_pengguna = "";
$email = "";
$pesan = "";
$sukses = "";
$error = "";

if (isset($_POST['submit'])) {
    $nama_pengguna = $_POST['nama_pengguna'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];

    if (empty($nama_pengguna) || empty($email) || empty($pesan)) {
        $error = "Silakan masukkan semua data";
    } else {
        // Using prepared statements to prevent SQL injection
        $stmt = $koneksi->prepare("INSERT INTO contact (nama_pengguna, email, pesan) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama_pengguna, $email, $pesan);

        if ($stmt->execute()) {
            $sukses = "Pesan berhasil dikirim";
            // Clear form inputs after successful submission
            $nama_pengguna = "";
            $email = "";
            $pesan = "";
        } else {
            $error = "Pesan gagal dikirim";
        }

        $stmt->close();
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
    <title>Portfolio Ghaniyah Rahma Yanti</title>
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
                        <a class="nav-link" href="../public_html/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../public_html/article.php">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../public_html/contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>          
    </nav>

    <!-- Contact Section -->
    <section id="contact" class="position-relative section">
        <div class="container text-center">
            <h6 class="subtitle">Contact</h6>
            <h6 class="section-title mb-4">Contact</h6>
            
            <div class="contact text-left">
                <div class="form">
                    <form action="contact.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nama_pengguna" placeholder="Nama" value="<?php echo $nama_pengguna ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Enter email" value="<?php echo $email ?>" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="pesan" cols="30" rows="5" placeholder="Message" required><?php echo $pesan ?></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block rounded w-lg">Send Message</button>
                    </form>
                    <?php if ($error) { ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            <?php echo $error ?>
                        </div>
                    <?php } ?>
                    <?php if ($sukses) { ?>
                        <div class="alert alert-success mt-3" role="alert">
                            <?php echo $sukses ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="contact-infos">
                    <div class="item">
                        <i class="ti-location-pin"></i>
                        <div class="">
                            <h5>Location</h5>
                            <p>Tanjung Pinang</p>
                        </div>                          
                    </div>
                    <div class="item">
                        <i class="ti-mobile"></i>
                        <div>
                            <h5>Phone Number</h5>
                            <p>081268034628</p>
                        </div>                          
                    </div>
                    <div class="item">
                        <i class="ti-email"></i>
                        <div class="mb-0">
                            <h5>Email Address</h5>
                            <p>ghaniyahrahma@gmail.com</p>
                        </div>
                    </div>
                </div>                  
            </div>
        </div>      
    </section>
    <!-- End of Contact Section -->

    <!-- Page Footer -->
    <footer class="page-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <p>&copy; <script>document.write(new Date().getFullYear())</script> Portfolio Ghaniyah Rahma Yanti</p>
                </div>
                <div class="col-sm-6">
                    <div class="socials">
                        <a class="social-item" href="javascript:void(0)"><i class="ti-facebook"></i></a>
                        <a class="social-item" href="javascript:void(0)"><i class="ti-instagram"></i></a>
                        <a class="social-item" href="javascript:void(0)"><i class="ti-github"></i></a>
                        <a class="social-item" href="javascript:void(0)"><i class="ti-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End of page footer -->

    <!-- Bootstrap + Steller main JavaScript -->
    <script src="assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/popper.js/popper.min.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.min.js"></script>
</body>
</html>
