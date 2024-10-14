<!-- table widget -->

<div class="card-box mb-30">
    <div class="pd-20">
        <div class="row">
            <div class="col-9">
                <h4 class="text-blue h4">Cash Transactions Vouchers</h4>
            </div>
            <div class="col-3">
                <a class="btn-lg btn-block btn-success text-white text-center"
                   href="../boco/add_transaction_voucher.php"><i class="icon-copy bi bi-plus-lg"></i>Create Transaction
                    Voucher</a>
            </div>
        </div>
    </div>
    <div class="pb-20">
        <table class="table hover table stripe multiple-select-row data-table-export nowrap">
            <thead class="small">
            <tr>
                <th>Application Date</th>
                <th>Reference No</th>
                <th>First Approver</th>
                <th>Second Approver</th>
                <th>Amount</th>
                <th>Withdrawal Purpose</th>
                <th>From Vault</th>
                <th>To Vault</th>

                <th class="datatable-nosort">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $voucher = cms_withdrawal_voucher_for_user($_SESSION['userId']);
            foreach ($voucher as $row):?>
                <tr>
                    <td><?= htmlspecialchars($row["applicationDate"]) ?></td>
                    <td><?= htmlspecialchars($row["reference"]) ?></td>

                    <td><?= htmlspecialchars($row["firstApprover"]['firstName']) . " " . htmlspecialchars($row["firstApprover"]['lastName']) . " - " ?>

                        <?php if ($row['firstApprovalStatus'] == "APPROVED") {
                            echo "<label style='padding: 6px;' class='badge badge-success'>Approved</label>";
                        } elseif ($row['firstApprovalStatus'] == "PENDING") {
                            echo "<label style='padding: 6px;' class='badge badge-warning'>Pending</label>";
                        } else {
                            echo "<label style='padding: 6px;' class='badge badge-danger'>Reverted</label>";
                        } ?></td>

                    <td><?= htmlspecialchars($row["secondApprover"]['firstName']) . " " . htmlspecialchars($row["secondApprover"]['lastName']) . " - " ?>
                        <?php if ($row['secondApprovalStatus'] == "APPROVED") {
                            echo "<label style='padding: 6px;' class='badge badge-success'>Approved</label>";
                        } elseif ($row['secondApprovalStatus'] == "REVISE") {
                            echo "<label style='padding: 6px;' class='badge badge-danger'>Reverted</label>";
                        } else {
                            echo "<label style='padding: 6px;' class='badge badge-warning'>Pending</label>";
                        } ?></td>


                    <td><?= '$' . number_format($row["amount"], 2) . " (" . htmlspecialchars($row["currency"]) . ")" ?></td>
                    <td><?php
                        $purpose = withdrawal_purposes($row["withdrawalPurpose"]);
                        echo($purpose['name']); ?></td>
                    <td><?= htmlspecialchars($row["fromVault"]["name"]) ?></td>
                    <td><?= htmlspecialchars($row["toVault"]["name"]) ?></td>
                    <td>
                        <div class="dropdown">
                            <a
                                    class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    href="#"
                                    role="button"
                                    data-toggle="dropdown"
                            >
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item"
                                   href="../boco/view_transaction_voucher.php?transactionId=<?= $row['id'] ?>"><i
                                            class="dw dw-eye"></i> View</a>
                                <?php if ($row['secondApprovalStatus'] != "APPROVED") {
                                    $transId = $row['id'];
                                    echo "<a  class='dropdown-item' href='../boco/update_transaction_voucher.php?transactionId=$transId'><i class='dw dw-edit2'></i> Edit</a>";
                                } ?>
                                <button <?php echo ($row['secondApprovalStatus'] == "APPROVED") ? "hidden" : " " ?>
                                        onclick='deleteTransaction(<?= $row['id']; ?>)' class='dropdown-item'><i
                                            class='dw dw-delete-3'></i> Delete
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function deleteTransaction(id) {

        fetch('http://localhost:7878/api/utg/cms/transaction-voucher/delete/' + id, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
        }).then(data => {
            window.location.href = "http://localhost/untu_cms/boco/cash_management.php?menu=main";
            // You can perform additional actions here after a successful deletion.
        })
            .catch(error => {
                // Handle error
                console.error('There has been a problem with your fetch operation:', error);
                alert("Failed to delete transaction. Please try again.");
            });

    }

</script>
<script src="../../../vendors/scripts/core.js"></script>
<script src="../../../vendors/scripts/script.min.js"></script>
<script src="../../../vendors/scripts/process.js"></script>
<script src="../../../vendors/scripts/layout-settings.js"></script>
<script src="../../../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="../../../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../../../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="../../../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>

<!-- buttons for Export datatable -->
<script src="../../../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="../../../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="../../../src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="../../../src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="../../../src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="../../../src/plugins/datatables/js/pdfmake.min.js"></script>
<script src="../../../src/plugins/datatables/js/vfs_fonts.js"></script>

<!-- Datatable Setting js -->
<script src="../../../vendors/scripts/datatable-setting.js"></script>
<!--  -->
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

