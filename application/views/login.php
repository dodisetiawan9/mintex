<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login Form</title>
	<!-- Bootstrap -->
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <style media="screen">
    	body{
    		background: #004049;
    	}

    	.well{
    		border-radius: 0px;
    		margin-top: 10%;
    		color: #616161;
    	}

    	.well hr{
    		margin: 5px;
    		border-color: #0077a3;
    	}

    	.header{
    		font-size: 40px;
    		color: #f7f7f7;
    	}

    	.header .fa{
    		border: 2px solid #fcfcfc;
    		border-radius: 50%;
    		padding: 5px;
    	}
    	
    	.container{
    		padding-top: 5%;
    	}	

    	.form-control{
    		padding: 20px 10px;
    		font-size: 20px;
    	}

    	.btn{
    		padding: 5px 20px;
    		font-size: 16px;
    		border-radius: 0px;
    	}
    </style>
</head>
<body>
	<div class="container">
		<center>
			<span class="header"><i class="fa fa-cube"></i> Cv Mintex </span>
		</center>

        <br>
		<div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4">
            <?php  
                    if($this->session->flashdata('alert'))
                    {
                        echo '<div class="alert alert-danger alert-message">';
                        echo $this->session->flashdata('alert');
                        echo '</div>';
                    }

                    if($this->session->flashdata('success'))
                    {
                        echo '<div class="alert alert-success alert-message">';
                        echo $this->session->flashdata('success');
                        echo '</div>';
                    }

            ?>

			<form action="" class="well" method="post">
                
				<h3><i class="fa fa-user"></i> Please Sign In</h3>
				<hr />
				<br />

				<div class="form-group">
					<label for="">Email / Username</label>
					<input type="text" class="form-control" placeholder="Username" name="username">
				</div>

				<div class="form-group">
					<label for="">Password</label>
					<input type="password" class="form-control" placeholder="Password" name="password">
				</div>

				<div class="form-group" style="text-align: right">
					<!-- <button type="reset" class=" btn btn-default">Cancel</button> -->
					<button type="submit" class=" btn btn-primary" name="submit" value="Submit">Sign In..</button>
				</div>
			</form>
			<!-- <p style="color:white">Lupa password? <a href="<?= base_url(); ?>lost_admin" style="color:orange">Klik disini</a></p> -->
		</div>
	</div>

	 <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $('.alert-message').alert().delay(3000).slideUp('slow');
    </script>
</body>
</html>