<!-- table widget -->
<?php
    

?>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">
			BCC Final Decision
		</h4>
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover multiple-select-row nowrap">
			<thead>
				<tr>
					<th>Applied On</th>
					<th>Name</th>					
					<th>Bsn Sector</th>
					<th>Loan Amount</th>
					<th>Tenure</th>
					<th>Boco</th>
					<th>Loan Officer</th>
					<th>Stage</th>										
					<th class="datatable-nosort">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$bcc_final_decision = loans('/finalizedLoan/ACCEPTED/'.$_SESSION['branch'].'/bm_scheduled_meeting/branch');
					foreach ($bcc_final_decision as $final): ?>
				<tr>
					<td><?php echo convertDateFormat($final['createdAt']); ?></td>
					<td class="table-plus"><?php echo $final['firstName']; ?> <?php echo $final['lastName']; ?></td>
					<td><?php echo $final['industryCode']; ?></td>
					<td><?php echo "$ ".$final['loanAmount'].".00"; ?></td>
					<td><?php echo $final['tenure']." months"; ?></td>
					<td><?php $boco = user($final['loanStatusAssigner']);
                            echo $boco['firstName'].' '.$boco['lastName'];
                        ?>
                    </td>
					<td><?php $lo = user($final['processedBy']);
                            echo $lo['firstName'].' '.$lo['lastName'];
                            echo $final['processedBy']; ?>
                    </td>
					<td><?php echo $final['pipelineStatus']; ?></td>
					<td>
						<div class="dropdown">
							<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href="loan_info.php?menu=bcc_final&loan_id=<?php echo $final['id']; ?>&userid=<?php echo $final['userId'] ;?>"><i class="dw dw-note"></i>Set Decision</a>
							</div>
						</div>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>