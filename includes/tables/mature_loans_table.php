<!-- table widget -->
<?php 
	// include('controllers.php');
?>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Potential Repeat Clients</h4>
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover multiple-select-row nowrap">
			<thead>
				<tr>
					<th>Maturity Date</th>
					<!-- <th>Account No.</th>					 -->
					<th>ClientName</th>
					<!-- <th>Loan Product</th> -->
					<th>Principal</th>
					<th>Tenure</th>
					<th>Interest</th>
					<!-- <th>DisbursedOn</th> -->
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
					$disbursements = disbursements($fromDate,$toDate);
					foreach ($disbursements as $data): ?>
				<tr>
					<td><?php echo formatJsonDate($data['loanData']['expectedMaturityDate']); ?></td>
					<!-- <td class="table-plus"><?php //echo $data['accountNo']; ?></td> -->
					<td><?php echo $data['loanData']['clientName']; ?></td>
					<!-- <td><?php //echo $data['loanProductName']; ?></td> -->
					<td><?php echo "$ ".$data['loanData']['principal']; ?></td>
					<td><?php echo $data['loanData']['numberOfRepayments']." months"; ?></td>
					<td><?php echo $data['loanData']['interestRatePerPeriod']." %"; ?></td>
					<!-- <td><?php //echo formatJsonDate($data['actualDisbursementDate']); ?></td> -->
					<!-- <td><?php //echo $data['totalExpectedRepayment']; ?></td> -->
					<!-- <td><?php //echo $data['totalRepayment']; ?></td> -->
					<td><?php echo "$ ".$data['loanData']['totalOutstanding']; ?></td>
					<td><?php echo $data['loanData']['officeName']; ?></td>
					<td><?php echo $data['loanData']['loanOfficerName']; ?></td>
					<td> <a class="dropdown-item" href="#"><i class="dw dw-eye"></i></a> </td>
				</tr>
				<?php endforeach; ?>
			</tbody>



		</table>
	</div>
</div>