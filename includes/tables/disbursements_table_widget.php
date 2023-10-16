<!-- table widget -->
<?php 
	// include('controllers.php');
?>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Recent Disbursements</h4>
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover multiple-select-row nowrap">
			<thead>
				<tr>
					<th>DisbursedOn</th>
					<!-- <th>Account No.</th>					 -->
					<th>ClientName</th>
					<!-- <th>Loan Product</th> -->
					<th>Principal</th>
					<th>Tenure</th>
					<th>Interest</th>
					<th>Maturity</th>
					<!-- <th>Expected Repayment</th> -->
					<!-- <th>Total Paid</th> -->
					<th>Outstanding</th>
					<th>Branch</th>
					<th>LoanOfficer</th>								
					<th class="datatable-nosort">Action</th>
				</tr>
			</thead>
            <tbody>
                <?php
                $disbursements = disbursements($fromDate, $toDate);
                foreach ($disbursements as $data):
                    // Check if the current data row matches the branch in the session
                    if ($_SESSION['branch'] === $data['officeName']) {
                        ?>
                        <tr>
                            <td><?php echo formatJsonDate($data['actualDisbursementDate']); ?></td>
                            <td><?php echo $data['clientName']; ?></td>
                            <td><?php echo "$ " . $data['principal']; ?></td>
                            <td><?php echo $data['numberOfRepayments'] . " months"; ?></td>
                            <td><?php echo $data['interestRatePerPeriod'] . " %"; ?></td>
                            <td><?php echo formatJsonDate($data['expectedMaturityDate']); ?></td>
                            <td><?php echo "$ " . $data['totalOutstanding']; ?></td>
                            <td><?php echo $data['officeName']; ?></td>
                            <td><?php echo $data['loanOfficerName']; ?></td>
                            <td> <a class="dropdown-item" href="#"><i class="dw dw-eye"></i></a> </td>
                        </tr>
                        <?php
                    } elseif ($_SESSION['branch'] == 'Head Office' && $_SESSION['role'] != 'ROLE_BM'){ ?>
                        <tr>
                            <td><?php echo formatJsonDate($data['actualDisbursementDate']); ?></td>
                            <td><?php echo $data['clientName']; ?></td>
                            <td><?php echo "$ " . $data['principal']; ?></td>
                            <td><?php echo $data['numberOfRepayments'] . " months"; ?></td>
                            <td><?php echo $data['interestRatePerPeriod'] . " %"; ?></td>
                            <td><?php echo formatJsonDate($data['expectedMaturityDate']); ?></td>
                            <td><?php echo "$ " . $data['totalOutstanding']; ?></td>
                            <td><?php echo $data['officeName']; ?></td>
                            <td><?php echo $data['loanOfficerName']; ?></td>
                            <td> <a class="dropdown-item" href="#"><i class="dw dw-eye"></i></a> </td>
                        </tr>
               <?php     }
                endforeach;
                ?>
            </tbody>
		</table>
	</div>
</div>