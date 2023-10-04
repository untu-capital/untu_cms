<?php
include('../session/session.php');
include('../includes/controllers.php');
$nav_header = "Marketing & Campaigns";




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

    $url = "http://localhost:7878/api/utg/cms_authorisation/update/".$id;
    $data_array = array(
        'branchName' => $branch,
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
if(isset($_POST['auth'])) {
    $id = $_POST['id'];
    $branch = $_POST['branches'];
    $authlevel = $_POST['role'];
    $name = $_POST['name'];


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
                        <ul class="nav nav-pills" role="tablist">
<!--                            <li class="nav-item">-->
<!--                                <a class="nav-link active text-blue" data-toggle="tab" href="#category" role="tab" aria-selected="true" >-->
<!--                                    Manage Branches-->
<!--                                </a>-->
<!--                            </li>-->

                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#branches" role="tab" aria-selected="false">
                                    Manage Branches
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#authorisers" role="tab" aria-selected="false">
                                    Manage Authorisers
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content">
<!--                              </div>-->
                            <div class="tab-pane fade show active" id="branches" role="tabpanel">
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
                                    <h4 class="text-blue h4">Edit Authority Level</h4>

                                </div>
                                <div class="wizard-content">

                                    <form action="" method="POST">
                                        <?php  $auth_by_id = authorisation_by_id($_GET['id']); ?>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Branch Name</label>
                                                    <select class="custom-select form-control" name="branches">
                                                        <option value="<?=$auth_by_id['branchName'] ?>"> <?=$auth_by_id['branchName'] ?></option>
                                                        <option value="">Select Name</option>
                                                        <?php
                                                        $branches = branch();
                                                        foreach ($branches as $branch) {
                                                            echo "<option value='$branch[branchName]'name='branches'>$branch[branchName] Branch</option>";
                                                        }
                                                        ?>

                                                    </select>                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Authentication Level <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                                                    <select class="custom-select form-control" name="role">
                                                        <option value="<?=$auth_by_id['authLevel'] ?>"> <?=$auth_by_id['authLevel'] ?></option>
                                                        <option value="Initiator"name="role" >Initiator</option>
                                                        <option value="First Approver"name="role" >First Approver</option>
                                                        <option value="Second Approver"name="role" >Second Approver</option>
                                                    </select>                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Name <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                                                    <input type="text" class="form-control" name="name" value="<?=$auth_by_id['userId'] ?>" id="name" required>
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

                                            <?php

                                            ?>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger" value="auth" name="auth">Update</button>
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
