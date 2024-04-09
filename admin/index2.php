<?php
	include('../session/session.php');
include ('check_role.php');
	include('charts_data.php');
	$nav_header = "Dashboard";

	include('../includes/controllers.php');	
	
?>

<!DOCTYPE html>
<html>
	<!-- HTML HEAD -->
	<?php 
		include('../includes/header.php');
	?>
	<!-- /HTML HEAD -->
	<body>
<!--		<div class="pre-loader">-->
<!--			<div class="pre-loader-box">-->
<!--				<div class="loader-logo">-->
<!--					<img src="vendors/images/deskapp-logo.svg" alt="" />-->
<!--				</div>-->
<!--				<div class="loader-progress" id="progress_div">-->
<!--					<div class="bar" id="bar1"></div>-->
<!--				</div>-->
<!--				<div class="percent" id="percent1">0%</div>-->
<!--				<div class="loading-text">Loading...</div>-->
<!--			</div>-->
<!--		</div>-->

		<!-- Top NavBar -->
			<?php include('../includes/top-nav-bar.php'); ?>
		<!-- Top NavBar -->

		<?php include('../includes/right-sidebar.php'); ?>

		<!-- sidebar-left -->
		<?php include('../includes/side-bar.php'); ?>
		<!-- /sidebar-left -->
<div class="mobile-menu-overlay"></div>

<div class="main-container">
	<div class="xs-pd-20-10 pd-ltr-20">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="title">
						<h4>Treasury Management</h4>
					</div>
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index2.html">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">
								Dashboard
							</li>
						</ol>
					</nav>
				</div>
				<div class="col-md-6 col-sm-12 text-right">
					<div class="dropdown">
						<a
							class="btn btn-primary dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							January 2018
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#">Export List</a>
							<a class="dropdown-item" href="#">Policies</a>
							<a class="dropdown-item" href="#">View Assets</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row clearfix progress-box">

			<div class="col-lg-6 col-md-6 col-sm-12 mb-30">
				<div class="card-box pd-30 height-100-p">
					<div class="progress-box text-center">
						<input
							type="text"
							class="knob dial2"
							value="70"
							data-width="120"
							data-height="120"
							data-linecap="round"
							data-thickness="0.12"
							data-bgColor="#fff"
							data-fgColor="#00e091"
							data-angleOffset="180"
							readonly
						/>
						<h5 class="text-light-green padding-top-10 h5">
							Upcoming Receipts
						</h5>
						<span class="d-block"
						> <i class="fa text-light-green fa-line-chart"></i
							></span>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 mb-30">
				<div class="card-box pd-30 height-100-p">
					<div class="progress-box text-center">
						<input
							type="text"
							class="knob dial3"
							value="90"
							data-width="120"
							data-height="120"
							data-linecap="round"
							data-thickness="0.12"
							data-bgColor="#fff"
							data-fgColor="#f56767"
							data-angleOffset="180"
							readonly
						/>
						<h5 class="text-light-orange padding-top-10 h5">
							Upcoming Payments
						</h5>
						<span class="d-block"
						><i class="fa text-light-orange fa-line-chart"></i
							></span>
					</div>
				</div>
			</div>

		</div>

<div class="row">
			<div class="col-lg-8 col-md-12 col-sm-12 mb-30">
				<div class="card-box pd-30 height-100-p">
					<h4 class="mb-30 h4">Share Price Trend</h4>
					<div id="chart" class="chart"></div>
				</div>
			</div>
	<div class="col-lg-4 col-md-12 col-sm-12 mb-30">
		<div class="card-box pd-30 height-100-p">
			<h4 class="mb-30 h4">Current Liquidity Position</h4>
			<div id="compliance-trend" class="compliance-trend"></div>
<!--			<div id="chart5" ></div>-->
		</div>


	</div>
</div>
		<?php include('../includes/tables/payyment_and_receipts_table.php'); ?>
		</div>
		<?php include('includes/footer.php');?>
	</div>
</div>

<!-- js -->
<script src="../vendors/scripts/core.js"></script>
<script src="../vendors/scripts/script.min.js"></script>
<script src="../vendors/scripts/process.js"></script>
<script src="../vendors/scripts/layout-settings.js"></script>
<script src="../src/plugins/jQuery-Knob-master/jquery.knob.min.js"></script>
<!--<script src="../src/plugins/highcharts-6.0.7/code/highcharts.js"></script>-->
<!--<script src="../src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>-->

<script src="../src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
<script src="../https://code.highcharts.com/highcharts-3d.js"></script>
<script src="../src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
<script src="../vendors/scripts/highchart-setting.js"></script>


<script src="../src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="../src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../vendors/scripts/dashboard2.js"></script>
<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>


<!-- buttons for Export datatable -->
<script src="../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="../src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="../src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="../src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="../src/plugins/datatables/js/pdfmake.min.js"></script>
<script src="../src/plugins/datatables/js/vfs_fonts.js"></script>
<!-- Datatable Setting js -->
<script src="../vendors/scripts/datatable-setting.js"></script>


<noscript
><iframe
		src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
		height="0"
		width="0"
		style="display: none; visibility: hidden"
	></iframe
	></noscript>
	</body>
</html>
