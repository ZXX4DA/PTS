<?php
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
	$anggota = $_POST['anggota'];
	$pass = $_POST['password'];

    $password = md5($pass);

    include './config.php';
    $result = mysqli_query($connect, "INSERT INTO team (nama, phone_number, jumlah_anggota, password) VALUES ('$nama','$telp', '$anggota', '$password')");
    
    if ($result) {
        echo "<script>alert('Berhasil!');</script>";
    } else {
        echo "<script>alert('Gagal!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar Team</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body style="
	margin: 0px;
	padding: 0px;
	max-width: 100%;
	font-family: sans-serif;	
">
	<main>
		<section style="
			width: 100%;
			max-width: 100%;
			height: 100vh;
			display: flex;
			background-image: url(style/img/backGame.jpeg);
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center;
			justify-content: center;
		">
		<!-- Section gambar -->
			<div style="
				flex: 1;
			">
				<div style="
					width: 90%;
					height: 80vh;
					margin-left: 5%;
					margin-top: 9%;
					background-position: center;
					background-size: cover;
					border-radius: 20px;
					border: 3px solid rgba(0,0,0,0.1);
				">
					<div class="container">
					  <div class="row" style="
						height: 80vh !important;
					">
					    <div class="col" style="
					    	background-image: url(style/img/ML.jpeg);
					    	background-position: center;
					    	background-repeat: no-repeat;
					    	background-size: cover;
					    	border-radius: 20px;
					    	margin-right: 5px;
					    ">col</div>
					    <div class="col" style="
					    	background-image: url(style/img/valo.jpeg);
					    	background-position: center;
					    	background-repeat: no-repeat;
					    	background-size: cover;
					    	border-radius: 20px;
					    ">col</div>
					    <div class="w-100" style="
					    	background-image: url(style/img/Slither.jpeg);
					    	background-position: center;
					    	background-repeat: no-repeat;
					    	background-size: cover;
					    	border-radius: 20px;
					    	margin-top: 5px;
					    	margin-bottom: 5px;
					    "></div>
					    <div class="col" style="
					    	background-image: url(style/img/Csgo.jpeg);
					    	background-position: center;
					    	background-repeat: no-repeat;
					    	background-size: cover;
					    	border-radius: 20px;
					    	margin-right: 5px;
					    ">col</div>
					    <div class="col" style="
					    	background-image: url(style/img/Pubg.jpeg);
					    	background-position: center;
					    	background-repeat: no-repeat;
					    	background-size: cover;
					    	border-radius: 20px;
					    ">col</div>
					  </div>
					</div>
				</div>
			</div>
			<!-- Section Form -->
			<div style="
				flex: 1;
			">
				<div style="
					width: 90%;
					height: 70vh;
					margin-left: 5%;
					margin-top: 20%;
					border-radius: 20px;
					

				">
					<form action="DaftarTeam.php" method="post" style="
						padding: 30px 150px 30px 150px;
						list-style: none;
						color: white;
						background-color: rgba(52, 73, 94, 0.7);
						border-radius: 10px;
					">
						<h2 style="text-align: center;">Pendaftaran Team</h2>
						<li style="
							padding-left: 40px;
						">
							<label>Nama Team</label><br>
							<input type="text" name="nama" required style="
								outline: none;
							border: none;
							border-radius: 10px;
							font-size: 17px;
							background-color: #f9f9f9;
							padding: 5px 10px 5px 10px;
							width: 100%;
							">
						</li>
						<li style="
							padding-left: 40px;
							margin-top: 10px;
						">
							<label>No. Handphone</label><br>
							<input type="text" name="telp" maxlength="12" required style="
								outline: none;
							border: none;
							border-radius: 10px;
							font-size: 17px;
							background-color: #f9f9f9;
							padding: 5px 10px 5px 10px;
							width: 100%;
							">
						</li>
						<li style="
							padding-left: 40px;
							margin-top: 10px;
						">
							<label>Jumlah anggota</label><br>
							<input type="number" name="anggota" maxlength="12" required style="
								outline: none;
							border: none;
							border-radius: 10px;
							font-size: 17px;
							background-color: #f9f9f9;
							padding: 5px 10px 5px 10px;
							width: 100%;
							">
						</li>
						<li style="
							padding-left: 40px;
							margin-top: 10px;
						">
							<label>Password</label><br>
							<input type="Password" name="password" maxlength="12" required style="
								outline: none;
							border: none;
							border-radius: 10px;
							font-size: 17px;
							background-color: #f9f9f9;
							padding: 5px 10px 5px 10px;
							width: 100%;
							">
						</li>
						<table width="80%" style="margin-left: 100px;">
							<tr>
								<td style="padding-right: 25px "><input type="submit" class="btn btn-primary" name="submit" value="Daftar" style="
								width: 100%;
								margin-top: 15px;
								border-radius: 10px;
								"></td>
								<td><a href="loginTeam.php"><input type="" class="btn btn-primary" name="tambah" value="Anggota" style="
								width: 50%;
								margin-top: 15px;
								border-radius: 10px;
								"></a></td>
								<a href="index.php"><button type="button" class="btn btn-primary" name="submitt" style="
								width: 45%;
								margin-top: 15px;
								border-radius: 10px;
								margin-left: 30%;
								color: white;
								">
									Back To Home
							</button></a>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</section>
	</main>
</body>
</html>