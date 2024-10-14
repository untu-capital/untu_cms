<!-- table widget -->
<div class="card-box mb-30">
    <!-- Start Modals-->
    <!-- Approved Transaction Modal  -->
    <div class="modal fade show" data-backdrop="static" id="approvedTransactions" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Transactions approved successfully!</h3>
                    <div class="mb-30 text-center">
                        <img src="../vendors/images/success.png"  alt=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center row"> <!-- Full width column for button -->
                        <div class="input-group mb-3 d-flex justify-content-center">
                            <a class="btn btn-secondary btn-lg ml-2" href="cash_management.php?menu=main">Dashboard</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Failed Transaction Modal  -->
    <div class="modal fade" data-backdrop="static" id="failedTransactions" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Transactions failed!</h3>
                    <div class="mb-30 text-center">
                        <img src="../vendors/images/caution-sign.png"  alt=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center"> <!-- Full width column for button -->
                        <div class="input-group mb-3 d-flex justify-content-center">
                            <a class="btn btn-secondary btn-lg ml-2" href="cash_management.php?menu=pending">Try Again</a>
                            <a class="btn btn-secondary btn-lg ml-2" href="cash_management.php?menu=main">Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- The Irreversible Modals-->
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
    <!-- End Modals-->
    <div class="pd-20">
        <div class="row">
            <div class="col-8">
                <h4 class="text-blue h4">Pending Cash Transactions Vouchers</h4>
            </div>
            <div class="col-4">
                <a class="btn-lg btn-block btn-secondary text-white text-center"
                   href="./cash_management.php?menu=main"><i class="icon-copy bi"></i>Dashboard</a>
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
            $transactions = cms_withdrawal_voucher_by_firstApprover($_SESSION['userId'], $firstApprovalStatus);
            foreach ($transactions as $row):?>
                <tr>
                    <td>
                        <label for="checkbox<?= htmlspecialchars($row["id"]) ?>" hidden="hidden">
                        </label><input type="checkbox" id="checkbox<?= htmlspecialchars($row["id"]) ?>"
                                                                                                onclick="handleCheckboxClick(<?= htmlspecialchars($row["id"]) ?>)"></td>
                    <td><?= htmlspecialchars($row["applicationDate"]) ?></td>
                    <td><?= htmlspecialchars($row["reference"]) ?></td>
                    <td><?= htmlspecialchars($row["firstApprover"]['firstName']) . " " . htmlspecialchars($row["firstApprover"]['lastName']) . " - " ?>
                        <?php if ($row['firstApprovalStatus'] == "APPROVED") {
                            echo "<label style='padding: 6px;' class='badge badge-success'>APPROVED</label>";
                        }
                        if ($row['firstApprovalStatus'] == "PENDING") {
                            echo "<label style='padding: 6px;' class='badge badge-warning'>PENDING</label>";
                        }  if ($row['firstApprovalStatus'] == "REVISE") {
                            echo "<label style='padding: 6px;' class='badge badge-secondary'>REVISE</label>";
                        }
                        if ($row['firstApprovalStatus'] == "DECLINED") {
                            echo "<label style='padding: 6px;' class='badge badge-danger'>DECLINED</label>";
                        }
                        ?></td>

                    <td><?= htmlspecialchars($row["secondApprover"]['firstName']) . " " . htmlspecialchars($row["secondApprover"]['lastName']) . " - " ?>
                        <?php if ($row['secondApprovalStatus'] == "APPROVED") {
                            echo "<label style='padding: 6px;' class='badge badge-success'>Approved</label>";
                        } if ($row['secondApprovalStatus'] == "REVISE") {
                            echo "<label style='padding: 6px;' class='badge badge-secondary'>REVISE</label>";
                        } if ($row['secondApprovalStatus'] == "PENDING") {
                            echo "<label style='padding: 6px;' class='badge badge-warning'>PENDING</label>";
                        }
                        if ($row['secondApprovalStatus'] == "DECLINED") {
                            echo "<label style='padding: 6px;' class='badge badge-danger'>DECLINED</label>";
                        }
                        ?></td>


                    <td><?= '$' . number_format($row["amount"], 2) . " (" . htmlspecialchars($row["currency"]) . ")" ?></td>
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
        <div class="col-3 mt-4">
            <!-- Button to Open the Modal -->
            <button id="bulkFirstApproveModal" type="button" class="btn btn-success" data-toggle="modal"
                    data-target="#myModal">
                Approve All
            </button>
        </div>
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

