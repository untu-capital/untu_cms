<?php if ($_GET['menu'] == 'loan'){ ?>
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
                            <?php if ($_SESSION['role'] == "ROLE_LO"){echo "Assessment/Appraisal";
                            } elseif ($_SESSION['role'] == "ROLE_ADMIN" || $_SESSION['role'] == "ROLE_AUDIT") {
                                echo "Application Process Pipeline";
                            }else {echo "Assign Tasks";} ?>
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
                                            <li><b>Fullname</b>: <?php echo $loans["firstName"] ?> <?php echo $loans["lastName"] ?></li>
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
                        <div class="">
                            <b>Client's Documents</b>
                            <?php
                                $client_id = $_GET['userid'];
                                include('../includes/forms/view_kyc.php');?>

                            <br><br>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="assign_task" role="tabpanel">
                        <?php if ($_SESSION['role'] == "ROLE_BM"){ ?>
                            <form method="post" action="">
                                <a class="list-group-item"><b>Notes from <?php $user = user($loans["loanStatusAssigner"]); echo $user['firstName'].' '.$user['lastName']; ?></b> <?php echo $loans["comment"] ?></a>
                                <textarea class="form-control" name= "additional_remarks" value= "<?php echo $loans["comment"] ?>" disabled></textarea>
                                <div class="form-group">
                                    <br>
                                    <label><h5>Assign Loan officer :</h5></label>
                                    <select class="selectpicker form-control" data-style="btn-outline-primary" data-size="5" name="assignTo">
                                        <optgroup  data-max-options="2">
                                            <option value="null">Select Loan officer</option>
                                            <?php
                                            $loan_officer = loan_officer();
                                            foreach ($loan_officer as $lo) {
                                                if ($lo['branch'] == $_SESSION['branch']){ echo "<option value='$lo[id]'>$lo[firstName] $lo[lastName]</option>";}} ?>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><h5>Additional Remarks</h5></label>
                                    <textarea class="form-control" name= "additional_remarks"></textarea>
                                </div>

                                </a>

                                <div hidden>
                                    <a class="list-group-item"><b style="padding-right: 160px;"></b>
                                        <input class="form-control" type="hidden" name="loanId" required value="<?php echo $_GET['loan_id'] ?>">
                                        <input class="form-control" type="hidden" name="userId" required value="<?php echo $_GET['userid'] ?>">
                                        <input class="form-control" type="hidden" name="assignedBy" required value="<?php echo $_SESSION['userId'] ?>">
                                    </a>
                                </div>
                                <button type = "submit" name= "assign_lo" class="btn btn-success btn-lg btn-block" >Assign Task</button>
                            </form>
                        <?php } elseif ($_SESSION['role'] == "ROLE_BOCO") { ?>
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-3">
                                    <a class="list-group-item"><b style="padding-right: 40px;">Action</b>:
                                        <select class="custom-select2 form-control" id="loanStatus" onchange="Status()" class="btn btn-clipboard" name="update_loan_status" autocomplete="off" style="width: 100%; height: 38px" placeholder="" >
                                            <option value="PENDING">Decision pending</option>
                                            <option value="ACCEPTED">Checked</option>
                                            <option value="REJECTED">Reject</option>
                                        </select>
                                    </a>
                                    </div>
                                    <div class="col-9">
                                        <textarea class="form-control" placeholder = "Additional Comments" name= "reason"></textarea>
                                    </div>
                                </div>
                                <br>
                                <input class="form-control" type="hidden" name="loan_id" required value="<?php echo $_GET['loan_id'] ?>">
                                <input class="form-control" type="hidden" name="userid" required value="<?php echo $_SESSION['userId'] ?>">
                                <button class="btn btn-success btn-lg" type = "submit" name="check" >Push Application</button>
                            </form>
                        <?php } elseif ($_SESSION['role'] == "ROLE_ADMIN" || $_SESSION['role'] == "ROLE_AUDIT") {
                            include('../includes/tables/track_loans_progress_table.php');

                        } elseif ($_SESSION['role'] == "ROLE_LO") { ?>
                            <b>Appraisal Form Upload</b>
                            <div class="row">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="post">
                                    <input type="hidden" value="<?php echo $_GET['loan_id'] ?>" name="loan_id" >
                                    <input type="hidden" value="<?php echo $_GET['userid'] ?>" name="userid">
                                    <div class="form-group row">
                                        <div class="col-8">
                                            <input type="file"  name="file" id="file" multiple="multiple" required class="form-control-file form-control height-auto">
                                        </div>
                                        <div class="col-4">
                                            <input type="submit" value="Upload Appraisal (Excel)" name="UploadAppraisal" class="btn btn-success btn-lg" >
                                        </div>
                                     </div>
                                </form>
                            </div>
                            <div class="row">

                                <?php
                                    $appraisal_files = appraisal_files($_GET['loan_id']);
                                    if($appraisal_files[0]['fileName'] !=""){ ?>
                                        <div class="col-md-55">
                                            <div class="thumbnail" style="border-radius: 0.08rem">
                                                <div class="image view view-first">
                                                    <a href="../includes/file_uploads/loan_officers/<?php echo $appraisal_files[0]['fileName'] ?>"><img style="height: 150px" src="../includes/file_uploads/loan_officers/excel.png"></a>
                                                    <div class="mask no-caption"></div>
                                                </div>
                                                <div class="caption">
                                                    <p>
                                                        <?php echo current(explode('.', $appraisal_files[0]['fileName'])) ?>
                                                        <strong><a name="downloadfile" download="<?php echo $appraisal_files[0]['fileName'] ?>" href="../includes/file_uploads/loan_officers/<?php echo $appraisal_files[0]['fileName'] ?>" style="color: black;">Download</a></strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                                <br>
                                <hr>
                            </div>
                            <br>
                            <b>Assessment Files Uploads</b>
                            <div class="row">
                                <form action="" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="loan_id" value="<?php echo $_GET['loan_id'];?>">
                                    <input type="hidden" name="userid" value="<?php echo $_GET['userid'];?>">
                                    <div class="form-group row">
                                        <div class="col-8">
                                            <input type="file" name="file[]" id="file" class="form-control-file form-control height-auto" multiple required />
                                        </div>
                                        <div class="col-4">
                                            <input type="submit" value="Upload Assessment Files" name="loanOfficerUploads" class="btn btn-success btn-lg">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row">
                                <?php
                                $loan_id = $_GET['loan_id'];
                                include('../includes/forms/view_assessment_files.php');?>
                            </div>

                            <div class="text-right">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                    <input type="hidden" value="<?php echo $_GET['loan_id']; ?>" name="loan_id">
                                    <input type="hidden" value="<?php echo $_GET['userid'] ?>" name="userid">
                                    <input type="hidden" value="completed" name="completed">
                                    <input class="form-control" type="hidden" name="fullName" required value="<?php echo $_SESSION['fullname'] ?>">
                                    <button type="submit" value="MarkAsDone" name="markAsDone" class="btn btn-lg btn-primary">COMPLETED FILE ASSESSMENT</button>
                                    <!--                                <div><input type="submit" value="MarkAsDone" name="markAsDone" class="form-control" style="background-color: transparent; color: white"></div>-->
                                </form>
                            </div>
                        <?php }?>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php }elseif ($_GET['menu'] == 'edit_loan'){
    include('../includes/forms/edit_loan.php');
 } elseif ($_GET['menu'] == 'bcc_schedule'){ ?>
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
                            Schedule BCC
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
                                            <li><b>Fullname</b>: <?php echo $loans["firstName"] ?> <?php echo $loans["lastName"] ?></li>
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
                        <b>Client's Documents</b>
                        <div class="row">
                            <?php
                            $client_id = $_GET['userid'];
                            include('../includes/forms/view_kyc.php');?>
                        </div>

                        <br><br>
                        <b>Appraisal File (Excel Sheet)</b>
                        <div class="row">
                            <?php
                            $loan_id = $_GET['loan_id'];
                            include('../includes/forms/view_appraisal_file.php');?>
                        </div>

                        <br><br>
                        <b>Assessment Files by Loan Officer</b>
                        <div class="row">
                            <?php
                            $loan_id = $_GET['loan_id'];
                            include('../includes/forms/view_assessment_files.php');?>
                        </div>
                        <!--                        </div>-->
                    </div>

                    <div class="tab-pane fade" id="assign_task" role="tabpanel">

                        <form method="post" id="insert_form" action="">
                            <b>Setup BCC Meeting</b>
                            <br>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Select Committee</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select id="setCommit" onchange="chooseCommit()" class="custom-select2 form-control" name="recipientEmail" multiple="multiple" required style="width: 100%">
                                            <optgroup label="Select Attendees">
    <!--                                            <option value="null">Select Attendees</option>-->
                                                <?php
                                                $loan_officer = loan_officer();
                                                foreach ($loan_officer as $lo) {
                                                    if ($lo['branch'] == $_SESSION['branch']){ echo "<option value='$lo[id]'>$lo[firstName] $lo[lastName]</option>";}} ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Email Subject</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control" type="text" id="setCommitGroup" name= "subject" placeholder="Add email subject">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><b>Message :</b></label>
                                    <textarea placeholder = "Type your message here" name= "message" class="form-control" required></textarea>
                                    <input type="hidden"  name = "fullname" required="required" class="form-control" value="<?php echo $_SESSION['firstname'].'_'.$_SESSION['lastname']; ?>" >
                                </div>

<!--                            <a class="list-group-item"><b style="padding-right: 160px;"></b>-->
                                <input class="form-control" type="hidden" name="loanId" required value="<?php echo $_GET['loan_id'] ?>">
                                <input class="form-control" type="hidden" name="userId" required value="<?php echo $_SESSION['userid'] ?>">
                                <input class="form-control" type="hidden" name="commit" required value="branch">
                                <button class="btn btn-success btn-lg" type = "submit" name= "set_meeting" >Schedule BCC Meeting</button>
<!--                            </a>-->
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php } elseif ($_GET['menu'] == 'bcc_final'){ ?>
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
                            Schedule BCC
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
                                            <li><b>Fullname</b>: <?php echo $loans["firstName"] ?> <?php echo $loans["lastName"] ?></li>
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
                        <b>Appraisal File (Excel Sheet)</b>
                        <div class="row">
                            <?php
                            $loan_id = $_GET['loan_id'];
                            include('../includes/forms/view_appraisal_file.php');?>
                        </div>

                        <br><br>
                        <b>Assessment Files by Loan Officer</b>
                        <div class="row">
                            <?php
                            $loan_id = $_GET['loan_id'];
                            include('../includes/forms/view_assessment_files.php');?>
                        </div>
                        <!--                        </div>-->
                    </div>

                    <div class="tab-pane fade" id="assign_task" role="tabpanel">

                        <form method="post" action="">
                            <table class="table table-striped table-bordered" id="table_field">
                                <tr>
                                    <th>Loan Amount ($)</th>
                                    <th>Tenure</th>
                                    <th>Interest Rate (%)</th>
                                    <th>On what basis</th>
                                    <th>Cash Handling Fee (%)</th>
                                    <th>Repayment Amount ($)</th>
                                    <th>Product</th>
                                    <th>R/N Client</th>
                                    <th>Upfront Fee (%)</th>
                                </tr>

                                <tr>
                                    <?php $data = loans('/'.$_GET['loan_id']) ?>
                                    <td><?php echo '$ '.$data['meetingLoanAmount'] ;?></td>
                                    <td><?php echo $data['meetingTenure'].' months' ;?></td>
                                    <td><?php echo $data['meetingInterestRate'].' %' ;?></td>
                                    <td><?php echo $data['meetingOnWhichBasis'] ;?></td>
                                    <td><?php echo $data['meetingCashHandlingFee'].' %' ;?></td>
                                    <td><?php echo '$ '.$data['meetingRepaymentAmount'] ;?></td>
                                    <td><?php echo $data['meetingProduct'] ;?></td>
                                    <td><?php echo $data['meetingRN'] ;?></td>
                                    <td><?php echo $data['meetingUpfrontFee'].' %' ;?></td>
                                    <!-- <td><input class="btn" type="button" id="delete" name="delete" value="delete" required></td> -->
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="txtLoanAmount"  min=0 required></td>
                                    <td>
                                        <select class="btn btn-clipboard" name="txtTenure" autocomplete="off" placeholder="" >
                                            <option value="0">Select</option>
                                            <option value="1">1 months</option>
                                            <option value="2">2 months</option>
                                            <option value="3">3 months</option>
                                            <option value="4">4 months</option>
                                            <option value="5">5 months</option>
                                            <option value="6">6 months</option>
                                            <option value="7">7 months</option>
                                            <option value="8">8 months</option>
                                            <option value="9">9 months</option>
                                            <option value="10">10 months</option>
                                            <option value="11">11 months</option>
                                            <option value="12">12 months</option>
                                        </select></td>
                                    <td><input class="form-control" type="text" name="txtInterestRate"  min=0 required></td>
                                    <td><select class="btn btn-clipboard" name="txtBasis" autocomplete="off" placeholder="" >
                                            <option value="reducing balance">reducing balance</option>
                                            <option value="fixed balance">fixed balance</option>
                                        </select></td>

                                    <td><input class="form-control" type="text" name="txtCashHandlingFee" placeholder="max 2%" min=0 max=2></td>
                                    <td><input class="form-control" type="text" name="txtRepaymentAmount" required></td>
                                    <td><select class="btn btn-clipboard" name="txtProduct" autocomplete="off" placeholder="" >
                                            <option value="CTF">CTF</option>
                                        </select></td>
                                    <td><select class="btn btn-clipboard" name="txtRN" autocomplete="off" placeholder="" >
                                            <option value="R">Repeat</option>
                                            <option value="N">New</option>
                                        </select>
                                    </td>

                                    <td><input class="form-control" type="text" name="txtUpfrontFee" required></td>
                                </tr>

                            </table>
                            <input class="form-control" type="hidden" name="loanId" required value="<?php echo $_GET['loan_id'] ?>">
                            <input class="form-control" type="hidden" name="userId" required value="<?php echo $_GET['userid'] ?>">
                            <input class="form-control" type="hidden" name="meetingFinalizedBy" required value="<?php echo $_SESSION['fullname'] ?>">
                            <button class="btn btn-success btn-lg btn-block" type = "submit" name= "set_parameters">Click To Update </button>
                            <br><br>
                        </form>

                        <form method="post" action="">
                            <table class="table table-striped table-bordered" id="table_field" >
                                <tr>
                                    <th>Conditions ( e.g Motor vehicle valued at 10000 ): </th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="txtCollateral" required>
                                                <input class="form-control" type="hidden" name="loanId" required value="<?php echo $_GET['loan_id'] ?>">
                                                <input class="form-control" type="hidden" name="userId" required value="<?php echo $_GET['userid'] ?>">
                                                <input class="form-control" type="hidden" name="meetingFinalizedBy" required value="<?php echo $_SESSION['fullname'] ?>">

                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-block btn-lg btn-success" type="submit" id="add" name="addCollateral" >Add To List</button>
<!--                                                <input class="btn btn-success" type="submit" id="add" name="addCollateral" value="Add" required>-->
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $cnt = 1;
                                $collateral = collateral($_GET['loan_id']);
                                foreach($collateral as $row):
                                    ?>

                                    <tr>
                                        <td><?php echo $cnt.'. '.$row['collateral'] ;?></td>
                                    </tr>
                                    <?php
                                    $cnt++;
                                endforeach;?>
                            </table>
                        </form>

                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="finalRadio" name="radioSelection" class="custom-control-input" checked>
                            <label class="custom-control-label" for="finalRadio">Select if the Application is ready for processing Pre-disbursement</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="recommendRadio" name="radioSelection" class="custom-control-input">
                            <label class="custom-control-label" for="recommendRadio">Request Recommendation from Head Office (Credit Dept.)</label>
                        </div>

                        <form method="post" id="submitButton" action="">
                            <input class="form-control" type="hidden" name="loanId" required value="<?php echo $_GET['loan_id'] ?>">
                            <input class="form-control" type="hidden" name="userId" required value="<?php echo $_SESSION['userid'] ?>">
                            <input class="form-control" type="hidden" name="decisionBy" required value="<?php echo $_SESSION['userId'] ?>">
                            <input class="form-control" type="hidden" name="creditCommit" value="branch">
                            <input class="form-control" type="hidden" name="pipeline" value="cc_final_meeting">
                            <button name="final_predisbursement" class="btn btn-info btn-lg" onclick="return confirmSubmit();">Submit for Pre-disbursement (BOCO)</button>
                        </form>

                        <script>
                            function confirmSubmit() {
                                var confirmation = confirm("Are you sure the file is ready for Pre-Disbursement?");
                                return confirmation;
                            }
                        </script>


                        <form method="post" id="insert_form" action="" style="display: none;">
                            <div class="text-blue"><b>Set Recommendation (Head Office)</b></div>
                            <br>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Select Recipients</label>
                                <div class="col-sm-12 col-md-10">
                                    <select id="setCommit" onchange="chooseCommit()" class="custom-select2 form-control" name="recipientEmail" multiple="multiple" required style="width: 100%">
                                        <optgroup label="Select Attendees">
                                            <?php $roles = user_role("Operations");
                                            foreach ($roles as $role) {echo "<option value='$role[id]'>$role[firstName] $role[lastName]</option>";} ?>

                                            <?php $roles = user_role("CreditManager");
                                            foreach ($roles as $role) {echo "<option value='$role[id]'>$role[firstName] $role[lastName]</option>";} ?>

                                            <?php $roles = user_role("CreditAnalyst");
                                            foreach ($roles as $role) { echo "<option value='$role[id]'>$role[firstName] $role[lastName]</option>";} ?>

                                            <?php $roles = user_role("Board");
                                            foreach ($roles as $role) { echo "<option value='$role[id]'>$role[firstName] $role[lastName]</option>";} ?>

                                            <?php $roles = user_role("LoanOfficer");
                                            foreach ($roles as $role) {if ($role['branch'] == $_SESSION['branch']){ echo "<option value='$role[id]'>$role[firstName] $role[lastName]</option>";}} ?>

                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>

                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Email Subject</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" type="text" placeholder = "Type Subject" value="<?php $data = loans("/".$_GET['loan_id']); echo $data["firstName"] ?> <?php echo $data["lastName"] ?> - $<?php echo $data["meetingLoanAmount"] ?>" name= "subject" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><b>Message :</b></label>
                                <textarea placeholder = "Type your message here" name= "message" class="form-control" required></textarea>
                                <input type="hidden"  name = "fullname" required="required" class="form-control" value="<?php echo $_SESSION['firstname'].'_'.$_SESSION['lastname']; ?>" >
                            </div>

                            <input class="form-control" type="hidden" name="loanId" required value="<?php echo $_GET['loan_id'] ?>">
                            <input class="form-control" type="hidden" name="userId" required value="<?php echo $_SESSION['userid'] ?>">
                            <input class="form-control" type="hidden" name="decisionBy" required value="<?php echo $_SESSION['userId'] ?>">
                            <input class="form-control" type="hidden" name="creditCommit" required value="management">
                            <input class="form-control" type="hidden" name="pipeline" value="bm_scheduled_meeting">
                            <button class="btn btn-info btn-lg" type = "submit" name= "final_meeting" >Submit for Recommendation (Head Office)</button>
                        </form>

                        <script>
                            const finalRadio = document.getElementById('finalRadio');
                            const recommendRadio = document.getElementById('recommendRadio');
                            const submitButton = document.getElementById('submitButton');
                            const form = document.getElementById('insert_form');

                            finalRadio.addEventListener('change', function() {
                                submitButton.style.display = 'block';
                                form.style.display = 'none';
                            });

                            recommendRadio.addEventListener('change', function() {
                                submitButton.style.display = 'none';
                                form.style.display = 'block';
                            });
                        </script>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php } elseif ($_GET['menu'] == 'mcc_final'){ ?>
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
                            Schedule MCC
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
                                            <li><b>Fullname</b>: <?php echo $loans["firstName"] ?> <?php echo $loans["lastName"] ?></li>
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
                        <b>Appraisal File (Excel Sheet)</b>
                        <div class="row">
                            <?php
                            $loan_id = $_GET['loan_id'];
                            include('../includes/forms/view_appraisal_file.php');?>
                        </div>

                        <br><br>
                        <b>Assessment Files by Loan Officer</b>
                        <div class="row">
                            <?php
                            $loan_id = $_GET['loan_id'];
                            include('../includes/forms/view_assessment_files.php');?>
                        </div>
                        <!--                        </div>-->
                    </div>

                    <div class="tab-pane fade" id="assign_task" role="tabpanel">

                        <form method="post" action="">
                            <table class="table table-striped table-bordered" id="table_field">
                                <tr>
                                    <th>Loan Amount ($)</th>
                                    <th>Tenure</th>
                                    <th>Interest Rate (%)</th>
                                    <th>On what basis</th>
                                    <th>Cash Handling Fee (%)</th>
                                    <th>Repayment Amount ($)</th>
                                    <th>Product</th>
                                    <th>R/N Client</th>
                                    <th>Upfront Fee (%)</th>
                                </tr>

                                <tr>
                                    <?php $data = loans('/'.$_GET['loan_id']) ?>
                                    <td><?php echo '$ '.$data['meetingLoanAmount'] ;?></td>
                                    <td><?php echo $data['meetingTenure'].' months' ;?></td>
                                    <td><?php echo $data['meetingInterestRate'].' %' ;?></td>
                                    <td><?php echo $data['meetingOnWhichBasis'] ;?></td>
                                    <td><?php echo $data['meetingCashHandlingFee'].' %' ;?></td>
                                    <td><?php echo '$ '.$data['meetingRepaymentAmount'] ;?></td>
                                    <td><?php echo $data['meetingProduct'] ;?></td>
                                    <td><?php echo $data['meetingRN'] ;?></td>
                                    <td><?php echo $data['meetingUpfrontFee'].' %' ;?></td>
                                    <!-- <td><input class="btn" type="button" id="delete" name="delete" value="delete" required></td> -->
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="txtLoanAmount"  min=0 required></td>
                                    <td>
                                        <select class="btn btn-clipboard" name="txtTenure" autocomplete="off" placeholder="" >
                                            <option value="0">Select</option>
                                            <option value="1">1 months</option>
                                            <option value="2">2 months</option>
                                            <option value="3">3 months</option>
                                            <option value="4">4 months</option>
                                            <option value="5">5 months</option>
                                            <option value="6">6 months</option>
                                            <option value="7">7 months</option>
                                            <option value="8">8 months</option>
                                            <option value="9">9 months</option>
                                            <option value="10">10 months</option>
                                            <option value="11">11 months</option>
                                            <option value="12">12 months</option>
                                        </select></td>
                                    <td><input class="form-control" type="text" name="txtInterestRate"  min=0 required></td>
                                    <td><select class="btn btn-clipboard" name="txtBasis" autocomplete="off" placeholder="" >
                                            <option value="reducing balance">reducing balance</option>
                                            <option value="fixed balance">fixed balance</option>
                                        </select></td>

                                    <td><input class="form-control" type="text" name="txtCashHandlingFee" placeholder="max 2%" min=0 max=2></td>
                                    <td><input class="form-control" type="text" name="txtRepaymentAmount" required></td>
                                    <td><select class="btn btn-clipboard" name="txtProduct" autocomplete="off" placeholder="" >
                                            <option value="CTF">CTF</option>
                                        </select></td>
                                    <td><select class="btn btn-clipboard" name="txtRN" autocomplete="off" placeholder="" >
                                            <option value="R">Repeat</option>
                                            <option value="N">New</option>
                                        </select>
                                    </td>

                                    <td><input class="form-control" type="text" name="txtUpfrontFee" required></td>
                                </tr>

                            </table>
                            <input class="form-control" type="hidden" name="loanId" required value="<?php echo $_GET['loan_id'] ?>">
                            <input class="form-control" type="hidden" name="userId" required value="<?php echo $_GET['userid'] ?>">
                            <input class="form-control" type="hidden" name="meetingFinalizedBy" required value="<?php echo $_SESSION['fullname'] ?>">
                            <button class="btn btn-success btn-lg btn-block" type = "submit" name= "set_parameters">Click To Update </button>
                            <br><br>
                        </form>

                        <form method="post" action="">
                            <table class="table table-striped table-bordered" id="table_field" >
                                <tr> <th>Conditions ( e.g Motor vehicle valued at 10000 ): </th> </tr>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="txtCollateral" required>
                                                <input class="form-control" type="hidden" name="loanId" required value="<?php echo $_GET['loan_id'] ?>">
                                                <input class="form-control" type="hidden" name="userId" required value="<?php echo $_GET['userid'] ?>">
                                                <input class="form-control" type="hidden" name="meetingFinalizedBy" required value="<?php echo $_SESSION['fullname'] ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-block btn-lg btn-success" type="submit" id="add" name="addCollateral" >Add To List</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $cnt = 1;
                                $collateral = collateral($_GET['loan_id']);
                                foreach($collateral as $row):
                                    ?>

                                    <tr>
                                        <td><?php echo $cnt.'. '.$row['collateral'] ;?></td>
                                    </tr>
                                    <?php
                                    $cnt++;
                                endforeach;?>
                            </table>
                        </form>

                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="finalRadio" name="radioSelection" class="custom-control-input" checked>
                            <label class="custom-control-label" for="finalRadio">Completed MCC</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="recommendRadio" name="radioSelection" class="custom-control-input">
                            <label class="custom-control-label" for="recommendRadio">Completed MCC (Add more comments)</label>
                        </div>

                        <form method="post" id="submitButton" action="">
                            <input class="form-control" type="hidden" name="loanId" required value="<?php echo $_GET['loan_id'] ?>">
                            <input class="form-control" type="hidden" name="userId" required value="<?php echo $_SESSION['userid'] ?>">
                            <input class="form-control" type="hidden" name="decisionBy" required value="<?php echo $_SESSION['userId'] ?>">
                            <input class="form-control" type="hidden" name="creditCommit" value="management">
                            <input class="form-control" type="hidden" name="pipeline" value="cc_final_meeting">
                            <button name= "final_predisbursement" class="btn btn-info btn-lg">Submit Final  Decision</button>
                        </form>

                        <form method="post" id="insert_form" action="" style="display: none;">
                            <div class="text-blue"><b>Submit MCC Decision </b></div>
                            <br>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Select Recipients</label>
                                <div class="col-sm-12 col-md-10">
                                    <select id="setCommit" onchange="chooseCommit()" class="custom-select2 form-control" name="recipientEmail" multiple="multiple" required style="width: 100%">
                                        <optgroup label="Select Attendees">
                                            <?php $roles = user_role("Operations");
                                            foreach ($roles as $role) {echo "<option value='$role[id]'>$role[firstName] $role[lastName]</option>";} ?>

                                            <?php $roles = user_role("CreditManager");
                                            foreach ($roles as $role) {echo "<option value='$role[id]'>$role[firstName] $role[lastName]</option>";} ?>

                                            <?php $roles = user_role("CreditAnalyst");
                                            foreach ($roles as $role) { echo "<option value='$role[id]'>$role[firstName] $role[lastName]</option>";} ?>

                                            <?php $roles = user_role("LoanOfficer");
                                            foreach ($roles as $role) {if ($role['branch'] == $_SESSION['branch']){ echo "<option value='$role[id]'>$role[firstName] $role[lastName]</option>";}} ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>

                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Email Subject</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" type="text" placeholder = "Type Subject" value="<?php $data = loans("/".$_GET['loan_id']); echo $data["firstName"] ?> <?php echo $data["lastName"] ?> - $<?php echo $data["meetingLoanAmount"] ?>" name= "subject" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><b>Message :</b></label>
                                <textarea placeholder = "Type your message here" name= "message" class="form-control" required></textarea>
                                <input type="hidden"  name = "fullname" required="required" class="form-control" value="<?php echo $_SESSION['firstname'].'_'.$_SESSION['lastname']; ?>" >
                            </div>

                            <input class="form-control" type="hidden" name="loanId" required value="<?php echo $_GET['loan_id'] ?>">
                            <input class="form-control" type="hidden" name="userId" required value="<?php echo $_SESSION['userid'] ?>">
                            <input class="form-control" type="hidden" name="decisionBy" required value="<?php echo $_SESSION['userId'] ?>">
                            <input class="form-control" type="hidden" name="creditCommit" required value="management">
                            <input class="form-control" type="hidden" name="pipeline" value="cc_final_meeting">
                            <button class="btn btn-info btn-lg" type = "submit" name= "final_meeting" >Submit Comments</button>
                        </form>

                        <script>
                            const finalRadio = document.getElementById('finalRadio');
                            const recommendRadio = document.getElementById('recommendRadio');
                            const submitButton = document.getElementById('submitButton');
                            const form = document.getElementById('insert_form');

                            finalRadio.addEventListener('change', function() {
                                submitButton.style.display = 'block';
                                form.style.display = 'none';
                            });

                            recommendRadio.addEventListener('change', function() {
                                submitButton.style.display = 'none';
                                form.style.display = 'block';
                            });
                        </script>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php } elseif ($_GET['menu'] == 'predisbursement'){ ?>
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
                            Process Ticket
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
                        <b>Appraisal File (Excel Sheet)</b>
                        <div class="row">
                            <?php
                            $loan_id = $_GET['loan_id'];
                            include('../includes/forms/view_appraisal_file.php');?>
                        </div>

                        <br><br>
                        <b>Assessment Files by Loan Officer</b>
                        <div class="row">
                            <?php
                            $loan_id = $_GET['loan_id'];
                            include('../includes/forms/view_assessment_files.php');?>
                        </div>
                        <!--                        </div>-->
                    </div>

                    <div class="tab-pane fade" id="assign_task" role="tabpanel">

                        <div class="card-body">
                            <h5 class="card-title text-blue" style="text-decoration: underline;">Pre-disbursement Ticket</h5>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="list-group-item"><b>Client Name</b>: <?= $loans["firstName"] ?> <?= $loans["lastName"] ?></a>
                                        <a class="list-group-item"><b>Loan Amount ($)</b>: <input class="form-control" type="text" name="meetingLoanAmount" autocomplete="off" value="<?php echo $loans['meetingLoanAmount']; ?>" required></a>
                                        <a class="list-group-item"><b>Less Fees ($)</b>: <input class="form-control" type="text" name="lessFees" autocomplete="off" value="<?php echo $loans['lessFees']; ?>" required></a>
                                        <a class="list-group-item"><b>Application Fee ($)</b>: <input class="form-control" type="text" name="applicationFee" autocomplete="off" value="<?php echo $loans['applicationFee']; ?>" required></a>
                                        <br/>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="list-group-item"><b>Cash Handling Fees ($)</b>: <input class="form-control" type="text" name="meetingCashHandlingFee" autocomplete="off" value="<?php echo $loans['meetingCashHandlingFee']; ?>" required></a>
                                        <a class="list-group-item"><b>Interest Rate (%)</b>: <input class="form-control" type="text" name="meetingInterestRate" autocomplete="off" value="<?php echo $loans['meetingInterestRate']; ?>" required> </a>
                                        <a class="list-group-item"><b>Repayment Amount ($)</b>:<input class="form-control" type="text" name="meetingRepaymentAmount" autocomplete="off" value="<?php echo $loans['meetingRepaymentAmount']; ?>" required></a>
                                        <a class="list-group-item"><b>Loan Officer</b>: <?= $loans["processedBy"] ?></a>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- <a class="list-group-item"><b style="padding-right: 95px;">Branch</b>: --><?php //= $data["branchName"] ?>
                                        <!-- </a> -->
                                        <a class="list-group-item"><b>Tenure (months)</b>: <input class="form-control" type="number" name="meetingTenure" autocomplete="off" value="<?php echo $loans['meetingTenure']; ?>" required></a>
                                        <a class="list-group-item"><b>Product</b>: <?= $loans["meetingProduct"] ?></a>
                                        <a class="list-group-item"><b>R/N</b>: <?= $loans["meetingRN"] ?></a>
                                        <a class="list-group-item"><b>Upfront Fees</b>: <input class="form-control" type="text" name="meetingUpfrontFee" autocomplete="off" value="<?php echo $loans['meetingUpfrontFee']; ?>"></a>
                                    </div>
                                </div>
<!--                                <div class="row">-->
<!--                                    <div class="col-md-4">-->
<!--                                        <a class="list-group-item"><b>Client Name</b>: --><?php //= $loans["firstName"] ?><!-- --><?php //= $loans["lastName"] ?><!--</a>-->
<!--                                        <a class="list-group-item"><b>Loan Amount</b>: --><?php //= "$ ".$loans["meetingLoanAmount"].".00" ?><!--</a>-->
<!--                                        <a class="list-group-item"><b>Less Fees</b>: <input class="form-control" type="text"  name="lessFees" autocomplete="off" placeholder="--><?php //echo $loans['lessFees']; ?><!--" required ></a>-->
<!--                                        <a class="list-group-item"><b>Application Fee</b>: <input class="form-control" type="text"  name="applicationFee"  placeholder="--><?php //echo $loans['applicationFee']; ?><!--" autocomplete="off"  required ></a>-->
<!--                                        <br/>-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="col-md-4">-->
<!--                                        <a class="list-group-item"><b>Cash Handling Fees</b>: --><?php //= "$ ". $loans["meetingCashHandlingFee"].".00" ?><!--</a>-->
<!--                                        <a class="list-group-item"><b>Interest Rate</b>: --><?php //= $loans["meetingInterestRate"]."%"  ?><!--</a>-->
<!--                                        <a class="list-group-item"><b>Repayment Amount</b>: --><?php //= $loans["meetingRepaymentAmount"] ?><!--</a>-->
<!--                                        <a class="list-group-item"><b>Loan Officer</b>: --><?php //= $loans["processedBy"]?><!--</a>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-4">-->
<!--    <!--                                    <a class="list-group-item"><b style="padding-right: 95px;">Branch</b>: --><?php ////= $data["branchName"] ?><!--</a>-->
<!--                                        <a class="list-group-item"><b>Tenor</b>: --><?php //= $loans["meetingTenure"]." months" ?><!--</a>-->
<!--                                        <a class="list-group-item"><b>Product</b>: --><?php //= $loans["meetingProduct"] ?><!--</a>-->
<!--                                        <a class="list-group-item"><b>R/N</b>: --><?php //= $loans["meetingRN"]  ?><!--</a>-->
<!--                                        <a class="list-group-item"><b>Upfront Fees</b>: --><?php //= $loans["meetingUpfrontFee"]."%"?><!--</a>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="row">
                                    <div class="col-md-12">
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
                                </div>
                                <br/>
                                <input class="form-control" type="hidden" name="fullName" required value="<?php echo $_SESSION['fullname'] ?>">
                                <input class="form-control" type="hidden" name="loanId" required value="<?php echo $_GET['loan_id'] ?>">
                                <input class="btn btn-success btn-lg" type = "submit" value = "Update Ticket Info" name= "update_ticket" id = "submit">
                                <select class="form-control" name="bocoSignature" hidden autocomplete="off">
                                    <option value="Signed">Authorise</option>
                                    <option value="Unsigned">Decline</option>
                                </select>
                                <br><br/>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

<?php } else{
    header('location:loan_info.php?menu=loan&loan_id='.$_GET['loan_id'].'&userid='.$_GET['userid']);
} ?>