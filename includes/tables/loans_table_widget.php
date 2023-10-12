<!-- table widget -->
<?php 
// include('../session/session.php');
//include('../includes/controllers.php');
?>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">
			<?php
				if ($state == 'progress'){echo "Applications In Progress";}
				elseif($state == 'reject'){echo "Rejected Applications";}
				else {echo "Loan Applications";}
			?>
		</h4>
	</div>
	<div class="pb-20">
        <table class="table hover table stripe multiple-select-row data-table-export nowrap">
			<thead>
				<tr>
					<th>Applied On</th>
					<th>Name</th>					
					<th>Bsn Sector</th>
					<th>Loan Amount</th>
					<th>Tenure</th>
                    <?php if ($_SESSION['role'] != 'ROLE_CLIENT') { ?>
					<th>Boco</th>
					<th>Loan Officer</th>
                    <?php } ?>
					<th>Status</th>
                    <th>Branch</th>
					<th>Stage</th>
					<th class="datatable-nosort">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$loans = loans($url);
					foreach ($loans as $data): ?>
				<tr>
                    <td>
                        <?php
                        if (isset($data['createdAt'])) {
                            echo convertDateFormat($data['createdAt']);
                        } else {
                            echo "Invalid date";
                        }
                        ?>
                    </td>

                    <td class="table-plus"><?php echo $data['firstName']; ?> <?php echo $data['lastName']; ?></td>
					<td><?php echo $data['industryCode']; ?></td>
					<td><?php echo "$ ".$data['loanAmount'].".00"; ?></td>
					<td><?php echo $data['tenure']." months"; ?></td>
                    <?php if ($_SESSION['role'] != 'ROLE_CLIENT') { ?>
					<td><?php $user = user($data['loanStatusAssigner']);
                        echo $user['firstName'].' '.$user['lastName'];?></td>
					<td><?php $user = user(htmlspecialchars($data["assignTo"]));
                        echo $user['firstName'].' '.$user['lastName'];?>
					</td>
                    <?php } ?>
					<td>
						<span class="badge badge-pill" 
							data-color="#fff"
							<?php if ($data['loanStatus'] === 'REJECTED'): ?>
								data-bgcolor="#d64b4b"
							<?php elseif ($data['loanStatus'] === 'ACCEPTED'): ?>
								data-bgcolor="#2DB83D"
							<?php else: ?>
								data-bgcolor="#7d8cff"
							<?php endif; ?>>
							<?php echo $data['loanStatus']; ?>
						</span>
					</td>
                    <td><?php echo $data['branchName']; ?></td>
					<td><?php echo $data['pipelineStatus']; ?></td>
					<td>
						<div class="dropdown">
							<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href="loan_info.php?menu=loan&loan_id=<?php echo $data['id']; ?>&userid=<?php echo $data['userId'] ;?>"><i class="dw dw-eye"></i> View</a>
                                <?php if ($_SESSION['role'] != 'ROLE_BOCO') { ?>
                                    <a class="dropdown-item" href="loan_info.php?menu=edit_loan&loan_id=<?php echo $data['id']; ?>&userid=<?php echo $data['userId'] ;?>"><i class="dw dw-edit-file"></i> Edit Loan Info</a>
                                <?php }?>
                            </div>
						</div>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>