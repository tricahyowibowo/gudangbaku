  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <a type="button" class="btn btn-default"  href="<?=base_url('barangmasuk')?>" style="margin:auto;"><i class="fa fa-arrow-left"></i> Kembali</a>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Tables</li>
        <li class="active"><a href="<?=base_url('admin/tabel_barangmasuk')?>"></a>Tabel Barang Masuk</li>
      </ol>
      <?php if($this->session->flashdata('msg_berhasil')){ ?>
        <div class="alert alert-success alert-dismissible" style="width:100%">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
        </div>
      <?php } ?>

      <?php if($this->session->flashdata('msg_berhasil_keluar')){ ?>
        <div class="alert alert-success alert-dismissible" style="width:100%">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil_keluar');?>
        </div>
      <?php } ?>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <!-- .VIEW TABEL DATA ---->
          <div class="box box-<?php echo $colorbox?> box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Stok <?php echo $text ?> <?php echo $status ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if($status === "karantina"){ ?>
              <!-- .tabel karantina --> 
              <div class="row">
                <div class="col-sm-6">
                  <?php $no = 1;?>
                  <?php foreach($list_detail_gudang as $dd): ?>
                    <table class="table w-100">
                        <tr>
                            <th>No. Nota</th>
                            <td><?php echo $dd->no_nota ?></td>
                        </tr>
                        <tr>
                            <th>Pemilik</th>
                            <td><?php echo $dd->nama_perusahaan ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Datang</th>
                            <td><?php echo $dd->tgl_masuk_barang ?></td>
                        </tr>
                        <tr>
                            <th>Supplier</th>
                            <td><?php echo $dd->nama_supplier ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-6">
                  <a href="<?=base_url('barangmasuk/release/'.$dd->no_nota);?>" class="btn btn-release btn-md btn-success pull-right">Release</a>
                </div>
                <?php endforeach;?>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama barang</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                  <th>COA</th>
                  <th>Halal</th>
                  <th>Expired Date</th>
                  <th>No. Batch</th>
                  <th>No. Seri</th>
                  <th>Status</th>
                </tr>
                </thead>
                <?php if(is_array($list_gudang)){ ?>
                <?php $no = 1;?>
                <?php foreach($list_gudang as $dd): ?>
                <tbody>
                <tr>
                    <td>(<?=$dd->kode_barang?>) <?=$dd->nama_bahan?></td>
                    <td><?=$dd->jml_barang?></td>
                    <td><?=$dd->satuan_kode?></td>
                    <td><?=$dd->coa?> - <?=$dd->tgl_coa?></td>
                    <td><?=$dd->halal?> - <?=$dd->tgl_halal?></td>
                    <td><?=$dd->expired_date?></td>
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
                  </tr>
                <?php $no++; ?>
                <?php endforeach;?>
                <?php }else { ?>
                      <td colspan="7" align="center"><strong>Data Kosong</strong></td>
                <?php } ?>
                </tbody>
              </table>
              <!-- /.tabel karantina -->
              <?php }else{ ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama barang</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                  <th>COA</th>
                  <th>Halal</th>
                  <th>Expired Date</th>
                  <th>No. Batch</th>
                  <th>No. Seri</th>
                  <th>Status</th>
                </tr>
                </thead>
                <?php if(is_array($list_gudang)){ ?>
                <?php $no = 1;?>
                <?php foreach($list_gudang as $dd): ?>
                <tbody>
                <tr>
                  <td>(<?=$dd->kode_barang?>) <?=$dd->nama_bahan?></td>
                  <td><?=$dd->jml_barang?></td>
                  <td><?=$dd->satuan_kode?></td>
                  <td><?=$dd->coa?> - <?=strftime('%d %b %Y', strtotime($dd->tgl_coa))?></td>
                  <td><?=$dd->halal?> - <?=strftime('%d %b %Y', strtotime($dd->tgl_halal))?></td>
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
                </tr>
                <?php $no++; ?>
                <?php endforeach;?>
                <?php }else { ?>
                      <td colspan="7" align="center"><strong>Data Kosong</strong></td>
                <?php } ?>
                </tbody>
              </table>
              <?php } ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.VIEW TABEL DATA ---->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
  $(document).ready(function() { // Ketika halaman sudah diload dan siap

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

    $loading();
  });

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
</script>

<script>
		$(".theSelect").select2();
</script>





  