<section class="content-header">
	<h1>
	    <?= $title; ?>
	    <small> / <?= $subtitle; ?></small><small> >> <?= $ontitle; ?></small>
	  </h1>
</section>

<section class="content">
	<div class="row">
			<div class="box">
				<div class="box-header"></div>
				<div class="box-body">
					<div class="well col-md-5 col-sm-12 col-xs-12">
							<form class="form-horizontal form-label-left" method="Post" action="">
								<?php  
									$no=1;
									$data = $edit->row();
								?>
									 <div class="form-group">
				            <div class="col-md-12 col-sm-12 col-xs-12">
			            		<label>Tanggal</label>
				              <input type="date" name="tgl" id="tgl" class="form-control col-md-2 col-xs-12" value="<?= $data->tgl; ?>" required>
				            </div>
		          		</div>
									<div class="form-group">
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <label>Destination</label>
                      <select name="destination" id="" class="form-control" required>
                        <option value="" selected disabled>-- Pilih Destination --</option>
                          <?php
                            foreach ($dest->result() as $key) {
                              if(!$this->uri->segment(3)){
                                echo '<option value="'.$key->id_dest.'">'.$key->nama_dest.'</option>';
                              }
                              else{ ?>
                                <option value="<?= $key->id_dest; ?>" <?php if($key->id_dest == $data->id_dest){echo 'selected';} ?>><?= $key->nama_dest; ?></option>
                              <?php } ?>       
                          <?php } ?>  
                      </select>
                    </div>
                        

                    <!-- <label class="control-label col-md-1 col-sm-1 col-xs-12" for="meter">Cm 
                    </label> -->

                  </div>
									<div class="form-group">
				            <div class="col-md-12 col-sm-12 col-xs-12">
				            	<label>Status Pembayaran</label>
				              <select name="status" id="" class="form-control" required>
				                <option value="" selected disabled>-- Pilih Destination --</option>
                     		<option value="1" <?php if($data->status_bout == 1){echo 'selected';} ?>>Pending</option>
                     		<option value="2" <?php if($data->status_bout == 2){echo 'selected';} ?>>Lunas</option>    
				                  
				              </select>

				            </div>
				          </div>
				           <div class="form-group">
				            <div class="col-md-12 col-sm-12 col-xs-12">
				            <label>Keterangan (Optional) </label>
				              <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="optional form-control col-md-7 col-xs-12"><?= $data->keterangan; ?></textarea> 
				            </div>
				          </div>
							 		<br>
							 		<button type="submit" name="submit" class="btn btn-success" value="Submit" style="float: right;">Submit</button>
							 		<br>
									<br>
							</form>
						</div>

							<!-- <button type="button" class="btn btn-info" onclick="window.history.go(-1)"><< Kembali</button> -->

						<!-- right -->
						<div class="col-md-6 col-sm-12 col-xs-12" style="width: 57%;margin-left: 10px">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Jenis Benang</th>
											<th>Banyaknya</th>
											<th>Netto</th>
											<th>Harga</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<?php  
											$no=1;
											$subtotal = 0;
											foreach ($edit->result() as $value) : 
												if($value->box == 0 && $value->kg == 0){
														$total = $value->harga * $value->ball;
													}elseif($value->karung == 0 && $value->ball == 0){
														$total = $value->harga * $value->kg;
													}
													$subtotal = $subtotal + $total;
											?>
												
												<tr>
													<td><?= $no++; ?></td>
													<td><?= $value->nama_benang; ?></td>
													<td>
														<?php  
															if($value->karung <= 0){echo $value->box.' '.'Box';}
															elseif($value->box <= 0){echo $value->karung.' '.'karung';}
														?>
													</td>
													<td>
														<?php 
																if($value->ball <= 0){
																	echo $value->kg.' '.'Kg';
																}elseif($value->kg <= 0){
																	echo $value->ball.' '.'Ball';
																} 
														?>
													</td>
													<td><?= 'Rp. '.number_format($value->harga,0,',','.'); ?></td>
													<td><?= 'Rp. '.number_format($total,0,',','.'); ?></td>
												</tr>
										<?php endforeach ?>
												<tr>
													<td colspan="5" align="right"><b>Subtotal</b></td>
													<td><b><?= 'Rp. '.number_format($subtotal,0,',','.'); ?></b></td>
												</tr>
									</tbody>
								</table>

								<div class="well">
									<p style="color: red"><strong>Note!, </strong>Data barang tidak dapat di rubah!</p>
								</div>
							</div>
						</div>

				</div>
			</div>
	</div>
</section>