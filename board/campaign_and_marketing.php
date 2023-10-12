<?php
	include('../session/session.php');
include ('check_role.php');
	include('../includes/controllers.php');
	$nav_header = "Marketing & Campaigns";

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

                <?php if ($_GET['menu'] == "main"){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                    <div class="pd-20 card-box">
                        <h5 class="h4 text-blue mb-20">Campaign & Marketing</h5>
                        <div class="tab">
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-blue" data-toggle="tab" href="#campaigns" role="tab" aria-selected="true" >
                                        Manage Campaigns
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#zones" role="tab" aria-selected="false">
                                        Manage Zones
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#cities" role="tab" aria-selected="false" >
                                        Manage Cities
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#sectors" role="tab" aria-selected="false" >
                                        Manage Sectors
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#targets" role="tab" aria-selected="false" >
                                        Manage Targets
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="campaigns" role="tabpanel">
                                    <?php include('../includes/tables/markerting_campaigns_table.php'); ?>
                                </div>
                                <div class="tab-pane fade" id="zones" role="tabpanel">
                                    <?php include('../includes/tables/lead_zones_table.php'); ?>
                                </div>
                                <div class="tab-pane fade" id="cities" role="tabpanel">
                                    <?php include('../includes/tables/lead_cities_table.php'); ?>
                                </div>
                                <div class="tab-pane fade" id="sectors" role="tabpanel">
                                    <?php include('../includes/tables/business_sector_table.php'); ?>
                                </div>
								<div class="tab-pane fade" id="targets" role="tabpanel">
                                    <?php include('../includes/tables/branch_target_table.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } elseif ($_GET['menu'] == "add_campaign") {?>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                        <div class="pd-20 card-box">
                            <?php include('../includes/forms/create_campaign.php'); ?>
                        </div>
                    </div>
                <?php } 

				elseif ($_GET['menu'] == "add_target") {?>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                        <div class="pd-20 card-box">
                            <?php include('../includes/forms/create_target.php'); ?>
                        </div>
                    </div>
                <?php } 
				elseif ($_GET['menu'] == "add_cities") {?>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                        <div class="pd-20 card-box">
                            <?php include('../includes/forms/create_cities.php'); ?>
                        </div>
                    </div>
                <?php } 
                		elseif ($_GET['menu'] == "add_zones") {?>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                                <div class="pd-20 card-box">
                                    <?php include('../includes/forms/create_zones.php'); ?>
                                </div>
                            </div>
                        <?php } 
                        elseif ($_GET['menu'] == "add_sectors") {?>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                                <div class="pd-20 card-box">
                                    <?php include('../includes/forms/create_sectors.php'); ?>
                                </div>
                            </div>
                        <?php }
                        
				
				?>

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
