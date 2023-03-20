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
                          <option value="0">- Pilih Bagian -</option>
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
          <div class="box-header" style="padding-top:20px">
          <a href="<?=base_url('barangkeluar/cetaklaporanexcel/').$bagian.'/'.$tgl_awal.'/'.$tgl_akhir?>" style="margin-bottom:10px;" type="button" class="btn btn-success pull-right" name="laporan_data"><i class="fa fa-download" aria-hidden="true"></i> Cetak Excel</a>
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
              <th>Kode Bahan</th>
              <th>Nama Bahan</th>
              <th>Total Keluar</th>
              <th>Satuan</th>
              <th>Detail</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <?php if(is_array($list_data)){ ?>
                <?php $no = 1;?>
                <?php foreach($list_data as $dd): ?>
                  <td><?=$no?></td>
                  <td><?=$dd->kode_barang?></td>
                  <td><?=$dd->nama_bahan?></td>
                  <td><?=$dd->pengeluaran?></td> 
                  <td><?=$dd->satuan_kode?></td> 
                  
                  <td><!-- <td><a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detail<?=$dd->kode_barang?>">detail</a ></td>  -->
                  <a href="<?=base_url('barangkeluar/detail_laporan/').$dd->kode_barang.'/'.$tgl_awal.'/'.$tgl_akhir.'/'.$bagian?>" style="margin-bottom:10px;" type="button" class="btn btn-primary btn-sm" name="laporan_data"><i class="fa fa-eye" aria-hidden="true"></i></a>
                  </td>
              </tr>
            <?php $no++; ?>

            <!-- Modal -->
            <div class="modal fade" id="detail<?=$dd->kode_barang?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                  </div>
                  <div class="modal-body">
                  <?php echo $dd->kode_barang?>

                  <?php 
                  $id=$dd->kode_barang;
                  $data = $this->bahanbaku_model->GetLaporanKeluarByBarang($id, $bagian, $tgl_awal,$tgl_akhir);

                  var_dump($data);
                  ?>
                  <div class="form-group">
                    <label for="keterangan" style="margin-left:220px;display:inline;">Alasan</label>
                    <input type="text" name="keterangan" style="margin-left:37px;width:20%;display:inline;" class="form-control">
                  </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
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
