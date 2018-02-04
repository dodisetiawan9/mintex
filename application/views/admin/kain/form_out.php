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
					
					<?php if($this->session->userdata('dataKain')) : ?>
					<a href="<?= base_url(); ?>kain_out/delete" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"> Hapus Semua</i></a>

					<br>
					<br>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover col-md-12 col-sm-12 col-xs-12 out">
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
							if($this->session->userdata('dataKain')) :
								$no=1;
								$subtotal = 0;	 
								foreach ($this->session->userdata('dataKain') as $value): ?>
									<?php foreach ($value as $row){ 
										$total = $row['meter'] * $row['harga'];
										$subtotal = $subtotal + $total;
									?>
										<tr>
											<td class="text-center"><?= $no++; ?></td>
											<td><?= $row['nama_kain']; ?></td>
											<td class="text-center"><?= $row['gl']; ?></td>
											<td><?= number_format($row['meter'],2,',','.'); ?></td>
											<td><?= number_format($row['kg'],2,',','.'); ?></td>
											<td><?= 'Rp. '.number_format($row['harga'],0,',','.'); ?></td>
											<td><?= 'Rp. '.number_format($row['harga'] * $row['meter'],0,',','.') ?></td>
										</tr>
									<?php } ?>
							<?php endforeach ?>
						

							</tbody>
							<td colspan="6" align="right"><b style="color:red">Subtotal</b></td>
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
						<form class="form-horizontal form-label-left" method="Post" action="<?= base_url(); ?>kain_out/collect">

		          <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-8" for="jenis">Jenis Kain
		            </label>
		            <div class="col-md-8 col-sm-6 col-xs-12">
		              <select name="jenis" id="" class="form-control" required>
		                <option value="<?= $id_kain; ?>" selected disabled>-- Pilih Jenis Kain --</option>

										<?php
											foreach ($jenis->result() as $key) {
												if(!$this->uri->segment(3)){
												echo '<option value="'.$key->id_kain.'">'.$key->nama_kain.'</option>';
												}
												else{ ?>
												<option value="<?= $key->id_kain; ?>" <?php if($key->id_kain == $id_kain){echo 'selected';} ?>><?= $key->nama_kain; ?></option>
											<?php } ?>       
										<?php } ?>        
		                         
		                      
		                  
		              </select>

		            </div>
		           <!--  <div class="col-md-1 col-sm-2 col-xs-4">
		              <button type="button" class="col-md-12 btn btn-info btn-sm" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Add</button>
		            </div> -->

		          </div>
		          <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gl">GL 
		            </label>
		            <div class="col-md-8 col-sm-6 col-xs-12">
		              <input type="number" id="gl" name="gl" required="" class="form-control col-md-7 col-xs-12" value="<?= $gl; ?>">
		            </div>
		          </div>
		          <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="meter">Meter 
		            </label>
		            <div class="col-md-8 col-sm-6 col-xs-12">
		              <input type="text" id="meter" name="meter" required="required" class="form-control col-md-7 col-xs-12" placeholder="Exs : 12700.25" value="<?= $meter; ?>">
		              <small><i style="color:red">*</i> Jangan Gunakan titik(.), Kecuali untuk kelebihan jumlah</small>            </div>
		            <!-- <label class="control-label col-md-1 col-sm-1 col-xs-12" for="meter">Cm 
		            </label>
		            <div class="col-md-2 col-sm-3 col-xs-12">
		              <input type="number" id="cm" name="cm" required="required" class="form-control col-md-7 col-xs-12">
		            </div> -->
		          </div>
		          <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kg">Kg 
		            </label>
		            <div class="col-md-8 col-sm-6 col-xs-12">
		              <input type="text" id="kg" name="kg" required="required" class="form-control col-md-7 col-xs-12" placeholder="Exs : 12700.31" value="<?= $kg; ?>">
		             <small><i style="color:red">*</i> Jangan Gunakan titik(.), Kecuali untuk kelebihan jumlah</small>            </div>
		            <!-- <label class="control-label col-md-1 col-sm-1 col-xs-12" for="meter">Gr 
		            </label>
		            <div class="col-md-2 col-sm-3 col-xs-12">
		              <input type="number" id="cm" name="cm" required="required" class="form-control col-md-7 col-xs-12">
		            </div> -->
		          </div>
		          <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga 
		            </label>
		            <div class="col-md-8 col-sm-6 col-xs-12">
		              <input type="number" id="harga" name="harga" required="required" class="form-control col-md-7 col-xs-12" value="<?= $harga; ?>" placeholder="Exs : 140000">
		            </div>
		          </div>
		          <!-- <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Total 
		            </label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <input id="occupation" type="text" name="occupation" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
		            </div>
		          </div> -->

		          <!-- <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keterangan">Keterangan <br>   (Optional) </label>
		            <div class="col-md-8 col-sm-6 col-xs-12">
		              <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="optional form-control col-md-7 col-xs-12"></textarea> 
		            </div>
		          </div> -->
		         
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