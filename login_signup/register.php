<?php
?>
<!DOCTYPE html>
<html>
	<!-- HTML HEAD -->
	<?php 
		include('../includes/header.php');
	?>
	<!-- /HTML HEAD -->

	<body class="login-page">
		<div class="login-header box-shadow">
			<div
				class="container-fluid d-flex justify-content-between align-items-center">
				<div class="brand-logo">
					<a href="login.php">
						<img src="../vendors/images/untu_logo.png" alt="" />
					</a>
				</div>
				<div class="login-menu">
					<ul>
						<li><a href="login.php">Login to CMS</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 col-lg-7">
						<img src="../vendors/images/register-page-img.png" alt="" />
					</div>
					<div class="col-md-6 col-lg-5">
						<div class="register-box bg-white box-shadow border-radius-10">
							<div class="wizard-content">
								<form action="../session/controllerUserData.php" method="post" class="tab-wizard2 wizard-circle wizard" autocomplete="off">
                                    <!-- Step 1 -->
                                    <h5>Personal Information</h5>
                                    <section>
                                        <div class="form-wrap max-width-600 mx-auto">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">First Name*</label>
                                                <div class="col-sm-8">
                                                    <input name="firstname" type="text" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Last Name*</label>
                                                <div class="col-sm-8">
                                                    <input name="lastname" type="text" class="form-control" required/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Email Address</label>
                                                <div class="col-sm-8">
                                                    <input name="email" type="email" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Mobile*</label>
                                                <div class="col-sm-8">
                                                    <input name="mobile" type="number" class="form-control" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 2 -->
									<h5>Basic Account Credentials</h5>
									<section>
										<div class="form-wrap max-width-600 mx-auto">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Username</label>
                                                <div class="col-sm-8">
                                                    <input name="username" type="text" class="form-control" required/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Password</label>
                                                <div class="col-sm-8">
                                                    <input name="password" type="password" class="form-control" required/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Confirm Password</label>
                                                <div class="col-sm-8">
                                                    <input name="cpassword" type="password" class="form-control" required/>
                                                </div>
                                            </div>
										</div>
                                        <button class="form-control btn-default btn-outline-primary" type="submit" name="signup"><b>Signup</b></button>
                                    </section>

									<!-- Step 3 -->
<!--									<h5>Overview Information</h5>-->
<!--                                    <section>-->
<!--                                        <div class="form-wrap max-width-600 mx-auto">-->
<!--                                            <ul class="register-info">-->
<!--                                                <li>-->
<!--                                                    <div class="row">-->
<!--                                                        <div class="col-sm-4 weight-600">Full name</div>-->
<!--                                                        <div class="col-sm-8" id="confirm-fullname"></div>-->
<!--                                                    </div>-->
<!--                                                </li>-->
<!--                                                <li>-->
<!--                                                    <div class="row">-->
<!--                                                        <div class="col-sm-4 weight-600">Email Address</div>-->
<!--                                                        <div class="col-sm-8" id="confirm-email"></div>-->
<!--                                                    </div>-->
<!--                                                </li>-->
<!--                                                <li>-->
<!--                                                    <div class="row">-->
<!--                                                        <div class="col-sm-4 weight-600">Username</div>-->
<!--                                                        <div class="col-sm-8" id="confirm-username"></div>-->
<!--                                                    </div>-->
<!--                                                </li>-->
<!--                                                <li>-->
<!--                                                    <div class="row">-->
<!--                                                        <div class="col-sm-4 weight-600">Mobile number</div>-->
<!--                                                        <div class="col-sm-8" id="confirm-mobile"></div>-->
<!--                                                    </div>-->
<!--                                                </li>-->
<!--                                            </ul>-->
<!--                                            <div class="custom-control custom-checkbox mt-4">-->
<!--                                                <input type="checkbox" class="custom-control-input" id="customCheck1" required />-->
<!--                                                <label class="custom-control-label" for="customCheck1">I have read and agreed to the terms of services and privacy policy</label>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <button class="form-control btn-default" type="submit" name="signup">Signup</button>-->
<!--                                    </section>-->

<!--                                    <script>-->
<!--                                        // JavaScript to populate the confirmation fields-->
<!--                                        document.addEventListener("DOMContentLoaded", function () {-->
<!--                                            const form = document.querySelector("form");-->
<!--                                            const confirmFullname = document.getElementById("confirm-fullname");-->
<!--                                            const confirmEmail = document.getElementById("confirm-email");-->
<!--                                            const confirmUsername = document.getElementById("confirm-username");-->
<!--                                            const confirmMobile = document.getElementById("confirm-mobile");-->
<!---->
<!--                                            // Listen for form submissions-->
<!--                                            form.addEventListener("submit", function (e) {-->
<!--                                                // Prevent the form from submitting-->
<!--                                                e.preventDefault();-->
<!---->
<!--                                                // Populate the confirmation fields with user inputs-->
<!--                                                confirmFullname.textContent = form.firstname.value + " " + form.lastname.value;-->
<!--                                                confirmEmail.textContent = form.email.value;-->
<!--                                                confirmUsername.textContent = form.username.value;-->
<!--                                                confirmMobile.textContent = form.mobile.value;-->
<!---->
<!--                                                // Submit the form after confirmation-->
<!--                                                form.submit();-->
<!--                                            });-->
<!--                                        });-->
<!--                                    </script>-->
                                </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- success Popup html Start -->
		<button type="submit" name="signup" id="success-modal-btn" hidden data-toggle="modal" data-target="#success-modal" data-backdrop="static">Launch modal</button>
		<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered max-width-400" role="document">
				<div class="modal-content">
					<div class="modal-body text-center font-18">
						<h3 class="mb-20">User Registration!</h3>
						<div class="mb-30 text-center">
							<img src="../vendors/images/success.png" />
						</div>You have successfully created an account, Click done to login.</div>
					<div class="modal-footer justify-content-center">
						<a href="../login_signup/login.php" class="btn btn-primary">Done</a>
					</div>
				</div>
			</div>
		</div>
		<!-- success Popup html End -->
		
		<!-- js -->
		<script src="../vendors/scripts/core.js"></script>
		<script src="../vendors/scripts/script.min.js"></script>
		<script src="../vendors/scripts/process.js"></script>
		<script src="../vendors/scripts/layout-settings.js"></script>
		<script src="../src/plugins/jquery-steps/jquery.steps.js"></script>
		<script src="../vendors/scripts/steps-setting.js"></script>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.php?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
	</body>
</html>
