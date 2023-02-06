<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Input Transaksi
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">Data divisi</li>
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
              <h3 class="box-title"><i class="fa fa-archive" aria-hidden="true"></i> Tambah Data divisi</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="container">

              <?php if($this->session->flashdata('msg_berhasil')){ ?>
                <div class="alert alert-success alert-dismissible" style="width:91%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
                </div>
              <?php } ?>

              <?php if(validation_errors()){ ?>
                <div class="alert alert-warning alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
                </div>
              <?php } ?>
              <div class="row">
                <div class="col-md-8">
                  <form class="form-horizontal" action="<?=base_url('supplier/update/'.$id_supplier)?>" role="form" method="post">
                    <div class="box-body">

                    <?php foreach($list_data as $l){ ?>
                      <a href="<?=base_url('supplier')?>" type="button" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>

                      <div class="form-group">
                        <label for="tgl_transaksi" class="col-sm-4 control-label" >Nama supplier :</label>
                        <div class="col-sm-6">
                          <input type="text" name="nama_supplier" id="nama_supplier" class="form-control" value="<?=$l->nama_supplier?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="tgl_transaksi" class="col-sm-4 control-label" >Alamat supplier :</label>
                        <div class="col-sm-6">
                          <input type="text" name="alamat_supplier" id="alamat_supplier" class="form-control" value="<?=$l->alamat_supplier?>">
                        </div>
                      </div>
                    <?php } ?>

                
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <div class="col-sm-6">
                        <input type="submit" value="Update" class="btn btn btn-success"></input>
                      </div>
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