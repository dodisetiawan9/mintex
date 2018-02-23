<div class="headun">
	<section class="content-header">
		<h1>
			<?= $title; ?>
			<small> / <?= $subtitle; ?> </small> <small> > <?= $ontitle; ?> </small>
		</h1>

		<a href="<?= base_url(); ?>benang_out/print/<?= $this->uri->segment(3); ?>" class="btn btn-default" target="_blank"><i class="fa fa-print"></i> Print Surat Jalan</a>
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
								$tanggal = date_create($data->tgl);
								$tgl = date_format($tanggal, 'd M Y');
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

									<th class="col-md-1 col-sm-6 col-xs-2" style="float:">Status</th>
									<td class="col-md-2 col-sm-6 col-xs-2">: 
										<?php
											 	if($data->status_bout != 1 ){
											 		echo '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i> Lunas</span>';
											 	} 
											 	else{
	                      	echo '<span class="label label-warning"><i class="glyphicon glyphicon-exclamation-sign"></i> Pending</span>';
	                    	} 
											?>
									</td>
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
											<th class="text-center">Jenis Benang</th>
											<th class="text-center">Banyaknya</th>
											<th class="text-center">Netto</th>
											<th class="text-center">Harga</th>
											<th class="text-center">Total</th>
										</tr>
									</thead>
									<tbody>
										<?php  
											$no=1;
											$subtotal = 0;
											foreach ($detail->result() as $key) : 
													if($key->box == 0 && $key->kg == 0){
														$total = $key->harga * $key->ball;
													}elseif($key->karung == 0 && $key->ball == 0){
														$total = $key->harga * $key->kg;
													}
													$subtotal = $subtotal + $total;
											?>
												<tr>
													<td class="text-center"><?= $no++; ?></td>
													<td class="text-center"><?= $key->nama_benang; ?></td>
													<td class="text-center">
														<?php  
															if($key->karung <= 0){echo $key->box.' '.'Box';}
															elseif($key->box <= 0){echo $key->karung.' '.'karung';}
														?>
													</td>
													<td class="text-center">
														<?php 
																if($key->ball <= 0){
																	echo $key->kg.' '.'Kg';
																}elseif($key->kg <= 0){
																	echo $key->ball.' '.'Ball';
																} 
														?>
													</td>
													<td class="text-center">
														<?= 'Rp. '.number_format($key->harga,0,',','.'); ?>
													</td>
													<td><?= 'Rp. '.number_format($total,0,',','.'); ?></td>
												
												</tr>
										
										<?php endforeach ?>
									</tbody>
									<td colspan="5" align="right"><b style="color:red">Subtotal</b></td>
									<td><b><?= 'Rp. '.number_format($subtotal,0,',','.'); ?></b></td>
									<tr>
							  		<td colspan="7" class="bor" style="padding: 10px"><b>Keterangan : </b>
							  			<br />
							  			<br />
							  			<?= $key->keterangan; ?>
							  		</td>
							  	</tr>
								</table>
							</div>
							<button type="button" class="btn btn-info" onclick="window.history.go(-1)"><< Kembali</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>