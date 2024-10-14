<?php

//error_reporting(0);

$audit = "";
$cc_level = 'bcc_final';
$schedule_meeting = '';

// CMS
if (isset($_POST['initiate_transaction'])) {

    $url = "http://localhost:7878/api/utg/cms/transaction-voucher/initiate";

    // Data to send in the POST request
    $postData = array('initiator' => $_POST['initiator'], 'currency' => $_POST['currency'], 'applicationDate' => $_POST['applicationDate'], 'amount' => $_POST['amount'], 'fromVault' => $_POST['fromVault'], 'toVault' => $_POST['toVault'], 'amountInWords' => $_POST['amountInWords'], 'withdrawalPurpose' => $_POST['withdrawalPurpose'], 'firstApprover' => $_POST['firstApprover'], 'secondApprover' => $_POST['secondApprover'], 'denomination100' => $_POST['denomination100'], 'denomination50' => $_POST['denomination50'], 'denomination20' => $_POST['denomination20'], 'denomination10' => $_POST['denomination10'], 'denomination5' => $_POST['denomination5'], 'denomination2' => $_POST['denomination5'], 'denomination1' => $_POST['denomination1'], 'denominationCents' => $_POST['denominationCents'], 'totalDenominations' => $_POST['totalDenominations'],

    );

    $data = json_encode($postData);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

    $response = curl_exec($ch);
    // Get the HTTP response status code
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($status == 201) {
        echo "<script>
                    setTimeout(function(){
                        $('#savedTransaction').modal('show');                        
                    },1000);
                  </script>";
    } else {
        echo "<script>
                    setTimeout(function(){
                        $('#failedTransaction').modal('show');
                    }, 1000);
                  </script>";
    }
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    curl_close($ch);
}
if (isset($_POST['deleteTransactionVoucher'])) {
    echo  'http://localhost:7878/api/utg/cms/transaction-voucher/delete/'.$_POST["transactionId"];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/cms/transaction-voucher/delete/'.$_POST['transactionId']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);

    $response = curl_exec($ch);
    // Get the HTTP response status code
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($status == 200) {
        echo "<script>
                    setTimeout(function(){
                        $('#deletedTransaction').modal('show');        
                    },1000);
                  </script>";
    } else {
        echo "<script>
                    setTimeout(function(){
                        $('#failedTransaction').modal('show');
                    }, 1000);
                  </script>";
    }
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    curl_close($ch);
}

if (isset($_POST['update_transaction'])) {

    $url = "http://localhost:7878/api/utg/cms/transaction-voucher/update";

    // Data to send in the POST request
    $postData = array('id' => $_POST['id'], 'fromVault' => $_POST['fromVault'], 'toVault' => $_POST['toVault'], 'applicationDate' => $_POST['applicationDate'], 'amount' => $_POST['amount'], 'amountInWords' => $_POST['amountInWords'], 'currency' => $_POST['currency'], 'withdrawalPurpose' => $_POST['withdrawalPurpose'], 'denomination100' => $_POST['denomination100'], 'denomination50' => $_POST['denomination50'], 'denomination20' => $_POST['denomination20'], 'denomination10' => $_POST['denomination10'], 'denomination5' => $_POST['denomination5'], 'denomination2' => $_POST['denomination5'], 'denomination1' => $_POST['denomination1'], 'denominationCents' => $_POST['denominationCents'], 'totalDenominations' => $_POST['totalDenominations'],

    );

    $data = json_encode($postData);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

    $response = curl_exec($ch);
//    Get Response Status
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($status == 200) {
        // Transaction successfully saved, show modal popup for 0.5 seconds
        echo "<script>
                    setTimeout(function(){
                        $('#updatedTransaction').modal('show');
                    }, 1000);
                  </script>";

    } else {
        echo "<script>
                    setTimeout(function(){
                        $('#failedTransaction').modal('show');
                    }, 1000);
                  </script>";
    }

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    curl_close($ch);
}

if (isset($_POST['firstApprove01'])) {
    first_approver_update_transaction_status($_POST['id'], $_POST['status'], $_POST['comment']);
}

if (isset($_POST['secondApprove01'])) {
    second_approver_update_transaction_status($_POST['id'], $_POST['status'], $_POST['comment']);
}

//First Approve
function first_approver_update_transaction_status($id, $status, $comment)
{
    // Data to send in the POST request
    $postData = array('id' => $id, 'approvalStatus' => $status, 'comment' => $comment,);

    $url = "http://localhost:7878/api/utg/cms/transaction-voucher/first-approve";

    $data = json_encode($postData);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

    $response = curl_exec($ch);
    //    Get Response Status
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($status == 200) {
        // Transaction first approved successfully saved, show modal popup for 0.5 seconds
        echo "<script>
                    setTimeout(function(){
                        $('#approvedTransaction').modal('show');                      
                    }, 1000);
                  </script>";
    } else {
        echo "<script>
                    setTimeout(function(){
                        $('#failedTransaction').modal('show');
                    }, 1000);
                  </script>";
    }

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    curl_close($ch);
}

// Bulk First Approve
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["firstApproveList"])) {
    // Get the JSON data from the hidden input field
    $jsonData = $_POST['firstApproveList'];

    $url = "http://localhost:7878/api/utg/cms/transaction-voucher/bulk-first-approve";

//    $data = json_encode($postData);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

    $response = curl_exec($ch);

    //    Get Response Status
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($status == 200) {
        echo "<script>
                    setTimeout(function(){
                        $('#approvedTransactions').modal('show');                     
                    }, 1000);
                  </script>";

    }
    else {
        echo "<script>
                    setTimeout(function(){
                        $('#failedTransactions').modal('show');
                    }, 1000);
                  </script>";
    }
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }
    curl_close($ch);
}

//Second Approve
function second_approver_update_transaction_status($id, $status, $comment)
{
    // Data to send in the POST request
    $postData = array('id' => $id, 'approvalStatus' => $status, 'comment' => $comment,);

    $url = "http://localhost:7878/api/utg/cms/transaction-voucher/second-approve";

    $data = json_encode($postData);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

    $response = curl_exec($ch);

    //    Get Response Status
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($status == 200) {
        // Transaction second approved successfully saved, show modal popup for 0.5 seconds
        echo "<script>
                    setTimeout(function(){
                        $('#approvedTransaction').modal('show');

                    }, 1000);
                  </script>";
    } else {
        echo "<script>
                    setTimeout(function(){
                        $('#failedTransaction').modal('show');
                    }, 1000);
                  </script>";
    }

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    curl_close($ch);
}

// Bulk Second Approve
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["secondApproveList"])) {
    // Get the JSON data from the hidden input field
    $jsonData = $_POST['secondApproveList'];

    $url = "http://localhost:7878/api/utg/cms/transaction-voucher/bulk-second-approve";

//    $data = json_encode($postData);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

    $response = curl_exec($ch);
    //    Get Response Status
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($status == 200) {
        echo "<script>
                    setTimeout(function(){
                        $('#approvedTransactions').modal('show');
                    }, 1000);
                  </script>";

    } else {
        echo "<script>
                    setTimeout(function(){
                        $('#failedTransactions').modal('show');
                    }, 1000);
                  </script>";
    }

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    curl_close($ch);
}

if ($_SESSION['role'] == "ROLE_OP"){
    $cc_level = 'mcc_final';
    $schedule_meeting = '';
}

$utgAddress = "http://localhost:7878/api/utg/";
$id = $_GET["loan_id"];
$userId = $_GET['userid'];

// CONVERT MUSONI DATES
function formatJsonDate($jsonDate) {
    $dateArray = json_decode($jsonDate);
    $year = $dateArray[0];
    $month = $dateArray[1];
    $day = $dateArray[2];
    return sprintf("%02d-%02d-%04d", $day, $month, $year);
}

// CONVERT CMS DATES
function convertDateFormat($dateString) {
    $dateTime = new DateTime($dateString);
    return $dateTime->format('d-M-Y');
}

function sendEmail($receipient, $subject, $message){

    $url = "http://localhost:7878/api/utg/credit_application/sendEmail";
    $data_array = array(
        'recipient' => "randakelvin@gmail.com",
        'subject' => "Test email body",
        'message' => "Test email message."
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);

    // convert headers to array
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:
                $_SESSION['info'] = "Email Send Successfully";
                audit($_SESSION['userid'], "Email Send Successfully", $_SESSION['branch']);
//                header('location: http://localhost/untu_cms/boco/cash_management.php?menu=main');
                break;
            default:
                $_SESSION['error'] = 'Failed to Send Email .';
                audit($_SESSION['userid'], "Failed to create Transaction Voucher", $_SESSION['branch']);
//                header('location: http://localhost/untu_cms/boco/cash_management.php?menu=main');
        }
    } else {
        $_SESSION['error'] = 'Failed to Send Email.. Please try again!';
        audit($_SESSION['userid'], "Failed to Send Email", $_SESSION['branch']);
//        header('location: http://localhost/untu_cms/boco/cash_management.php?menu=main');
    }
    curl_close($ch);
}

function sendBulkEmail(){

    $url = "http://localhost:7878/api/utg/credit_application/sendBulkEmail";
    $data_array = array(
        'recipients' => ["randakelvin@gmail.com", "kelvin.randa@untucapital.co.zw"],
        'subject' => "Test email body",
        'message' => "Test email message."
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);

    // convert headers to array
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:
                $_SESSION['info'] = "Email Send Successfully";
                audit($_SESSION['userid'], "Email Send Successfully", $_SESSION['branch']);
//                header('location: http://localhost/untu_cms/boco/cash_management.php?menu=main');
                break;
            default:
                $_SESSION['error'] = 'Failed to Send Email.';
                audit($_SESSION['userid'], "Failed to Send Email", $_SESSION['branch']);
//                header('location: http://localhost/untu_cms/boco/cash_management.php?menu=main');
        }
    } else {
        $_SESSION['error'] = 'Failed to Add Transaction Voucher.. Please try again!';
        audit($_SESSION['userid'], "Failed to Send Email", $_SESSION['branch']);
//        header('location: http://localhost/untu_cms/boco/cash_management.php?menu=main');
    }
    curl_close($ch);
}

//send_requisition("randa@gmail.com","subject", "message","Kelvin");

// ######################  Get RECENT DISBURSEMENTS from MUSONI #################################

function audit($userid, $activity, $branch) {
    $data_array = array(
        'userid'=> $userid,
        'branch'=> $branch,
        'role'=> $_SESSION['role'],
        'activity'=> $activity,
        'deviceInfo'=> $_SERVER['HTTP_USER_AGENT'],
        'ipAddress'=> $_SERVER['REMOTE_ADDR']
    );
    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/access_logs");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);
    curl_close($ch);

//    return "Log recorded successfully";
}


function access_logs()
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/access_logs");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $access_logs = json_decode($server_response, true);
    return $access_logs;
}


// ######################  Get RECENT DISBURSEMENTS from MUSONI #################################
function disbursements($fromDate,$toDate){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/musoni/getLoansByDisbursementDate/'.$fromDate.'/'.$toDate);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $disbursements_response = curl_exec($ch);
        curl_close($ch);
        $disbursements_data = json_decode($disbursements_response, true);

        if ($disbursements_data !== null) {
            $disbursements = $disbursements_data['disbursedLoans'];
            return $disbursements;
        } else {
            echo "Error decoding JSON data";
        }
    }

function disbursed_by_range($display_range){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/musoni/loans/disbursed-by-range/'.$display_range);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $disbursements_response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($disbursements_response, true);
//        $disbursement_data = [];
//        foreach ($data as $loan) {
//            $disbursement_data[] = $data['totalPrincipalDisbursed'];
//        }
        return $data;
    }

function branch_targets(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/targets");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    return json_decode($server_response, true);
}


function get_tax_policies()
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/tax_policy");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    return json_decode($server_response, true);
}

// ######################  Get LOAN APPLICATIONS from CMS #################################

function loans($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/credit_application'.$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $loans_response = curl_exec($ch);
    curl_close($ch);
    $loans = json_decode($loans_response, true);
    return $loans;
}
// ######################  APPLY FOR A LOAN APPLICATIONS - CMS #################################

if(isset($_POST['loan_application'])){
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $id_number = $_POST['id_number'];
    $marital = $_POST['marital'];
    $gender = $_POST['gender'];
    $dob = date('Y-m-d', strtotime($_POST['dob']));
    $phonenumber = $_POST['phonenumber'];
    $pob = $_POST['pob'];
    $industry_code = $_POST['industry_code'];
    $street_no = $_POST['street_no'];
    $street_name = $_POST['street_name'];
    $surbub = $_POST['surbub'];
    $city = $_POST['city'];
    $loan = $_POST['loan'];
    $tenure = $_POST['tenure'];
    $businessName = $_POST['businessName'];
    $businessStartDate = date('Y-m-d', strtotime($_POST['businessStartDate']));
    $branchName = $_POST['branchName'];

    $next_of_kin_name = $_POST['next_of_kin_name'];
    $next_of_kin_phone = $_POST['next_of_kin_phone'];
    $next_of_kin_relationship = $_POST['next_of_kin_relationship'];
    $next_of_kin_address = $_POST['next_of_kin_address'];

    $next_of_kin_name2 = $_POST['next_of_kin_name2'];
    $next_of_kin_phone2 = $_POST['next_of_kin_phone2'];
    $next_of_kin_relationship2 = $_POST['next_of_kin_relationship2'];
    $next_of_kin_address2 = $_POST['next_of_kin_address2'];

    $loan_status = "PENDING";
    $loanFileId = uniqid('4587');
    $process_loan_status = "uncomplete";
    $assignTo = "Unassigned";
    $bocoSignature = "Unsigned";
    $bmSignature = "Unsigned";
    $caSignature = "Unsigned";
    $cmSignature = "Unsigned";
    $finSignature = "Unsigned";
    $pipelineStatus = "client_application" ;

    $user_loans = loans('/user/'.$_SESSION['userId']);
    $loanCount = 0;
    if($user_loans <> null){ $loanCount = 1;}

    $url = "http://127.0.0.1:7878/api/utg/credit_application";
    $data_array = array(

        'firstName' => $firstname,
        'middleName'=> $middlename,
        'lastName' => $lastname,
        'idNumber' => $id_number,
        'maritalStatus' => $marital,
        'gender' => $gender,
        'dateOfBirth' => $dob,
        'phoneNumber' => $phonenumber,
        'placeOfBusiness' => $pob,
        'industryCode' => $industry_code,
        'streetNo' => $street_no,
        'streetName' => $street_name,
        'suburb' => $surbub,
        'city' => $city,
        'loanAmount' => $loan,
        'tenure' => $tenure,
        'businessName' => $businessName,
//        'businessAddress' => $businessAddress,
        'businessStartDate' => $businessStartDate,
        'branchName' => $branchName,

        'nextOfKinName' => $next_of_kin_name,
        'nextOfKinPhone' => $next_of_kin_phone,
        'nextOfKinRelationship' => $next_of_kin_relationship,
        'nextOfKinAddress' => $next_of_kin_address,
        'nextOfKinName2' => $next_of_kin_name2,
        'nextOfKinPhone2' => $next_of_kin_phone2,
        'nextOfKinRelationship2' => $next_of_kin_relationship2,
        'nextOfKinAddress2' => $next_of_kin_address2,

//        'dateCreated' => $date_created,
        'userId' => $_SESSION['userId'],
        'loanStatus' => $loan_status,
        'loanFileId' => $loanFileId,
        'process_loan_status' => $process_loan_status,
        'assignTo' => $assignTo,
        'bocoSignature' => $bocoSignature,
        'bmSignature' => $bmSignature,
        'caSignature' => $caSignature,
        'cmSignature' => $cmSignature,
        'finSignature' => $finSignature,
        'pipelineStatus' => $pipelineStatus,
        'loanCount' => $loanCount,
        'platformUsed' => 'web-application'

    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 201:  # OK redirect to dashboard
                audits($_SESSION['userid'], "Client Loan Application successful", $_SESSION['branch']);
//                sendEmail("subject", "message", "user");
                $data = loans('/loanFileId/'.$loanFileId);
                $loanId = $data["id"];


                // ################## ------------------------------ send email to BOCOS ------------------------------------ #######################

                 $ch = curl_init();

                 curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:7878/api/utg/users/roleAndBranch/BackOfficeCreditOfficer/'.$branchName);
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                 $resp = curl_exec($ch);
                 curl_close($ch);
                 $boco = json_decode($resp, true);
                 foreach ($boco as $bocos):

                     $recipientName = $bocos['firstName'];
                     $recipientEmail = $bocos['contactDetail']['emailAddress'];

                     $url = "http://127.0.0.1:7878/api/utg/credit_application/newClientloanEmail/".$recipientName.'/'.$recipientEmail;

                     $data_array = array(
                         'recipientName' => $recipientName,
                         'recipientEmail' => $recipientEmail
                     );

                     $data = json_encode($data_array);
                     $ch = curl_init();

                     curl_setopt($ch, CURLOPT_URL, $url);
                     curl_setopt($ch, CURLOPT_POST, true);
                     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                     curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                     curl_setopt($ch, CURLOPT_HEADER, true );
                     $resp = curl_exec($ch);

                     curl_close($ch);

                 endforeach;

// ################## ------------------------------ End send email to BOCOS ------------------------------------ #######################



                echo "<script>alert('Application sent successfully. You can now upload the required documents.');</script>";
                echo "<script>window.location.href = 'kyc_documents.php';</script>";
                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                }
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                audits($_SESSION['userid'], "Client Loan Application failed", $_SESSION['branch']);
                header('location: loan_applications.php?state=apply');
                break;
            case 401: # Unauthorixed - Bad credientials
                $_SESSION['error'] = 'Application failed.. Please try again!';
                audits($_SESSION['userid'], "Client Loan Application failed", $_SESSION['branch']);
                header('location: loan_applications.php?state=apply');
                break;
            default:
                $_SESSION['error'] = 'Not able to send application'. "\n";
                header('location: loan_applications.php?state=apply');
        }
    } else {
        $_SESSION['error'] = 'Application failed.. Please try again!'. "\n";
        audits($_SESSION['userid'], "Client Loan Application failed", $_SESSION['branch']);
        header('location: loan_applications.php?state=apply');
    }
//    curl_close($ch);
    $decoded = json_decode($resp, true);
}


if (isset($_POST['credit_check'])){
    $loanId = $_POST['id'];
    $nationalId = $_POST['national_id'];


//    sendCreditCheckedLoanRequest($loanId);
    saveConsumerData($nationalId);

    echo 'Request processed successfully.';
}

function sendCreditCheckedLoanRequest($loanId) {
    $url = "http://localhost:7878/api/utg/credit_application/creditCheckedLoan/".$loanId;

    $data = json_encode($data_array);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($httpcode == 201) {
        echo "Client loan updated successfully.";
    } else {
        echo "Error updating client loan. HTTP Code: " . $httpcode;
    }

    return $response;
}

function saveConsumerData($nationalId) {
    // URL with the national ID in the query string
    $url = 'http://localhost:8100/xds/consumer?nationalId=' . urlencode($nationalId);

    // Initialize cURL
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Return the response as a string
    curl_setopt($ch, CURLOPT_HTTPGET, true);         // Use GET method

    // Execute the cURL request and capture the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    } else {
        // Display the response
        echo 'Response: ' . $response;
    }

    // Close cURL session
    curl_close($ch);
}


if (isset($_POST['uploadxds'])) {

    $id = $_POST["loan_id"];
    $userId = $_POST['userid'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/xdsFileUpload/get/'.$id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $xds_files = json_decode($server_response, true);

    if($xds_files['fileName'] == ""){
        if(isset($_FILES['file']['name'])){
            $uploadfile = '../includes/file_uploads/xds/'.basename($_FILES['file']['name']);
            //move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
            $temp = explode(".", $_FILES["file"]["name"]);
            $newfilename = basename($_FILES['file']['name']).date('Y.m.d').'.'.round(microtime(true)). '.' . end($temp) ;
            if(move_uploaded_file($_FILES["file"]["tmp_name"], "../includes/file_uploads/xds/" . $newfilename)){
                $url = "http://localhost:7878/api/utg/xdsFileUpload/add/";
                $data_array = array(
                    'loanId'=> $id,
                    'userId' => $userId,
                    'fileName' => $newfilename
                );

                $data = json_encode($data_array);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true );
                $resp = curl_exec($ch);

                curl_close($ch);

            }
        }
    } elseif ($xds_files['fileName'] <> ""){
        if(isset($_FILES['file']['name'])){
            $uploadfile = '../includes/file_uploads/xds/'.basename($_FILES['file']['name']);
            $temp = explode(".", $_FILES["file"]["name"]);
            $newfilename = basename($_FILES['file']['name']).date('Y.m.d').'.'.round(microtime(true)). '.' . end($temp) ;
            if(move_uploaded_file($_FILES["file"]["tmp_name"], "../includes/file_uploads/xds/" . $newfilename)){
                $url = "http://localhost:7878/api/utg/xdsFileUpload/update/$id";
                $data_array = array(
                    'loanId'=> $id,
                    'userId' => $userId,
                    'fileName' => $newfilename
                );

                $data = json_encode($data_array);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true );
                $resp = curl_exec($ch);

                curl_close($ch);

            }
        }
    }

    header('Location: loan_info.php?menu=loan&loan_id='.$id.'&userid='.$userId);
}

// ######################  Get USER BY ID from CMS #################################
function users(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $users_response = curl_exec($ch);
        curl_close($ch);
        $users = json_decode($users_response, true);
        return $users;
    }

function staff(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/untuStaff');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $users_response = curl_exec($ch);
    curl_close($ch);
    $staff = json_decode($users_response, true);
    return $staff;
}

function cms_user(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/cmsUser');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $cms_user_response = curl_exec($ch);
    curl_close($ch);
    $cms_user = json_decode($cms_user_response, true);
    return $cms_user;
}

function tms_user(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/tmsUser');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $cms_user_response = curl_exec($ch);
    curl_close($ch);
    $tms_user = json_decode($cms_user_response, true);
    return $tms_user;
}

function po_user(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/poUser');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $cms_user_response = curl_exec($ch);
    curl_close($ch);
    $cms_user = json_decode($cms_user_response, true);
    return $cms_user;
}

function cms_withdrawal_voucher_for_user($userId){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/transaction-voucher/all-by-initiator/$userId");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $cms_withdrawal_voucher_response = curl_exec($ch);
    curl_close($ch);
    return json_decode($cms_withdrawal_voucher_response, true);
}

function cms_withdrawal_voucher($userId, $firstApprovalStatus, $secondApprovalStatus)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/transaction-voucher/all-by-initiator/$userId");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $cms_withdrawal_voucher_response = curl_exec($ch);
    curl_close($ch);
    $decoded_response = json_decode($cms_withdrawal_voucher_response, true);

    if ($firstApprovalStatus === "PENDING" || $secondApprovalStatus === "PENDING") {
        return array_filter($decoded_response, function ($voucher) use ($firstApprovalStatus) {
            return $voucher['firstApprovalStatus'] === $firstApprovalStatus || $voucher['secondApprovalStatus'] === $firstApprovalStatus;
        });
    }
    if ($firstApprovalStatus === "REVISE" || $secondApprovalStatus === "REVISE") {
        return array_filter($decoded_response, function ($voucher) use ($firstApprovalStatus) {
            return $voucher['firstApprovalStatus'] === $firstApprovalStatus || $voucher['secondApprovalStatus'] === $firstApprovalStatus;
        });
    }
    if ($firstApprovalStatus === "DECLINED" || $secondApprovalStatus === "DECLINED") {
        return array_filter($decoded_response, function ($voucher) use ($firstApprovalStatus) {
            return $voucher['firstApprovalStatus'] === $firstApprovalStatus || $voucher['secondApprovalStatus'] === $firstApprovalStatus;
        });
    }

    return array_filter($decoded_response, function ($voucher) use ($firstApprovalStatus) {
        return $voucher['firstApprovalStatus'] === $firstApprovalStatus && $voucher['secondApprovalStatus'] === $firstApprovalStatus;
    });
}

function cms_withdrawal_voucher_by_firstApprover($userId, $status){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/transaction-voucher/all-by-first-approver/$userId");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $cms_withdrawal_voucher_response = curl_exec($ch);
    curl_close($ch);
    $decoded_response = json_decode($cms_withdrawal_voucher_response, true);

    return array_filter($decoded_response, function($voucher) use ($status) {
        return $voucher['firstApprovalStatus'] === $status;
    });
}

function cms_withdrawal_voucher_by_second_approver($userId, $status){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/transaction-voucher/all-by-second-approver/$userId");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $cms_withdrawal_voucher_response = curl_exec($ch);
    curl_close($ch);
    $decoded_response = json_decode($cms_withdrawal_voucher_response, true);



    $aStatus = "APPROVED";

    $first_approved = array_filter($decoded_response, function($voucher) use ($aStatus) {
        return $voucher['firstApprovalStatus'] === $aStatus;
    });

    return array_filter($first_approved, function($voucher) use ($status) {
        return $voucher['secondApprovalStatus'] === $status;
    });

}

function cms_finance_manager_transaction_vouchers($userId, $status ){

//    return cms_withdrawal_voucher_by_second_approver($userId, $status) + cms_withdrawal_voucher_by_firstApprover($userId, $status);
    return array_merge(cms_withdrawal_voucher_by_second_approver($userId, $status), cms_withdrawal_voucher_by_firstApprover($userId, $status));
}


function branch_by_id($id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/branches/$id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $branches_by_id = json_decode($server_response, true);
    return $branches_by_id;
}

function petty_cash_payments_by_id($id){
    $ch = curl_init();
    $id = $_GET["id"];
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/petty-cash-payments/$id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $petty_cash_payments_by_id = json_decode($server_response, true);
    return $petty_cash_payments_by_id;
}

function authorisation($id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/cms_authorisation".$id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $authorisation = json_decode($server_response, true);
    return $authorisation;
}

function user($userId){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/'.$userId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $user_response = curl_exec($ch);
    curl_close($ch);
    $user = json_decode($user_response, true);
    return $user;
}
//function authbranch($id){
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/branches/'.$id);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $user_response = curl_exec($ch);
//    curl_close($ch);
//    $authbranch = json_decode($user_response, true);
//    return $authbranch;
//}

// ######################   REPORTS for PIPELINE APPLICANTS from CMS #################################

function applicants(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/credit_application_pipeline/loans');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $applicants_response = curl_exec($ch);
    curl_close($ch);
    $applicants = json_decode($applicants_response, true);
    return $applicants;
}

function lo_pipelines($userId){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/credit_application_pipeline/getLoPipeline/'.$userId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $applicants_response = curl_exec($ch);
    curl_close($ch);
    $applicants = json_decode($applicants_response, true);
    return $applicants;
}


function pipeline_report(){
    $ch = curl_init("http://localhost:7878/api/utg/credit_application_pipeline/getPipelineSummary");
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_data = json_decode($response, true);

    $pipeline_reports = [];
    foreach ($response_data as $pipeline_report) {


        $pipeline_reports[] = $pipeline_report;
//        print_r($pipeline_reports);
    }
    return $pipeline_reports;

}

function branch_pipeline_report($branchName){
    $ch = curl_init("http://localhost:7878/api/utg/credit_application_pipeline/getPipelineByBranch/".$branchName);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_data = json_decode($response, true);

    $pipeline_reports = [];
    foreach ($response_data as $pipeline_report) {


        $pipeline_reports[] = $pipeline_report;
//        print_r($pipeline_reports);
    }
    return $pipeline_reports;

}

function lo_productivity_report(){
    $ch = curl_init("http://localhost:7878/api/utg/credit_application_pipeline/getLoanOfficerProductivity");
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_data = json_decode($response, true);

    $pipeline_reports = [];
    foreach ($response_data as $pipeline_report) {


        $pipeline_reports[] = $pipeline_report;
//        print_r($pipeline_reports);
    }
    return $pipeline_reports;

}

function getLoTotalPipelineAndDisbursements(){

    if ($_SESSION['role'] == "ROLE_BM"){
        $url = "http://localhost:7878/api/utg/credit_application_pipeline/getLoTotalPipelineAndDisbursementsByBranch/".str_replace(' ','%20',$_SESSION['branch']);
    }else {
        $url = "http://localhost:7878/api/utg/credit_application_pipeline/getLoTotalPipelineAndDisbursements";
    }
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_data = json_decode($response, true);

    $pipeline_reports = [];
    foreach ($response_data as $pipeline_report) {


        $pipeline_reports[] = $pipeline_report;
//        print_r($pipeline_reports);
    }
    return $pipeline_reports;

}


if (isset($_POST['add_to_pipeline'])) {
    $applicant = $_POST['applicant'];
    $sector = $_POST['sector'];
    $repeatClient = $_POST['repeat_client'];
    $soughtLoan = $_POST['sought_loan'];
    $loanStatus = $_POST['loan_status'];
    $loanOfficer = $_POST['loan_officer'];
    ?>
    <script>
        console.log("<?php echo $loanOfficer; ?>");
    </script>
        <?php



    $data_array = array(
        'userId' => $_SESSION['userId'],
        'branchName' => $_SESSION['branch'],
        'applicant' => $applicant,
        'sector' => $sector,
        'repeatClient' => $repeatClient,
        'soughtLoan' => $soughtLoan,
        'loanStatus' => $loanStatus,
        'loanOfficer' => $loanOfficer
    );

    $data = json_encode($data_array);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/credit_application_pipeline/loans");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);

// convert headers to array
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:
                $_SESSION['info'] = "Created LO Pipeline Successfully";
                audit($_SESSION['userid'], "Created LO Pipeline Successfully", $_SESSION['branch']);
                break;
            default:
                $_SESSION['error'] = 'Failed to Created LO Pipeline ';
                audit($_SESSION['userid'], "Failed to Created LO Pipeline ", $_SESSION['branch']);
        }
    } else {
        $_SESSION['error'] = 'Failed to Created LO Pipeline .. Please try again!';
        audit($_SESSION['userid'], "Failed to Created LO Pipeline ", $_SESSION['branch']);
    }
    curl_close($ch);
}

if (isset($_POST['update_pipeline'])) {
    $applicant = $_POST['applicant'];
    $sector = $_POST['sector'];
    $repeatClient = $_POST['repeat_client'];
    $soughtLoan = $_POST['sought_loan'];
    $loanStatus = $_POST['loan_status'];
    $loanOfficer = $_POST['loan_officer'];
    $id = $_POST['pipeline_id'];

    $data_array = array(
        'userId' => $_SESSION['userId'],
        'branchName' => $_SESSION['branch'],
        'applicant' => $applicant,
        'sector' => $sector,
        'repeatClient' => $repeatClient,
        'soughtLoan' => $soughtLoan,
        'loanStatus' => $loanStatus,
        'loanOfficer' => $loanOfficer
    );

    $data = json_encode($data_array);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/credit_application_pipeline/update/".$id);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);

// convert headers to array
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:
                $_SESSION['info'] = "Created LO Pipeline Successfully";
                audit($_SESSION['userid'], "Created LO Pipeline Successfully", $_SESSION['branch']);
                break;
            default:
                $_SESSION['error'] = 'Failed to Created LO Pipeline ';
                audit($_SESSION['userid'], "Failed to Created LO Pipeline ", $_SESSION['branch']);
        }
    } else {
        $_SESSION['error'] = 'Failed to Created LO Pipeline .. Please try again!';
        audit($_SESSION['userid'], "Failed to Created LO Pipeline ", $_SESSION['branch']);
    }
    curl_close($ch);
}













// ######################   REPORTS for BUSINESS SECTORS from CMS #################################

function industries(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/industries');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $industries_response = curl_exec($ch);
    curl_close($ch);
    $industries = json_decode($industries_response, true);
    return $industries;
}

// ######################   REPORTS for BUSINESS SECTORS from CMS #################################

function zones(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/zones');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $zones_response = curl_exec($ch);
    curl_close($ch);
    $zones = json_decode($zones_response, true);
    return $zones;
}

// ######################   REPORTS for PO Transaction from CMS #################################
function poTransactions(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/poTransactions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $poTransactions_response = curl_exec($ch);
    curl_close($ch);
    $poTransactions = json_decode($poTransactions_response, true);
    return $poTransactions;
}

// ######################   REPORTS for BUSINESS SECTORS from CMS #################################

function leadStatus(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/leadStatus');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $leadStatus_response = curl_exec($ch);
    curl_close($ch);
    $leadStatus = json_decode($leadStatus_response, true);
    return $leadStatus;
}

// ######################   REPORTS for BUSINESS SECTORS from CMS #################################

function cities(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/cities');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $cities_response = curl_exec($ch);
    curl_close($ch);
    $cities = json_decode($cities_response, true);
    return $cities;
}


// ######################   GET APPRAISAL FILES from CMS #################################

function files($userId,$id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/credit_application/downloadFiless/'.$userId.'/'.$id.'/Appraisal-Form'.'/Assessment-Files');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $files = json_decode($server_response, true);
    return $files;
}

// ######################   GET APPRAISAL KYC FILES from CMS #################################

function kyc_files($userId){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/credit_application/downloadFiles/'.$userId.'/Appraisal-Form'.'/selfie'.'/nationalId');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);
    curl_close($ch);
    $kyc_files = json_decode($resp, true);
    return $kyc_files;
}

// ######################   GET LOAN OFFICERS by BRANCH from CMS #################################

function loan_officer(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/branch/'.$_SESSION['branch']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);
    curl_close($ch);
    $branch = json_decode($resp, true);

    foreach($branch as $branchs):
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/role/LoanOfficer');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resp = curl_exec($ch);
        curl_close($ch);
        $loan_officer = json_decode($resp, true);

    endforeach;
    return $loan_officer;
}

// ######################   GET CLIENT FILE UPLOADS from CMS #################################

function client_file_uploads($userId){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/ClientFileUpload/get/'.$userId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $client_file_uploads = json_decode($server_response, true);
    return $client_file_uploads;
}

// ######################   GET CLIENT FILE UPLOADS from CMS #################################

function assessment_files($id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/assessmentFileUpload/get/'.$id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $assessment_files = json_decode($server_response, true);
    return $assessment_files;
}

// ######################   GET CLIENT FILE UPLOADS from CMS #################################

function xds_files($id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/xdsFileUpload/get/'.$id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $xds_files = json_decode($server_response, true);
    return $xds_files;
}

// ######################   GET CLIENT FILE UPLOADS from CMS #################################

function assign_lo($assignTo, $assignedBy, $loanId, $userId, $additional_remarks, $processLoanStatus, $bmDateAssignLo, $pipelineStatus){

    $url = "http://localhost:7878/api/utg/credit_application/assignTo/".$loanId;
    $data_array = array(
        'assignTo' => $assignTo,
        'additionalRemarks' => $additional_remarks,
        'assignedBy' => $assignedBy,
        'processLoanStatus' => $processLoanStatus,
        'bmDateAssignLo' => $bmDateAssignLo,
        'pipelineStatus' => $pipelineStatus
    );

    $data = json_encode($data_array);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);

    $resp = curl_exec($ch);

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // convert headers to array
    $headers = headersToArray( $headerStr );

    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard

                $loan_officer = user($assignTo);

                // foreach ($loan_officer as $loan_officers):

                $recipientName = $loan_officer['firstName'];
                $recipientEmail = $loan_officer['contactDetail']['emailAddress'];

                $url = "http://localhost:7878/api/utg/credit_application/bmAssignLoanOfficer/".$recipientName.'/'.$recipientEmail;

                $data_array = array(
                    'recipientName' => $recipientName,
                    'recipientEmail' => $recipientEmail
                );

                $data = json_encode($data_array);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true );
                $resp = curl_exec($ch);

                curl_close($ch);

                // endforeach;

                $_SESSION['info'] = "Assigned this application". " successful";

                header('location: loan_info.php?menu=loan&loan_id='.$loanId.'&userid='.$userId);
                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    echo $key . ': ' . $val . '<br>';
                }
                echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                header('location: loan_info.php?menu=loan&loan_id='.$loanId.'&userid='.$userId);
                break;

            case 401: # Unauthorixed - Bad credientials
                $_SESSION['error'] = 'Update Status failed';
                header('location: loan_info.php?menu=loan&loan_id='.$loanId.'&userid='.$userId);

                break;
            default:
                $_SESSION['error'] = 'Could not update Loan status '. "\n";
                header('location: loan_info.php?menu=loan&loan_id='.$loanId.'&userid='.$userId);
        }
    } else {
        $_SESSION['error'] = 'Update Status failed.. Please try again!'. "\n";
        header('location: loan_info.php?menu=loan&loan_id='.$loanId.'&userid='.$userId);

    }
    curl_close($ch);

    return "";
}

function market_campaigns(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/market_campaigns");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $market_campaigns = json_decode($server_response, true);
    return $market_campaigns;
}

function market_campaign_by_id($id){
    $ch = curl_init();
    $id = $_GET["id"];
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/market_campaigns/$id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $market_campaign_by_id = json_decode($server_response, true);
    return $market_campaign_by_id;
}

function sectors_by_id($id){
    $ch = curl_init();
    $id = $_GET["id"];
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/industries/$id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $sectors_by_id = json_decode($server_response, true);
    return $sectors_by_id;
}

function targets_by_id($id){
    $ch = curl_init();
    $id = $_GET["id"];
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/targets/$id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $targets_by_id = json_decode($server_response, true);
    return $targets_by_id;
}
function zones_by_id($id){
    $ch = curl_init();
    $id = $_GET["id"];
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/zones/$id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $zones_by_id = json_decode($server_response, true);
    return $zones_by_id;
}
function cities_by_id($id){
    $ch = curl_init();
    $id = $_GET["id"];
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cities/$id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $cities_by_id = json_decode($server_response, true);
    return $cities_by_id;
}


    function leads($leads_url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/marketLeads".$leads_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_response = curl_exec($ch);
        curl_close($ch);
        $leads = json_decode($server_response, true);
        return $leads;
    }

function bsn_sector(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/industries');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $bsn_sector = json_decode($server_response, true);
    return $bsn_sector;
}

function branches() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/branches');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);

    $branches = json_decode($server_response, true);
    $branch_data = [];
    foreach ($branches as $branch) {
        $branch_data[] = $branch['branchName'];
    }
    return $branch_data;
}

function branch(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/branches');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $branches = json_decode($server_response, true);
    return $branches;
}
//function authorisation(){
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/cms/cms_authorisation');
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $server_response = curl_exec($ch);
//    curl_close($ch);
//    $authorisations = json_decode($server_response, true);
//    return $authorisations;
//}



function user_role($role){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/role/'.$role);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);
    curl_close($ch);
    $user_role = json_decode($resp, true);
    return $user_role;
}

function roles(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/roles');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $roles_data = json_decode($server_response, true);
    return $roles_data;
}

function get_roles($roleId){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/roles/$roleId");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $get_roles = json_decode($server_response, true);
    return $get_roles;
}

function cms_vault_permissions(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/cms/cms_vault_permission');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $cms_vault_permissions = json_decode($server_response, true);
    return $cms_vault_permissions;
}

function cms_petty_cash_payments(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/cms/petty-cash-payments/all');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $cms_petty_cash_payments = json_decode($server_response, true);
    return $cms_petty_cash_payments;
}

function untuStaff() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/untuStaff');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);
    curl_close($ch);
    $untuStaff = json_decode($resp, true);
    return $untuStaff;
}

function appraisal_prep(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/credit_application/assessmentNotCompleted/ACCEPTED/'.$_SESSION['userId'].'/'.$_SESSION['branch'].'/uncompleted');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $appraisal_prep = json_decode($server_response, true);
    return $appraisal_prep;
}

function boco_check_application($upadateLoanStatus, $loanId, $userId, $comment, $bocoDate, $pipelineStatus){

    $url = "http://localhost:7878/api/utg/credit_application/update/".$loanId;
    $data_array = array(
        'loanStatus' => $upadateLoanStatus,
        'comment' => $comment,
        'loanStatusAssigner' => $userId,
        'bocoDate' => $bocoDate,
        'pipelineStatus' => $pipelineStatus
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);

    $resp = curl_exec($ch);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/branch/'.$_SESSION['branch']);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $resp = curl_exec($ch);
                curl_close($ch);
                $branch = json_decode($resp, true);

                foreach($branch as $branches):
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/users/role/BranchManager');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $resp = curl_exec($ch);
                    curl_close($ch);
                    $branch_manager = json_decode($resp, true);
                endforeach;


                foreach ($branch_manager as $branch_managers):
                    $recipientName = $branch_managers['firstName'];
                    $recipientEmail = $branch_managers['contactDetail']['emailAddress'];

                    $url = "http://localhost:7878/api/utg/credit_application/bocoCheckLoanStatus/".$recipientName.'/'.$recipientEmail;

                    $data_array = array(
                        'recipientName' => $recipientName,
                        'recipientEmail' => $recipientEmail
                    );

                    $data = json_encode($data_array);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HEADER, true );
                    $resp = curl_exec($ch);
                    curl_close($ch);

                endforeach;

                if ($upadateLoanStatus == "ACCEPTED"){
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/credit_application/$loanId");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $server_response = curl_exec($ch);
                    curl_close($ch);
                    $loan = json_decode($server_response, true);

                    $ch = curl_init();
                    $messageText = str_replace(' ', '%20', "Dear ".$loan['firstName'].", We are currently reviewing your application.");
                    curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:7878/api/utg/sms/single/'.$loan['phoneNumber'].'/'.$messageText);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $resp = curl_exec($ch);
                    curl_close($ch);
                }

                $_SESSION['info'] = "Status updated successfully, Your Branch Manager has been notified";
                header('location: loan_info.php?menu=loan&loan_id='.$loanId.'&userid='.$userId);
                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    echo $key . ': ' . $val . '<br>';
                }
                echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                header('location: loan_info.php?loan_id='.$loanId.'&userid='.$userId);
                break;

            case 401: # Unauthorixed - Bad credientials
                $_SESSION['error'] = 'Update Status failed';
                header('location: loan_info.php?loan_id='.$loanId.'&userid='.$userId);
                break;
            default:
                $_SESSION['error'] = 'Could not update Loan status '. "\n";
                header('location: loan_info.php?loan_id='.$loanId.'&userid='.$userId);
        }
    } else {
        $_SESSION['error'] = 'Update Status failed.. Please try again!'."\n";
        header('location: loan_info.php?loan_id='.$loanId.'&userid='.$userId);
    }
    curl_close($ch);
}

function appraisal_files($loan_id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/appraisalFileUpload/get/'.$loan_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $appraisal_files = json_decode($server_response, true);
    return $appraisal_files;
}

function updateLoanAssessmentStatus($loanId,$assessment_status, $fullName,  $loDate, $pipelineStatus, $userId){

    $url = "http://localhost:7878/api/utg/credit_application/updateLoanAssessmentStatus/".$loanId;
    $data_array = array(
        'processLoanStatus' => $assessment_status,
        'processedBy' => $fullName,
        'loDate' => $loDate,
        'pipelineStatus' =>$pipelineStatus
    );

    $data = json_encode($data_array);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // convert headers to array
    $headers = headersToArray( $headerStr );

    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard
                $_SESSION['info'] = "Status updated successfully";
                header('location: loan_applications.php?state=processed');
                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    echo $key . ': ' . $val . '<br>';
                }
                echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                header('location: loan_applications.php?state=processed');
                break;

            case 401: # Unauthorixed - Bad credientials
                $_SESSION['error'] = 'Update Status failed';
                header('location: loan_applications.php?state=processed');
                break;
            default:
                $_SESSION['error'] = 'Could not update Loan status '. "\n";
                header('location: loan_applications.php?state=processed');
        }
    } else {
        $_SESSION['error'] = 'Update Status failed.. Please try again!'. "\n";
        header('location: loan_applications.php?state=processed');
    }
    curl_close($ch);
}

function setMeeting($recipientEmail, $subject, $message, $loanId, $userId, $scheduledBy, $bmDateMeeting, $commit, $pipelineStatus){
    $url = "http://localhost:7878/api/utg/credit_application/updateBmDateMeeting/".$loanId;
    $data_array = array(
        'bmDateMeeting' => $bmDateMeeting,
        'pipelineStatus' =>$pipelineStatus,
        'bmSetMeeting' => $userId,
        'creditCommit' => $commit
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    curl_close($ch);

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard
                $user = user($userId);

                $url = "http://localhost:7878/api/utg/credit_application/sendBulkEmail";

                $data_array = array(
                    'recipients' => $recipientEmail,
                    'subject' => $subject,
                    'message' => $message
                );

                $data = json_encode($data_array);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true );
                $resp = curl_exec($ch);

                // convert headers to array
                $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                $headerStr = substr($resp, 0, $headerSize);
                $bodyStr = substr($resp, $headerSize);
                $headers = headersToArray( $headerStr );

                // Check HTTP status code
                if (!curl_errno($ch)) {
                    switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                        case 200:
                            $_SESSION['info'] = "Scheduled Meeting Successfully";
                            audit($_SESSION['userid'], "Scheduled Meeting Successfully", $_SESSION['branch']);
                            header('location: bcc_final_decision.php');
                            break;
                        default:
                            $_SESSION['error'] = 'Failed to Schedule Meeting ';
                            header('location: bcc_final_decision.php');
                    }
                } else {
                    $_SESSION['error'] = 'Failed to Schedule Meeting.. Please try again!';
                    audit($_SESSION['userid'], "Failed to Schedule Meeting", $_SESSION['branch']);
//                    header('location: loan_info.php?menu=bcc_schedule&loan_id='.$loanId.'&userid='.$userId);
                    header('location: bcc_final_decision.php');

                }
                curl_close($ch);

            default:
                audit($_SESSION['userid'], "Failed to Schedule Meeting", $_SESSION['branch']);
//                header('location: loan_info.php?menu=bcc_schedule&loan_id='.$loanId.'&userid='.$userId);
                header('location: bcc_final_decision.php');

        }
    } else {
        audit($_SESSION['userid'], "Failed to Schedule Meeting", $_SESSION['branch']);
        header('location: loan_info.php?menu=bcc_schedule&loan_id='.$loanId.'&userid='.$userId);
    }
    curl_close($ch);

}

function collateral($id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/meetings/collateralByLoanId/$id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);
    curl_close($ch);
    $collateral = json_decode($resp, true);
    return $collateral;

}

if(isset($_POST['deleteCollateral'])) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/meetings/".$_POST['collateral_id']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    curl_close($ch);

}

//    ############################################## SCHEDULE MEETING ##########################################
if(isset($_POST['addCollateral'])){
    $txtCollateral = $_POST['txtCollateral'];
    $loanId = $_POST['loanId'];
    $userId = $_POST['userId'];
    $meetingFinalizedBy = $_POST['meetingFinalizedBy'];

    $url = "http://localhost:7878/api/utg/meetings/addMeetings";

    $data_array = array(
        'userId' => $userId,
        'loanId' => $loanId,
        'collateral' => $txtCollateral,
        'meetingFinalizedBy' => $meetingFinalizedBy
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);

    // convert headers to array
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    echo $key . ': ' . $val . '<br>';
                }
                //echo $val;
                $_SESSION['info'] = "Added successfully";
                audit($_SESSION['userid'], "Colleteral Added Successfuly", $_SESSION['branch']);
                header('location: loan_info.php?menu='.$cc_level.'&loan_id='.$loanId.'&userid='.$userId.'#final_decision');
                break;
            default:
                $_SESSION['error'] = 'Failed to add collateral ';
                audit($_SESSION['userid'], "Attempt to add Colleteral Failed", $_SESSION['branch']);
                header('location: loan_info.php?menu='.$cc_level.'&loan_id='.$loanId.'&userid='.$userId.'#final_decision');
        }
    } else {
        $_SESSION['error'] = 'Failed to add collateral.. Please try again!';
        header('location: loan_info.php?menu='.$cc_level.'&loan_id='.$loanId.'&userid='.$userId.'#final_decision');
    }
    curl_close($ch);
}

if(isset($_POST['set_bcc_meeting'])) {
    $recipientEmail = $_POST['recipientEmail'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $loanId = $_POST['loanId'];
    $userId = $_POST['userId'];
    $scheduledBy = $_POST['fullname'];
    $bmDateMeeting = date("Y-m-d H:i:s");
    $pipelineStatus = "bm_scheduled_meeting";
    $commit = $_POST['commit'];

    setMeeting($recipientEmail, $subject, $message, $loanId, $userId, $scheduledBy, $bmDateMeeting, $commit, $pipelineStatus);
}

function finalMeeting($recipientEmail, $subject, $message, $loanId, $userId, $decisionBy, $ccDate, $pipelineStatus, $creditCommit){

    $url = "http://localhost:7878/api/utg/credit_application/updateCcFinalMeeting/".$loanId;
    $data_array = array(
        'ccDate' => $ccDate,
        'pipelineStatus' =>$pipelineStatus,
        'creditCommit' => $creditCommit
    );
    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    curl_close($ch);

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard
                $user = user($userId);

                $url = "http://localhost:7878/api/utg/credit_application/sendBulkEmail";

                $data_array = array(
                    'recipients' => $recipientEmail,
                    'subject' => $subject,
                    'message' => $message
                );

                $data = json_encode($data_array);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true );
                $resp = curl_exec($ch);

                // convert headers to array
                $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                $headerStr = substr($resp, 0, $headerSize);
                $bodyStr = substr($resp, $headerSize);
                $headers = headersToArray( $headerStr );

                // Check HTTP status code
                if (!curl_errno($ch)) {
                    switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                        case 200:
                            $_SESSION['info'] = "Meeting Decision Set Successfully";
                            audit($_SESSION['userid'], "Meeting Decision Set Successfully", $_SESSION['branch']);
                            header('location: bcc_final_decision.php');
                            break;
                        default:
                            $_SESSION['error'] = 'Failed to set Meeting Decision ';
                            header('location: bcc_final_decision.php');
                    }
                } else {
                    $_SESSION['error'] = 'Failed to set Meeting Decision.. Please try again!';
                    audit($_SESSION['userid'], "Failed to set Meeting Decision..", $_SESSION['branch']);
//                    header('location: loan_info.php?menu=bcc_schedule&loan_id='.$loanId.'&userid='.$userId);
                    header('location: bcc_final_decision.php');

                }
                curl_close($ch);

            default:
                audit($_SESSION['userid'], "Failed to set Meeting Decision.", $_SESSION['branch']);
                if ($_SESSION['branch'] == 'Head Office'){
                    header('location: final_meeting.php');
                } else {
                    header('location: bcc_final_decision.php');
                }
        }
    } else {
        audit($_SESSION['userid'], "Failed to Schedule Meeting", $_SESSION['branch']);
        header('location: loan_info.php?menu=bcc_final&loan_id='.$loanId.'&userid='.$userId);
    }
    curl_close($ch);

}

if(isset($_POST['final_meeting'])) {
    $recipientEmail = $_POST['recipientEmail'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $loanId = $_POST['loanId'];
    $userId = $_POST['userId'];
    $decisionBy = $_POST['decisionBy'];
    $ccDate = date("Y-m-d H:i:s");
    $pipelineStatus = $_POST['pipeline'];
    $creditCommit = $_POST['creditCommit'];
    finalMeeting($recipientEmail, $subject, $message, $loanId, $userId, $decisionBy, $ccDate, $pipelineStatus, $creditCommit);
}

if(isset($_POST['final_predisbursement'])) {
    $loanId = $_POST['loanId'];
    $userId = $_POST['userId'];
    $decisionBy = $_POST['decisionBy'];
    $ccDate = date("Y-m-d H:i:s");
    $pipelineStatus = $_POST['pipeline'];
    $creditCommit = $_POST['creditCommit'];

    $data_array = array(
        'ccDate' => $ccDate,
        'pipelineStatus' =>$pipelineStatus,
        'creditCommit' => $creditCommit
    );
    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/credit_application/updateRecommentCcFinalMeeting/".$loanId);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    curl_close($ch);

    audit($_SESSION['userid'], "Set CC Decision for loan", $_SESSION['branch']);
}

if(isset($_POST['set_parameters'])) {
    $txtLoanAmount = $_POST['txtLoanAmount'];
    $txtTenure = $_POST['txtTenure'];
    $txtInterestRate = $_POST['txtInterestRate'];
    $txtBasis = $_POST['txtBasis'];
    $txtCashHandlingFee = $_POST['txtCashHandlingFee'];
    $txtRepaymentAmount = $_POST['txtRepaymentAmount'];
    $txtProduct = $_POST['txtProduct'];
    $txtRN = $_POST['txtRN'];
    $txtUpfrontFee = $_POST['txtUpfrontFee'];
    $loanId = $_POST['loanId'];
    $userId = $_POST['userId'];
    $meetingFinalizedBy = $_POST['meetingFinalizedBy'];

    $url = "http://localhost:7878/api/utg/credit_application/updateMeeting/".$loanId;
    $data_array = array(
        'meetingLoanAmount' => $txtLoanAmount,
        'meetingTenure' => $txtTenure,
        'meetingInterestRate' => $txtInterestRate,
        'meetingOnWhichBasis' => $txtBasis,
        'meetingCashHandlingFee' => $txtCashHandlingFee,
        'meetingRepaymentAmount' => $txtRepaymentAmount,
        'meetingProduct' => $txtProduct,
        'meetingRN' => $txtRN,
        'meetingUpfrontFee' => $txtUpfrontFee,
        'meetingFinalizedBy' => $meetingFinalizedBy,
        'ccDate' => $ccDate
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
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
                audit($_SESSION['userid'], "Updated values for a loan agreed in CC meeting", $_SESSION['branch']);
                header('location: loan_info.php?menu='.$cc_level.'&loan_id='.$loanId.'&userid='.$userId);
                break;
            default:
                $_SESSION['error'] = 'Could not update conditions'. "\n";
                audit($_SESSION['userid'], "Failed to Update values for a loan agreed in CC meeting", $_SESSION['branch']);
                header('location: loan_info.php?menu='.$cc_level.'&loan_id='.$loanId.'&userid='.$userId);
        }
    }
    else {
        $_SESSION['error'] = 'Could not update conditions.. Please try again!'. "\n";
        audit($_SESSION['userid'], "Failed to updated values for a loan agreed in CC meeting", $_SESSION['branch']);
        header('location: loan_info.php?menu='.$cc_level.'&loan_id='.$loanId.'&userid='.$userId);
    }
    curl_close($ch);
}

function data_collateral($id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,'http://localhost:7878/api/utg/meetings/collateralByLoanId/'.$id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    return json_decode($server_response, true);
}

//function updateTicket($loanId,$fullName ,$bocoSignature, $lessFees, $applicationFee, $predisDate, $pipelineStatus){
//
//
//}

if(isset($_POST['update_ticket'])) {
    $loanId = $_POST['loanId'];
    $fullName = $_POST['fullName'];
    $bocoSignature = $_POST['bocoSignature'];
    $lessFees = $_POST['lessFees'];
    $applicationFee = $_POST['applicationFee'];
    $meetingLoanAmount = $_POST['meetingLoanAmount'];
    $meetingCashHandlingFee = $_POST['meetingCashHandlingFee'];
    $meetingRepaymentAmount = $_POST['meetingRepaymentAmount'];
    $meetingTenure = $_POST['meetingTenure'];
    $meetingUpfrontFee = $_POST['meetingUpfrontFee'];
    $meetingInterestRate = $_POST['meetingInterestRate'];
    $predisDate = date("Y-m-d H:i:s");
    $pipelineStatus = "predisbursment_ticket";

    $url = "http://localhost:7878/api/utg/credit_application/updateTicketInfo/".$loanId;
    $data_array = array(
        //        'bocoSignature' => $bocoSignature,
        //        'bocoName' => $fullName,
        'lessFees' => $lessFees,
        'applicationFee' => $applicationFee,
        'meetingLoanAmount' => $meetingLoanAmount,

        'meetingCashHandlingFee' => $meetingCashHandlingFee,
        'meetingRepaymentAmount' => $meetingRepaymentAmount,
        'meetingTenure' => $meetingTenure,

        'meetingUpfrontFee' => $meetingUpfrontFee,
        'meetingInterestRate' => $meetingInterestRate,

        'predisDate' => $predisDate,
        'pipelineStatus' => $pipelineStatus
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // convert headers to array
    $headers = headersToArray( $headerStr );

    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard
                $_SESSION['info'] = "Ticket Updated Successfully!";
                audit($_SESSION['userid'], "Signed Ticket Successfully! - ".$loanId, $_SESSION['branch']);
                header('location: predisbursed_tickets.php');
                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    echo $key . ': ' . $val . '<br>';
                }
                echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                audit($_SESSION['userid'], "Failed to Sign Ticket! - ".$loanId, $_SESSION['branch']);
                header('location: predisbursed_tickets.php');
                break;
            default:
                $_SESSION['error'] = 'Could not update Loan status '. "\n";
                audit($_SESSION['userid'], "Failed to Sign Ticket! - ".$loanId, $_SESSION['branch']);
                header('location: predisbursed_tickets.php');
        }
    } else {
        $_SESSION['error'] = 'Signing failed.. Please try again!'. "\n";
        audit($_SESSION['userid'], "Failed to Sign Ticket! - ".$loanId, $_SESSION['branch']);
        header('location: predisbursed_tickets.php');
    }
    curl_close($ch);
}

if(isset($_POST['update_ticket'])) {
    $loanId = $_POST['loanId'];
    $fullName = $_POST['fullName'];
    $bocoSignature = $_POST['bocoSignature'];
    $lessFees = $_POST['lessFees'];
    $applicationFee = $_POST['applicationFee'];
    $predisDate = date("Y-m-d H:i:s");
    $pipelineStatus = "predisbursment_ticket";
    updateTicket($loanId, $fullName, $bocoSignature, $lessFees, $applicationFee, $predisDate, $pipelineStatus);
}

function updateBocoSignature($checked,$userId ,$bocoSignature){
    foreach($_POST['checkArr'] as $checked):
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/credit_application/".$checked);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_response = curl_exec($ch);

        $data = json_decode($server_response, true);
        $url = "http://localhost:7878/api/utg/credit_application/updateTicketSignature/".$checked;
        $data_array = array(
            'bocoSignature' => $bocoSignature,
            'bocoName' => $userId
        );

        $data = json_encode($data_array);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        $resp = curl_exec($ch);

        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headerStr = substr($resp, 0, $headerSize);
        $bodyStr = substr($resp, $headerSize);

        // convert headers to array
        $headers = headersToArray( $headerStr );

        if (!curl_errno($ch)) {
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:  # OK redirect to dashboard
                    $loan = loans('/'.$checked);

                    $ch = curl_init();
                    $messageText = str_replace(' ', '%20', "Dear ".$loan['firstName'].", We are pleased to advise that your loan application has been approved and our customer service desk will get in touch with you to guide you on the next steps.");
                    curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:7878/api/utg/sms/single/'.$loan['phoneNumber'].'/'.$messageText);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $resp = curl_exec($ch);
                    curl_close($ch);

                    $_SESSION['info'] = "Ticket signed successfully";
                    audit($_SESSION['userid'], "Ticket signed successfully - ".$checked, $_SESSION['branch']);
                    header('location: signed_tickets.php');
                    break;
                case 400:  # Bad Request
                    $decoded = json_decode($bodyStr);
                    foreach($decoded as $key => $val) {
                        echo $key . ': ' . $val . '<br>';}
                    echo $val;
                    $_SESSION['error'] = "Failed. Please try again, ".$val;
                    audit($_SESSION['userid'], "Failed to Sign Ticket! - ".$checked, $_SESSION['branch']);
                    header('location: predisbursed_tickets.php');
                    break;
                case 401: # Unauthorixed - Bad credientials
                    $_SESSION['error'] = 'Update Status failed';
                    audit($_SESSION['userid'], "Failed to Sign Ticket! - ".$checked, $_SESSION['branch']);
                    header('location: predisbursed_tickets.php');
                    break;
                default:
                    $_SESSION['error'] = 'Could not update Loan status '. "\n";
                    header('location: predisbursed_tickets.php');}
        }else {
            $_SESSION['error'] = 'Signing failed.. Please try again!'. "\n";
            audit($_SESSION['userid'], "Failed to Sign Ticket! - ".$checked, $_SESSION['branch']);
            header('location: predisbursed_tickets.php' );}
        curl_close($ch);
    endforeach;
}

if(isset($_POST['sign_ticket'])) {
    $checked = $_POST['checkArr'];
    $userId = $_POST['userId'];
    $bocoSignature = $_POST['bocoSignature'];
    if($checked==''){
        header('location: predisbursed_tickets.php');}
    else{
        updateBocoSignature($checked, $userId, $bocoSignature);}
}




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

                        $loan = loans('/'.$checked);

                        if ($loan['bocoName'] != "") {
                            $boco_signed = user($loan["bocoName"]);
                            $boco_signature = $boco_signed['firstName'].' '.$boco_signed['lastName'];
                        }
                        if ($loan['bmName'] != "") {
                            $bm_signed = user($loan["bmName"]);
                            $bm_signature = $bm_signed['firstName'].' '.$bm_signed['lastName'];

                        }
                        if ($loan['caName'] != "") {
                            $ca_signed = user($loan["caName"]);
                            $ca_signature = $ca_signed['firstName'].' '.$ca_signed['lastName'];
                        }
                        if ($loan['cmName'] != "") {
                            $cm_signed = user($loan["cmName"]);
                            $cm_signature = $cm_signed['firstName'].' '.$cm_signed['lastName'];
                        }
                        if ($loan['finName'] != "") {
                            $fin_signed = user($loan["finName"]);
                            $fin_signature = $fin_signed['firstName'].' '.$fin_signed['lastName'];
                        }


                        $data_collateral = data_collateral($checked);
                        $array[$i] = $loan['firstName'];

                        $i++;
                        $this->SetX(5);
                        $this->SetFont('Times', '', 7);
                        $this->Cell(30, 10, $loan['firstName'] . ' ' . $loan['middleName'] . ' ' . $loan['lastName'], 1, 0, 'C');
                        $this->Cell(20, 10, $loan["meetingLoanAmount"] . ' USD', 1, 0, 'L');
                        $this->Cell(15, 10, $loan["lessFees"] . ' USD', 1, 0, 'L');
                        $this->Cell(20, 10, $loan["applicationFee"] . ' USD', 1, 0, 'L');
                        $this->Cell(20, 10, $loan["meetingCashHandlingFee"] . ' USD', 1, 0, 'L');
                        $this->Cell(20, 10, $loan["meetingInterestRate"] . ' %', 1, 0, 'L');
                        $this->Cell(27, 10, $loan["meetingRepaymentAmount"], 1, 0, 'L');
                        $this->Cell(15, 10, $loan["branchName"], 1, 0, 'L');
                        $this->Cell(8, 10, $loan["meetingTenure"], 1, 0, 'L');
                        $this->Cell(10, 10, $loan["meetingProduct"], 1, 0, 'L');
                        $this->Cell(10, 10, $loan["meetingUpfrontFee"] . ' %', 1, 0, 'L');
                        $this->Cell(8, 10, $loan["meetingRN"], 1, 0, 'L');
                        $this->Cell(20, 10, $loan["processedBy"], 1, 0, 'L');
                        $temp = "";
                        foreach ($data_collateral as $i) {
                            $temp = $temp . ' ' . $i["collateral"] . ',';
                        }
                        $this->Cell(60, 10, $temp, 1, 0, 'L');


                        $this->Ln();
                        $this->SetFont('Times', '', 12);
                        if ($boco_signature != "") {
                            $this->Cell(10, 30, ' ', 0, 1);
                            $this->Cell(70, 7, 'Prepared By: ', 0, 0, 'L');
                            $this->Cell(70, 7, $boco_signature, 0, 0, 'C');
                        }

                        if ($bm_signature != "") {
                            $this->Cell(10, 10, ' ', 0, 1);
                            $this->Cell(70, 7, 'Checked by Branch Manager: ', 0, 0, 'L');
                            $this->Cell(70, 7, $bm_signature, 0, 0, 'C');
                        }

                        if ($ca_signature != "") {
                            $this->Cell(10, 10, ' ', 0, 1);
                            $this->Cell(70, 7, 'Credit Checked by: ', 0, 0, 'L');
                            $this->Cell(70, 7, $ca_signature, 0, 0, 'C');
                        }

                        if ($cm_signature != "") {
                            $this->Cell(10, 10, ' ', 0, 1);
                            $this->Cell(70, 7, 'Confirmed by Credit Manager: ', 0, 0, 'L');
                            $this->Cell(70, 7, $cm_signature, 0, 0, 'C');
                        }

                        if ($fin_signature != "") {
                            $this->Cell(10, 10, ' ', 0, 1);
                            $this->Cell(70, 7, 'Finance Authorised by : ', 0, 0, 'L');
                            $this->Cell(70, 7, $fin_signature, 0, 0, 'C');
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

if(isset($_POST['bm_sign_ticket'])) {
    $checked = $_POST['checkArr'];
    $userId = $_POST['userId'];
    $bmSignature = $_POST['bmSignature'];

    if($checked==''){
        header('location: signed_tickets.php');
    }
    else{
        foreach($_POST['checkArr'] as $checked):
            $data = loans('/'.$checked);
            $url = "http://localhost:7878/api/utg/credit_application/updateBmSignature/".$checked;
            $data_array = array(
                'bmSignature' => $bmSignature,
                'bmName' => $userId);

            $data = json_encode($data_array);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            $resp = curl_exec($ch);

            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $headerStr = substr($resp, 0, $headerSize);
            $bodyStr = substr($resp, $headerSize);
            $headers = headersToArray($headerStr);

            if (!curl_errno($ch)) {
                switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                    case 200:  # OK redirect to dashboard
                        $_SESSION['info'] = "Ticket signed successfully";
                        audit($_SESSION['userid'], "Ticket signed successfully - ".$checked, $_SESSION['branch']);
                        header('location: signed_tickets.php');
                        break;
                    case 400:  # Bad Request
                        $decoded = json_decode($bodyStr);
                        foreach($decoded as $key => $val) {
                            echo $key . ': ' . $val . '<br>';
                        }
                        echo $val;
                        $_SESSION['error'] = "Failed. Please try again";
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: signed_tickets.php');
                        break;

                    case 401: # Unauthorixed - Bad credientials
                        $_SESSION['error'] = 'Update Status failed';
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: signed_tickets.php');
                        break;
                    default:
                        $_SESSION['error'] = 'Could not update Loan status '. "\n";
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: signed_tickets.php');
                }
            }else {
                $_SESSION['error'] = 'Signing failed.. Please try again!'. "\n";
                audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                header('location: signed_tickets.php' );
            }
            curl_close($ch);
        endforeach;
    }
}

if(isset($_POST['ca_sign_ticket'])) {
    $checked = $_POST['checkArr'];
    $userId = $_POST['userId'];
    $caSignature = $_POST['caSignature'];
    if($checked==''){
        header('location: predisbursed_tickets.php');
    }
    else{
        foreach($_POST['checkArr'] as $checked):

//            $userId = $_SESSION['userid'];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/credit_application/".$checked);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_response = curl_exec($ch);

            $data = json_decode($server_response, true);
            $url = "http://localhost:7878/api/utg/credit_application/updateCaSignature/".$checked;
            $data_array = array(
                'caSignature' => $caSignature,
                'caName' => $userId
            );

            $data = json_encode($data_array);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);

            $resp = curl_exec($ch);

            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $headerStr = substr($resp, 0, $headerSize);
            $bodyStr = substr($resp, $headerSize);

            // convert headers to array
            $headers = headersToArray( $headerStr );

            if (!curl_errno($ch)) {
                switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                    case 200:  # OK redirect to dashboard

                        $_SESSION['info'] = "Ticket signed successfully";
                        audit($_SESSION['userid'], "Ticket signed successfully - ".$checked, $_SESSION['branch']);
                        header('location: signed_tickets.php');
                        break;
                    case 400:  # Bad Request
                        $decoded = json_decode($bodyStr);
                        foreach($decoded as $key => $val) {
                            echo $key . ': ' . $val . '<br>';
                        }
                        echo $val;
                        $_SESSION['error'] = "Failed. Please try again, ".$val;
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: predisbursed_tickets.php');
                        break;

                    case 401: # Unauthorixed - Bad credientials
                        $_SESSION['error'] = 'Update Status failed';
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: predisbursed_tickets.php');

                        break;
                    default:
                        $_SESSION['error'] = 'Could not update Loan status '. "\n";
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: predisbursed_tickets.php');
                }
            }else {
                $_SESSION['error'] = 'Signing failed.. Please try again!'. "\n";
                audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                header('location: predisbursed_tickets.php');

            }
            curl_close($ch);
        endforeach;
    }
}

if(isset($_POST['cm_sign_ticket'])) {
    $checked = $_POST['checkArr'];
    $userId = $_POST['userId'];
    $cmSignature = $_POST['cmSignature'];
    if($checked==''){
        header('location: predisbursed_tickets.php');
    }
    else{
        foreach($_POST['checkArr'] as $checked):

//            $userId = $_SESSION['userid'];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/credit_application/".$checked);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_response = curl_exec($ch);

            $data = json_decode($server_response, true);
            $url = "http://localhost:7878/api/utg/credit_application/updateCmSignature/".$checked;
            $data_array = array(
                'cmSignature' => $cmSignature,
                'cmName' => $userId
            );

            $data = json_encode($data_array);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);

            $resp = curl_exec($ch);

            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $headerStr = substr($resp, 0, $headerSize);
            $bodyStr = substr($resp, $headerSize);

            // convert headers to array
            $headers = headersToArray( $headerStr );

            if (!curl_errno($ch)) {
                switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                    case 200:  # OK redirect to dashboard

                        $_SESSION['info'] = "Ticket signed successfully";
                        audit($_SESSION['userid'], "Ticket signing successful - ".$checked, $_SESSION['branch']);
                        header('location: signed_tickets.php');
                        break;
                    case 400:  # Bad Request
                        $decoded = json_decode($bodyStr);
                        foreach($decoded as $key => $val) {
                            echo $key . ': ' . $val . '<br>';
                        }
                        echo $val;
                        $_SESSION['error'] = "Failed. Please try again, ".$val;
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: predisbursed_tickets.php');
                        break;

                    case 401: # Unauthorixed - Bad credientials
                        $_SESSION['error'] = 'Update Status failed';
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: predisbursed_tickets.php');

                        break;
                    default:
                        $_SESSION['error'] = 'Could not update Loan status '. "\n";
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: predisbursed_tickets.php');
                }
            }else {
                $_SESSION['error'] = 'Signing failed.. Please try again!'. "\n";
                audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                header('location: predisbursed_tickets.php');

            }
            curl_close($ch);
        endforeach;
    }
}

if(isset($_POST['fin_sign_ticket'])) {
    $checked = $_POST['checkArr'];
    $userId = $_POST['userId'];
    $cmSignature = $_POST['finSignature'];
    if($checked==''){
        header('location: predisbursed_tickets.php');
    }
    else{
        foreach($_POST['checkArr'] as $checked):

//            $userId = $_SESSION['userid'];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/credit_application/".$checked);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_response = curl_exec($ch);

            $data = json_decode($server_response, true);
            $url = "http://localhost:7878/api/utg/credit_application/updateFinSignature/".$checked;
            $data_array = array(
                'finSignature' => $cmSignature,
                'finName' => $userId
            );

            $data = json_encode($data_array);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);

            $resp = curl_exec($ch);

            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $headerStr = substr($resp, 0, $headerSize);
            $bodyStr = substr($resp, $headerSize);

            // convert headers to array
            $headers = headersToArray( $headerStr );

            if (!curl_errno($ch)) {
                switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                    case 200:  # OK redirect to dashboard

                        $_SESSION['info'] = "Ticket signed successfully";
                        audit($_SESSION['userid'], "Ticket signing successful - ".$checked, $_SESSION['branch']);
                        header('location: signed_tickets.php');
                        break;
                    case 400:  # Bad Request
                        $decoded = json_decode($bodyStr);
                        foreach($decoded as $key => $val) {
                            echo $key . ': ' . $val . '<br>';
                        }
                        echo $val;
                        $_SESSION['error'] = "Failed. Please try again, ".$val;
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: predisbursed_tickets.php');
                        break;

                    case 401: # Unauthorixed - Bad credientials
                        $_SESSION['error'] = 'Update Status failed';
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: predisbursed_tickets.php');

                        break;
                    default:
                        $_SESSION['error'] = 'Could not update Loan status '. "\n";
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: predisbursed_tickets.php');
                }
            }else {
                $_SESSION['error'] = 'Signing failed.. Please try again!'. "\n";
                audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                header('location: predisbursed_tickets.php');

            }
            curl_close($ch);
        endforeach;
    }
}

if(isset($_POST['board_sign_ticket'])) {
    $checked = $_POST['checkArr'];
    $userId = $_POST['userId'];
    $cmSignature = $_POST['boardSignature'];
    if($checked==''){
        header('location: predisbursed_tickets.php');
    }
    else{
        foreach($_POST['checkArr'] as $checked):

//            $userId = $_SESSION['userid'];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/credit_application/".$checked);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_response = curl_exec($ch);

            $data = json_decode($server_response, true);
            $url = "http://localhost:7878/api/utg/credit_application/updateBoardSignature/".$checked;
            $data_array = array(
                'boardSignature' => $cmSignature,
                'boardName' => $userId
            );

            $data = json_encode($data_array);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);

            $resp = curl_exec($ch);

            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $headerStr = substr($resp, 0, $headerSize);
            $bodyStr = substr($resp, $headerSize);

            // convert headers to array
            $headers = headersToArray( $headerStr );

            if (!curl_errno($ch)) {
                switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                    case 200:  # OK redirect to dashboard

                        $_SESSION['info'] = "Ticket signed successfully";
                        audit($_SESSION['userid'], "Ticket signing successful - ".$checked, $_SESSION['branch']);
                        header('location: signed_tickets.php');
                        break;
                    case 400:  # Bad Request
                        $decoded = json_decode($bodyStr);
                        foreach($decoded as $key => $val) {
                            echo $key . ': ' . $val . '<br>';
                        }
                        echo $val;
                        $_SESSION['error'] = "Failed. Please try again, ".$val;
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: predisbursed_tickets.php');
                        break;

                    case 401: # Unauthorixed - Bad credientials
                        $_SESSION['error'] = 'Update Status failed';
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: predisbursed_tickets.php');

                        break;
                    default:
                        $_SESSION['error'] = 'Could not update Loan status '. "\n";
                        audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                        header('location: predisbursed_tickets.php');
                }
            }else {
                $_SESSION['error'] = 'Signing failed.. Please try again!'. "\n";
                audit($_SESSION['userid'], "Ticket signing failed - ".$checked, $_SESSION['branch']);
                header('location: predisbursed_tickets.php');

            }
            curl_close($ch);
        endforeach;
    }
}


// ######################  Get ALL REQUISITIONS #################################

function requisitions($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/requisitions'.$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $loans_response = curl_exec($ch);
    curl_close($ch);
    $requisitions = json_decode($loans_response, true);
    return $requisitions;
}

// ######################  Get ALL Parameters #################################

//function parameters(){
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/pos/parameter/all');
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $parameter_response = curl_exec($ch);
//    curl_close($ch);
//    $parameter = json_decode($parameter_response, true);
//    return $parameter;
//
//}
if (isset($_POST['create_requisition'])) {
    // API endpoint URL
    $url = "http://localhost:7878/api/utg/requisitions/save";

    // Data to send in the POST request
    $postData = array(
        'poNumber' => $_POST['po_number'],
        'poName' => $_POST['name'],
        'poTotal' => 0,
        'poCount' => 0,
        'poStatus' => "OPEN",
        'userId' => $_SESSION['userId']
    );

    // Encode the data array as JSON
    $data = json_encode($postData);

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the POST request and store the response in a variable
    $response = curl_exec($ch);
    $formattedData = json_encode(json_decode($response), JSON_PRETTY_PRINT);
    echo '<script>alert("'.addslashes($formattedData).'");</script>';


    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    // Parse the API response as JSON to extract the ID
    $responseData = json_decode($response, true);

    if ($responseData && isset($responseData['id'])) {
        // Add the returned ID to the data array
        $postData['id'] = $responseData['id'];

        // Encode the updated data array as JSON
        $data = json_encode($postData);
    }

    $formattedData = json_encode(json_decode($data), JSON_PRETTY_PRINT);
    echo '<script>alert("'.addslashes($formattedData).'");</script>';

    header("Location: req_info.php?menu=req&req_id=".$responseData['id']);
}


// ######################  Get Transactions for a REQUISITION #################################

function req_trans($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/poTransactions'.$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $loans_response = curl_exec($ch);
    curl_close($ch);
    $req_trans = json_decode($loans_response, true);
    return $req_trans;
}


// ######################  Add Transaction to a REQUISITION #################################

if(isset($_POST['add_req_trans'])) {
    $url = "http://localhost:7878/api/utg/poTransactions";
    $data_array = array(
        'poItem' => $_POST['item'],
        'poSupplier' => $_POST['supplier'],
        'poCategory' => $_POST['category'],
        'poQuantity' => $_POST['quantity'],
        'poAmount' => $_POST['amount'],
        'poRequisitionId' => $_POST['req_id'],
        'poCurrency' => $_POST['currency'],
        'poStatus' => "OPEN"
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);

    // convert headers to array
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:
                $_SESSION['info'] = "Purchase Order Transaction created Successfully";
                audit($_SESSION['userid'], "Purchase Order Transaction created Successfully", $_SESSION['branch']);
                header('location: req_info.php?menu=req&req_id='.$_POST['req_id']);
                break;
            default:
                $_SESSION['error'] = 'Failed to create PO Transaction.';
                audit($_SESSION['userid'], "Failed to create Purchase Order Transaction", $_SESSION['branch']);
                header('location: req_info.php?menu=req&req_id='.$_POST['req_id']);
        }
    } else {
        $_SESSION['error'] = 'Failed to Add Purchase Order Transaction.. Please try again!';
        audit($_SESSION['userid'], "Failed to create Purchase Order Transaction", $_SESSION['branch']);
        header('location: req_info.php?menu=req&req_id='.$_POST['req_id']);
    }
    curl_close($ch);

}

if (isset($_POST['update_po_trans'])) {

    $req_trans_id = $_POST['req_trans_id'];
    $req_id = $_POST['req_id'];

    $data_array = array(
        'poItem' => $_POST['item'],
        'poSupplier' => $_POST['supplier'],
        'poCategory' => $_POST['category'],
        'poQuantity' => $_POST['quantity'],
        'poAmount' => $_POST['amount'],
        'poCurrency' => $_POST['currency'],
        'poStatus' => $_POST['status']

    );

    // Convert the data array to JSON
    $data = json_encode($data_array);

    $url = "http://localhost:7878/api/utg/poTransactions/".$req_trans_id;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, true);

    // Execute cURL request
    $response = curl_exec($curl);
    $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $headerStr = substr($response, 0, $headerSize);
    $bodyStr = substr($response, $headerSize);
    $headers = headersToArray($headerStr);

    // Check for errors
    if (!curl_errno($curl)) {
        switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
            case 200:
//                echo "<script>alert('$systemOut')</script>";
                $_SESSION['info'] = "Purchase Order Transaction approved Successfully";
                audit($_SESSION['userid'], "Purchase Order Transaction approved Successfully", $_SESSION['branch']);
                header('location: req_info.php?menu=req&req_id='.$req_id);
                break;
            default:
                $_SESSION['error'] = 'Failed to approved PO Transaction.';
                audit($_SESSION['userid'], "Failed to approved Purchase Order Transaction", $_SESSION['branch']);
                header('location: requisitions.php?menu=main');
        }
    } else {
        $_SESSION['error'] = 'Failed to approved Purchase Order Transaction.. Please try again!';
        audit($_SESSION['userid'], "Failed to approved Purchase Order Transaction", $_SESSION['branch']);
        header('location: requisitions.php?menu=main');
    }
    curl_close($curl);

}

// ######################  Add Transaction to a REQUISITION #################################

function save_requisition(){
    // Gather form data
    $requisitionId = $_POST['req_id'];
    $notes = $_POST['notes'];
    $approvers = $_POST['approvers']; // $approvers will be an array of selected values

    // Initialize an array to store attachment file names
    $attachmentFiles = array();

    // Loop through the uploaded files
    foreach ($_FILES['attachments']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['attachments']['name'][$key];
        $file_tmp = $_FILES['attachments']['tmp_name'][$key];

        // Check if a file was uploaded successfully
        if ($file_name != "") {
            $temp = explode(".", $file_name);
            $attachment = pathinfo($file_name, PATHINFO_FILENAME) . '_' . date('Y.m.d') . '.' . end($temp);
            $uploadfile = '../includes/file_uploads/purchase_order/' . $attachment;

            // Move the uploaded file to the destination folder
            if (move_uploaded_file($file_tmp, $uploadfile)) {
                $attachmentFiles[] = $uploadfile;
            }
        }
    }

    // Print the paths of the moved files
    $systemOut = "Attachments: " . $attachmentFiles;
    $systemOuts = "Approvers: " . $approvers;

    // Build the data array with attachment file names
    $data_array = array(
        'notes' => $notes,
        'approvers' => $approvers,
        'attachments' => $attachmentFiles,
        'poStatus' => "OPEN",
    );

    // Convert the data array to JSON
    $data = json_encode($data_array);

    $url = "http://localhost:7878/api/utg/requisitions/" . $requisitionId;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, true);

    // Execute cURL request
    $response = curl_exec($curl);
    $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $headerStr = substr($response, 0, $headerSize);
    $bodyStr = substr($response, $headerSize);
    $headers = headersToArray($headerStr);

    // Check for errors
    if (!curl_errno($curl)) {
        switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
            case 200:
//                echo "<script>alert('$systemOut')</script>";
                $_SESSION['info'] = "Purchase Order Transaction updated Successfully";
                audit($_SESSION['userid'], "Purchase Order Transaction updated Successfully", $_SESSION['branch']);
                header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
                break;
            default:
                $_SESSION['error'] = 'Failed to update PO Transaction.';
                audit($_SESSION['userid'], "Failed to update Purchase Order Transaction", $_SESSION['branch']);
                header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
        }
    } else {
        $_SESSION['error'] = 'Failed to update Purchase Order Transaction.. Please try again!';
        audit($_SESSION['userid'], "Failed to update Purchase Order Transaction", $_SESSION['branch']);
        header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
    }
    curl_close($curl);
}

if (isset($_POST['save_requisition'])) {
    save_requisition();
}

if (isset($_POST['po_approve_requisition'])) {

        $data_array = array(
            'poStatus' => $_POST['status'],
            'poApprover' => $_SESSION['userId'],
        );

        // Convert the data array to JSON
        $data = json_encode($data_array);

        $url = "http://localhost:7878/api/utg/requisitions/poApproveRequest/".$_GET['req_id'];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);

        // Execute cURL request
        $response = curl_exec($curl);
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $headerStr = substr($response, 0, $headerSize);
        $bodyStr = substr($response, $headerSize);
        $headers = headersToArray($headerStr);

        // Check for errors
        if (!curl_errno($curl)) {
            switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
                case 200:
//                echo "<script>alert('$systemOut')</script>";
                    $_SESSION['info'] = "Purchase Order Transaction approved Successfully";
                    audit($_SESSION['userid'], "Purchase Order Transaction approved Successfully", $_SESSION['branch']);
                    header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
                    break;
                default:
                    $_SESSION['error'] = 'Failed to approved PO Transaction.';
                    audit($_SESSION['userid'], "Failed to approved Purchase Order Transaction", $_SESSION['branch']);
                    header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
            }
        } else {
            $_SESSION['error'] = 'Failed to approved Purchase Order Transaction.. Please try again!';
            audit($_SESSION['userid'], "Failed to approved Purchase Order Transaction", $_SESSION['branch']);
            header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
        }
        curl_close($curl);

}

if (isset($_POST['cms_approve_requisition'])) {

    $data_array = array(
        'poStatus' => $_POST['cmsStatus'],
        'cmsApprover' => $_SESSION['userId'],
        'teller' => $_POST['teller']
    );

    // Convert the data array to JSON
    $data = json_encode($data_array);

    $url = "http://localhost:7878/api/utg/requisitions/cmsApproveRequest/".$_GET['req_id'];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, true);

    // Execute cURL request
    $response = curl_exec($curl);
    $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $headerStr = substr($response, 0, $headerSize);
    $bodyStr = substr($response, $headerSize);
    $headers = headersToArray($headerStr);

    // Check for errors
    if (!curl_errno($curl)) {
        switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
            case 200:
//                echo "<script>alert('$systemOut')</script>";
                $_SESSION['info'] = "Purchase Order Transaction approved Successfully";
                audit($_SESSION['userid'], "Purchase Order Transaction approved Successfully", $_SESSION['branch']);
                header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
                break;
            default:
                $_SESSION['error'] = 'Failed to approved PO Transaction.';
                audit($_SESSION['userid'], "Failed to approved Purchase Order Transaction", $_SESSION['branch']);
                header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
        }
    } else {
        $_SESSION['error'] = 'Failed to approved Purchase Order Transaction.. Please try again!';
        audit($_SESSION['userid'], "Failed to approved Purchase Order Transaction", $_SESSION['branch']);
        header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
    }
    curl_close($curl);

}


if(isset($_POST['paid_requisition'])) {
    // Collect form data and assign to variables
    $userName = $_POST['req_initiator'] ?? "";

    $toAccount = getVaultAccountByType("Expense Account") ?? "";
    $fromAccount = getVaultAccount($_SESSION['userid'], "Petty Cash") ?? "";

    $reference = $_POST['req_reference'] ?? "";
    $amount = $_POST['req_amount'] ?? "";
    $transactionType = "PO-TRANS";
    $description = $_POST['req_name'] ?? "Purchase Order Transaction";

    $data_array = array(
        'poStatus' => $_POST['paidStatus']
    );

    // Convert the data array to JSON
    $data = json_encode($data_array);

    $url = "http://localhost:7878/api/utg/requisitions/paidRequisition/".$_GET['req_id'];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, true);

    // Execute cURL request
    $response = curl_exec($curl);
    $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $headerStr = substr($response, 0, $headerSize);
    $bodyStr = substr($response, $headerSize);
    $headers = headersToArray($headerStr);

    // Check for errors
    if (!curl_errno($curl)) {
        switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
            case 200:
                $_SESSION['info'] = "Purchase Order Transaction paid Successfully";
                audit($_SESSION['userid'], "Purchase Order Transaction paid Successfully", $_SESSION['branch']);

                pastel_transaction($userName, $toAccount, $fromAccount, $reference, $amount, $transactionType, $description);

                header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
                break;
            default:
                $_SESSION['error'] = 'Failed to make PO Transaction payment.';
                audit($_SESSION['userid'], "Failed to pay Purchase Order Transaction", $_SESSION['branch']);
                header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
        }
    } else {
        $_SESSION['error'] = 'Failed to pay Purchase Order Transaction.. Please try again!';
        audit($_SESSION['userid'], "Failed to make Purchase Order Transaction payment", $_SESSION['branch']);
        header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
    }
    curl_close($curl);

}

if (isset($_POST['request_revisions'])) {

    $data_array = array(
        'poStatus' => $_POST['declineStatus'],
        'cmsApprover' => $_SESSION['userId'],
    );

    // Convert the data array to JSON
    $data = json_encode($data_array);

    $url = "http://localhost:7878/api/utg/requisitions/cmsApproveRequest/".$_GET['req_id'];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, true);

    // Execute cURL request
    $response = curl_exec($curl);
    $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $headerStr = substr($response, 0, $headerSize);
    $bodyStr = substr($response, $headerSize);
    $headers = headersToArray($headerStr);

    // Check for errors
    if (!curl_errno($curl)) {
        switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
            case 200:
//                echo "<script>alert('$systemOut')</script>";
                $_SESSION['info'] = "Purchase Order Transaction approved Successfully";
                audit($_SESSION['userid'], "Purchase Order Transaction approved Successfully", $_SESSION['branch']);
                header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
                break;
            default:
                $_SESSION['error'] = 'Failed to approved PO Transaction.';
                audit($_SESSION['userid'], "Failed to approved Purchase Order Transaction", $_SESSION['branch']);
                header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
        }
    } else {
        $_SESSION['error'] = 'Failed to approved Purchase Order Transaction.. Please try again!';
        audit($_SESSION['userid'], "Failed to approved Purchase Order Transaction", $_SESSION['branch']);
        header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
    }
    curl_close($curl);

}

if (isset($_POST['request_revision'])) {

    $data_array = array(
        'poStatus' => $_POST['declineStatus'],
        'poApprover' => $_SESSION['userId'],
    );

    // Convert the data array to JSON
    $data = json_encode($data_array);

    $url = "http://localhost:7878/api/utg/requisitions/poApproveRequest/".$_GET['req_id'];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, true);

    // Execute cURL request
    $response = curl_exec($curl);
    $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $headerStr = substr($response, 0, $headerSize);
    $bodyStr = substr($response, $headerSize);
    $headers = headersToArray($headerStr);

    // Check for errors
    if (!curl_errno($curl)) {
        switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
            case 200:
//                echo "<script>alert('$systemOut')</script>";
                $_SESSION['info'] = "Purchase Order Transaction approved Successfully";
                audit($_SESSION['userid'], "Purchase Order Transaction approved Successfully", $_SESSION['branch']);
                header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
                break;
            default:
                $_SESSION['error'] = 'Failed to approve PO Transaction.';
                audit($_SESSION['userid'], "Failed to approve Purchase Order Transaction", $_SESSION['branch']);
                header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
        }
    } else {
        $_SESSION['error'] = 'Failed to approve Purchase Order Transaction.. Please try again!';
        audit($_SESSION['userid'], "Failed to approve Purchase Order Transaction", $_SESSION['branch']);
        header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
    }
    curl_close($curl);

}

function send_requisition(){
    // Gather form data
    $requisitionId = $_POST['req_id'];
    $notes = $_POST['notes'];
    $approvers = $_POST['approvers']; // $approvers will be an array of selected values
    $po_number = $_POST['poNumber'];

    // Initialize an array to store attachment file names
    $attachmentFiles = array();

    // Loop through the uploaded files
    foreach ($_FILES['attachments']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['attachments']['name'][$key];
        $file_tmp = $_FILES['attachments']['tmp_name'][$key];

        // Check if a file was uploaded successfully
        if ($file_name != "") {
            $temp = explode(".", $file_name);
            $attachment = pathinfo($file_name, PATHINFO_FILENAME) . '_' . date('Y.m.d') . '.' . end($temp);
            $uploadfile = '../includes/file_uploads/purchase_order/' . $attachment;

            // Move the uploaded file to the destination folder
            if (move_uploaded_file($file_tmp, $uploadfile)) {
                $attachmentFiles[] = $uploadfile;
            }
        }
    }

    // Print the paths of the moved files
    $systemOut = "Attachments: " . $attachmentFiles;
    $systemOuts = "Approvers: " . $approvers;

    // Build the data array with attachment file names
    $data_array = array(
        'notes' => $notes,
        'approvers' => $approvers,
        'attachments' => $attachmentFiles
    );

    // Convert the data array to JSON
    $data = json_encode($data_array);

    $url = "http://localhost:7878/api/utg/requisitions/" . $requisitionId;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, true);

    // Execute cURL request
    $response = curl_exec($curl);
    $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $headerStr = substr($response, 0, $headerSize);
    $bodyStr = substr($response, $headerSize);
    $headers = headersToArray($headerStr);

    // Check for errors
    if (!curl_errno($curl)) {
        switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
            case 200:

                $user_email = []; // Initialize an empty array to store email addresses

                foreach ($approvers as $user_id){
                    $user = user($user_id);
                    $user_email[] = $user['contactDetail']['emailAddress']; // Append each email address to the array
                }

                $url = "http://localhost:7878/api/utg/credit_application/sendBulkEmail";
                $data_array = array(
                    'recipients' => $user_email,
                    'subject' => "Purchase Order Request: $po_number",
                    'message' => "A Purchase Order requiring your approval is currently pending for your approval. Please log in to the CMS and access the Purchase Order section on the sidebar to review it. We value your prompt consideration of this request."
                );


                $data = json_encode($data_array);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true );
                $resp = curl_exec($ch);




                $_SESSION['info'] = "Purchase Order Transaction updated Successfully";
                audit($_SESSION['userid'], "Purchase Order Transaction updated Successfully", $_SESSION['branch']);
                header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
                break;
            default:
                $_SESSION['error'] = 'Failed to update PO Transaction.';
                audit($_SESSION['userid'], "Failed to update Purchase Order Transaction", $_SESSION['branch']);
                header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
        }
    } else {
        $_SESSION['error'] = 'Failed to update Purchase Order Transaction.. Please try again!';
        audit($_SESSION['userid'], "Failed to update Purchase Order Transaction", $_SESSION['branch']);
        header('location: req_info.php?menu=req&req_id=' . $_POST['req_id']);
    }
    curl_close($curl);
}

if (isset($_POST['send_requisition'])) {
    send_requisition();
}

function suppliers($path){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/supplier".$path);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);

    curl_close($ch);
    return json_decode($server_response, true);
//    return $data;
}

if(isset($_POST['delete_supplier'])) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/supplier/delete/".$_POST['supplierId']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    curl_close($ch);

}

function categories($path){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/category".$path);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($server_response, true);
// Check if the JSON decoding was successful
    if ($data !== null) {
        return $data;

    } else {
        return "Error decoding JSON data";
    }
}

if(isset($_POST['create_category'])){
    // API endpoint URL
    $url ="http://localhost:7878/api/utg/pos/budget/save";

    // Data to send in the POST request
    $postData = array(
        'category' => $_POST['category'],
        'year' => $_POST['year'],
        'january' => $_POST['january'],
        'february' => $_POST['february'],
        'march' => $_POST['march'],
        'april' => $_POST['april'],
        'may' => $_POST['may'],
        'june' => $_POST['june'],
        'july' => $_POST['july'],
        'august' => $_POST['august'],
        'september' => $_POST['september'],
        'october' => $_POST['october'],
        'november' => $_POST['november'],
        'december' => $_POST['december'],
    );

    $data = json_encode($postData);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );

    // Execute the POST request and store the response in a variable
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    header("Location: requisitions.php?menu=main");
    exit;
}

if(isset($_POST['delete_category'])) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/category/delete/".$_POST['categoryId']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    curl_close($ch);

}

if(isset($_POST['update_cms_role'])) {
    $user = $_POST['user'];
    $role = $_POST['role'];

    $data_array = array(
        'role' => $role
    );
    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/users/updateCmsUserRole/".$user);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    curl_close($ch);

    audit($_SESSION['userid'], "Admin updated user ($user) Cash Management Sys Role", $_SESSION['branch']);
}

if(isset($_POST['update_tms_role'])) {
    $user = $_POST['user'];
    $role = $_POST['role'];

    $data_array = array(
        'role' => $role
    );
    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/users/updateTmsUserRole/".$user);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    curl_close($ch);

    audit($_SESSION['userid'], "Admin updated user ($user)\'s Treasury Management Sys Role", $_SESSION['branch']);
}

if(isset($_POST['add_vault_permissions'])) {
    $user = $_POST['user'];
    $vault_acc = $_POST['vault_acc'];
    $vault_type = $_POST['vault_type'];

    $data_array = array(
        'role' => $role,
        'userid' => $user,
        'vault_acc_code' => $vault_acc,
//        'vault_acc_name' => "vault_acc_name",
        'vault_acc_type' => $vault_type
    );
    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/cms_vault_permission");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);
    curl_close($ch);
    audit($_SESSION['userid'], "Admin added permission for user ($user) to have access to vault: ($vault_acc)", $_SESSION['branch']);
}

if(isset($_POST['revoke_permission'])) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/cms_vault_permission/".$_POST['id']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    curl_close($ch);

}

//function pastel_transaction($userName, $toAccount, $fromAccount, $reference, $amount, $transactionType, $description){
//
//    $data_array = array(
//        'userName' => $userName,
//        'toAccount' => $toAccount,
//        'fromAccount' => $fromAccount,
//        'reference' => $reference,
//        'amount' => $amount,
//        'transactionType' => $transactionType,
//        'description' => $description,
//        'currency' => '001',
//        'transactionDate' => date('Y-m-d'),
//        'exchangeRate' => '1'
//    );
//    $data = json_encode($data_array);
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/postGl/save");
//    curl_setopt($ch, CURLOPT_POST, true);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_HEADER, true );
//    $resp = curl_exec($ch);
//    curl_close($ch);
//    audit($_SESSION['userid'], "Created Pastel $description ", $_SESSION['branch']);
//}
//
//function pastel_acc_balances($account){
//
//    $data_array = array(
//        'account' => $account
//    );
//    $data = json_encode($data_array);
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/postGl/getVaultBalance");
//    curl_setopt($ch, CURLOPT_POST, true);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $resp = curl_exec($ch);
//    curl_close($ch);
//
//    // Return the response body without the headers
//    return $resp;
//}


function pastel_transaction($userName, $toAccount, $fromAccount, $reference, $amount, $transactionType, $description){

    $data_array = array(
        'aPIUsername' => "Admin",
        'aPIPassword' => "Admin",
        'toAccount' => $toAccount,
        'fromAccount' => $fromAccount,
        'reference' => $reference,
        'amount' => $amount,
        'transactionType' => $transactionType,
        'description' => $description,
        'currency' => '001',
        'transactionDate' => date('Y-m-d'),
        'exchangeRate' => '1'
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/postGl/save");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);
    curl_close($ch);
    audit($_SESSION['userid'], "Created Pastel $description ", $_SESSION['branch']);
}

function pastel_acc_balances($accounts){

//    echo json_encode($accounts);

    $data = json_encode($accounts); // Only encode once
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/postGl/getAllPastelVaultBalances");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);
    if ($resp === false) {
        // Handle curl error
        $error = curl_error($ch);
        curl_close($ch);
        return "Curl error: " . $error;
    } else {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
//        echo "before if ".$http_code;
        if ($http_code >= 200 && $http_code < 300) {
            // HTTP status code indicates success
//            echo "qwertyuiop - ".$http_code;
            return $resp;
        } else {
            // HTTP status code indicates error
            return "HTTP Error: " . $http_code;
        }
    }
}


if (isset($_POST['cms_transact'])){
    $ToAccount = $_POST['ToAccount'];
    $FromAccount = $_POST['FromAccount'];
    $Reference = $_POST['Reference'];
    $Amount = $_POST['Amount'];
    $TransactionType = "CAS-TRN";
    $Description = $_POST['Description'];

    pastel_transaction($ToAccount, $FromAccount, $Reference, $Amount, $TransactionType, $Description);
}

if(isset($_POST['create_vault'])){
    // API endpoint URL
    $url ="http://localhost:7878/api/utg/cms/vault/save";

    // Data to send in the POST request
    $postData = array(
        'account' => $_POST['account'],
        'name' => $_POST['name'],
        'code' => $_POST['code'],
        'type' => $_POST['type'],
        'branchId' => $_POST['branch'],
    );

    $data = json_encode($postData);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );

    // Execute the POST request and store the response in a variable
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);
    if($response){
        echo '<script>window.location.href = "cash_management.php?menu=main&tabId=vaults";</script>';
    }
}


if (isset($_POST['update_vault'])) {
    // API endpoint URL
    $url = "http://localhost:7878/api/utg/cms/vault/update";
    // Data to send in the POST request
    $postData = array(
        'id' => $_POST['id'],
        'account' => $_POST['account'],
        'name' => $_POST['vaultName'],
        'type' => $_POST['type'],
        'code' => $_POST['code'],
        'branchId' => $_POST['branch'],
    );

    $data = json_encode($postData);
    echo $data;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

    // Execute the POST request and store the response in a variable
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }
    // Close cURL session
    curl_close($ch);


}

if(isset($_POST['create_withdrawal_purpose'])){
    // API endpoint URL
    $url ="http://localhost:7878/api/utg/cms/transaction-purpose/save";

    // Data to send in the POST request
    $postData = array(
        'name' => $_POST['name'],
    );

    $data = json_encode($postData);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );

    // Execute the POST request and store the response in a variable
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);
    if($response){
        echo '<script>window.location.href = "cash_management.php?menu=main";</script>';
    }
}

function vaults($get) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/vault/get/$get");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $vaults = json_decode($server_response, true);
    return $vaults;
}

function cash_receipts() {
    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/cash_receipts");
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/musoni_pastel");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $cash_receipts = json_decode($server_response, true);
    return $cash_receipts;
}

//===============================Start CMS Controller==========================================================================================
function getTransactionVoucher($transactionId){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/cms/transaction-voucher/'.$transactionId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $transaction_response = curl_exec($ch);
    curl_close($ch);

    return json_decode($transaction_response, true);
}

function getVaults($userId){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/cms/cms_vault_permission/user/'.$userId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $vault_response = curl_exec($ch);
    curl_close($ch);

    return json_decode($vault_response, true);
}

function getVaultCode($vaultId){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/cms/vault/get/'.$vaultId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $vault_response = curl_exec($ch);
    curl_close($ch);

    return json_decode($vault_response, true);
}

function getWithdrawal(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/cms/transaction-purpose/all');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data_response = curl_exec($ch);
    curl_close($ch);

    return json_decode($data_response, true);
}

function deleteTransaction($id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/cms/transaction-voucher/delete/'.$id);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    curl_close($ch);
}

function cmsAuditTrail(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/audit_trail/all");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);

    curl_close($ch);
    return json_decode($server_response, true);

}

//===============================End CMS Controller ==========================================================================================

//===============================START PURCHASEggggg ORDER ==========================================================================================

if(isset($_POST['add_trans_voucher'])) {
    $url = "http://localhost:7878/api/utg/cms/transaction-voucher/initiate";

    $data_array = array(
        'initiator' => $_POST['initiator'],
        'applicationDate' => date('Y-m-d', strtotime($_POST['applicationDate'])),
        'currency' => $_POST['currency'],
        'amount' => $_POST['amount'],
        'fromVault' => $_POST['fromVault'],
        'vaultCode' => $_POST['vaultCode'],
        'toVault' => $_POST['toVault'],
        'amountInWords' => $_POST['amountInWords'],
        'withdrawalPurpose' => $_POST['withdrawalPurpose'],
        'firstApprover' => $_POST['firstApprover'],
        'secondApprover' => $_POST['secondApprover'],
        'denomination100' => $_POST['denomination100'],
        'denomination50' => $_POST['denomination50'],
        'denomination20' => $_POST['denomination20'],
        'denomination10' => $_POST['denomination10'],
        'denomination5' => $_POST['denomination5'],
        'denomination2' => $_POST['denomination2'],
        'denomination1' => $_POST['denomination1'],
        'denominationCents' => $_POST['denominationCents'],
        'totalDenominations' => $_POST['totalDenominations']
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);

    // convert headers to array
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:
                $_SESSION['info'] = "Transaction Voucher created Successfully";
                audit($_SESSION['userid'], "Transaction Voucher created Successfully", $_SESSION['branch']);
                header('location: cash_management.php?menu=main');
                break;
            default:
                $_SESSION['error'] = 'Failed to create Transaction.';
                audit($_SESSION['userid'], "Failed to create Transaction Voucher", $_SESSION['branch']);
                header('location: cash_management.php?menu=main');
        }
    } else {
        $_SESSION['error'] = 'Failed to Add Transaction Voucher.. Please try again!';
        audit($_SESSION['userid'], "Failed to create Transaction Voucher", $_SESSION['branch']);
        header('location: cash_management.php?menu=main');
    }
    curl_close($ch);

}

if(isset($_POST['first_approve_trans'])) {
    $url = "http://localhost:7878/api/utg/cms/transaction-voucher/first-approve";
    $data_array = array(
        'id' => $_POST['trans_id'],
        'approvalStatus' => $_POST['approvalStatus'],
        'comment' => $_POST['comment']
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);

    // convert headers to array
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:
                $_SESSION['info'] = "Transaction Voucher approved Successfully";
                audit($_SESSION['userid'], "Transaction Voucher approved Successfully", $_SESSION['branch']);
                header('location: cash_management.php?menu=main#approved');
                break;
            default:
                $_SESSION['error'] = 'Failed to approved PO Transaction.';
                audit($_SESSION['userid'], "Failed to approved Transaction Voucher", $_SESSION['branch']);
                header('location: cash_management.php?menu=main#approved');
        }
} else {
    $_SESSION['error'] = 'Failed to approved Transaction Voucher.. Please try again!';
    audit($_SESSION['userid'], "Failed to approved Transaction Voucher", $_SESSION['branch']);
    header('location: cash_management.php?menu=main#approved');
}
curl_close($ch);

}

if(isset($_POST['second_approve_trans'])) {
    // Collect form data and assign to variables
    $userName = $_POST['initiator'] ?? "";
    $toAccount = $_POST['toVaultAcc'] ?? "";
    $fromAccount = $_POST['fromVaultAcc'] ?? "";
    $reference = $_POST['trans_id'] ?? "";
    $amount = $_POST['amount'] ?? "";
    $transactionType = "CAS-TRN";
    $description = $_POST['withdrawalPurpose'] ?? "";

    $url = "http://localhost:7878/api/utg/cms/transaction-voucher/second-approve";
    $data_array = array(
        'id' => $_POST['trans_id'],
        'approvalStatus' => $_POST['approvalStatus'],
        'comment' => $_POST['comment']
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);

    // convert headers to array
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:
                $_SESSION['info'] = "Transaction Voucher approved Successfully";
                audit($_SESSION['userid'], "Transaction Voucher approved Successfully", $_SESSION['branch']);

                pastel_transaction($userName, $toAccount, $fromAccount, $reference, $amount, $transactionType, $description);

                header('location: cash_management.php?menu=main#approved');
                break;
            default:
                $_SESSION['error'] = 'Failed to approved PO Transaction.';
                audit($_SESSION['userid'], "Failed to approved Transaction Voucher", $_SESSION['branch']);
                header('location: cash_management.php?menu=main#approved');
        }
    } else {
        $_SESSION['error'] = 'Failed to approved Transaction Voucher.. Please try again!';
        audit($_SESSION['userid'], "Failed to approved Transaction Voucher", $_SESSION['branch']);
        header('location: cash_management.php?menu=main#approved');
    }
    curl_close($ch);

}

if(isset($_POST['second_revert_trans'])) {
    $url = "http://localhost:7878/api/utg/cms/transaction-voucher/second-approve";
    $data_array = array(
        'id' => $_POST['trans_id'],
        'approvalStatus' => $_POST['revertStatus'],
        'comment' => $_POST['comment']
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);

    // convert headers to array
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:
                $_SESSION['info'] = "Transaction Voucher approved Successfully";
                audit($_SESSION['userid'], "Transaction Voucher approved Successfully", $_SESSION['branch']);
                header('location: cash_management.php?menu=main#approved');
                break;
            default:
                $_SESSION['error'] = 'Failed to approved PO Transaction.';
                audit($_SESSION['userid'], "Failed to approved Transaction Voucher", $_SESSION['branch']);
                header('location: cash_management.php?menu=main#approved');
        }
    } else {
        $_SESSION['error'] = 'Failed to approved Transaction Voucher.. Please try again!';
        audit($_SESSION['userid'], "Failed to approved Transaction Voucher", $_SESSION['branch']);
        header('location: cash_management.php?menu=main#approved');
    }
    curl_close($ch);

}

function withdrawal_purposes($action) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/transaction-purpose/$action");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $vaults = json_decode($server_response, true);
    return $vaults;
}

function getVaultAccount($userId, $vaultAccType) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/cms_vault_permission/byUserIdAndVaultType/$userId/$vaultAccType");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $vaultAcc = json_decode($server_response, true);
    return $vaultAcc;
}

function getVaultAccountByType($vaultAccType) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/vault/get/byType/$vaultAccType");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $vaultAcc = json_decode($server_response, true);
    return $vaultAcc;
}
?>

