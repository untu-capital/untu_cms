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

<div class="main-container">
    <div class="pd-ltr-20">

        <?php include('../includes/dashboard/topbar_widget.php'); ?>
        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 card-box">
                <h5 class="h4 text-blue mb-20">View Transaction voucher Details</h5>
                <div class="pd-20 card-box mb-30">
                    <form method="POST" action="" id="withdrawalCashVoucherForm">
                        <label for="id" hidden="hidden"></label>
                        <input id="id" name="id" value="<?= $transactionVoucher['id'] ?>" hidden="hidden">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="fromVault">From Vault</label>
                                <select class="custom-select2 form-control" id="fromVault" name="fromVault" style="width: 100%; height: 38px">
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
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="toVault">To Vault</label>
                                <select class="custom-select2 form-control" id="toVault" name="toVault" style="width: 100%; height: 38px">
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
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="text"
                                       value="<?= $transactionVoucher['amount'] ?>"
                                       class="form-control" name="amount" id="amount">
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group">
                                <label for="amountInWords">Amount In Words</label>
                                <input type="text" value="<?= $transactionVoucher['amountInWords'] ?>"
                                       class="form-control" name="amountInWords" id="amountInWords">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="currency">Currency</label>
                                <select
                                        class="custom-select2 form-control"
                                        id="currency"
                                        name="currency"
                                        style="width: 100%; height: 38px"
                                >

                                    <option value="usd">USD</option>
                                    <option value="zwl">ZWL</option>

                                </select></div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group">
                                <label for="transactionPurposeSelect">Withdrawal Purpose</label>
                                <select
                                        class="custom-select2 form-control"
                                        name="withdrawalPurpose"
                                        id="transactionPurposeSelect"
                                        style="width: 100%; height: 38px"
                                >
                                    <option value="">Please Select Transaction Purpose</option>
                                    <?php
                                    $purposes = getWithdrawal();
                                    foreach ($purposes as $row):?>
                                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row["name"]) ?></option>
                                    <?php endforeach; ?>
                                </select>
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
                                           name="denomination100"
                                           oninput="calculateValue()"
                                           value="<?= $transactionVoucher['denomination100'] ?>"
                                    ></th>
                                <th scope="row">
                                    <label for="denomination100T" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denomination100T"
                                           name="denomination100T" readonly></th>
                            </tr>
                            <tr>
                                <th scope="row">50</th>
                                <th scope="row">
                                    <label for="denomination50" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denomination50"
                                           name="denomination50"
                                           oninput="calculateValue()"
                                           value="<?= $transactionVoucher['denomination50'] ?>"
                                    ></th>
                                <th scope="row">
                                    <label for="denomination50T" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denomination50T" name="denomination50T"
                                           readonly></th>
                            </tr>
                            <tr>
                                <th scope="row">20</th>
                                <th scope="row">
                                    <label for="denomination20" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denomination20"
                                           name="denomination20"
                                           oninput="calculateValue()"
                                           value="<?= $transactionVoucher['denomination20'] ?>"
                                    ></th>
                                <th scope="row">
                                    <label for="denomination20T" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denomination20T" name="denomination20T"
                                           readonly></th>
                            </tr>
                            <tr>
                                <th scope="row">10</th>
                                <th scope="row">
                                    <label for="denomination10" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denomination10"
                                           name="denomination10"
                                           oninput="calculateValue()"
                                           value="<?= $transactionVoucher['denomination10'] ?>"
                                    ></th>
                                <th scope="row">
                                    <label for="denomination10T" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denomination10T" name="denomination10T"
                                           readonly></th>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <th scope="row">
                                    <label for="denomination5" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denomination5"
                                           name="denomination5"
                                           oninput="calculateValue()"
                                           value="<?= $transactionVoucher['denomination5'] ?>"
                                    ></th>
                                <th scope="row">
                                    <label for="denomination5T" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denomination5T" name="denomination5T"
                                           readonly></th>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <th scope="row">
                                    <label for="denomination2" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denomination2"
                                           name="denomination2"
                                           oninput="calculateValue()"
                                           value="<?= $transactionVoucher['denomination2'] ?>"
                                    ></th>
                                <th scope="row">
                                    <label for="denomination2T" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denomination2T" name="denomination2T"
                                           readonly></th>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <th scope="row">
                                    <label for="denomination1" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denomination1"
                                           name="denomination1"
                                           oninput="calculateValue()"
                                           value="<?= $transactionVoucher['denomination1'] ?>"
                                    ></th>
                                <th scope="row">
                                    <label for="denomination1T" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denomination1T" name="denomination1T"
                                           readonly></th>
                            </tr>
                            <tr>
                                <th scope="row">0.01</th>
                                <th scope="row">
                                    <label for="denominationCents" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denominationCents"
                                           name="denominationCents"
                                           oninput="calculateValue()"
                                           value="<?= $transactionVoucher['denominationCents'] ?>"
                                    ></th>
                                <th scope="row">
                                    <label for="denominationCentsT" hidden="hidden"></label>
                                    <input type="number" class="form-control"
                                           id="denominationCentsT"
                                           name="denominationCentsT" readonly></th>
                            </tr>
                            <tr>
                                <th scope="row">Total</th>
                                <th scope="row">
                                    <label for="totalDenominationsT" hidden="hidden"></label>
                                    <input type="number" id="totalDenominationsT"
                                           class="form-control"
                                           name="totalDenominations" readonly></th>
                                <th scope="row">
                                    <label for="totalSumT" hidden="hidden"></label>
                                    <input type="text" id="totalSumT"
                                           class="form-control form-control-danger" name="totalSumT"
                                           readonly></th>
                            </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button class="btn btn-success"
                                    type="submit"
                                    name="update_transaction"
                                    >Update
                            </button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="cash_management.php?menu=main" class="btn btn-primary "
                            >Back
                            </a>
                        </div>
                    </div>
                    </form>
                    <!--                                    Javascript function to calculate the amount per denomination and total amount-->
                    <script>

                        document.addEventListener('DOMContentLoaded', function () {
                            calculateValue();
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

                            if (totalSum !== amount) {
                                document.getElementById('totalSumT').value = "Check if the amount entered is correct";
                            } else {
                                document.getElementById('totalSumT').value = totalSum;
                            }


                            document.getElementById('totalDenominationsT').value = denomination100 + denomination50 + denomination20 + denomination10 + denomination5 + denomination2 + denomination1 + denominationCents;
                        }
                    </script>

                </div>
            </div>
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
