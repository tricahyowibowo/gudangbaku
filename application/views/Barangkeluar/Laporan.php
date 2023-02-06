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
        <div class="box box-primary">
          <div class="box-header">
            <h3>Filter Laporan</h3>
          </div>
          <div class="box-body">
            <form role="form" method="post">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Akun</label>
                      <select class="form-control" name="bagian"  id="bagian">
                          <option value="">- Pilih Bagian -</option>
                          <?php foreach($list_bagian as $list){ ?>
                          <option <?= $bagian === $list->id_bagian ? "selected ": ""?> value="<?=$list->id_bagian?>"> Bagian <?=$list->nama_bagian?></option>
                          <?php } ?>
                        </select>  
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <div class="col-md-6">
                        <label for="exampleInputPassword1">Tanggal Awal</label>
                        <?php if(is_null($tgl_awal)) {?>
                          <input type="date" class="form-control" name="tgl_awal" required>
                        <?php }else { ?>
                          <input type="date" class="form-control" name="tgl_awal" value="<?php echo $tgl_awal ?>" required>
                        <?php } ?>

                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputPassword1">Tanggal Akhir</label>
                        <?php if(is_null($tgl_akhir)) {?>
                        <input type="date" class="form-control" name="tgl_akhir" required>
                        <?php }else { ?>
                          <input type="date" class="form-control" name="tgl_akhir" value="<?php echo $tgl_akhir ?>" required>
                        <?php } ?>
                      </div>                 
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <a href="<?= base_url('data/')?>" class="btn btn-warning pull-left">Reset</a>
                <button type="submit" class="btn btn-primary pull-right">Filter</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
          <a href="<?=base_url('report/barangKeluarManual')?>" style="margin-bottom:10px;" type="button" class="btn btn-success pull-right" name="laporan_data"><i class="fa fa-download" aria-hidden="true"></i> Cetak Excel</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">

            <?php if($this->session->flashdata('msg_berhasil')){ ?>
              <div class="alert alert-success alert-dismissible" style="width:100%">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
              </div>
            <?php } ?>

            <table id="datakeluar" class="table table-bordered table-striped">
              <thead>
              <tr>
              <th>No</th>
              <th>Kode Produk</th>
              <th>Nama Produk</th>
              <?php if(is_array($tanggal)){ ?>
                <?php $no = 1;?>
                <?php foreach($tanggal as $dd): ?>
                <th><?=strftime('%d %b %Y', strtotime($dd->tgl_keluar))?></th>
              <?php endforeach;?>
              <?php }?>
              </tr>
              <tr>
              <th></th>
              <th></th>
              <th></th>
              <?php if(is_array($tanggal)){ ?>
                <?php $no = 1;?>
                <?php foreach($tanggal as $dd): ?>
                <th><?=$dd->nota_keluar?></th>
                <!-- <th></th> -->
              <?php endforeach;?>
              <?php }?>
              </tr>
              </thead>
              <tbody>
              <tr>
                <?php if(is_array($list_data)){ ?>
                <?php $no = 1;?>
                <?php foreach($list_bahan as $dd): ?>
                  <td><?=$no?></td>
                  <td><?=$dd->kode_bahan?></td>
                  <td><?=$dd->nama_bahan?></td>
                  <?php foreach($list_data as $p): ?>
                  <?php if($dd->kode_bahan === $p->kode_barang){ ?>
                  <td><?=$p->pengeluaran?></td>
                  <?php }else{ ?>
                  <td><?php echo "-"?></td>
                  <?php } ?>
                  <?php endforeach;?>
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
