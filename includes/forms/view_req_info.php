<?php if ($_GET['menu'] == 'req'){ ?>
    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 card-box">
            <?php
                $req = requisitions('/'.$_GET['req_id']);
                $req_trans = req_trans("/getByRequisitionId/".$_GET['req_id']);
            ?>

            <div class="row">
                <div class="col-9"><h5 class="card-title text-blue" style="text-decoration: underline;">PO NUMBER: #<?php echo $req['poNumber'] ?></h5></div>
                <div class="col-3"><h5 class="card-title text-blue" style="text-decoration: underline;">Status: <?php echo $req['poStatus'] ?></h5></div>
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
                                                    <input type="text" class="form-control" disabled placeholder="<?php echo $req['poName'] ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Requisition Date:</label>
                                                    <input type="text" class="form-control" placeholder="<?php echo date('d M Y', strtotime($req['createdAt'])); ?>" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php
                                            // Assuming you have retrieved the transactions and stored them in a variable called $req
                                            $transactionCount = count($req_trans); // Calculate the total count of transactions
                                            $totalAmount = 0; // Initialize the total amount variable

                                            foreach ($req_trans as $transaction) {
                                                // Check if 'poAmount' key exists before accessing it
                                                if (isset($transaction['poAmount'])) {
                                                    $totalAmount += (int)$transaction['poAmount']; // Sum up the transaction amounts (cast to integer for numeric addition)
                                                }
                                            }
                                            ?>

                                            <!-- Update the HTML to display the calculated values -->
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Transactions:</label>
                                                    <input type="text" class="form-control" value="<?php echo $transactionCount; ?>" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Total Amount:</label>
                                                    <input type="text" class="form-control" value="$ <?php echo number_format($totalAmount, 2); ?>" disabled />
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

                    <?php if ($req['userId'] == $_SESSION['userid'] ){ ?>
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
                                    <td>$ <?php echo number_format($row['poAmount'], 2); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item" href="req_info.php?menu=edit&req_id=<?php echo $row['id']; ?>"><i class="dw dw-edit-2"></i> Edit</a>
                                                <a class="dropdown-item" href="req_info.php?menu=delete&req_id=<?php echo $row['id']; ?>"><i class="dw dw-delete-3"></i> Delete</a>
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

                        <h5 class="card-title text-blue" ><b>Prepared By :</b> <?php $user =user($_SESSION['userid']); echo $user['firstName']." ".$user['lastName']; ?></h5>

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

                    <?php } elseif ($req['userId'] != $_SESSION['userid'] ){ ?>

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
<!--                            <div class="form-group col-6">-->
<!--                                <h5><label class="card-title text-blue" style="text-decoration: underline;">Attachments:</label></h5>-->
<!--                                <input type="file" name="attachments[]" class="form-control-file form-control height-auto" multiple />-->
<!--                            </div>-->

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

                            <h5 class="card-title text-blue" ><b>Prepared By :</b> <?php $user =user($_SESSION['userid']); echo $user['firstName']." ".$user['lastName']; ?></h5>

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
                            <div class="row">
                                <div class="col-4">
                                    <?php if ($_SESSION['role'] == "ROLE_BOARD" || $_SESSION['role'] == "ROLE_FIN" ){ ?>
                                        <button name="cms_approve_requisition" type="submit" class="btn btn-success btn-lg btn-block">Approve Requisition</button>
                                    <?php } else{ ?>
                                    <button name="po_approve_requisition" type="submit" class="btn btn-success btn-lg btn-block">Approve Requisition</button>
                                    <?php } ?>
                                </div>
                                <div class="col-6"></div>
                                <div class="col-2">
                                    <button name="request_revisions" type="submit" class="btn btn-outline-dark btn-lg btn-block">Request Revisions</button>
                                </div>
                            </div>
                        </form>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
<?php } elseif ($_GET['menu'] == 'edit'){ ?>
    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 card-box">
            <?php include('../includes/forms/create_campaign.php'); ?>
        </div>
    </div>
<?php } ?>
