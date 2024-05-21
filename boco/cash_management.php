<?php
include('../session/session.php');
include('check_role.php');
//include('charts_data.php');
$nav_header = "Cash Management Dashboard";

include('../includes/controllers.php');
$state = $_GET['state'];
$userId = $_SESSION['userId'];
$branch = $_SESSION['branch'];
//
?>

<?php
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/branches/getAllBranches");
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//$server_response = curl_exec($ch);
//
//curl_close($ch);
//$data = json_decode($server_response, true);
//// Check if the JSON decoding was successful
//if ($data !== null) {
//    $branches = $data;
//
//} else {
//    echo "Error decoding JSON data";
//}
//?>

<!DOCTYPE html>
<html lang="en">
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
<!-- Start Modals-->
<!-- Deleted Transaction Modal-->
<div class="modal fade show" data-backdrop="static" id="deletedTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h3 class="mb-20">Voucher deleted successfully!</h3>
                <div class="mb-30 text-center">
                    <img src="../vendors/images/success.png"  alt=""/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center row"> <!-- Full width column for button -->
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <a class="btn btn-secondary btn-lg ml-2" href="cash_management.php?menu=main">Dashboard</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Failed Transaction Modal  -->
<div class="modal fade" data-backdrop="static" id="failedTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h3 class="mb-20">Transaction failed!</h3>
                <div class="mb-30 text-center">
                    <img src="../vendors/images/caution-sign.png"  alt=""/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center"> <!-- Full width column for button -->
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <a class="btn btn-secondary btn-lg ml-2" href="cash_management.php?menu=main">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modals-->

<div class="main-container">
    <div class="pd-ltr-20">

        <?php include('../includes/dashboard/topbar_widget.php'); ?>

        <?php if ($_GET['menu'] == 'main') { ?>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="pd-20 card-box">
                    <h5 class="h4 text-blue mb-20">CMS Configurations</h5>
                    <div class="tab">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#acc_balance" role="tab"
                                   aria-selected="true">Account Balances</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pending_transaction" role="tab"
                                   aria-selected="false">Pending Transaction Voucher</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#revise_transaction" role="tab"
                                   aria-selected="false">Revise Transaction Voucher</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#decline_transaction" role="tab"
                                   aria-selected="false">Declined Transaction Voucher</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#approved_transaction" role="tab"
                                   aria-selected="false">Approved Transaction Voucher</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="acc_balance" role="tabpanel">
                                <div class="pd-20">
                                    <?php include('../includes/dashboard/cms_acc_balance_widget.php'); ?>
                                </div>
                            </div>

                            <div class="tab-pane fade row" id="pending_transaction" role="tabpanel">
                                <div class="pd-20">
                                    <?php $firstApprovalStatus = "PENDING";
                                    $secondApproval = "PENDING";
                                    include('../includes/tables/cash_management/boco_cash_withdrawal_vouchers_table.php'); ?>
                                </div>
                            </div>
                            <div class="tab-pane fade row" id="revise_transaction" role="tabpanel">
                                <div class="pd-20">
                                    <?php $firstApprovalStatus = "REVISE";
                                    $secondApproval = "REVISE";
                                    include('../includes/tables/cash_management/boco_cash_withdrawal_vouchers_table.php'); ?>
                                </div>
                            </div>
                            <div class="tab-pane fade row" id="decline_transaction" role="tabpanel">
                                <div class="pd-20">
                                    <?php $firstApprovalStatus = "DECLINED";
                                    $secondApproval = "DECLINED";
                                    include('../includes/tables/cash_management/boco_cash_withdrawal_vouchers_table.php'); ?>
                                </div>
                            </div>
                            <div class="tab-pane fade row" id="approved_transaction" role="tabpanel">
                                <div class="pd-20">
                                    <?php $firstApprovalStatus = "APPROVED";
                                    $secondApproval = "APPROVED";
                                    include('../includes/tables/cash_management/boco_cash_withdrawal_vouchers_table.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <?php }
        elseif ($_GET['menu'] == 'add_vault') {
            ?>
            <?php

            ?>
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
                            <label for="account" hidden="hidden"></label>
                            <input id="account" class="form-control" type="text" name="account"
                                   placeholder="Vault Account"
                                   required/></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Name</label>
                        <div class="col-sm-12 col-md-10">
                            <label for="name" hidden="hidden"></label>
                            <input id="name" class="form-control" type="text" name="name" placeholder="Vault Name"
                                   required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Type</label>
                        <div class="col-sm-12 col-md-10">
                            <label for="type" hidden="hidden"></label>
                            <select id="type" class="custom-select2 form-control" name="type"
                                    style="width: 100%; height: 38px">
                                <optgroup label="Select Vault Type">
                                    <option value="">Select Vault Type</option>
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
                            <label for="branch" hidden="hidden"></label>
                            <select id="branch" class="custom-select2 form-control" name="branch"
                                    style="width: 100%; height: 38px">
                                <optgroup label="Branches">
                                    <option value="">Select Branch</option>
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
        elseif ($_GET['menu'] == 'update_vault') { ?>

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

            } else {
                echo '<script>window.location.href = "cash_management.php?menu=main#vaults";</script>';
                echo "Error decoding JSON data";
            }

            if (isset($_POST['vault'])) {
                // API endpoint URL
                $url = "http://localhost:7878/api/utg/cms/vault/update";
                // Data to send in the POST request
                $postData = array('id' => $_POST['id'], 'account' => $_POST['account'], 'name' => $_POST['vaultName'], 'type' => $_POST['type'], 'branchId' => $_POST['branch'],);

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
                    <label for="id" hidden="hidden"></label>
                    <input id="id" name="id" value="<?php echo $table['id'] ?>" hidden="hidden">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Account</label>
                        <div class="col-sm-12 col-md-10">
                            <label for="account" hidden="hidden"></label>
                            <input id="account" class="form-control" type="text" name="account"
                                   placeholder="Vault Account"
                                   value="<?php echo $table['account'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Name</label>
                        <div class="col-sm-12 col-md-10">
                            <label for="vaultName" hidden="hidden"></label>
                            <input id="vaultName" class="form-control" type="text" name="vaultName"
                                   placeholder="Vault Account"
                                   value="<?php echo $table['name'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Type</label>
                        <div class="col-sm-12 col-md-10">
                            <label for="type" hidden="hidden"></label>
                            <select
                                    id="type"
                                    class="custom-select2 form-control"
                                    name="type"
                                    style="width: 100%; height: 38px"
                            >
                                <optgroup label="Types">
                                    <option value="<?php echo $table['type'] ?>"><?php echo $table['type'] ?></option>
                                    <option value="Petty Cash">Petty Cash</option>
                                    <option value="Internal Vault">Internal Vault</option>
                                    <option value="External Vault">External Vault</option>
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
        elseif ($_GET['menu'] == 'approve') {

            if (isset($_POST['approve'])) {
                // API endpoint URL
                $url = "http://localhost:7878/api/utg/cms/petty-cash-payments/" . $_POST['id'];
                // Data to send in the POST request
                $postData = array('id' => $_POST['id'], 'firstApprover' => $_SESSION['userId'], 'status' => "Approved", 'notes' => $_POST['notes'], 'fromAccount' => "8000/0009/HRE/FCA", 'toAccount' => "3000/8988/EXP/HO");

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
                            $url = "http://localhost:7878/api/utg/cms/Pastel/" . $_POST['id'];
                            // Data to send in the POST request
                            $postData = array('id' => $_POST['id'], 'ToAccount' => "8422/000/GWE/FCA", 'TransactionType' => "PO-TRANS", 'ExchangeRate' => "1", 'Description' => "Repayment Transaction", 'FromAccount' => "8000/000/HO/LR", 'Reference' => "RP{transId}", 'Currency' => "001", 'Amount' => "4000.0", 'APIPassword' => "Admin", 'APIUsername' => "Admin", 'TransactionDate' => "13-Sep-2023"

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
                            foreach ($decoded as $key => $val) {
                                //echo $key . ': ' . $val . '<br>';
                            }
                            // echo $val;
                            $_SESSION['error'] = "Failed. Please try again, " . $val;
                            header('location: cash_management.php?menu=main');
                            break;

                        case 401: # Unauthorixed - Bad credientials
                            $_SESSION['error'] = ' Failed.. Please try again!';
                            header('location: cash_management.php?menu=main');

                            break;
                        default:
                            $_SESSION['error'] = 'Not able to Approve' . "\n";
                            header('location: cash_management.php?menu=main');
                    }
                } else {
                    $_SESSION['error'] = 'Failed.. Please try again!' . "\n";
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
                    <?php $petty = petty_cash_payments_by_id($_GET['id']); ?>
                    <label for="id" hidden="hidden"></label>
                    <input id="id" name="id" value="<?php echo $_GET['id'] ?>" hidden="hidden">

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <h1>PO-By: </h1>
                                <h3><?= $petty['name'] ?> </h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <h1>PO-Number: </h1>
                                <h3><?= $petty['purchaseOrderNumber'] ?> </h3>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12">
                            <div class="form-group">
                                <h1>Status </h1>
                                <h3>First Approved By : <?= $petty['firstApprover'] ?></h3>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="requesitionName">Requisition Name</label>
                                <input type="text" disabled class="form-control"
                                       value="<?= $petty['requesitionName'] ?>" name="requesitionName"
                                       id="requesitionName" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="date">Requisition Date <i
                                            class="mdi mdi-subdirectory-arrow-left:"></i></label>
                                <input type="text" disabled class="form-control" name="branchAddress"
                                       value="<?= $petty['date'] ?>" id="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="transType">Transaction</label>
                                <input type="text" disabled class="form-control" value="<?= $petty['transType'] ?>"
                                       name="transType" id="transType" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="amount">Total <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                                <input type="text" class="form-control" name="amount" disabled
                                       value="<?= $petty['amount'] ?>" id="amount" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="id" hidden="hidden"></label>
                                <input type="hidden" disabled class="form-control" value="<?= $petty['id'] ?>" name="id"
                                       id="id" required>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="notes">Additional Notes</label>
                        <textarea class="form-control" name="notes" id="notes"></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button class="btn btn-success" type="submit" name="approve">Approve</button>
                        </div>

                    </div>

                </form>
            </div>
            <!-- Default Basic Forms End -->

        <?php }
        elseif ($_GET['menu'] == 'delete_vault') { ?>

            <?php
            $id = $_GET['vaultId'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/vault/delete/" . $id);
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

        <?php include('../includes/footer.php'); ?>
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
>
    <iframe
            src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
            height="0"
            width="0"
            style="display: none; visibility: hidden"
    ></iframe
    >
</noscript>
<!-- End Google Tag Manager (noscript) -->

</body>
</html>
