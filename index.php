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
    <!-- End of page navigation -->

    <!-- Page Header -->
    <header class="header" id="home">
        <div class="container">
            <div class="infos">
                <h6 class="subtitle">hallo,I'm</h6>
                <h6 class="title">Ghaniyah Rahma Yanti</h6>
                <p>UI/UX Designer</p>

                <div class="buttons pt-3">
                    <button class="btn btn-primary rounded"><a href="contact.php" style="color: white;">HIRE ME</a></button>
                </div>      

                <div class="socials mt-4">
                    <a class="social-item" href="javascript:void(0)"><i class="ti-facebook"></i></a>
                    <a class="social-item" href="javascript:void(0)"><i class="ti-instagram"></i></a>
                    <a class="social-item" href="javascript:void(0)"><i class="ti-github"></i></a>
                    <a class="social-item" href="javascript:void(0)"><i class="ti-linkedin"></i></a>
                </div>
            </div>              
            <div class="img-holder">
                <img src="assets/imgs/nia.jpg" alt="">
            </div>      
        </div>  

        <!-- Header-widget -->
        <div class="widget">
            <div class="widget-item">
                <h2>$400</h2>
                <p>Web Designer</p>
            </div>
            <div class="widget-item">
                <h2>$456</h2>
                <p>Web development</p>
            </div>
            <div class="widget-item">
                <h2>$789</h2>
                <p>System Analyst</p>
            </div>
        </div>
    </header>
    <!-- End of Page Header -->
    
    <!-- About section -->
    <section id="about" class="section mt-3">
        <div class="container mt-5">
            <div class="row text-center text-md-left">
                <div class="col-md-3">
                    <img src="assets/imgs/avatar.jpg" alt="" class="img-thumbnail mb-4">
                </div>
                <div class="pl-md-4 col-md-9">
                    <h6 class="title">Ghaniyah Rahma Yanti</h6>
                    <p class="subtitle">UI/UX Designer</p>
                    <p>I am a 6th semester informatics engineering student from Raja Ali Haji Maritime University. 
                    I am active in developing myself in the fields of informatics, administration, and graphic design, 
                    especially UI/UX Designer. Have creative and innovative abilities that have made me accustomed to being 
                    responsible in the field of programming and creating poster designs on events, twibbons, and certificates.</p>
                    <p>I also have a soul that is easy to communicate well and is able to receive new insights and experiences 
                        and also allows me to try new challenges, pressure at work and adaptable in the work environment.</p>
                                     
                </div>
            </div>
        </div>
    </section>

    <!-- Experience section -->
    <section id="service" class="section">
        <div class="container text-center">
            <h6 class="subtitle">Experience</h6>
            <h6 class="section-title mb-4">Experience</h6>
            <div class="row">
            <?php               
                $stmt = $koneksi->prepare("SELECT * FROM article");
                $stmt->execute();
                $result = $stmt->get_result();
                
                while ($row = $result->fetch_assoc()) {
            ?>
                <div class="col-sm-6 col-md-3 mb-4">
                    <div class="custom-card card border">
                        <div class="card-body">
                            <img src="uploads/<?php echo $row['gambar'];?>" alt="<?php echo $row['judul'];?>">
                            <h5><?php echo $row['judul'];?></h5>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
            </div>
        </div>
    </section>
    <!-- End of Section -->

    <!-- Skills section -->
    <section class="section">
        <div class="container text-center">
            <h6 class="subtitle">Skills</h6>
            <h6 class="section-title mb-4">Skills</h6>
            
            <div class="row text-left">
                <div class="col-sm-6">
                    <h6 class="mb-3">Python</h6>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span>89%</span></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h6 class="mb-3">Web Design</h6>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 83%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span>83%</span></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h6 class="mb-3">App Design</h6>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 95%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span>95%</span></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h6 class="mb-3">Html & CSS</h6>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 90%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span>90%</span></div>
                    </div>
                </div>
            </div>  
        </div>
    </section>
    <!-- End of Skills section -->

    <!-- Project section -->
    <section id="project" class="section">
        <div class="container text-center">
            <h6 class="subtitle">Project</h6>
            <h6 class="section-title mb-4">Project</h6>
            <p class="mb-5 pb-4">Sebuah Project Yang Pernah Buat Selama Menjadi Mahasiswa. <br> </p>

            <div class="row">
                <div class="col-sm-4">
                    <div class="img-wrapper">
                        <img src="assets/imgs/folio-1.png" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Micro Project</h5>
                            </div>  
                        </div>
                    </div>
                    <div class="img-wrapper">
                        <img src="assets/imgs/folio-2.png" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Massive Project</h5>
                            </div>                              
                        </div>
                    </div>                  
                </div>
                <div class="col-sm-4">
                    <div class="img-wrapper">
                        <img src="assets/imgs/folio-3.png" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Macro Project</h5>
                            </div>  
                        </div>
                    </div>
                    <div class="img-wrapper">
                        <img src="assets/imgs/folio-4.png" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Interaksi Manusia Komputer Project</h5>
                            </div>                              
                        </div>
                    </div>                  
                </div>
                <div class="col-sm-4">
                    <div class="img-wrapper">
                        <img src="assets/imgs/folio-5.png" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Pemrograman Perangkat Sistem Project</h5>
                            </div>  
                        </div>
                    </div>
                    <div class="img-wrapper">
                        <img src="assets/imgs/folio-6.png" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Data Mining Project</h5>
                            </div>                              
                        </div>
                    </div>                  
                </div>
            </div>

        </div>
    </section>
    <!-- End of Project section -->

    <!-- Page Footer -->
    <footer class="page-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <p>Copyright <script>document.write(new Date().getFullYear())</script> &copy; <a href="http://www.devcrud.com" target="_blank">Ghaniyah Rahma Yanti</a></p>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </footer> 
    <!-- End of page footer -->
    
    <!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>
    <!-- bootstrap 3 affix -->
    <script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- steller js -->
    <script src="assets/js/steller.js"></script>

</body>
</html>
