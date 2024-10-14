<!-- table widget -->
<?php
// include('../session/session.php');
//include('../includes/controllers.php');
?>
<div class="card-box mb-30">
    <div class="pd-20">
        <div class="row">
            <div class="col-10">
                <h4 class="text-blue h4">
                    <?php
                    if ($state == 'progress'){echo "Applications In Progress";}
                    elseif($state == 'reject'){echo "Rejected Applications";}
                    else {echo "Purchase Order Requisitions";}
                    ?>
                </h4>
            </div>
            <div class="col-2">
                <a class="btn-lg btn-block btn-success text-white text-center" href="requisitions.php?menu=add_requisition"><i class="icon-copy bi bi-plus-lg"></i>Create Requisition</a>
            </div>
        </div>
    </div>
    <div class="pb-20">
        <table class="table hover table stripe multiple-select-row data-table-export nowrap">
            <thead>
            <tr>
                <th>PO Number</th>
                <th>Requisition name</th>
                <th>Item</th>
                <th>Date Created</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Originator</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Requisition Approval</th>
                <th>Finance Approval</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $poTransactions = poTransactions();
                foreach($poTransactions as $data):
                ?>

                <tr>
                    <td><?php echo $data['poNumber']; ?></td>
                    <td><?php echo $data['poRequisitionName']; ?></td>
                    <td class="table-plus"><?php echo $data['poItem']; ?>
                    <td><?php echo convertDateFormat($data['createdAt']); ?></td>
                    <td><?php echo "$ ".number_format($data['poAmount'],2,'.',','); ?></td>
                    <td><?php echo $data['poCurrency']; ?></td>
                    <td><?php echo $data['poOriginator']; ?></td>

                    <td><?php echo $data['poCategory']; ?></td>
                    <td><?php echo $data['poSupplier']; ?></td>
                    <td><?php echo $data['poApprover']; ?></td>
                    <td><?php echo $data['cmsApprover']; ?></td>

<!--                    <td>-->
<!--                        <div class="dropdown">-->
<!--                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>-->
<!--                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">-->
<!--                                --><?php //if ($_SESSION['role'] == "ROLE_BOARD" || $_SESSION['role'] == "ROLE_FIN" && $data['poStatus'] == "PENDING APPROVAL"){ ?>
                                    <!--                                    <a class="dropdown-item" href="cash_management.php?menu=approve&id=--><?php //=$data["id"] ?><!--" ><i class="dw dw-edit2"></i> View/(Approve)</a>-->
<!--                                    <a class="dropdown-item" href="req_info.php?menu=req&req_id=--><?php //echo $data['id']; ?><!--"><i class="dw dw-eye"></i> View</a>-->
<!--                                --><?php //} else{ ?>
<!--                                    <a class="dropdown-item" href="req_info.php?menu=req&req_id=--><?php //echo $data['id']; ?><!--"><i class="dw dw-eye"></i> View</a>-->
<!--                                --><?php //} ?>
<!--                            </div>-->
<!--                        </div>-->
<!--                    </td>-->

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>