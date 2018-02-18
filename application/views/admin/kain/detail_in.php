<div class="headun">
	<section class="content-header">
		<h1>
			<?= $title; ?>
			<small> / <?= $subtitle; ?> </small> <small> > <?= $ontitle; ?> </small>
		</h1>
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
								$dest = $data->nama_dist;
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
											 	if($data->status_kain != 1 ){
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
						<h3 class="text-center">Detail Barang Masuk</h3>
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
											<!-- <th class="text-center">Status</th> -->
										</tr>
									</thead>
									<tbody>
										<?php  
											$no=1;
											$subtotal = 0;
											foreach ($detail->result() as $key) : 
												$total 		= $key->meter * $key->harga;
												$subtotal = $subtotal + $total;

												$gll = explode(",", number_format($key->gl,2,',','.'));
												$mtr = explode(",", number_format($key->meter,2,',','.'));
												$klg = explode(",", number_format($key->kg,2,',','.')); 
											?>
												<tr>
													<td class="text-center"><?= $no++; ?></td>
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
													<td><?= 'Rp. '.number_format($total,0,',','.'); ?></td>
													
												</tr>
										
										<?php endforeach ?>
									</tbody>
									
								</table>
							</div>

							<button type="button" class="btn btn-info" onclick="window.history.go(-1)"><< Kembali</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>