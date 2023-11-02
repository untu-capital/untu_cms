<!-- table widget -->
<div class="card-box">
	<div class="pd-20">
		<form action="campaign_and_marketing.php?menu=add_sectors" method="post">
			<button class="btn btn-lg btn-primary" type="submit" name="add_sectors" style="margin-bottom: 15px;">Add Sector</button>
		</form>
	</div>
	<!-- <div class="pb-20"> -->
	<table class="data-table table stripe hover multiple-select-row nowrap">
		<thead>
		<tr>
			<th>Creation Date</th>
			<th>Sector Name</th>
			<th>Sub-Sectors</th>
			<th>Status</th>
			<th class="datatable-nosort">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$industries = industries();
		foreach($industries as $data): ?>
			<tr>
				<td><?php echo date('d-M-Y', strtotime($data['createdAt'])) ;?></td>
				<td class="table-plus"><?php echo $data['name'] ;?></td>
				<td><?php echo $data['subSector'] ;?></td>
				<td>
					<?php if ($data['status'] == 1){ ?>
						<span class="badge badge-success" data-bgcolor="#2DB83D" data-color="#fff"><?php echo "Active" ;?></span>
					<?php } else { ?>
						<span class="badge badge-warning" data-color="#fff"><?php echo "Disabled" ;?></span>
					<?php } ?>
				</td>
				<td>
					<div class="dropdown">
						<a
							class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<i class="dw dw-more"></i>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href="#"
							><i class="dw dw-eye"></i> View</a
							>
							<a class="dropdown-item" href="edit.php?menu=sector&id=<?=$data["id"] ?>" ><i class="dw dw-edit2"></i> Edit</a>
							<a class="dropdown-item" href="#"
							><i class="dw dw-delete-3"></i> Delete</a
							>
						</div>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<!-- </div> -->
</div>