<!DOCTYPE html>
<html>
	<!-- HTML HEAD -->
	<?php 
		include('includes/head.php');
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
			<?php include('includes/top-nav.php'); ?>
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
		<?php include('includes/sidebar.php'); ?>
		<!-- /sidebar-left -->
		
		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="title">
									<h4>Tabs</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="index.html">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											UI Tabs
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

					<div class="row clearfix">
						<div class="col-lg-6 col-md-12 col-sm-12 mb-30">
							<div class="pd-20 card-box">
								<h5 class="h4 text-blue mb-20">Default Tab</h5>
								<div class="tab">
									<ul class="nav nav-tabs" role="tablist">
										<li class="nav-item">
											<a
												class="nav-link active text-blue"
												data-toggle="tab"
												href="#home"
												role="tab"
												aria-selected="true"
												>Home</a
											>
										</li>
										<li class="nav-item">
											<a
												class="nav-link text-blue"
												data-toggle="tab"
												href="#profile"
												role="tab"
												aria-selected="false"
												>Profile</a
											>
										</li>
										<li class="nav-item">
											<a
												class="nav-link text-blue"
												data-toggle="tab"
												href="#contact"
												role="tab"
												aria-selected="false"
												>Contact</a
											>
										</li>
									</ul>
									<div class="tab-content">
										<div
											class="tab-pane fade show active"
											id="home"
											role="tabpanel"
										>
											<div class="pd-20">
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed do eiusmod tempor incididunt ut labore et
												dolore magna aliqua. Ut enim ad minim veniam, quis
												nostrud exercitation ullamco laboris nisi ut aliquip ex
												ea commodo consequat. Duis aute irure dolor in
												reprehenderit in voluptate velit esse cillum dolore eu
												fugiat nulla pariatur. Excepteur sint occaecat cupidatat
												non proident, sunt in culpa qui officia deserunt mollit
												anim id est laborum.
											</div>
										</div>
										<div class="tab-pane fade" id="profile" role="tabpanel">
											<div class="pd-20">
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed do eiusmod tempor incididunt ut labore et
												dolore magna aliqua. Ut enim ad minim veniam, quis
												nostrud exercitation ullamco laboris nisi ut aliquip ex
												ea commodo consequat. Duis aute irure dolor in
												reprehenderit in voluptate velit esse cillum dolore eu
												fugiat nulla pariatur. Excepteur sint occaecat cupidatat
												non proident, sunt in culpa qui officia deserunt mollit
												anim id est laborum.
											</div>
										</div>
										<div class="tab-pane fade" id="contact" role="tabpanel">
											<div class="pd-20">
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed do eiusmod tempor incididunt ut labore et
												dolore magna aliqua. Ut enim ad minim veniam, quis
												nostrud exercitation ullamco laboris nisi ut aliquip ex
												ea commodo consequat. Duis aute irure dolor in
												reprehenderit in voluptate velit esse cillum dolore eu
												fugiat nulla pariatur. Excepteur sint occaecat cupidatat
												non proident, sunt in culpa qui officia deserunt mollit
												anim id est laborum.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 mb-30">
							<div class="pd-20 card-box">
								<h5 class="h4 text-blue mb-20">Customtab Tab</h5>
								<div class="tab">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a
												class="nav-link active"
												data-toggle="tab"
												href="#home2"
												role="tab"
												aria-selected="true"
												>Home</a
											>
										</li>
										<li class="nav-item">
											<a
												class="nav-link"
												data-toggle="tab"
												href="#profile2"
												role="tab"
												aria-selected="false"
												>Profile</a
											>
										</li>
										<li class="nav-item">
											<a
												class="nav-link"
												data-toggle="tab"
												href="#contact2"
												role="tab"
												aria-selected="false"
												>Contact</a
											>
										</li>
									</ul>
									<div class="tab-content">
										<div
											class="tab-pane fade show active"
											id="home2"
											role="tabpanel"
										>
											<div class="pd-20">
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed do eiusmod tempor incididunt ut labore et
												dolore magna aliqua. Ut enim ad minim veniam, quis
												nostrud exercitation ullamco laboris nisi ut aliquip ex
												ea commodo consequat. Duis aute irure dolor in
												reprehenderit in voluptate velit esse cillum dolore eu
												fugiat nulla pariatur. Excepteur sint occaecat cupidatat
												non proident, sunt in culpa qui officia deserunt mollit
												anim id est laborum.
											</div>
										</div>
										<div class="tab-pane fade" id="profile2" role="tabpanel">
											<div class="pd-20">
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed do eiusmod tempor incididunt ut labore et
												dolore magna aliqua. Ut enim ad minim veniam, quis
												nostrud exercitation ullamco laboris nisi ut aliquip ex
												ea commodo consequat. Duis aute irure dolor in
												reprehenderit in voluptate velit esse cillum dolore eu
												fugiat nulla pariatur. Excepteur sint occaecat cupidatat
												non proident, sunt in culpa qui officia deserunt mollit
												anim id est laborum.
											</div>
										</div>
										<div class="tab-pane fade" id="contact2" role="tabpanel">
											<div class="pd-20">
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed do eiusmod tempor incididunt ut labore et
												dolore magna aliqua. Ut enim ad minim veniam, quis
												nostrud exercitation ullamco laboris nisi ut aliquip ex
												ea commodo consequat. Duis aute irure dolor in
												reprehenderit in voluptate velit esse cillum dolore eu
												fugiat nulla pariatur. Excepteur sint occaecat cupidatat
												non proident, sunt in culpa qui officia deserunt mollit
												anim id est laborum.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 mb-30">
							<div class="pd-20 card-box">
								<h5 class="h4 text-blue mb-20">vertical Tab</h5>
								<div class="tab">
									<div class="row clearfix">
										<div class="col-md-3 col-sm-12">
											<ul class="nav flex-column vtabs nav-tabs" role="tablist">
												<li class="nav-item">
													<a
														class="nav-link active"
														data-toggle="tab"
														href="#home3"
														role="tab"
														aria-selected="true"
														>Home</a
													>
												</li>
												<li class="nav-item">
													<a
														class="nav-link"
														data-toggle="tab"
														href="#profile3"
														role="tab"
														aria-selected="false"
														>Profile</a
													>
												</li>
												<li class="nav-item">
													<a
														class="nav-link"
														data-toggle="tab"
														href="#contact3"
														role="tab"
														aria-selected="false"
														>Contact</a
													>
												</li>
											</ul>
										</div>
										<div class="col-md-9 col-sm-12">
											<div class="tab-content">
												<div
													class="tab-pane fade show active"
													id="home3"
													role="tabpanel"
												>
													<div class="pd-20">
														Lorem ipsum dolor sit amet, consectetur adipisicing
														elit, sed do eiusmod tempor incididunt ut labore et
														dolore magna aliqua. Ut enim ad minim veniam, quis
														nostrud exercitation ullamco laboris nisi ut aliquip
														ex ea commodo consequat. Duis aute irure dolor in
														reprehenderit in voluptate velit esse cillum dolore
														eu fugiat nulla pariatur. Excepteur sint occaecat
														cupidatat non proident, sunt in culpa qui officia
														deserunt mollit anim id est laborum.
													</div>
												</div>
												<div
													class="tab-pane fade"
													id="profile3"
													role="tabpanel"
												>
													<div class="pd-20">
														Lorem ipsum dolor sit amet, consectetur adipisicing
														elit, sed do eiusmod tempor incididunt ut labore et
														dolore magna aliqua. Ut enim ad minim veniam, quis
														nostrud exercitation ullamco laboris nisi ut aliquip
														ex ea commodo consequat. Duis aute irure dolor in
														reprehenderit in voluptate velit esse cillum dolore
														eu fugiat nulla pariatur. Excepteur sint occaecat
														cupidatat non proident, sunt in culpa qui officia
														deserunt mollit anim id est laborum.
													</div>
												</div>
												<div
													class="tab-pane fade"
													id="contact3"
													role="tabpanel"
												>
													<div class="pd-20">
														Lorem ipsum dolor sit amet, consectetur adipisicing
														elit, sed do eiusmod tempor incididunt ut labore et
														dolore magna aliqua. Ut enim ad minim veniam, quis
														nostrud exercitation ullamco laboris nisi ut aliquip
														ex ea commodo consequat. Duis aute irure dolor in
														reprehenderit in voluptate velit esse cillum dolore
														eu fugiat nulla pariatur. Excepteur sint occaecat
														cupidatat non proident, sunt in culpa qui officia
														deserunt mollit anim id est laborum.
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 mb-30">
							<div class="pd-20 card-box">
								<h5 class="h4 text-blue mb-20">Custom vertical Tab</h5>
								<div class="tab">
									<div class="row clearfix">
										<div class="col-md-3 col-sm-12">
											<ul
												class="nav flex-column vtabs nav-tabs customtab"
												role="tablist"
											>
												<li class="nav-item">
													<a
														class="nav-link active"
														data-toggle="tab"
														href="#home4"
														role="tab"
														aria-selected="true"
														>Home</a
													>
												</li>
												<li class="nav-item">
													<a
														class="nav-link"
														data-toggle="tab"
														href="#profile4"
														role="tab"
														aria-selected="false"
														>Profile</a
													>
												</li>
												<li class="nav-item">
													<a
														class="nav-link"
														data-toggle="tab"
														href="#contact4"
														role="tab"
														aria-selected="false"
														>Contact</a
													>
												</li>
											</ul>
										</div>
										<div class="col-md-9 col-sm-12">
											<div class="tab-content">
												<div
													class="tab-pane fade show active"
													id="home4"
													role="tabpanel"
												>
													<div class="pd-20">
														Lorem ipsum dolor sit amet, consectetur adipisicing
														elit, sed do eiusmod tempor incididunt ut labore et
														dolore magna aliqua. Ut enim ad minim veniam, quis
														nostrud exercitation ullamco laboris nisi ut aliquip
														ex ea commodo consequat. Duis aute irure dolor in
														reprehenderit in voluptate velit esse cillum dolore
														eu fugiat nulla pariatur. Excepteur sint occaecat
														cupidatat non proident, sunt in culpa qui officia
														deserunt mollit anim id est laborum.
													</div>
												</div>
												<div
													class="tab-pane fade"
													id="profile4"
													role="tabpanel"
												>
													<div class="pd-20">
														Lorem ipsum dolor sit amet, consectetur adipisicing
														elit, sed do eiusmod tempor incididunt ut labore et
														dolore magna aliqua. Ut enim ad minim veniam, quis
														nostrud exercitation ullamco laboris nisi ut aliquip
														ex ea commodo consequat. Duis aute irure dolor in
														reprehenderit in voluptate velit esse cillum dolore
														eu fugiat nulla pariatur. Excepteur sint occaecat
														cupidatat non proident, sunt in culpa qui officia
														deserunt mollit anim id est laborum.
													</div>
												</div>
												<div
													class="tab-pane fade"
													id="contact4"
													role="tabpanel"
												>
													<div class="pd-20">
														Lorem ipsum dolor sit amet, consectetur adipisicing
														elit, sed do eiusmod tempor incididunt ut labore et
														dolore magna aliqua. Ut enim ad minim veniam, quis
														nostrud exercitation ullamco laboris nisi ut aliquip
														ex ea commodo consequat. Duis aute irure dolor in
														reprehenderit in voluptate velit esse cillum dolore
														eu fugiat nulla pariatur. Excepteur sint occaecat
														cupidatat non proident, sunt in culpa qui officia
														deserunt mollit anim id est laborum.
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 mb-30">
							<div class="pd-20 card-box">
								<h5 class="h4 text-blue mb-20">Nav Pills Tabs</h5>
								<div class="tab">
									<ul class="nav nav-pills" role="tablist">
										<li class="nav-item">
											<a
												class="nav-link active text-blue"
												data-toggle="tab"
												href="#home5"
												role="tab"
												aria-selected="true"
												>Home</a
											>
										</li>
										<li class="nav-item">
											<a
												class="nav-link text-blue"
												data-toggle="tab"
												href="#profile5"
												role="tab"
												aria-selected="false"
												>Profile</a
											>
										</li>
										<li class="nav-item">
											<a
												class="nav-link text-blue"
												data-toggle="tab"
												href="#contact5"
												role="tab"
												aria-selected="false"
												>Contact</a
											>
										</li>
									</ul>
									<div class="tab-content">
										<div
											class="tab-pane fade show active"
											id="home5"
											role="tabpanel"
										>
											<div class="pd-20">
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed do eiusmod tempor incididunt ut labore et
												dolore magna aliqua. Ut enim ad minim veniam, quis
												nostrud exercitation ullamco laboris nisi ut aliquip ex
												ea commodo consequat. Duis aute irure dolor in
												reprehenderit in voluptate velit esse cillum dolore eu
												fugiat nulla pariatur. Excepteur sint occaecat cupidatat
												non proident, sunt in culpa qui officia deserunt mollit
												anim id est laborum.
											</div>
										</div>
										<div class="tab-pane fade" id="profile5" role="tabpanel">
											<div class="pd-20">
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed do eiusmod tempor incididunt ut labore et
												dolore magna aliqua. Ut enim ad minim veniam, quis
												nostrud exercitation ullamco laboris nisi ut aliquip ex
												ea commodo consequat. Duis aute irure dolor in
												reprehenderit in voluptate velit esse cillum dolore eu
												fugiat nulla pariatur. Excepteur sint occaecat cupidatat
												non proident, sunt in culpa qui officia deserunt mollit
												anim id est laborum.
											</div>
										</div>
										<div class="tab-pane fade" id="contact5" role="tabpanel">
											<div class="pd-20">
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed do eiusmod tempor incididunt ut labore et
												dolore magna aliqua. Ut enim ad minim veniam, quis
												nostrud exercitation ullamco laboris nisi ut aliquip ex
												ea commodo consequat. Duis aute irure dolor in
												reprehenderit in voluptate velit esse cillum dolore eu
												fugiat nulla pariatur. Excepteur sint occaecat cupidatat
												non proident, sunt in culpa qui officia deserunt mollit
												anim id est laborum.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-6 col-md-12 col-sm-12 mb-30">
							<div class="pd-20 card-box">
								<h5 class="h4 text-blue mb-20">Nav Pills Tabs Right</h5>
								<div class="tab">
									<ul class="nav nav-pills justify-content-end" role="tablist">
										<li class="nav-item">
											<a
												class="nav-link active text-blue"
												data-toggle="tab"
												href="#home6"
												role="tab"
												aria-selected="true"
												>Home</a
											>
										</li>
										<li class="nav-item">
											<a
												class="nav-link text-blue"
												data-toggle="tab"
												href="#profile6"
												role="tab"
												aria-selected="false"
												>Profile</a
											>
										</li>
										<li class="nav-item">
											<a
												class="nav-link text-blue"
												data-toggle="tab"
												href="#contact6"
												role="tab"
												aria-selected="false"
												>Contact</a
											>
										</li>
									</ul>
									<div class="tab-content">
										<div
											class="tab-pane fade show active"
											id="home6"
											role="tabpanel"
										>
											<div class="pd-20">
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed do eiusmod tempor incididunt ut labore et
												dolore magna aliqua. Ut enim ad minim veniam, quis
												nostrud exercitation ullamco laboris nisi ut aliquip ex
												ea commodo consequat. Duis aute irure dolor in
												reprehenderit in voluptate velit esse cillum dolore eu
												fugiat nulla pariatur. Excepteur sint occaecat cupidatat
												non proident, sunt in culpa qui officia deserunt mollit
												anim id est laborum.
											</div>
										</div>
										<div class="tab-pane fade" id="profile6" role="tabpanel">
											<div class="pd-20">
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed do eiusmod tempor incididunt ut labore et
												dolore magna aliqua. Ut enim ad minim veniam, quis
												nostrud exercitation ullamco laboris nisi ut aliquip ex
												ea commodo consequat. Duis aute irure dolor in
												reprehenderit in voluptate velit esse cillum dolore eu
												fugiat nulla pariatur. Excepteur sint occaecat cupidatat
												non proident, sunt in culpa qui officia deserunt mollit
												anim id est laborum.
											</div>
										</div>
										<div class="tab-pane fade" id="contact6" role="tabpanel">
											<div class="pd-20">
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed do eiusmod tempor incididunt ut labore et
												dolore magna aliqua. Ut enim ad minim veniam, quis
												nostrud exercitation ullamco laboris nisi ut aliquip ex
												ea commodo consequat. Duis aute irure dolor in
												reprehenderit in voluptate velit esse cillum dolore eu
												fugiat nulla pariatur. Excepteur sint occaecat cupidatat
												non proident, sunt in culpa qui officia deserunt mollit
												anim id est laborum.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 mb-30">
							<div class="pd-20 card-box">
								<h5 class="h4 text-blue mb-20">Icons vertical Nav Pills Tab</h5>
								<div class="tab">
									<div class="row clearfix">
										<div class="col-md-3 col-sm-12">
											<ul
												class="nav flex-column nav-pills vtabs"
												role="tablist"
											>
												<li class="nav-item">
													<a
														class="nav-link active"
														data-toggle="tab"
														href="#home7"
														role="tab"
														aria-selected="true"
														><i class="fa fa-home"></i
													></a>
												</li>
												<li class="nav-item">
													<a
														class="nav-link"
														data-toggle="tab"
														href="#profile7"
														role="tab"
														aria-selected="false"
														><i class="fa fa-users"></i
													></a>
												</li>
												<li class="nav-item">
													<a
														class="nav-link"
														data-toggle="tab"
														href="#contact7"
														role="tab"
														aria-selected="false"
														><i class="fa fa-envelope-o"></i
													></a>
												</li>
											</ul>
										</div>
										<div class="col-md-9 col-sm-12">
											<div class="tab-content">
												<div
													class="tab-pane fade show active"
													id="home7"
													role="tabpanel"
												>
													<div class="pd-20">
														Lorem ipsum dolor sit amet, consectetur adipisicing
														elit, sed do eiusmod tempor incididunt ut labore et
														dolore magna aliqua. Ut enim ad minim veniam, quis
														nostrud exercitation ullamco laboris nisi ut aliquip
														ex ea commodo consequat. Duis aute irure dolor in
														reprehenderit in voluptate velit esse cillum dolore
														eu fugiat nulla pariatur. Excepteur sint occaecat
														cupidatat non proident, sunt in culpa qui officia
														deserunt mollit anim id est laborum.
													</div>
												</div>
												<div
													class="tab-pane fade"
													id="profile7"
													role="tabpanel"
												>
													<div class="pd-20">
														Lorem ipsum dolor sit amet, consectetur adipisicing
														elit, sed do eiusmod tempor incididunt ut labore et
														dolore magna aliqua. Ut enim ad minim veniam, quis
														nostrud exercitation ullamco laboris nisi ut aliquip
														ex ea commodo consequat. Duis aute irure dolor in
														reprehenderit in voluptate velit esse cillum dolore
														eu fugiat nulla pariatur. Excepteur sint occaecat
														cupidatat non proident, sunt in culpa qui officia
														deserunt mollit anim id est laborum.
													</div>
												</div>
												<div
													class="tab-pane fade"
													id="contact7"
													role="tabpanel"
												>
													<div class="pd-20">
														Lorem ipsum dolor sit amet, consectetur adipisicing
														elit, sed do eiusmod tempor incididunt ut labore et
														dolore magna aliqua. Ut enim ad minim veniam, quis
														nostrud exercitation ullamco laboris nisi ut aliquip
														ex ea commodo consequat. Duis aute irure dolor in
														reprehenderit in voluptate velit esse cillum dolore
														eu fugiat nulla pariatur. Excepteur sint occaecat
														cupidatat non proident, sunt in culpa qui officia
														deserunt mollit anim id est laborum.
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 mb-30">
							<div class="pd-20 card-box">
								<h5 class="h4 text-blue mb-20">Icons vertical Tab</h5>
								<div class="tab">
									<div class="row clearfix">
										<div class="col-md-3 col-sm-12">
											<ul class="nav flex-column nav-tabs vtabs" role="tablist">
												<li class="nav-item">
													<a
														class="nav-link active"
														data-toggle="tab"
														href="#home8"
														role="tab"
														aria-selected="true"
														><i class="fa fa-home"></i
													></a>
												</li>
												<li class="nav-item">
													<a
														class="nav-link"
														data-toggle="tab"
														href="#profile8"
														role="tab"
														aria-selected="false"
														><i class="fa fa-users"></i
													></a>
												</li>
												<li class="nav-item">
													<a
														class="nav-link"
														data-toggle="tab"
														href="#contact8"
														role="tab"
														aria-selected="false"
														><i class="fa fa-envelope-o"></i
													></a>
												</li>
											</ul>
										</div>
										<div class="col-md-9 col-sm-12">
											<div class="tab-content">
												<div
													class="tab-pane fade show active"
													id="home8"
													role="tabpanel"
												>
													<div class="pd-20">
														Lorem ipsum dolor sit amet, consectetur adipisicing
														elit, sed do eiusmod tempor incididunt ut labore et
														dolore magna aliqua. Ut enim ad minim veniam, quis
														nostrud exercitation ullamco laboris nisi ut aliquip
														ex ea commodo consequat. Duis aute irure dolor in
														reprehenderit in voluptate velit esse cillum dolore
														eu fugiat nulla pariatur. Excepteur sint occaecat
														cupidatat non proident, sunt in culpa qui officia
														deserunt mollit anim id est laborum.
													</div>
												</div>
												<div
													class="tab-pane fade"
													id="profile8"
													role="tabpanel"
												>
													<div class="pd-20">
														Lorem ipsum dolor sit amet, consectetur adipisicing
														elit, sed do eiusmod tempor incididunt ut labore et
														dolore magna aliqua. Ut enim ad minim veniam, quis
														nostrud exercitation ullamco laboris nisi ut aliquip
														ex ea commodo consequat. Duis aute irure dolor in
														reprehenderit in voluptate velit esse cillum dolore
														eu fugiat nulla pariatur. Excepteur sint occaecat
														cupidatat non proident, sunt in culpa qui officia
														deserunt mollit anim id est laborum.
													</div>
												</div>
												<div
													class="tab-pane fade"
													id="contact8"
													role="tabpanel"
												>
													<div class="pd-20">
														Lorem ipsum dolor sit amet, consectetur adipisicing
														elit, sed do eiusmod tempor incididunt ut labore et
														dolore magna aliqua. Ut enim ad minim veniam, quis
														nostrud exercitation ullamco laboris nisi ut aliquip
														ex ea commodo consequat. Duis aute irure dolor in
														reprehenderit in voluptate velit esse cillum dolore
														eu fugiat nulla pariatur. Excepteur sint occaecat
														cupidatat non proident, sunt in culpa qui officia
														deserunt mollit anim id est laborum.
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
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
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
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
