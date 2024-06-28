<!DOCTYPE html>
<html>
<head>
	<title>admin Ghaniyahrahma</title>
	<link rel="stylesheet" type="text/css" href="log.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Calistoga&family=Hermeneus+One&display=swap">
</head>
<body>
 
	<h1>Admin Ghaniyahrahma</h1>

	<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Login gagal. Username dan Password tidak sesuai !</div>";
		}
        elseif($_GET['pesan']=="gagallagi"){
			echo "<div class='alert'> Anda belum login, silakan isi kolom berikut !</div>";
		}
        elseif($_GET['pesan']=="gagallogin"){
			echo "<div class='alert'>Pengguna tidak ditemukan !</div>";
		}
	}
	?>
	<div class="kotak_login">
		<p class="tulisan_login">Silakan login</p>

		<form action="login-cek.php" method="post">
			<label>Username</label>
			<input type="text" name="username" class="form_login" placeholder="Username" required="required">
 
			<label>Password</label>
			<input type="password" name="password" class="form_login" placeholder="Password" required="required">
 
			<input type="submit" class="tombol_login" value="LOGIN">
 
			<br/>
			<br/>
		</form>
		
	</div>
</body>
</html>