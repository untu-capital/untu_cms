<?php
error_reporting(0);
if(isset($_POST['generate_date'])){
    $today = $_POST["date"];
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://localhost:9191/musoni/loans/interest-paid/" . $today);
    echo "http://localhost:9191/musoni/loans/interest-paid/" . $today;
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($server_response, true);
    // Check if the JSON decoding was successful
    if ($data !== null) {
        $table = $data;
    } else {
        echo "Error decoding JSON data";
    }
}
if(isset($_POST['generate_month'])){
    $from_date = $_POST["from_date"];
    $to_date = $_POST["to_date"];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://localhost:9191/musoni/loans/interest-paid/" .$from_date."/".$to_date);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($server_response, true);
    // Check if the JSON decoding was successful
    if ($data !== null) {
        $table = $data;
    } else {
        echo "Error decoding JSON data";
    }
}
if(isset($_POST['generate_month_as_today'])){
    $from_date = $_POST["from_date"];
    $to_date = $_POST["to_date"];
    $today = $_POST["date"];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://localhost:9191/musoni/loans/interest-paid/" .$from_date."/".$today."/".$to_date);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($server_response, true);
    // Check if the JSON decoding was successful
    if ($data !== null) {
        $table = $data;
    } else {
        echo "Error decoding JSON data";
    }
}
?>
<!DOCTYPE html>
<html>
	<!-- HTML HEAD -->
	<?php 
		include('../includes/header.php');
	?>
	<!-- /HTML HEAD -->
	<body>
		<div class="pre-loader">
			<div class="pre-loader-box">
				<div class="loader-logo">
					<img src="../vendors/images/deskapp-logo.svg" alt="" />
				</div>
				<div class="loader-progress" id="progress_div">
					<div class="bar" id="bar1"></div>
				</div>
				<div class="percent" id="percent1">0%</div>
				<div class="loading-text">Loading...</div>
			</div>
		</div>

		<!-- Top NavBar -->
			<?php //include('../includes/top-nav-bar.php'); ?>
		<!-- Top NavBar -->


		<!-- sidebar-left -->
		<?php // include('../includes/side-bar.php'); ?>
		<!-- /sidebar-left -->
		
		<div class="mobile-menu-overlay"></div>

		<div class="">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="title">
									<h4>Generate Interest Reports</h4>
								</div>
                                <div class="row mb-3">
                                    <div class="col-md-4 border p-2">
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-12 mb-2">
                                                    <label for="date">Pick Date</label>
                                                    <input type="date" class="form-control" name="date" id="date" required="">
                                                </div>
                                            </div>
                                            <button type="submit" value="Submit" name="generate_date" class="btn btn-primary btn-sm">Generate</button>
                                        </form>
                                    </div>
                                    <div class="col-md-8 border p-2">
                                        <form method="post">
                                            <div class="row form-row">
                                                <div class="form-group col-lg-6 mb-2">
                                                    <label for="from_date">From Date</label>
                                                    <input type="date" class="form-control" id="from_date" name="from_date" required="">
                                                </div>
                                                <div class="form-group col-lg-6 mb-2">
                                                    <label for="to_date">To Date</label>
                                                    <input type="date" class="form-control" id="to_date" name="to_date" required="">
                                                </div>
                                            </div>
                                            <button type="submit" value="Submit" name="generate_month" class="btn btn-primary btn-sm">Generate</button>
                                        </form>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
					<!-- Export Datatable start -->
					<div class="card-box mb-30">
						<div class="pd-20">
							<h4 class="text-blue h4">Data Table with Export Buttons</h4>
						</div>
						<div class="pb-20">
							<table
								class="table small hover multiple-select-row data-table-export nowrap"
							>
								<thead class="small">
									<tr class="small">
                                        <th class="table-plus datatable-nosort">Account No</th>
                                        <th>Client Id</th>
                                        <th>Client Name</th>
                                        <th>Branch</th>
                                        <th>Loan Officer</th>
                                        <th>Product</th>


<!--                                        Calculated Interest-->
                                        <th>Total Accrued Interest</th>
                                        <th>Interest Rate</th>
                                        <th>Loan Term</th>
                                        <th>Loan Term Type</th>
                                        <th>Disbursed Date</th>
                                        <th>Matured</th>
                                        <th>First Repayment Date</th>
                                        <th>Last Repayment Date</th>
                                        <th>Status</th>

<!--                                        Summary-->
                                        <th>Currency</th>
                                        <th>Principal Disbursed</th>
                                        <th>Principal Paid</th>
                                        <th>Principal WrittenOff</th>
                                        <th>Principal Outstanding</th>
                                        <th>Principal Overdue</th>
                                        <th>Interest Charged</th>
                                        <th>Interest Paid</th>
                                        <th>Interest Waived</th>
                                        <th>Interest WrittenOff</th>
                                        <th>Interest Outstanding</th>
                                        <th>Interest Overdue</th>
                                        <th>Fee Charges Charged</th>
                                        <th>Fee Charges Due At Disbursement Charged</th>
                                        <th>Fee Charges Paid</th>
                                        <th>Fee Charges Waived</th>
                                        <th>Fee Charges WrittenOff</th>
                                        <th>Fee Charges Outstanding</th>
                                        <th>Fee Charges Overdue</th>
                                        <th>Penalty Charges Charged</th>
                                        <th>Penalty Charges Paid</th>
                                        <th>Penalty Charges Waived</th>
                                        <th>Penalty Charges WrittenOff</th>
                                        <th>Penalty Charges Outstanding</th>
                                        <th>Penalty Charges Overdue</th>
                                        <th>Total Expected Repayment</th>
                                        <th>Total Repayment</th>
                                        <th>Total Expected Cost Of Loan</th>
                                        <th>Total Cost Of Loan</th>
                                        <th>Total Waived</th>
                                        <th>Total WrittenOff</th>
                                        <th>Total Outstanding</th>
                                        <th>Total Overdue</th>
                                        <th>Days In Arrears</th>
                                    </tr>
								</thead>
								<tbody>
								    <?php foreach ($table as $row):?>
                                    <tr >
                                        <td class="table-plus"><?php echo $row['loanId']; ?></td>
                                        <td><?php echo $row['clientId']; ?></td>
                                        <td><?php echo $row['clientName']; ?></td>
                                        <td><?php echo $row['branch']; ?></td>
                                        <td><?php echo $row['loanOfficer']; ?></td>
                                        <td><?php echo $row['product']; ?></td>
<!--                                        Calculated Interest-->
                                        <td><?php echo $row['totalAccruedInterest'] !== null ? $row['totalAccruedInterest'] : 0; ?></td>
                                        <td><?php echo $row['interestRate']." %"; ?></td>
                                        <td><?php echo $row['loanTerm']?></td>
                                        <td><?php echo $row['loanTermType'] ?></td>
                                        <td><?php echo $row['disbursedDate'] ?></td>
                                        <td><?php echo $row['matured'] ?></td>
                                        <td><?php echo $row['firstRepaymentDate'] ?></td>
                                        <td><?php echo $row['lastRepaymentDate'] ?></td>
                                        <td><?php echo $row['status'] ?></td>

<!--                                        Summary-->
                                        <td><?php echo $row['currency'] ?></td>
                                        <td><?php echo $row['principalDisbursed'] !== null ? $row['principalDisbursed'] : 0; ?></td>
                                        <td><?php echo $row['principalPaid'] !== null ? $row['principalPaid'] : 0; ?></td>
                                        <td><?php echo $row['principalWrittenOff'] !== null ? $row['principalWrittenOff'] : 0; ?></td>
                                        <td><?php echo $row['principalOutstanding'] !== null ? $row['principalOutstanding'] : 0; ?></td>
                                        <td><?php echo $row['principalOverdue'] !== null ? $row['principalOverdue'] : 0; ?></td>
                                        <td><?php echo $row['interestCharged'] !== null ? $row['interestCharged'] : 0; ?></td>
                                        <td><?php echo $row['interestPaid'] !== null ? $row['interestPaid'] : 0; ?></td>
                                        <td><?php echo $row['interestWaived'] !== null ? $row['interestWaived'] : 0; ?></td>
                                        <td><?php echo $row['interestWrittenOff'] !== null ? $row['interestWrittenOff'] : 0; ?></td>
                                        <td><?php echo $row['interestOutstanding'] !== null ? $row['interestOutstanding'] : 0; ?></td>
                                        <td><?php echo $row['interestOverdue'] !== null ? $row['interestOverdue'] : 0; ?></td>
                                        <td><?php echo $row['feeChargesCharged'] !== null ? $row['feeChargesCharged'] : 0; ?></td>
                                        <td><?php echo $row['feeChargesDueAtDisbursementCharged'] !== null ? $row['feeChargesDueAtDisbursementCharged'] : 0; ?></td>
                                        <td><?php echo $row['feeChargesPaid'] !== null ? $row['feeChargesPaid'] : 0; ?></td>
                                        <td><?php echo $row['feeChargesWaived'] !== null ? $row['feeChargesWaived'] : 0; ?></td>
                                        <td><?php echo $row['feeChargesWrittenOff'] !== null ? $row['feeChargesWrittenOff'] : 0; ?></td>
                                        <td><?php echo $row['feeChargesOutstanding'] !== null ? $row['feeChargesOutstanding'] : 0; ?></td>
                                        <td><?php echo $row['feeChargesOverdue'] !== null ? $row['feeChargesOverdue'] : 0; ?></td>
                                        <td><?php echo $row['penaltyChargesCharged'] !== null ? $row['penaltyChargesCharged'] : 0; ?></td>
                                        <td><?php echo $row['penaltyChargesPaid'] !== null ? $row['penaltyChargesPaid'] : 0; ?></td>
                                        <td><?php echo $row['penaltyChargesWaived'] !== null ? $row['penaltyChargesWaived'] : 0; ?></td>
                                        <td><?php echo $row['penaltyChargesWrittenOff'] !== null ? $row['penaltyChargesWrittenOff'] : 0; ?></td>
                                        <td><?php echo $row['penaltyChargesOutstanding'] !== null ? $row['penaltyChargesOutstanding'] : 0; ?></td>
                                        <td><?php echo $row['penaltyChargesOverdue'] !== null ? $row['penaltyChargesOverdue'] : 0; ?></td>
                                        <td><?php echo $row['totalExpectedRepayment'] !== null ? $row['totalExpectedRepayment'] : 0; ?></td>
                                        <td><?php echo $row['totalRepayment'] !== null ? $row['totalRepayment'] : 0; ?></td>
                                        <td><?php echo $row['totalExpectedCostOfLoan'] !== null ? $row['totalExpectedCostOfLoan'] : 0; ?></td>
                                        <td><?php echo $row['totalCostOfLoan'] !== null ? $row['totalCostOfLoan'] : 0; ?></td>
                                        <td><?php echo $row['totalWaived'] !== null ? $row['totalWaived'] : 0; ?></td>
                                        <td><?php echo $row['totalWrittenOff'] !== null ? $row['totalWrittenOff'] : 0; ?></td>
                                        <td><?php echo $row['totalOutstanding'] !== null ? $row['totalOutstanding'] : 0; ?></td>
                                        <td><?php echo $row['totalOverdue'] !== null ? $row['totalOverdue'] : 0; ?></td>
                                        <td><?php echo $row['daysInArrears'] !== null ? $row['daysInArrears'] : 0; ?></td>

                                    </tr>
                                    <?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- Export Datatable End -->
				</div>
				
			</div>
		</div>
		
		<!-- js -->
		<script src="../vendors/scripts/core.js"></script>
		<script src="../vendors/scripts/script.min.js"></script>
		<script src="../vendors/scripts/process.js"></script>
		<script src="../vendors/scripts/layout-settings.js"></script>
		<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<!-- buttons for Export datatable -->
		<script src="../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
		<script src="../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
		<script src="../src/plugins/datatables/js/buttons.print.min.js"></script>
		<script src="../src/plugins/datatables/js/buttons.html5.min.js"></script>
		<script src="../src/plugins/datatables/js/buttons.flash.min.js"></script>
		<script src="../src/plugins/datatables/js/pdfmake.min.js"></script>
		<script src="../src/plugins/datatables/js/vfs_fonts.js"></script>
		<!-- Datatable Setting js -->
		<script src="../vendors/scripts/datatable-setting.js"></script>
		<!-- Google Tag Manager (noscript) -->
		<noscript
			><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
		<!-- End Google Tag Manager (noscript) -->
	</body>
</html>
