<?php
include('../session/session.php');
include ('check_role.php');
include('../includes/controllers.php');
$nav_header = "Cash Management Dashboard";

$state = $_GET['state'];
$userId = $_SESSION['userId'];
$branch = $_SESSION['branch'];

if(isset($_POST['Branch'])){
    $name = $_POST['name'];
    $status = $_POST['status'];
    $code = $_POST['code'];
    $direction = $_POST['direction'];
    $google = $_POST['google'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $branchcode = $_POST['branchcode'];
    $vault = $_POST['vault'];

    $url = "http://localhost:7878/api/utg/branches/addBranch";

    $data_array = array(

        'branchName'=> $name,
        'branchStatus' => $status,
        'branchAddress'=> $address,
        'branchTellPhone' => $phone,
        'googleMap'=> $google,
        'direactionsLink' => $direction,
        'code'=> $code,
        'vaultAccountNumber'=> $vault,
        'branchCode'=> $branchcode



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
            case 200:
                header('Location: cash_management.php?menu=main');# OK redirect to dashboard


                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    //echo $key . ': ' . $val . '<br>';
                }
                // echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                header('location: cash_management.php?menu=main');
                break;

            case 401: # Unauthorixed - Bad credientials
                $_SESSION['error'] = 'Application failed.. Please try again!';
                header('location: cash_management.php?menu=main');

                break;
            default:
                $_SESSION['error'] = 'Not able to create Category'. "\n";
                header('location: cash_management.php?menu=main');
        }
    } else {
        $_SESSION['error'] = 'Application failed.. Please try again!'. "\n";
        header('location: cash_management.php?menu=main');

    }
    curl_close($ch);
}


//UPDATE BRANCH
function updateBranch($id, $address, $phone,$status, $name, $code, $branchcode, $vault){

    $url = "http://localhost:7878/api/utg/branches/update/".$id;
    $data_array = array(
        'branchName' => $name,
        'branchAddress' => $address,
        'branchTellPhone' => $phone,
        'branchStatus' => $status,
        'branchCode' => $branchcode,
        'code' => $code,
        'vaultAccountNumber' => $vault,


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

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // convert headers to array
    $headers = headersToArray( $headerStr );

    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard
                $_SESSION['info'] = "Industry Updated Successfully!";
                audit($_SESSION['userid'], "Updated Category! - ".$id, $_SESSION['branch']);
                header('location: cash_management.php?menu=main');
                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    echo $key . ': ' . $val . '<br>';
                }
                echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                audit($_SESSION['userid'], "Failed to Update Branch! - ".$id, $_SESSION['branch']);
                header('location: cash_management.php?menu=main');
                break;
            default:
                $_SESSION['error'] = 'Could not update Branch '. "\n";
                audit($_SESSION['userid'], "Failed to Update Branch! - ".$id, $_SESSION['branch']);
                header('location: cash_management.php?menu=main');
        }
    } else {
        $_SESSION['error'] = 'Update failed.. Please try again!'. "\n";
        audit($_SESSION['userid'], "Failed to Update Branch! - ".$id, $_SESSION['branch']);
        header('location: cash_management.php?menu=main');
    }
    curl_close($ch);
}
if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['branchName'];
    $status = $_POST['status'];
    $address = $_POST['branchAddress'];
    $phone = $_POST['branchTellPhone'];
    $code = $_POST['code'];
    $branchcode = $_POST['branchcode'];
    $vault = $_POST['vault'];

    updateBranch($id, $address, $phone,$status, $name, $code, $branchcode, $vault);
}

//update Authrities
function updateAuthorities($id, $branch, $authlevel,$name){

    echo $id;
    echo

    $url = "http://localhost:7878/api/utg/cms/cms_authorisation/update/".$id;
    $data_array = array(
        'branchId' => $branch,
        'authLevel' => $authlevel,
        'userId' => $name,

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

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // convert headers to array
    $headers = headersToArray( $headerStr );

    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard
                $_SESSION['info'] = "Authorisationd Updated Successfully!";
                audit($_SESSION['userid'], "Updated Authorisation! - ".$id, $_SESSION['branch']);
                header('location: cash_management.php?menu=main');
                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    echo $key . ': ' . $val . '<br>';
                }
                echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                audit($_SESSION['userid'], "Failed to Update Authorisation! - ".$id, $_SESSION['branch']);
                header('location: cash_management.php?menu=main');
                break;
            default:
                $_SESSION['error'] = 'Could not update Branch '. "\n";
                audit($_SESSION['userid'], "Failed to Update Authorisation! - ".$id, $_SESSION['branch']);
                header('location: cash_management.php?menu=main');
        }
    } else {
        $_SESSION['error'] = 'Update failed.. Please try again!'. "\n";
        audit($_SESSION['userid'], "Failed to Update Authorisation! - ".$id, $_SESSION['branch']);
        header('location: cash_management.php?menu=main');
    }
    curl_close($ch);
}
if(isset($_POST['update_auth'])) {
    $id = $_POST['id'];
    $branch = $_POST['update_branch'];
    $authlevel = $_POST['role'];
    $name = $_POST['update_name'];

    updateAuthorities($id, $branch, $authlevel,$name);
}



?>

<!DOCTYPE html>
<html>

<style>
    /* Styles for the popup message */
    .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #ffffff;
        padding: 20px;
        border: 1px solid #ccc;
        box-shadow: 0px 0px 10px #000;
        z-index: 9999;
    }
</style>
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
    <div class="pd-ltr-20">

        <?php include('../includes/dashboard/topbar_widget.php'); ?>

        <?php if ($_GET['menu'] == "main"){ ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('success')) {
                        // Display a popup or alert message
                        alert('Deleted successfully');
                    }
                });
            </script>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="pd-20 card-box">
                    <h5 class="h4 text-blue mb-20">Cash Management</h5>
                    <div class="tab">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#acc_balance" role="tab" aria-selected="true">Account Balances</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pending" role="tab"
                                   aria-selected="false">Pending Trans Vouchers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#approved" role="tab"
                                   aria-selected="false">Approved Trans Vouchers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#revise" role="tab"
                                   aria-selected="false">Revise Trans Vouchers</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#po_payments" role="tab"
                                   aria-selected="false">P.O Payments</a>
                            </li>

<!--                            <li class="nav-item">-->
<!--                                <a class="nav-link" data-toggle="tab" href="#cash_receipts" role="tab" aria-selected="false">Cash Receipts (Musoni - Pastel)</a>-->
<!--                            </li>-->
<!---->
<!--                            <li class="nav-item">-->
<!--                                <a class="nav-link text-blue" data-toggle="tab" href="#cash_trans_voucher" role="tab" aria-selected="false">-->
<!--                                    Cash Transactions Voucher-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li class="nav-item">-->
<!--                                <a class="nav-link" data-toggle="tab" href="#vault_auth" role="tab" aria-selected="false">Vaults Authorization</a>-->
<!--                            </li>-->
<!--                            <li class="nav-item">-->
<!--                                <a class="nav-link text-blue" data-toggle="tab" href="#authorisers" role="tab" aria-selected="false">-->
<!--                                    Branch Authorizers-->
<!--                                </a>-->
<!--                            </li>-->

                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#vaults" role="tab" aria-selected="false">
                                    Manage Vaults
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#auditTrail" role="tab" aria-selected="false" >
                                    Audit Trail
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="acc_balance" role="tabpanel">
                                <div class="pd-20">
                                    <?php include('../includes/dashboard/cms_acc_balance_widget.php'); ?>
                                </div>
                            </div>

                            <div class="tab-pane fade row" id="pending" role="tabpanel">
                                <?php $approvalStatus = "PENDING"; include('../includes/tables/cash_management/finance_transaction_vouchers.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="approved" role="tabpanel">
                                <?php $approvalStatus = "APPROVED"; include('../includes/tables/cash_management/finance_transaction_vouchers.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="revise" role="tabpanel">
                                <?php $approvalStatus = "REVISE"; include('../includes/tables/cash_management/finance_transaction_vouchers.php'); ?>
                            </div>

                            <div class="tab-pane fade" id="po_payments" role="tabpanel">
<!--                                --><?php //include('../includes/tables/cash_management/list-petty-cash.php'); ?>


                                <?php
                                    $req_status = "Waiting for Approval";
                                    $requisitionsUrl = "/financeApproval";
                                include('../includes/tables/purchase_order/requisitions_table.php'); ?>


                                <?php
                                    $req_status = "Approved / Declined";
                                    $requisitionsUrl = "/approvedByFinance";
                                include('../includes/tables/purchase_order/requisitions_table.php'); ?>
                            </div>
<!--                            <div class="tab-pane fade row" id="cash_receipts" role="tabpanel">-->
<!--                                --><?php //include('../includes/tables/cash_management/cash_receipts.php'); ?>
<!--                            </div>-->

<!--                            <div class="tab-pane fade" id="cash_trans_voucher" role="tabpanel">-->
<!--                                --><?php //include('../includes/tables/cms/cash_transactions.php'); ?>
<!--                            </div>-->

                            <div class="tab-pane fade" id="vault_auth" role="tabpanel">
                                <form method="post" action="">
                                    <div class="row">
                                        <div class="pd-20 col-4">
                                            <div class="form-group">
                                                <br>
                                                <label>Select User :</label>
                                                <select id="userSelect" class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="user" style="width: 100%; height: 38px">
                                                    <optgroup label="Pick a user">
                                                        <?php
                                                        $users = untuStaff();
                                                        foreach ($users as $user) {
                                                            echo "<option value='$user[id]'>$user[firstName] $user[lastName]</option>";
                                                        } ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="pd-20 col-2">
                                            <div class="form-group">
                                                <br>
                                                <label>Select Vault Type :</label>
                                                <select id="vaultTypeSelect" class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="vault_type" style="width: 100%; height: 38px">
                                                    <!--                                               <optgroup label="Select Vault Type">-->
                                                    <option value="" >Select Vault Type</option>
                                                    <option value="Petty Cash">Petty Cash</option>
                                                    <option value="Internal Vault">Internal Vault</option>
                                                    <option value="External Vault">External Vault</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="pd-20 col-4">
                                            <div class="form-group">
                                                <br>
                                                <label>Select Vault Account :</label>
                                                <select id="vaultSelect" class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="vault_acc" style="width: 100%; height: 38px">
                                                    <optgroup label="Select Vault Account">
                                                        <?php
                                                        $vaults = vaults('all');
                                                        foreach ($vaults as $vault) {
                                                            echo "<option value='$vault[id]'>$vault[name] ($vault[account])</option>";
                                                        } ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-2 pd-20 form-group">
                                            <br>
                                            <label>.</label>
                                            <!--                                        <input class="form-control" type="hidden" name="userid" required value="--><?php //echo $_SESSION['userid'] ?><!--">-->
                                            <button type="submit" name="add_vault_permissions" class="btn btn-success btn-lg btn-block">Grant Permission</button>
                                        </div>
                                    </div>
                                </form>
                                <?php include('../includes/tables/cms_permissions_table.php'); ?>
                            </div>

                            <div class="tab-pane fade" id="vaults" role="tabpanel">
                                <?php include('../includes/tables/cash_management/list_vaults.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="auditTrail" role="tabpanel">
                                <?php include('../includes/tables/cash_management/list-audit-trail.php'); ?>
                            </div>


                            <div class="tab-pane fade" id="authorisers" role="tabpanel">
                                <?php include('../includes/tables/cms/authorisers_table.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } elseif ($_GET['menu'] == "add_branch") {?>


            <div class="pd-20 card-box mb-30">

                <div class="wizard-content">

                    <form action="" method="POST" id="myForm">
                        <div class="clearfix">
                            <h4 class="text-blue h4">Branch</h4>

                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Branch Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Branch Address <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                                    <input type="text" class="form-control" name="address" id="address" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Branch Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">

<!--                                    <label>Status <i class="mdi mdi-subdirectory-arrow-left:"></i></label>-->
<!--                                    <input type="text" class="form-control" name="status" id="status" required>-->
                                    <div class="form-group">
                                        <label>Select Status :</label>
                                        <select class="custom-select form-control">
                                            <option value="">Select Status</option>
                                            <option value="Active" name="status" id="status">Active</option>
                                            <option value="Disabled" name="status" id="status">Disabled</option>

                                        </select>
                                    </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Code Number</label>
                                    <input type="number" class="form-control" name="code" id="code" required>

                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Branch Code</label>
                                    <input type="text" class="form-control" name="branchcode" id="branchcode" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Vault Acc Number</label>
                                    <input type="text" class="form-control" name="vault" id="vault" required>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                        <div class="col-md-1 col-sm-12">

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" value="Branch" name="Branch">Submit</button>
                            </div>
                        </div>

                            <div class="col-md-1 col-sm-12">

                                <div class="form-group">
                                    <button  class="btn btn-primary"onclick="goBack()">Cancel</button>
                                </div>
                            </div>

                        </div>
                    </form>
                    <script>
                        // JavaScript function to go back to the previous page
                        function goBack() {
                            window.history.back();
                        }
                    </script
                </div>
            </div>
        <?php }

        elseif ($_GET['menu'] == "edit_branch") {?>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="personal_info" role="tabpanel">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="card card-box ">
                                <div class="card-body"><h5 class="card-title text-blue" style="text-decoration: underline;">Personal Information</h5>
                                    <p class="card-text">
                                        <?php $loans = loans('/'.$_GET['loan_id']); ?>
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
                </div>
            </div>
        <?php }
        elseif ($_GET['menu'] == "edit_authorities") {?>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="pd-20 card-box">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                        <div class="pd-20 card-box">
                            <div class="pd-20 card-box mb-30">
                                <div class="clearfix">
                                    <h4 class="text-blue h4">Edit Branch Vault Access</h4>
                                </div>
                                <div class="wizard-content">

                                    <form action="" method="POST">
                                        <?php  $auth_by_id = authorisation('/'.$_GET['id']); ?>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Branch Name</label>
                                                    <select id="branch" class="custom-select2 form-control" name="update_branch" style="width: 100%; height: 38px">
                                                        <?php
                                                            $branch = branch_by_id($auth_by_id['branchId']);
                                                            echo "<option value='$branch[id]'>$branch[branchName] Branch</option>";
                                                            $branches = branch();
                                                            foreach ($branches as $branch) {
                                                                echo "<option value='$branch[id]'>$branch[branchName] Branch</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Authentication Level <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                                                    <select class="custom-select form-control" name="role">
                                                        <option value="<?=$auth_by_id['authLevel'] ?>"> <?=$auth_by_id['authLevel'] ?></option>
                                                        <option value="Initiator" name="role" >Initiator</option>
                                                        <option value="First Approver" name="role" >First Approver</option>
                                                        <option value="Second Approver" name="role" >Second Approver</option>
                                                    </select>                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Name <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
<!--                                                    <input type="text" class="form-control" name="name" value="--><?php //$user = user($auth_by_id['userId']); echo $user['firstName'].' '.$user['lastName'] ?><!--" id="name" required>-->
                                                    <select id="name" class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="update_name" style="width: 100%; height: 38px" required>
                                                        <optgroup label="select user">
                                                            <?php
                                                                $user = user($auth_by_id['userId']);
                                                                echo "<option value='$user[id]'>$user[firstName] $user[lastName]</option>";
                                                                $users = untuStaff();
                                                                foreach ($users as $user) {
                                                                    echo "<option value='$user[id]'>$user[firstName] $user[lastName]</option>";
                                                                }
                                                                ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" value="<?=$auth_by_id['id'] ?>" name="id" id="id" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger" value="auth" name="update_auth">Update</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        elseif ($_GET['menu'] == "add_zones") {?>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="pd-20 card-box">
                    <?php include('../includes/forms/create_zones.php'); ?>
                </div>
            </div>
        <?php }
        elseif ($_GET['menu'] == "add_sectors") {?>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="pd-20 card-box">
                    <?php include('../includes/forms/create_sectors.php'); ?>
                </div>
            </div>

        <?php }elseif ($_GET['menu'] == 'add_vault'){?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Add Vault</h4>
                    </div>
                </div>
                <form method="POST" action="">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Account</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="account" placeholder="Vault Account" required/></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="name" placeholder="Vault Name" required/></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Type</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select2 form-control" name="type" style="width: 100%; height: 38px">
                                <optgroup label="Select Vault Type">
                                    <option value="" >Select Vault Type</option>
                                    <option value="Petty Cash">Petty Cash</option>
                                    <option value="Internal Vault">Internal Vault</option>
                                    <option value="External Vault">External Vault</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Branch</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select2 form-control" name="branch" style="width: 100%; height: 38px">
                                <optgroup label="Branches">
                                    <option value="" >Select Branch</option>
                                    <?php
                                    $branches = branch();
                                    foreach ($branches as $branch):?>
                                        <option value="<?php echo $branch['id']; ?>"><?php echo $branch['branchName']; ?></option>
<!--                                    <option>Harare</option>-->
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button class="btn btn-success" type="submit" name="create_vault">Save</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="cash_management.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>

        <?php }elseif ($_GET['menu'] == 'update_vault'){ ?>

            <?php
            $id = $_GET['vaultId'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/vault/get/" . $id);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_response = curl_exec($ch);

            curl_close($ch);
            $data = json_decode($server_response, true);
            // Check if the JSON decoding was successful
            if ($data !== null) {
                $table = $data;

            }
            else {
                echo '<script>window.location.href = "cash_management.php?menu=main#vaults";</script>';
                echo "Error decoding JSON data";
            }

            if (isset($_POST['vault'])) {
                // API endpoint URL
                $url = "http://localhost:7878/api/utg/cms/vault/update/max-amount/$_POST[id]/$_POST[maxAmount]";
                // Data to send in the POST request
                $postData = array(
                    'id' => $_POST['id'],
                );

                $data = json_encode($postData);
                echo $data;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

                // Execute the POST request and store the response in a variable
                $response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'Curl error: ' . curl_error($ch);
                }
                // Close cURL session
                curl_close($ch);


            }
            ?>

            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Update Vault</h4>
                    </div>
                </div>
                <form method="POST" action="cash_management.php?menu=update_vault">
                    <input name="id" value="<?php echo $table['id'] ?>" hidden="hidden">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Account</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="account" placeholder="Vault Account" value="<?php echo $table['account'] ?>" disabled/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="vaultName" placeholder="Vault Account" value="<?php echo $table['name'] ?>" disabled/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Type</label>
                        <div class="col-sm-12 col-md-10">
                            <select
                                    class="custom-select2 form-control"
                                    name="type"
                                    style="width: 100%; height: 38px"
                                    disabled
                            >
                                <optgroup label="Types">
                                    <option value="<?php echo $table['type'] ?>" ><?php echo $table['type'] ?></option>
                                    <option value="Petty Cash">Petty Cash</option>
                                    <option value="Internal Vault">Internal Vault</option>
                                    <option value="External Vault">External Vault</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Branch</label>
                        <div class="col-sm-12 col-md-10">
                            <select
                                    class="custom-select2 form-control"
                                    name="branch"
                                    style="width: 100%; height: 38px"
                                    disabled
                            >
                                <optgroup label="Branches">
                                    <option value="<?php echo $table['branch']['id'] ?>" ><?php echo $table['branch']['branchName'] ?></option>
                                    <?php foreach ($branches as $branch):?>
                                        <option value="<?php echo $branch['id']; ?>"><?php echo $branch['branchName']; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Set Cash Limit</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="number" name="maxAmount" placeholder="Enter Limit amount" value="<?php echo $table['maxAmount'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button class="btn btn-success" type="submit" name="vault">Update</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="cash_management.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
            <!-- Default Basic Forms End -->

        <?php } elseif ($_GET['menu'] == 'approve') {
        if (isset($_POST['approve'])) {
            // API endpoint URL
            $url = "http://localhost:7878/api/utg/cms/petty-cash-payments/".$_POST['id'];
            // Data to send in the POST request
            $postData = array(
                'id' => $_POST['id'],
                'secondApprover' => $_SESSION['userId'],
                'status' => "Approved",
                'notes' => $_POST['notes'],
                'fromAccount' => "8000/0009/HRE/FCA",
                'toAccount' => "3000/8988/EXP/HO"
            );

            $data = json_encode($postData);
//              echo $data;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

            // Execute the POST request and store the response in a variable
            $resp = curl_exec($ch);

            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $headerStr = substr($resp, 0, $headerSize);
            $bodyStr = substr($resp, $headerSize);

            // Check for cURL errors
            if (!curl_errno($ch)) {
                switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                    case 200:

                        echo '<script>alert("Approve Successful");</script>';


//POST TO Pastel
                        $url = "http://localhost:7878/api/utg/cms/Pastel/".$_POST['id'];
                        // Data to send in the POST request
                        $postData = array(
                            'id' => $_POST['id'],
                            'ToAccount' =>"8422/000/GWE/FCA",
                            'TransactionType' => "PO-TRANS",
                            'ExchangeRate' => "1",
                            'Description' => "Repayment Transaction",
                            'FromAccount' =>"8000/000/HO/LR",
                            'Reference' =>"RP{transId}",
                            'Currency' =>"001",
                            'Amount' =>"4000.0",
                            'APIPassword' =>"Admin",
                            'APIUsername' => "Admin",
                            'TransactionDate'=>"13-Sep-2023"

                        );

                        $data = json_encode($postData);
//              echo $data;
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HEADER, true);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

                        // Execute the POST request and store the response in a variable
                        $resp = curl_exec($ch);

                        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                        $headerStr = substr($resp, 0, $headerSize);
                        $bodyStr = substr($resp, $headerSize);

                        // Check for cURL errors
                        if (!curl_errno($ch)) {
                            echo 'Curl error: ' . curl_error($ch);
                        }
                        // Close cURL session
                        curl_close($ch);

                        header('Location: cash_management.php?menu=main');
                        break;

                    case 400:  # Bad Request
                        $decoded = json_decode($bodyStr);
                        foreach($decoded as $key => $val) {
                            //echo $key . ': ' . $val . '<br>';
                        }
                        // echo $val;
                        $_SESSION['error'] = "Failed. Please try again, ".$val;
                        header('location: cash_management.php?menu=main');
                        break;

                    case 401: # Unauthorixed - Bad credientials
                        $_SESSION['error'] = ' Failed.. Please try again!';
                        header('location: cash_management.php?menu=main');

                        break;
                    default:
                        $_SESSION['error'] = 'Not able to Approve'. "\n";
                        header('location: cash_management.php?menu=main');
                }
            }

            else {
                $_SESSION['error'] = 'Failed.. Please try again!'. "\n";
                header('location: cash_management.php?menu=main');

            }
            // Close cURL session
            curl_close($ch);


        }
        ?>

            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Purchase Order</h4>
                    </div>
                </div>
                <form method="POST" action="cash_management.php?menu=approve">
                    <?php  $petty = requisitions('/'.$_GET['id']);

                    $transactionCount = count(req_trans("/getByRequisitionId/".$_GET['id'])); // Calculate the total count of transactions
                    $totalAmount = 0; // Initialize the total amount variable

                    foreach (req_trans("/getByRequisitionId/".$_GET['id']) as $transaction) {
                        // Check if 'poAmount' key exists before accessing it
                        if (isset($transaction['poAmount'])) {
                            $totalAmount += (int)$transaction['poAmount']; // Sum up the transaction amounts (cast to integer for numeric addition)
                        }
                    }

                    ?>
                    <input name="id" value="<?php echo $_GET['id'] ?>" hidden="hidden">

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <h1>Prepared-By: </h1>
                                <h3><?php $user = user($petty['userId']); echo $user['firstName'].' '.$user['lastName'];?> </h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <h1>PO-Number: </h1>
                                <h3><?=$petty['poNumber']?> </h3>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12">
                            <div class="form-group">
                                <h1>Po Approved By : </h1>
                                <h3> <?php $user = user($petty['poApprover']); echo $user['firstName'].' '.$user['lastName'];?></h3>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Requisition Name</label>
                                <input type="text" disabled class="form-control" value="<?=$petty['poName'] ?>" name="poName" id="poName" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Requisition Date <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                                <input type="text" disabled class="form-control" name="date" value="<?= date('d-M-Y H:i', strtotime($petty['createdAt'])) ?>" id="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Transaction</label>
                                <input type="text" disabled class="form-control" value="PO-TRANS" name="transType" id="transType">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Total <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                                <input type="text" class="form-control" name="amount" disabled value="$ <?php echo number_format($totalAmount, 2); ?>" id="amount" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <input type="hidden" disabled class="form-control" value="<?=$petty['id'] ?>" name="id" id="id" required>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Additional Notes</label>
                        <textarea class="form-control" name="notes" id="notes"></textarea>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button class="btn btn-success" type="submit" name="approve">Approve</button>
                        </div>

                    </div>

                </form>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'delete_vault'){ ?>

            <?php
            $id = $_GET['vaultId'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/vault/delete/". $id);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

            $server_response = curl_exec($ch);

            curl_close($ch);
            $data = json_decode($server_response, true);

            if ($data !== null) {
                $table = $data;

            } else {
                echo '<script>window.location.href = "cash_management.php?menu=main";</script>';
                echo "Error decoding JSON data";
            }
            ?>

        <?php }

        ?>

        <?php include('../includes/footer.php');?>
    </div>
</div>

<!-- js -->
<script src="../vendors/scripts/core.js"></script>
<script src="../vendors/scripts/script.min.js"></script>
<script src="../vendors/scripts/process.js"></script>
<script src="../vendors/scripts/layout-settings.js"></script>
<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>

<!-- js -->
<script src="../src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="../src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
<script src="../vendors/scripts/highchart-setting.js"></script>

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
