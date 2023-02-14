<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="padding-top: 20px;">
      <h1>
        Hai <b><?php echo $name; ?></b> Selamat Datang, Apa kabar hari ini? :)
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>    
    <section class="content">

	<div class="row" style="background-color:#DFE1E3;">
	<?php foreach($list_data as $ld){ ?>
		<div class="col-md-3 col-sm-6 col-xs-12" style="margin-top:20px;">
			<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa  fa-tags"></i></span>

			<div class="info-box-content">
				<span class="info-box-text"><?= $ld->nama_bahan ?></span>
				<span class="info-box-number"><?= $ld->jml_barang." ".$ld->satuan_kode ?></span>

					<span class="progress-description">
					<a href="<?=base_url('barangmasuk/detail_tabel/'.$ld->kode_barang)?>" style="color:white">klik untuk lebih detail <i class="fa  fa-angle-double-right"></i></a>
					</span>
			</div>
			<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
	<?php } ?>
	</div>

    </section>
</div>