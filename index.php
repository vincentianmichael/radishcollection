<!DOCTYPE html>
<html>
<head>
	<title>CRUD Toko Batik</title>
</head>
<body>

<?php

// --- koneksi ke database
$koneksi = mysqli_connect("localhost","root","","batik") or die(mysqli_error());

// --- Fngsi tambah data (Create)
function tambah($koneksi){
	
	if (isset($_POST['btn_simpan'])){
		$kode = $_POST['kode1'];
		$nama = $_POST['nama1'];
		$jumlah = $_POST['jumlah1'];
		$tanggal = $_POST['tanggal1'];
		
		if(!empty($kode) && !empty($nama) && !empty($jumlah) && !empty($tanggal)){
			$sql = "INSERT INTO databatik (kode, nama, jumlah, tanggal) VALUES(".$kode.",'".$nama."','".$jumlah."','".$tanggal."')";
			$simpan = mysqli_query($koneksi, $sql);
			if($simpan && isset($_GET['aksi'])){
				if($_GET['aksi'] == 'create'){
					header('location: index.php');
				}
			}
		} else {
			$pesan = "Tidak dapat menyimpan, data belum lengkap!";
		}
	}

	?> 
		<form action="" method="POST">
			<fieldset>
				<legend><h2>Tambah data</h2></legend>
				<label>Kode Barang <input type="text" name="kode1" /></label> <br>
				<label>Nama Barang <input type="text" name="nama1" /></label><br>
				<label>Jumlah Barang <input type="number" name="jumlah1" /> Pcs </label> <br>
				<label>Tanggal Masuk <input type="date" name="tanggal1" /></label> <br>
				<br>
				<label>
					<input type="submit" name="btn_simpan" value="Simpan"/>
					<input type="reset" name="reset" value="Besihkan"/>
				</label>
				<br>
				<p><?php echo isset($pesan) ? $pesan : "" ?></p>
			</fieldset>
		</form>
	<?php

}
// --- Tutup Fngsi tambah data

// --- Fungsi Baca Data (Read)
function tampil_data($koneksi){
	$sql = "SELECT * FROM databatik";
	$query = mysqli_query($koneksi, $sql);
	
	echo "<fieldset>";
	echo "<legend><h2>Data Batik</h2></legend>";
	
	echo "<table border='1' cellpadding='10'>";
	echo "<tr>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Jumlah Barang</th>
			<th>Tanggal Masuk</th>
			<th>Tindakan</th>
		  </tr>";
	
	while($data = mysqli_fetch_array($query)){
		?>
			<tr>
				<td><?php echo $data['kode']; ?></td>
				<td><?php echo $data['nama']; ?></td>
				<td><?php echo $data['jumlah']; ?> Pcs</td>
				<td><?php echo $data['tanggal']; ?></td>
				<td>
					<a href="index.php?aksi=update&kode=<?php echo $data['kode']; ?>&nama=<?php echo $data['nama']; ?>&jumlah=<?php echo $data['jumlah']; ?>&tanggal=<?php echo $data['tanggal']; ?>">Ubah</a> |
					<a href="index.php?aksi=delete&kode=<?php echo $data['kode']; ?>">Hapus</a>
				</td>
			</tr>
		<?php
	}
	echo "</table>";
	echo "</fieldset>";
}
// --- Tutup Fungsi Baca Data (Read)


// --- Fungsi Ubah Data (Update)
function ubah($koneksi){

	// ubah data
	if(isset($_POST['btn_ubah'])){
		$kodelama = $_POST['kodelama'];
		$kode = $_POST['kode1'];
		$nama = $_POST['nama1'];
		$jumlah = $_POST['jumlah1'];
		$tanggal = $_POST['tanggal1'];
		var_dump($_POST);
		if(!empty($kode) && !empty($nama) && !empty($jumlah) && !empty($tanggal)){
			$perubahan = "kode='${kode}',nama='${nama}',jumlah=${jumlah},tanggal='${tanggal}'";
			$sql_update = "UPDATE databatik SET ${perubahan} WHERE kode='${kodelama}'";
			$update = mysqli_query($koneksi, $sql_update);			
			if($update && isset($_GET['aksi'])){
				if($_GET['aksi'] == 'update'){
					header('location: index.php');
				}
			}
		} else {
			$pesan = "Data tidak lengkap!";
		}
	}
	// tampilkan form ubah
	if(isset($_GET['kode'])){
		?>
			<a href="index.php"> &laquo; Home</a> | 
			<a href="index.php?aksi=create"> (+) Tambah Data</a>
			<hr>
			
			<form action="index.php?aksi=update" method="POST">
			<fieldset>
				<legend><h2>Ubah data</h2></legend>
				<input type="hidden" name="kodelama" value="<?php echo $_GET['kode'] ?>"/>
				<label>Kode Barang <input type="text" name="kode1" value="<?php echo $_GET['kode'] ?>"/></label> <br>
				<label>Nama Barang  <input type="text" name="nama1" value="<?php echo $_GET['nama'] ?>"/></label><br>
				<label>Jumlah Barang <input type="number" name="jumlah1" value="<?php echo $_GET['jumlah'] ?>"/> Pcs</label> <br>
				<label>Tanggal Masuk <input type="date" name="tanggal1" value="<?php echo $_GET['tanggal'] ?>"/></label> <br>
				<br>
				<label>
					<input type="submit" name="btn_ubah" value="Simpan Perubahan"/> atau <a href="index.php?aksi=delete&kode=<?php echo $_GET['kode'] ?>"> (x) Hapus data ini</a>!
				</label>
				<br>
				<p><?php echo isset($pesan) ? $pesan : "" ?></p>
				
			</fieldset>
			</form>
		<?php
	}
	
}
// --- Tutup Fungsi Update
	
// --- Fungsi Delete
function hapus($koneksi){

	if(isset($_GET['kode']) && isset($_GET['aksi'])){
		$kode = $_GET['kode'];
		$sql_hapus = "DELETE FROM databatik WHERE kode=" . $kode;
		$hapus = mysqli_query($koneksi, $sql_hapus);
		
		if($hapus){
			if($_GET['aksi'] == 'delete'){
				header('location: index.php');
			}
		}
	}
	
}
// --- Tutup Fungsi Hapus


// ===================================================================
// --- Program Utama
if (isset($_GET['aksi'])){
	switch($_GET['aksi']){
		case "create":
			echo '<a href="index.php"> &laquo; Home</a>';
			tambah($koneksi);
			break;
		case "read":
			tampil_data($koneksi);
			break;
		case "update":
			ubah($koneksi);
			tampil_data($koneksi);
			break;
		case "delete":
			hapus($koneksi);
			break;
		default:
			echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidaka ada!</h3>";
			tambah($koneksi);
			tampil_data($koneksi);
	}
} else {
	tambah($koneksi);
	tampil_data($koneksi);
}

?>
</body>
</html>
