<?php 
include "koneksi.php";

$id = $_GET['id'];

// buat query hapus
$sql = "DELETE FROM daftar WHERE id=$id";
$query = mysqli_query($db, $sql);

// apakah query hapus berhasil?
if( $query ){
	header('Location: tes_qti.php');
} else {
	die("gagal menghapus...");
}

?>