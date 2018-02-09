<div class="headun">
  <section class="content-header">
    <h1>
      <?= $title; ?>
    </h1>
  </section>
</div>


<section class="content">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="box">
        <div class="box-header">
          
        </div>
        <div class="box-body">
          <div>
            <?php
             if($this->session->flashdata('alert_benang') || $this->session->flashdata('deleted') || $this->session->flashdata('success')){$class = 'active';}
             else{
              $class = '';
             } 
             ?>

             <?php echo validation_errors('<p style="color:red"></p>'); ?>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="<?= $class; ?>"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Distributor Benang</a></li>
              <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Distributor Kain</a></li>
            </ul>
            <br>

            <!-- Tab panes -->
            <div class="tab-content">
              <?php  
                if($this->session->flashdata('alert_benang'))
                {
                  echo '<div class="alert alert-info alert-message">';
                  echo $this->session->flashdata('alert_benang');
                  echo '</div>';

                }
                if($this->session->flashdata('success'))
                {
                  echo '<div class="alert alert-success alert-message">';
                  echo $this->session->flashdata('success');
                  echo '</div>';

                }
                if($this->session->flashdata('deleted'))
                {
                  echo '<div class="alert alert-info alert-message">';
                  echo $this->session->flashdata('deleted');
                  echo '</div>';

                }
               
              ?>
              <div role="tabpanel" class="tab-pane active" id="home">
                <div class="well">
                  <h4 class="tit">Data Distributor Benang</h4>
                  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#benang"><i class="fa fa-plus"></i> Tambah</button>
                  <hr>
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama Distributor</th>
                          <th>Alamat</th>
                          <th>Phone</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  
                          $no=1;
                          foreach ($data->result() as $key) { ?>
                            <tr>
                              <td><?= $no++; ?></td>
                              <td><?= $key->nama_dist; ?></td>
                              <td><?= $key->alamat; ?></td>
                              <td><?= $key->telepon; ?></td>
                              <td>
                                <a href="<?= base_url(); ?>distributor/update/<?= $key->id_dist_benang; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url(); ?>distributor/delete/<?= $key->id_dist_benang; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                              </td>
                            </tr>
                          
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>  
                </div>
              </div>

              <div role="tabpanel" class="tab-pane" id="profile">...</div>
              
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- modal kain -->
  <div class="modal fade" id="benang" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
          <h4 class="modal-title">Tambah Data Distributor</h4>
        </div>
        <div class="modal-body">
          <!-- form-modal -->
            <form class="form-horizontal form-label-left" method="Post" action="<?= base_url(); ?>distributor/add_dist">            

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Distributor 
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                  <input type="text" name="dist" required="required" class="form-control col-md-7 col-xs-12" value="" placeholder="Enter name distributor">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat 
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                  <input type="text" name="alamat" required="required" class="form-control col-md-7 col-xs-12" value="" placeholder="Enter Alamat">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Telepon 
                </label>
                <div class="col-md-8 col-sm-6 col-xs-12">
                  <input type="number" name="phone" required="required" class="form-control col-md-7 col-xs-12" value="" placeholder="Enter Phone">
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
          <!-- end form-modal -->
        </div>
      </div>
    </div>
  </div>
<!-- end modal kain -->