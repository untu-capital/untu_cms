<?php
    include('../session/session.php');
include ('check_role.php');
    include "../includes/controllers.php";
    $market_campaign_by_id = market_campaign_by_id($_GET['id']);

    $errors = array();
    // Escape user inputs for security
    if(isset($_POST['Submit'])){
        $id=$_POST['id'];

        $url = "http://localhost:7878/api/utg/market_campaigns/campaignStatus/".$id;
        $data_array = array(
            'campaignStatus' => "closed",
        );
        $market_campaign_by_id = json_encode($data_array);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $market_campaign_by_id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        $resp = curl_exec($ch);

        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headerStr = substr($resp, 0, $headerSize);
        $bodyStr = substr($resp, $headerSize);

        // Check HTTP status code
        if (!curl_errno($ch)) {
            // $_SESSION['info'] = "";
            // $_SESSION['error'] = "";
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:  # OK redirect to dashboard

                    ?>
                    <script>
                        $(function() {
                            $("#myModal").modal();//if you want you can have a timeout to hide the window after x seconds
                        });
                    </script>
                    <?php
                    $_SESSION['info'] = "Success";
                    // header('location: ongoing_clients.php');
                    break;
                case 400:  # Bad Request
                    $decoded = json_decode($bodyStr);
                    foreach($decoded as $key => $val) {
                        //echo $key . ': ' . $val . '<br>';
                    }
                    // echo $val;
                    $_SESSION['error'] = "Failed. Please try again, ".$val;
                    header('location: open_campaigns.php');
                    break;

                case 401: # Unauthorixed - Bad credientials
                    $_SESSION['error'] = 'Application failed.. Please try again!';
                    header('location: open_campaigns.php');

                    break;
                // default:
                // $_SESSION['error'] = 'Not able to send application'. "\n";
                // header('location: loan_officer.php');
            }
        } else {
            $_SESSION['error'] = 'Status Update failed.. Please try again!'. "\n";
            header('location: view_campaigns.php');
        }
        curl_close($ch);

    }
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
                        <h4 class="text-blue h4">Campaign and Marketing</h4>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-12 col-md-2 mb-30">

                        </div>
                        <div class="col-sm-12 col-md-8 mb-30">
                            <div class="card card-box text-left">
                                <div class="card-body">
                                    <h5 class="card-title">Campaign Details</h5>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Campaign Name :</label>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $market_campaign_by_id["campaignName"] ?> </p>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City :</label>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $market_campaign_by_id["city"] ?> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Zone :</label>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $market_campaign_by_id["zoneArea"] ?> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Sector :</label>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $market_campaign_by_id["sector"] ?> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Subsector :</label>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $market_campaign_by_id["subSector"] ?> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Value Chain :</label>

                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $market_campaign_by_id["valueChain"] ?> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Resources Needed :</label>

                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $market_campaign_by_id["resourceNeed"] ?> </p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Start Date :</label>

                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $market_campaign_by_id["startDate"] ?> </p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>End Date :</label>

                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $market_campaign_by_id["endDate"] ?> </p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Loan Officer :</label>

                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <p><?= $market_campaign_by_id["allocatedLoanOfficer"] ?> </p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <a href="campaign_and_marketing.php?menu=main" class="btn btn-primary">Back</a>
                                            </div>
                                        </div>
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $id ?>" />

                                                        <button type="submit" class="btn btn-primary" value="Submit" name="Submit">Close Campaign</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="col-md-3">
                                            <div class="form-group">

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2 mb-30">

                        </div>
                    </div>


                <!-- success Popup html Start -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center font-18">
                                    <h3 class="mb-20">Campaign Succesfully Closed</h3>
                                    <div class="mb-30 text-center">
                                        <img src="../vendors/images/success.png" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group mb-0">
                                            <a class="btn btn-danger btn-lg btn-block" href="loan_officer.php">Ok</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- success Popup html End -->
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
