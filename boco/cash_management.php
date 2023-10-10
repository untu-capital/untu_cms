<?php
include('../session/session.php');
//include('charts_data.php');
$nav_header = "Cash Management Dashboard";

include('../includes/controllers.php');
$state = $_GET['state'];

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
<html>
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
                                <a class="nav-link" data-toggle="tab" href="#assign_role" role="tab"
                                   aria-selected="false">Cash Transaction Voucher</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#vault_auth" role="tab"
                                   aria-selected="false">Petty Cash Payments</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#vaults" role="tab"
                                   aria-selected="false">
                                    Cash Receipts
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#auditTrail" role="tab"
                                   aria-selected="false">
                                    Cash Reconciliation
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="acc_balance" role="tabpanel">
                                <div class="pd-20">
                                    <?php include('../includes/dashboard/cms_acc_balance_widget.php'); ?>
                                </div>
                            </div>
                            <div class="tab-pane fade row" id="assign_role" role="tabpanel">

                                <div class="pd-20 card-box mb-30">
                                    <div class="clearfix">
                                        <div class="pull-left">
                                            <h4 class="text-blue h4">Withdrawal Cash Voucher</h4>
                                        </div>
                                    </div>
                                    <form method="POST" action="" id="withdrawalCashVoucherForm">
                                        <input value="" name="initiator">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>currency</label>
                                                    <select
                                                            class="custom-select2 form-control"
                                                            name="currency"
                                                            style="width: 100%; height: 38px"
                                                    >

                                                        <option value="usd">USD</option>
                                                        <option value="zwl">ZWL</option>

                                                    </select></div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Amount</label>
                                                    <input type="number" class="form-control" required name="amount"
                                                           id="amount">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Withdrawal From</label>
                                                    <select
                                                            class="custom-select2 form-control"
                                                            name="fromVault"
                                                            style="width: 100%; height: 38px"
                                                    >
                                                        <option value="">Please Select Category</option>
                                                        <option value="">Please Select Category</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Withdrawal To</label>
                                                    <select
                                                            class="custom-select2 form-control"
                                                            name="toVault"
                                                            style="width: 100%; height: 38px"
                                                    >
                                                        <option value="">Please Select Category</option>
                                                        <option value="">Please Select Category</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Amount in Words</label>
                                                    <input type="text" class="form-control" required
                                                           name="amountInWords">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Withdrawal Purpose</label>
                                                    <select
                                                            class="custom-select2 form-control"
                                                            name="withdrawalPurpose"
                                                            style="width: 100%; height: 38px"
                                                    >
                                                        <option value="">Please Select Category</option>
                                                        <option value="">Please Select Category</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
<!--                                        <div class="row">-->
<!--                                            <div class="col-md-6 col-sm-12">-->
<!--                                                <div class="form-group">-->
<!--                                                    <label>First Approver</label>-->
<!--                                                    <input type="text" class="form-control" required-->
<!--                                                           name="firstApprover">-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="col-md-6 col-sm-12">-->
<!--                                                <div class="form-group">-->
<!--                                                    <label>Second Approver</label>-->
<!--                                                    <input type="text" class="form-control" required-->
<!--                                                           name="secondApprover">-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
                                        <div class="row">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Denomination</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Value</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">100</th>
                                                    <th scope="row"><input type="number" class="form-control"
                                                                           id="denomination100" required
                                                                           name="denomination100"
                                                                           oninput="calculateValue()"></th>
                                                    <th scope="row"><input type="number" class="form-control"
                                                                           id="denomination100T" required
                                                                           name="denomination100T" readonly></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">50</th>
                                                    <th scope="row"><input type="number" class="form-control"
                                                                           id="denomination50" required
                                                                           name="denomination50"
                                                                           oninput="calculateValue()"></th>
                                                    <th scope="row"><input type="number" class="form-control" required
                                                                           id="denomination50T" name="denomination50T"
                                                                           readonly></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">20</th>
                                                    <th scope="row"><input type="number" class="form-control"
                                                                           id="denomination20" required
                                                                           name="denomination20"
                                                                           oninput="calculateValue()"></th>
                                                    <th scope="row"><input type="number" class="form-control" required
                                                                           id="denomination20T" name="denomination20T"
                                                                           readonly></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">10</th>
                                                    <th scope="row"><input type="number" class="form-control"
                                                                           id="denomination10" required
                                                                           name="denomination10"
                                                                           oninput="calculateValue()"></th>
                                                    <th scope="row"><input type="number" class="form-control" required
                                                                           id="denomination10T" name="denomination10T"
                                                                           readonly></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">5</th>
                                                    <th scope="row"><input type="number" class="form-control"
                                                                           id="denomination5" required
                                                                           name="denomination5"
                                                                           oninput="calculateValue()"></th>
                                                    <th scope="row"><input type="number" class="form-control" required
                                                                           id="denomination5T" name="denomination5T"
                                                                           readonly></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <th scope="row"><input type="number" class="form-control"
                                                                           id="denomination2" required
                                                                           name="denomination2"
                                                                           oninput="calculateValue()"></th>
                                                    <th scope="row"><input type="number" class="form-control" required
                                                                           id="denomination2T" name="denomination2T"
                                                                           readonly></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <th scope="row"><input type="number" class="form-control"
                                                                           id="denomination1" required
                                                                           name="denomination1"
                                                                           oninput="calculateValue()"></th>
                                                    <th scope="row"><input type="number" class="form-control" required
                                                                           id="denomination1T" name="denomination1T"
                                                                           readonly></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">0.01</th>
                                                    <th scope="row"><input type="number" class="form-control"
                                                                           id="denominationCents" required
                                                                           name="denominationCents"
                                                                           oninput="calculateValue()"></th>
                                                    <th scope="row"><input type="number" class="form-control" required
                                                                           id="denominationCentsT"
                                                                           name="denominationCentsT" readonly></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Total</th>
                                                    <th scope="row"><input type="number" id="totalDenominationsT"
                                                                           class="form-control" required
                                                                           name="totalDenominations" readonly></th>
                                                    <th scope="row"><input type="number" id="totalSumT"
                                                                           class="form-control" required name="totalSum"
                                                                           readonly></th>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-2 col-form-label">
                                                <button class="btn btn-success" type="submit" name="create"
                                                        id="withdrawalCashVoucherButton">Save
                                                </button>
                                            </div>
                                            <div class="col-sm-12 col-md-2 col-form-label">
                                                <a
                                                        href="list-budget.php"
                                                        class="btn btn-primary"
                                                >
                                                    Cancel
                                                </a>
                                            </div>
                                        </div>
                                        <!--                                    Javascript function to calculate the amount per denomination and total amount-->
                                        <script>

                                            document.getElementById('withdrawalCashVoucherForm').addEventListener('submit', function (event) {
                                                // Prevent the default form submission
                                                event.preventDefault();

                                                // Collect form data
                                                const formData = new FormData(event.target);
                                                const filteredFormData = new FormData();

                                                for (const [name, value] of formData.entries()) {
                                                    // Exclude fields ending with 'from'
                                                    if (!name.endsWith('T')) {
                                                        // Include this field in the form data to be sent
                                                        console.log(`${name}: ${value}`);
                                                        filteredFormData.append(name, value);
                                                    }
                                                }

                                                const formDataObject = {};

                                                filteredFormData.forEach((value, key) => {
                                                    formDataObject[key] = value;
                                                });

                                                const jsonData = JSON.stringify(formDataObject);
                                                console.log(jsonData);
                                                // Send form data using Fetch API
                                                fetch('http://localhost:7878/api/utg/cms/transaction-voucher/initiate', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json'
                                                    },
                                                    body: jsonData,                                               })
                                                    .then(response => response.json()) // Assuming the response is JSON, adjust accordingly
                                                    .then(data => {
                                                        // Handle the response data here if needed
                                                        console.log(data);
                                                    })
                                                    .catch(error => {
                                                        // Handle errors here
                                                        console.error('Error:', error);
                                                    });
                                            });


                                            function calculateValue() {
                                                const denomination100 = parseInt(document.getElementById('denomination100').value) || 0;
                                                const denomination50 = parseInt(document.getElementById('denomination50').value) || 0;
                                                const denomination20 = parseInt(document.getElementById('denomination20').value) || 0;
                                                const denomination10 = parseInt(document.getElementById('denomination10').value) || 0;
                                                const denomination5 = parseInt(document.getElementById('denomination5').value) || 0;
                                                const denomination2 = parseInt(document.getElementById('denomination2').value) || 0;
                                                const denomination1 = parseInt(document.getElementById('denomination1').value) || 0;
                                                const denominationCents = parseInt(document.getElementById('denominationCents').value) || 0;

                                                // Calculate individual totals
                                                const total100 = denomination100 * 100;
                                                const total50 = denomination50 * 50;
                                                const total20 = denomination20 * 20;
                                                const total10 = denomination10 * 10;
                                                const total5 = denomination5 * 5;
                                                const total2 = denomination2 * 2;
                                                const total1 = denomination1 * 1;
                                                const totalCents = denominationCents * 0.01;

                                                document.getElementById('denomination100T').value = total100;
                                                document.getElementById('denomination50T').value = total50;
                                                document.getElementById('denomination20T').value = total20;
                                                document.getElementById('denomination10T').value = total10;
                                                document.getElementById('denomination5T').value = total5;
                                                document.getElementById('denomination2T').value = total2;
                                                document.getElementById('denomination1T').value = total1;
                                                document.getElementById('denominationCentsT').value = totalCents;

                                                document.getElementById('totalSumT').value = total100 + total50 + total20 + total10 + total5 + total2 + total1 + totalCents;
                                                document.getElementById('totalDenominationsT').value = denomination100 + denomination50 + denomination20 + denomination10 + denomination5 + denomination2 + denomination1 + denominationCents;
                                            }
                                        </script>

                                    </form>
                                </div>

                                <?php include('../includes/tables/cms_users_table.php'); ?>
                            </div>

                            <div class="tab-pane fade" id="vault_auth" role="tabpanel">
                                <form method="post" action="">
                                    <div class="row">
                                        <div class="pd-20 col-4">
                                            <div class="form-group">
                                                <br>
                                                <label>Select User :</label>
                                                <select id="userSelect" class="custom-select2 form-control"
                                                        data-style="btn-outline-primary" data-size="5" name="user"
                                                        style="width: 100%; height: 38px">
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
                                                <select id="vaultTypeSelect" class="custom-select2 form-control"
                                                        data-style="btn-outline-primary" data-size="5" name="vault_type"
                                                        style="width: 100%; height: 38px">
                                                    <!--                                               <optgroup label="Select Vault Type">-->
                                                    <option value="">Select Vault Type</option>
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
                                                <select id="vaultSelect" class="custom-select2 form-control"
                                                        data-style="btn-outline-primary" data-size="5" name="vault_acc"
                                                        style="width: 100%; height: 38px">
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

                                        <script>
                                            // Function to fetch vaults based on user and vault type
                                            function fetchVaults() {
                                                var userId = $('#userSelect').val();
                                                var vaultType = $('#vaultTypeSelect').val();

                                                // Construct the API URL based on selected values
                                                var apiUrl = `http://localhost:7878/api/utg/cms/vault/getVaultsByBranchAndType/Harare/Internal Vault}`;

                                                // Make an AJAX request to fetch the vaults
                                                $.ajax({
                                                    url: apiUrl,
                                                    method: 'GET',
                                                    success: function (response) {
                                                        // Populate the vault select options based on the fetched data
                                                        var vaultSelect = $('#vaultSelect');
                                                        vaultSelect.empty();

                                                        $.each(response, function (index, vault) {
                                                            vaultSelect.append(`<option value="${vault.id}">${vault.name} (${vault.account})</option>`);
                                                        });
                                                    },
                                                    error: function (xhr, status, error) {
                                                        console.error('Error fetching vaults:', error);
                                                    }
                                                });
                                            }

                                            // Attach event listeners to user and vault type selects
                                            $('#userSelect, #vaultTypeSelect').change(function () {
                                                fetchVaults(); // Fetch and update vaults when values change
                                            });
                                        </script>

                                        <div class="col-2 pd-20 form-group">
                                            <br>
                                            <label>.</label>
                                            <!--                                        <input class="form-control" type="hidden" name="userid" required value="-->
                                            <?php //echo $_SESSION['userid'] ?><!--">-->
                                            <button type="submit" name="add_vault_permissions"
                                                    class="btn btn-success btn-lg btn-block">Grant Permission
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <?php include('../includes/tables/cms_permissions_table.php'); ?>
                            </div>


                            <div class="tab-pane fade" id="vaults" role="tabpanel">
                                <?php include('../includes/tables/cash_management/cash_receipts.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="auditTrail" role="tabpanel">
                                <?php include('../includes/tables/cash_management/list-audit-trail.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--        --><?php //include('../includes/tables/users_table.php'); ?>

        <?php } elseif ($_GET['menu'] == 'add_vault') {
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
                            <input class="form-control" type="text" name="account" placeholder="Vault Account"
                                   required/></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="name" placeholder="Vault Name" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Type</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select2 form-control" name="type" style="width: 100%; height: 38px">
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
                            <select class="custom-select2 form-control" name="branch" style="width: 100%; height: 38px">
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

        <?php } elseif ($_GET['menu'] == 'update_vault') { ?>

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
                $postData = array(
                    'id' => $_POST['id'],
                    'account' => $_POST['account'],
                    'name' => $_POST['vaultName'],
                    'type' => $_POST['type'],
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
                            <input class="form-control" type="text" name="account" placeholder="Vault Account"
                                   value="<?php echo $table['account'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="vaultName" placeholder="Vault Account"
                                   value="<?php echo $table['name'] ?>" required/>
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

        <?php } elseif ($_GET['menu'] == 'delete_vault') { ?>

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
