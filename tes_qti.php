<html>
<head>
<title>Data Pendaftaran</title>
</head>
<body>
<form name="form1" method="post" action="">
<h2>Pendaftaran</h2>
<table width="600" border="0">
  <tr>
    <td width="138">Nama Lengkap</td>
    <td width="452"><input name="nama" type="text" size="50" ></td>
  </tr>
  <tr>
    <td>User Name</td>
    <td><input type="text" name="user"></td>
  </tr>
  <tr>
    <td>Password </td>
    <td><input type="password" name="pass"></td>
  </tr>
  <tr>
    <td>Alamat </td>
    <td><label for="textarea"></label>
      <textarea name="alamat" id="textarea" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="input" value="Daftar"></td>
  </tr>
</table>
</form>
</body>
</html>

<?php
include "koneksi.php";

if(isset($_POST['input'])){

$nama = $_POST['nama'];
$user = $_POST['user'];
$pass= $_POST['pass'];
$alamat= $_POST['alamat']; 

$sql = "INSERT INTO daftar(id, nama, user, pass, alamat) VALUE ('','$nama', '$user', '$pass', '$alamat')";
$query = mysqli_query($db, $sql);
}
?>



<?php include("koneksi.php");?>

<html>
<body>
	<br>
	<header>
		<h3>Data Anggota yang Telah Mendaftar</h3>
	</header>
    
    
	<?php
    include "koneksi.php"; 
    $BatasAwal = 3;
	if (!empty($_GET['page'])) {
	$hal = $_GET['page'] - 1;
	$MulaiAwal = $BatasAwal * $hal;
	} else if (!empty($_GET['page']) and $_GET['page'] == 1) {
	$MulaiAwal = 0;
	} else if (empty($_GET['page'])) {
	$MulaiAwal = 0;
	}//tampil data
    ?>
    
	<table border="1">
	<thead>
		<tr>
			<th>No</th>
            <th>Nama</th>
			<th>User Name</th>
			<th>Password</th>
			<th>Alamat</th>
            <th>Tindakan</th>
		</tr>
	</thead>
	<tbody>

		<?php
		$sql = "SELECT * FROM daftar LIMIT $MulaiAwal , $BatasAwal";
		$query = mysqli_query($db, $sql);

		while($data = mysqli_fetch_array($query)){
			echo "<tr>";
			echo "<td>".$data['id']."</td>";
			echo "<td>".$data['nama']."</td>";
			echo "<td>".$data['user']."</td>";
			echo "<td>".$data['pass']."</td>";
			echo "<td>".$data['alamat']."</td>";

			echo "<td>";
			echo "<a href='edit.php?id=".$data['id']."'>Edit</a> | ";
			echo "<a href='hapus.php?id=".$data['id']."'>Hapus</a>";
			echo "</td>";

			echo "</tr>";
		}
		?>

	</tbody>
	</table>

	<?php
	include "koneksi.php";
    $cekQuery = "SELECT * FROM daftar";
	$query = mysqli_query($db, $cekQuery);
	$jumlahData = mysqli_num_rows($query);
	
	if ($jumlahData > $BatasAwal) {
		echo '<br/><div style="font-size:12pt;">Page : ';
		$a = explode(".", $jumlahData / $BatasAwal);
		$b = $a[0];
		$c = $b + 1;
		for ($i = 1; $i <= $c; $i++) {
		echo '<a style="text-decoration:none;';
		if ($_GET['page'] == $i) {
			echo 'color:red';
		}
			echo '" href="?page=' . $i . '">' . $i . '</a>, ';
		}
		echo '</div>';
	} ?>
        
    </body>
</html>




