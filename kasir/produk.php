<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Produk
      <small>Data Produk</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Produk</h3>
          </div>
          
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>KODE</th>
                    <th>NAMA PRODUK</th>
                    <th>SATUAN</th>
                    <th>KATEGORI</th>
                    <th>STOK</th>
                    <th>MODAL</th>
                    <th>JUAL</th>
                    <th>KETERANGAN</th>
                    <th width="5%">FOTO</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM produk, kategori where produk_kategori=kategori_id order by produk_id desc");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['produk_kode']; ?></td>
                      <td><?php echo $d['produk_nama']; ?></td>
                      <td><?php echo $d['produk_satuan']; ?></td>
                      <td><?php echo $d['kategori']; ?></td>
                      <td><?php echo $d['produk_stok']; ?></td>
                      <td><?php echo "Rp.".number_format($d['produk_harga_modal']).",-"; ?></td>
                      <td><?php echo "Rp.".number_format($d['produk_harga_jual']).",-"; ?></td>
                      <td><?php echo $d['produk_keterangan']; ?></td>
                      <td>

                       <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#foto_<?php echo $d['produk_id'] ?>">
                        <i class="fa fa-image"></i> Lihat
                      </button>

                      <!-- modal hapus -->
                      <div class="modal fade" id="foto_<?php echo $d['produk_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">

                              <center>
                                <?php if($d['produk_foto'] == ""){ ?>
                                  <img src="../gambar/sistem/produk.png" style="width: 100%;height: auto">
                                <?php }else{ ?>
                                  <img src="../gambar/produk/<?php echo $d['produk_foto'] ?>" style="width: 100% ;height: auto">
                                <?php } ?>
                              </center>

                            </div>
                          </div>
                        </div>
                      </div>

                    </td>
                  </tr>
                  <?php 
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </section>
  </div>
</section>

</div>
<?php include 'footer.php'; ?>