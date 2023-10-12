<?php
include('../session/session.php');
include ('check_role.php');
include('charts_data.php');
include ('../includes/controllers.php');
$nav_header = "Loan Statements";
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
                <?php
                $json = file_get_contents('http://localhost:7878/api/utg/musoni/clientAccounts/'.$_SESSION['musoniClientId']);
                $data = json_decode($json, true);
                foreach ($data['loanAccounts'] as $loanAccount):

                ?>

                <div class="blog-list">
                    <ul>
                        <li>
                            <div class="row no-gutters">
                                <div class="col-lg-2 col-md-12 col-sm-12">
                                    <div class="blog-img">
                                        <img src="../vendors/images/img2.jpg" alt="" class="bg_img"/>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-12 col-sm-12">
                                    <h4 class="card-title">Repayment Schedule For Loan: <?php echo $loanAccount['id']; ?></h4>
                                    <p class="card-text">
                                        <?php echo $loanAccount['productName'];
                                        $RPjson = file_get_contents('http://localhost:7878/api/utg/musoni/loansRepaymentSchedule/'.$loanAccount['id']);
                                        $RPdata = json_decode($RPjson, true);
                                        $repayments = $RPdata['repaymentSchedule'];
                                        ?>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">Period #</th>
                                                <th scope="col">Date Due</th>
                                                <th scope="col">Amount Due</th>
                                                <th scope="col">Amount Paid</th>
                                                <th scope="col">Total Installment</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($repayments['periods'] as $period): ?>
                                            <tr>
                                                <th scope="row"><?php echo $period['period']; ?></th>
                                                <td><?php echo date('d M Y', strtotime(implode("-", $period['dueDate']))); ?></td>
                                                <td><?php echo '$ ' . number_format($period['totalDueForPeriod'], 2, '.', ','); ?></td>
                                                <td><?php echo '$ ' . number_format($period['totalPaidForPeriod'], 2, '.', ','); ?></td>
                                                <td><?php echo '$ ' . number_format($period['totalInstallmentAmountForPeriod'], 2, '.', ','); ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <?php endforeach; ?>

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
