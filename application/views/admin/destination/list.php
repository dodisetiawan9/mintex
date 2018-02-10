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
          <?php  
            $notif = isset($_GET['benang']) ? $_GET['benang'] : false;
            $not_kain = isset($_GET['kain']) ? $_GET['kain'] : false;
          ?>
          <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="<?php if($notif == "added" || $notif == "deleted" || $notif == "updated"){echo 'active';} ?>"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Benang</a></li>
              <li role="presentation" class="<?php if($not_kain == "added" || $not_kain == "deleted" || $not_kain == "updated"){echo 'active';} ?>"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Kain</a></li>
            </ul>
            <br>
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
            <!-- Tab panes -->
            <div class="tab-content">
             <br>

             <!--  benang -->
              <div role="tabpanel" class="tab-pane <?php if($notif == "added" || $notif == "deleted" || $notif == "updated"){echo 'active';} ?>" id="home">
                <div class="well">
                  <div class="table-responsive">
                    <h4 class="tit">Data Distributor Benang</h4>
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#benang"><i class="fa fa-plus"></i> Tambah</button>
                    <hr>
                    <table class="table table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Distributor</th>
                          <th>Alamat</th>
                          <th>Telepon</th>
                          <th class="text-center">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  
                          $no=1;
                          foreach ($benang->result() as $key) {  ?>
                            <tr>
                              <td><?= $no++; ?></td>
                              <td><?= $key->nama_dest; ?></td>
                              <td><?= $key->alamat; ?></td>
                              <td><?= $key->telepon; ?></td>
                              <td class="text-center">
                                <a href="<?= base_url(); ?>destination/update/<?= $key->id_dest; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url(); ?>destination/delete/<?= $key->id_dest; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                              </td>
                            </tr>
                         
                       <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            <!--  end benang -->
              


            <!-- kain -->
              <div role="tabpanel" class="tab-pane  <?php if($not_kain == "added" || $not_kain == "deleted" || $not_kain == "updated"){echo 'active';} ?>" id="profile">
                <div class="well">
                <h4 class="tit">Data Distributor Kain</h4>
                  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#kain"><i class="fa fa-plus"></i> Tambah</button>
                  <hr>
                  <table class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Distributor</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th class="text-center">Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php  
                        $no=1;
                        foreach ($kain->result() as $val) {  ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $val->nama_dest; ?></td>
                            <td><?= $val->alamat; ?></td>
                            <td><?= $val->telepon; ?></td>
                            <td class="text-center">
                              <a href="<?= base_url(); ?>destination/kain_update/<?= $val->id_dest; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                              <a href="<?= base_url(); ?>destination/kain_delete/<?= $val->id_dest; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                            </td>
                          </tr>
                       
                     <?php } ?>
                    </tbody>
                  </table>
              </div>
              </div>
            <!-- end kain -->
            </div>

            <!-- end tab  panes -->

        </div>
      </div>
    </div>
  </div>
</section>

<!-- modal benang -->
<div class="modal fade" id="benang">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times</button>
        <h4>Tambah Data Destination</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" method="Post" action="<?= base_url(); ?>destination/add_benang">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Destination 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="dest" name="dest" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Destination">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="alamat" name="alamat" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Alamat">
                </div>
              </div> 
               <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Telepon 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="telepon" name="telepon" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Phone">
                </div>
              </div>              
              <hr>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <button type="submit" name="submit" class="btn btn-success" value="Submit">Submit</button>
                </div>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- end modal benang -->
<!-- modal kain -->
<div class="modal fade" id="kain">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times</button>
        <h4>Tambah Data Destination</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" method="Post" action="<?= base_url(); ?>destination/add_kain">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Destination 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="dest" name="dest" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Destination">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="alamat" name="alamat" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Alamat">
                </div>
              </div> 
               <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Telepon 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="telepon" name="telepon" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Phone">
                </div>
              </div>              
              <hr>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <button type="submit" name="submit" class="btn btn-success" value="Submit">Submit</button>
                </div>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- end modal benang -->

