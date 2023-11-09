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
                    <th>Date Created</th>
					<th>PO Number</th>
					<th>Name</th>
					<th>Total Amount</th>
                    <th>Count</th>
                    <th>Requisition Approval</th>
                    <th>Finance Approval</th>
					<th>Status</th>
					<th class="datatable-nosort"></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$req = requisitions($requisitionsUrl);
					foreach ($req as $data):
                        $req = requisitions('/'.$data['id']);
                        $req_trans = req_trans("/getByRequisitionId/".$data['id']);


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
				<tr>
                    <td><?php echo convertDateFormat($data['createdAt']); ?></td>
                    <td><?php echo $data['poNumber']; ?></td>
					<td class="table-plus"><?php echo $data['poName']; ?>
					<td><?php echo "$ ".number_format($totalAmount,'2','.',','); ?></td>
                    <td><?php echo $transactionCount; ?></td>
					<td><?php $user = user($data['poApprover']);
                        echo $user['firstName']." ".$user['lastName']; ?></td>
                    <td><?php $user = user($data['cmsApprover']);
                        echo $user['firstName']." ".$user['lastName']; ?></td>
                    <td>
                        <!-- <span class="badge badge-pill" data-bgcolor="#FF0000" data-color="#fff">
						<?= htmlspecialchars ($data['poStatus']) ?></span> -->

                        <?php if ($data['poStatus'] =="PAID") {
                            echo "<label style='padding: 7px;' class='badge badge-success'>$data[poStatus]</label>";
                        } else {
                            echo "<label style='padding: 7px;' class='badge badge-warning'>$data[poStatus]</label>";
                        }
                        ?>
                    </td>

					<td>
						<div class="dropdown">
							<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <?php if ($_SESSION['role'] == "ROLE_BOARD" || $_SESSION['role'] == "ROLE_FIN" && $data['poStatus'] == "PENDING APPROVAL"){ ?>
<!--                                    <a class="dropdown-item" href="cash_management.php?menu=approve&id=--><?php //=$data["id"] ?><!--" ><i class="dw dw-edit2"></i> View/(Approve)</a>-->
                                    <a class="dropdown-item" href="req_info.php?menu=req&req_id=<?php echo $data['id']; ?>"><i class="dw dw-eye"></i> View</a>
                                <?php } else{ ?>
                                    <a class="dropdown-item" href="req_info.php?menu=req&req_id=<?php echo $data['id']; ?>"><i class="dw dw-eye"></i> View</a>
                                <?php } ?>
							</div>
						</div>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>