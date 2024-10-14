<?php
ob_start(); // Start output buffering

if (isset($_POST['create_amortisation'])){
    // Retrieve form data
    $counterpart = "OLD MUTUAL INVESTMENT";
    $currency = $_POST['currency'];
    $amount = $_POST['amount'];
    $interest = $_POST['interest'];
    $tenure = $_POST['tenure'];
    $period = $_POST['period'];
    $repayment = $_POST['repayment'];
    $repayments = $_POST['repayments'];
    $startDate = $_POST['startDate'];

    // Create JSON object
    $amortisation_data = array(
        "amount" => $amount,
        "tenure" => $tenure,
        "repayments" => $repayments,
        "currency" => $currency,
        "counterpart" => "Old Mutual", // Assuming this is static
        "period" => $period,
        "interest" => $interest,
        "startDate" => $startDate
    );

    // Convert array to JSON
    $json_data = json_encode($amortisation_data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7272/api/treasury/amortisation/create");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);
    $error = curl_error($ch); // Added to capture any CURL errors
    curl_close($ch);

    if ($resp === false) {
        echo "CURL Error: " . $error; // Output any CURL errors
        return;
    }

    $amortisation = json_decode($resp, true);

    if ($amortisation !== null) {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        require_once('../../fpdf/fpdf.php');

//        $amortisation = deal_note($_GET['id']);

        class myAmortisationPDF extends FPDF
        {
            function header()
            {
                $imageWidth = 40; // Adjust this value according to your image width

                // Calculate X position to center the image
                $xCenter = ($this->GetPageWidth() - $imageWidth) / 2;

                $this->SetX(15);
                $this->SetFont('Arial', '', 11);
                $this->Cell(50, 8, "Untu Capital Limited", 0, 1);
                $this->SetX(15);
                $this->Cell(50, 8, "Harare", 0, 1);
                // Set X position for the image
                $this->SetX($xCenter);

                $this->SetX(15); // Set X position for the logo
                $this->Image('../../../vendors/images/logo.png', $xCenter, 10, 35, 35);
                $this->Ln(25); // Adjust Y position after the logo

                $this->SetFont('Arial', 'B', 15);

//                $amortisation = deal_note($_GET['id']);
//                $this->Cell(0, 20, 'Deal Note for '.$amortisation['liabilityType'], 0, 1, 'C');
            }

            function headerTable()
            {
//            $this->Ln(10); // Adjust Y position before the table
//            $this->SetX(15); // Set X position for the table
//            $this->SetFont('Times', '', 8);
//            $this->Cell(70, 10, 'Client Name', 0, 0, 'L');
//            $this->Cell(140, 10, 'Interest Rate', 0, 1, 'L'); // Move to the next line after the second cell
            }

            function form()
            {
                // Your form implementation goes here
            }

            function viewTable($amortisation, $counterpart, $amount, $tenure, $interest, $repayments, $currency)
            {
                if(isset($amortisation['counterParty'])) {
                    $this->SetX(20);
                    $this->SetFont('Arial', '', 12);
                    $this->Cell(50, 15, 'Counterparty :', 0, 0);
                    $this->Cell(145, 15, $amortisation['counterParty'], 0, 1);
                }

                $this->SetX(15);
                $this->SetFont('Arial', '', 18);
                $this->Cell(260, 15, 'AMORTISATION SCHEDULE - '.$counterpart.date('F Y'), 0, 1); // Example content, replace with actual data

                $this->SetX(50);
                $this->SetFont('Arial', '', 12);
                $this->Cell(50, 8, "Invested Amount", 0, 0);
                $this->Cell(50, 8, "US$".number_format($amount, 2), 0, 1);

                $this->SetX(50);
                $this->Cell(50, 8, "Tenor", 0, 0);
                $this->Cell(50, 8, $tenure." Days", 0, 1);

                $this->SetX(50);
                $this->Cell(50, 8, "Interest", 0, 0);
                $this->Cell(50, 8, $interest." %", 0, 1);

                $this->SetX(50);
                $this->Cell(50, 8, "Repayments", 0, 0);
                $this->Cell(50, 8, $repayments, 0, 1);

                $this->SetX(50);
                $this->Cell(50, 8, "Currency", 0, 0);
                $this->Cell(50, 8, $currency, 0, 1);

                $this->Ln(5);

                $this->SetX(90);
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(95, 8, "Note Amount and Balance", 1, 0, 'C');
                $this->Cell(45, 8, "Total Cost of Note", 1, 1, 'C');

                $this->SetFillColor(72, 213, 247); // Light blue / sky blue background color
                $this->SetX(10);
                $this->Cell(20, 8, "#", 1, 0, 'C', true); // With background color
                $this->Cell(40, 8, "Date", 1, 0, 'C', true); // With background color
                $this->Cell(20, 8, "# Days", 1, 0, 'C', true); // With background color
                $this->Cell(50, 8, "Principal Balance", 1, 0, 'C', true); // With background color
                $this->Cell(45, 8, "Principal Due", 1, 0, 'C', true); // With background color
                $this->Cell(45, 8, "Interest Due", 1, 0, 'C', true); // With background color
                $this->Cell(45, 8, "Repayment Due", 1, 1, 'C', true); // With background color


                $this->SetX(10);
                $this->SetFont('Arial', '', 12);
                $this->Cell(20, 8, "", 1, 0, 'C');
                $this->Cell(40, 8, "", 1, 0, 'C');
                $this->Cell(20, 8, "", 1, 0, 'C');
                $this->Cell(50, 8, "USD", 1, 0, 'C');
                $this->Cell(45, 8, "USD", 1, 0, 'C');
                $this->Cell(45, 8, "USD", 1, 0, 'C');
                $this->Cell(45, 8, "USD", 1, 1, 'C');

                if ($amortisation !== null && isset($amortisation['periods'])) {
                    $periods = $amortisation['periods']; // Get the 'periods' array from $amortisation

                    $totalDays = 0;
                    $totalPrincipalDue = 0;
                    $totalInterestDue = 0;
                    $totalRepaymentDue = 0;
                    foreach ($periods as $amortise) {
                        $totalDays += $amortise['days'];
                        $totalPrincipalDue += $amortise['principalDue'];
                        $totalInterestDue += $amortise['interestDue'];
                        $totalRepaymentDue += $amortise['repaymentDue'];

                        $this->SetX(10);
                        $this->Cell(20, 8, $amortise['period'], 1, 0, 'C'); // Use 'period' key directly
                        $this->Cell(40, 8, $amortise['date'], 1, 0, 'C');
                        $this->Cell(20, 8, $amortise['days'], 1, 0, 'C');
                        $this->Cell(50, 8, number_format($amortise['principalBalance'], 2), 1, 0, 'C');
                        $this->Cell(45, 8, number_format($amortise['principalDue'], 2), 1, 0, 'C');
                        $this->Cell(45, 8, number_format($amortise['interestDue'], 2), 1, 0, 'C');
                        $this->Cell(45, 8, number_format($amortise['repaymentDue'], 2), 1, 1, 'C');
                    }
                }

                $this->SetX(10);
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(20, 8, "", 1, 0, 'C');
                $this->Cell(40, 8, "Total", 1, 0, 'C');
                $this->Cell(20, 8, $totalDays, 1, 0, 'C');
                $this->Cell(50, 8, "", 1, 0, 'C');
                $this->Cell(45, 8, number_format($totalPrincipalDue, 2), 1, 0, 'C');
                $this->Cell(45, 8, number_format($totalInterestDue, 2), 1, 0, 'C');
                $this->Cell(45, 8, number_format($totalRepaymentDue, 2), 1, 1, 'C');
            }

        }

        $pdf = new myAmortisationPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage('L', 'A4', 0);
        $pdf->headerTable();
        $pdf->viewTable($amortisation, $counterpart, $amount, $tenure, $interest, $repayments, $currency);
        $pdf->form();
        $pdf->Output();


    } else {
        echo "Error decoding JSON data";
        echo "Response Body: " . $resp;
    }
}


ob_end_flush(); // Flush the output buffer and end output buffering
?>
