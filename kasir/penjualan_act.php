<?php 
include '../koneksi.php';
session_start();
$nomor = $_POST['nomor'];
$tanggal = $_POST['tanggal'];
$pelanggan = $_POST['pelanggan'];
$kasir = $_SESSION['id'];
$sub_total = $_POST['sub_total'];
$diskon = $_POST['diskon'];
$total = $_POST['total'];

mysqli_query($koneksi, "insert into invoice values(NULL,'$nomor','$tanggal','$pelanggan','$kasir','$sub_total','$diskon','$total')")or die(mysqli_errno($koneksi));

$id_invoice = mysqli_insert_id($koneksi);

$transaksi_produk = $_POST['transaksi_produk'];
$transaksi_harga = $_POST['transaksi_harga'];
$transaksi_jumlah = $_POST['transaksi_jumlah'];
$transaksi_total = $_POST['transaksi_total'];

$jumlah_pembelian = count($transaksi_produk);

for($a=0;$a<$jumlah_pembelian;$a++){

	$t_produk = $transaksi_produk[$a];
	$t_harga = $transaksi_harga[$a];
	$t_jumlah = $transaksi_jumlah[$a];
	$t_total = $transaksi_total[$a];

	// ambil jumlah produk
	$detail = mysqli_query($koneksi, "select * from produk where produk_id='$t_produk'");
	$de = mysqli_fetch_assoc($detail);
	$jumlah_produk = $de['produk_stok'];

	// kurangi jumlah produk
	$jp = $jumlah_produk-$t_jumlah;
	mysqli_query($koneksi, "update produk set produk_stok='$jp' where produk_id='$t_produk'");

	// simpan data pembelian
	mysqli_query($koneksi, "insert into transaksi values(NULL,'$id_invoice','$t_produk','$t_harga','$t_jumlah','$t_total')")or die(mysqli_errno($koneksi));

}
header("location:penjualan_print.php?id=".$id_invoice."&redirect=true");

// i want to redirect to penjualan_tambah.php and open penjualan_print.php?id=<?php echo $d['invoice_id']; in new tab in php way
?>
<!-- <html>
<head>
	  	<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
		<link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="../assets/bower_components/morris.js/morris.css">
		<link rel="stylesheet" href="../assets/bower_components/jvectormap/jquery-jvectormap.css">
		<link rel="stylesheet" href="../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" href="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
		<link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<title></title>
</head>
<body >
	<div class="container" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
		<div class="row">
			<div class="col-lg-12">
				<img src="../gambar/sistem/check.png" class="img img-responsive" style="width: 150px; margin: 0 auto;">
				<h2 class="text-center">
					Transaksi berhasil dibuat
				</h2>

			</div>
			<div class="col-lg-12 text-center" style="margin-top: 20px;">
				<a href="penjualan_tambah.php" class="btn btn-lg btn-secondary" style="margin-right: 50px;">Kembali</a>
				<a href="penjualan_print.php?id=<?php echo $id_invoice; ?>" class="btn btn-lg btn-primary" target="_blank">Print Nota</a>
			</div>
		</div>
	</div>
</body>
</html> -->


