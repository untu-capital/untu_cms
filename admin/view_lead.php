<?php
    include('../session/session.php');
include ('check_role.php');
    include "../includes/controllers.php";

    $ch = curl_init();
    $id = $_GET["id"];
    $userId = $_GET['userid'];
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

    <!-- sidebar-left -->
    <?php include('../includes/sidebar.php'); ?>
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
                        <div class="col-sm-12 col-md-2 mb-30">

                        </div>
                        <div class="col-sm-12 col-md-8 mb-30">
                            <div class="card card-box text-left">
                                <div class="card-body">
                                    <h5 class="card-title">Lead Details</h5>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Client Name :</label>

                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $data["clientName"] ?> </p>

                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Contact Number :</label>

                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $data["contactNumber"] ?> </p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Contact Email :</label>

                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $data["contactEmail"] ?> </p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nature Of Business :</label>

                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $data["natureOfBusiness"] ?> </p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Business Address :</label>

                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $data["businessAddress"] ?> </p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Potential Loan Amount :</label>

                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $data["potentialLoanAmount"] ?> </p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Follow Up Status :</label>

                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $data["followUpStatus"] ?> </p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Follow Up Comments :</label>

                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <table>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Coment</th>

                                                    </tr>
                                                    <?php
                                                    foreach($data1 as $application):
                                                        $date = htmlspecialchars ($application["createdAt"]);
                                                        $createDate = new DateTime($date);



                                                        ?>
                                                        <tr>
                                                            <td><?= $createDate->format('d-M-Y') ?></td>
                                                            <td><?= htmlspecialchars ($application["followUpComments"]) ?></td>

                                                        </tr>
                                                    <?php

                                                    endforeach;?>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Loan Officer :</label>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p><?= $data["loanOfficerName"] ?> </p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <hr>

                                    <a href="" class="btn btn-primary">Back</a>
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
<script src="../src/plugins/jquery-steps/jquery.steps.js"></script>
<script src="../vendors/scripts/steps-setting.js"></script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>
</html>
