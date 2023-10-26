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
                        else {echo "List of Requisitions";}
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
					<th>Name</th>					
					<th>Date Created</th>
					<th>Total Amount</th>
					<th>Count</th>
					<th>Status</th>
					<th class="datatable-nosort"></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$req = requisitions($url);
					foreach ($req as $data): ?>
				<tr>
                    <td><?php echo $data['poNumber']; ?></td>
					<td class="table-plus"><?php echo $data['poName']; ?>
                    <td><?php echo convertDateFormat($data['createdAt']); ?></td>
					<td><?php echo "$ ".$data['poTotal'].".00"; ?></td>
					<td><?php echo $data['poCount']; ?></td>
					<td><?php echo $data['poStatus'];?></td>

					<td>
						<div class="dropdown">
							<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href="req_info.php?menu=req&req_id=<?php echo $data['id']; ?>"><i class="dw dw-eye"></i> View</a>
							</div>
						</div>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>