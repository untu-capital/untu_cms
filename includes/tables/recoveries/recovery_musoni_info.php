<!-- table widget -->
<?php 
	// include('controllers.php');
?>
<!--<div class="card-box mb-30">-->
	<div class="pb-20">
        <table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Office name</th>
					<th>Loan officer</th>
					<th>Client name</th>
					<th>Amount ($)</th>
					<th>Principal ($)</th>
					<th>Total due ($)</th>
					<th>Days in arrears</th>
					<th>Days since payment</th>
<!--					<th>Status</th>-->
				</tr>
			</thead>
            <tbody>
                <?php
                $musoni_recovery = musoni_recovery_by_id($_GET['recovery_id']);
                    ?>
                    <tr>
                        <td><?php echo $musoni_recovery['office']; ?></td>
                        <td><?php echo $musoni_recovery['loanOfficer']; ?></td>
                        <td><?php echo $musoni_recovery['clientName']; ?></td>
                        <td><?php echo "$" . number_format($musoni_recovery['amount'], 2); ?></td>
                        <td><?php echo "$" . number_format($musoni_recovery['principal'], 2); ?></td>
                        <td><?php echo "$" . number_format($musoni_recovery['totalDue'], 2); ?></td>
                        <td><?php echo $musoni_recovery['daysInArrears']; ?></td>
                        <td><?php echo $musoni_recovery['daysSincePayment']; ?></td>
                    </tr>
            </tbody>
		</table>
	</div>

    <div class="pb-20">
        <table class="table table-striped table-bordered" id="table_field">
            <tr>
                <th>Repayment Type</th>
                <th>Agreed Amount ($)</th>
                <th>Legal</th>
                <th>Status</th>
                <th>Movement ($)</th>
                <th>Timeline</th>
            </tr>

            <?php $last_action = last_saved_action_plan($_GET['recovery_id']); ?>
            <tr>
                <td><?php echo $last_action['repaymentType']; ?></td>
                <td><?php echo "$" . number_format($last_action['agreedAmount'], 2); ?></td>
                <td><?php echo $last_action['legalEntity']; ?></td>
<!--                <td>--><?php //echo $last_action['status']; ?><!--</td>-->
                <td>
                    <span class="badge badge-pill" data-color="#fff"
                        <?php if ($last_action['status'] === 'ON_TRACK'): ?>
                            data-bgcolor="#d64b4b"
                            <?php echo "On Track"; ?>
                        <?php elseif ($last_action['status'] === 'OFF_TRACK'): ?>
                            data-bgcolor="#2DB83D"
                            <?php echo "Off Track"; ?>
                        <?php else: ?>
                            data-bgcolor="#7d8cff"
                            <?php echo "Unknown"; ?>
                        <?php endif; ?>>
                    </span>
                </td>

                <td><?php echo "$" . number_format($last_action['movementAmount'], 2); ?></td>

                <td>
                    <?php
                    $start_date = strtotime($last_action['startDate']);
                    if ($last_action['repaymentType'] === 'WEEKLY') {
                        $new_date = strtotime('+1 week', $start_date);
                    } elseif ($last_action['repaymentType'] === 'MONTHLY') {
                        $new_date = strtotime('+1 month', $start_date);
                    }
                    echo date('d F Y', $new_date);
                    ?>
                </td>


            </tr>

        </table>
    </div>
<!--</div>-->