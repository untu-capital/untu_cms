<?php
	include('../session/session.php');
include ('check_role.php');
	include('../includes/controllers.php');
	$nav_header = "Application Details";
?>

<!DOCTYPE html>
<html>
	<!-- HTML HEAD -->
	<?php 
		include('../includes/header.php');
	?>
	<!-- /HTML HEAD -->

	<style>
		.label {
			display: inline-block;
			width: 200px; /* Adjust the width as needed */
			text-align: left;
			margin-right: 10px; /* Adjust the margin as needed */
		}
	</style>
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
					
<!--				--><?php //include('../includes/dashboard/topbar_widget.php'); ?>

<!--                --><?php //include('../includes/forms/view_loan_info.php'); ?>

				<div class="col-lg-12 col-md-12 col-sm-12 mb-30">
					<div class="pd-20 card-box">

						<h5 class="h4 text-blue mb-20">Recovery Information:</h5>
				<div class="tab-pane fade active show" id="personal_info" role="tabpanel">
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="card card-box ">
								<div class="card-body"><h5 class="card-title text-blue" style="text-decoration: underline;">Personal Information</h5>
									<p class="card-text">
									<li><b class="label">Office:</b> Bulawayo Recoveries</li>
									<li><b class="label">Client name:</b> Melody Mupenzwa</li>
									<li><b class="label">Loan Officer Name:</b> Bare Simbarashe</li>
<br>
									<br>
									<br>



									</p>
<!--									<h5 class="card-title text-blue" style="text-decoration: underline;">Contact Information</h5>-->
<!--									<p class="card-text">-->
<!--									<li><b>Phone number:</b> --><?php //echo $loans["phoneNumber"] ?><!--</li>-->
<!--									<li><b>Residential Address:</b> --><?php //echo $loans["streetNo"] ?><!-- --><?php //echo $loans["streetName"] ?><!-- --><?php //echo $loans["suburb"] ?><!-- --><?php //echo $loans["city"] ?><!--</li>-->
<!---->
<!--									</p>-->
								</div>
							</div>
						</div>

						<div class="col-sm-12 col-md-6">
							<div class="card card-box ">
								<div class="card-body">
									<h5 class="card-title text-blue" style="text-decoration: underline;">Loan Information</h5>
									<p class="card-text">

									<li><b style="padding-right: 10px;" class="label">Total Due:</b> $10 000</li>
									<li><b style="padding-right: 25px;" class="label">Days In Arrears:</b> 1295 days</li>
									<li><b style="padding-right: 25px;" class="label">Days Since Payment:</b> 1280 days</li>
									<li><b style="padding-right: 35px;" class="label">Amount:</b> $100 000</li>
									<li><b style="padding-right: 15px;" class="label">Principal Due:</b> $6600</li>
									<li><b class="label">Status:</b>
										<?php if ($loans['loanStatus'] == "ACCEPTED") {
											echo "<label style='padding: 10px;' class='badge badge-danger'>Off Track</label>";
										}  else { echo "<label style='padding: 6px;' class='badge badge-success'>On Track</label>"; } ?>
									</li>

								</div>
							</div>
						</div>
					</div>
				</div>



						<div class="pd-20 card-box mb-30">
							<div class="clearfix">
								<h4 class="text-blue h4"></h4>

							</div>
							<div class="wizard-content">

								<form action="" method="POST">

									<div class="row">


										<div class="col-md-5 col-sm-12">
											<div class="form-group">
												<label for="pob">Cause Of Arrears</label>
												<textarea type="text" id="arrears" name="arrears" required="required" maxlength = "40" minlength="4" class="form-control">Cause Of Arrears</textarea>
											</div>
										</div>

										<div class="col-md-5 col-sm-12">
											<div class="form-group">
												<label for="pob">Agreed Action Point</label>
												<textarea type="text" id="action_point" name="action_point" required="required" maxlength = "40" minlength="4" class="form-control">Agreed action Point</textarea>
											</div>
										</div>
										<div class="col-md-2 col-sm-12">
											<div class="form-group">
												<label>Comment</label>
												<select class="custom-select2 form-control" name="comment" id="comment" style="width: 100%; height: 38px" required>

													<option value="MTN">Weekly Payment</option>
													<option value="Receivable">Monthly Payment</option>
													<option value="Short_Term">Litigation</option>


												</select>
											</div>
										</div>
									</div>


									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Agreed Amount</label>
												<input type="text" class="form-control" name="amount" id="amount" required>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Handed Over To</label>
												<select class="custom-select2 form-control" name="legal" id="legal" style="width: 100%; height: 38px" required>
													<option value=null>Collectors</option>
													<option value="USD">Danziger</option>
													<option value="ZWL">Nyamundanda</option>
													<option value="ZWL">Branch</option>


												</select>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Movement</label>
												<input type="text" class="form-control" name="movement" id="movement" required>
											</div>
										</div>

										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Timeline</label>
												<input type="text" class="form-control date-picker" name="time_line" id="time_line" required>
											</div>
										</div>

									</div>

									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Next Step</label>
												<input type="text" class="form-control" name="next_step" id="next_step" value=" Summons"readonly required>
											</div>
										</div>


									</div>

									<div class="row">
										<div class="col-md-12 col-sm-12">
											<div class="form-group">
												<label>Notes</label>
												<textarea type="text" id="notes" name="notes" required="required" maxlength = "40" minlength="4" class="form-control">Notes</textarea>

											</div>
										</div>


									</div>

									</div>




									<div class="col-md-6 col-sm-12">

										<?php
										//                if ($_SERVER["REQUEST_METHOD"] == "POST") {
										//                    $start_date = $_POST["start_date"];
										//                    $end_date = $_POST["end_date"];
										//
										//                    if ($end_date > $start_date) {
										//                        // End date is greater than start date
										//                        echo "End date is greater than start date.";
										//                        // Add your desired logic here
										//                    } else {
										//                        // End date is not greater than start date
										//                        echo "End date must be greater than start date.";
										//                        // Add your desired logic here
										//                    }
										//                }
										?>
										<div class="form-group">
											<button type="submit" class="btn btn-danger" value="Submit" name="Submit">Submit</button>
										</div>
									</div>
								</form>

							</div>

						</div>
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
