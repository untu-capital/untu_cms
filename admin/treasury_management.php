<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../session/session.php');
include ('check_role.php');
include('../includes/controllers.php');
include ('../controllers/treasury.php');
include('../includes/forms/treasury_management/deal_note_pdf.php');
include('../includes/forms/treasury_management/asset_deal_note_pdf.php');
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
                                <a class="nav-link text-blue" data-toggle="tab" href="#amortization" role="tab" aria-selected="false">
                                    Amortization
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#assets" role="tab" aria-selected="false" >
                                    Assets Info
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#asset_notes_register" role="tab" aria-selected="false">
                                    Asset Notes Register
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
                                    <?php include('../includes/dashboard/treasury/index.php'); ?>
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
                                                <label>Select TMS Role :</label>
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
                                                <button type="submit" name="update_tms_role" class="btn btn-success btn-lg btn-block">Update Role</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <?php include('../includes/tables/treasury_management/users_table.php'); ?>
                            </div>

                            <div class="tab-pane fade" id="customer_info" role="tabpanel">
                                <?php include('../includes/tables/treasury_management/customers.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="reports" role="tabpanel">
                                <?php include('../includes/tables/cash_management/withdrawal_purposes.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="assets" role="tabpanel">
                                <?php include('../includes/forms/treasury_management/create_asset.php'); ?>
                            </div>

                            <div class="tab-pane fade" id="liabilities" role="tabpanel">
                                <?php include('../includes/forms/treasury_management/create_liability.php'); ?>
                            </div>

                            <div class="tab-pane fade" id="asset_notes_register" role="tabpanel">
                                <?php include('../includes/tables/treasury_management/asset_notes_register_table.php'); ?>
                            </div>

                            <div class="tab-pane fade" id="notes_register" role="tabpanel">
                                <?php include('../includes/tables/treasury_management/notes_register_table.php'); ?>
                            </div>

                            <div class="tab-pane fade" id="amortization" role="tabpanel">
                                <?php include('../includes/forms/treasury_management/amortization_form.php'); ?>
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

        <?php }
        elseif ($_GET['menu'] == "download_deal_note")
        {
            include('../includes/forms/treasury_management/deal_note_pdf.php');
        }
        elseif ($_GET['menu'] == "download_asset_deal_note")
        {
            include('../includes/forms/treasury_management/asset_deal_note_pdf.php');
        }

        elseif ($_GET['menu'] == "view_statement")
        {?>
            <?php include('../includes/forms/treasury_management/deal_note_statement.php');
        }
        elseif ($_GET['menu'] == "view_asset_statement")
        {?>
            <?php include('../includes/forms/treasury_management/asset_deal_note_statement.php');
        }

        elseif ($_GET['menu'] == "view_asset_statement") {?>
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
                                    <strong class="weight-600">Ref: Gain 5 </strong>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!--                    <h4 class="text-center mb-30 weight-600">INVOICE</h4>-->
                    <div class="row pb-30">
                        <div class="col-md-6">
                            <h5 class="mb-15">Debenture Investment Statement</h5>
                            <p class="font-14 mb-5">
                                Investment Type : &nbsp;<strong class="weight-600">Fixed Rate Note</strong>
                            </p>
                            <p class="font-14 mb-5">
                                Interest Rate : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <strong class="weight-600">US $15,000.00 (Equivalent paid upfront) </strong>
                            </p>
                        </div>
                        <div class="col-md-6">
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
                                        <p class="font-14 mb-5">06.11.2023</p>
                                        <p class="font-14 mb-5"><strong class="weight-600">Gain Cash & Carry</strong></p>
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
                                <th>Debit (USD)</th>
                                <th>Credit (USD)</th>
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
                                    <strong class="weight-600">27,500.00</strong>
                                </p>
                                <p class="font-14 mb-5 text-right">
                                    <strong class="weight-600">-</strong>
                                </p>
                                <p class="font-14 mb-5 text-right">
                                    <strong class="weight-600">250,000.00</strong>
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
                                    <strong class="weight-600">-</strong>
                                </p>
                                <p class="font-14 mb-5 text-right">
                                    -
                                </p>
                                <p class="font-14 mb-5 text-right">
                                    -
                                </p>
                                <p class="font-14 mb-5 text-right">
                                    <strong class="weight-600" style="border-bottom: 3px double #000; display: inline-block;">-</strong>
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
                                        <td>15,000.00</td>
                                        <td>-</td>
                                        <td>$250,000.00</td>
                                    </tr>
                                    <tr>
                                        <td class="table-plus"><strong class="weight-600">30-03-2018</strong></td>
                                        <td>6,250.00</td>
                                        <td>-</td>
                                        <td>$250,000.00</td>
                                    </tr>
                                    <tr>
                                        <td class="table-plus"><strong class="weight-600">30-03-2018</strong></td>
                                        <td>-</td>
                                        <td>$250,000.00</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td class="table-plus"><strong class="weight-600">Repayment:</strong></td>
                                        <td><span class="weight-600">15,000.00</span></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="table-plus"><strong class="weight-600">Total Interest:</strong></td>
                                        <td><span class="weight-600">27,500.00</span></td>
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

        elseif ($_GET['menu'] == 'add_customer'){
            include('../includes/forms/treasury_management/create_customer.php');
        }
        elseif ($_GET['menu'] == 'view_customer'){
        $data = customer_info($_GET['customerId']);
        ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Customer Information Details</h4>
                    </div>
                </div>
                <hr>
                <div class="wizard-content">
                    <form class="tab-wizard wizard-circle wizard">
                        <!-- Step 1 -->
                        <h5>Counterparty Details</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name :</label>
                                        <input id="name" name="name" type="text" class="form-control"
                                               value="<?php echo $data['name'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address :</label>
                                        <input id="email" name="email" type="text" class="form-control"
                                               value="<?php echo $data['email'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumber">Phone Number :</label>
                                        <input id="phoneNumber" name="phoneNumber" type="text" class="form-control"
                                               value="<?php echo $data['phoneNumber'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumberOther">Phone Number (other) :</label>
                                        <input id="phoneNumberOther" name="phoneNumberOther" type="text"
                                               class="form-control"
                                               value="<?php echo $data['phoneNumberOther'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Physical Address :</label>
                                        <textarea id="address" name="address" rows="4" type="text" class="form-control"
                                                  readonly="readonly"><?php echo $data['address'] ?? ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 2 -->
                        <h5>Contact Person</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contactPersonName">Full Name:</label>
                                        <input id="contactPersonName" name="contactPersonName" type="text"
                                               class="form-control"
                                               value="<?php echo $data['contactPersonName'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contactPersonJobTitle">Job Title :</label>
                                        <input id="contactPersonJobTitle" name="contactPersonJobTitle" type="text"
                                               class="form-control"
                                               value="<?php echo $data['contactPersonJobTitle'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 3 -->
                        <h5>Banking Details</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="BankName">Bank Name:</label>
                                        <input id="BankName" name="BankName" type="text" class="form-control"
                                               value="<?php echo $data['BankName'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="BankBranch">Branch</label>
                                        <input id="BankBranch" name="BankBranch" type="text" class="form-control"
                                               value="<?php echo $data['BankBranch'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="BankAccountNumber">Account Number</label>
                                        <input id="BankAccountNumber" name="BankAccountNumber" type="number"
                                               class="form-control"
                                               value="<?php echo $data['BankAccountNumber'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="SwiftCode">Swift Code :</label>
                                        <input id="SwiftCode" name="SwiftCode" class="form-control" type="text"
                                               value="<?php echo $data['SwiftCode'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                        </section>


                        <div class="form-group row">
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <a href="treasury_management.php?menu=main" class="btn btn-primary">Back</a></div>
                        </div>
                    </form>
                </div>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'update_customer'){
        $data = customer_info($_GET['customerId']);
        ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Update Customer Information Details</h4>
                    </div>
                </div>
                <hr>
                <div class="wizard-content">
                    <form method="POST" action="" class="tab-wizard wizard-circle wizard">
                        <!-- Step 1 -->
                        <h5>Counterparty Details</h5>
                        <div class="col-md-6" hidden="hidden">
                            <div class="form-group">
                                <label for="id">Name :</label>
                                <input id="id" name="id" type="text" class="form-control"
                                       value="<?php echo $data['id'] ?? ''; ?>"
                                />
                            </div>
                        </div>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name :</label>
                                        <input id="name" name="name" type="text" class="form-control"
                                               value="<?php echo $data['name'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address :</label>
                                        <input id="email" name="email" type="text" class="form-control"
                                               value="<?php echo $data['email'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumber">Phone Number :</label>
                                        <input id="phoneNumber" name="phoneNumber" type="text" class="form-control"
                                               value="<?php echo $data['phoneNumber'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumberOther">Phone Number (other) :</label>
                                        <input id="phoneNumberOther" name="phoneNumberOther" type="text"
                                               class="form-control"
                                               value="<?php echo $data['phoneNumberOther'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Physical Address :</label>
                                        <textarea id="address" name="address" rows="4" type="text" class="form-control"><?php echo $data['address'] ?? ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 2 -->
                        <h5>Contact Person</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contactPersonName">Full Name:</label>
                                        <input id="contactPersonName" name="contactPersonName" type="text"
                                               class="form-control"
                                               value="<?php echo $data['contactPersonName'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contactPersonJobTitle">Job Title :</label>
                                        <input id="contactPersonJobTitle" name="contactPersonJobTitle" type="text"
                                               class="form-control"
                                               value="<?php echo $data['contactPersonJobTitle'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 3 -->
                        <h5>Banking Details</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="BankName">Bank Name:</label>
                                        <input id="BankName" name="BankName" type="text" class="form-control"
                                               value="<?php echo $data['BankName'] ?? ''; ?>"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="BankBranch">Branch</label>
                                        <input id="BankBranch" name="BankBranch" type="text" class="form-control"
                                               value="<?php echo $data['BankBranch'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="BankAccountNumber">Account Number</label>
                                        <input id="BankAccountNumber" name="BankAccountNumber" type="number" class="form-control" value="<?php echo $data['BankAccountNumber'] ?? ''; ?>"/>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="SwiftCode">Swift Code :</label>
                                            <input id="SwiftCode" name="SwiftCode" class="form-control" type="text" value="<?php echo $data['SwiftCode'] ?? ''; ?>"/>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="currency">Currency Denomination</label>
                                            <select class="custom-select2 form-control" name="currency" autocomplete="off" style="width: 100%; height: 38px" >
                                                <option value="USD">USD</option>
                                                <option value="ZWL">ZWL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                        <div class="form-group row">
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <button class="btn btn-success" type="submit" name="update_customer_info">Save</button>
                            </div>
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <a href="treasury_management.php?menu=main" class="btn btn-primary">Cancel</a></div>
                        </div>
                    </form>
                </div>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'delete_customer') { ?>
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
<!--<script src="../vendors/scripts/dashboard2.js"></script>-->

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
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden">

    </iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

</body>
</html>
