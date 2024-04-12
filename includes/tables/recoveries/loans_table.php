<!-- table widget -->
<?php 
	// include('controllers.php');
?>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Recoveries</h4>
	</div>
	<div class="pb-20">
            <table class="table hover table stripe multiple-select-row data-table-export nowrap">
			<thead>
				<tr>
					<th>Select</th>
					<th>Office name</th>
					<th>Loan officer</th>
					<th>Client name</th>
					<th>Amount ($)</th>
					<th>Principal ($)</th>
					<th>Total due ($)</th>
					<th>Days in arrears</th>
					<th>Days since payment</th>
					<th>Status</th>
					<th class="datatable-nosort">Action</th>
				</tr>
			</thead>
            <tbody>
                <?php
                $musoni_recoveries = musoni_recoveries();
                foreach ($musoni_recoveries as $data):
                    // Check if the current data row matches the branch in the session
//                    if ($_SESSION['branch'] == 'Head Office') {
                        ?>
                        <tr>
                            <td><?php echo $data['office']; ?></td>
                            <td><?php echo $data['office']; ?></td>
                            <td><?php echo $data['loanOfficer']; ?></td>
                            <td><?php echo $data['clientName']; ?></td>
                            <td><?php echo "$" . number_format($data['amount'], 2); ?></td>
                            <td><?php echo "$" . number_format($data['principal'], 2); ?></td>
                            <td><?php echo "$" . number_format($data['totalDue'], 2); ?></td>
                            <td><?php echo $data['daysInArrears']; ?></td>
                            <td><?php echo $data['daysSincePayment']; ?></td>
                            <td><?php echo $data['status']; ?></td>
                            <td> <a class="dropdown-item" href="recoveries_tracker.php?menu=recovery_info&recovery_id=<?php echo $data['loanId']; ?>"><i class="dw dw-eye"></i></a> </td>
                        </tr>
                        <?php
//                    }
                endforeach;
                ?>
            </tbody>
		</table>
	</div>

</div>