<?php
include('../session/session.php');
include ('check_role.php');
include('charts_data.php');

$nav_header = "Dashboard";
$bp_title = "Branch Loan Book Movement";
$lop_title = "Loan Officer Productivity";

include('../includes/controllers.php');

?>

<!DOCTYPE html>
<html>
<!-- HTML HEAD -->
<?php
include('../includes/header.php');
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

    // Set the URL of the REST API endpoint
    $url = "http://localhost:7878/api/utg/credit_application_pipeline/loans";

    // Create cURL resource
    $ch = curl_init($url);

    // Set the HTTP method to GET
    curl_setopt($ch, CURLOPT_HTTPGET, true);

    // Set response type as JSON and return as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        echo "Error: " . curl_error($ch);
    } else {
        // Access the properties of the LoansPipeline model
        $data = json_decode($response);

        // Check if the decoding was successful
        if ($data === null) {
            echo "Error decoding JSON response";
        } else {

            $total = 0; // Variable to store the total sought loan

            $PendingTotal = 0;
            $AssessmentTotal=0;
            $PropectTotal = 0;

            $HarareRepeatGlobVar =0;
            $HarareARepeatGlobVar =0;
            $BulawayoRepeatGlobVar =0;
            $GweruRepeatGlobVar =0;
            $GokweRepeatGlobVar =0;


            $HarareNewGlobVar=0;
            $HarareANewGlobVar=0;
            $BulawayoNewGlobVar=0;
            $GweruNewGlobVar=0;
            $GokweNewGlobVar=0;


            $HarareBranchTotal = 0;
            $HarareABranchTotal = 0;
            $GweruBranchTotal = 0;
            $BulawayoBranchTotal = 0;
            $GokweBranchTotal = 0;

            $HarareBranchAssessment= 0;
            $HarareABranchAssessment = 0;
            $GweruBranchAssessment = 0;
            $BulawayoBranchAssessment = 0;
            $GokweBranchAssessment = 0;

            $HarareBranchProspect = 0;
            $HarareABranchProspect  = 0;
            $GweruBranchProspect  = 0;
            $BulawayoBranchProspect  = 0;
            $GokweBranchProspect  = 0;

            $HarareBranchPending = 0;
            $HarareABranchPending  = 0;
            $GweruBranchPending  = 0;
            $BulawayoBranchPending  = 0;
            $GokweBranchPending  = 0;


            $HarareBranchDisbursed = 0;
            $HarareBranchADisbursed  = 0;
            $GweruBranchDisbursed  = 0;
            $BulawayoBranchDisbursed  = 0;
            $GokweBranchDisbursed  = 0;

            foreach ($data as $datas) {
                $intId = $datas->intId;
                $userId = $datas->userId;
                $branchName = $datas->branchName;
                $dateRecorded = $datas->dateRecorded;
                $applicant = $datas->applicant;
                $sector = $datas->sector;
                $repeatClient = $datas->repeatClient;
                $soughtLoan = $datas->soughtLoan;
                $loanStatus = $datas->loanStatus;
                $loanOfficer = $datas->loanOfficer;

                $myDate = $dateRecorded;

                $dateString = $dateRecorded;
                $dateTime = DateTime::createFromFormat('d-m-Y h:i:s a', $dateString);
                $timestamp = $dateTime->getTimestamp();

                if ($timestamp>=$StartDatetimestamp && $timestamp<=$EndDatetimestamp){

                    if ($branchName == "Harare"){
                        $HarareBranchTotal += intval($soughtLoan);

                        if($repeatClient == "Repeat"){
                            $HarareRepeatGlobVar = $HarareRepeatGlobVar+1;
                            if($loanStatus=="Prospect"){
                                $HarareBranchProspect += intval($soughtLoan);
                            }elseif($loanStatus=="Pending Disbursement"){
                                $HarareBranchPending  += intval($soughtLoan);
                            }elseif($loanStatus=="Assessment"){
                                $HarareBranchAssessment += intval($soughtLoan);
                            }elseif($loanStatus=="Disbursed"){
                                $HarareBranchDisbursed += intval($soughtLoan);
                            }
                        } elseif($repeatClient == "New"){
                            $HarareNewGlobVar = $HarareNewGlobVar+1;
                            if($loanStatus=="Prospect"){

                                $HarareBranchProspect += intval($soughtLoan);

                            }elseif($loanStatus=="Pending Disbursement"){
                                $HarareBranchPending  += intval($soughtLoan);
                            }elseif($loanStatus=="Assessment"){
                                $HarareBranchAssessment += intval($soughtLoan);
                            }elseif($loanStatus=="Disbursed"){
                                $HarareBranchDisbursed += intval($soughtLoan);
                            }
                        }


                    }elseif($branchName == "Harare A"){
                        $HarareABranchTotal += intval($soughtLoan);

                        if($repeatClient == "Repeat"){
                            $HarareARepeatGlobVar = $HarareARepeatGlobVar+1;
                            if($loanStatus=="Prospect"){

                                $HarareABranchProspect += intval($soughtLoan);

                            }elseif($loanStatus=="Pending Disbursement"){
                                $HarareABranchPending  += intval($soughtLoan);
                            }elseif($loanStatus=="Assessment"){
                                $HarareABranchAssessment += intval($soughtLoan);
                            }elseif($loanStatus=="Disbursed"){
                                $HarareBranchADisbursed += intval($soughtLoan);
                            }

                        }elseif($repeatClient == "New"){
                            $HarareANewGlobVar = $HarareANewGlobVar+1;
                            if($loanStatus=="Prospect"){

                                $HarareABranchProspect += intval($soughtLoan);

                            }elseif($loanStatus=="Pending Disbursement"){
                                $HarareABranchPending  += intval($soughtLoan);
                            }elseif($loanStatus=="Assessment"){
                                $HarareABranchAssessment += intval($soughtLoan);
                            }elseif($loanStatus=="Disbursed"){
                                $HarareBranchADisbursed += intval($soughtLoan);
                            }


                        }

                    }elseif($branchName == "Gweru"){
                        $GweruBranchTotal += intval($soughtLoan);

                        if($repeatClient == "Repeat"){
                            $GweruRepeatGlobVar = $GweruRepeatGlobVar+1;
                            if($loanStatus=="Prospect"){

                                $GweruBranchProspect += intval($soughtLoan);

                            }elseif($loanStatus=="Pending Disbursement"){
                                $GweruBranchPending  += intval($soughtLoan);
                            }elseif($loanStatus=="Assessment"){
                                $GweruBranchAssessment += intval($soughtLoan);
                            }elseif($loanStatus=="Disbursed"){
                                $GweruBranchDisbursed += intval($soughtLoan);
                            }

                        }elseif($repeatClient == "New"){
                            $GweruNewGlobVar = $GweruNewGlobVar+1;
                            if($loanStatus=="Prospect"){

                                $GweruBranchProspect += intval($soughtLoan);

                            }elseif($loanStatus=="Pending Disbursement"){
                                $GweruBranchPending  += intval($soughtLoan);
                            }elseif($loanStatus=="Assessment"){
                                $GweruBranchAssessment += intval($soughtLoan);
                            }elseif($loanStatus=="Disbursed"){
                                $GweruBranchDisbursed += intval($soughtLoan);
                            }


                        }

                    }elseif($branchName == "Bulawayo"){
                        $BulawayoBranchTotal += intval($soughtLoan);

                        if($repeatClient == "Repeat"){
                            $BulawayoRepeatGlobVar = $BulawayoRepeatGlobVar+1;
                            if($loanStatus=="Prospect"){

                                $BulawayoBranchProspect += intval($soughtLoan);

                            }elseif($loanStatus=="Pending Disbursement"){
                                $BulawayoBranchPending  += intval($soughtLoan);
                            }elseif($loanStatus=="Assessment"){
                                $BulawayoBranchAssessment += intval($soughtLoan);
                            }elseif($loanStatus=="Disbursed"){
                                $BulawayoBranchDisbursed += intval($soughtLoan);
                            }

                        }elseif($repeatClient == "New"){
                            $BulawayoNewGlobVar = $BulawayoNewGlobVar+1;
                            if($loanStatus=="Prospect"){

                                $BulawayoBranchProspect += intval($soughtLoan);

                            }elseif($loanStatus=="Pending Disbursement"){
                                $BulawayoBranchPending  += intval($soughtLoan);
                            }elseif($loanStatus=="Assessment"){
                                $BulawayoBranchAssessment += intval($soughtLoan);
                            }
                            elseif($loanStatus=="Disbursed"){
                                $BulawayoBranchDisbursed += intval($soughtLoan);
                            }


                        }

                    } elseif($branchName == "Gokwe"){
                        $GokweBranchTotal += intval($soughtLoan);

                        if($repeatClient == "Repeat"){
                            $GokweRepeatGlobVar = $GokweRepeatGlobVar+1;
                            if($loanStatus=="Prospect"){

                                $GokweBranchProspect += intval($soughtLoan);

                            }elseif($loanStatus=="Pending Disbursement"){
                                $GokweBranchPending  += intval($soughtLoan);
                            }elseif($loanStatus=="Assessment"){
                                $GokweBranchAssessment += intval($soughtLoan);
                            }elseif($loanStatus=="Disbursed"){
                                $GokweBranchDisbursed += intval($soughtLoan);
                            }

                        } elseif($repeatClient == "New"){
                            $GokweNewGlobVar = $GokweNewGlobVar+1;
                            if($loanStatus=="Prospect"){

                                $GokweBranchProspect += intval($soughtLoan);

                            }elseif($loanStatus=="Pending Disbursement"){
                                $GokweBranchPending  += intval($soughtLoan);
                            }elseif($loanStatus=="Assessment"){
                                $GokweBranchAssessment += intval($soughtLoan);
                            }elseif($loanStatus=="Disbursed"){
                                $GokweBranchDisbursed += intval($soughtLoan);
                            }

                        }

                    }
                    // Convert soughtLoan to an integer and add it to the total
                    $total += intval($soughtLoan);
                } else{
                    echo "Timestamp range not found";
                }
            }
            $PendingTotal = $GokweBranchPending + $BulawayoBranchPending + $GweruBranchPending+ $HarareABranchPending+$HarareBranchPending;
            $AssessmentTotal=$GokweBranchAssessment + $BulawayoBranchAssessment + $GweruBranchAssessment+ $HarareABranchAssessment + $HarareBranchAssessment;
            $PropectTotal = $GokweBranchProspect + $BulawayoBranchProspect + $GweruBranchProspect + $HarareABranchProspect + $HarareBranchProspect;
            $DisbursmentTotal = $GokweBranchDisbursed + $BulawayoBranchDisbursed + $GweruBranchDisbursed + $HarareBranchADisbursed + $HarareBranchDisbursed;
        }
    }

    curl_close($ch);
}


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

        <?php include('../includes/forms/pipeline_report_date_range.php'); ?>

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
