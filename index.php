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
