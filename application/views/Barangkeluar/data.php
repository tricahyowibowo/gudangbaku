  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        Tabel Barang Keluar
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Tables</li>
        <li class="active"><a href="<?=base_url('barangkeluar')?>">Tabel Barang Keluar</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <!-- /.box -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">

              <?php if($this->session->flashdata('msg_berhasil')){ ?>
                <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
               </div>
              <?php } ?>

              <!-- <a href="<?=base_url('Databarangmasuk')?>" style="margin-bottom:10px;" type="button" class="btn btn-primary" name="tambah_data"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Data Keluar</a>
              <a href="<?=base_url('report/barangKeluarManual')?>" style="margin-bottom:10px;" type="button" class="btn btn-danger" name="laporan_data"><i class="fa fa-file-text" aria-hidden="true"></i> Invoice Manual</a> -->
              <table id="datakeluar" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nota Keluar</th>
                  <th>Pemilik</th>
                  <th>Tanggal Keluar</th>
                  <th>Bagian</th>
                  <th>Detail</th>
                  <th>BPPB</th>
                  <!-- <th></th> -->
                </tr>
                </thead>
                <tbody>
                <tr>
                  <?php if(is_array($list_data)){ ?>
                  <?php $no = 1;?>
                  <?php foreach($list_data as $dd): ?>
                    <td><?=$no?></td>
                    <td><?=$dd->nota_keluar?></td>
                    <td><?=$dd->nama_perusahaan?></td>
                    <td><?=strftime('%d %b %Y', strtotime($dd->tgl_keluar))?></td>
                    <td><?=$dd->nama_bagian?></td>
                    <td><a type="button" class="btn btn-primary btn-detail"  href="<?=base_url('barangkeluar/detail_tabel/'.$dd->nota_keluar)?>" name="btn_detail" style="margin:auto;"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                    <td><a type="button" class="btn btn-danger btn-report"  href="<?=base_url('barangkeluar/cetakbarangKeluar/'.$dd->nota_keluar)?>" name="btn_report" target="_blank" style="margin:auto;"><i class="fa fa-file-text" aria-hidden="true"></i></a></td>
                </tr>
              <?php $no++; ?>
              <?php endforeach;?>
              <?php }else { ?>
                    <td colspan="7" align="center"><strong>Data Kosong</strong></td>
              <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>


        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
