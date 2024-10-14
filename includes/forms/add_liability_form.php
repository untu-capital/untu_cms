
<?php

$errors = array();

// Escape user inputs for security
if(isset($_POST['Submit'])){
    $campaignname = $_POST['campaign_name'];


    if ($enddate < $startdate) {
        // End date is greater than start date
        echo '<script>alert("End date must be greater than start date.");history.go(-1);</script>';
        // Add your desired logic here
    } else {
        $url = "http://localhost:7878/api/utg/api/liability";

        $data_array = array(
            'campaignID' => 1234,


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
                <h3 class="mb-20">Liability added Succesfully!</h3>
                <div class="mb-30 text-center">
                    <img src="../vendors/images/success.png" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-4">
                    <div class="input-group mb-0">
                        <a class="btn btn-danger btn-lg btn-block"  href="treasury_management.php?menu=main">Ok</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <h4 class="text-blue h4">Liability Form</h4>

    </div>
    <div class="wizard-content">

        <form action="" method="POST">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Type of Liability</label>
                        <select class="custom-select2 form-control" name="liability" id="liability" style="width: 100%; height: 38px" required>

                            <option value="MTN">MTN</option>
                            <option value="Receivable">Receivable</option>
                            <option value="Short_Term">Short Term Dept</option>
                            <option value="Long_Term">Long Term Dept</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Currency</label>
                        <select class="custom-select2 form-control" name="currency" id="currency" style="width: 100%; height: 38px" required>
                            <option value=null>Select Option</option>
                            <option value="USD">USD</option>
                            <option value="ZIG">ZIG</option>


                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" name="amount" id="amount" required>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Tenure(months)</label>
                        <input type="text" class="form-control" name="tenure" id="tenure" required>
                    </div>
                </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Interest</label>
                            <input type="text" class="form-control" name="interest" id="interest" required>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Principal Repayment Type</label>
                        <select class="custom-select2 form-control" name="principal_repayment" id="principal_rapayment" style="width: 100%; height: 38px" required>
                            <option value=null>Select Option</option>
                            <option value="monthly">Monthly</option>
                            <option value="quoterly">Quoterly</option>
                            <option value="maturity">At Maturity</option>


                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Interest Repayment Type</label>
                        <select class="custom-select2 form-control" name="interest-repayment" id="interest-repayment" required>

                            <option value="monthly">Monthly</option>
                            <option value="quoterly">Quoterly</option>
                            <option value="maturity">At Maturity</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="text" class="form-control date-picker" name="start_date" id="start_date" readonly required>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Maturity Date</label>
                        <input type="text" class="form-control date-picker" name="maturity_date" id="maturity_date" readonly required>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Repayment Date</label>
                        <input type="text" class="form-control date-picker" name="repayment_date" id="maturity_date" readonly required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Revolving</label>
                        <select class="custom-select2 form-control" name="revolving"  id="revolving" style="width: 100%; height: 38px" required>
                            <option value="">Revolving?</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <p>Statement detailing other special features like option agreement:</p>
                        <input type="file" id="myFile" name="filename">

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