<!-- table widget -->
<?php 
	// include('controllers.php');
?>

<div class="card-box mb-30">
<!--	<div class="pd-20">-->
<!--		<h4 class="text-blue h4">Recoveries</h4>-->
<!--	</div>-->
	<div class="pb-20">
        <form method="post" action="">
            <div class="row">
                <!-- Your export button -->
                <div class="pd-20 col-3">
                    <button class="btn btn-block btn-outline-dark" type="submit" name="exportcsv">Export to Excel</button>
                </div>
            </div>

            <table class="checkbox-datatable hover stripe table nowrap nowrap">
                <thead>
                <tr>
                    <th>
                        <div class="dt-checkbox">
                            <input type="checkbox" name="select_all" value="1" id="example-select-all"/>
                            <span class="dt-checkbox-label"></span>
                        </div>
                    </th>
                    <th>Office name</th>
                    <th>Loan officer</th>
                    <th>Client name</th>
                    <th>Amount ($)</th>
                    <th>Principal ($)</th>
                    <th>Total due ($)</th>
                    <th>Days in arrears</th>
                    <th>Days since payment</th>
                    <th>Status</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $musoni_recoveries = musoni_recoveries();
                foreach ($musoni_recoveries as $data):
                    ?>
                    <tr>
                        <td>
                            <div class="dt-checkbox">
                                <input type="checkbox" class="row-checkbox" data-loan-id="<?php echo $data['loanId']; ?>"/>
                                <span class="dt-checkbox-label"></span>
                            </div>
                        </td>
                        <td><?php echo $data['office']; ?></td>
                        <td><?php echo $data['loanOfficer']; ?></td>
                        <td><?php echo $data['clientName']; ?></td>
                        <td><?php echo "$" . number_format($data['amount'], 2); ?></td>
                        <td><?php echo "$" . number_format($data['principal'], 2); ?></td>
                        <td><?php echo "$" . number_format($data['totalDue'], 2); ?></td>
                        <td><?php echo $data['daysInArrears']; ?></td>
                        <td><?php echo $data['daysSincePayment']; ?></td>
                        <td><?php echo $data['status']; ?></td>
                        <td> <a class="dropdown-item view-recovery-info" href="#" data-loan-id="<?php echo $data['loanId']; ?>"><i class="dw dw-eye"></i></a> </td>
                    </tr>
                <?php
                endforeach;
                ?>
                </tbody>
            </table>

            !-- Add hidden inputs for selected rows -->
            <?php foreach ($musoni_recoveries as $data): ?>
                <input type="hidden" name="selectedRows[]" value="<?php echo htmlspecialchars(json_encode($data)); ?>">
            <?php endforeach; ?>



        </form>
	</div>



</div>