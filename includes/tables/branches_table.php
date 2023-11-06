<!-- table widget -->
<div class="card-box">
	<div class="pd-20">
		<button class="btn btn-lg btn-primary" style="margin-bottom: 15px;">Add Branch</button>
	</div>
	<!-- <div class="pb-20"> -->
		<table class="data-table table stripe hover multiple-select-row nowrap">
			<thead>
				<tr>
					<th>Creation Date</th>
					<th>Branch Name</th>
					<th>Branch Address</th>
					<th>Contact No.</th>
                    <th>Activation Status</th>
					<th class="datatable-nosort">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
                $cnt = 1;
					$branches = branch();
					foreach($branches as $data): ?>
				<tr>
					<td><?php echo $cnt ;?></td>
					<td><?php echo $data['branchName'] ;?></td>
					<td><?php echo $data['branchAddress'] ;?></td>
                    <td><?php echo $data['branchTellPhone'] ;?></td>
					<td>
						<?php if ($data['branchStatus'] == 1){ ?>
						<span class="badge badge-success" data-bgcolor="#2DB83D" data-color="#fff"><?php echo "Active" ;?></span>
						<?php } else { ?>
							<span class="badge badge-warning" data-color="#fff"><?php echo "Disabled" ;?></span>
						<?php } ?>
					</td>
					<td>
						<div class="dropdown">
							<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
								<i class="dw dw-more"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
								<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
								<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
							</div>
						</div>
					</td>
				</tr>
				<?php $cnt++; endforeach; ?>
			</tbody>
		</table>
	<!-- </div> -->
</div>