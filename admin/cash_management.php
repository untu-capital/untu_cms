<?php
include('../session/session.php');
include ('check_role.php');
include('../includes/controllers.php');
$nav_header = "Cash Management Dashboard";

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
                                <a class="nav-link" data-toggle="tab" href="#assign_role" role="tab" aria-selected="false">Assign CMS Role</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#vault_auth" role="tab" aria-selected="false">Vaults Authorization</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#branches" role="tab" aria-selected="false">
                                    Manage Branches
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#authorisers" role="tab" aria-selected="false">
                                    Branch Vault Approvers
                                </a>
                            </li>

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
<!--                                    --><?php //include('../includes/dashboard/cms_acc_balance_widget.php'); ?>
                                </div>
                            </div>
                            <div class="tab-pane fade row" id="assign_role" role="tabpanel">

                                <form method="post" action="">
                                    <div class="row">
                                        <div class="pd-20 col-4">
                                            <div class="form-group">
                                                <br>
                                                <label for="user">Select User :</label>
                                                <select id="usser" class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="user" style="width: 100%; height: 38px">
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

                                        <div class="pd-20 col-4">
                                            <div class="form-group">
                                                <br>
                                                <label for="role">Select CMS Role :</label>
                                                <select id="role" class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="role" style="width: 100%; height: 38px">
                                                    <optgroup label="Assign Role">
                                                        <option value="">Unassign Role</option>;
                                                        <?php
                                                        $roles = roles();
                                                        foreach ($roles as $role) {
                                                            echo "<option value='$role[id]'>$role[description] ($role[name])</option>";
                                                        } ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="pd-20 col-4">
                                            <div class="form-group">
                                                <br>
                                                <label> .</label>
                                                <button type="submit" name="update_cms_role" class="btn btn-success btn-lg btn-block">Update Role</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <?php include('../includes/tables/cms_users_table.php'); ?>
                            </div>

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

                            <div class="tab-pane fade" id="branches" role="tabpanel">
                                <?php include('../includes/tables/cms/branches_table.php'); ?>
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
                                    <input type="text" class="form-control" name="branchcode" id="branchcode" requred>
                                </div>
                            </div>

                        </div>
<!--                        <div class="row">-->
<!---->
<!--                            <div class="col-md-6 col-sm-12">-->
<!--                                <div class="form-group">-->
<!--                                    <label>Vault Acc Number</label>-->
<!--                                    <input type="text" class="form-control" name="vault" id="vault" >-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->


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
            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="pd-20 card-box">
                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix">
                            <h4 class="text-blue h4">Edit Branch</h4>

                        </div>
                        <div class="wizard-content">

                            <form action="" method="POST">
                                <?php  $branch_by_id = branch_by_id($_GET['id']); ?>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Branch Name</label>
                                            <input type="text" class="form-control" value="<?=$branch_by_id['branchName'] ?>" name="branchName" id="branchName" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Branch Address <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                                            <input type="text" class="form-control" name="branchAddress" value="<?=$branch_by_id['branchAddress'] ?>" id="branchAddress" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Branch Phone</label>
                                            <input type="text" class="form-control" value="<?=$branch_by_id['branchTellPhone'] ?>" name="branchTellPhone" id="branchTellPhone" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">

                                            <div class="form-group">
                                                <label>Select Status :</label>
                                                <select class="custom-select form-control">
                                                    <option value="<?=$branch_by_id['branchStatus'] ?>"> <?=$branch_by_id['branchStatus'] ?></option>
                                                    <option value="Active" name="status" id="status">Active</option>
                                                    <option value="Disabled" name="status" id="status">Disabled</option>

                                                </select>
                                            </div>
<!--                                            <input type="text" class="form-control" name="status" value="--><?php //=$branch_by_id['branchStatus'] ?><!--" id="status" required>-->
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Code Number</label>
                                            <input type="number" class="form-control" name="code"value="<?=$branch_by_id['code'] ?>" id="code" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Branch Code</label>
                                            <input type="text" class="form-control" name="branchcode"value="<?=$branch_by_id['branchCode'] ?>" id="branchcode" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Vault Acc Number</label>
                                            <input type="text" class="form-control" value="<?=$branch_by_id['vaultAccountNumber'] ?>"name="vault" id="vault" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">

                                            <input type="hidden" class="form-control" value="<?=$branch_by_id['id'] ?>" name="id" id="id" required>
                                        </div>
                                    </div>

                                </div>




                                <div class="col-md-6 col-sm-12">

                                    <?php

                                    ?>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger" value="edit" name="edit">Update</button>
                                    </div>
                                </div>
                            </form>

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
                                                    <select id="branch" class="custom-select form-control" name="update_branch">
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
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Code</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="code" placeholder="Vault Code" required/></div>
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

        <?php }
        elseif ($_GET['menu'] == 'update_vault'){ ?>

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
                $url = "http://localhost:7878/api/utg/cms/vault/update";
                // Data to send in the POST request
                $postData = array(
                    'id' => $_POST['id'],
                    'account' => $_POST['account'],
                    'name' => $_POST['vaultName'],
                    'type' => $_POST['type'],
                    'code' => $_POST['code'],
                    'branchId' => $_POST['branch'],
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
                            <input class="form-control" type="text" name="account" placeholder="Vault Account" value="<?php echo $table['account'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="vaultName" placeholder="Vault Account" value="<?php echo $table['name'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Code</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="code" placeholder="Vault Account" value="<?php echo $table['code'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Type</label>
                        <div class="col-sm-12 col-md-10">
                            <select
                                    class="custom-select2 form-control"
                                    name="type"
                                    style="width: 100%; height: 38px"
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
