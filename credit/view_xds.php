<?php
//    include('../session/session.php');
//    include ('check_role.php');
    include "../controllers/credit_analytics.php";
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

    <!-- sidebar-left -->
    <?php include('../includes/sidebar.php'); ?>
    <!-- /sidebar-left -->

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20">
            <?php include('../includes/tables/credit_analytics/xds_report.php') ?>
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
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>
</html>
