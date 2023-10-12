<?php
    include('../session/session.php');
include ('check_role.php');
    include "../includes/controllers.php";

    $ch = curl_init();
    $id = $_GET["id"];
//    $userId = $_GET['userid'];
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/marketLeads/$id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($server_response, true);

    $ch = curl_init();
    $clientId=$data["id"] ;
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/followUpDiary/byClientId/$clientId");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response1 = curl_exec($ch);
    curl_close($ch);
    $data1 = json_decode($server_response1, true);

?>

<!--<head>-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<!--</head>-->

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
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">


                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <h4 class="text-blue h4">Lead Management</h4>

                    </div>
                    <div class="row clearfix">

                        <div class="col-sm-12 col-md-12 mb-30">
                            <div class="card card-box text-left">
                                <div class="card-body">
                                    <h5 class="card-title">Lead Details</h5>
                                    <table class="table table-striped hover nowrap">
                                        <thead>
                                        <tr>
                                            <th class="table-plus datatable-nosort">Lead Name</th>
                                            <th>Contact Number</th>
                                            <th>Email Address</th>
                                            <th>Nature of Business</th>
                                            <th>Business Location (Address)</th>
                                            <th>Potential Loan Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><?= $data["clientName"] ?></td>
                                            <td><?= $data["contactNumber"] ?></td>
                                            <td><?= $data["contactEmail"] ?></td>
                                            <td><?= $data["natureOfBusiness"] ?></td>
                                            <td><?= $data["businessAddress"] ?></td>
                                            <td><?= '$ ' . number_format($data["potentialLoanAmount"], 2, '.', ',') ?></td>
                                        </tr>

                                        </tbody>
                                    </table>

                                    <hr>
                                    <br><br>
                                    <h5 class="card-title">Interaction Comments (Follow-Up)</h5>
                                    <table class="table table-striped hover nowrap">
                                        <thead>
                                        <tr>
                                            <th class="table-plus datatable-nosort">Date Captured</th>
                                            <th>Interaction Comments</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($data1 as $application):
                                            $date = htmlspecialchars ($application["createdAt"]);
                                            $createDate = new DateTime($date); ?>
                                        <tr>
                                            <td><?= $createDate->format('d-M-Y') ?></td>
                                            <td><?= htmlspecialchars ($application["followUpComments"]) ?></td>
                                            <td><?= $data["followUpStatus"] ?></td>
                                        </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>

                                    <hr>
                                    <div class="form-group">
                                        <label>Loan Officer : <?php
                                            $loan_officer = user($data["loanOfficer"]);
                                            echo $loan_officer['firstName']." ".$loan_officer['lastName'] ?></label>
                                    </div>

                                    <a href="lead_management.php?menu=main" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2 mb-30">

                        </div>
                    </div>

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
</body>
</html>
