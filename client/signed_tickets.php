<?php
include ('check_role.php');
    include('../includes/fpdf/fpdf.php');
    if (isset($_POST['generate'])) {
        class myPDF extends FPDF
        {
            function header()
            {
                //  header(){
                $this->Image('../vendors/images/logo.png', 130, 10, 28, 18);
                $this->Ln(15);

                $this->SetFont('Arial', 'B', 11);
                $this->Cell(270, 10, 'UNTU CAPITAL LTD. ', 0, 1, 'C');
                $this->Cell(270, 10, 'Predisbursement Ticket ', 0, 1, 'C');

            }

            function footer()
            {
                $this->SetY(-15);
                $this->SetFont('Arial', '', 8);
                $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
            }

            function headerTable()
            {
                $this->SetX(5);
                $this->SetFont('Times', 'B', 8);
                $this->Cell(30, 10, 'Client Name', 1, 0, 'C');
                $this->Cell(20, 10, 'Loan Amount', 1, 0, 'C');
                $this->Cell(15, 10, 'Less Fees', 1, 0, 'C');
                $this->Cell(20, 10, 'Application Fee', 1, 0, 'C');
                $this->Cell(20, 10, 'C/Handling Fee', 1, 0, 'C');
                $this->Cell(20, 10, 'Interest Rate', 1, 0, 'C');
                $this->Cell(27, 10, 'Repayment Amount', 1, 0, 'C');
                $this->Cell(15, 10, 'Branch', 1, 0, 'C');
                $this->Cell(8, 10, 'Tenor', 1, 0, 'C');
                $this->Cell(10, 10, 'Product', 1, 0, 'C');
                $this->Cell(10, 10, 'U/Fees', 1, 0, 'C');
                $this->Cell(8, 10, 'R/N', 1, 0, 'C');
                $this->Cell(20, 10, 'Loan Officer', 1, 0, 'C');
                $this->Cell(60, 10, 'Collateral', 1, 0, 'C');
                $this->Ln();
            }

            function form()
            {
            }

            function viewTable()
            {

                if (isset($_POST['generate'])) {
                    if (!empty($_POST['checkArr'])) {
                        $id = $_POST['checkArr'];
                        $array[] = '';
                        $i = 0;
                        $this->SetFont('Times', 'B', 11);
                        foreach ($_POST['checkArr'] as $checked) {
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/credit_application/$checked");
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $server_response = curl_exec($ch);
                            curl_close($ch);
                            $data = json_decode($server_response, true);

                            if ($data['bocoName'] != "") {
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/getUser/' . $data['bocoName']);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $server_response = curl_exec($ch);
                                curl_close($ch);
                                $boco_signed = json_decode($server_response, true);

                                $boconame = $boco_signed['firstName'] . ' ' . $boco_signed['lastName'];


                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/signatures/get/' . $data['bocoName']);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $server_response = curl_exec($ch);
                                curl_close($ch);
                                $boco_signature = json_decode($server_response, true);

                                $bocosignature = $boco_signature['fileName'];

                            }
                            if ($data['bmName'] != "") {
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/getUser/' . $data['bmName']);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $server_response = curl_exec($ch);
                                curl_close($ch);
                                $bm_signed = json_decode($server_response, true);

                                $bmname = $bm_signed['firstName'] . ' ' . $bm_signed['lastName'];

                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/signatures/get/' . $data['bmName']);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $server_response = curl_exec($ch);
                                curl_close($ch);
                                $bm_signature = json_decode($server_response, true);

                                $bmsignature = $bm_signature['fileName'];

                            }
                            if ($data['caName'] != "") {
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/getUser/' . $data['caName']);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $server_response = curl_exec($ch);
                                curl_close($ch);
                                $ca_signed = json_decode($server_response, true);

                                $caname = $ca_signed['firstName'] . ' ' . $ca_signed['lastName'];

                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/signatures/get/' . $data['caName']);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $server_response = curl_exec($ch);
                                curl_close($ch);
                                $ca_signature = json_decode($server_response, true);

                                $casignature = $ca_signature['fileName'];
                            }
                            if ($data['cmName'] != "") {
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/getUser/' . $data['cmName']);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $server_response = curl_exec($ch);
                                curl_close($ch);
                                $cm_signed = json_decode($server_response, true);

                                $cmname = $cm_signed['firstName'] . ' ' . $cm_signed['lastName'];

                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/signatures/get/' . $data['cmName']);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $server_response = curl_exec($ch);
                                curl_close($ch);
                                $cm_signature = json_decode($server_response, true);

                                $cmsignature = $cm_signature['fileName'];
                            }
                            if ($data['finName'] != "") {
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/getUser/' . $data['finName']);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $server_response = curl_exec($ch);
                                curl_close($ch);
                                $fin_signed = json_decode($server_response, true);

                                $finname = $fin_signed['firstName'] . ' ' . $fin_signed['lastName'];

                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/signatures/get/' . $data['finName']);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $server_response = curl_exec($ch);
                                curl_close($ch);
                                $fin_signature = json_decode($server_response, true);

                                $finsignature = $fin_signature['fileName'];
                            }

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/meetings/collateralByLoanId/' . $checked);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $server_response = curl_exec($ch);
                            curl_close($ch);

                            $data_collateral = json_decode($server_response, true);
                            $array[$i] = $data['firstName'];

                            $i++;
                            $this->SetX(5);
                            $this->SetFont('Times', '', 7);
                            $this->Cell(30, 10, $data['firstName'] . ' ' . $data['middleName'] . ' ' . $data['lastName'], 1, 0, 'C');
                            $this->Cell(20, 10, $data["meetingLoanAmount"] . ' USD', 1, 0, 'L');
                            $this->Cell(15, 10, $data["lessFees"] . ' USD', 1, 0, 'L');
                            $this->Cell(20, 10, $data["applicationFee"] . ' USD', 1, 0, 'L');
                            $this->Cell(20, 10, $data["meetingCashHandlingFee"] . ' USD', 1, 0, 'L');
                            $this->Cell(20, 10, $data["meetingInterestRate"] . ' %', 1, 0, 'L');
                            $this->Cell(27, 10, $data["meetingRepaymentAmount"], 1, 0, 'L');
                            $this->Cell(15, 10, $data["branchName"], 1, 0, 'L');
                            $this->Cell(8, 10, $data["meetingTenure"], 1, 0, 'L');
                            $this->Cell(10, 10, $data["meetingProduct"], 1, 0, 'L');
                            $this->Cell(10, 10, $data["meetingUpfrontFee"] . ' %', 1, 0, 'L');
                            $this->Cell(8, 10, $data["meetingRN"], 1, 0, 'L');
                            $this->Cell(20, 10, $data["processedBy"], 1, 0, 'L');
                            $temp = "";
                            foreach ($data_collateral as $i) {
                                $temp = $temp . ' ' . $i["collateral"] . ',';
                            }
                            $this->Cell(60, 10, $temp, 1, 0, 'L');


                            $this->Ln();
                            $this->SetFont('Times', '', 12);
                            if ($bocosignature != "") {
                                $this->Cell(10, 30, ' ', 0, 1);
                                $this->Cell(70, 7, 'Prepared By: ', 0, 0, 'L');
                                $this->Cell(70, 7, $boconame, 0, 0, 'C');
                                $image = "../../../uploads/signatures/" . $bocosignature;
//                            // Image(file name , x position , y position , width [optional] , height [optional])
//                            $this->Image($image);
                            }

                            if ($bmsignature != "") {
                                $this->Cell(10, 10, ' ', 0, 1);
                                $this->Cell(70, 7, 'Checked by Branch Manager: ', 0, 0, 'L');
                                $this->Cell(70, 7, $bmname, 0, 0, 'C');
//                            $image = "../../../uploads/signatures/".$bmsignature ;
//                            $this->Image($image);
                            }

                            if ($casignature != "") {
                                $this->Cell(10, 10, ' ', 0, 1);
                                $this->Cell(70, 7, 'Credit Checked by: ', 0, 0, 'L');
                                $this->Cell(70, 7, $caname, 0, 0, 'C');
//                            $image = "../../../uploads/signatures/".$casignature ;
//                            $this->Image($image);
                            }

                            if ($cmsignature != "") {
                                $this->Cell(10, 10, ' ', 0, 1);
                                $this->Cell(70, 7, 'Confirmed by Credit Manager: ', 0, 0, 'L');
                                $this->Cell(70, 7, $cmname, 0, 0, 'C');
//                            $image = "../../../uploads/signatures/".$cmsignature ;
//                            $this->Image($image);
                            }

                            if ($finsignature != "") {
                                $this->Cell(10, 10, ' ', 0, 1);
                                $this->Cell(70, 7, 'Finance Authorised by : ', 0, 0, 'L');
                                $this->Cell(70, 7, $finname, 0, 0, 'C');
//                            $image = "../../../uploads/signatures/".$finsignature ;
//                            $this->Image($image);
                            }
                        }
                    }
                }
            }
        }

        $pdf = new myPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage('L', 'A4', 0);
        $pdf->headerTable();
        $pdf->viewTable();
        $pdf->form();
        $pdf->Output();
    }
?>

<?php
	include('../session/session.php');
	include('../includes/controllers.php');
	$nav_header = "Signed Tickets";

    if(isset($_POST['submit'])){
        if(!empty($_POST['checkArr'])){
            foreach($_POST['checkArr'] as $checked){
                echo $checked."</br>";
            }
        }
    }

	// small widgets titles
	$widget_title = ["4", "3", "2", "1", "2", "12"];

	// small widgets descriptions
    $widget_descr = ["Tickets Signed: Harare", "Tickets Signed: HarareA", "Tickets Signed: Bulawayo", "Tickets Signed: Gweru", "Tickets Signed: Gokwe", "Total Tickets Signed"];

?>

<!DOCTYPE html>
<html>
	<!-- HTML HEAD -->
	<?php 
		include('../includes/header.php');
	?>
	<!-- /HTML HEAD -->
	<body>

		<!-- Top NavBar -->
			<?php include('../includes/top-nav-bar.php'); ?>
		<!-- Top NavBar -->

		<?php include('../includes/right-sidebar.php'); ?>

		<!-- sidebar-left -->
		<?php include('../includes/side-bar.php'); ?>
		<!-- /sidebar-left -->
		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="pd-ltr-20">
					
				<?php include('../includes/dashboard/topbar_widget.php'); ?>
					
				<?php include('../includes/dashboard/lead_summary_widget.php'); ?>

				<?php include('../includes/tables/signed_tickets_table.php'); ?>

				<?php include('../includes/footer.php');?>
			</div>
		</div>
		
		<!-- js -->
		<script src="../vendors/scripts/core.js"></script>
		<script src="../vendors/scripts/script.min.js"></script>
		<script src="../vendors/scripts/process.js"></script>
		<script src="../vendors/scripts/layout-settings.js"></script>
		<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script src="../vendors/scripts/dashboard.js"></script>

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
