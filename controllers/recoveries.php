<?php

// ######################  Get RECOVERIES from MUSONI #################################

function musoni_recoveries(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/api/treasury/recoveries/getRecoveries');
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
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/api/treasury/recoveries/getRecoveryById/'.$recoveryId);
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
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/api/treasury/recoveries/getNextSteps/'.$loanId);
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
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/api/treasury/recoveries/last-saved-action-plan/'.$loanId);
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
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/api/treasury/recoveries/getRepayments');
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
//    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/api/treasury/recoveries/getRepayments');
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
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/api/treasury/recoveries/getActionPlanById/'.$recoveryId);
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
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/api/treasury/recoveries/saveActionPlan");
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
