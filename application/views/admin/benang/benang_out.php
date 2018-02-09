<div class="headun">
		<section class="content-header">
	  <h1>
	    <?= $title; ?>
	    <small> / <?= $subtitle; ?></small>
	  </h1>
				<a href="<?= base_url(); ?>benang_out/add_benang" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
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
									<th>Tgl</th>
									<th>Distributor</th>
									<th>Jenis Benang</th>
									<th>Banyaknya</th>
									<th>Netto</th>
									<th class="text-center">Opsi</th>
								</tr>
							</thead>

							<tbody>
							
								
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