
<div class="card-box mb-30">
    <div class="pd-20">
        <div class="row">
            <div class="col-9">
                <h4 class="text-blue h4">Pending Cash Transactions Vouchers</h4>
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
            $voucher = cms_withdrawal_voucher($_SESSION['userId'], $firstApprovalStatus, $secondApprovalStatus);
            foreach ($voucher as $row):?>
                <!-- The Delete Modal-->
                <div class="modal fade show" data-backdrop="static" id="deleteModal<?= htmlspecialchars($row["id"]) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-center font-8">
                                <h3 class="mb-20">
                                    You are about to permanently delete this transaction voucher. This cannot be undone. Confirm to proceed.
                                </h3>
                                <div class="mb-30 text-center">
                                    <img src="../vendors/images/caution-sign.png"  alt=""/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-center row"> <!-- Full width column for button -->
                                    <div class="input-group mb-3 d-flex justify-content-center">
                                        <form action="" method="POST">
                                            <input type="text" id="transactionId" name="transactionId" value="<?= htmlspecialchars($row["id"]) ?>">
                                            <input type="submit" name="deleteTransactionVoucher" class="btn btn-danger" value="Confirm">
                                        </form>
                                        <a class="btn btn-secondary btn-lg ml-2" href="cash_management.php?menu=main">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <tr>
                    <td><?= htmlspecialchars($row["applicationDate"]) ?></td>
                    <td><?= htmlspecialchars($row["referenceNumber"]) ?></td>

                    <td><?= htmlspecialchars($row["firstApprover"]['firstName']) . " " . htmlspecialchars($row["firstApprover"]['lastName']) . " - " ?>

                        <?php if ($row['firstApprovalStatus'] == "APPROVED") {
                            echo "<label style='padding: 6px;' class='badge badge-success'>APPROVED</label>";
                        }
                        if ($row['firstApprovalStatus'] == "PENDING") {
                            echo "<label style='padding: 6px;' class='badge badge-warning'>PENDING</label>";
                        }
                        if ($row['firstApprovalStatus'] == "REVISE") {
                            echo "<label style='padding: 6px;' class='badge badge-warning'>REVERTED</label>";
                        }
                        if ($row['firstApprovalStatus'] == "DECLINED") {
                            echo "<label style='padding: 6px;' class='badge badge-danger'>DECLINED</label>";
                        }

                        ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row["secondApprover"]['firstName']) . " " . htmlspecialchars($row["secondApprover"]['lastName']) . " - " ?>
                        <?php if ($row['secondApprovalStatus'] == "APPROVED") {
                            echo "<label style='padding: 6px;' class='badge badge-success'>APPROVED</label>";
                        }
                        if ($row['secondApprovalStatus'] == "PENDING") {
                            echo "<label style='padding: 6px;' class='badge badge-warning'>PENDING</label>";
                        }
                        if ($row['secondApprovalStatus'] == "REVISE") {
                            echo "<label style='padding: 6px;' class='badge badge-warning'>REVERTED</label>";
                        }
                        if ($row['secondApprovalStatus'] == "DECLINED") {
                            echo "<label style='padding: 6px;' class='badge badge-danger'>DECLINED</label>";
                        }
                        ?>
                    </td>


                    <td><?= '$' . number_format($row["amount"], 2) . " (" . htmlspecialchars($row["currency"]) . ")" ?></td>
                    <td><?= htmlspecialchars($row["withdrawalPurpose"]) ?></td>
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
                                <?php
                                if ($row['secondApprovalStatus'] != "APPROVED") {
                                    $transId = $row['id'];
                                    echo "<a  class='dropdown-item' href='../boco/update_transaction_voucher.php?transactionId=$transId'><i class='dw dw-edit2'></i> Edit</a>";
                                }
                                ?>
                                <?php
                                if ($row['secondApprovalStatus'] != "APPROVED") {
                                    echo '
                                    <button id="deleteModal'. $row["id"] .'" data-toggle="modal" data-target="#deleteModal'. $row["id"] .'" class="dropdown-item">
                                <i class="dw dw-delete-3"></i> Delete 
                                </button>';
                                }
                                ?>
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

