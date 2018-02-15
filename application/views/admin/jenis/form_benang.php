<section class="content-header">
	<h1>
		<?= $title; ?>
		<small> / <?= $subtitle; ?> </small>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Jenis 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="jenis" name="jenis" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Jenis Benang" value="<?= $jenis; ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="status" id="" class="form-control">
                    <option value="" selected disabled>-- Pilih --</option>
                      <option value="on" <?php if($status == "on"){echo 'selected';} ?>>Aktif</option>
                      <option value="off" <?php if($status == "off"){echo 'selected';} ?>>Nonaktif</option>                      
                  </select>
                </div>
              </div>        
              <hr>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                	<button type="submit" class="btn btn-primary" onclick="window.history.go(-1);">Cancel</button>
                  <button type="submit" name="submit" class="btn btn-success" value="Submit">Submit</button>
                </div>
              </div>
          </form>
				</div>
			</div>
		</div>
	</div>
</section>