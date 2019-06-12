<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title;?></title>
<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="shortcut icon" type="image/x-icon">
<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
<link href="<?php echo base_url('assets/bootstrap/css/style.css')?>" rel="stylesheet">
<link href="<?php echo base_url('assets/validation/css/formValidation.css')?>" rel="stylesheet">

<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('assets/validation/js/formValidation.js')?>"></script>
<script src="<?php echo base_url('assets/validation/js/framework/bootstrap.js')?>"></script>

<!-- icons-->
		


</head>


<body>



	 <!--side bar menu-->

	<div id="sidebar-collapse" class="col-xs-2 col-md-2 col-sm-2 col-lg-2 sidebar">
	<ul class="nav">
		<li style="text-align: center;">
		<a href="<?php echo base_url('home.html');?>"><img class='img-rounded' src="<?php echo base_url('assets/gambar/logo.png');?>" style="max-width:90%;"></a>
		</li>

		<li class="divider"></li>
		
		<li class="<?php echo @$btn1;?>"><a href="<?php echo base_url('data-karyawan-aktif.html');?>"><b class="glyphicon glyphicon-th"></b> Tabel Karyawan</a></li>
		<li class="divider"></li>
		<li class="<?php echo @$btn2;?>"><a href="<?php echo base_url('data-jabatan-aktif.html');?>"><b class="glyphicon glyphicon-th"></b> Tabel Jabatan</a></li>
		<li class="divider"></li>
		<li class="<?php echo @$btn3;?>"><a href="<?php echo base_url('data-penilaian-aktif.html');?>"><b class="glyphicon glyphicon-th"></b> Tabel Penilaian</a></li>
		<li class="divider"></li>
		<li class="<?php echo @$btn4;?>"><a href="javascript:void()" onclick="gantisandi()"><b class="glyphicon glyphicon-user"></b> Ganti Password</a></li>
		<li class="divider"></li>
		
		<li><a href="<?php echo base_url('admin/logout');?>" onclick="return confirm('YAkin ingin Logout??')"><b class="glyphicon glyphicon-off"></b> logout</a></li>
		<li  class="divider"></li>
	</ul>	
	</div>

	<!-- end sidebar -->
<!-- main -->
<div class="col-xs-10 col-xs-offset-2 col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 col-lg-10 col-lg-offset-2 main">			
				
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo @$judultabel;?></div>
					<div class="panel-body">
						<?php $this->load->view($table);?>
					</div>
				</div>
		
	
		
		
		
	</div><!--/.main-->	


<?php

$this->load->view('sandi');

?>

	
</body>

        
</html>

