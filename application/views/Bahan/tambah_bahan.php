<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Input Bahan
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">Data Bahan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="container">
        <div class="col-md-12">
            <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-archive" aria-hidden="true"></i> Tambah Data bahan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="container">

              <?php if($this->session->flashdata('msg_gagal')){ ?>
                <div class="alert alert-danger alert-dismissible" style="width:91%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Failed!</strong><br> <?php echo $this->session->flashdata('msg_gagal');?>
                </div>
              <?php } ?>

              <?php if(validation_errors()){ ?>
                <div class="alert alert-warning alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
                </div>
              <?php } ?>
              <div class="row">
                <div class="col-md-12">
                  <form class="form-horizontal" action="<?=base_url('bahan/simpan')?>" role="form" method="post">
                    <div class="box-body">

                      <div class="form-group">
                          <label for="kode_bahan" class="col-sm-4 control-label" >Kode Bahan :</label>
                            <div class="col-sm-3">
                            <input type="text" name="kode_bahan" id="kode_bahan" class="form-control">
                            </div>
                      </div>

                      <div class="form-group">
                          <label for="tgl_transaksi" class="col-sm-4 control-label" >Nama Bahan :</label>
                            <div class="col-sm-3">
                            <input type="text" name="nama_bahan" id="nama_bahan" class="form-control">
                            </div>
                      </div>

                      <div class="form-group">
                        <label for="tgl_transaksi" class="col-sm-4 control-label" >Nama Supplier :</label>
                        <div class="col-sm-3">
                        <select class="form-control" name="supplier_id">
                          <option value="">- Pilih Supplier -</option>
                          <?php foreach($list_supplier as $lb){ ?>
                            <option value="<?=$lb->id_supplier?>"><?=$lb->nama_supplier?></option>
                          <?php } ?>
                        </select>
                        </div>
                      </div>

                      <div class="form-group">
                          <label for="tgl_transaksi" class="col-sm-4 control-label" >Harga Bahan :</label>
                            <div class="col-sm-3">
                            <input type="text" name="harga_bahan" id="harga_bahan" class="form-control">
                            </div>
                      </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a type="button" class="btn btn-default" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                        <input type="submit" value="Simpan" class="btn pull-right btn btn-success"></input>
                    </div>
                    <!-- /.box-footer -->
                    <!-- /.box-body -->
                  </form>
                </div>
              </div>
            </div>
          <!-- /.box -->
          </div>
        </div>
      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->