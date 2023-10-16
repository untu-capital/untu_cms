<?php
	include('../session/session.php');
include ('check_role.php');
	include('../includes/controllers.php');
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

                <?php if ($_GET['menu'] == 'loan'){ ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                        <div class="pd-20 card-box">
                            <?php $loans = loans('/'.$_GET['loan_id']); ?>
                            <h5 class="h4 text-blue mb-20">Client: <?php echo $loans["firstName"].' '.$loans["lastName"];?></h5>
                            <div class="tab">
                                <ul class="nav nav-pills " role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active text-blue" data-toggle="tab" href="#personal_info" role="tab" aria-selected="true" >
                                            Personal Info
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-blue" data-toggle="tab" href="#kyc_docs" role="tab" aria-selected="false">KYC Documents</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="personal_info" role="tabpanel">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="card card-box ">
                                                    <div class="card-body"><h5 class="card-title text-blue" style="text-decoration: underline;">Personal Information</h5>
                                                        <p class="card-text">
                                                            <li><b>Fullname</b>: <?php echo $loans["firstName"] ?> <?php echo $loans["lastName"] ?></li>
                                                            <li><b>Marital Status</b>: <?php echo $loans["maritalStatus"] ?></li>
                                                            <li><b>Date of Birth</b>: <?php echo $loans["dateOfBirth"] ?></li>
                                                            <li><b>National ID:</b> <?php echo $loans["idNumber"] ?></li>
                                                            <li><b>Gender:</b> <?php echo $loans["gender"] ?></li>

                                                        </p>
                                                        <h5 class="card-title text-blue" style="text-decoration: underline;">Contact Information</h5>
                                                        <p class="card-text">
                                                            <li><b>Phone number:</b> <?php echo $loans["phoneNumber"] ?></li>
                                                            <li><b>Residential Address:</b> <?php echo $loans["streetNo"] ?> <?php echo $loans["streetName"] ?> <?php echo $loans["suburb"] ?> <?php echo $loans["city"] ?></li>

                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-6">
                                                <div class="card card-box ">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-blue" style="text-decoration: underline;">Business Information</h5>
                                                        <p class="card-text">
                                                            <li><b style="padding-right: 35px;">Name</b>: <?php echo $loans["businessName"] ?></li>
                                                            <li><b style="padding-right: 15px;">Address</b>: <?php echo  $loans["placeOfBusiness"] ?></li>
                                                            <li><b style="padding-right: 10px;">Start Date</b>: <?php echo  $loans["businessStartDate"] ?></li>
                                                            <li><b style="padding-right: 25px;">Type of Business</b>: <?php echo  $loans["industryCode"] ?></li>
                                                        </p>
                                                        <!-- </div>
                                                        <div class="card-body"> -->
                                                        <h5 class="card-title text-blue" style="text-decoration: underline;">Application Information</h5>
                                                        <p class="card-text">
                                                            <li><b>Loan Amount:</b> <?php echo "$ ".$loans["loanAmount"].".00" ?></li>
                                                            <li><b>Tenure:</b> <?php echo $loans["tenure"]." months" ?></li>
                                                            <li><b>Status</b>:
                                                                <?php if ($loans['loanStatus'] == "ACCEPTED") {
                                                                    echo "<label style='padding: 10px;' class='badge badge-success'>Checked</label>";
                                                                } else if ($loans['loanStatus'] == "REJECTED") {
                                                                    echo "<label style='padding: 6px;' class='badge badge-danger'>Rejected</label>";
                                                                } else { echo "<label style='padding: 6px;' class='badge badge-warning'>Pending</label>"; } ?>
                                                            </li>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="card-title text-blue" style="text-decoration: underline;">Next of Kin Details</h5>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <?php if($loans["nextOfKinName"]<>""){ ?>
                                                    <a class="list-group-item"><b style="padding-right: 60px;">Fullname</b>: <?php echo $loans["nextOfKinName"] ?></a>
                                                    <a class="list-group-item"><b style="padding-right: 20px;">Phone number</b>: <?php echo $loans["nextOfKinPhone"] ?></a>
                                                    <a class="list-group-item"><b style="padding-right: 35px;">Relationship</b>: <?php echo $loans["nextOfKinRelationship"] ?></a>
                                                    <a class="list-group-item"><b style="padding-right: 65px;">Address</b>: <?php echo $loans["nextOfKinAddress"] ?></a>
                                                <?php }; ?>
                                            </div>

                                            <div class="col-md-6">
                                                <?php if($loans["nextOfKinName2"]<>""){ ?>
                                                    <a class="list-group-item"><b style="padding-right: 60px;">Fullname</b>: <?php echo $loans["nextOfKinName2"] ?></a>
                                                    <a class="list-group-item"><b style="padding-right: 20px;">Phone number</b>: <?php echo $loans["nextOfKinPhone2"] ?></a>
                                                    <a class="list-group-item"><b style="padding-right: 35px;">Relationship</b>: <?php echo $loans["nextOfKinRelationship2"] ?></a>
                                                    <a class="list-group-item"><b style="padding-right: 65px;">Address</b>: <?php echo $loans["nextOfKinAddress2"] ?></a>
                                                <?php }; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="kyc_docs" role="tabpanel">
                                        <b>My Documents</b>
                                        <?php
                                            $client_id = $_SESSION['userId'];
                                            include('../includes/forms/view_kyc.php');?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                <?php } elseif ($_GET['menu'] == 'edit_loan'){

                    include ('../includes/forms/edit_loan.php');

				 } include('../includes/footer.php');?>
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
