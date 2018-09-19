<section class="content-header">
  <h1>
    Dashboard
    <small>Home</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>



<!-- Main content -->
<section class="content">

  <!-- content -->

   <div class="row">
    <div class="col-md-6 col-kain">
      <!-- form select -->
          <div class="box-header">
            <h3>Stok Data Stok Kain</h3>
          </div>
          
           <form action="" method="POST" class="searc-cn">
           <div class="col-md-10"> 
            <select name="jenis_kain" id="" class="form-control">
             
              <option value="" selected disabled>-- Pilih Jenis Kain --</option>

              <?php foreach ($kain->result() as $val): ?>
                <option value="<?= $val->id_kain; ?>"><?= $val->nama_kain; ?></option>
              <?php endforeach ?>
            </select>
            </div>
            <div class="col-md-2 cari">
              
            <button type="submit" name="submit_kain" value="Submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i></button>
            </div>

           </form>
            <br>
            <br>
            <br>

  
        <!-- endform select -->
        <?php  
          if(@!$this->input->post('submit_kain', TRUE) == 'Submit'){
            echo '<p class="text-center">Pilih jenis kain untuk melihat stok</p>';
          }else{

            $gll = explode(",", number_format($total_gl,2,',','.'));
            $mtr = explode(",", number_format($total_meter,2,',','.'));
            $klg = explode(",", number_format($total_kg,2,',','.')); 
        ?>



        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 class="sizeFont">
                <?php
                  if($gll[1] == 00){
                    echo number_format($total_gl,0,',','.');
                  }
                  else{
                    echo number_format($total_gl,2,',','.');
                  } 
                ?>
              </h3>

              <p>Total Gl</p>
            </div>
            
           
          </div>
        </div>
         <!-- ./col -->
        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 class="sizeFont">
                <?php
                  if($mtr[1] == 00){
                    echo number_format($total_meter,0,',','.');
                  }
                  else{
                    echo number_format($total_meter,2,',','.');
                  } 
                ?>
              </h3>

              <p>Total Meter</p>
            </div>
          
           
          </div>
        </div>

         <!-- ./col -->
        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 class="sizeFont">
                <?php
                  if($klg[1] == 00){
                    echo number_format($total_kg,0,',','.');
                  }
                  else{
                    echo number_format($total_kg,2,',','.');
                  } 
                ?>
              </h3>

              <p>Total Kilogram</p>
            </div>
            <div class="icon">
          
            </div>
           
          </div>
        </div>
        <!-- ./col -->
       
        <!-- ./col -->
        <?php } ?>

    </div>      

    <!-- benang -->

    <div class="col-md-6 col-benang">

        <!-- form select -->
          <div class="box-header">
            <h3>Totak Data Stok Benang</h3>
          </div>
          
           <form action="" method="post" class="searc-cn">
           <div class="col-md-10"> 
            <select name="jenis_benang" id="" class="form-control">
             
              <option value="" selected disabled>-- Pilih Jenis Benang --</option>

              <?php foreach ($benang->result() as $bng): ?>
                <option value="<?= $bng->id_benang; ?>"><?= $bng->nama_benang; ?></option>
              <?php endforeach ?>
            </select>
            </div>
            <div class="col-md-2 cari">
              
            <button type="submit" name="submit" value="Cari" class="btn btn-primary btn-block"><i class="fa fa-search"></i></button>
            </div>

           </form>
            <br>
            <br>
            <br>

         <?php  
          if(@!$this->input->post('submit', TRUE) == 'Cari'){
            echo '<p class="text-center">Pilih jenis kain untuk melihat stok</p>';
          }else{
        ?>
        <!-- endform select -->
          <!-- small box -->
       <div class="col-lg-6 col-xs-12">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 class="sizeFont">
                <?php  
                  if($total_karung <= 0){echo $total_box.' '.'Box';}
                  elseif($total_box <= 0){echo $total_karung.' '.'karung';}
                ?>
              </h3>

              <p>Banyaknya</p>
            </div>
            
           
          </div>
        </div>
         <!-- ./col -->
        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 class="sizeFont">
                <?php 
                    if($total_ball <= 0){
                      echo $total_kg.' '.'Kg';
                    }elseif($total_kg <= 0){
                      echo $total_ball.' '.'Ball';
                    } 
                ?>
              </h3>

              <p>Netto</p>
            </div>
          
           
          </div>
        </div>

      <?php } ?>
    </div> 
        
    <!-- endbenang -->    
  </div>
</section>
  <!-- endcontent -->

 




