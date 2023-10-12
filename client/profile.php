<?php
    include('../session/session.php');
include ('check_role.php');
//    include('charts_data.php');
    include('../includes/controllers.php');
    $nav_header = "My Profile";

	
    function updateprofile($id, $firstname,$password, $lastname, $username, $email, $date, $gender, $phonenumber, $marital, $city, $surbab, $streetname,$streetnumber){

        $url = "http://localhost:7878/api/utg/users/updateUser/".$id;
        $data_array = array(
            'firstName' => $firstname,
			'lastName' => $lastname,
			'username' => $username,
			'firstName' => $firstname,
			'password' => $password,
			'dateOfBirth' => $date,
			'gender' => $gender,
			'maritalStatus' => $marital,
			'city' => $city,
			'surbub' => $surbab,
			'streetName' => $streetname,
			'streetNumber' => $streetnumber,
			'contactDetail' => array(
				'mobileNumber' => $phonenumber,
				'emailAddress' => $email
			)
        );
    
        $data = json_encode($data_array);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        $resp = curl_exec($ch);
    
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headerStr = substr($resp, 0, $headerSize);
        $bodyStr = substr($resp, $headerSize);
    
        // convert headers to array
        $headers = headersToArray( $headerStr );
    
        if (!curl_errno($ch)) {
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:  # OK redirect to dashboard
                    $_SESSION['info'] = "Zone Updated Successfully!";
                    audit($_SESSION['userid'], "Signed Ticket Successfully! - ".$id, $_SESSION['branch']);
                    header('location: profile.php');
                    break;
                case 400:  # Bad Request
                    $decoded = json_decode($bodyStr);
                    foreach($decoded as $key => $val) {
                        echo $key . ': ' . $val . '<br>';
                    }
                    echo $val;
                    $_SESSION['error'] = "Failed. Please try again, ".$val;
                    audit($_SESSION['userid'], "Failed to Sign Ticket! - ".$id, $_SESSION['branch']);
                    header('location: predisbursed_tickets.php');
                    break;
                default:
                    $_SESSION['error'] = 'Could not update Loan status '. "\n";
                    audit($_SESSION['userid'], "Failed to Sign Ticket! - ".$id, $_SESSION['branch']);
                    header('location: predisbursed_tickets.php');
            }
        } else {
            $_SESSION['error'] = 'Update failed.. Please try again!'. "\n";
            audit($_SESSION['userid'], "Failed to Update Zone! - ".$id, $_SESSION['branch']);
            header('location: edit.php?menu=zones');
        }
        curl_close($ch);
    }
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
        $username = $_POST['username'];
		$email = $_POST['email'];
		$date = $_POST['date'];
		$gender = $_POST['gender'];
		$phonenumber = $_POST['phonenumber'];
		$marital = $_POST['maritalstatus'];
		$city = $_POST['city'];
		$surbab = $_POST['surbab'];
		$streetname = $_POST['streetname'];
		$streetnumber = $_POST['streetnumber'];
		$password = $_POST['password'];

        updateprofile($id, $firstname,$password, $lastname, $username, $email, $date, $gender, $phonenumber, $marital, $city, $surbab, $streetname,$streetnumber);
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
		<?php $user = user($_SESSION['userId']); ?>
		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="title">
									<h4>Profile</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="index.php">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Profile
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
							<div class="pd-20 card-box height-100-p">
								<div class="profile-photo">
									<a
										href="modal"
										data-toggle="modal"
										data-target="#modal"
										class="edit-avatar"
										><i class="fa fa-pencil"></i
									></a>
									<img
										src="../vendors/images/photo1.jpg"
										alt=""
										class="avatar-photo"
									/>
									<div
										class="modal fade"
										id="modal"
										tabindex="-1"
										role="dialog"
										aria-labelledby="modalLabel"
										aria-hidden="true"
									>
										<div
											class="modal-dialog modal-dialog-centered"
											role="document"
										>
											<div class="modal-content">
												<div class="modal-body pd-5">
													<div class="img-container">
														<img
															id="image"
															src="../vendors/images/photo2.jpg"
															alt="Picture"
														/>
													</div>
												</div>
												<div class="modal-footer">
													<input
														type="submit"
														value="Update"
														class="btn btn-primary"
													/>
													<button
														type="button"
														class="btn btn-default"
														data-dismiss="modal"
													>
														Close
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<h5 class="text-center h5 mb-0"><?php echo $user['firstName'].' '.$user['lastName']; ?></h5>
								<p class="text-center text-muted font-14">
							
								</p>
								<div class="profile-info">
									<h5 class="mb-20 h5 text-blue">Contact Information</h5>
									<ul>
										<li>
											<span>Email Address:</span>
											<?php echo $user['contactDetail']['emailAddress']; ?>
										</li>
										<li>
											<span>Phone Number:</span>
											<?php echo $user['contactDetail']['mobileNumber']; ?>
										</li>
										<li>
											<span>Country:</span>
											Zimbabwe
										</li>
										<li>
											<span>Address:</span>
											<?php echo $user['city']; ?> ,<?php echo $user['surbab']; ?><br />
											<?php echo $user['streetName']; ?>, <?php echo $user['streetNumber']; ?>
										</li>
									</ul>
								</div>
							

							</div>
						</div>
						<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
							<div class="card-box height-100-p overflow-hidden">
								<div class="profile-tab height-100-p">
									<div class="tab height-100-p">
										<ul class="nav nav-tabs customtab" role="tablist">
											<li class="nav-item">
												<a
													class="nav-link active"
													data-toggle="tab"
													href="#timeline"
													role="tab"
													>Timeline</a
												>
											</li>
											<li class="nav-item">
												<a
													class="nav-link"
													data-toggle="tab"
													href="#tasks"
													role="tab"
													>Tasks</a
												>
											</li>
											<li class="nav-item">
												<a
													class="nav-link"
													data-toggle="tab"
													href="#setting"
													role="tab"
													>Update Profile</a
												>
											</li>
										</ul>
										<div class="tab-content">
											<!-- Timeline Tab start -->
											<div
												class="tab-pane fade show active"
												id="timeline"
												role="tabpanel"
											>
												<div class="pd-20">
													<div class="profile-timeline">
														<div class="timeline-month">
															<h5>August, 2020</h5>
														</div>
														<div class="profile-timeline-list">
															<ul>
																<li>
																	<div class="date">12 Aug</div>
																	<div class="task-name">
																		<i class="ion-android-alarm-clock"></i> Task
																		Added
																	</div>
																	<p>
																		Lorem ipsum dolor sit amet, consectetur
																		adipisicing elit.
																	</p>
																	<div class="task-time">09:30 am</div>
																</li>
																<li>
																	<div class="date">10 Aug</div>
																	<div class="task-name">
																		<i class="ion-ios-chatboxes"></i> Task Added
																	</div>
																	<p>
																		Lorem ipsum dolor sit amet, consectetur
																		adipisicing elit.
																	</p>
																	<div class="task-time">09:30 am</div>
																</li>
																<li>
																	<div class="date">10 Aug</div>
																	<div class="task-name">
																		<i class="ion-ios-clock"></i> Event Added
																	</div>
																	<p>
																		Lorem ipsum dolor sit amet, consectetur
																		adipisicing elit.
																	</p>
																	<div class="task-time">09:30 am</div>
																</li>
																<li>
																	<div class="date">10 Aug</div>
																	<div class="task-name">
																		<i class="ion-ios-clock"></i> Event Added
																	</div>
																	<p>
																		Lorem ipsum dolor sit amet, consectetur
																		adipisicing elit.
																	</p>
																	<div class="task-time">09:30 am</div>
																</li>
															</ul>
														</div>
														<div class="timeline-month">
															<h5>July, 2020</h5>
														</div>
														<div class="profile-timeline-list">
															<ul>
																<li>
																	<div class="date">12 July</div>
																	<div class="task-name">
																		<i class="ion-android-alarm-clock"></i> Task
																		Added
																	</div>
																	<p>
																		Lorem ipsum dolor sit amet, consectetur
																		adipisicing elit.
																	</p>
																	<div class="task-time">09:30 am</div>
																</li>
																<li>
																	<div class="date">10 July</div>
																	<div class="task-name">
																		<i class="ion-ios-chatboxes"></i> Task Added
																	</div>
																	<p>
																		Lorem ipsum dolor sit amet, consectetur
																		adipisicing elit.
																	</p>
																	<div class="task-time">09:30 am</div>
																</li>
															</ul>
														</div>
														<div class="timeline-month">
															<h5>June, 2020</h5>
														</div>
														<div class="profile-timeline-list">
															<ul>
																<li>
																	<div class="date">12 June</div>
																	<div class="task-name">
																		<i class="ion-android-alarm-clock"></i> Task
																		Added
																	</div>
																	<p>
																		Lorem ipsum dolor sit amet, consectetur
																		adipisicing elit.
																	</p>
																	<div class="task-time">09:30 am</div>
																</li>
																<li>
																	<div class="date">10 June</div>
																	<div class="task-name">
																		<i class="ion-ios-chatboxes"></i> Task Added
																	</div>
																	<p>
																		Lorem ipsum dolor sit amet, consectetur
																		adipisicing elit.
																	</p>
																	<div class="task-time">09:30 am</div>
																</li>
																<li>
																	<div class="date">10 June</div>
																	<div class="task-name">
																		<i class="ion-ios-clock"></i> Event Added
																	</div>
																	<p>
																		Lorem ipsum dolor sit amet, consectetur
																		adipisicing elit.
																	</p>
																	<div class="task-time">09:30 am</div>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
											<!-- Timeline Tab End -->
											<!-- Tasks Tab start -->
											<div class="tab-pane fade" id="tasks" role="tabpanel">
												<div class="pd-20 profile-task-wrap">
													<div class="container pd-0">
														<!-- Open Task start -->
														<div class="task-title row align-items-center">
															<div class="col-md-8 col-sm-12">
																<h5>Open Tasks (4 Left)</h5>
															</div>
															<div class="col-md-4 col-sm-12 text-right">
																<a
																	href="task-add"
																	data-toggle="modal"
																	data-target="#task-add"
																	class="bg-light-blue btn text-blue weight-500"
																	><i class="ion-plus-round"></i> Add</a
																>
															</div>
														</div>
														<div class="profile-task-list pb-30">
															<ul>
																<li>
																	<div
																		class="custom-control custom-checkbox mb-5"
																	>
																		<input
																			type="checkbox"
																			class="custom-control-input"
																			id="task-1"
																		/>
																		<label
																			class="custom-control-label"
																			for="task-1"
																		></label>
																	</div>
																	<div class="task-type">Email</div>
																	Lorem ipsum dolor sit amet, consectetur
																	adipisicing elit. Id ea earum.
																	<div class="task-assign">
																		Assigned to Ferdinand M.
																		<div class="due-date">
																			due date <span>22 February 2019</span>
																		</div>
																	</div>
																</li>
																<li>
																	<div
																		class="custom-control custom-checkbox mb-5"
																	>
																		<input
																			type="checkbox"
																			class="custom-control-input"
																			id="task-2"
																		/>
																		<label
																			class="custom-control-label"
																			for="task-2"
																		></label>
																	</div>
																	<div class="task-type">Email</div>
																	Lorem ipsum dolor sit amet.
																	<div class="task-assign">
																		Assigned to Ferdinand M.
																		<div class="due-date">
																			due date <span>22 February 2019</span>
																		</div>
																	</div>
																</li>
																<li>
																	<div
																		class="custom-control custom-checkbox mb-5"
																	>
																		<input
																			type="checkbox"
																			class="custom-control-input"
																			id="task-3"
																		/>
																		<label
																			class="custom-control-label"
																			for="task-3"
																		></label>
																	</div>
																	<div class="task-type">Email</div>
																	Lorem ipsum dolor sit amet, consectetur
																	adipisicing elit.
																	<div class="task-assign">
																		Assigned to Ferdinand M.
																		<div class="due-date">
																			due date <span>22 February 2019</span>
																		</div>
																	</div>
																</li>
																<li>
																	<div
																		class="custom-control custom-checkbox mb-5"
																	>
																		<input
																			type="checkbox"
																			class="custom-control-input"
																			id="task-4"
																		/>
																		<label
																			class="custom-control-label"
																			for="task-4"
																		></label>
																	</div>
																	<div class="task-type">Email</div>
																	Lorem ipsum dolor sit amet. Id ea earum.
																	<div class="task-assign">
																		Assigned to Ferdinand M.
																		<div class="due-date">
																			due date <span>22 February 2019</span>
																		</div>
																	</div>
																</li>
															</ul>
														</div>
														<!-- Open Task End -->
														<!-- Close Task start -->
														<div class="task-title row align-items-center">
															<div class="col-md-12 col-sm-12">
																<h5>Closed Tasks</h5>
															</div>
														</div>
														<div class="profile-task-list close-tasks">
															<ul>
																<li>
																	<div
																		class="custom-control custom-checkbox mb-5"
																	>
																		<input
																			type="checkbox"
																			class="custom-control-input"
																			id="task-close-1"
																			checked=""
																			disabled=""
																		/>
																		<label
																			class="custom-control-label"
																			for="task-close-1"
																		></label>
																	</div>
																	<div class="task-type">Email</div>
																	Lorem ipsum dolor sit amet, consectetur
																	adipisicing elit. Id ea earum.
																	<div class="task-assign">
																		Assigned to Ferdinand M.
																		<div class="due-date">
																			due date <span>22 February 2018</span>
																		</div>
																	</div>
																</li>
																<li>
																	<div
																		class="custom-control custom-checkbox mb-5"
																	>
																		<input
																			type="checkbox"
																			class="custom-control-input"
																			id="task-close-2"
																			checked=""
																			disabled=""
																		/>
																		<label
																			class="custom-control-label"
																			for="task-close-2"
																		></label>
																	</div>
																	<div class="task-type">Email</div>
																	Lorem ipsum dolor sit amet.
																	<div class="task-assign">
																		Assigned to Ferdinand M.
																		<div class="due-date">
																			due date <span>22 February 2018</span>
																		</div>
																	</div>
																</li>
																<li>
																	<div
																		class="custom-control custom-checkbox mb-5"
																	>
																		<input
																			type="checkbox"
																			class="custom-control-input"
																			id="task-close-3"
																			checked=""
																			disabled=""
																		/>
																		<label
																			class="custom-control-label"
																			for="task-close-3"
																		></label>
																	</div>
																	<div class="task-type">Email</div>
																	Lorem ipsum dolor sit amet, consectetur
																	adipisicing elit.
																	<div class="task-assign">
																		Assigned to Ferdinand M.
																		<div class="due-date">
																			due date <span>22 February 2018</span>
																		</div>
																	</div>
																</li>
																<li>
																	<div
																		class="custom-control custom-checkbox mb-5"
																	>
																		<input
																			type="checkbox"
																			class="custom-control-input"
																			id="task-close-4"
																			checked=""
																			disabled=""
																		/>
																		<label
																			class="custom-control-label"
																			for="task-close-4"
																		></label>
																	</div>
																	<div class="task-type">Email</div>
																	Lorem ipsum dolor sit amet. Id ea earum.
																	<div class="task-assign">
																		Assigned to Ferdinand M.
																		<div class="due-date">
																			due date <span>22 February 2018</span>
																		</div>
																	</div>
																</li>
															</ul>
														</div>
														<!-- Close Task start -->
														<!-- add task popup start -->
														<div
															class="modal fade customscroll"
															id="task-add"
															tabindex="-1"
															role="dialog"
														>
															<div
																class="modal-dialog modal-dialog-centered"
																role="document"
															>
																<div class="modal-content">
																	<div class="modal-header">
																		<h5
																			class="modal-title"
																			id="exampleModalLongTitle"
																		>
																			Tasks Add
																		</h5>
																		<button
																			type="button"
																			class="close"
																			data-dismiss="modal"
																			aria-label="Close"
																			data-toggle="tooltip"
																			data-placement="bottom"
																			title=""
																			data-original-title="Close Modal"
																		>
																			<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<div class="modal-body pd-0">
																		<div class="task-list-form">
																			<ul>
																				<li>
																					<form>
																						<div class="form-group row">
																							<label class="col-md-4"
																								>Task Type</label
																							>
																							<div class="col-md-8">
																								<input
																									type="text"
																									class="form-control"
																								/>
																							</div>
																						</div>
																						<div class="form-group row">
																							<label class="col-md-4"
																								>Task Message</label
																							>
																							<div class="col-md-8">
																								<textarea
																									class="form-control"
																								></textarea>
																							</div>
																						</div>
																						<div class="form-group row">
																							<label class="col-md-4"
																								>Assigned to</label
																							>
																							<div class="col-md-8">
																								<select
																									class="selectpicker form-control"
																									data-style="btn-outline-primary"
																									title="Not Chosen"
																									multiple=""
																									data-selected-text-format="count"
																									data-count-selected-text="{0} people selected"
																								>
																									<option>Ferdinand M.</option>
																									<option>Don H. Rabon</option>
																									<option>Ann P. Harris</option>
																									<option>
																										Katie D. Verdin
																									</option>
																									<option>
																										Christopher S. Fulghum
																									</option>
																									<option>
																										Matthew C. Porter
																									</option>
																								</select>
																							</div>
																						</div>
																						<div class="form-group row mb-0">
																							<label class="col-md-4"
																								>Due Date</label
																							>
																							<div class="col-md-8">
																								<input
																									type="text"
																									class="form-control date-picker"
																								/>
																							</div>
																						</div>
																					</form>
																				</li>
																				<li>
																					<a
																						href="javascript:;"
																						class="remove-task"
																						data-toggle="tooltip"
																						data-placement="bottom"
																						title=""
																						data-original-title="Remove Task"
																						><i class="ion-minus-circled"></i
																					></a>
																					<form>
																						<div class="form-group row">
																							<label class="col-md-4"
																								>Task Type</label
																							>
																							<div class="col-md-8">
																								<input
																									type="text"
																									class="form-control"
																								/>
																							</div>
																						</div>
																						<div class="form-group row">
																							<label class="col-md-4"
																								>Task Message</label
																							>
																							<div class="col-md-8">
																								<textarea
																									class="form-control"
																								></textarea>
																							</div>
																						</div>
																						<div class="form-group row">
																							<label class="col-md-4"
																								>Assigned to</label
																							>
																							<div class="col-md-8">
																								<select
																									class="selectpicker form-control"
																									data-style="btn-outline-primary"
																									title="Not Chosen"
																									multiple=""
																									data-selected-text-format="count"
																									data-count-selected-text="{0} people selected"
																								>
																									<option>Ferdinand M.</option>
																									<option>Don H. Rabon</option>
																									<option>Ann P. Harris</option>
																									<option>
																										Katie D. Verdin
																									</option>
																									<option>
																										Christopher S. Fulghum
																									</option>
																									<option>
																										Matthew C. Porter
																									</option>
																								</select>
																							</div>
																						</div>
																						<div class="form-group row mb-0">
																							<label class="col-md-4"
																								>Due Date</label
																							>
																							<div class="col-md-8">
																								<input
																									type="text"
																									class="form-control date-picker"
																								/>
																							</div>
																						</div>
																					</form>
																				</li>
																			</ul>
																		</div>
																		<div class="add-more-task">
																			<a
																				href="#"
																				data-toggle="tooltip"
																				data-placement="bottom"
																				title=""
																				data-original-title="Add Task"
																				><i class="ion-plus-circled"></i> Add
																				More Task</a
																			>
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button
																			type="button"
																			class="btn btn-primary"
																		>
																			Add
																		</button>
																		<button
																			type="button"
																			class="btn btn-secondary"
																			data-dismiss="modal"
																		>
																			Close
																		</button>
																	</div>
																</div>
															</div>
														</div>
														<!-- add task popup End -->
													</div>
												</div>
											</div>
											<!-- Tasks Tab End -->
											<!-- Setting Tab start -->
											<div
												class="tab-pane fade height-100-p"
												id="setting"
												role="tabpanel"
											>
												<div class="profile-setting">

												<?php $user = user($_SESSION['userId']); ?>
													<form action="" method="POST">
														<ul class="profile-edit-list row">
															<li class="weight-500 col-md-12">
																<h4 class="text-blue h5 mb-20">
																	Edit Your Personal Setting
																</h4>
																<div class="form-group">
																	<label>First Name</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		value="<?php echo $user['firstName']; ?>"
																		name="firstname"
																		id="firstname"
																		
																	/>
																</div>
																<div class="form-group">
																	<label>Last Name</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		value="<?php echo $user['lastName']; ?>"
																		name="lastname"
																		id="lastname"
																	/>
																</div>

																<div class="form-group">
																	
																	<input
																		class="form-control form-control-lg"
																		type="hidden"
																		value="<?php echo $user['id']; ?>"
																		name="id"
																		id="id"
																	/>
																</div>
																<div class="form-group">
																	<label>User Name</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		value="<?php echo $user['username']; ?>"
																		name="username"
																		id="username"
																	/>
																</div>
																<!-- <div class="form-group">
																	<label>Password</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		value="<?php echo $user['password']; ?>"
																		name="password"
																		id="password"
																	/>
																</div> -->
																<div class="form-group">
																	<label>Email</label>
																	<input
																		class="form-control form-control-lg"
																		type="email"
																		value="<?php echo $user['contactDetail']['emailAddress']; ?>"
																		name="email"
																		id="id"

																	/>
																</div>
																<div class="form-group">
																	<label>Date of birth</label>
																	<input
																		class="form-control form-control-lg date-picker"
																		type="text"
																		value="<?php echo $user['dirtOfBirth']; ?>"
																		name="date"
																		id="date"

																	/>
																</div>

																<div class="form-group">
																	<label>Gender</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		value="<?php echo $user['gender']; ?>"
																		name="gender"
																		id="gender"

																		
																	/>
																</div>
																
													
								
																<div class="form-group">
																	<label>Phone Number</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		value="<?php echo $user['contactDetail']['mobileNumber']; ?>"
																		name="phonenumber"
																		id="phonenumber"

																		
																	/>
																</div>
																<div class="form-group">
																	<label>Marital Status</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		value="<?php echo $user['MaritalStatus']; ?>"
																		name="maritalstatus"
																		id="maritalstatus"

																	/>
																</div>
																<div class="form-group">
																	<label>City</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		value="<?php echo  $user['city']; ?>"
																		name="city"
																		id="city"
																	/>
																</div>

																<div class="form-group">
																	<label>Surbab</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		value="<?php echo  $user['surbab']; ?>"
																		name="surbab"
																		id="surbab"
																	/>
																</div>
																<div class="form-group">
																	<label>Street Name</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		value="<?php echo  $user['streetName']; ?>"
																		name="streetname"
																		id="streetname"
																		
																	/>
																</div>

																<div class="form-group">
																	<label>Street Number</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		value="<?php echo  $user['streetNumber']; ?>"
																		name="streetnumber"
																		id="streetnumber"
																		
																	/>
																</div>
																<div class="form-group">
																	<div
																		class="custom-control custom-checkbox mb-5"
																	>
																		<input
																			type="checkbox"
																			class="custom-control-input"
																			id="customCheck1-1"
																		/>
																		<label
																			class="custom-control-label weight-400"
																			for="customCheck1-1"
																			>I agree to receive notification
																			emails</label
																		>
																	</div>
																</div>
																<div class="form-group mb-0">
																	<input
																		type="submit"
																		class="btn btn-primary"
																		value="Update Information"
																		name="submit"
																		id="submit"
																	/>
																</div>
															</li>

														</ul>
													</form>
												</div>
											</div>
											<!-- Setting Tab End -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php include('../includes/footer.php') ?>
			</div>
		</div>
		
		<!-- js -->
		<script src="../vendors/scripts/core.js"></script>
		<script src="../vendors/scripts/script.min.js"></script>
		<script src="../vendors/scripts/process.js"></script>
		<script src="../vendors/scripts/layout-settings.js"></script>
		<script src="../src/plugins/cropperjs/dist/cropper.js"></script>
		<script>
			window.addEventListener("DOMContentLoaded", function () {
				var image = document.getElementById("image");
				var cropBoxData;
				var canvasData;
				var cropper;

				$("#modal")
					.on("shown.bs.modal", function () {
						cropper = new Cropper(image, {
							autoCropArea: 0.5,
							dragMode: "move",
							aspectRatio: 3 / 3,
							restore: false,
							guides: false,
							center: false,
							highlight: false,
							cropBoxMovable: false,
							cropBoxResizable: false,
							toggleDragModeOnDblclick: false,
							ready: function () {
								cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
							},
						});
					})
					.on("hidden.bs.modal", function () {
						cropBoxData = cropper.getCropBoxData();
						canvasData = cropper.getCanvasData();
						cropper.destroy();
					});
			});
		</script>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
	</body>
</html>
