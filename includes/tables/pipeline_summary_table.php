<!-- Bordered table  start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Branch Pipeline</h4>
                        <p>
                            <code></code>
                        </p>
                    </div>
                </div>
                <table class="table table-striped">
					<thead>
						<tr>

						<th scope="col">#</th>
						<th scope="col">Branch</th>
						<th scope="col">Total Disbursed</th>
						<th scope="col">Pending Disbursement</th>
						<th scope="col">Assessment</th>
						<th scope="col">Prospect</th>
						<th scope="col">Total Pipeline</th>
						<th scope="col">Repeat</th>
						<th scope="col">New</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                        $cnt = 1;
                        $pipeline_reports = pipeline_report();
                        foreach ($pipeline_reports as $pipeline_report){
                            if ($_SESSION['role'] === "ROLE_BM" ) {
                            if ($pipeline_report['branchName'] === $_SESSION['branch']){
                                ?>
                            <tr>
                                <th scope="row"><?php echo $cnt; ?></th>
                                <td><?php echo $pipeline_report['branchName']; ?></td>
                                <td><?php echo $pipeline_report['disbursements']; ?></td>
                                <td><?php echo $pipeline_report['pendingDisbursements']; ?></td>
                                <td><?php echo $pipeline_report['prospects']; ?></td>
                                <td><?php echo $pipeline_report['assessments']; ?></td>
                                <td><?php echo $pipeline_report['totalPipeline']; ?></td>
                                <td><?php echo $pipeline_report['newClients']; ?></td>
                                <td><?php echo $pipeline_report['repeatClients']; ?></td>

                            </tr>
                                <?php  $cnt++; }} else { ?>
                    <tr>
                        <th scope="row"><?php echo $cnt; ?></th>
                        <td><?php echo $pipeline_report['branchName']; ?></td>
                        <td><?php echo $pipeline_report['disbursements']; ?></td>
                        <td><?php echo $pipeline_report['pendingDisbursements']; ?></td>
                        <td><?php echo $pipeline_report['prospects']; ?></td>
                        <td><?php echo $pipeline_report['assessments']; ?></td>
                        <td><?php echo $pipeline_report['totalPipeline']; ?></td>
                        <td><?php echo $pipeline_report['newClients']; ?></td>
                        <td><?php echo $pipeline_report['repeatClients']; ?></td>

                    </tr>
                    <?php
                    $cnt++; }}?>
					</tbody>
				</table>
            </div>
            <!-- Bordered table End -->