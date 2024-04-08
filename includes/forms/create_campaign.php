
<?php

$errors = array();

// Escape user inputs for security
if(isset($_POST['Submit'])){
    $campaignname = $_POST['campaign_name'];
    $city = $_POST['city'];
    $branch = $_POST['branch'];
    $zonearea= $_POST['zone'];
    $sector = $_POST['sector'];
    $subsector = $_POST['subsector'];
    $valuechain = $_POST['value_chain'];
    $resourceneed = $_POST['resource_need'];
    $startdate = $_POST['start_date'];
    $enddate = $_POST['end_date'];
    $loanofficer = $_POST['loan_officer'];

    if ($enddate < $startdate) {
        // End date is greater than start date
        echo '<script>alert("End date must be greater than start date.");history.go(-1);</script>';
        // Add your desired logic here
    } else {
        $url = "http://localhost:7878/api/utg/market_campaigns";

        $data_array = array(
            'campaignID' => 1234,
            'campaignName'=> $campaignname,
            'city' => $city,
            'branchName' => $branch,
            'zoneArea' => $zonearea,
            'sector' => $sector,
            'subSector' => $subsector,
            'valueChain' => $valuechain,
            'resourceNeed' => $resourceneed,
            'startDate' => $startdate,
            'endDate' => $enddate,
            'allocatedLoanOfficer' => $loanofficer,
            'campaignStatus' => "open",
            'venue' => "Chisipite Park",
            'targetAudience'=>'Farmers',
            'objectives' =>'To inform leads',
            'keyPerformanceIndicator'=> 'Get many clients as possible',
            'allocatedLoanOfficer'=> 'kelvin'

        );



        $data = json_encode($data_array);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true );

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
                    ?>        <script>
                    $(function() {
                        $("#myModal").modal();//if you want you can have a timeout to hide the window after x seconds
                    });
                </script>
                    <?php

                    break;
                case 400:  # Bad Request
                    $decoded = json_decode($bodyStr);
                    foreach($decoded as $key => $val) {
                        //echo $key . ': ' . $val . '<br>';
                    }
                    // echo $val;
                    $_SESSION['error'] = "Failed. Please try again, ".$val;
                    header('location: campaign_and_marketing.php?menu=add_campaign');
                    break;

                case 401: # Unauthorixed - Bad credientials
                    $_SESSION['error'] = 'Application failed.. Please try again!';
                    header('location: campaign_and_marketing.php?menu=add_campaign');

                    break;
                default:
                    $_SESSION['error'] = 'Not able to send application'. "\n";
                    header('location: campaign_and_marketing.php?menu=add_campaign');
            }
        } else {
            $_SESSION['error'] = 'Application failed.. Please try again!'. "\n";
            header('location: campaign_and_marketing.php?menu=add_campaign');

        }
        curl_close($ch);
    }

}

?>
<!--<head>-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<!---->
<!--</head>-->
<!-- Modal -->



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h3 class="mb-20">Campaign Created Succesfully!</h3>
                <div class="mb-30 text-center">
                    <img src="../vendors/images/success.png" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-4">
                    <div class="input-group mb-0">
                        <a class="btn btn-danger btn-lg btn-block"  href="campaign_and_marketing.php?menu=main">Ok</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <h4 class="text-blue h4">Campaign and Marketing Management</h4>

    </div>
    <div class="wizard-content">

        <form action="" method="POST">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Campaign Name</label>
                        <input type="text" class="form-control" name="campaign_name" id="campaign_name" required>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Branch Name</label>
                        <select class="custom-select form-control"name="branch" id="branch" required>
                            <option value="">Select Branch</option>
                            <?php
                                $branches = branches();
                                foreach ($branches as $branch) {
                                echo "<option value='$branch[branchName]'>$branch[branchName] Branch</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>City/Town</label>
                        <select class="custom-select form-control" name="city" id="city" required>
                            <option value="">Select City</option>
                            <?php
                                $cities = cities();
                            foreach ($cities as $city) {
                                echo "<option value='$city[name]'>$city[name]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Zone/Area</label>
                        <select class="custom-select form-control" name="zone" id="zone"  autocomplete="off" required="required">
                            <option value="">Select Zone</option>
                            <?php
                            $zones = zones();
                            foreach ($zones as $zone) {
                                echo "<option value='$zone[name]'>$zone[name]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Sector</label>

                        <select class="custom-select form-control" name="sector" id="sector"  autocomplete="off" required="required">
                            <option value="">Select Sector</option>
                            <?php
                                $bsn_sector = bsn_sector();
                                foreach ($bsn_sector as $ind) {
                                echo "<option value='$ind[name]'>$ind[name]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Sub-sector</label>
                        <input type="text" class="form-control" name="subsector" id="subsector" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Value Chain(if applicable)</label>
                        <input type="text" class="form-control" name="value_chain" id="value_chain" required>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Specify Location/(Venue)</label>
                        <input type="text" class="form-control" name="location" id="location" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Start Date</label>
                        <input
                                type="text"
                                class="form-control date-picker"
                                placeholder="Select Date"
                                id="start_date"
                                name="start_date"
                        />
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>End Date</label>
                        <input
                                type="text"
                                class="form-control date-picker"
                                placeholder="Select Date"
                                id="end_date"
                                name="end_date"
                        />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Assign Loan Officer (Optional)</label>
                        <select class="custom-select form-control" id= "loan_officer" name="loan_officer" required>
                            <option value="">Select Loan Officer</option>
                            <?php
                            $user_role = user_role('LoanOfficer');
                            foreach ($user_role as $role) {
                                echo "<option value='$role[id]'>$role[firstName] $role[lastName]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Resource Need</label>
                        <input type="text" class="form-control" name="resource_need" id="resource_need" required>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">

                <?php
//                if ($_SERVER["REQUEST_METHOD"] == "POST") {
//                    $start_date = $_POST["start_date"];
//                    $end_date = $_POST["end_date"];
//
//                    if ($end_date > $start_date) {
//                        // End date is greater than start date
//                        echo "End date is greater than start date.";
//                        // Add your desired logic here
//                    } else {
//                        // End date is not greater than start date
//                        echo "End date must be greater than start date.";
//                        // Add your desired logic here
//                    }
//                }
                ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-danger" value="Submit" name="Submit">Submit</button>
                </div>
            </div>
        </form>

    </div>
</div>