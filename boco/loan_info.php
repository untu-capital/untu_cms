<?php
	include('../session/session.php');
include ('check_role.php');
	include('../includes/controllers.php');
include('../controllers/credit_analytics.php');
	$nav_header = "Application Details";

    if(isset($_POST['update'])) {
        $assignTo =  $_POST['assignTo'];
        $assignedBy = $_SESSION['userId'];
        $loanId = $_POST['loanId'];
        $userId =  $_POST['userId'];
        $additional_remarks =  $_POST['additional_remarks'];
        $processLoanStatus = "uncompleted";
        $bmDateAssignLo = date("Y-m-d H:i:s");
        $pipelineStatus = "bm_assign_loan";

        updateLoanStatus($assignTo, $assignedBy, $loanId, $userId, $additional_remarks, $processLoanStatus, $bmDateAssignLo, $pipelineStatus);
    }

    if(isset($_POST['check'])) {
        $upadateLoanStatus = $_POST['update_loan_status'];
        $loanId =  $_POST['loan_id'];
        $userId =  $_POST['userid'];
        $comment =  $_POST['reason'];
        $bocoDate = date("Y-m-d H:i:s");
        $pipelineStatus = "boco_checks_application";

        boco_check_application($upadateLoanStatus, $loanId, $userId, $comment, $bocoDate, $pipelineStatus);
    }
?>

<!DOCTYPE html>
<html>
	<!-- HTML HEAD -->
	<?php 
		include('../includes/header.php');
	?>
	<!-- /HTML HEAD -->
	<body>

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

                <?php include('../includes/forms/view_loan_info.php'); ?>

                <?php include('../includes/tables/track_loans_progress_table.php'); ?>

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
