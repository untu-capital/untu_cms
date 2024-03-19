<?php
$errors = array();

// Escape user inputs for security
if(isset($_POST['Submit'])){

    $comments = $_POST['comments'];
    $status = $_POST['status'];
    $id=$_POST['id'];

    $url = "http://localhost:7878/api/utg/followUpDiary";

    $data_array = array(

        'clientID' => $id,
        'loanOfficerName'=>" urelia ",
        'clientName'=> " Christa ",
        'clientContactNumber' => " 0784315526 ",
        'clientContactEmail' => " kiki@gmail.com ",
        'followUpStatus' => $status,
        'followUpComments' => $comments,
        'clientBusinessAddress' => " urelia ",

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
            case 201:  # OK redirect to dashboard
                $url = "http://localhost:7878/api/utg/marketLeads/status/".$id;

                $data_array = array(
                    'followUpStatus' => $status,
                );

                $data = json_encode($data_array);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                $resp = curl_exec($ch);
                curl_close($ch);

                $_SESSION['info'] = "Success";
                header('location: ongoing-clients.php');
                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    //echo $key . ': ' . $val . '<br>';
                }
                // echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                header('location: ongoing-clients.php');
                break;

            case 401: # Unauthorixed - Bad credientials
                $_SESSION['error'] = 'Application failed.. Please try again!';
                header('location: lead-management.php');

                break;
            default:
                $_SESSION['error'] = 'Not able to Update Lead'. "\n";
                header('location: lead-management.php');
        }
    } else {
        $_SESSION['error'] = 'Application failed.. Please try again!'. "\n";
        header('location: lead_management.php');

    }
//    curl_close($ch);
    ?>


<?php

//    require_once '../dbconnect.php';
//    $decoded = json_decode($resp, true);
//
//    $activity = " Successfully added lead" ;
//    $ip =  $_SERVER['REMOTE_ADDR'];
//    $device= $_SERVER['HTTP_USER_AGENT'];
//    $time_logged =date('Y-m-d H:i:s');
//    $stmt=$conn->prepare('insert into activity(time_logged,user_id,activity,name,ip,device,role,branch)VALUES(?,?,?,?,?,?,?,?)');
//    $stmt->bindparam(1,$time_logged);
//    $stmt->bindparam(2,$_SESSION['userId']);
//    $stmt->bindparam(3,$activity);
//    $stmt->bindparam(4,$_SESSION['fullname']);
//    $stmt->bindparam(5,$ip);
//    $stmt->bindparam(6,$device);
//    $stmt->bindparam(7,$_SESSION['role']);
//    $stmt->bindparam(8,$_SESSION['branch']);
//
//    $stmt->execute();
}

?>
<!-- table widget -->

<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">
            <?php if ($_SESSION['role'] == "ROLE_LO"){ ?>
            Manage my Leads
            <?php } else {
                echo "Recent Leads";} ?>
        </h4>
    </div>
    <div class="pd-20" >
        <?php if ($_SESSION['role'] == "ROLE_LO") { ?>
            <form action="lead_management.php?menu=add_lead" method="post">
                <button class="btn btn-lg btn-primary" type="submit" name="add_lead">Add New Lead</button>
            </form>
        <?php } ?>

    </div>
    <div class="pb-20">
        <table class="table hover table stripe multiple-select-row data-table-export nowrap">
            <thead>
            <tr>
                <th>Creation Date</th>
                <th>Lead Name</th>
                <th>Phone Number</th>
                <th>Area/Place</th>
                <th>Branch</th>
                <th>Nature of Business</th>
                <th>Potential Loan Amount</th>
                <th>Status</th>
                <th class="datatable-nosort">Action</th>
            </tr>
            </thead>
            <tbody>
                <?php $leads_url = "";
                if ($_SESSION['role'] == "ROLE_BM"){
                    $leads_url = "/branch/".str_replace(" ","%20",$_SESSION['branch']);
                } elseif ($_SESSION['role'] == "ROLE_LO"){
                    $leads_url = "/loanOfficer/".$_SESSION['userId'];
                }
                $leads = leads($leads_url);
                foreach($leads as $data):?>
                    <tr>
                        <td><?php echo date('d-M-Y', strtotime($data['createdAt'])) ?></td>
                        <td><?= htmlspecialchars ($data["clientName"]) ?></td>
                        <td><?= htmlspecialchars ($data["contactNumber"]) ?></td>
                        <td><?= htmlspecialchars ($data["location"]) ?></td>
                        <td class="table-plus"><?= htmlspecialchars ($data["branchName"]) ?></td>
                        <td><?= htmlspecialchars ($data["natureOfBusiness"]) ?></td>
                        <td><?= htmlspecialchars ('$ ' . number_format($data["potentialLoanAmount"], 2, '.', ',')) ?></td>

                        <td>
                            <?= htmlspecialchars ($data["followUpStatus"]) ?></span> -->

                            <?php if ($data["followUpStatus"] =="won") {
                                echo "<label style='padding: 7px;' class='badge badge-success'>Qualified</label>";
                            } else if ($data["followUpStatus"] =="lost") {
                                echo "<label style='padding: 7px;' class='badge badge-danger'>Failed</label>";
                            } else  {
                                echo "<label style='padding: 7px;' class='badge badge-warning'>In-Progress</label>";
                            }
                            ?>
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <?php if ($_SESSION['role'] == "ROLE_LO"){ ?>
                                        <a class="dropdown-item" href="lead_management.php?menu=main&id=<?=$data["id"] ?>" data-backdrop="static" data-toggle="modal" data-target="#login-modal"><i class="dw dw-edit-file"></i> Follow-Up Comments</a>
                                        <a class="dropdown-item" href="lead_management.php?menu=edit_lead&id=<?=$data["id"] ?>"><i class="dw dw-edit2"></i> Edit Lead</a>
                                    <?PHP } ?>
                                    <a class="dropdown-item" href="view_lead.php?id=<?=$data["id"] ?>"><i class="dw dw-eye"></i> View</a>
                                    <a class="dropdown-item" href="view_lead.php?id=<?=$data["id"] ?>"><i class="dw dw-delete-3"></i> Delete</a>
                                </div>

                                <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="login-box bg-white box-shadow border-radius-10">
                                                <div class="login-title">
                                                    <h2 class="text-center text-primary">
                                                        Follow-Up Comments
                                                    </h2>
                                                </div>
                                                <form action="" method="POST">
                                                    <div class="select-role">
                                                        <div class="btn-group btn-group-toggle" data-toggle="buttons"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Follow Up Comments :</label>
                                                        <textarea class="form-control"id= "comments" name="comments"></textarea>
                                                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $data["id"] ?>" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Follow Up Status :</label>
                                                        <select class="custom-select form-control" id= "status" name="status">
                                                            <option value="won">Lead Qualify</option>
                                                            <option value="ongoing">Still in Progress</option>
                                                            <option value="lost">Lead Failed</option>
                                                        </select>
                                                    </div>
                                                    <div class="row pb-30">
                                                        <div class="col-6">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck1"/>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-danger" value="Submit" name="Submit">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<script src="../../vendors/scripts/core.js"></script>
<script src="../../vendors/scripts/script.min.js"></script>
<script src="../../vendors/scripts/process.js"></script>
<script src="../../vendors/scripts/layout-settings.js"></script>
<!--  -->
<!-- Google Tag Manager (noscript) -->
<noscript
><iframe
        src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
        height="0"
        width="0"
        style="display: none; visibility: hidden"
    ></iframe
    ></noscript>

