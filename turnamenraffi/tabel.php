<?php
$urut=0;
include 'config.php';

?>
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<title>Menampilkan Data MySQL Ke Dalam Tabel HTML</title>
	<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
			background-image: url(style/img/backGame.jpeg);
			background-repeat: no-repeat;
			background-size: cover;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
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
			text-align: right;
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
<body>
	<h1>Daftar Team Esport</h1>
	<table class="data-table">
<!-- 		<caption class="title">Daftar Team Esport</caption> -->
		<thead>
			<tr>
				<th>NO</th>
				<th>Nama Team</th>
				<th>Game</th>
				<th>Hapus</th>		
			</tr>
		</thead>
		<tbody>
			<?php
				$query2 = "SELECT * FROM pendaftaran";
				$sql2 = mysqli_query($connect, $query2);

				while($datapendaftaran = mysqli_fetch_array($sql2)) {
					$idteam = $datapendaftaran['id_team'];
					$idgame = $datapendaftaran['id_game'];

					$query1 = "SELECT * FROM team WHERE id_team = '$idteam'";
					$sql1 = mysqli_query($connect, $query1);
					$datateam = mysqli_fetch_array($sql1);

					$query3 = "SELECT * FROM game WHERE id_game = '$idgame'";
					$sql3 = mysqli_query($connect, $query3);
					$datagame = mysqli_fetch_array($sql3);

					$urut=$urut+1;

			    	echo "<tr>";
			    	echo "<td>".$urut."</td>";
			        echo "<td>".$datateam['nama']."</td>";
			        echo "<td>".$datagame['nama']."</td>";
			        echo "<td><a href='delete.php?id=$datapendaftaran[id_pendaftaran]'>Hapus</a></td>"; 
			        echo "</tr>"; 
			    	}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="3">TOTAL PENDAFTARAN</th>
				<th><?php echo $urut ?> Pendaftaran</th>

			</tr>

		</tfoot>
	</table>
	<a href="index.php"><button type="button" class="btn btn-primary" name="submitt" style="
		width: 40%;
		margin-top: 15px;
		border-radius: 10px;
		margin-left: 30%;
		color: white;
	">
		Back To Home
	</button></a>
</body>
</html>