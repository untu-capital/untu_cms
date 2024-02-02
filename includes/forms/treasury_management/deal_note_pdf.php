<?php
ob_start(); // Start output buffering

if (isset($_GET['generate_deal_note'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once('../includes/fpdf/fpdf.php');

    class myDealNOtePDF extends FPDF
    {
        function header()
        {
            $imageWidth = 40; // Adjust this value according to your image width

            // Calculate X position to center the image
            $xCenter = ($this->GetPageWidth() - $imageWidth) / 2;

            // Set X position for the image
            $this->SetX($xCenter);

            $this->SetX(15); // Set X position for the logo
            $this->Image('../vendors/images/logo.png', $xCenter, 20, 40, 40);
            $this->Ln(45); // Adjust Y position after the logo

            $this->SetFont('Arial', 'B', 15);
            $this->Cell(0, 20, 'Deal Note for Note Investment', 0, 1, 'C');
        }

//        function footer()
//        {
//            $this->SetY(-15);
//            $this->SetFont('Arial', '', 8);
//            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
//        }

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

        function viewTable()
        {
            $this->SetX(20);
            $this->SetFont('Arial', '', 12);
            $this->Cell(50, 15, 'Counterparty :', 0, 0); // Example content, replace with actual data
            $this->Cell(145, 15, 'Untu Capital Ltd. ', 0, 1); // Example content, replace with actual data

            $this->SetX(20);
            $this->SetFont('Arial', '', 12);
            $this->Cell(50, 15, 'Amount :', 0, 0); // Example content, replace with actual data
            $this->Cell(145, 15, 'US$ 50,000.00', 0, 1); // Example content, replace with actual data

            $this->SetX(20);
            $this->SetFont('Arial', '', 12);
            $this->Cell(50, 15, 'PA Status :', 0, 0); // Example content, replace with actual data
            $this->Cell(145, 15, 'Yes', 0, 1); // Example content, replace with actual data


            $this->SetX(20);
            $this->SetFont('Arial', '', 12);
            $this->Cell(50, 15, 'Start Date :', 0, 0); // Example content, replace with actual data
            $this->Cell(145, 15, '21 December 2024', 0, 1); // Example content, replace with actual data

            $this->SetX(20);
            $this->SetFont('Arial', '', 12);
            $this->Cell(50, 15, 'Tenure :', 0, 0); // Example content, replace with actual data
            $this->Cell(145, 15, '365 Days', 0, 1); // Example content, replace with actual data

            $this->SetX(20);
            $this->SetFont('Arial', '', 12);
            $this->Cell(50, 15, 'Interest Rate :', 0, 0); // Example content, replace with actual data
            $this->Cell(145, 15, '10 % per annum', 0, 1); // Example content, replace with actual data

            $this->SetX(20);
            $this->SetFont('Arial', '', 12);
            $this->Cell(50, 15, 'Coupon Payment :', 0, 0); // Example content, replace with actual data
            $this->Cell(145, 15, 'Quarterly', 0, 1); // Example content, replace with actual data

            $this->SetX(20);
            $this->SetFont('Arial', '', 12);
            $this->Cell(50, 15, 'Coupon Amount :', 0, 0); // Example content, replace with actual data
            $this->Cell(145, 15, 'US$ 1,250.00 ', 0, 1); // Example content, replace with actual data

            $this->SetX(20);
            $this->SetFont('Arial', '', 12);
            $this->Cell(50, 15, 'Principal :', 0, 0); // Example content, replace with actual data
            $this->Cell(145, 15, 'Bullet payment at Maturity', 0, 1); // Example content, replace with actual data

            $this->SetX(20);
            $this->SetFont('Arial', '', 12);
            $this->Cell(50, 8, 'Coupon Dates :', 0, 0); // Example content, replace with actual data
            $this->MultiCell(120, 8, '21 March 2024, 21 June 2024, 21 September 2024 & 21 December 2024 ', 0, 1); // Example content, replace with actual data


            $this->Ln(30);
            $this->SetX(20);
            $this->SetFont('Arial', '', 12);
            $this->Cell(100, 10, '...................................', 0, 0); // Example content, replace with actual data
            $this->MultiCell(90, 10, '...................................', 0, 1); // Example content, replace with actual data

            $this->SetX(20);
            $this->Cell(100, 10, 'CEO', 0, 0); // Example content, replace with actual data
            $this->MultiCell(90, 10, 'Head Finance', 0, 1); // Example content, replace with actual data

        }
    }

    $pdf = new myDealNOtePDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('P', 'A4', 0);
    $pdf->headerTable();
    $pdf->viewTable();
    $pdf->form();
    $pdf->Output();
}

ob_end_flush(); // Flush the output buffer and end output buffering
?>
