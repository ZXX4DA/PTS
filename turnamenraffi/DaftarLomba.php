<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $game = $_POST['game'];
    $team = $_POST['team'];

    // Prepared statement untuk menghindari SQL Injection
    $query_game = "SELECT * FROM game WHERE nama = ?";
    $stmt_game = mysqli_prepare($connect, $query_game);
    mysqli_stmt_bind_param($stmt_game, "s", $game);
    mysqli_stmt_execute($stmt_game);
    $result_game = mysqli_stmt_get_result($stmt_game);
    $datagame = mysqli_fetch_array($result_game);

    if ($datagame) {
        $minimalanggota = $datagame['minimal_anggota'];
        $idgame = $datagame['id_game'];

        // Prepared statement untuk menghindari SQL Injection
        $query_team = "SELECT * FROM team WHERE nama = ?";
        $stmt_team = mysqli_prepare($connect, $query_team);
        mysqli_stmt_bind_param($stmt_team, "s", $team);
        mysqli_stmt_execute($stmt_team);
        $result_team = mysqli_stmt_get_result($stmt_team);
        $datateam = mysqli_fetch_array($result_team);

        if ($datateam) {
            $idteam = $datateam['id_team'];

            // Menghitung jumlah anggota tim
            $query_anggota = "SELECT COUNT(*) AS jumlah FROM anggota WHERE id_team = ?";
            $stmt_anggota = mysqli_prepare($connect, $query_anggota);
            mysqli_stmt_bind_param($stmt_anggota, "i", $idteam);
            mysqli_stmt_execute($stmt_anggota);
            $result_anggota = mysqli_stmt_get_result($stmt_anggota);
            $row_anggota = mysqli_fetch_assoc($result_anggota);
            $jumlah_anggota = $row_anggota['jumlah'];

            if ($jumlah_anggota >= $minimalanggota) {
                // Prepared statement untuk menghindari SQL Injection
                $query_insert = "INSERT INTO pendaftaran (id_team, id_game) VALUES (?, ?)";
                $stmt_insert = mysqli_prepare($connect, $query_insert);
                mysqli_stmt_bind_param($stmt_insert, "ii", $idteam, $idgame);
                $result_insert = mysqli_stmt_execute($stmt_insert);

                if ($result_insert) {
                    echo "<script>alert('Berhasil!');</script>";
                } else {
                    echo "<script>alert('Gagal menyimpan data!');</script>";
                }
            } else {
                echo "<script>alert('Jumlah Anggota Kurang!');</script>";
            }
        } else {
            echo "<script>alert('Tim tidak ditemukan!');</script>";
        }
    } else {
        echo "<script>alert('Game tidak ditemukan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar Tournament Game</title>
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
			<!-- Section Form -->
			<div style="
				flex: 1;
			">
				<div style="
					width: 90%;
					height: 70vh;
					margin-left: 5%;
					margin-top: 25%;
					border-radius: 20px;
				">
					<form action="DaftarLomba.php" method="post" style="
						padding: 10px;
						list-style: none;
						color: white;
					">
						<h2 style="text-align: center;">Pendaftaran Tournament</h2>
						<li style="
							padding-left: 30%;
						">
							<label>Pilih Game</label><br>
<select name="game" style="
    outline: none;
    border: none;
    border-radius: 10px;
    font-size: 17px;
    background-color: #f9f9f9;
    padding: 5px 10px 5px 10px;
    width: 60%;
">
    <optgroup label="Games">
        <?php
        // Lakukan koneksi ke database
        include 'config.php';

        // Query untuk mengambil data dari tabel game
        $query_game = "SELECT * FROM game";
        $result_game = mysqli_query($connect, $query_game);

        // Periksa apakah hasil kueri tidak kosong
        if (mysqli_num_rows($result_game) > 0) {
            // Loop melalui setiap baris hasil kueri dan cetak opsi dropdown
            while ($row_game = mysqli_fetch_assoc($result_game)) {
                echo "<option value='" . $row_game['nama'] . "'>" . $row_game['nama'] . "</option>";
            }
        } else {
            echo "<option value='' disabled selected>Tidak ada game yang tersedia</option>";
        }
        ?>
    </optgroup>
</select>

						</li>
						<li style="
							padding-left: 30%;
						">
							<label>Nama Team</label><br>
							<select name="team" style="
    outline: none;
    border: none;
    border-radius: 10px;
    font-size: 17px;
    background-color: #f9f9f9;
    padding: 5px 10px 5px 10px;
    width: 60%;
">
    <option disabled selected>Pilih</option>
    <?php
    // Panggil file konfigurasi database
    include 'config.php';

    // Query untuk mengambil data tim dari tabel team
    $query_team = "SELECT * FROM team";
    $result_team = mysqli_query($connect, $query_team);

    // Loop untuk menampilkan setiap nama tim sebagai opsi dalam dropdown
    while ($row_team = mysqli_fetch_assoc($result_team)) {
        echo "<option value='" . $row_team['nama'] . "'>" . $row_team['nama'] . "</option>";
    }
    ?>
</select>

						</li>
						 <input type="submit" class="btn btn-primary" name="submit" value="Submit" style="
							width: 30%;
							margin-top: 15px;
							border-radius: 10px;
							margin-left: 30%;
						">
						<a href="index.php"><button type="button" class="btn btn-primary" name="submitt" style="
							width: 30%;
							margin-top: 15px;
							border-radius: 10px;
							margin-left: 30%;
							color: white;
						">
		Back To Home
	</button></a>
					</form>
				</div>
			</div>
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
		</section>
	</main>
</body>
</html>