<?php 
include 'header.php';
?>

<?php
$a = mysqli_query($koneksi, "SELECT * from barang_laku");
?>

<div class="col-md-10">
	<h3>Selamat datang</h3>	
    <h3>Aplikasi Penjualan Sederhana</h3>
    <h3>Radish Collections</h3>
</div>
<!-- kalender -->
<div class="pull-right">
	<div id="kalender"></div>
</div>

<?php 
include 'footer.php';

?>