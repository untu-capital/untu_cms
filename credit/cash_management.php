<?php
include('../session/session.php');
include('charts_data.php');
$nav_header = "Cash Management Dashboard";

include('../includes/controllers.php');
$state = $_GET['state'];
$userId = $_SESSION['userId'];
$branch = $_SESSION['branch'];
//
?>

<?php
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/branches/getAllBranches");
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//$server_response = curl_exec($ch);
//
//curl_close($ch);
//$data = json_decode($server_response, true);
//// Check if the JSON decoding was successful
//if ($data !== null) {
//    $branches = $data;
//
//} else {
//    echo "Error decoding JSON data";
//}
//?>

<!DOCTYPE html>
<html lang="">
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

        <?php if ($_GET['menu'] == 'main') { ?>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="pd-20 card-box">
                    <h5 class="h4 text-blue mb-20">CMS Dashboard</h5>
                    <div class="tab">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#acc_balance" role="tab"
                                   aria-selected="true">Account Balances</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pending" role="tab"
                                   aria-selected="false">Pending Transactions Vouchers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#revise" role="tab"
                                   aria-selected="false">Revise Transactions Vouchers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#declined" role="tab"
                                   aria-selected="false">Declined Transactions Vouchers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#approved" role="tab"
                                   aria-selected="false">Approved Transactions Vouchers</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="acc_balance" role="tabpanel">
                                <div class="pd-20">
                                    <?php include('../includes/dashboard/cms_acc_balance_widget.php'); ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pending" role="tabpanel">
                                <?php $titleStatus="Pending"; $approvalStatus = "PENDING";
                                include('../includes/tables/cash_management/board_transaction_vouchers.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="approved" role="tabpanel">
                                <?php $titleStatus="Approved"; $approvalStatus = "APPROVED";
                                include('../includes/tables/cash_management/board_transaction_vouchers.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="revise" role="tabpanel">
                                <?php $titleStatus="Revise"; $approvalStatus = "REVISE";
                                include('../includes/tables/cash_management/board_transaction_vouchers.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="declined" role="tabpanel">
                                <?php $titleStatus="Declined"; $approvalStatus = "DECLINED";
                                include('../includes/tables/cash_management/board_transaction_vouchers.php'); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        <?php }
        elseif ($_GET['menu'] == "acc_bal") {?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('success')) {
                        // Display a popup or alert message
                        alert('Deleted successfully');
                    }
                });
            </script>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="pd-20 card-box">
                    <h5 class="h4 text-blue mb-20">Cash Management</h5>
                    <div class="tab">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#acc_balance" role="tab" aria-selected="true">Account Balances</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="acc_balance" role="tabpanel">
                                <div class="pd-20">
                                    <?php include('../includes/dashboard/cms_acc_balance_widget.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>

        <?php include('../includes/footer.php'); ?>
    </div>
</div>


<!-- js -->
<script src="../vendors/scripts/core.js"></script>
<script src="../vendors/scripts/script.min.js"></script>
<script src="../vendors/scripts/process.js"></script>
<script src="../vendors/scripts/layout-settings.js"></script>
<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>

<!-- js -->
<script src="../src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
<script src="../src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
<script src="../vendors/scripts/highchart-setting.js"></script>

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
>
    <iframe
            src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
            height="0"
            width="0"
            style="display: none; visibility: hidden"
    ></iframe
    >
</noscript>
<!-- End Google Tag Manager (noscript) -->

</body>
</html>
