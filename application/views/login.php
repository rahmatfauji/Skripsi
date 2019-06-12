<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title;?></title>

<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
<link href="<?php echo base_url('assets/bootstrap/css/styles.css')?>" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<style type="text/css">
	
	<?php

	$color=rand(000000,999999);
	//$color=63537;
	?>

	body{
		background-color:#<?php echo $color;?>;
	}

</style>

</head>

<body>

	<div class="container-fluid" style="width:550px;">
		
			<div class="panel panel-default">
				<div class="panel-heading">Sistem Penilaian Kinerja Karyawan</div>
				<div class="panel-body">
					<form role="form" method="post" action="<?php echo base_url('admin')?>">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value=""><br>
								<?php echo @$keterangan;?>
							</div>
							
							
							<input type="submit" class="btn btn-primary" value="Login" name="login">
						</fieldset>
					</form>
				</div>
			
		</div><!-- /.col-->
	</div><!-- /.row -->

	
		

	
</body>

</html>
