<?php if ($_GET['menu'] == 'req'){ ?>
    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 card-box">
            <?php
                $req = requisitions('/'.$_GET['req_id']);
                $req_trans = req_trans("/getByRequisitionId/".$_GET['req_id']);

            ?>

            <div class="row">
                <div class="col-4"><h5 class="card-title text-blue"  style="text-decoration: underline;">PO Number: #<?php echo $req['poNumber'] ?></h5></div>
                <div class="col-4"><h5 class="card-title text-blue" style="text-decoration: underline;"></div>
                <div class="col-4"><h5 class="card-title text-blue" style="text-decoration: underline;">Status: <?php echo $req['poStatus'] ?></h5></div>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade active show" id="personal_info" role="tabpanel">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="card card-box ">
                                <div class="card-body">
                                    <p class="card-text">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Requisition Name:</label>
                                                    <input type="text" class="form-control" name="req_name" disabled value="<?php echo $req['poName'] ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Requisition Date:</label>
                                                    <input type="text" class="form-control" name="req_date" value="<?php echo date('d M Y', strtotime($req['createdAt'])); ?>" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php
                                            // Assuming you have retrieved the transactions and stored them in a variable called $req
                                            $transactionCount = count($req_trans); // Calculate the total count of transactions
                                            $totalAmount = 0; // Initialize the total amount variable
                                            $discountedAmount = 0; // Initialize the total amount variable

                                            foreach ($req_trans as $transaction) {
                                                // Check if 'poAmount' key exists before accessing it
                                                if (isset($transaction['poAmount'])) {
                                                    $totalAmount += (int)$transaction['poAmount']; // Sum up the transaction amounts (cast to integer for numeric addition)
                                                }
                                            }
                                            ?>

                                            <!-- Update the HTML to display the calculated values -->
                                            <div class="col-md-2 col-sm-12">
                                                <div class="form-group">
                                                    <label>Transactions:</label>
                                                    <input type="text" class="form-control" value="<?php echo $transactionCount; ?>" disabled />
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-sm-12">
                                                <div class="form-group">
                                                    <label>Withholding Tax:</label>
                                                    <?php
                                                    foreach($req_trans as $row):
                                                    endforeach;
                                                    $sup = suppliers("/" . $row['poSupplier']);
                                                    $par = parameters();
                                                    foreach ($par as $parrr) {

                                                        if (($sup['taxClearance'] === null || $sup['taxClearance'] != 'Yes') && $totalAmount > $parrr['cumulative']) {

                                                            $discountedAmount = $totalAmount * 0.3;
                                                            echo '<input type="text" class="form-control" name="req_amount" value="$ ' . number_format($discountedAmount, 2) . '" disabled />';
                                                        } else {

                                                            echo '<input type="text" class="form-control" name="req_amount" value="$ ' . 0 . '" disabled />';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
<!--                                            <div class="col-md-4 col-sm-12">-->
<!--                                                <div class="form-group">-->
<!--                                                    <label>Total Amount:</label>-->
<!--                                                    <input type="text" class="form-control" name="req_amount" value="$ --><?php //echo number_format($totalAmount, 2); ?><!--" disabled />-->
<!--                                                </div>-->
<!--                                            </div>-->

                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Revised Amount:</label>
                                                    <?php
                                                    foreach($req_trans as $row):
                                                    endforeach;
                                                    $sup = suppliers("/" . $row['poSupplier']);
                                                    $par = parameters();
                                                    foreach ($par as $parrr){

                                                            if ($sup['taxClearance'] === 'No' && $totalAmount > $parrr['cumulative']) {

                                                                    $discountedAmount = $totalAmount * $parrr['tax'] / 100;
                                                                    $actualAmount = $totalAmount - $discountedAmount;
            //                                                        $discountedAmount = $totalAmount * 0.7;
                                                                        echo '<input type="text" class="form-control" name="req_amount" value="$ ' . number_format($actualAmount, 2) .    ' (Initial Amount : $' . number_format($totalAmount, 2) . ')" disabled />';
                                                                    } else {

                                                                        echo '<input type="text" class="form-control" name="req_amount" value="$ ' . number_format($totalAmount, 2) . '" disabled />';
                                                                    }
                                                    }
                                                     ?>

                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Status:</label>
                                                    <input type="text" class="form-control" placeholder="<?php echo $req['poStatus'] ?>" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if ($req['userId'] == $_SESSION['userid']  && is_null($req['teller'])){ ?>
                    <h5 class="card-title text-blue" ></h5>
                    <form method="post" action="" id="add_transaction">
                        <table class="table hover table-striped multiple-select-row nowrap table-bordered" id="table_field">
                            <tr>
                                <th style="width: 32%;">Item</th>
                                <th style="width: 25%;">Supplier</th>
                                <th style="width: 20%;">Category</th>
                                <th style="width: 10%;">Quantity</th>
                                <th style="width: 10%;">Currency</th>
                                <th style="width: 12%;">Amount($)</th>
                                <th style="width: 12%;">Action</th>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-control" type="text" name="item" required>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select class="custom-select2 form-control" name="supplier" required>
                                            <option value="">Choose Supplier</option>
                                            <?php $suppliers = suppliers('/all');
                                            foreach ($suppliers as $supplier) { echo "<option value='$supplier[id]'>$supplier[name]</option>";} ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select class="custom-select2 form-control" name="category" required>
                                            <option value="">Choose Category</option>
                                            <?php $categories = categories('/all');
                                            foreach ($categories as $category) { echo "<option value='$category[id]'>$category[name]</option>";} ?>
                                        </select>
                                    </div>
                                </td>

                                <td><input class="form-control" type="number" name="quantity" placeholder="1" min=0 required ></td>
                                <td>
                                    <div class="form-group">
                                        <select class="custom-select2 form-control" name="currency" required>
                                            <option value='USD'>USD</option>
                                            <option value='ZWL'>ZWL</option>
                                        </select>
                                    </div>
                                </td>
                                <td><input class="form-control" type="number" name="amount" required></td>
                                <td>
                                    <input class="form-control" type="hidden" name="req_id" value="<?php echo $_GET['req_id'] ?>" required>
                                    <button class="btn btn-outline-success" type="submit" id="add" name="add_req_trans" ><i class="icon-copy bi bi-plus-lg"></i></button>
                                </td>
                            </tr>

                            <?php foreach($req_trans as $row):?>
                                <tr>
                                    <td><?php echo $row['poItem'] ;?></td>
                                    <td><?php $sup = suppliers("/".$row['poSupplier']);
                                            echo $sup['name'] ;?></td>
                                    <td><?php $cat = categories('/'.$row['poCategory']);
                                        echo $cat['name'] ;?></td>
                                    <td><?php echo $row['poQuantity'] ;?></td>
                                    <td><?php echo $row['poCurrency'] ;?></td>
                                    <td>$ <?php echo number_format($row['poAmount'], 2); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item" href="req_info.php?menu=edit&trans_id=<?php echo $row['id']; ?>"><i class="dw dw-edit-2"></i> Edit</a>
                                                <a class="dropdown-item" href="req_info.php?menu=delete&trans_id=<?php echo $row['id']; ?>"><i class="dw dw-delete-3"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                        </table>
                    </form>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group col-6">
                            <h5><label class="card-title text-blue" style="text-decoration: underline;">Attachments:</label></h5>
                            <input type="file" name="attachments[]" class="form-control-file form-control height-auto" multiple />
                        </div>

                        <!--                    TODO: DISPLAY ATTACHMENTS-->
                        <div class="form-group col-6">
                            <h5><label class="card-title text-blue" style="text-decoration: underline;">Uploaded Files:</label></h5>
                            <ul id="fileList">
                                <?php
                                $req_attachments = requisitions('/'.$_GET['req_id']);
                                $attachments = $req_attachments['attachments'];
                                if (!empty($attachments)) {
                                    foreach ($attachments as $attachmentIndex => $file) {
                                        $filename = basename($file);
                                        echo '<li>';
//                                        echo '<span class="file-tag">' . $filename . '</span>';
                                        echo '<a href="' . $file . '" download="' . $filename . '">'.'<span class="file-tag">' . $filename . '</span>'.'</a>'." ";
                                        echo '<button type="button" style="margin: 5px;" data-bgcolor="#bd081c" data-color="#ffffff" class="delete-file btn dw dw-delete-3" data-attachment-index="' . $attachmentIndex . '"> </button>';
                                        echo '</li>';
                                    }
                                } else {
                                    echo "<li>No files uploaded yet.</li>";
                                }
                                ?>
                            </ul>
                        </div>

                        <script>
                            $(document).ready(function () {
                                $('.delete-file').on('click', function () {
                                    var attachmentIndex = $(this).data('attachment-index');

                                    // Ask for confirmation before deleting
                                    if (window.confirm('Are you sure you want to delete this attachment?')) {
                                        deleteAttachment(attachmentIndex);
                                    }
                                });

                                function deleteAttachment(attachmentIndex) {
                                    var requisitionId = <?php echo json_encode($_GET['req_id']); ?>;

                                    $.ajax({
                                        type: 'DELETE',
                                        url: 'http://localhost:7878/api/utg/requisitions/attachments/' + requisitionId + '/' + attachmentIndex,
                                        success: function (data) {
                                            // Handle success, e.g., remove the deleted file from the UI
                                            $('#fileList li:eq(' + attachmentIndex + ')').remove();
                                        },
                                        error: function (xhr, status, error) {
                                            // Handle error, e.g., show an error message
                                            console.error(error);
                                        }
                                    });
                                }
                            });
                        </script>


                        <div class="form-group">
                            <label>Notes:</label>
                            <textarea name="notes" class="form-control"><?php $req_notes = requisitions('/'.$_GET['req_id']); echo htmlspecialchars($req_notes['notes']); ?></textarea>
                        </div>

                        <h5 class="card-title text-blue" ><b>Prepared By :</b> <?php $user =user($req['userId']); echo $user['firstName']." ".$user['lastName']; ?></h5>
                        <div class="custom-control custom-checkbox mb-5">
                            <input name="add_approver" type="checkbox" class="custom-control-input" id="customCheck1-1">
                            <label class="custom-control-label" for="customCheck1-1"><b>Add Approvers</b> (Approver should be your Supervisor or someone who can act in that capacity.)</label>
                        </div>

                        <div class="form-group">
                            <select name="approvers[]" class="custom-select2 form-control" multiple="multiple" style="width: 100%">
                                <optgroup label="Choose Approvers">
                                    <?php
                                    $users = users();
                                    $req_approvers = requisitions('/'.$_GET['req_id']);
                                    foreach ($users as $user) {
                                        $userId = $user['id'];
                                        $userName = $user['firstName'] . ' ' . $user['lastName'];
                                        $isSelected = in_array($userId, $req_approvers['approvers']) ? 'selected' : '';
                                        echo "<option value='$userId' $isSelected>$userName</option>";
                                    }
                                    ?>
                                </optgroup>
                            </select>
                        </div>

                        <input class="form-control" type="hidden" name="req_id" value="<?php echo $_GET['req_id'] ?>" required>
                        <input class="form-control" type="hidden" name="po_number" value="<?php echo $req_approvers['poNumber'] ?>" required>
                        <div class="row">
                            <div class="col-4">
                                <button name="save_requisition" type="submit" class="btn btn-info btn-lg btn-block">Save Changes</button>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-2">
                                <button name="send_requisition" type="submit" class="btn btn-success btn-lg btn-block">Submit for Approval</button>
                            </div>
                        </div>
                    </form>

                    <?php } elseif ($req['userId'] != $_SESSION['userid'] || !is_null($req['teller']) || $req['teller'] !== "") { ?>

                        <h5 class="card-title text-blue" ></h5>
                        <form method="post" action="" id="add_transaction">
                            <table class="table hover table-striped multiple-select-row nowrap table-bordered" id="table_field">
                                <tr>
                                    <th style="width: 32%;">Item</th>
                                    <th style="width: 25%;">Supplier</th>
                                    <th style="width: 20%;">Category</th>
                                    <th style="width: 10%;">Quantity</th>
                                    <th style="width: 12%;">Amount($)</th>
                                </tr>
                                <?php foreach($req_trans as $row):?>
                                    <tr>
                                        <td><?php echo $row['poItem'] ;?></td>
                                        <td><?php $sup = suppliers("/".$row['poSupplier']);
                                            echo $sup['name'] ;?></td>
                                        <td><?php $cat = categories('/'.$row['poCategory']);
                                            echo $cat['name'] ;?></td>
                                        <td><?php echo $row['poQuantity'] ;?></td>
                                        <td>$ <?php echo number_format($row['poAmount'], 2,'.',','); ?></td>

                                    </tr>
                                <?php endforeach;?>
                            </table>
                        </form>

                        <form action="" method="post" enctype="multipart/form-data">

                            <!--                    TODO: DISPLAY ATTACHMENTS-->
                            <div class="form-group col-6">
                                <h5><label class="card-title text-blue" style="text-decoration: underline;">Uploaded Files:</label></h5>
                                <ul id="fileList">
                                    <?php
                                    $req_attachments = requisitions('/'.$_GET['req_id']);
                                    $attachments = $req_attachments['attachments'];
                                    if (!empty($attachments)) {
                                        foreach ($attachments as $attachmentIndex => $file) {
                                            $filename = basename($file);
                                            echo '<li>';
//                                        echo '<span class="file-tag">' . $filename . '</span>';
                                            echo '<span class="btn dw dw-file" > </span>';
                                            echo '<a href="' . $file . '" download="' . $filename . '">'.'<span class="file-tag">' . $filename . '</span>'.'</a>'." ";
                                            echo '</li>';
                                        }
                                    } else {
                                        echo "<li>No files uploaded yet.</li>";
                                    }
                                    ?>
                                </ul>
                            </div>

                            <script>
                                $(document).ready(function () {
                                    $('.delete-file').on('click', function () {
                                        var attachmentIndex = $(this).data('attachment-index');

                                        // Ask for confirmation before deleting
                                        if (window.confirm('Are you sure you want to delete this attachment?')) {
                                            deleteAttachment(attachmentIndex);
                                        }
                                    });

                                    function deleteAttachment(attachmentIndex) {
                                        var requisitionId = <?php echo json_encode($_GET['req_id']); ?>;

                                        $.ajax({
                                            type: 'DELETE',
                                            url: 'http://localhost:7878/api/utg/requisitions/attachments/' + requisitionId + '/' + attachmentIndex,
                                            success: function (data) {
                                                // Handle success, e.g., remove the deleted file from the UI
                                                $('#fileList li:eq(' + attachmentIndex + ')').remove();
                                            },
                                            error: function (xhr, status, error) {
                                                // Handle error, e.g., show an error message
                                                console.error(error);
                                            }
                                        });
                                    }
                                });
                            </script>


                            <div class="form-group">
                                <label>Notes:</label>
                                <textarea name="notes" class="form-control" disabled><?php $req_notes = requisitions('/'.$_GET['req_id']); echo htmlspecialchars($req_notes['notes']); ?></textarea>
                            </div>

                            <h5 class="card-title text-blue" ><b>Prepared By :</b> <?php $user =user($req['userId']); echo $user['firstName']." ".$user['lastName']; ?></h5>

<!--                            --><?php //echo 'user id '. $_SESSION['userId'];?><!--</form><br>-->
<!--                            --><?php
//                                if (in_array($_SESSION['userid'], $req['approvers'])) {
//                                    echo "Purchase Order ID: ";
//                                } ?>


                            <div class="custom-control mb-5">
<!--                                <input name="add_approver" type="checkbox" class="custom-control-input" id="customCheck1-1">-->
                                <label class=""><b>Listed Approvers</b> (Any Approver Listed is able to approve this requisition)</label>
                            </div>

                            <div class="form-group">
                                <select name="approvers[]" class="custom-select2 form-control" multiple="multiple" style="width: 100%" disabled>
                                    <optgroup label="Choose Approvers">
                                        <?php
                                            $users = users();
                                            $req_approvers = requisitions('/'.$_GET['req_id']);
                                            foreach ($users as $user) {
                                                $userId = $user['id'];
                                                $userName = $user['firstName'] . ' ' . $user['lastName'];
                                                $isSelected = in_array($userId, $req_approvers['approvers']) ? 'selected' : '';
                                                echo "<option value='$userId' $isSelected>$userName</option>";
                                            }
                                        ?>
                                    </optgroup>
                                </select>
                            </div>

                            <input class="form-control" type="hidden" name="req_id" value="<?php echo $_GET['req_id'] ?>" required>
                            <input class="form-control" type="hidden" name="po_number" value="<?php echo $req_approvers['poNumber'] ?>" required>
                            <?php if ($_SESSION['role'] == "ROLE_BOCO" && (!is_null($req['teller']) || $req['teller'] !== "")){ ?>

                                <input class="form-control" type="hidden" name="paidStatus" value="PAID" required>
                                <input type="hidden" class="form-control" name="req_reference" value="<?php echo $req['poNumber'] ?>" />
                                <input type="hidden" class="form-control" name="req_name" value="<?php echo $req['poName'] ?>" />
                                <input type="hidden" class="form-control" name="req_amount" value=<?php echo $totalAmount; ?> />
                                <input type="hidden" class="form-control" name="req_initiator" value="<?php echo $_SESSION['fullname']; ?>" />

                                <?php if ($req['poStatus'] != "PAID"){ ?>
                                    <button name="paid_requisition" type="submit" class="btn btn-info btn-lg btn-block">Disburse Cash</button>
                                <?php } else{ ?>
                                    <button class="btn btn-dark btn-lg btn-block" disabled>Cash Disbursed</button>
                                <?php } ?>
                            <?php } else if ($req['poStatus'] == "OPEN" && in_array($_SESSION['userid'], $req['approvers'])){ ?>

                                <div class="row">
                                    <div class="col-6">
<!--                                        --><?php //if ($_SESSION['role'] == "ROLE_BOARD" || $_SESSION['role'] == "ROLE_FIN" ){ ?>
<!--                                            <div class="row">-->
<!--                                                <div class="col">-->
<!--                                                    <h5 class="card-title text-blue" ><b>Select Teller to Disburse Amount: </b> </h5>-->
<!--                                                </div>-->
<!--                                                <div class="form-group col">-->
<!--                                                    <select id="name" class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="teller" style="width: 100%; height: 38px" required>-->
<!--                                                        <optgroup label="select user">-->
<!--                                                            --><?php
//                                                            $user = user($req['teller']);
//                                                            echo "<option value='$user[id]'>$user[firstName] $user[lastName]</option>";
//                                                            $users = untuStaff();
//                                                            foreach ($users as $user) {
//                                                                echo "<option value='$user[id]'>$user[firstName] $user[lastName]</option>";
//                                                            }
//                                                            ?>
<!--                                                        </optgroup>-->
<!--                                                    </select>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <input class="form-control" type="hidden" name="cmsStatus" value="PAYMENT APPROVED" required>-->
<!--                                            <button name="cms_approve_requisition" type="submit" class="btn btn-success btn-lg btn-block">Approve Requisition</button>-->
<!--                                        --><?php //} else{ ?>
                                            <input class="form-control" type="hidden" name="status" value="PENDING APPROVAL" required>
                                            <button name="po_approve_requisition" type="submit" class="btn btn-success btn-lg btn-block">Approve Requisition</button>
<!--                                        --><?php //} ?>
                                    </div>

                                    <div class="col-4"></div>

                                    <div class="col-2">
                                        <input class="form-control" type="hidden" name="declineStatus" value="DECLINED" required>
<!--                                        --><?php //if ($_SESSION['role'] == "ROLE_BOARD" || $_SESSION['role'] == "ROLE_FIN" ){ ?>
<!--                                            <button name="request_revisions" type="submit" class="btn btn-outline-dark btn-lg btn-block">Decline</button>-->
<!--                                        --><?php //} else{ ?>
                                            <button name="request_revision" type="submit" class="btn btn-outline-dark btn-lg btn-block">Decline</button>
<!--                                        --><?php //} ?>
                                    </div>

                                </div>
                            <?php } else {
                                if ($req['poStatus'] == "PENDING APPROVAL"){ ?>

                                    <div class="row">
                                        <div class="col-6">
                                            <?php if ($_SESSION['role'] == "ROLE_BOARD" || $_SESSION['role'] == "ROLE_FIN" ){ ?>
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-blue" ><b>Select Teller to Disburse Amount: </b> </h5>
                                                    </div>
                                                    <div class="form-group col">
                                                        <select id="name" class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="teller" style="width: 100%; height: 38px" required>
                                                            <optgroup label="select user">
                                                                <?php
                                                                $user = user($req['teller']);
                                                                echo "<option value='$user[id]'>$user[firstName] $user[lastName]</option>";
                                                                $users = untuStaff();
                                                                foreach ($users as $user) {
                                                                    echo "<option value='$user[id]'>$user[firstName] $user[lastName]</option>";
                                                                }
                                                                ?>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <input class="form-control" type="hidden" name="cmsStatus" value="PAYMENT APPROVED" required>
                                                <button name="cms_approve_requisition" type="submit" class="btn btn-success btn-lg btn-block">Approve Requisition</button>
<!--                                            --><?php //} ?>
                                        </div>

                                        <div class="col-4"></div>

                                        <div class="col-2">
                                            <input class="form-control" type="hidden" name="declineStatus" value="DECLINED" required>
<!--                                            --><?php //if ($_SESSION['role'] == "ROLE_BOARD" || $_SESSION['role'] == "ROLE_FIN" ){ ?>
                                                <button name="request_revisions" type="submit" class="btn btn-outline-dark btn-lg btn-block">Decline</button>
                                            <?php }
//                                            else{ ?>
<!--                                                <button name="request_revision" type="submit" class="btn btn-outline-dark btn-lg btn-block">Decline</button>-->
<!--                                            --><?php //}
                                            ?>
                                        </div>
                                    </div>
                                <?php }
                            }  ?>

                        </form>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
<?php } elseif ($_GET['menu'] == 'edit'){ ?>
    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 card-box">
            <?php include('../includes/forms/edit_po_transaction.php'); ?>
        </div>
    </div>
<?php } elseif ($_GET['menu'] == 'delete'){
    delete_po_transaction($_GET['trans_id'],$_GET['req_id']);
    header('Location: req_info.php?menu=req&req_id=' .$_GET['req_id']);
 } ?>
