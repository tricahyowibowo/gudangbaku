
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Permintaan Barang
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">Permintaan Barang</li>
    </ol>
  </section>
  <!-- /Content Header (Page header) -->

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="container">
        <!-- form start -->
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div id="loading"></div>
              <form class="form-horizontal" action="<?=base_url('barangkeluar/proses_data_keluar')?>" role="form" id="addBarang" method="post">
                <div class="modal-body">
                  <div class="form-group">      
                    <label for="nota_keluar" class="col-sm-4 control-label">No Nota :</label>
                      <div class="col-sm-3">
                      <input type="text" name="nota_keluar" id="nota_keluar" class="form-control" placeholder="Masukkan nomer nota">
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
                    <label for="tgl_keluar" class="col-sm-4 control-label" >Tanggal Keluar:</label>
                    <div class="col-sm-3">
                      <input type="date" name="tgl_keluar" id="tgl_keluar" class="form-control" placeholder="Klik Disini">
                    </div>
                  </div>  
                  <div class="form-group">  
                    <label for="bagian" class="col-sm-4 control-label">Bagian :</label>
                    <div class="col-sm-3">
                      <td><select class="form-control" name="bagian"  id="bagian">
                        <option value="">- Pilih Bagian -</option>
                        <?php foreach($list_bagian as $list){ ?>
                        <option value="<?=$list->id_bagian?>"> <?=$list->nama_bagian?></option>
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
                          <th>Permintaan</th>
                          <th>Jumlah</th>
                          <th>Satuan</th>
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
          </div>
        </div>
        <!-- form end -->
      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
<!-- /.content-wrapper -->
<script>
  $(".theSelect").select2();
</script>

<script type="text/javascript">
  $(".form_datetime").datetimepicker({
    format: 'dd/mm/yyyy',
    autoclose: true,
    todayBtn: true,
    pickTime: false,
    minView: 2,
    maxView: 4,
  });
</script>

<script>
  $(document).ready(function() { // Ketika halaman sudah diload dan siap

    $("#btn-tambah-form").click(function() { // Ketika tombol Tambah Data Form di klik
      var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
      var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya
      // Kita akan menambahkan form dengan menggunakan append
      // pada sebuah tag div yg kita beri id insert-form
      var nota_keluar = $("#nota_keluar").val();
      var status_barang = $("#status_barang").val();
      var tgl_keluar = $("#tgl_keluar").val();
      var bagian = $("#bagian").val();

        $("#table1").append(
        '<tr>' +
        '<input type="hidden" class="form-control" name="nota_keluar[]" value=' + nota_keluar + '>' +
        '<input type="hidden" class="form-control" name="status_barang[]" value=' + status_barang + '>' +
        '<input type="hidden" class="form-control" name="tgl_keluar[]" value=' + tgl_keluar + '>' +
        '<input type="hidden" class="form-control" name="bagian[]" value=' + bagian + '>' +
        '<td><select class="form-control" name="kode_barang[]">' +
        '<option value="">- Pilih barang -</option>'+
        '<?php foreach($list_bahan as $lb){ ?>'+ 
        '<option value="<?=$lb->id_barang_masuk?>"><?=$lb->nama_bahan?> | <?=$lb->expired_date?> | <?=$lb->batch?> | <?=$lb->no_nota?> (<?=$lb->jml_barang?>)</option>'+
        '<?php } ?>'+
        '</select></td>'+
        '<td><input type="text" class="form-control" placeholder="permintaan" name="permintaan[]"></td>' + 
        '<td><input type="text" class="form-control" placeholder="keluar" name="keluar[]"></td>' + 
        '<td><select class="form-control" name="satuan_kode[]">' +
        '<option value="">- Pilih Satuan -</option>'+
        '<?php foreach($list_satuan as $ls){ ?>'+ 
        '<option value="<?=$ls->kode_satuan?>"> <?=$ls->kode_satuan?></option>'+
        '<?php } ?>'+
        '</select></td>'+
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

  $(".theSelect").select2();
</script>
  
<script>
  jQuery(document).ready(function($){
  $('.btn-add').on('click',function(){
      var getLink = $(this).attr('href');
      swal({
            title: 'Konfirmasi Data',
            text: 'Periksa kembali data yang anda masukkan <br> <b>Apakah Data Sudah Benar ?</b>',
            html: true,
            confirmButtonColor: '#00A65A',
            confirmButtonText: 'Sudah Benar',
            showCancelButton: true,
            cancelButtonText: 'Periksa',
            },function(){
            window.location.href = getLink
          });
      return false;
      });
  });
</script>