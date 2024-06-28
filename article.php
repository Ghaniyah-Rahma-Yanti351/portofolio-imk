<?php
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Steller landing page.">
    <meta name="author" content="Devcrud">
    <title>Fortofolio Ghaniyah Rahma Yanti</title>
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

     <!-- Blog Section -->
     <section id="blog" class="section">
        <div class="container text-center">
            <h6 class="subtitle">Experience</h6>
            <h6 class="section-title mb-4">Experience</h6>
            <p class="mb-5 pb-4">Pengalaman Yang Pernah Saya Lakukan Selama Menjadi Mahasiswa. <br> </p>

            <div class="row text-left">
            <?php               
                $stmt = $koneksi->prepare("SELECT id_article, judul, gambar, deskripsi FROM article");
                $stmt->execute();
                $result = $stmt->get_result();
                
                while ($row = $result->fetch_assoc()) {
                    $deskripsi = $row['deskripsi'];
                    // Ambil 25 kata pertama
                    $short_desc = implode(' ', array_slice(str_word_count($deskripsi, 2), 0, 25));
            ?>
                    <div class="col-md-4">
                        <div class= "card border mb-4">
                        <img src="uploads/<?php echo $row['gambar'];?>" alt="<?php echo $row['judul'];?>" class="card-img-top w-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['judul'];?></h5>
                            <div class="post-details">
                                <a>Posted By: Admin</a>
                            </div>
                            <p class="short-desc"><?php echo $short_desc;?></p>
                            <p class="full-desc" style="display: none;"><?php echo $deskripsi;?></p>
                            <a href="#" class="read-more">Read More</a>
                        </div>
                        </div>
                    </div>
            <?php
                }
            ?>    
            </div>
        </div>
    </section>
    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="assets/vendors/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.read-more').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $cardBody = $this.closest('.card-body');
            var $shortDesc = $cardBody.find('.short-desc');
            var $fullDesc = $cardBody.find('.full-desc');
            
            $fullDesc.slideDown(); // Mengubah slideUp menjadi slideDown
        });
    });
    </script>

</body>
</html>
