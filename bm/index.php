<?php
include('../session/session.php');
include ('check_role.php');
//  include('charts_data.php');
$nav_header = "Dashboard";
include('../includes/controllers.php');
$fromGraphDate = date('Y-m-d');
$fromDate = date('Y-m-d');
$toDate = date('Y-m-d');
if (isset($_POST['pick_range'])) {
    // Check if the form is submitted
    if (isset($_POST['date_range']) && !empty($_POST['date_range'])) {
        // Get the selected date range from the form
        list($fromDate, $toDate) = explode(' - ', $_POST['date_range']);
        // Convert the dates to the desired format
        $fromDate = date('Y-m-d', strtotime($fromDate));
        $toDate = date('Y-m-d', strtotime($toDate));
    }
}
$disbursement_data = disbursed_by_range($_SESSION['branch'].'/'.$fromGraphDate.'/'.$toDate);
$target_data = [1100000, 1200000, 1400000, 1100000, 1350000, 1200000, 1300000, 1100000, 1500000, 1200000, 1800000, 2000000];
$disbursement_rate = round((array_sum($disbursement_data)/array_sum(array_slice($target_data, 0, count($disbursement_data))))*100, 0);
?>
<!DOCTYPE html>
<html>
<!-- HTML HEAD -->
<?php
include('../includes/header.php');
?>
<!-- /HTML HEAD -->
<body>
<!-- <div class="pre-loader">
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
</div> -->
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
        <?php include('../includes/dashboard/topbar_widget.php');?>
        <?php include('../includes/dashboard/welcome_widget.php'); ?>
        <!--             --><?php //include('../includes/dashboard/small_simple_summary_widget.php'); ?>
        <div class="row">
            <?php include('../includes/dashboard/monthly_chart_histo_graph_widget.php'); ?>
            <?php include('../includes/dashboard/disburse_target_widget.php'); ?>
        </div>
        <?php include('../includes/tables/disbursements_table_widget.php'); ?>
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
<script>
    var disbursementData = <?php echo json_encode($disbursement_data); ?>;
    var targetData = <?php echo json_encode($target_data); ?>;
    var disbursementRate = <?php echo json_encode($disbursement_rate); ?>;
</script>
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