
<?php if ($_GET['menu'] == 'signing'){ ?>
    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 card-box">
            <?php $loans = loans('/'.$_GET['loan_id']); ?>
            <h5 class="h4 text-blue mb-20">Client: <?php echo $loans["firstName"].' '.$loans["lastName"];?></h5>
            <div class="tab">
                <ul class="nav nav-pills " role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-blue" data-toggle="tab" href="#personal_info" role="tab" aria-selected="true" >
                            Personal Info
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-blue" data-toggle="tab" href="#credit_check" role="tab" aria-selected="false">
                            Credit-Check Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-blue" data-toggle="tab" href="#kyc_docs" role="tab" aria-selected="false">
                            KYC Documents
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-blue" data-toggle="tab" href="#assign_task" role="tab" aria-selected="false" >
                            Ticket Signing Pipeline
                        </a>
                    </li>
                </ul>
                <div class="tab-content">

                    <div class="tab-pane fade active show" id="personal_info" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="card card-box ">
                                    <div class="card-body"><h5 class="card-title text-blue" style="text-decoration: underline;">Personal Information</h5>
                                        <p class="card-text">
                                            <li><b>Client name</b>: <?php echo $loans["firstName"] ?> <?php echo $loans["lastName"] ?></li>
                                            <li><b>Marital Status</b>: <?php echo $loans["maritalStatus"] ?></li>
                                            <li><b>Date of Birth</b>: <?php echo $loans["dateOfBirth"] ?></li>
                                            <li><b>National ID:</b> <?php echo $loans["idNumber"] ?></li>
                                            <li><b>Gender:</b> <?php echo $loans["gender"] ?></li>

                                        </p>
                                        <h5 class="card-title text-blue" style="text-decoration: underline;">Contact Information</h5>
                                        <p class="card-text">
                                            <li><b>Phone number:</b> <?php echo $loans["phoneNumber"] ?></li>
                                            <li><b>Residential Address:</b> <?php echo $loans["streetNo"] ?> <?php echo $loans["streetName"] ?> <?php echo $loans["suburb"] ?> <?php echo $loans["city"] ?></li>

                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="card card-box ">
                                    <div class="card-body">
                                        <h5 class="card-title text-blue" style="text-decoration: underline;">Business Information</h5>
                                        <p class="card-text">
                                            <li><b style="padding-right: 35px;">Name</b>: <?php echo $loans["businessName"] ?></li>
                                            <li><b style="padding-right: 15px;">Address</b>: <?php echo  $loans["placeOfBusiness"] ?></li>
                                            <li><b style="padding-right: 10px;">Start Date</b>: <?php echo  $loans["businessStartDate"] ?></li>
                                            <li><b style="padding-right: 25px;">Type of Business</b>: <?php echo  $loans["industryCode"] ?></li>
                                        </p>
                                        <!-- </div>
                                        <div class="card-body"> -->
                                        <h5 class="card-title text-blue" style="text-decoration: underline;">Application Information</h5>
                                        <p class="card-text">
                                            <li><b>Loan Amount:</b> <?php echo "$ ".$loans["loanAmount"].".00" ?></li>
                                            <li><b>Tenure:</b> <?php echo $loans["tenure"]." months" ?></li>
                                            <li><b>Status</b>:
                                                <?php if ($loans['loanStatus'] == "ACCEPTED") {
                                                    echo "<label style='padding: 10px;' class='badge badge-success'>Checked</label>";
                                                } else if ($loans['loanStatus'] == "REJECTED") {
                                                    echo "<label style='padding: 6px;' class='badge badge-danger'>Rejected</label>";
                                                } else { echo "<label style='padding: 6px;' class='badge badge-warning'>Pending</label>"; } ?>
                                            </li>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="card-title text-blue" style="text-decoration: underline;">Next of Kin Details</h5>
                        <div class="row">

                            <div class="col-md-6">
                                <?php if($loans["nextOfKinName"]<>""){ ?>
                                    <a class="list-group-item"><b style="padding-right: 60px;">Fullname</b>: <?php echo $loans["nextOfKinName"] ?></a>
                                    <a class="list-group-item"><b style="padding-right: 20px;">Phone number</b>: <?php echo $loans["nextOfKinPhone"] ?></a>
                                    <a class="list-group-item"><b style="padding-right: 35px;">Relationship</b>: <?php echo $loans["nextOfKinRelationship"] ?></a>
                                    <a class="list-group-item"><b style="padding-right: 65px;">Address</b>: <?php echo $loans["nextOfKinAddress"] ?></a>
                                <?php }; ?>
                            </div>

                            <div class="col-md-6">
                                <?php if($loans["nextOfKinName2"]<>""){ ?>
                                    <a class="list-group-item"><b style="padding-right: 60px;">Fullname</b>: <?php echo $loans["nextOfKinName2"] ?></a>
                                    <a class="list-group-item"><b style="padding-right: 20px;">Phone number</b>: <?php echo $loans["nextOfKinPhone2"] ?></a>
                                    <a class="list-group-item"><b style="padding-right: 35px;">Relationship</b>: <?php echo $loans["nextOfKinRelationship2"] ?></a>
                                    <a class="list-group-item"><b style="padding-right: 65px;">Address</b>: <?php echo $loans["nextOfKinAddress2"] ?></a>
                                <?php }; ?>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="credit_check" role="tabpanel">
                        <div class="table-responsive">
                            <table class=" table-striped" style="margin: 2%;">
                                <colgroup>
                                    <col span="1" style="width: 10%;">
                                    <col span="1" style="width: 25%;">
                                </colgroup>
                                <tbody>
                                <tr class="even pointer">
                                    <td>Nationality</td>
                                    <td>
                                        <?php echo $loans["fcbResponse"]["Report"][0]["Nationality"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td>
                                        <?php echo $loans["fcbResponse"]["Report"][0]["DOB"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>National ID</td>
                                    <td>
                                        <?php echo $loans["fcbResponse"]["Report"][0]["National_ID"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Gender</td>
                                    <td>
                                        <?php echo $loans["fcbResponse"]["Report"][0]["Gender"] ?>
                                    </td>
                                </tr>
                                <tr class="even pointer">
                                    <td> Mobile</td>
                                    <td>
                                        <?php echo $loans["fcbResponse"]["Report"][0]["Mobile"] ?>
                                    </td>
                                </tr>
                                <tr class="even pointer">
                                    <td> Property Status</td>
                                    <td>
                                        <?php echo $loans["fcbResponse"]["addresses"][0]["property_status"] ?>
                                    </td>
                                </tr>
                                <tr class="even pointer">
                                    <td>Property Density</td>
                                    <td>
                                        <?php echo $loans["fcbResponse"]["addresses"][0]["property_density"] ?>
                                    </td>
                                </tr>
                                <tr class="even pointer">
                                    <td> Address</td>
                                    <td>
                                        <?php echo $loans["fcbResponse"]["addresses"][0]["street_no"] ?>
                                        <?php echo $loans["fcbResponse"]["addresses"][0]["street_name"] ?>
                                        <?php echo $loans["fcbResponse"]["addresses"][0]["suburb"] ?>
                                        <?php echo $loans["fcbResponse"]["addresses"][0]["city"] ?>
                                    </td>
                                </tr>
                                <tr class="even pointer">
                                    <td> Marital Status</td>
                                    <td>
                                        <?php echo $loans["fcbResponse"]["Report"][0]["Married"] ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <a class="list-group-item text-blue"><center><b>ADDRESSES (Last 5 years with most recent first)</b></center></a>
                        <div class="table-responsive">
                            <table class="data-table table-striped hover nowrap">
                                <colgroup>
                                    <col span="1" style="width: 10%;">
                                    <col span="1" style="width: 30%;">
                                    <col span="1" style="width: 15%;">
                                    <col span="1" style="width: 15%;">
                                    <col span="1" style="width: 15%;">
                                    <col span="1" style="width: 15%;">
                                    <col span="1" style="width: 15%;">
                                </colgroup>
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Date</th>
                                    <th class="column-title">Street Name</th>
                                    <th class="column-title">City</th>
                                    <th class="column-title">Country</th>
                                    <th class="column-title">Phone</th>
                                    <th class="column-title">Poperty Rights</th>
                                </tr>
                                </thead>
                                <colgroup>
                                    <col span="1" style="width: 10%;">
                                    <col span="1" style="width: 30%;">
                                    <col span="1" style="width: 15%;">
                                    <col span="1" style="width: 15%;">
                                    <col span="1" style="width: 15%;">
                                    <col span="1" style="width: 15%;">
                                    <col span="1" style="width: 15%;">
                                </colgroup>
                                <tbody>
                                <?php
                                for ($cnt = 0; $cnt <= 4; $cnt++) {
                                    if (isset($loans["fcbResponse"]["addresses"][$cnt]["id"])) {

                                        $date = $loans["fcbResponse"]["searches"][$cnt]["date_searched"];
                                        $createDate = new DateTime($date);

                                        $strip = $createDate->format('d-M-Y');
                                        ?>

                                        <tr class="even pointer">
                                            <td>
                                                <?php echo $strip ?>
                                            </td>
                                            <td>
                                                <?php echo $loans["fcbResponse"]["addresses"][$cnt]["street_no"] ?>
                                                <?php echo $loans["fcbResponse"]["addresses"][$cnt]["street_name"] ?>
                                            </td>
                                            <td>
                                                <?php echo $loans["fcbResponse"]["addresses"][$cnt]["city"] ?>
                                            </td>
                                            <td>
                                                <?php echo $loans["fcbResponse"]["addresses"][$cnt]["country"] ?>
                                            </td>
                                            <td>
                                                <?php echo $loans["fcbResponse"]["addresses"][$cnt]["country"] ?>
                                            </td>
                                            <td>
                                                <?php echo $loans["fcbResponse"]["addresses"][$cnt]["property_density"] ?>
                                            </td>
                                            <td>
                                                <?php echo $loans["fcbResponse"]["addresses"][$cnt]["property_status"] ?>
                                            </td>
                                        </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                            <br><br>
                            <a class="list-group-item text-blue">
                                <center><b>PREVIOUS SEARCHES (Last 5 years with most recent first)</b></center>
                            </a>

                            <div class="table-responsive">
                                <table class="data-table table-striped hover nowrap">
                                    <colgroup>
                                        <col span="1" style="width: 18%;">
                                        <col span="1" style="width: 30%;">
                                        <col span="1" style="width: 25%;">
                                        <col span="1" style="width: 15%;">
                                        <col span="1" style="width: 10%;">
                                        <col span="1" style="width: 10%;">
                                    </colgroup>
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title">Date</th>
                                        <th class="column-title">Search Purpose</th>
                                        <th class="column-title">Subscriber</th>
                                        <th class="column-title">Branch</th>
                                        <th class="column-title">Status</th>
                                        <th class="column-title">Score</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    for ($cnt = 0; $cnt <= 4; $cnt++) {
                                        if (isset($loans["fcbResponse"]["searches"][$cnt]["id"])) {
                                            $date = $loans["fcbResponse"]["searches"][$cnt]["date_searched"];
                                            $createDate = new DateTime($date);

                                            $strip = $createDate->format('d-M-Y');
                                            ?>
                                            <tr class="even pointer">
                                                <td>
                                                    <?php echo $strip ?>
                                                </td>
                                                <td>
                                                    <?php echo $loans["fcbResponse"]["searches"][$cnt]["search_purpose"] ?>
                                                </td>
                                                <td>
                                                    <?php echo $loans["fcbResponse"]["searches"][$cnt]["subscriber_name"] ?>
                                                </td>
                                                <td>
                                                    <?php echo $loans["fcbResponse"]["searches"][$cnt]["branch_name"] ?>
                                                </td>
                                                <td>
                                                    <?php echo $loans["fcbResponse"]["searches"][$cnt]["status"] ?>
                                                </td>
                                                <td>
                                                    <?php echo $loans["fcbResponse"]["searches"][$cnt]["score"] ?>
                                                </td>
                                            </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <a class="list-group-item text-blue"><center><b>ATTACHED KYC FILES</b></center></a>

                        <?php
                        $xds_files = xds_files($_GET['loan_id']);
                        if ($xds_files['fileName'] <> ""){?>
                            <div class="panel panel-default">
                                <embed
                                    src="../../uploads/xds/<?php echo $xds_files['fileName'] ?>"
                                    type="application/pdf" frameBorder="0" scrolling="auto" height="700px" width="100%">
                            </div>
                        <?php }?>
                    </div>

                    <div class="tab-pane fade" id="kyc_docs" role="tabpanel">
                        <!--                        <div class="container-lg">-->
                        <b>Client's Documents</b>
                        <div class="row">
                            <?php
                            $client_id = $_GET['userid'];
                            include('../includes/forms/view_kyc.php');?>
                        </div>

                        <br><br>
                        <b>Assessment Files by Loan Officer</b>
                        <div class="row">
                            <?php
                            $loan_id = $_GET['loan_id'];
                            include('../includes/forms/view_assessment_files.php');?>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="assign_task" role="tabpanel">

                        <div class="card-body">
                            <form action="" method="post">
                                <?php $user = user($_GET['userid']) ?>
                                <?php $loans = loans('/'.$_GET['loan_id']) ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="list-group-item"><b>Client Name</b>: <?= $user["firstName"] ?> <?= $user["middleName"] ?>  <?= $user["lastName"] ?></a>
                                        <a class="list-group-item"><b>Loan Amount</b>: <?= "$ ".$loans["meetingLoanAmount"].".00" ?></a>
                                        <a class="list-group-item"><b>Less Fees</b>: <?= "$ ".$loans["lessFees"].".00" ?></a>
                                        <a class="list-group-item"><b>Application Fee</b>: <?= "$ ". $loans["applicationFee"].".00" ?></a>
                                        <a class="list-group-item"><b>Cash Handling Fees</b>: <?= "$ ". $loans["meetingCashHandlingFee"].".00" ?></a>
                                        <a class="list-group-item"><b>Repayment Amount</b>: <?= $loans["meetingRepaymentAmount"] ?></a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="list-group-item"><b>Branch</b>: <?= $loans["branchName"] ?></a>
                                        <a class="list-group-item"><b>Tenor</b>: <?= $loans["meetingTenure"]." months" ?></a>
                                        <a class="list-group-item"><b>Interest Rate</b>: <?= $loans["meetingInterestRate"]."%"  ?></a>
                                        <a class="list-group-item"><b>Product</b>: <?= $loans["meetingProduct"] ?></a>
                                        <a class="list-group-item"><b>R/N</b>: <?= $loans["meetingRN"]  ?></a>
                                        <a class="list-group-item"><b>Upfront Fees</b>: <?= $loans["meetingUpfrontFee"]."%"?></a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="list-group-item"><b>Prepared By </b>: <?php echo $boco_signature; ?></a>
                                        <a class="list-group-item"><b style="padding-right: 5px;">Signed by Branch Manager</b>:
                                            <?php if ($loans['bmSignature'] == "Signed") {
                                                echo $bm_signature;
                                            } elseif ($loans['caSignature'] == "Declined"){
                                                echo "<label style='padding: 7px;' class='badge badge-danger'>Subject to review.</label>";
                                            }
                                            else {
                                                echo "<label style='padding: 7px;' class='badge badge-warning'>Not Signed Yet.</label>";
                                            }
                                            ?></a>

                                        <a class="list-group-item"><b style="padding-right: 20px;">Credit Checked By</b>: <?php if ($loans['caSignature'] == "Signed") {
                                                echo $ca_signature;
                                            } elseif ($loans['cmSignature'] == "Declined"){
                                                echo "<label style='padding: 7px;' class='badge badge-danger'>Subject to review.</label>";
                                            }
                                            else {
                                                echo "<label style='padding: 7px;' class='badge badge-warning'>Not Signed Yet.</label>";
                                            }
                                            ?></a>
                                        <a class="list-group-item"><b style="padding-right: 15px;">Confirmed By</b>: <?php if ($loans['cmSignature'] == "Signed") {
                                                echo $cm_signature;
                                            } elseif ($loans['finSignature'] == "Declined"){
                                                echo "<label style='padding: 7px;' class='badge badge-danger'>Subject to review.</label>";
                                            }
                                            else {
                                                echo "<label style='padding: 7px;' class='badge badge-warning'>Not Signed Yet.</label>";
                                            }
                                            ?></a>
                                        <a class="list-group-item"><b>Finance Authorised By</b>: <?php if ($loans['finSignature'] == "Signed") {
                                                echo $fin_signature;
                                            } elseif ($loans['boardSignature'] == "Declined"){
                                                echo "<label style='padding: 7px;' class='badge badge-danger'>Subject to review.</label>";
                                            }
                                            else {
                                                echo "<label style='padding: 7px;' class='badge badge-warning'>Not Signed Yet.</label>";
                                            }
                                            ?></a>
                                        <?php if ($loans['meetingLoanAmount'] >= 30000 ){ ?>
                                            <a class="list-group-item"><b>CEO Authorization</b>: <?php if ($loans['boardSignature'] == "Signed") {
                                                    echo $board_signature;
                                                } else {
                                                    echo "<label style='padding: 7px;' class='badge badge-warning'>Not Signed Yet.</label>";
                                                }
                                                ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <br>
                                <h5 class="card-title text-blue" style="text-decoration: underline;">Loan Assessed By:  <?php $loan_officer = user($loans['assignTo']);
                                    echo $loan_officer['firstName'].' '.$loan_officer['lastName'];?></h5>

                                <div class="row">
                                    <div class="col-md-9">
                                        <!--                                        <a class="list-group-item"><b>Collateral</b>:-->
                                        <table class="table table-striped table-bordered hover nowrap">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Conditions List</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $cnt = 1;
                                            $data_collateral = data_collateral($_GET['loan_id']);
                                            foreach($data_collateral as $application):?>
                                                <tr>
                                                    <td><?= $cnt; ?></td>
                                                    <td><?= $application["collateral"] ?></td>
                                                </tr>
                                                <?php $cnt++; endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control" type="hidden" name="userId" required value="<?php echo $_SESSION['userid'] ?>">
                                        <input class="form-control" type="hidden" name="fullName" required value="<?php echo $_SESSION['fullname'] ?>">
                                        <div style="display: flex; justify-content: flex-end; margin-right: 5%">
                                            <div class="custom-control custom-radio mb-5" style="display: flex; flex-direction: column; align-items: flex-start; margin-right: 10px;">
                                                <div>
                                                    <input class="custom-control-input" type="radio" id="authorise" name="<?php echo $xxSignature ?>" value="Signed" onclick="enableButton()">
                                                    <label class="custom-control-label" for="authorise">Authorise</label>
                                                </div>
                                                <div>
                                                    <input class="custom-control-input" type="radio" id="decline" name="<?php echo $xxSignature ?>" value="Declined" onclick="enableButton()">
                                                    <label class="custom-control-label" for="decline">Revert Ticket</label>
                                                </div>
                                            </div>
                                            <br>
                                            <button class="btn btn-success" id="submitBtn" type="submit" name="<?php echo $xx_sign_ticket ?>" disabled>Sign Ticket</button>
                                        </div>
                                        <script>
                                            function enableButton() {
                                                const authorise = document.getElementById('authorise');
                                                const decline = document.getElementById('decline');
                                                const submitBtn = document.getElementById('submitBtn');

                                                if (authorise.checked || decline.checked) {
                                                    submitBtn.disabled = false;
                                                } else {
                                                    submitBtn.disabled = true;
                                                }
                                            }
                                        </script>
                                    </div>

                                </div>
                                <br/>

                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php } ?>