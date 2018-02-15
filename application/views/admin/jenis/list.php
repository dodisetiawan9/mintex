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
                    <h4 class="tit">Data Jenis Benang</h4>
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#benang"><i class="fa fa-plus"></i> Tambah</button>
                    <hr>
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama Benang</th>
                          <th>Status</th>
                          <th class="text-center">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  
                          $no=1;
                          foreach ($benang->result() as $key) {  ?>
                            <tr>
                              <td><?= $no++; ?></td>
                              <td><?= $key->nama_benang; ?></td>
                              <td>
                                <?php
                                  if($key->status == "on"){
                                    echo '<span class="label label-success">Aktif</span>';
                                  }else{
                                    echo '<span class="label label-danger">Tidak Aktif</span>';
                                  } 
                                ?>
                                  
                              </td>
                              <td class="text-center">
                                <a href="<?= base_url(); ?>jenis/update/<?= $key->id_benang; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url(); ?>jenis/delete/<?= $key->id_benang; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
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
                <h4 class="tit">Data Jenis Kain</h4>
                  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#kain"><i class="fa fa-plus"></i> Tambah</button>
                  <hr>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Kain</th>
                        <th>Status</th>
                        <th class="text-center">Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php  
                        $no=1;
                        foreach ($kain->result() as $val) {  ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $val->nama_kain; ?></td>
                            <td>
                              <?php
                                  if($val->status == "on"){
                                    echo '<span class="label label-success">Aktif</span>';
                                  }else{
                                    echo '<span class="label label-danger">Tidak Aktif</span>';
                                  } 
                                ?>
                            </td>
                            <td class="text-center">
                              <a href="<?= base_url(); ?>jenis/kain_update/<?= $val->id_kain; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                              <a href="<?= base_url(); ?>jenis/kain_delete/<?= $val->id_kain; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                            </td>
                          </tr>
                       
                     <?php } ?>
                    </tbody>
                  </table>
                </div>
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
        <h4>Tambah Jenis Benang</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" method="Post" action="<?= base_url(); ?>jenis/add_benang">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Jenis 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="jenis" name="jenis" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Jenis Benang">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="status" id="" class="form-control">
                    <option value="" selected disabled>-- Pilih --</option>
                      <option value="on">Aktif</option>
                      <option value="off">Nonaktif</option>                      
                  </select>
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
        <h4>Tambah Jenis Kain</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" method="Post" action="<?= base_url(); ?>jenis/add_kain">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Jenis 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="jenis" name="jenis" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Jenis Kain">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="status" id="" class="form-control">
                    <option value="" selected disabled>-- Pilih --</option>
                      <option value="on">Aktif</option>
                      <option value="off">Nonaktif</option>                      
                  </select>
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

