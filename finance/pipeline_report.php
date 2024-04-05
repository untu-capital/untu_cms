<?php
include('../session/session.php');
include ('check_role.php');
include('charts_data.php');

$nav_header = "Dashboard";
$bp_title = "Branch Loan Book Movement";
$lop_title = "Loan Officer Productivity";

include('../includes/controllers.php');

?>

<?php
$myDate = date("Y-m-d H:i:s", strtotime("23-05-2023 11:07:19 am"));

if(isset($_POST['Submit'])){
    $StartDate = $_POST['Start_Date'];
    $EndDate = $_POST['End_Date'];

    echo "The Start Date is :".$StartDate;
    echo "The End Date is :".$EndDate;
    $StartDatedateString = $StartDate;
    $StartDatetimestamp = strtotime($StartDatedateString);
    echo "The UNIX Start Date is :".$StartDatetimestamp;
    $EndDatedateString = $EndDate;
    $EndDatetimestamp = strtotime($EndDatedateString);
    echo "The UNIX End Date is :".$EndDatetimestamp;

    pipeline_report();
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

        <!--				--><?php //include('../includes/forms/pipeline_report_date_range.php'); ?>

        <?php include('../includes/dashboard/branches_productivity_widget.php'); ?>

        <?php include('../includes/tables/pipeline_summary_table.php'); ?>

        <?php //include('../includes/dashboard/lo_productivity_bar_graph.php'); ?>

        <?php include('../includes/tables/lo_productivity_table.php'); ?>

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
    var branch = <?php echo json_encode($branches); ?>
    var color = <?php echo json_encode($colors); ?>
    var data = <?php echo json_encode($dataJson); ?>
</script>
<script src="../src/plugins/jQuery-Knob-master/jquery.knob.min.js"></script>
<script src="../src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
<script src="../src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>

<script src="../src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="../src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
<script src="../vendors/scripts/highchart-setting.js"></script>

<script src="../src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="../src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../vendors/scripts/dashboard2.js"></script>
<script src="../vendors/scripts/dashboard3.js"></script>

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
