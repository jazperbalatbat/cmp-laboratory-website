
<div class="sidebar app-aside" id="sidebar">
				<div class="sidebar-container perfect-scrollbar">

<nav>
						
						<!-- start: MAIN NAVIGATION MENU -->
						<div class="navbar-title">
							<span>Main Navigation</span>
						</div>
						<ul class="main-navigation-menu">
							<li>
								<a href="dashboard.php">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-home"></i>
										</div>
										<div class="item-inner">
											<span class="title"> Dashboard </span>
										</div>
									</div>
								</a>
							</li>
							<!--<li>
								<a href="javascript:void(0)">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-user"></i>
										</div>
										<div class="item-inner">
											<span class="title"> Doctors </span><i class="icon-arrow"></i>
										</div>
									</div>
								</a>
								<ul class="sub-menu">
									<li>
										<a href="doctor-specilization.php">
											<span class="title"> Doctor Specialization </span>
										</a>
									</li>
									<li>
										<a href="add-doctor.php">
											<span class="title"> Add Doctor</span>
										</a>
									</li>
									<li>
										<a href="Manage-doctors.php">
											<span class="title"> Manage Doctors </span>
										</a>
									</li>
									
								</ul>
								</li>-->

				<li>
								<a href="javascript:void(0)">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-user"></i>
										</div>
										<div class="item-inner">
											<span class="title"> Patients </span><i class="icon-arrow"></i>
										</div>
									</div>
								</a>
								<ul class="sub-menu">
									
									<li>
										<a href="manage-users.php">
											<span class="title"> Manage Patients </span>
										</a>
									</li>
									
								</ul>
								</li>	

					<li style="padding: 3px;">
								<a href="appointmenthistory.php">
									<div class="item-content" >
										<div class="item-media" id="adl">
											<i class="ti-file"></i>
										</div>
										<div class="item-inner" id="ap">
											<span class="title" id="aph"> Appointment History </span>
										</div>
									</div>
								</a>
							</li>

				<li>
								<a href="javascript:void(0)">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-user"></i>
										</div>
										<div class="item-inner">
											<span class="title"> Reports </span><i class="icon-arrow"></i>
										</div>
									</div>
								</a>
								<ul class="sub-menu">
									
									<!-- <li>
										<a href="manage-users.php">
											<span class="title"> Manage Patients </span>
										</a>
									</li> -->
									<li>
										<a href="list-patients.php">
											<span class="title"> List of Patients </span>
										</a>
									</li>
									<li>
										<a href="list-appointments.php">
											<span class="title"> List of Appointments </span>
										</a>
									</li>
									
									<li>
										<a href="list-sales.php">
											<span class="title"> Sales Report </span>
										</a>
									</li>
									
								</ul>
								</li>







			<!--	<li>
								<a href="javascript:void(0)">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-files"></i>
										</div>
										<div class="item-inner">
											<span class="title"> Conatctus Queries </span><i class="icon-arrow"></i>
										</div>
									</div>
								</a>
								<ul class="sub-menu">
									
									<li>
										<a href="unread-queries.php">
											<span class="title"> Unread Query </span>
										</a>
									</li>

									<li>
										<a href="manage-users.php">
											<span class="title"> Read Query </span>
										</a>
									</li>
									
								</ul>
								</li>



	<li>
								<a href="doctor-logs.php">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-list"></i>
										</div>
										<div class="item-inner">
											<span class="title"> Doctor Session Logs </span>
										</div>
									</div>
								</a>
							</li>		-->



							<li>
								<a href="user-logs.php">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-list"></i>
										</div>
										<div class="item-inner">
											<span class="title"> User Session Logs </span>
										</div>
									</div>
								</a>
							</li>						
				

						</ul>
						<!-- end: CORE FEATURES -->
						
					</nav>
					</div>
			</div>
			<?php
$ret=mysqli_query($con,"select * from appointment");
		while($row=mysqli_fetch_array($ret))
		{
			$x = htmlentities($row['adminStatus']);
			if($x == 0){
				$y = "#FC3333";
		echo'<script type="text/javascript">';
				echo 'document.getElementById("ap").style.background="'.$y.'";';
				echo 'document.getElementById("adl").style.background="'.$y.'";';
				echo 'document.getElementById("aph").innerHTML="Pending Appointment";';
				echo 'document.getElementById("aph").style.color="white";';
			echo'</script>';

			
			}
		}
		?>