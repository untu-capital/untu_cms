<!-- table widget -->
<div class="card-box mb-30">
    <div class="pd-20">
        <div class="row">
            <div class="col-8">
                <h4 class="text-blue h4"><?= $titleStatus ?> Cash Transactions Vouchers</h4>
            </div>
            <?php
            if ($titleStatus === "Pending") echo '
                <div class="col-4">
                <a class="btn-lg btn-block btn-success text-white text-center"
                   href="./bulk_transaction_approval.php?menu=main"><i class="icon-copy bi"></i>Bulk Approval</a>
            </div>
                '
            ?>

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
            $transactions = cms_withdrawal_voucher_by_firstApprover($_SESSION['userId'], $firstApprovalStatus);
            foreach ($transactions as $row):?>
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
                        if ($row['firstApprovalStatus'] == "DECLINED") {
                            echo "<label style='padding: 6px;' class='badge badge-danger'>DECLINED</label>";
                        }
                        if ($row['firstApprovalStatus'] == "REVISE") {
                            echo "<label style='padding: 6px;' class='badge badge-secondary'>REVISE</label>";
                        } ?>

                    </td>

                    <td><?= htmlspecialchars($row["secondApprover"]['firstName']) . " " . htmlspecialchars($row["secondApprover"]['lastName']) . " - " ?>
                        <?php if ($row['secondApprovalStatus'] == "APPROVED") {
                            echo "<label style='padding: 6px;' class='badge badge-success'>APPROVED</label>";
                        }
                        if ($row['secondApprovalStatus'] == "REVISE") {
                            echo "<label style='padding: 6px;' class='badge badge-secondary'>REVISE</label>";
                        }
                        if ($row['secondApprovalStatus'] == "PENDING") {
                            echo "<label style='padding: 6px;' class='badge badge-warning'>PENDING</label>";
                        }
                        if ($row['secondApprovalStatus'] == "DECLINED") {
                            echo "<label style='padding: 6px;' class='badge badge-warning'>DECLINED</label>";
                        }
                        ?>
                    </td>


                        <td><?= '$' . number_format($row["amount"], 2)." (".htmlspecialchars($row["currency"]).")" ?></td>
                        <td><?php $withdrawalPurpose = withdrawal_purposes($row["withdrawalPurpose"]);
                            echo $withdrawalPurpose['name']; ?></td>

                    <td><?= htmlspecialchars($row["fromVault"]["name"]) ?></td>
                    <td><?= htmlspecialchars($row["toVault"]["name"]) ?></td>
                    <td>
                        <a class="dropdown-item"
                           href="../bm/view_transaction_voucher.php?transactionId=<?= $row['id'] ?>"
                        ><i class="dw dw-eye"></i> View</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
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

