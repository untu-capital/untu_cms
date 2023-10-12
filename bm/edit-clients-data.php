<?php
include('../session/session.php');
include ('check_role.php');
//$nav_header = "Lead Management";
include('../includes/controllers.php');
?>
<!DOCTYPE html>
<html>
	<!-- HTML HEAD -->
	<?php 
		include('../includes/header.php');
		$id = $_GET["id"];
	?>
	<!-- /HTML HEAD -->
	<!-- Cities-->

<!-- Branches -->
<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/credit_application_client_datasets/'.$id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_response = curl_exec($ch);

curl_close($ch);

$data = json_decode($server_response, true);

?>
	<body>
<!--		<div class="pre-loader">-->
<!--			<div class="pre-loader-box">-->
<!--				<div class="loader-logo">-->
<!--					<img src="../vendors/images/deskapp-logo.svg" alt="" />-->
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

		<div class="right-sidebar">
			<div class="sidebar-title">
				<h3 class="weight-600 font-16 text-blue">
					Layout Settings
					<span class="btn-block font-weight-400 font-12"
						>User Interface Settings</span
					>
				</h3>
				<div class="close-sidebar" data-toggle="right-sidebar-close">
					<i class="icon-copy ion-close-round"></i>
				</div>
			</div>
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">
					<h4 class="weight-600 font-18 pb-10">Header Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-white active"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-dark"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-light"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-dark active"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
					<div class="sidebar-radio-group pb-10 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-1"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebaricon-1"
								><i class="fa fa-angle-down"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-2"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-2"
							/>
							<label class="custom-control-label" for="sidebaricon-2"
								><i class="ion-plus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-3"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-3"
							/>
							<label class="custom-control-label" for="sidebaricon-3"
								><i class="fa fa-angle-double-right"></i
							></label>
						</div>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
					<div class="sidebar-radio-group pb-30 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-1"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-1"
								><i class="ion-minus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-2"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-2"
							/>
							<label class="custom-control-label" for="sidebariconlist-2"
								><i class="fa fa-circle-o" aria-hidden="true"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-3"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-3"
							/>
							<label class="custom-control-label" for="sidebariconlist-3"
								><i class="dw dw-check"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-4"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-4"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-4"
								><i class="icon-copy dw dw-next-2"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-5"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-5"
							/>
							<label class="custom-control-label" for="sidebariconlist-5"
								><i class="dw dw-fast-forward-1"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-6"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-6"
							/>
							<label class="custom-control-label" for="sidebariconlist-6"
								><i class="dw dw-next"></i
							></label>
						</div>
					</div>

					<div class="reset-options pt-30 text-center">
						<button class="btn btn-danger" id="reset-settings">
							Reset Settings
						</button>
					</div>
				</div>
			</div>
		</div>

		<!-- sidebar-left -->
		<?php include('../includes/side-bar.php'); ?>
		<!-- /sidebar-left -->
		
		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<?php ?>



					<div class="pd-20 card-box mb-30">
						<div class="clearfix">
							<h4 class="text-blue h4">Edit Old Loan Record</h4>
							
						</div>
						
							<form action="edit.php" method="POST">
								<section>

									<div class="row">
									    <div class="col-md-6">
											<div class="form-group">
												<label>First Name :</label>
												<input type="text" class="form-control" name="first_name" id="first_name" value= <?= htmlspecialchars ($data["firstName"]) ?>>
											</div>
										</div>

                                        <div class="col-md-6">
											<div class="form-group">
												<label>Last Name :</label>
												<input type="text" class="form-control" name="last_name" id="last_name"  value= <?= htmlspecialchars ($data["lastName"]) ?>>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>National Id :</label>
												<input type="text" class="form-control" name="national_id" id="nature_of_business" value= <?= htmlspecialchars ($data["nationalId"]) ?> >
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Date Of Birth :</label>
												<input type="text" class="form-control" name="date_of_birth" id="business_address" value=<?= htmlspecialchars ($data["dateOfBirth"]) ?> >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
												<label>Phone Number :</label>
												<input type="text" class="form-control" name="contact_number" id="contact_number" value=<?= htmlspecialchars ($data["phoneNumber"]) ?> >
											</div>
										</div>
										<div class="col-md-6">
										<div class="form-group">
												<label>Gender <i class="far fa-sort-amount-up"></i> :</label>
												<input type="text" class="form-control" name="gender" id="gender" value=<?= htmlspecialchars ($data["gender"]) ?> >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
												<label>Phone Number :</label>
												<input type="text" class="form-control" name="phone_number" id="phone_number" value=<?= htmlspecialchars ($data["phoneNumber"]) ?> />
											</div>
										</div>
										<div class="col-md-6">
										<div class="form-group">
												<label>Branch :</label>
												<input type="text" class="form-control" name="branch" id="branch" value=<?= htmlspecialchars ($data["branch"]) ?> >
											</div>
										</div>

									</div>
                                    <div class="row">
									<div class="col-md-6">
											<div class="form-group">
												<label>Home Address :</label>
												<input type="text" class="form-control" name="home_address" id="home_address" value=<?= htmlspecialchars ($data["homeAddress"]) ?>>
											</div>
										</div>

                                        <div class="col-md-6">
											<div class="form-group">
												<label>Business Sector :</label>
												<input type="text" class="form-control" name="business_sector" id="business_sector" value=<?= htmlspecialchars ($data["businessSector"]) ?> >
											</div>
										</div>
									</div>
									<div class="row">
									<div class="col-md-6">
											<div class="form-group">
												<label>Loan Amount :</label>
												<input type="text" class="form-control" name="loan_amount" id="loan_amount" value=<?= htmlspecialchars ($data["loanAmount"]) ?>>
											</div>
										</div>

                                        <div class="col-md-6">
											<div class="form-group">
												<label>Loan Product :</label>
												<input type="text" class="form-control" name="loan_product" id="loan_product" value=<?= htmlspecialchars ($data["loanProduct"]) ?>>
											</div>
										</div>
									</div>
                                    <div class="row">
									<div class="col-md-6">
											<div class="form-group">
												<label>Credit Rating :</label>
												<input type="text" class="form-control" name="credit_rating" id="credit_rating" value=<?= htmlspecialchars ($data["creditRating"]) ?>>
											</div>
										</div>

                                        <div class="col-md-6">
											<div class="form-group">
												<label>Origin :</label>
												<input type="text" class="form-control" name="origin" id="origin" value=<?= htmlspecialchars ($data["origin"]) ?>>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
												<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $id ?>" />
											</div>
										</div>
									</div>
								</section>
								<div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger" value="Submit" name="Submit">Update</button>
                                    </div>
		                        </div>
							</form>
						</div>
					



			</div>
		</div>
		
		<!-- js -->
		<script src="../vendors/scripts/core.js"></script>
		<script src="../vendors/scripts/script.min.js"></script>
		<script src="../vendors/scripts/process.js"></script>
		<script src="../vendors/scripts/layout-settings.js"></script>
		<script src="../src/plugins/jquery-steps/jquery.steps.js"></script>
		<script src="../vendors/scripts/steps-setting.js"></script>
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
