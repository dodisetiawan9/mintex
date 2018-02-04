<div class="headun">
	<section class="content-header">
		<h1>
			<?= $title; ?>
			<small> / <?= $subtitle; ?> </small> <small> > <?= $ontitle; ?> </small>
		</h1>

		<a href="<?= base_url(); ?>kain_out/print/<?= $this->uri->segment(3); ?>" class="btn btn-default" target="_blank"><i class="fa fa-print"></i> Print Surat Jalan</a>
	</section>
</div>
<section class="content">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="box-body">
						<!-- <div class="table-responsive"> -->
							<?php  
								$data = $detail->row();
								$dest = $data->nama_dest;
								$alamat = $data->alamat;
								$telepon = $data->telepon;
								$tgl = $data->tgl;
							?>
							<table class="table tbl-detail">
								<tr>
									<th class="col-md-2">Destination</th>
									<td>: <?= $dest; ?></td>

									<th class="col-md-1 col-sm-6 col-xs-2" style="float:">Tanggal</th>
									<td class="col-md-2 col-sm-6 col-xs-2">: <?= $tgl; ?></td>
								</tr>
								<tr>
									<th class="col-md-2">Alamat</th>
									<td>: <?= $alamat; ?></td>
								</tr>
								<tr>
									<th class="col-md-2">Telepon</th>
									<td>: <?= $telepon; ?></td>
								</tr>
							</table>
						<br>
						<br>
						<h3 class="text-center">Detail Barang Keluar</h3>
						<hr>
							<div class="table-responsive col-md-12 col-sm-12 col-xs-6">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">Jenis Kain</th>
											<th class="text-center">GL</th>
											<th class="text-center">Meter</th>
											<th class="text-center">Kg</th>
											<th class="text-center">Harga</th>
											<th class="text-center">Total</th>
										</tr>
									</thead>
									<tbody>
										<?php  
											$no=1;
											$subtotal = 0;
											foreach ($detail->result() as $key) : 
												$total 		= $key->meter * $key->harga;
												$subtotal = $subtotal + $total; 
											?>
												<tr>
													<td class="text-center"><?= $no++; ?></td>
													<td><?= $key->nama_kain; ?></td>
													<td><?= $key->gl; ?></td>
													<td><?= number_format($key->meter,2,',','.'); ?></td>
													<td><?= number_format($key->kg,2,',','.'); ?></td>
													<td><?= 'Rp. '.number_format($key->harga,0,',','.'); ?></td>
													<td><?= 'Rp. '.number_format($total,0,',','.'); ?></td>
												</tr>
										
										<?php endforeach ?>
									</tbody>
									<td colspan="6" align="right"><b style="color:red">Subtotal</b></td>
									<td><b><?= 'Rp. '.number_format($subtotal,0,',','.'); ?></b></td>
								</table>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>