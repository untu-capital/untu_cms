<?php 
// session_start();
include ('check_role.php');
?>

<!DOCTYPE html>
<html>
	<!-- HTML HEAD -->
	<?php 
        // include ('../../session.php'); 
		include('../includes/header.php');
		$id = $_GET["id"];
	?>


	<!-- /HTML HEAD -->
	<!-- Cities-->

	<body>
		<div class="pre-loader">
			<div class="pre-loader-box">
				<div class="loader-logo">
					<img src="vendors/images/deskapp-logo.svg" alt="" />
				</div>
				<div class="loader-progress" id="progress_div">
					<div class="bar" id="bar1"></div>
				</div>
				<div class="percent" id="percent1">0%</div>
				<div class="loading-text">Loading...</div>
			</div>
		</div>

		<!-- Top NavBar -->
			<?php include('../includes/top-nav.php'); ?>
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
		<?php include('../includes/sidebar.php'); ?>
		<!-- /sidebar-left -->
		
		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Bulk Messege</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											
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
										Choose Ticket Action
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="view-ticket.php">View Tickets</a>
										
									</div>
								</div>
							</div>
						</div>
					</div>



					<div class="pd-20 card-box mb-30">
						<div class="clearfix">
							<h4 class="text-blue h4">Bulk Messaging</h4>
							
						</div>
						
							<form action="" method="POST">
							<?php 
		               
		                     
	                         ?>
								
								<section>


									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
												
												<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $id ?>" />
											</div>
										</div>
							

									</div>
                                        <div class="row">
                                        <div class="col-md-12">
											<div class="form-group">
												<label>Message :</label>
												<textarea class="form-control" name="reason" id="reason" ></textarea>
											</div>
										</div>
									</div>
                                    <?php

// if (isset($_GET['phoneNumbers'])) {
    
//     $phoneNumbers = explode(",", $_GET['phoneNumbers']);

//     print_r($phoneNumbers);
// } else {
   
//     echo "No phone numbers were passed.";
// }
// ?>

								</section>
								
								<div class="col-md-6 col-sm-12">
			<div class="form-group">
	<button type="submit" class="btn btn-danger" value="Submit" name="Submit">Submit</button>
	</div>
		</div>
								


        <?php 
                                  
                                  function curllbulksms($array,$message ){
   
                                            // $phoneNumber = ["0784315526","0784315526","0784315526","0776174597"];

                                            // print_r( $phoneNumber);
                                

                                    $url = "http://localhost:7878/api/utg/sms/bulk";

                                    
                                    $data_array = array(
                                        
                                        'phoneNumbers' => $array,
                                        'message'=> $message,
                                    
                                    );

                                    $data = json_encode($data_array);

                                    $ch = curl_init();

                                    curl_setopt($ch, CURLOPT_URL, $url);
                                    curl_setopt($ch, CURLOPT_POST, true);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch, CURLOPT_HEADER, true );

                                    $resp = curl_exec($ch);
                                    
                                    
                                    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                                    $headerStr = substr($resp, 0, $headerSize);
                                    $bodyStr = substr($resp, $headerSize);


                     
                                    curl_close($ch);
                                }
                                if (isset($_GET['phoneNumbers'])) {
    
                                    $phoneNumbers = explode(",", $_GET['phoneNumbers']);
                                
                                    print_r($phoneNumbers);
                                                
                                     if (isset($_POST['Submit'])) {
                                                   
                                        
                                      
                                           echo '<pre>';
                                           //  print_r($_SESSION['checked']);
                                           $array = $phoneNumbers;
                                           print_r($array);

                                           $newArray=[];
                                           foreach ($array as $value) {
                                            //    print_r( $value) . "<br />";
                                               array_push($newArray,$value);
                                            //    print_r($newArray);
                                               
                                           // print_r(var_dump($_SESSION['checked']));
                                        //    print_r( $phoneNumbers);
                                        //    echo '</pre>';
                                           }
   
                                            $comments= $_POST['reason'];
                                            $message = str_replace(' ', '%20', $comments);
                                            echo "The comment that you entered is:" . "" . $message;
                                          
                                            // $array = $_POST['phoneNumbers'];
                                            // $message = $_POST['message'];
    
                                            curllbulksms($array,$message);

                                                
                                            } else {
                                           
                                                echo "No phone numbers were passed.";
                                            }
                           
                                            }


                                                

                                                    ?>

							</form>
						</div>
					

					<!-- success Popup html Start -->
					<div
						class="modal fade"
						id="success-modal"
						tabindex="-1"
						role="dialog"
						aria-labelledby="exampleModalCenterTitle"
						aria-hidden="true"
					>
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-body text-center font-18">
									<h3 class="mb-20">Form Submitted!</h3>
									<div class="mb-30 text-center">
										<img src="vendors/images/success.png" />
									</div>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
									do eiusmod
								</div>
								<div class="modal-footer justify-content-center">
									<button
										type="button"
										class="btn btn-primary"
										data-dismiss="modal"
									>
										Done
									</button>
								</div>
							</div>
						</div>
					</div>
					<!-- success Popup html End -->
				</div>
				<div class="footer-wrap pd-20 mb-20 card-box">
					DeskApp - Bootstrap 4 Admin Template By
					<a href="https://github.com/dropways" target="_blank"
						>Ankit Hingarajiya</a
					>
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
