<?php

    include('../session/session.php');
    include ('check_role.php');
    include('../includes/controllers.php');
    include('../includes/forms/treasury_management/deal_note_pdf.php');
    $nav_header = "Treasury Management Dashboard";

//    include('../includes/fpdf/fpdf.php');

?>

<!DOCTYPE html>
<html >
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
                    <h5 class="h4 text-blue mb-20">Treasury Management</h5>
                    <div class="tab">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#dashboard" role="tab" aria-selected="true">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#user_access" role="tab" aria-selected="false">User Access</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#customer_info" role="tab" aria-selected="false">Customer Info</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#liabilities" role="tab" aria-selected="false">
                                    Liabilities Info
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#notes_register" role="tab" aria-selected="false">
                                    Notes Register (+Summary)
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#statements" role="tab" aria-selected="false">
                                    Statements
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#assets" role="tab" aria-selected="false" >
                                    Assets Info
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#dn_aprrover1" role="tab" aria-selected="false" >
                                    Approve D. Note(1st)
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#dn_aprrover2" role="tab" aria-selected="false" >
                                    Approve D. Note(2nd)
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#reports" role="tab" aria-selected="false">
                                    Reports
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                                <div class="pd-20">
<!--                                    --><?php //include('../includes/dashboard/cms_acc_balance_widget.php'); ?>
                                </div>
                            </div>
                            <div class="tab-pane fade row" id="user_access" role="tabpanel">

                                <form method="post" action="">
                                    <div class="row">
                                        <div class="pd-20 col-4">
                                            <div class="form-group">
                                                <br>
                                                <label>Select User :</label>
                                                <select class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="user" style="width: 100%; height: 38px">
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
                                                <label>Select CMS Role :</label>
                                                <select class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="role" style="width: 100%; height: 38px">
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

                            <div class="tab-pane fade" id="customer_info" role="tabpanel">
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
                            <div class="tab-pane fade" id="reports" role="tabpanel">
                                <?php include('../includes/tables/cash_management/withdrawal_purposes.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="statements" role="tabpanel">
                                <?php include('../includes/tables/cash_management/list_vaults.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="assets" role="tabpanel">
                                <?php include('../includes/tables/cash_management/list-audit-trail.php'); ?>
                            </div>

                            <div class="tab-pane fade" id="liabilities" role="tabpanel">
                                <?php include('../includes/tables/cms/branches_table.php'); ?>
                            </div>

                            <div class="tab-pane fade" id="notes_register" role="tabpanel">
                                <?php include('../includes/'); ?>
                                <?php include('../includes/tables/treasury_management/notes_register_table.php'); ?>
                            </div>

                            <div class="tab-pane fade" id="dn_aprrover1" role="tabpanel">
                                <?php include('../includes/tables/cms/authorisers_table.php'); ?>
                            </div>

                            <div class="tab-pane fade" id="dn_aprrover2" role="tabpanel">
                                <?php include('../includes/tables/cms/authorisers_table.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } elseif ($_GET['menu'] == "download_deal_note") {
            include('../includes/forms/treasury_management/deal_note_pdf.php');
         }

        elseif ($_GET['menu'] == "view_statement") {?>
            <div class="invoice-wrap pd-30">
                <div class="invoice-box">
                    <div class="invoice-header">
                        <div class="row">
                            <div class="col">
                                <br>
                                <p class="font-16 mb-5">
                                    <strong class="weight-600">Untu Capital Limited <br> Harare </strong>
                                </p>
                            </div>
                            <div class="col text-center">
                                <div class="logo" style="width: 60%; height: 60%">
                                    <img src="../vendors/images/logo.PNG" alt="" class="mx-auto d-block" />
                                </div>
                            </div>

                            <div class="col">
                                <br>
                                <p class="font-16 mb-5">
                                    <strong class="weight-600">NLAC-009 </strong>
                                </p>
                            </div>
                        </div>
                    </div>

<!--                    <h4 class="text-center mb-30 weight-600">INVOICE</h4>-->
                    <div class="row pb-30">
                        <div class="col-md-5">
                            <h5 class="mb-15">Note Investment Statement</h5>
                            <p class="font-14 mb-5">
                                Investment Type : &nbsp;<strong class="weight-600">Fixed Rate Note</strong>
                            </p>
                            <p class="font-14 mb-5">
                                Interest Rate : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <strong class="weight-600">10.00 % </strong>
                            </p>
                        </div>
                        <div class="col-md-7">
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-left">
                                        <p class="font-14 mb-5">Print Date</p>
                                        <p class="font-14 mb-5">Account Name</p>
                                        <p class="font-14 mb-5">Currency</p>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="text-right">
                                        <p class="font-14 mb-5">30.11.2023</p>
                                        <p class="font-14 mb-5"><strong class="weight-600">Nyaradza Life Assurance Cover</strong></p>
                                        <p class="font-14 mb-5">USD</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="invoice-desc pb-30">
                        <table class="table ">
                            <thead>
                            <tr class="invoice-desc-head">
                                <th>Date</th>
                                <th>Transaction Type</th>
                                <th>Credit (USD)</th>
                                <th>Debit (USD)</th>
                                <th>Balance (USD)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="table-plus">29-03-2018</td>
                                <td>Note Investment</td>
                                <td>50,000.00</td>
                                <td>-</td>
                                <td>$50,000.00</td>
                            </tr>
                            <tr>
                                <td class="table-plus">30-03-2018</td>
                                <td>Interest Charge</td>
                                <td>27.78</td>
                                <td>-</td>
                                <td>$50,027.78</td>
                            </tr>
                            <tr>
                                <td class="table-plus"><strong class="weight-600">Closing Balance</strong></td>
                                <td></td>
                                <td><span class="weight-600" style="border-bottom: 3px double #000; display: inline-block;">50,851.65</span></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>

<!--                        <br>-->
                        <p class="font-18 mb-5"><strong class="weight-600 text-red-50">Summary</strong></p>

                        <div class="row">
                            <div class="col-3">
                                <p class="font-14 mb-5">Interest Paid:</p>
                                <p class="font-14 mb-5">Fees Paid:</p>
                                <p class="font-14 mb-5">Principal Paid:</p>
                            </div>
                            <div class="col-2">
                                <p class="font-14 mb-5 text-right">
                                    <strong class="weight-600">3,750.00</strong>
                                </p>
                                <p class="font-14 mb-5 text-right">
                                    <strong class="weight-600">-</strong>
                                </p>
                                <p class="font-14 mb-5 text-right">
                                    <strong class="weight-600">-</strong>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3" style="border-top: 1px solid #000; margin-top: 10px; padding-top: 10px;">
                                <p class="font-14 mb-5"><strong class="weight-600">Principal Balance:</strong></p>
                                <p class="font-14 mb-5">Interest Balance:</p>
                                <p class="font-14 mb-5">Outstanding Fees:</p>
                                <p class="font-14 mb-5"><strong class="weight-600">Total Balance:</strong></p>
                            </div>
                            <div class="col-2" style="border-top: 1px solid #000; margin-top: 10px; padding-top: 10px;">
                                <p class="font-14 mb-5 text-right">
                                    <strong class="weight-600">50,000.00</strong>
                                </p>
                                <p class="font-14 mb-5 text-right">
                                    851.65
                                </p>
                                <p class="font-14 mb-5 text-right">
                                    -
                                </p>
                                <p class="font-14 mb-5 text-right">
                                    <strong class="weight-600" style="border-bottom: 3px double #000; display: inline-block;">50,851.65</strong>
                                </p>
                            </div>
                        </div>


                        <br>
                        <p class="font-18 mb-5"><strong class="weight-600 text-red-50">Amortisation Schedule</strong></p>

                        <div class="row">
                            <div class="col-10" >
                                <table class="table ">
                                    <thead>
                                    <tr class="invoice-desc-head">
                                        <th>Repayment Dates</th>
                                        <th>Interest (USD)</th>
                                        <th>Principal (USD)</th>
                                        <th>Balance (USD)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="table-plus"><strong class="weight-600">29-03-2018</strong></td>
                                        <td>1,250.00</td>
                                        <td>-</td>
                                        <td>$50,000.00</td>
                                    </tr>
                                    <tr>
                                        <td class="table-plus"><strong class="weight-600">30-03-2018</strong></td>
                                        <td>1,250.00</td>
                                        <td>-</td>
                                        <td>$50,000.00</td>
                                    </tr>
                                    <tr>
                                        <td class="table-plus"><strong class="weight-600">30-03-2018</strong></td>
                                        <td>1,250.00</td>
                                        <td>$50,000.00</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td class="table-plus"><strong class="weight-600">Quarterly Payment</strong></td>
                                        <td><span class="weight-600">1,250.00</span></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="table-plus"><strong class="weight-600">Total Interest</strong></td>
                                        <td><span class="weight-600">5,000.00</span></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
<!--                    <h4 class="text-center pb-20">Thank You!!</h4>-->
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
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

</body>
</html>
