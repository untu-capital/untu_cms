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
                ?>
                <tr>
                    <td><?php echo convertDateFormat($data['createdAt']); ?></td>
                    <td><?php echo $data['poNumber']; ?></td>
                    <td class="table-plus"><?php echo $data['poName']; ?></td>
                    <td class="table-plus"><?php echo "$ " . number_format($data['poTotal'], 2, '.', ','); ?></td>
                    <td><?php echo $data['zimraTax'] ?></td>

                    <td><?php echo "$ " . number_format($data['poTotal'] - $data['zimraTax'], 2, '.', ','); ?></td>

                    <td><?php echo $data['poCount']; ?></td>
                    <td><?php echo $data['poApproverName']; ?></td>
                    <td><?php echo $data['cmsApproverName']; ?></td>
                    <td><?php echo $data['tellerName']; ?></td>

                    <td>
                        <?php if ($data['poStatus'] == "PENDING APPROVAL") {
                            echo "<label style='padding: 7px;' class='badge badge-warning'>$data[poStatus]</label>";
                        } elseif ($data['poStatus'] == "PAID") {
                            echo "<label style='padding: 7px;' class='badge badge-success'>$data[poStatus]</label>";
                        } elseif ($data['poStatus'] == "PAYMENT APPROVED") {
                            echo "<label style='padding: 7px;' class='badge badge-info'>$data[poStatus]</label>";
                        } elseif ($data['poStatus'] == "DECLINED") {
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