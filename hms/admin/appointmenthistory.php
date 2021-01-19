<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();


if(isset($_POST['approve']))
{
	$userid=$_POST['userId'];
	$examtype=$_POST['examtype'];
	$appdate=$_POST['appdate'];
	$appTime=$_POST['appTime'];
	$consfee=$_POST['consfee'];
	$adstat=1;

	$sql=mysqli_query($con,"Update appointment set exam='$examtype',consultancyFees='$consfee',adminStatus='$adstat',appointmentDate='$appdate',appointmentTime='$appTime' where id='".$_GET['id']."'");

	if($sql)
	{
		$msg="Your Profile updated Successfully";


	}

}

if(isset($_POST['disapprove']))
{
	$userid=$_POST['userId'];
	$examtype="unavailable";
	$appdate= "unavailable";
	$appTime= "unavailable";
	$consfee=0;
	$adstat=2;

	$sql=mysqli_query($con,"Update appointment set exam='$examtype',consultancyFees='$consfee',adminStatus='$adstat',appointmentDate='$appdate',appointmentTime='$appTime' where id='".$_GET['id']."'");

	if($sql)
	{
		$msg="Your Profile updated Successfully";


	}

}


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Manage Patients</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	</head>
	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
			<div class="app-content">
				
						<?php include('include/header.php');?>
						
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin | Manage Appointments</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Manage Appointments</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
						

									<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Appointments</span></h5>
									<p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
								<?php echo htmlentities($_SESSION['msg']="");?></p>
									<table class="table table-hover" id="sample-table-1">
										<thead>
											<tr>
												<th class="center">#</th>
												<th class="hidden-xs">Patient  Name</th>
											<!-- 	<th>Specialization</th -->
											
												<th>Appointment Date / Time </th>
												<th>Medical Examination</th>
													<th>Consultancy Fee</th>
												<!-- <th>Appointment Creation Date  </th> -->
												<th>Action</th>
												
											</tr>
										</thead>
										<tbody>
<?php
$x= "select users.fullName as pname, appointment.*  from appointment join users on users.id=appointment.userId  ORDER BY id DESC";

$sql=mysqli_query($con,$x);
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>

							<tr>
								<td class="center"><?php echo  $row['id'];?>.</td>
								<td class="hidden-xs"><?php echo $row['pname'];?></td>
								<td><?php echo $row['appointmentDate'];?> / <?php echo
								 $row['appointmentTime'];?>
								</td>
									<td><?php echo $row['exam'];?></td>
									<td><?php echo $row['consultancyFees'];?></td>
								<td>

								<div class="visible-md visible-lg hidden-sm hidden-xs">
									<a href="appointmenthistory.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Approve/Disapprove Appointment')"class="btn btn-xs-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove">
									manage
									</a>
								</div>
												
								</td>
							</tr>
											
								<?php 
									$cnt=$cnt+1;
								 }?>
											
											
										</tbody>
									</table>
								</div>
							</div>
								</div>


								<div id="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); transition: 0.3s; padding: 20px; margin: 10px; visibility: hidden;">
								  <div class="container">
								  	<button style="border:none; float: right;">x</button><br><br><br>
<?php 
$sql=mysqli_query($con,"select * from appointment where id='".$_GET['id']."'");
while($data=mysqli_fetch_array($sql))
{
?>
							    	<form role="form" name="appointmentDecide" method="post" style="margin-top: -90px;">
							    		<div class="form-group">
	<input style="visibility: hidden;" type="text" name="userId" class="form-control" value="<?php echo htmlentities($data['userId']);?>"  >
										</div>

										<div class="form-group">
											<label for="examtype">
											 Exam Type
											</label>
	<input type="text" name="examtype" class="form-control" value="<?php echo htmlentities($data['exam']);?>"  >
										</div>

							    		<div class="form-group">
											<label for="appdate">
											 Appointment Date
											</label>
	<input type="text" name="appdate" class="form-control" value="<?php echo htmlentities($data['appointmentDate']);?>"  >
										</div>	

										<div class="form-group">
											<label for="appTime">
											 Appointment Time
											</label>
	<input type="text" name="appTime" class="form-control" value="<?php echo htmlentities($data['appointmentTime']);?>"  >
										</div>

										<div class="form-group">
											<label for="consfee">
											 Consultation Fee
											</label>
										<input type="text" name="consfee" class="form-control"  >
										</div>
<?php } ?>

										<button type="submit" name="disapprove" class="btn btn-o btn-primary" style="float: right; margin-right: 5px;">
											disapprove
										</button>
										<button type="submit" name="approve" class="btn btn-o btn-primary" style="float: right; margin-right: 5px;">
											approve
										</button>
							    	</form>
							    	<br>
								  </div>
								</div>
							</div>
						</div>
						<!-- end: BASIC EXAMPLE -->
						<!-- end: SELECT BOXES -->

						
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			
			<!-- end: SETTINGS -->
		</div>
<?php
		if(isset($_GET['del']))
		  {
		          //mysqli_query($con,"delete from users where id = '".$_GET['id']."'");
                  //$_SESSION['msg']="data deleted !!";
		  	echo'<script type="text/javascript">';
		  	$ppp = "visible";
				echo 'document.getElementById("card").style.visibility="'.$ppp.'";';
			echo'</script>';
	  		/*$ret=mysqli_query($con,"select * from appointment where id = '".$_GET['id']."'");
				while($row=mysqli_fetch_array($ret))
				{
					$x = htmlentities($row['id']);
				
				}*/
		  }
		  ?>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
