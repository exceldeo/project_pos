 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Cetak invoice - Sistem Point Of Sales (POS)</title>
 	<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
 	<style>
		*{
			font-size: 20px;
		}
		</style>
 </head>
 <body style="padding-right: 17px;">


 	<?php 
 	if($_GET['id']){
 		?>
 		<?php 
 		include "../koneksi.php";
 		$id = $_GET['id'];
 		$invoice = mysqli_query($koneksi,"select * from invoice,kasir where invoice_kasir=kasir_id and invoice_id='$id'");
 		while($d = mysqli_fetch_array($invoice)){
 			?>

			<div class="row justify-content-md-center">
				<div class="col-lg-4 text-center">
					<center>
						<img src="../assets/logo.jpeg" style="width: 170px">
					</center>
				</div>
			</div>

 			<div class="row">
 				<div class="col-lg-4">
 					<table class="table">
 						<tr>
 							<th>No. Invoice</th>
 							<th>:</th>
 							<td><?php echo $d['invoice_nomor']; ?></td>
 						</tr>
 						<tr>
 							<th>Tanggal Invoice</th>
 							<th>:</th>
 							<td><?php echo date('d-m-Y', strtotime($d['invoice_tanggal'])); ?></td>
 						</tr>
 						<tr>
 							<th>Pelanggan</th>
 							<th>:</th>
 							<td><?php echo $d['invoice_pelanggan']; ?></td>
 						</tr>
 						<!-- <tr>
 							<th width="40%">Kasir yang melayani</th>
 							<th width="1%">:</th>
 							<td><?php echo $d['kasir_nama']; ?></td>
 						</tr> -->
 					</table>					
 				</div>
 			</div>

 			<!-- <h5><b>Daftar Pembelian</b></h5> -->
			 <!-- <hr> -->


 			<table class="table table-bordered table-striped table-hover" id="table-pembelian">
 				<thead>
 					<tr>
 						<th>Produk</th>
 						<th width="1%" style="text-align: center;">Harga</th>
 						<th width="1%" style="text-align: center;">Qty</th>
 						<th width="1%" style="text-align: right;">Total</th>
 					</tr>
 				</thead>
 				<tbody>
 					<?php 
 					$id_invoice = $d['invoice_id'];
 					$ppata = mysqli_query($koneksi,"SELECT * FROM produk,kategori,transaksi where produk_kategori=kategori_id and transaksi_invoice='$id_invoice' and transaksi_produk=produk_id");
 					while($pp = mysqli_fetch_array($ppata)){
 						?>
 						<tr>
 							<td >
 								<?php echo $pp['produk_nama']; ?>
 							</td>
 							<td style="text-align: center;"><?php echo number_format($pp['transaksi_harga']); ?></td>  
 							<td style="text-align: center;"><?php echo $pp['transaksi_jumlah']; ?></td>
 							<td style="text-align: right;"><?php echo number_format($pp['transaksi_total']); ?></td>  
 						</tr>
 						<?php 
 					}
 					?>
 				</tbody>
 			</table>


 			<div class="row">
 				<div class="col-lg-6">
 					<table class="table table-bordered table-striped">
 						<tr>
 							<th width="30%">Sub Total</th>
 							<td>
 								<span class="sub_total_pembelian"><?php echo number_format($d['invoice_sub_total']); ?></span>
 							</td>
 						</tr>
 						<tr>
 							<th>Diskon</th>
 							<td>
 								<?php echo $d['invoice_diskon'] ?>%
 							</td>
 						</tr>
 						<tr>
 							<th>Total</th>
 							<td>
 								<span class="total_pembelian"><?php echo number_format($d['invoice_total']); ?></span>
 							</td>
 						</tr>
 					</table>
 				</div>
 			</div>

			<hr>

			<div class="row justify-content-md-center">
				<div class="col-lg-4 text-center">
					Thank you
				</div>
			</div>

 			<?php 
 		}
 		?>
 		<?php 
 	}else{
 		?>

 		<div class="alert alert-info text-center">
 			Silahkan Filter Laporan Terlebih Dulu.
 		</div>

 		<?php
 	}
 	?>

 	<script>
 		window.print();
		 window.onafterprint = function(){
			const queryString = window.location.search;
			const urlParams = new URLSearchParams(queryString);
			const redirect = urlParams.get('redirect');
			 if(redirect){
				 window.location.href = "penjualan_tambah.php?alert=success"
			 }else{
				 window.close();
			 }
		}
 	</script>
	

 </body>
 </html>
