<?php

// ######################  Get RECOVERIES from MUSONI #################################

function musoni_recoveries(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/api/recovery/recoveries/getRecoveries');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $disbursements_response = curl_exec($ch);
    curl_close($ch);
    $disbursements_data = json_decode($disbursements_response, true);

    if ($disbursements_data !== null) {
        return $disbursements_data;
    } else {
        echo "Error decoding JSON data";
    }
}

// ######################  Get RECOVERIES from MUSONI #################################

function musoni_recovery_by_id($recoveryId){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/api/recovery/recoveries/getRecoveryById/'.$recoveryId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $disbursements_response = curl_exec($ch);
    curl_close($ch);
    $disbursements_data = json_decode($disbursements_response, true);

    if ($disbursements_data !== null) {
        return $disbursements_data;
    } else {
        echo "Error decoding JSON data";
    }
}

function get_next_steps($loanId){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/api/recovery/recoveries/getNextSteps/'.$loanId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $disbursements_response = curl_exec($ch);
    curl_close($ch);
    $disbursements_data = json_decode($disbursements_response, true);

    if ($disbursements_data !== null) {
        return $disbursements_data;
    } else {
        echo "Error decoding JSON data";
    }
}


function last_saved_action_plan($loanId){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/api/recovery/recoveries/last-saved-action-plan/'.$loanId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $disbursements_response = curl_exec($ch);
    curl_close($ch);
    $disbursements_data = json_decode($disbursements_response, true);

    if ($disbursements_data !== null) {
        return $disbursements_data;
    } else {
        echo "Error decoding JSON data";
    }
}

function get_repayments($recoveryId){
    // Get recovery data
    $recovery_data = musoni_recovery_by_id($recoveryId);

    // Prepare data as an array of recovery objects
    $repayments_data = array($recovery_data);

    // Convert the array to JSON format
    $json_data = json_encode($repayments_data);

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/api/recovery/recoveries/getRepayments');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json_data))
    );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data); // Send JSON data in the request body

    // Check for errors
    if(curl_errno($ch)){
        throw new Exception('cURL Error: ' . curl_error($ch));
    }

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check if the request was successful
    if ($response === false) {
        throw new Exception('cURL Error: No response received');
    }

    // Get HTTP response code
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Close cURL session
    curl_close($ch);

    // Check if the response code is successful (2xx)
    if ($httpCode >= 200 && $httpCode < 300) {
        // Decode the JSON response
        $decoded_response = json_decode($response, true);

        // Check if decoding was successful
        if ($decoded_response !== null) {
            return $decoded_response;
        } else {
            throw new Exception('Error decoding JSON data');
        }
    } else {
        throw new Exception('HTTP Error: ' . $httpCode);
    }
}


//function get_repayments(){
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/api/recovery/recoveries/getRepayments');
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $disbursements_response = curl_exec($ch);
//    curl_close($ch);
//    $disbursements_data = json_decode($disbursements_response, true);
//
//    if ($disbursements_data !== null) {
//        return $disbursements_data;
//    } else {
//        echo "Error decoding JSON data";
//    }
//}

function recovery_actionPlans($recoveryId){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/api/recovery/recoveries/getActionPlanById/'.$recoveryId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $disbursements_response = curl_exec($ch);
    curl_close($ch);
    $disbursements_data = json_decode($disbursements_response, true);

    if ($disbursements_data !== null) {
        return $disbursements_data;
    } else {
        echo "Error decoding JSON data";
    }
}

if(isset($_POST['set_recovery_actions'])) {
    $txtArrears = $_POST['arrears'];
    $txtActionPoint = $_POST['action_point'];
    $txtCreatedAt = $_POST['created_at'];
    $txtComments = $_POST['comments'];
    $txtAgreedAmount = $_POST['agreed_amount'];
    $txtLegal = $_POST['legal'];
    $txtStatus = $_POST['status'];
    $txtStartDate = date("Y-m-d", strtotime($_POST['start_date']));
    $loanId = $_POST['loanId'];
    $repaymentType = $_POST['repaymentType'];

    $data_array = array(
        'causeOfArrears' => $txtArrears,
        'agreedActionPoints' => $txtActionPoint,
        'createdAt' => $txtCreatedAt,
        'comments' => $txtComments,
        'agreedAmount' => $txtAgreedAmount,
        'legalEntity' => $txtLegal,
        'status' => $txtStatus,
        'startDate' => $txtStartDate,
        'loanId' => $loanId,
        'repaymentType' => $repaymentType
    );


    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/api/recovery/recoveries/saveActionPlan");
//    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // convert headers to array
    $headers = headersToArray( $headerStr );

    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard
                $_SESSION['info'] = "Successfully updated";
                audit($_SESSION['userid'], "Recovery action for loan ID: ".$loanId." Successfully Updated", $_SESSION['branch']);
//                header('location: loan_info.php?menu='.$cc_level.'&loan_id='.$loanId.'&userid='.$userId);
                break;
            default:
                $_SESSION['error'] = 'Could not update Recovery'. "\n";
                audit($_SESSION['userid'], "Recovery action for loan ID: ".$loanId." Failed to Update", $_SESSION['branch']);
//                header('location: loan_info.php?menu='.$cc_level.'&loan_id='.$loanId.'&userid='.$userId);
        }
    }
    else {
        $_SESSION['error'] = 'Could not update Recovery'. "\n";
        audit($_SESSION['userid'], "Recovery action for loan ID: ".$loanId." Failed to Update", $_SESSION['branch']);
    }
    curl_close($ch);
}



function generateExcel($recoveryLoans) {
    // URL of your API endpoint
    $url = 'http://localhost:8080/api/recovery/recoveries/generateExcel';

    // Convert array to JSON
    $jsonPayload = json_encode($recoveryLoans);

    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonPayload)
    ));

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for errors
    if($response === false) {
        echo 'cURL Error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    return $response;
}

// Example usage:
//$recoveryLoans = array(
//    array(
//        "loanId" => 29592,
//        "office" => "Main Branch",
//        "loanOfficer" => "John Doe",
//        "clientName" => "Alice Smith",
//        "amount" => 5000.0,
//        "principal" => 4500.0,
//        "totalDue" => 5500.0,
//        "daysInArrears" => 30,
//        "daysSincePayment" => 15,
//        "lastTransactionDate" => "2024-04-10",
//        "lastTransactionAmount" => 200.0
//    )
//);

if(isset($_POST['exportcsv'])) {

    $selectedRows = $_POST['selectedRows'];

    // Initialize $recoveryLoans array
    $recoveryLoans = [];

    // Loop through selected rows to populate $recoveryLoans array
    foreach ($selectedRows as $selectedRow) {
        $recoveryLoans[] = json_decode($selectedRow, true);
    }

    // Generate the Excel data
    $response = generateExcel($recoveryLoans);

    // Convert JSON response to associative array
    $responseArray = json_decode($response, true);

    // Modify the column headings to capitalize them
    $columnHeadings = [
        'Loan Id',
        'Office',
        'Loan Officer',
        'Client Name',
        'Amount',
        'Principal',
        'Total Due',
        'Days In Arrears',
        'Days Since Payment',
        'Cause Of Arrears',
        'Agreed Action Points',
        'Comments',
        'Agreed Amount',
        'Legal Entity',
        'Status',
        'Movement Amount',
        'Timeline',
        'Next Timeline',
        'Previous Timeline',
        'Stage'
    ];



    // Create a new CSV file
    $csvFile = fopen('recovery_info.csv', 'w');

    // Write column headings to the file, capitalizing them
    fputcsv($csvFile, array_map('ucfirst', $columnHeadings));

    // Write data rows to the file
    foreach ($responseArray as $data) {
        fputcsv($csvFile, $data);
    }

    // Close the CSV file
    fclose($csvFile);

    // Set headers for download
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment;filename="recovery_info.csv"');
    header('Cache-Control: max-age=0');

    // Output the file contents
    readfile('recovery_info.csv');

    // Remove the file after output
    unlink('recovery_info.csv');

    // Stop script execution to prevent any additional output
    exit;
}




