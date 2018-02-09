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

					<form class="form-horizontal form-label-left" method="Post" action="">
		          <div class="item form-group">
		            <label for="tanggal" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal</label>
		            <div class="col-md-3 col-sm-2 col-xs-12">
		              <input type="text" name="tgl" id="tanggal" class="form-control col-md-2 col-xs-12" required="" value="<?= $tgl; ?>">
		            </div>
		          </div>

		          <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenis">Distributor
		            </label>
		            <div class="col-md-5 col-sm-3 col-xs-8">
		              <select name="distributor" id="" class="form-control" required>
		                <option value="<?= $dist; ?>" selected disabled>-- Pilih Distributor --</option>
										<?php
											foreach ($distributor->result() as $key) {
												if(!$this->uri->segment(3)){
												echo '<option value="'.$key->id_dist_benang.'">'.$key->nama_dist.'</option>';
												}
												else{ ?>
												<option value="<?= $key->id_dist_benang; ?>" <?php if($key->id_dist_benang == $dist){echo 'selected';} ?>><?= $key->nama_dist; ?></option>
											<?php } ?>       
										<?php } ?>  
		                      
		                  
		              </select>
		            </div>
		                

		            <!-- <label class="control-label col-md-1 col-sm-1 col-xs-12" for="meter">Cm 
		            </label> -->
		            <div class="col-md-1 col-sm-2 col-xs-4">
		              <button type="button" class="col-md-12 btn btn-info btn-sm" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Add</button>
		            </div>

		          </div>

		          <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-8" for="jenis">Jenis Benang
		            </label>
		            <div class="col-md-6 col-sm-6 col-xs-8">
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
		            <!-- <div class="col-md-1 col-sm-2 col-xs-4">
		              <button type="button" class="col-md-12 btn btn-info btn-sm" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Add</button>
		            </div> -->

		          </div>
		          <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kg">Box / Karung 
		            </label>
		            <div class="col-md-4 col-sm-6 col-xs-12">
		              <input type="text" id="bk" name="bk" required="required" class="form-control col-md-7 col-xs-12" placeholder="Exs : 30" value="<?= $bk; ?>">
		             <!-- <small><i style="color:red">*</i> Jangan Gunakan titik(.), Kecuali untuk kelebihan jumlah</small>  -->           
		           </div>
		           	<div class="col-md-2 col-sm-2 col-xs-4">
		              <select name="satuan" id="satuan" class="form-control" required>
		              	<option value="" selected disabled>-- Pilih Satuan --</option>
		              	<option value="box">Box / Dus</option>
		              	<option value="karung">Karung</option>
		              </select>
		            </div>
		          </div>

		          <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kg">Netto
		            </label>
		            <div class="col-md-4 col-sm-6 col-xs-12">
		              <input type="number" id="netto" name="netto" required="required" class="form-control col-md-7 col-xs-12" placeholder="Exs : 5  / Kg" value="">
		             <small><i style="color:red">*</i> Jangan Gunakan titik(.), Kecuali untuk kelebihan jumlah</small>            
		           </div>

		           <div class="col-md-2 col-sm-2 col-xs-4">
		              <select name="satuan_net" id="satuan_net" class="form-control" required>
		              	<option value="" selected disabled>-- Pilih Satuan --</option>
		              	<option value="ball">Ball</option>
		              	<option value="kg">Kg</option>
		              </select>
		            </div>
		          </div>

		           <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga 
		            </label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <input type="number" id="harga" name="harga" required="required" class="form-control col-md-7 col-xs-12" value="<?= $harga; ?>" placeholder="Exs : 140000">
		            </div>
		          </div>
		     
		          <div class="item form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keterangan">Keterangan <br>   (Optional) </label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="optional form-control col-md-7 col-xs-12"><?= $keterangan; ?></textarea> 
		            </div>
		          </div>
		         
							<hr>
		          <div class="ln_solid"></div>
		          <div class="form-group">
		            <div class="col-md-6 col-md-offset-3">
		              <button type="submit" class="btn btn-primary" onclick="window.history.go(-1);">Cancel</button>
		              <button type="reset" class="btn btn-danger">Reset</button>
		              <button type="submit" name="submit" class="btn btn-success" value="Submit">Submit</button>
		            </div>
		          </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>