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
			<div class="pd-ltr-20">
					
				<?php include('../includes/dashboard/topbar_widget.php'); ?>
					
				<?php include('../includes/dashboard/welcome_widget.php'); ?>

                <!-- powerBi widget -->
                <div class="card-box pd-20 height-100-p mb-30">
                    <div class="row align-items-center">
<!--                        <iframe class="card-body" title="credit_loans" width="1140" height="515" src="https://app.powerbi.com/reportEmbed?reportId=de0def08-11a1-48a7-84de-6a985f030144&autoAuth=true&ctid=66d250cc-d4c9-4aa7-beec-9a10acf3be25" frameborder="0" allowFullScreen="true"></iframe>-->
                        <iframe
                                src="http://localhost:3000/public/dashboard/92d8721b-5168-4c92-aac7-69f94bf1b23b"
                                frameborder="0"
                                width=100%
                                height=800
                                allowtransparency
                        ></iframe>
                    </div>
                </div>

				<?php include('../includes/tables/users_table.php'); ?>

				<?php include('../includes/footer.php');?>
			</div>
		</div>
		
		<!-- js -->
		<script src="../vendors/scripts/core.js"></script>
		<script src="../vendors/scripts/script.min.js"></script>
		<script src="../vendors/scripts/process.js"></script>
		<script src="../vendors/scripts/layout-settings.js"></script>
		<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script>
			var disbursementData = <?php echo json_encode($disbursement_data); ?>;
			var targetData = <?php echo json_encode($target_data); ?>; 
			var disbursementRate = <?php echo json_encode($disbursement_rate); ?>;
		</script>
		<script src="../vendors/scripts/dashboard.js"></script>

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
		

		
		<!-- Google Tag Manager (noscript) -->
		<noscript
			><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
		<!-- End Google Tag Manager (noscript) -->
		
	</body>
</html>
