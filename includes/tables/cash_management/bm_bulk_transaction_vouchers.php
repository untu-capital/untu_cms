<!-- table widget -->
<div class="card-box mb-30">
    <!-- Start Modals-->
    <!-- The Modal -->
    <div class="modal" id="approvedTransactions">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Transactions Status Changes</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    The transactions status has been change successfully.
                </div>

            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal" id="failedTransactions">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Transaction Failed</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    Oops! Something went wrong. The transaction could not be saved. Please review all details and try
                    again.
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Try Again</button>
                </div>

            </div>
        </div>
    </div>
    <!-- End Modals-->
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Irreversible Action</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    Action irreversible. Review all transactions. Confirm carefully. Proceed with caution.
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <form id="bulkFirstApprove" action="" method="POST">
                        <input type="hidden" id="firstApproveListInput" name="firstApproveList">
                        <input type="submit" class="btn btn-success" value="Approve All">
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <div class="pd-20">
        <div class="row">
            <div class="col-9">
                <h4 class="text-blue h4">Pending Cash Transactions Vouchers</h4>
            </div>
            <div class="col-3">
                <!-- Button to Open the Modal -->
                <button id="bulkFirstApproveModal" type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#myModal">
                    Approve All
                </button>
            </div>
        </div>
    </div>

    <div class="pb-20">
        <table class="table hover table stripe data-table-export nowrap">
            <thead class="small">
            <tr>
                <th>Select</th>
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
            $transactions = cms_withdrawal_voucher_by_firstApprover($_SESSION['userId'], $approvalStatus);
            foreach ($transactions as $row):?>
                <tr>
                    <td>
                        <label for="checkbox<?= htmlspecialchars($row["id"]) ?>" hidden="hidden">
                        </label><input type="checkbox" id="checkbox<?= htmlspecialchars($row["id"]) ?>"
                                                                                                onclick="handleCheckboxClick(<?= htmlspecialchars($row["id"]) ?>)"></td>
                    <td><?= htmlspecialchars($row["applicationDate"]) ?></td>
                    <td><?= htmlspecialchars($row["referenceNumber"]) ?></td>
                    <td><?= htmlspecialchars($row["firstApprover"]['firstName']) . " " . htmlspecialchars($row["firstApprover"]['lastName']) . " - " ?>
                        <?php if ($row['firstApprovalStatus'] == "APPROVED") {
                            echo "<label style='padding: 6px;' class='badge badge-success'>Approved</label>";
                        } elseif ($row['firstApprovalStatus'] == "PENDING") {
                            echo "<label style='padding: 6px;' class='badge badge-warning'>Pending</label>";
                        } else {
                            echo "<label style='padding: 6px;' class='badge badge-danger'>Revise</label>";
                        } ?></td>

                    <td><?= htmlspecialchars($row["secondApprover"]['firstName']) . " " . htmlspecialchars($row["secondApprover"]['lastName']) . " - " ?>
                        <?php if ($row['secondApprovalStatus'] == "APPROVED") {
                            echo "<label style='padding: 6px;' class='badge badge-success'>Approved</label>";
                        } elseif ($row['secondApprovalStatus'] == "REVISE") {
                            echo "<label style='padding: 6px;' class='badge badge-danger'>Revise</label>";
                        } else {
                            echo "<label style='padding: 6px;' class='badge badge-warning'>Pending</label>";
                        } ?></td>


                    <td><?= '$' . number_format($row["amount"], 2) . " (" . htmlspecialchars($row["currency"]) . ")" ?></td>
                    <td><?= htmlspecialchars($row["withdrawalPurpose"]) ?></td>

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
<script>
    let objectList = []; // Define objectList outside the function
    function handleCheckboxClick(id) {
        const checkbox = document.getElementById("checkbox" + id); // Assuming checkbox IDs have a pattern like "checkbox1", "checkbox2", etc.
        if (checkbox.checked) {
            objectList.push({id: id, comment: "APPROVED", approvalStatus: "APPROVED"});
        } else {
            // If checkbox is unchecked, remove the corresponding object from the objectList
            const indexToRemove = objectList.findIndex(obj => obj.id === id);
            if (indexToRemove !== -1) {
                objectList.splice(indexToRemove, 1);
            }
        }
        // Call the function to hide the form if objectList is empty
        hideFormIfEmpty();
    }

    function updateObjectListInput() {
        // Convert the objectList array to a JSON string
        // Set the JSON data as the value of the hidden input field
        document.getElementById("firstApproveListInput").value = JSON.stringify(objectList);
    }

    // Call updateObjectListInput() before submitting the form
    document.getElementById("bulkFirstApprove").addEventListener("submit", function (event) {
        updateObjectListInput();
        console.log("Value ", document.getElementById("firstApproveListInput").value)
    });

    function hideFormIfEmpty() {
        const form = document.getElementById("bulkFirstApprove");
        const modalButton = document.getElementById("bulkFirstApproveModal");
        if (objectList.length === 0) {
            form.style.display = "none";
            modalButton.style.display = "none";
        } else {
            form.style.display = "block"; // Or set it to "inline-block", "flex", etc. depending on your layout
            modalButton.style.display = "block"; // Or set it to "inline-block", "flex", etc. depending on your layout
        }
    }

    // Call hideFormIfEmpty() initially to hide the form if the object list is empty
    hideFormIfEmpty();
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

