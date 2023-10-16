<?php
include('../session/session.php');
include('charts_data.php');
$nav_header = "Cash Management Dashboard";

include('../includes/controllers.php');
$state = $_GET['state'];
$userId = $_SESSION['userId'];
$branch = $_SESSION['branch'];

$transactionVoucher = getTransactionVoucher($_GET['transactionId']);
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
<html lang="">
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
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Withdrawal Cash Voucher</h4>
                </div>
            </div>
            <form method="POST" action="" id="withdrawalCashVoucherForm">
                <label for="initiator" hidden="hidden"></label>
                <input id="initiator" value="<?= $userId  ?>" name="initiator" hidden="hidden">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="currency">currency</label>
                            <select
                                    onselect="validateFormOnSelect()"
                                    class="custom-select2 form-control"
                                    id="currency"
                                    name="currency"
                                    style="width: 100%; height: 38px"
                            >

                                <option value="usd">USD</option>
                                <option value="zwl">ZWL</option>
                            </select>
                            <div id="error-currency" class="none has-danger d-none">
                                <div class="form-control-feedback">Please Select Currency!</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control"
                                   name="amount"
                                   required
                                   oninput="calculateValue()"
                                   id="amount">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="fromVault">Withdrawal From</label>
                            <select
                                    onchange="validateFormOnSelect()"
                                    class="custom-select2 form-control"
                                    id="fromVault"
                                    name="fromVault"
                                    style="width: 100%; height: 38px"
                            >
                                <option value="">Please Select Vault</option>
                                <?php
                                $voucher = getVaults($_SESSION['userId']);
                                foreach ($voucher as $row):?>
                                    <option value="<?= $row['vault_acc_code'] ?>">
                                        <?php
                                            $vaults = vaults($row['vault_acc_code']);
                                            echo $vaults["name"]." (".$vaults['account'].")"; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error-fromVault" class="has-danger d-none">
                                <div class="form-control-feedback">Please Select Vault!</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="toVault">Withdrawal To</label>
                            <select
                                    onchange="validateFormOnSelect()"
                                    class="custom-select2 form-control"
                                    id="toVault"
                                    name="toVault"
                                    style="width: 100%; height: 38px"
                            >
                                <option value="">Please Select Vault</option>
                                <?php
                                $voucher = getVaults($_SESSION['userId']);
                                foreach ($voucher as $row):?>
                                    <option value="<?= $row['vault_acc_code'] ?>">
                                        <?php
                                        $vaults = vaults($row['vault_acc_code']);
                                        echo $vaults["name"]." (".$vaults['account'].")"; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error-toVault" class="has-danger  d-none">
                                <div class="form-control-feedback">Please Select Vault!</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="amountInWords">Amount in Words</label>
                            <input type="text" class="form-control"
                                   required
                                   id="amountInWords"
                                   name="amountInWords">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-md-12 col-sm-10">
                                <div class="form-group">
                                    <label for="transactionPurposeSelect">Withdrawal Purpose</label>
                                    <select onchange="handleSelectChange(this)" class="custom-select2 form-control" name="withdrawalPurpose" id="transactionPurposeSelect" style="width: 100%; height: 38px">
                                        <option value="">Please Select Transaction Purpose</option>
                                        <?php
                                        $purposes = getWithdrawal();
                                        foreach ($purposes as $row):?>
                                            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row["name"]) ?></option>
                                        <?php endforeach; ?>
                                        <option value="custom">Other (Type your purpose)</option>
                                    </select>
                                    <div id="error-withdrawalPurpose" class="has-danger d-none">
                                        <div class="form-control-feedback">Please Select Withdrawal Purpose or Type Your Purpose!</div>
                                    </div>
                                </div>

                                <!-- Add a custom input field -->
                                <div class="form-group" id="customPurposeField" style="display: none;">
                                    <label for="customWithdrawalPurpose">Custom Withdrawal Purpose</label>
                                    <input type="text" class="form-control" name="customWithdrawalPurpose" id="customWithdrawalPurpose">
                                </div>

                                <script>
                                    function handleSelectChange(select) {
                                        var customField = document.getElementById("customPurposeField");
                                        var customInput = document.getElementById("customWithdrawalPurpose");

                                        if (select.value === "custom") {
                                            customField.style.display = "block";
                                            customInput.setAttribute("name", "customWithdrawalPurpose"); // Make sure the custom input is included in the form data
                                        } else {
                                            customField.style.display = "none";
                                            customInput.removeAttribute("name"); // Remove the custom input from form data
                                        }
                                    }
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="firstApprover">First Approver</label>
                            <select onchange="validateFormOnSelect()" class="custom-select2 form-control" name="firstApprover" id="firstApprover" style="width: 100%; height: 38px">
                                <option value="">Select First Approver</option>
                                <?php
                                $branch = branch_by_id('byName/'.$_SESSION['branch']);
                                $authorizers = authorisation('/branch/'.$branch['id']);
//                                echo "wer";
//                                echo "<option value=''> $branch[id]</option>"
                                foreach ($authorizers as $authorizer) {?>
                                    <option value='<?php echo $authorizer['userId'] ?>'><?php $user = user($authorizer['userId']); echo $user['firstName']."".$user['firstName'] ?></option>";
                               <?php } ?>
                            </select>
                            <div id="error-firstApprover" class="has-danger  d-none">
                                <div class="form-control-feedback">Please Select First Approver!</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="secondApprover">Second Approver</label>
                            <select onchange="validateFormOnSelect()" class="custom-select2 form-control" name="secondApprover" id="secondApprover" style="width: 100%; height: 38px">
                                <option value="">Select Second Approver</option>
                            </select>
                            <div id="error-secondApprover" class="has-danger d-none">
                                <div class="form-control-feedback">Please Select Second Aprrover!</div>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <th scope="row">
                                <label for="denomination100" hidden="hidden"></label>
                                <input type="number" class="form-control"
                                       id="denomination100"
                                       required
                                       name="denomination100"
                                       oninput="calculateValue()">
                            </th>
                            <th scope="row">
                                <label for="denomination100T" hidden="hidden"></label>
                                <input type="number" class="form-control"
                                       id="denomination100T" required
                                       name="denomination100T" readonly></th>
                        </tr>
                        <tr>
                            <th scope="row">50</th>
                            <th scope="row">
                                <label for="denomination50" hidden="hidden"></label>
                                <input type="number" class="form-control"
                                       id="denomination50" required
                                       name="denomination50"
                                       oninput="calculateValue()">
                            </th>
                            <th scope="row">
                                <label for="denomination50T" hidden="hidden"></label>
                                <input type="number" class="form-control" required
                                       id="denomination50T" name="denomination50T"
                                       readonly></th>
                        </tr>
                        <tr>
                            <th scope="row">20</th>
                            <th scope="row">
                                <label for="denomination20" hidden="hidden"></label>
                                <input type="number" class="form-control"
                                       id="denomination20" required
                                       name="denomination20"
                                       oninput="calculateValue()">
                            </th>
                            <th scope="row">
                                <label for="denomination20T" hidden="hidden"></label>
                                <input type="number" class="form-control" required
                                       id="denomination20T" name="denomination20T"
                                       readonly></th>
                        </tr>
                        <tr>
                            <th scope="row">10</th>
                            <th scope="row">
                                <label for="denomination10" hidden="hidden"></label>
                                <input type="number" class="form-control"
                                       id="denomination10" required
                                       name="denomination10"
                                       oninput="calculateValue()">
                            </th>
                            <th scope="row">
                                <label for="denomination10T" hidden="hidden"></label>
                                <input type="number" class="form-control" required
                                       id="denomination10T" name="denomination10T"
                                       readonly></th>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <th scope="row">
                                <label for="denomination5" hidden="hidden"></label>
                                <input type="number" class="form-control"
                                       id="denomination5" required
                                       name="denomination5"
                                       oninput="calculateValue()">
                            </th>
                            <th scope="row">
                                <label for="denomination5T" hidden="hidden"></label>
                                <input type="number" class="form-control" required
                                       id="denomination5T" name="denomination5T"
                                       readonly></th>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <th scope="row">
                                <label for="denomination2" hidden="hidden"></label>
                                <input type="number" class="form-control"
                                       id="denomination2" required
                                       name="denomination2"
                                       oninput="calculateValue()">
                            </th>
                            <th scope="row">
                                <label for="denomination2T" hidden="hidden"></label>
                                <input type="number" class="form-control" required
                                       id="denomination2T" name="denomination2T"
                                       readonly></th>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <th scope="row">
                                <label for="denomination1" hidden="hidden"></label>
                                <input type="number" class="form-control"
                                       id="denomination1" required
                                       name="denomination1"
                                       oninput="calculateValue()">
                            </th>
                            <th scope="row">
                                <label for="denomination1T" hidden="hidden"></label>
                                <input type="number" class="form-control" required
                                       id="denomination1T" name="denomination1T"
                                       readonly></th>
                        </tr>
                        <tr>
                            <th scope="row">0.01</th>
                            <th scope="row">
                                <label for="denominationCents" hidden="hidden"></label>
                                <input type="number" class="form-control"
                                       id="denominationCents" required
                                       name="denominationCents"
                                       oninput="calculateValue()">
                            </th>
                            <th scope="row">
                                <label for="denominationCentsT" hidden="hidden"></label>
                                <input type="number" class="form-control" required
                                       id="denominationCentsT"
                                       name="denominationCentsT" readonly></th>
                        </tr>
                        <tr>
                            <th scope="row">Total</th>
                            <th scope="row">
                                <label for="totalDenominationsT" hidden="hidden"></label>
                                <input type="number" id="totalDenominationsT"
                                       class="form-control" required
                                       name="totalDenominations" readonly></th>
                            <th scope="row">
                                <label for="totalSumT" hidden="hidden"></label>
                                <input type="text" id="totalSumT"
                                       class="form-control form-control-danger" required name="totalSumT"
                                       readonly></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-md-2 col-form-label">
                        <button class="btn btn-success"
                                type="submit"
                                name="create"
                                id="withdrawalCashVoucherButton">Save
                        </button>
                    </div>
                    <div class="col-sm-12 col-md-2 col-form-label">
                        <a href="cash_management.php?menu=main" class="btn btn-primary "
                           >Back
                        </a>
                    </div>
                </div>
                <!--                                    Javascript function to calculate the amount per denomination and total amount-->
                <script>
                    async function getAllTransactionsDefault() {
                        const purposesList = document.getElementById('transactionPurposeSelect');

                        // Fetch Transaction Type from API
                        await fetch('http://localhost:7878/api/utg/cms/transaction-purpose/all')
                            .then(response => response.json())
                            .then(data => {
                                // Loop through the data and create option elements
                                data.forEach(item => {
                                    const option = document.createElement('option');
                                    option.value = item.id; // Set the value attribute of the option
                                    option.textContent = item.name; // Set the text content of the option
                                    purposesList.appendChild(option); // Append the option to the select element
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching data:', error);
                            });

                        let branchId;
                        //Fetch Initiator details to retrieve branch details
                        await fetch('http://localhost:7878/api/utg/cms/transaction-voucher/authorizations/<?= $userId ?>')
                            .then(response => response.json())
                            .then(data => {
                                data.forEach((item)=>{
                                    branchId = item.branchId;
                                });

                            })
                            .catch(error => {
                                console.error('Error fetching data:', error);
                            });

                        console.log("Branch Id" + branchId);
                        const firstApprovers = document.getElementById('firstApprover');
                        //Fetch First Approvers
                        await fetch(`http://localhost:7878/api/utg/cms/transaction-voucher/first-approvers/${branchId}`)
                            .then(response => response.json())
                            .then(data => {
                                data.forEach(item => {
                                    const option = document.createElement('option');
                                    option.value = item.id; // Set the value attribute of the option
                                    option.textContent = `${item.firstName} ${item.lastName}`; // Set the text content of the option

                                    firstApprovers.appendChild(option); // Append the option to the select element
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching data:', error);
                            });

                        const secondApprovers = document.getElementById('secondApprover');
                        //Fetch Second Approvers
                        await fetch(`http://localhost:7878/api/utg/cms/transaction-voucher/second-approvers/${branchId}`)
                            .then(response => response.json())
                            .then(data => {
                                data.forEach(item => {
                                    const option = document.createElement('option');
                                    option.value = item.id; // Set the value attribute of the option
                                    option.textContent = `${item.firstName} ${item.lastName}`; // Set the text content of the option

                                    secondApprovers.appendChild(option); // Append the option to the select element
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching data:', error);
                            });
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        // Your JavaScript function here
                        getAllTransactionsDefault();
                    });

                    function validateFormOnSelect(){
                        const currency = document.getElementById("currency").value;
                        const error_currency = document.getElementById("error-currency");
                        if (currency.trim() !== "") {
                            error_currency.classList.add("d-none")
                        }
                        const fromVault = document.getElementById("fromVault").value;
                        const errorFromVault = document.getElementById("error-fromVault");
                        if (fromVault.trim() !== "") {
                            errorFromVault.classList.add("d-none")
                        }
                        const toVault = document.getElementById("toVault").value;
                        const error_toVault = document.getElementById("error-toVault");
                        if (toVault.trim() !== "") {
                            error_toVault.classList.add("d-none")
                        }
                        const withdrawalPurpose = document.getElementById("transactionPurposeSelect").value;
                        const error_withdrawalPurpose = document.getElementById("error-withdrawalPurpose");
                        if (withdrawalPurpose.trim() !== "") {
                            error_withdrawalPurpose.classList.add("d-none")
                        }
                        const firstApprover = document.getElementById("firstApprover").value;
                        const error_firstApprover = document.getElementById("error-firstApprover");
                        if (firstApprover.trim() !== "") {
                            error_firstApprover.classList.add("d-none")
                        }
                        const secondApprover = document.getElementById("secondApprover").value;
                        const error_secondApprover = document.getElementById("error-secondApprover");
                        if (secondApprover.trim() !== "") {
                            error_secondApprover.classList.add("d-none")
                        }
                    }

                    function validateForm(){
                        const currency = document.getElementById("currency").value;
                        const error_currency = document.getElementById("error-currency");
                        if (currency.trim() === "") {
                            error_currency.classList.remove("d-none")
                        }
                        const fromVault = document.getElementById("fromVault").value;
                        const errorFromVault = document.getElementById("error-fromVault");
                        if (fromVault.trim() === "") {
                            errorFromVault.classList.remove("d-none")
                        }
                        const toVault = document.getElementById("toVault").value;
                        const error_toVault = document.getElementById("error-toVault");
                        if (toVault.trim() === "") {
                            error_toVault.classList.remove("d-none")
                        }
                        const withdrawalPurpose = document.getElementById("transactionPurposeSelect").value;
                        const error_withdrawalPurpose = document.getElementById("error-withdrawalPurpose");
                        if (withdrawalPurpose.trim() === "") {
                            error_withdrawalPurpose.classList.remove("d-none")
                        }
                        const firstApprover = document.getElementById("firstApprover").value;
                        const error_firstApprover = document.getElementById("error-firstApprover");
                        if (firstApprover.trim() === "") {
                            error_firstApprover.classList.remove("d-none")
                        }
                        const secondApprover = document.getElementById("secondApprover").value;
                        const error_secondApprover = document.getElementById("error-secondApprover");
                        if (secondApprover.trim() === "") {
                            error_secondApprover.classList.remove("d-none")
                        }

                        return !(currency.trim() === "" || fromVault.trim() === "" || toVault.trim() === ""
                            || withdrawalPurpose.trim() === "" || firstApprover.trim() === "" || secondApprover.trim() === "");
                    }

                    document.getElementById('withdrawalCashVoucherForm').addEventListener('submit', async function (event) {

                        // Prevent the default form submission
                        event.preventDefault();



                        // Collect form data
                        const formData = new FormData(event.target);
                        const filteredFormData = new FormData();

                        for (const [name, value] of formData.entries()) {
                            // Exclude fields ending with 'from'
                            if (!name.endsWith('T')) {
                                // Include this field in the form data to be sent
                                filteredFormData.append(name, value);
                            }
                        }

                        const formDataObject = {};

                        filteredFormData.forEach((value, key) => {
                            formDataObject[key] = value;
                        });

                        const jsonData = JSON.stringify(formDataObject);

                        if(validateForm()){
                            // Send form data using Fetch API
                            await fetch('http://localhost:7878/api/utg/cms/transaction-voucher/initiate', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: jsonData,
                            })
                                .then(response => response.json()) // Assuming the response is JSON, adjust accordingly
                                .then(data => {
                                    console.log(data);
                                    window.location.href = "http://localhost/untu-systems/boco/cash_management.php?menu=main";
                                })
                                .catch(error => {
                                    // Handle errors here
                                    console.error('Error:', error);
                                });
                        }
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

                        const totalSum = total100 + total50 + total20 + total10 + total5 + total2 + total1 + totalCents;
                        const amount = parseInt(document.getElementById('amount').value) || 0;

                        if (totalSum !== amount){
                            document.getElementById('totalSumT').value = "Check if the amount entered is correct";
                        }else {
                            document.getElementById('totalSumT').value = totalSum;
                        }

                        document.getElementById('totalDenominationsT').value = denomination100 + denomination50 + denomination20 + denomination10 + denomination5 + denomination2 + denomination1 + denominationCents;
                    }
                </script>

            </form>
        </div>
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
