<!DOCTYPE html>
<html>
<head>
  <title>Surat Jalan</title>
  <style type="text/css">
  body{
  	color: #5E5B5C;
  }
    #outtable{
      padding: 10px;
      border:1px solid #5E5B5C;
      width:100%;
      border-radius: 3px;
      overflow: hidden;
      display: inline-block;
    }
 
    .short{
      width: 50px;
    }
 
    .normal{
      width: 100%;
    }

    #right{
    	margin-top: -50px;
    	margin-left: 300px;
    }
    .bor{
    	border: 1px solid #5E5B5C;
    	padding: 10px 0px;
    }

    .bord{
    	border: 1px solid #5E5B5C;
    	padding: 3px 0px;
    	margin-left: 10px;
    }

		h2{
			display: inline-block;
		}
 
    table{
      border-collapse: collapse;
      font-family: arial;
      color:#5E5B5C;
      width: 100%;
 
    }
 
    thead th{
      text-align: left;
      padding: 0px;
      /*border: 1px solid #5E5B5C;*/
    }
 
    tbody td{
      /*border: 1px solid #5E5B5C;*/
      padding: 0px;
    }
 
    tbody tr:nth-child(even){
      background: #F6F5FA;
    }
 
    tbody tr:hover{
      background: #EAE9F5
    }
  </style>
</head>
<body>
	<?php  
		$ident 		= $dataout->row();
		$tanggal 	= date_create($ident->tgl);
		$tgl 			= date_format($tanggal, 'd M Y');
	?>
	<div id="outtable">
		<div class="">
			<h2>SURAT JALAN NO. ........</h2>
			<table id="right">
				<tr>
					<th align="left" width="100">Destination</th>
					<td>: <?= $ident->nama_dest; ?></td>
				</tr>
				<tr>
					<th align="left">Alamat</th>
					<td>: <?= $ident->alamat; ?></td>
				</tr>
				<tr>
					<th align="left">Tanggal</th>
					<td>: <?= $tgl; ?></td>
				</tr>
			</table>
		</div>
		<br />
		<div>
			<p>Kami kirimkan barang-barang tersebut di bawah ini,<br> dengan kendaraan.......................
			No. ............................</p>
		</div>
	  <!-- <table align="center">
	  	<thead>
	  		<tr>
	  			<th class="short" align="center">#</th>
	  			<th class="normal">Nama Barang</th>
	  			<th class="normal">Qty / Banyaknya</th>
	  			<th class="normal">Kg</th>
	  			
	  		</tr>
	  	</thead>
	  	<tbody>
	  		
	  		  <tr>
	  			<td align="center"></td>
	  			<td></td>
	  			<td></td>
	  			<td></td>
	  		  </tr>
	  	</tbody>
	  </table> -->
		
	  <table id="data">
	  	<tr>
	  		<th class="bor">No</th>
	  		<th class="bor">Nama Barang</th>
	  		<th class="bor">Banyaknya</th>
	  		<th class="bor">Netto</th>
	  		<th class="bor">harga</th>
	  		<th class="bor">Total</th>

	  	</tr>
	  	<?php  
	  		$no=1;
	  		$subtotal = 0;
	  		foreach ($dataout->result() as $key) : 
	  			if($key->box == 0 && $key->kg == 0){
						$total = $key->harga * $key->ball;
					}elseif($key->karung == 0 && $key->ball == 0){
						$total = $key->harga * $key->kg;
					}
					$subtotal = $subtotal + $total;
	  	?>
	  			
	  		
	  	<tr>
	  		<td class="bord" align="center"><?= $no++; ?></td>
	  		<td class="bord" style="padding-left: 10px"><?= $key->nama_benang; ?></td>
	  		<td class="bord" style="padding-left: 10px">
	  			<?php  
						if($key->karung <= 0){echo $key->box.' '.'Box';}
						elseif($key->box <= 0){echo $key->karung.' '.'karung';}
					?>
	  		</td>
	  		<td class="bord" style="padding-left: 10px">
	  			<?php 
							if($key->ball <= 0){
								echo $key->kg.' '.'Kg';
							}elseif($key->kg <= 0){
								echo $key->ball.' '.'Ball';
							} 
					?>
	  		</td>
	  		<td class="bord" style="padding-left: 10px"><?= 'Rp. '.number_format($key->harga,0,',','.'); ?></td>
	  		<td class="bord" style="padding-left: 10px"><?= 'Rp. '.number_format($total,0,',','.'); ?></td>

	  	</tr>
	  	<?php endforeach ?>
	  	<tr>
	  		<th class="bord" colspan="5" align="right" style="padding-right: 10px"><b>Subtotal</b></th>
	  		<td class="bord" style="padding-left:10px"> <b><?= 'Rp. '.number_format($subtotal,0,',','.'); ?></b></td>
	  	</tr>
	  	
	  	<tr>
	  		<td colspan="6" class="bor" style="padding: 10px"><b>Keterangan : </b>
	  			<br />
	  			<br />
	  			<?= $key->keterangan; ?>
	  		</td>
	  	</tr>
	  </table>
	  <br>
	  <br>
	  <br>
	  <div class="footer">

	  	<table id="foot">
	  		<tr>
	  			<th width="50%" align="left" style="padding-left: 10px">Tanda Terima</th>
	  			<th width="50%" align="right" style="padding-right: 10px">Hormat Kami</th>
	  		</tr>
	  	</table>
	  		<br>
	  		<br>
	  		<br>
	  		<br>
	  	<table id="foot">
	  		<tr>
	  			<th width="50%" align="left" style="padding-left: 10px">( ..................... )</th>
	  			<th width="50%" align="right" style="padding-right: 10px">( ................... )</th>
	  		</tr>
	  	</table>
	  		
		  <!-- <h4>Tanda Terima</h4>
		  <br>
		  <br>
		  <br>
		  <br>
		  <p>( ............................. )</p> -->
	  </div>
	 </div>
</body>
</html>