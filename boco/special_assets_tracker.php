<?php
include('../session/session.php');
include('check_role.php');
include('../controllers/treasury.php');
$nav_header = "Treasury Management Dashboard";

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>


<!DOCTYPE html>
<html lang="en">
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

        <?php if ($_GET['menu'] == "main") { ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('success')) {
                        // Display a popup or alert message
                        alert('Deleted successfully');
                    }
                });
            </script>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="pd-20 card-box">
                    <h5 class="h4 text-blue mb-20">Special Assets</h5>
                    <div class="tab">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link text-blue active" data-toggle="tab" href="#bank_and_cash_balances"
                                   role="tab"
                                   aria-selected="false">
                                    Bank and Cash Balances
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#equities"
                                   role="tab"
                                   aria-selected="false">
                                    Equities
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#calculate_acquisition"
                                   role="tab"
                                   aria-selected="false">
                                    Calculate Acquisition
                                </a>
                            </li>
<!--                            <li class="nav-item">-->
<!--                                <a class="nav-link text-blue" data-toggle="tab" href="#short_term_placements"-->
<!--                                   role="tab"-->
<!--                                   aria-selected="false">-->
<!--                                    Short Term Placements-->
<!--                                </a>-->
<!--                            </li>-->
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#expected_loan_repayments"
                                   role="tab"
                                   aria-selected="false">
                                    Expected Loan Repayments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#daily_collections"
                                   role="tab"
                                   aria-selected="false">
                                    Daily Collections
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#manage_bank"
                                   role="tab"
                                   aria-selected="false">
                                    Manage Bank
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade  show active" id="bank_and_cash_balances" role="tabpanel">
                                <?php include('../includes/tables/treasury_management/bank_and_cash_balances.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="equities" role="tabpanel">
                                <?php include('../includes/tables/treasury_management/equities.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="calculate_acquisition" role="tabpanel">
                                <?php include('../includes/tables/treasury_management/calculate_acquisition.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="short_term_placements" role="tabpanel">
                                <?php include('../includes/tables/treasury_management/short_term_placements.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="expected_loan_repayments" role="tabpanel">
                                <?php include('../includes/tables/treasury_management/expected_loan_repayments.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="daily_collections" role="tabpanel">
                                <?php include('../includes/tables/treasury_management/daily_collections.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="manage_bank" role="tabpanel">
                                <?php include('../includes/tables/treasury_management/manage_bank.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } //<======= Bank and Cash Balances =======>
        elseif ($_GET['menu'] == 'add_bank_and_cash_balance'){
        ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Add Bank or Cash Balances</h4>
                    </div>
                </div>
                <hr>
                <div class="wizard-content">
                    <form method="POST" action="" class="tab-wizard wizard-circle wizard">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Source :</label>
                                    <input id="name" name="source" type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Bank Account :</label>
                                    <?php $banks = bank_list(); ?>
                                    <select id="type" class="custom-select2 form-control" name="bankAccount" aria-label="Default select example" style="width: 100%; height: 38px">
                                        <?php foreach ($banks as $bank){ ?>
                                        <option value="<?php echo $bank['id'] ?>"><?php echo $bank['bankName'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Branch :</label>
                                    <input id="name" name="branchName" type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Balance :</label>
                                    <input id="name" name="balance" type="number" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Attach Statement/Proof :</label>
                                    <input id="name" name="attachment" type="file" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <button class="btn btn-success" type="submit" name="create_cash_bank_bal">Save</button>
                            </div>
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <a href="special_assets_tracker.php?menu=main" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'view_bank_and_cash_balance'){
        $data = customer_info($_GET['customerId']);
        ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Bank or Cash Details</h4>
                    </div>
                </div>
                <hr>
                <div class="wizard-content">
                    <form class="tab-wizard wizard-circle wizard">
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Source :</label>
                                        <input id="name" name="name" type="text" class="form-control"
                                               value="<?php echo $data['name'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Type :</label>
                                        <input id="email" name="email" type="text" class="form-control"
                                               value="<?php echo $data['email'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumber">Currency :</label>
                                        <input id="phoneNumber" name="phoneNumber" type="text" class="form-control"
                                               value="<?php echo $data['phoneNumber'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumber">Balance :</label>
                                        <input id="phoneNumber" name="phoneNumber" type="text" class="form-control"
                                               value="<?php echo $data['phoneNumber'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumberOther">Statement/Proof Link :</label>
                                        <input id="phoneNumberOther" name="phoneNumberOther" type="text"
                                               class="form-control"
                                               value="<?php echo $data['phoneNumberOther'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-2 col-form-label">
                                    <a href="special_assets_tracker.php?menu=main" class="btn btn-primary">Back</a></div>
                            </div>
                    </form>
                </div>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'update_bank_and_cash_balance'){
        $data = customer_info($_GET['customerId']);
        ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Update Bank or Cash Balance</h4>
                    </div>
                </div>
                <hr>
                <div class="wizard-content">
                    <form method="POST" action="" class="tab-wizard wizard-circle wizard">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Source :</label>
                                    <input id="name" name="name" type="text" class="form-control"
                                           value="<?php echo $data['name'] ?? ''; ?>"
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Type :</label>
                                    <select id="type" class="form-select form-control"
                                            value="<?php echo $data['email'] ?? ''; ?>"
                                            aria-label="Default select example">
                                        <option value="">Bank</option>
                                        <option value="2">Cash</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Currency :</label>
                                    <select id="type" class="form-select form-control"
                                            value="<?php echo $data['email'] ?? ''; ?>"
                                            aria-label="Default select example">
                                        <option value="">USD</option>
                                        <option value="2">ZiG</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Balance:</label>
                                    <input id="email" name="email" type="text" class="form-control"
                                           value="<?php echo $data['email'] ?? ''; ?>"
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Statement/Proof :</label>
                                    <input id="email" name="email" type="text" class="form-control"
                                           value="<?php echo $data['email'] ?? ''; ?>"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <button class="btn btn-success" type="submit" name="update_customer_info">Save</button>
                            </div>
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <a href="special_assets_tracker.php?menu=main" class="btn btn-primary">Cancel</a></div>
                        </div>
                    </form>
                </div>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'delete_bank_and_cash_balance') {
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
                echo '<script>window.location.href = "special_assets_tracker.php?menu=main";</script>';
                echo "Error decoding JSON data";
            }
            ?>

        <?php }
        //<======= Bank Info =======>-->
        elseif ($_GET['menu'] == 'add_bank'){
        ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Add Bank Details</h4>
                    </div>
                </div>
                <hr>
                <div class="wizard-content">
                    <form method="POST" action="" class="tab-wizard wizard-circle wizard">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bankName">Bank Name :</label>
                                    <input id="bankName" name="bankName" type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="accountNumber">Account Number:</label>
                                    <input id="accountNumber" name="accountNumber" type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="currency">Currency :</label>
                                    <select id="currency" class="custom-select2 form-control" name="currency" style="width: 100%; height: 38px"
                                            aria-label="Default select example">
                                        <option value="USD">USD</option>
                                        <option value="ZIG">ZiG</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="balance">Balance:</label>
                                    <input id="balance" name="balance" type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="attachment">Attach Statement/Proof :</label>
                                    <input id="attachment" name="attachment" type="file" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="source">Source :</label>
                                    <input id="source" name="source" type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="branchName">Branch Name :</label>
                                    <input id="branchName" name="branchName" type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">Code :</label>
                                    <input id="code" name="code" type="text" class="form-control"/>
                                </div>
                            </div>
<!--                            <div class="col-md-6">-->
<!--                                <div class="form-group">-->
<!--                                    <label for="files">Files :</label>-->
<!--                                    <input id="files" name="files" type="file" class="form-control"/>-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <button class="btn btn-success" type="submit" name="create_bank_info">Create</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'view_bank'){
        $data = bank_info($_GET['bankId']);
        ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Manage Bank Details</h4>
                    </div>
                </div>
                <hr>
                <div class="wizard-content">
                    <form class="tab-wizard wizard-circle wizard">
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bankName">Bank Name :</label>
                                        <input id="name" name="bankName" type="text" class="form-control"
                                               value="<?php echo $data['bankName'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Account Number :</label>
                                        <input id="account" name="accountNumber" type="text" class="form-control"
                                               value="<?php echo $data['accountNumber'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branchName">Branch Name :</label>
                                        <input id="branchName" name="branchName" type="text" class="form-control"
                                               value="<?php echo $data['branchName'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="code">Code :</label>
                                        <input id="code" name="code" type="text" class="form-control"
                                               value="<?php echo $data['code'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="currency">Currency :</label>
                                        <input id="currency" name="currency" type="text"
                                               class="form-control"
                                               value="<?php echo $data['currency'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-2 col-form-label">
                                    <a href="special_assets_tracker.php?menu=main" class="btn btn-primary">Back</a></div>
                            </div>
                    </form>
                </div>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'update_bank'){
        $data = bank_info($_GET['bankId']);
        ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Update Bank Info</h4>
                    </div>
                </div>
                <hr>
                <div class="wizard-content">
                    <form method="POST" action="" class="tab-wizard wizard-circle wizard">
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bankName">Bank Name :</label>
                                        <input id="bankName" name="bankName" type="text" class="form-control"
                                               value="<?php echo $data['bankName'] ?? ''; ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="currency">Currency :</label>
                                        <input id="currency" name="currency" type="text" class="form-control"
                                               value="<?php echo $data['currency'] ?? ''; ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="balance">Balance :</label>
                                        <input id="balance" name="balance" type="text" class="form-control"
                                               value="<?php echo $data['balance'] ?? ''; ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="files">Files :</label>
                                        <input id="files" name="files" type="text" class="form-control"
                                               value="<?php echo $data['files'] ?? ''; ?>"/>
                                    </div>
                                </div>
                                <!-- Add hidden input for id -->
                                <input type="hidden" name="id" value="<?php echo $data['id'] ?? ''; ?>">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-2 col-form-label">
                                    <button class="btn btn-success" type="submit" name="update_bank_info">Save</button>
                                </div>
                                <div class="col-sm-12 col-md-2 col-form-label">
                                    <a href="special_assets_tracker.php?menu=main" class="btn btn-primary">Cancel</a>
                                </div>
                            </div>
                        </section>
                    </form>


                </div>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'delete_bank') {
            delete_bank($_GET['bankId']);
        }
        //<======= Manage Banks  =======>-->
        //<======= Equity =======>
        elseif ($_GET['menu'] == 'add_equity'){
        ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Add Equity</h4>
                    </div>
                </div>
                <hr>
                <div class="wizard-content">
                    <form method="POST" action="" class="tab-wizard wizard-circle wizard">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="counterpart">Counter :</label>
                                    <input id="counterpart" name="counterpart" type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="agent">Agent :</label>
                                    <input id="agent" name="agent" type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="currency">Currency :</label>
                                    <select id="currency" name="currency" class="form-select form-control" aria-label="Default select example">
                                        <option value="USD">USD</option>
                                        <option value="ZiG">ZiG</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dateOfAcquisition">Date of Acquisition :</label>
                                    <input id="dateOfAcquisition" name="dateOfAcquisition" type="date" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="numberOfShares">Number of Shares :</label>
                                    <input id="numberOfShares" name="numberOfShares" type="number" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pricePerShare">Price per Share :</label>
                                    <input id="pricePerShare" name="pricePerShare" type="number" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="transactionCosts">Transaction Costs :</label>
                                    <input id="transactionCosts" name="transactionCosts" type="number" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <button class="btn btn-success" type="submit" name="create_equity">Save</button>
                            </div>
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <a href="special_assets_tracker.php?menu=main" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'view_equity'){
        $data = equity_by_id($_GET['customerId']);
        ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Equity Details</h4>
                    </div>
                </div>
                <hr>
                <div class="wizard-content">
                    <form class="tab-wizard wizard-circle wizard">
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="counterpart">Counter :</label>
                                        <input id="counterpart" name="counterpart" type="text" class="form-control"
                                               value="<?php echo $data['counterpart'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agent">Agent :</label>
                                        <input id="agent" name="agent" type="text" class="form-control"
                                               value="<?php echo $data['agent'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="currency">Currency :</label>
                                        <input id="currency" name="currency" type="text" class="form-control"
                                               value="<?php echo $data['currency'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dateOfAcquisition">Date of Acquisition :</label>
                                        <input id="dateOfAcquisition" name="dateOfAcquisition" type="text" class="form-control"
                                               value="<?php echo $data['dateOfAcquisition'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="numberOfShares">Number of Shares :</label>
                                        <input id="numberOfShares" name="numberOfShares" type="text" class="form-control"
                                               value="<?php echo number_format($data['numberOfShares'], 0, '', ',') ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pricePerShare">Price Per Share :</label>
                                        <input id="pricePerShare" name="pricePerShare" type="text" class="form-control"
                                               value="<?php echo $data['pricePerShare'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="transactionCosts">Transaction Costs :</label>
                                        <input id="transactionCosts" name="transactionCosts" type="text" class="form-control"
                                               value="<?php echo $data['transactionCosts'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 col-md-2 col-form-label">
                                    <a href="special_assets_tracker.php?menu=main" class="btn btn-primary">Back</a></div>
                            </div>
                    </form>
                </div>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'update_equity'){
        $data = customer_info($_GET['customerId']);
        ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Update Equity</h4>
                    </div>
                </div>
                <hr>
                <div class="wizard-content">
                    <form method="POST" action="" class="tab-wizard wizard-circle wizard">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Counter:</label>
                                    <input id="name" name="name" type="text" class="form-control"
                                           value="<?php echo $data['name'] ?? ''; ?>"
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Agent:</label>
                                    <input id="name" name="name" type="text" class="form-control"
                                           value="<?php echo $data['name'] ?? ''; ?>"
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Currency:</label>
                                    <select id="type" class="form-select form-control"
                                            value="<?php echo $data['email'] ?? ''; ?>"
                                            aria-label="Default select example">
                                        <option value="">USD</option>
                                        <option value="2">ZiG</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Date of Acquisition:</label>
                                    <input id="email" name="email" type="text" class="form-control"
                                           value="<?php echo $data['email'] ?? ''; ?>"
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Number of Shares:</label>
                                    <input id="email" name="email" type="text" class="form-control"
                                           value="<?php echo $data['email'] ?? ''; ?>"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <button class="btn btn-success" type="submit" name="update_customer_info">Save</button>
                            </div>
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <a href="special_assets_tracker.php?menu=main" class="btn btn-primary">Cancel</a></div>
                        </div>
                    </form>
                </div>
            </div>

        <?php } elseif ($_GET['menu'] == 'delete_equity') { ?>
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
                echo '<script>window.location.href = "special_assets_tracker.php?menu=main";</script>';
                echo "Error decoding JSON data";
            }
            ?>
        <?php }
        //<======= /Equity=======>-->
        //======= calculate_acquisition ========
        elseif ($_GET['menu'] == 'calculate_acquisition'){
        ?>
            <?php include('../includes/tables/treasury_management/calculate_acquisition.php'); ?>
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