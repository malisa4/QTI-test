<?php
include("koneksi.php");

// kalau tidak ada id di query string
if( !isset($_GET['id']) ){
	header('Location: tes_qti.php');
}

//ambil id dari query string
$id = $_GET['id'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM daftar WHERE id=$id";
$query = mysqli_query($db, $sql);
$data = mysqli_fetch_assoc($query);

// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
	die("data tidak ditemukan...");
}

?>
<html>
<head>
<title>Data Pendaftaran</title>
</head>
<body>
<form name="form1" method="post" action="">
<h2>Edit Data Pendaftaran</h2>
<table width="600" border="0">
  <tr>
    <td width="138">Nama Lengkap</td>
    <td width="452"><input name="nama" type="text" size="50" value="<?php echo $data['nama'] ?>"> <input type="hidden" name="id" value="<?php echo $data['id'] ?>" /></td>
  </tr>
  <tr>
    <td>User Name</td>
    <td><input type="text" name="user" value="<?php echo $data['user'] ?>"></td>
  </tr>
  <tr>
    <td>Password </td>
    <td><input type="text" name="pass" value="<?php echo $data['pass'] ?>"></td>
  </tr>
  <tr>
    <td>Alamat </td>
    <td><label for="textarea"></label>
      <textarea name="alamat" id="textarea" cols="45" rows="5"><?php echo $data['alamat'] ?></textarea></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="edit" value="Edit"></td>
  </tr>
</table>
</form>
</body>
</html>
	

<?php
include "koneksi.php";

if(isset($_POST['edit'])){

	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$user = $_POST['user'];
	$pass= $_POST['pass'];
	$alamat= $_POST['alamat']; 
	
	$sql = "UPDATE daftar SET nama='$nama', user='$user', pass='$pass', alamat='$alamat' WHERE id=$id";
	$query = mysqli_query($db, $sql);

	if( $query ) {
		header('Location: tes_qti.php');
	} else {
		die("Gagal menyimpan perubahan...");
	}
	
}

?>