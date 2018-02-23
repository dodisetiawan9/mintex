<section class="content-header">
	<h1>
		<?= $title; ?>
		<small> / <?= $subtitle; ?> </small> <small> > <?= $ontitle; ?> </small>
	</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="box">
				<div class="box-header">
					
				</div>
				<div class="box-body">
					
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah</button>
					
					<?php if($this->session->userdata('dataBenang')) : ?>
					<a href="<?= base_url(); ?>benang_out/delete" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"> Hapus Semua</i></a>

					<br>
					<br>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover col-md-12 col-sm-12 col-xs-12 out">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Jenis Benang</th>
									<th class="text-center">Banyaknya</th>
									<th class="text-center">Netto</th>
									<th class="text-center">Harga</th>
									<th class="text-center">Total</th>
									<!-- <th class="text-center">Total</th> -->
								</tr>
							</thead>
							<tbody>

						<?php
							if($this->session->userdata('dataBenang')) :
								$no=1;
								$subtotal = 0;	 
								foreach ($this->session->userdata('dataBenang') as $value): ?>
									<?php foreach ($value as $row){ 
										if($row['b_box'] == 0 && $row['kg'] == 0){
											$total = $row['harga'] * $row['ball'];
										}elseif($row['b_karung'] == 0 && $row['ball'] == 0){
											$total = $row['harga'] * $row['kg'];
										}
										$subtotal = $subtotal + $total;
									?>
										<tr>
											<td class="text-center"><?= $no++; ?></td>
											<td class="text-center"><?= $row['nama_benang']; ?></td>
											<td class="text-center">
												<?php  
													if($row['b_karung'] <= 0){echo $row['b_box'].' '.'Box';}
													elseif($row['b_box'] <= 0){echo $row['b_karung'].' '.'karung';}
												?>
											</td>
											<td class="text-center">
												<?php 
														if($row['ball'] <= 0){
															echo $row['kg'].' '.'Kg';
														}elseif($row['kg'] <= 0){
															echo $row['ball'].' '.'Ball';
														} 
												?>
											</td>
											<td class="text-center"><?= 'Rp. '.number_format($row['harga'],0,',','.'); ?></td>
											<td><?= 'Rp. '.number_format($total,0,',','.'); ?></td>
								
										</tr>
									<?php } ?>
							<?php endforeach ?>
						

							</tbody>
							<td colspan="5" align="right"><b style="color:red">Subtotal</b></td>
							<td><b><?= 'Rp. '.number_format($subtotal,0,',','.'); ?></b></td>
						<?php endif ?>
						</table>
						<br>
						<hr>
						<br>
						<br>
						<br>
						<br>
						<div class="well">
							<form action="" method="post" class="form-horizontal form-label-left">
									 <div class="item form-group">
			            		<label for="tgl" class="control-label col-md-3 col-sm-3 col-xs-6">Tanggal</label>
				            <div class="col-md-3 col-sm-2 col-xs-12">
				              <input type="date" name="tgl" id="tgl" class="form-control col-md-2 col-xs-12" required="" value="<?= $tgl; ?>">
				            </div>
		          		</div>
									<div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenis">Destination
                    </label>
                    <div class="col-md-5 col-sm-3 col-xs-8">
                      <select name="destination" id="" class="form-control" required>
                        <option value="" selected disabled>-- Pilih Destination --</option>
                        
                        <?php
                            foreach ($dest->result() as $key) {
                              if(!$this->uri->segment(3)){
                                echo '<option value="'.$key->id_dest.'">'.$key->nama_dest.'</option>';
                              }
                              else{ ?>
                                <option value="<?= $key->id_dest; ?>" <?php if($key->id_dest == $id_dest){echo 'selected';} ?>><?= $key->nama_dest; ?></option>
                              <?php } ?>       
                          <?php } ?>  
                               
                              
                          
                      </select>
                    </div>
                        

                    <!-- <label class="control-label col-md-1 col-sm-1 col-xs-12" for="meter">Cm 
                    </label> -->

                  </div>

				           <div class="item form-group">
				            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keterangan">Keterangan <br>   (Optional) </label>
				            <div class="col-md-6 col-sm-6 col-xs-12">
				              <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="optional form-control col-md-7 col-xs-12"></textarea> 
				            </div>
				          </div>
							 		<br>
							 		<button type="submit" name="additem" value="Add" class="btn btn-success pull-right"><i class="fa fa-forward"></i> Lanjut Input Data</button>
							 		<br>
									<br>
							</form>
						</div>
					</div>

				<?php else :
					echo '<br/>
								<br />
								<div>
									<div class="alert alert-default"><p class="text-center">Klik tombol tambah untuk menambahkan data!</p></div>
								</div>';
				 ?>
			<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- modal -->
	<div class="modal fade" id="tambah" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times</button>
					<h4 class="modal-title">Tambah Data</h4>
				</div>
				<div class="modal-body">
					<!-- form input -->
						<form class="form-horizontal form-label-left" method="Post" action="<?= base_url(); ?>benang_out/collect">

		          <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-8" for="jenis">Jenis Benang
		            </label>
		            <div class="col-md-8 col-sm-6 col-xs-12">
		              <select name="jenis" id="" class="form-control" required>
		                <option value="" selected disabled>-- Pilih Jenis Benang --</option>

										<?php
											foreach ($jenis->result() as $key) {
												if(!$this->uri->segment(3)){
												echo '<option value="'.$key->id_benang.'">'.$key->nama_benang.'</option>';
												}
												else{ ?>
												<option value="<?= $key->id_benang; ?>" <?php if($key->id_benang == $jenis){echo 'selected';} ?>><?= $key->nama_benang; ?></option>
											<?php } ?>       
										<?php } ?>      
		                         
		                      
		                  
		              </select>

		            </div>
		           <!--  <div class="col-md-1 col-sm-2 col-xs-4">
		              <button type="button" class="col-md-12 btn btn-info btn-sm" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Add</button>
		            </div> -->

		          </div>
		           <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kg">Banyaknya 
		            </label>
		            <div class="col-md-5 col-sm-6 col-xs-12">
		              <input type="text" id="bk" name="bk" required="required" class="form-control col-md-7 col-xs-12" placeholder="Exs : 30" value="<?= $bk; ?>">
		             <!-- <small><i style="color:red">*</i> Jangan Gunakan titik(.), Kecuali untuk kelebihan jumlah</small>  -->           
		           </div>
		           	<div class="col-md-3 col-sm-2 col-xs-4">
		              <select name="satuan" id="satuan" class="form-control">
		              	<option value="" selected disabled>-- Pilih Satuan --</option>
		              	<option value="box">Box / Dus</option>
		              	<option value="karung">Karung</option>
		              </select>
		            </div>
		          </div>
		       
		           <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kg">Netto
		            </label>
		            <div class="col-md-5 col-sm-6 col-xs-12">
		              <input type="number" id="netto" name="netto" required="required" class="form-control col-md-7 col-xs-12" placeholder="Exs : 5  / Kg" value="">
		            <!--  <small><i style="color:red">*</i> Jangan Gunakan titik(.), Kecuali untuk kelebihan jumlah</small>   -->          
		           </div>

		           <div class="col-md-3 col-sm-2 col-xs-4">
		              <select name="satuan_net" id="satuan_net" class="form-control">
		              	<option value="" selected disabled>-- Pilih Satuan --</option>
		              	<option value="ball">Ball</option>
		              	<option value="kg">Kg</option>
		              </select>
		            </div>
		          </div>

		            <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga 
		            </label>
		            <div class="col-md-8 col-sm-6 col-xs-12">
		              <input type="number" id="harga" name="harga" required="required" class="form-control col-md-7 col-xs-12" value="" placeholder="Exs : 140000">
		            </div>
		          </div>
		         
							<hr>
		          <div class="ln_solid"></div>
			         <div class="form-group">
		          	<div class="modal-footer">
			            <div class="col-md-6 pull-right">
			              <button type="reset" class="btn btn-danger">Reset</button>
			              <button type="submit" name="submit" class="btn btn-success" value="Submit">Submit</button>
			            </div>
			          </div>
		          </div>
					</form>
					<!-- end form input -->
				</div>
			</div>
		</div>
	</div>
<!-- end modal -->

