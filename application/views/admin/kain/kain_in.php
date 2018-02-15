<div class="headun">
		<section class="content-header">
	  <h1>
	    <?= $title; ?>
	    <small> / <?= $subtitle; ?></small>
	  </h1>
				<a href="<?= base_url(); ?>kain/add_item" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
		</section>
</div>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
  
  	<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="box">
				<div class="box-header">
		<!-- 			<h3 class="box-title">
						Data Kain Masuk
					</h3> -->
				</div>
				<div class="box-body">
					<?php  
			      if($this->session->flashdata('alert'))
			      {
			        echo '<div class="alert alert-info alert-message">';
			        echo $this->session->flashdata('alert');
			        echo '</div>';

			      }
			      if($this->session->flashdata('success'))
			      {
			        echo '<div class="alert alert-success alert-message">';
			        echo $this->session->flashdata('success');
			        echo '</div>';

			      }
			      if($this->session->flashdata('fail'))
			      {
			        echo '<div class="alert alert-danger alert-message">';
			        echo $this->session->flashdata('fail');
			        echo '</div>';

			      }
		   		?>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="datatable">
							<thead>
								<tr>
									<th>#</th>
									<th>Tanggal</th>
									<th>Distributor</th>
									<th>Jenis Kain</th>
									<th>GL</th>
									<th>Meter</th>
									<th>Kg</th>
									<th>Harga</th>
									<th class="text-center">Opsi</th>
								</tr>
							</thead>

							<tbody>
								<?php  
									$no=1;

									foreach ($kain->result() as $key) : ?>

									<?php  
										$gll = explode(",", number_format($key->gl,2,',','.'));
										$mtr = explode(",", number_format($key->meter,2,',','.'));
										$klg = explode(",", number_format($key->kg,2,',','.'));

										$tanggal = date_create($key->tgl);
										$tgl = date_format($tanggal, 'd M Y');
									?>
								<tr>
									<td><?= $no++; ?></td>
									<td><?= $tgl; ?></td>
									<td><?= $key->nama_dist; ?></td>
									<td><?= $key->nama_kain; ?></td>
									<td>
										<?php
											if($gll[1] == 00){
												echo number_format($key->gl,0,',','.');
											}
											else{
												echo number_format($key->gl,2,',','.');
											} 
										?>
											
									</td>
									<td>
										<?php
											if($mtr[1] == 00){
												echo number_format($key->meter,0,',','.');
											}
											else{
												echo number_format($key->meter,2,',','.');
											} 
										?>
										
									</td>
									<td>
										<?php
											if($klg[1] == 00){
												echo number_format($key->kg,0,',','.');
											}
											else{
												echo number_format($key->kg,2,',','.');
											} 
										?>
									</td>
									<td><?= 'Rp. '.number_format($key->harga,0,',','.'); ?></td>
									<td class="text-center">
										<a href="<?= base_url(); ?>kain/update_kain/<?= $key->id_kain_in; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
										<a href="<?= base_url(); ?>kain/delete/<?= $key->id_kain_in; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Ingin Menghapus?')"><i class="fa fa-trash"></i></a>
									</td>
								</tr>

							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
  	</div>  
	
  <!-- Main row -->
  <div class="row"></div>
  <!-- /.row (main row) -->

</section>