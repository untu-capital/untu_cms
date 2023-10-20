
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Access Logs</h4>
	</div>
	<div class="pb-20">
        <table class="table hover table stripe multiple-select-row data-table-export nowrap">
			<thead>
				<tr>
                    <th>Time logged</th>
                    <th>User</th>
                    <th>Activity</th>
                    <th>User Role</th>
                    <th>User Branch</th>
                    <th>Device info</th>
                    <th>ip_address</th>
				</tr>
			</thead>
			<tbody>
                <?php
                $access_logs = access_logs();
                    foreach($access_logs as $access_log):
                        $date = htmlspecialchars ($access_log["createdAt"]);
                        $createDate = new DateTime($date);
                    ?>
                    <tr>
                        <td><?= $createDate->format('d-M-Y H:i:s') ?></td>
                        <td>
                            <?php
                            $user = user($access_log['userid']);
                            echo $user["firstName"]." ".$user["lastName"]; ?>
                        </td>
                        <td><?= htmlspecialchars($access_log["activity"]) ?></td>
                        <td><?= htmlspecialchars ($access_log["role"]) ?></td>
                        <td><?= htmlspecialchars ($access_log["branch"])?></td>
                        <td><?= htmlspecialchars($access_log["deviceInfo"]) ?></td>
                        <td><?= htmlspecialchars($access_log["ipAddress"]) ?></td>
                    </tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>