<?php
$urut = 0;
$idteam = $_GET['id'];
include 'config.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $idteam = $_POST['id_team']; // Perubahan: Mengambil id_team dari form
    
    $stmt = $connect->prepare("INSERT INTO anggota (id_team, nama) VALUES (?, ?)");
    $stmt->bind_param("is", $idteam, $nama);
    $result = $stmt->execute();

    if ($result) {
        $query1 = "SELECT * FROM team WHERE id_team = '$idteam'";
        $sql1 = mysqli_query($connect, $query1);
        $datateam = mysqli_fetch_array($sql1);

        $jumlahanggota = $datateam['jumlah_anggota'];
        $jumlahanggotanow = $jumlahanggota + 1;

        $result1 = mysqli_query($connect, "UPDATE team SET jumlah_anggota='$jumlahanggotanow' WHERE id_team='$idteam'");
        if ($result1) {
            header("Location: DaftarAnggota.php?id=$idteam");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar Anggota</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
			background-repeat: no-repeat;
			background-size: cover;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
			margin-top: 15%;
			margin-left: 0px;
			background-color: #bdc3c7;
		}

		h1 {
			margin: 25px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 17px;
			margin-bottom: 15px;
			color: white;
		}

		table td {
			transition: all .5s;
		}
		a{
			text-decoration: none;
			color: white;
			font-weight: 800;
		}
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
	</style>
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
					<form action="" method="post" style="
						padding: 10px;
						list-style: none;
						color: white;
					">
					<input type="hidden" name="id_team" value="<?= $idteam?>">
						<h2 style="text-align: center;">Pendaftaran Anggota</h2>
						<li style="
							padding-left: 30%;
						">
							<label>Nama Anggota</label><br>
							<input type="text" name="nama" style="
								outline: none;
							border: none;
							border-radius: 10px;
							font-size: 17px;
							background-color: #f9f9f9;
							padding: 5px 10px 5px 10px;
							width: 60%;
							">
						</li>
						 <input type="submit" class="btn btn-primary" name="submit" value="Submit" style="
							width: 42%;
							margin-top: 15px;
							border-radius: 10px;
							margin-left: 30%;
						">
						<a href="index.php"><button type="button" class="btn btn-primary" name="submitt" style="
							width: 42%;
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

				<table class="data-table">
		<!-- 		<caption class="title">Daftar Team Esport</caption> -->
				<thead>
					<tr>
						<th>NO</th>
						<th>Nama Anggota</th>
					</tr>
				</thead>
				<tbody>
					<?php
							$query1 = "SELECT * FROM anggota WHERE id_team = '".$idteam."'";
							$sql1 = mysqli_query($connect, $query1);

							while($dataanggota = mysqli_fetch_array($sql1)) {     
								$urut=$urut+1;
					    	echo "<tr>";
					        echo "<td>".$urut."</td>";
							echo "<td>".$dataanggota['nama']."</td>";
							echo "</tr>"; 
					    	}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>TOTAL</th>
						<th><?php echo $urut ?> Anggota</th>

					</tr>

				</tfoot>
			</table>

				</div>
			</div>
		</section>
	</main>
</body>
</html>
