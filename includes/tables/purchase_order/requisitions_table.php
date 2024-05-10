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
                        echo " Purchase Order Requisitions ( ". $req_status ." )";
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
					<th>Initial Amount</th>
					<th>ZIMRA Tax</th>
					<th>Revised Amount</th>
                    <th>Count</th>
                    <th>Requisition Approval</th>
                    <th>Finance Approval</th>
                    <th>Teller</th>
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
					<td class="table-plus"><?php echo $totalAmount; ?>

					<td><?php
						$sup = suppliers("/" . $transaction['poSupplier']);
						if ($sup['tax_id_no'] === null && $totalAmount > 1000) {
                            $tax=0;
							$discountedAmount = $totalAmount * 0.3;
							echo "$ ".number_format($discountedAmount,'2','.',',');
                        } else {
							echo "$ ".number_format($tax,'2','.',',');
						}
						?>

					</td>
                    <td><?php
                        $sup = suppliers("/" . $transaction['poSupplier']);
                        if ($sup['tax_id_no'] === null && $totalAmount > 1000) {
                            $discountedAmount = $totalAmount * 0.7;
                            echo "$ ".number_format($discountedAmount,'2','.',',');
                        } else {
                            echo "$ ".number_format($totalAmount,'2','.',',');
                        }
                        ?>
                    </td>
                    <td><?php echo $transactionCount; ?></td>
					<td><?php $user = user($data['poApprover']);
                        echo $user['firstName']." ".$user['lastName']; ?></td>
                    <td><?php $user = user($data['cmsApprover']);
                        echo $user['firstName']." ".$user['lastName']; ?></td>
                    <td><?php $user = user($data['teller']);
                        echo $user['firstName']." ".$user['lastName']; ?></td>
                    <td>
                        <!-- <span class="badge badge-pill" data-bgcolor="#FF0000" data-color="#fff">
						<?= htmlspecialchars ($data['poStatus']) ?></span> -->

                        <?php if ($data['poStatus'] =="PENDING APPROVAL") {
                            echo "<label style='padding: 7px;' class='badge badge-warning'>$data[poStatus]</label>";
                        } elseif ($data['poStatus'] =="PAID") {
                            echo "<label style='padding: 7px;' class='badge badge-success'>$data[poStatus]</label>";
                        } elseif ($data['poStatus'] =="PAYMENT APPROVED") {
                            echo "<label style='padding: 7px;' class='badge badge-info'>$data[poStatus]</label>";
                        } elseif ($data['poStatus'] =="DECLINED") {
                            echo "<label style='padding: 7px;' class='badge badge-primary'>$data[poStatus]</label>";
                        } else {
                            echo "<label style='padding: 7px;' class='badge badge-dark'>$data[poStatus]</label>";
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
                                <?php } elseif ($_SESSION['role'] == "ROLE_BOCO" && $data['teller'] != ""){ ?>
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