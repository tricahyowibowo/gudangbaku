  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tabel Barang Masuk
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Tables</li>
        <li class="active"><a href="<?=base_url('admin/tabel_barangmasuk')?>"></a>Tabel Barang Masuk</li>
      </ol>

      <a type="button" style="margin-top:20px;" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
        <i class="fa fa-plus" aria-hidden="true"></i>
        Tambah Penerimaan Barang
      </a>

      <a href="<?=base_url('barangkeluar/barang_keluar/')?>" type="button" style="margin-top:20px;" class="btn btn-danger pull-right">
        <i class="fa fa-sign-out" aria-hidden="true"></i>
        Tambah Pengeluaran Barang
      </a>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- .VIEW TABEL DATA ---->
          <!-- .BOX KARANTINA ---->
          <div class="box box-warning box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Stok Karantina</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="karantina" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Nota</th>
                    <th>Pemilik</th>
                    <th>Tanggal Datang</th>
                    <th>Supplier</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                  
                    <?php if(COUNT($list_karantina) != 0){ ?>
                    <?php $no = 1;?>
                    <?php foreach($list_karantina as $dd): ?>
                    <td><?=$no?></td>
                    <td><?= $dd->no_nota?></td>
                    <td><?=$dd->nama_perusahaan?></td>
                    <td><?=strftime('%d %b %Y', strtotime($dd->tgl_masuk_barang))?></td>
                    <td><?=$dd->nama_supplier?></td>
                    <td>
                    <?php 
                    $cek = $dd->status;
                    switch ($cek) {
                      case "karantina":?>
                        <span class="label label-warning">Karantina</span>
                      <?php break;
                      default:?>
                        <span class="label label-success">Realease</span>
                    <?php } ?>
                    </td>
                    
                    <!-- <td><a type="button" class="btn btn-danger btn-delete"  href="<?=base_url('barangmasuk/delete_barang/'.$dd->id_barang_masuk)?>" name="btn_delete" style="margin:auto;"><i class="fa fa-trash" aria-hidden="true"></i></a></td> -->
                    <td><a href="<?=base_url('barangmasuk/detail_tabel/'.$dd->no_nota)?>" type="button" class="btn btn-primary btn-sm btn-detail">detail</a></td>
                    <!-- <td><a type="button" class="btn btn-primary btn-sm btn-detail" data-toggle="modal"  data-target="#modal-detail" 
                           data-nota="<?= $dd->no_nota?>"
                           data-nama_perusahaan="<?= $dd->nama_perusahaan?>"
                           data-tgl_masuk_barang="<?= $dd->tgl_masuk_barang?>"
                           data-nama_supplier="<?= $dd->nama_supplier?>"
                           data-nama_bahan="<?= $dd->nama_bahan?>"
                           data-jml_barang="<?= $dd->jml_barang?>"
                           data-satuan_kode="<?= $dd->satuan_kode?>"
                           data-coa="<?= $dd->coa?>"
                           data-tgl_coa="<?= $dd->tgl_coa?>"
                           data-halal="<?= $dd->halal?>"
                           data-tgl_halal="<?= $dd->tgl_halal?>"
                           data-expired_date="<?= $dd->expired_date?>"
                           data-batch="<?= $dd->batch?>"
                           style="margin:auto;">detail</a></td> -->
                    <!-- <td><a type="button" class="btn btn-success btn-sm btn-release"  href="<?=base_url('barangmasuk/release/'.$dd->id_barang_masuk)?>" name="btn_release" style="margin:auto;">release</a></td> -->
                  </tr>
                <?php $no++; ?>
                <?php endforeach;?>
                <?php }else { ?>
                      <td><strong>Data Kosong</strong></td>
                      <td><strong>Data Kosong</strong></td>
                      <td><strong>Data Kosong</strong></td>
                      <td><strong>Data Kosong</strong></td>
                      <td><strong>Data Kosong</strong></td>
                      <td><strong>Data Kosong</strong></td>
                      <td><strong>Data Kosong</strong></td>
                <?php } ?>
                </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.BOX KARANTINA ---->

          <!-- .BOX RELEASE ---->
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><strong>Stok Release</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">  
              <!-- .tabel release -->
              <table id="release" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Bahan</th>
                  <th>Nama Bahan</th>
                  <th>Pemilik</th>
                  <th>Supplier</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                  <th>Expired Date</th>
                  <th>Batch</th>
                  <th>No. Seri</th>
                  <th>Status</th>
                  <th>detail</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php if(is_array($list_release)){ ?>
                    <?php $no = 1;?>
                    <?php foreach($list_release as $dd): ?>
                    <td><?=$no?></td>
                    <td><?=$dd->kode_barang?></td>
                    <td><?=$dd->nama_bahan?></td>
                    <td><?=$dd->nama_perusahaan?></td>
                    <td><?=$dd->nama_supplier?></td>
                    <td><?=$dd->jml_barang?></td>
                    <td><?=$dd->satuan_kode?></td>
                    <td><?=strftime('%d %b %Y', strtotime($dd->expired_date))?></td>
                    <td><?=$dd->batch?></td>
                    <td><?=$dd->seri?></td>
                    <td>
                    <?php 
                    $cek = $dd->status;
                    switch ($cek) {
                      case "karantina":?>
                        <span class="label label-warning">Karantina</span>
                      <?php break;
                      default:?>
                        <span class="label label-success">Realease</span>
                    <?php } ?>
                    </td>
                    <td><a href="<?=base_url('barangmasuk/detail_tabel/'.$dd->kode_barang)?>" type="button" class="btn btn-primary btn-sm btn-detail">detail</a></td>
                    <td><a type="button" class="btn btn-danger btn-delete"  href="<?=base_url('barangmasuk/delete_barang/'.$dd->id_barang_masuk)?>" name="btn_delete" style="margin:auto;"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                <?php $no++; ?>
                <?php endforeach;?>
                <?php }else { ?>
                      <td colspan="7" align="center"><strong>Data Kosong</strong></td>
                <?php } ?>
                </tbody>
              </table>
              <!-- /.tabel release -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.BOX KARANTINA ---->

          <!-- /.VIEW TABEL DATA ---->

          <!-- .INPUT DATA ---->
          <div class="modal fade" id="modal-add">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">TAMBAH PENERIMAAN BARANG</h4>
                </div>
                <div id="loading"></div>
                <form class="form-horizontal" action="<?=base_url('barangmasuk/input_data')?>" role="form" id="addBarang" method="post">
                  <div class="modal-body">
                    <div class="form-group">      
                      <label for="kode_transaksi" class="col-sm-4 control-label">No Nota :</label>
                        <div class="col-sm-3">
                        <input type="text" name="no_nota" id="no_nota" class="form-control" placeholder="Masukkan nomer nota">
                        </div>
                    </div>
                    <div class="form-group">      
                      <label for="status_barang" class="col-sm-4 control-label">Stok Untuk :</label>
                        <div class="col-sm-3">
                        <td><select class="form-control" name="status_barang"  id="status_barang">
                          <option value="">- Pilih Perusahaan -</option>
                          <?php foreach($list_perusahaan as $lp){ ?> 
                          <option value="<?=$lp->id_perusahaan?>"> <?=$lp->nama_perusahaan?></option>
                          <?php } ?>
                        </select></td>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="tgl_transaksi" class="col-sm-4 control-label" >Tanggal :</label>
                      <div class="col-sm-3">
                        <input type="date" name="tgl_datang" id="tgl_datang" class="form-control" placeholder="Klik Disini">
                      </div>
                    </div>  
                    <div class="form-group">  
                      <label for="supplier" class="col-sm-4 control-label">Diterima Dari :</label>
                      <div class="col-sm-3">
                        <td><select class="form-control" name="supplier"  id="supplier">
                          <option value="">- Pilih Supplier -</option>
                          <?php foreach($list_supplier as $ls){ ?> 
                          <option value="<?=$ls->id_supplier?>"> <?=$ls->nama_supplier?> - <?=$ls->alamat_supplier?></option>
                          <?php } ?>
                        </select></td>
                      </div>
                      <div class="col-sm-4">
                        <button type="button" class="btn btn-primary pull-right" id="btn-tambah-form">Tambah Data Form</button>
                      </div>
                    </div>    
                    <div id="insert-form"></div>

                    <div id="insert-tabel">
                      <table id="table1" name="table1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>C.O.A</th>
                            <th>tanggal C.O.A</th>
                            <th>Halal</th>
                            <th>tanggal Halal</th>
                            <th>Expired Date</th>
                            <th>Batch</th>
                            <th>No. Seri</th>
                            <th>Action</th>
                          <tr>
                        </thead>
                        <tbody id="body">
                        </tbody>
                      </table>
                    </div>

                    <input type="hidden" id="jumlah-form" value="0">
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <input type="submit" value="Simpan" class="btn pull-right btn btn-success"></input>
                  </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.INPUT DATA ---->
          <!-- /.MODAL -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
<script> 
// .PROSES ADD DATA 
  $(document).ready(function() {
    $("#btn-tambah-form").click(function() { // Ketika tombol Tambah Data Form di klik
      var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
      var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya
      // Kita akan menambahkan form dengan menggunakan append
      var no_nota = $("#no_nota").val();
      var status_barang = $("#status_barang").val();
      var tgl_datang = $("#tgl_datang").val();
      var supplier = $("#supplier").val();

        $("#table1").append(
        '<tr>' +
        '<input type="hidden" class="form-control" name="no_nota[]" value=' + no_nota + '>' +
        '<input type="hidden" class="form-control" name="status_barang[]" value=' + status_barang + '>' +
        '<input type="hidden" class="form-control" name="tgl_datang[]" value=' + tgl_datang + '>' +
        '<input type="hidden" class="form-control" name="supplier[]" value=' + supplier + '>' +
        '<td><select class="form-control" name="nama_barang[]">' +
        '<option value="">- Pilih barang -</option>'+
        '<?php foreach($list_bahan as $lb){ ?>'+ 
        '<option value="<?=$lb->kode_bahan?>"><?=$lb->kode_bahan?> - <?=$lb->nama_bahan?></option>'+
        '<?php } ?>'+
        '</select></td>'+
        '<td><input type="text" class="form-control" placeholder="jumlah" name="jml_barang[]"></td>' + 
        '<td><select class="form-control" name="satuan_kode[]">' +
        '<option value="">- Pilih Satuan -</option>'+
        '<?php foreach($list_satuan as $ls){ ?>'+ 
        '<option value="<?=$ls->kode_satuan?>"> <?=$ls->kode_satuan?></option>'+
        '<?php } ?>'+
        '</select></td>'+
        '<td><input type="checkbox" name="coa[]" value="ya"></td>'+
        '<td><input type="date" class="form-control" name="tgl_coa[]"></td>' +  
        '<td><input type="checkbox" name="halal[]" value="ya"></td>'+
        '<td><input type="date" class="form-control" name="tgl_halal[]"></td>' + 
        '<td><input type="date" class="form-control" name="expired_date[]"></td>' +
        '<td><input type="text" class="form-control" placeholder="Kode Batch" name="batch[]"></td>' +
        '<td><input type="text" class="form-control" placeholder="No. Seri" name="seri[]"></td>' +
        "<td><a href='javascript:void(0);' class='remCF btn btn-danger'><i class='fa fa-close'></i></a></td>" +
        "</tr>" +
        "<br><br>");

      $("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
    });

    $("#table1").on('click', '.remCF', function() {
      $(this).parent().parent().remove();
    });

    // Buat fungsi untuk mereset form ke semula
    $("#btn-reset-form").click(function() {
      $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form
      $("#jumlah-form").val("0"); // Ubah kembali value jumlah form menjadi 1
    });

    $("input")
      .keyup(function() {
        var value = $(this).val();
        $("#").text(value);
      })
      .keyup();
  });
// ./PROSES ADD DATA 

// .PROSES LOADING
  function loading(){
	  $("#addBarang").submit(function(){
        $("#loading").addClass('overlay');
        $("#loading").html('<i class="fa fa-spinner fa-spin"></i>');
		setTimeout(RemoveClass(), 500);
    });
    
    function RemoveClass(){
        $("#loading").RemoveClass('overlay');
        $("#loading").fadeOut();
    }
  }
// ./PROSES LOADING

// .PROSES SELECT
  $(".theSelect").select2();
// ./PROSES SELECT
</script>

<!-- <script>
    $(document).ready(function() {
    $('.btn-detail').on('click',function(){
      var nota = $(this).data('nota');
      var nama_perusahaan = $(this).data('nama_perusahaan');
      var tgl_masuk_barang = $(this).data('tgl_masuk_barang');
      var nama_supplier = $(this).data('nama_supplier');
      var nama_bahan = $(this).data('nama_bahan');
      var jml_barang = $(this).data('jml_barang');
      var satuan_kode = $(this).data('satuan_kode');
      var coa = $(this).data('coa');
      var tgl_coa = $(this).data('tgl_coa');
      var halal = $(this).data('halal');
      var tgl_halal = $(this).data('tgl_halal');
      var expired_date = $(this).data('expired_date');
      var batch = $(this).data('batch');

      $('#nota').text(nota);
      // $('#nama_perusahaan').text(nama_perusahaan);
      // $('#nama_perusahaan').text(nama_perusahaan);
      // $('#tgl_masuk_barang').text(tgl_masuk_barang);
      // $('#nama_supplier').text(nama_supplier);
      // $('#nama_bahan').text(nama_bahan);
      // $('#jml_barang').text(jml_barang);
      // $('#satuan_kode').text(satuan_kode);
      // $('#coa').text(coa);
      // $('#tgl_coa').text(tgl_coa);
      // $('#halal').text(halal);
      // $('#tgl_halal').text(tgl_halal);
      // $('#expired_date').text(expired_date);
      // $('#batch').text(batch);
    });
  });
</script> -->






  