<?php
$id = $_GET['id'];
include 'config.php';

$result = mysqli_query($connect, "DELETE FROM pendaftaran WHERE id_pendaftaran=$id");

if($result){
header("Location: tabel.php");
}
?>