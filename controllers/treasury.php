<!--################################################################################################################################################################-->

<!--###############  -------------------------------------------     TREASURY MANAGEMENT SYSTEM      -----------------------------------------  ####################-->

<!--################################################################################################################################################################-->


<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_POST['create_customer_info'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $phoneNumberOther = $_POST['phoneNumberOther'];
    $address = $_POST['address'];
    $contactPersonName = $_POST['contactPersonName'];
    $contactPersonJobTitle = $_POST['contactPersonJobTitle'];
    $contactPersonName2 = $_POST['contactPersonName2'];
    $contactPersonJobTitle2 = $_POST['contactPersonJobTitle2'];
    $BankName = $_POST['BankName'];
    $BankBranch = $_POST['BankBranch'];
    $BankAccountNumber = $_POST['BankAccountNumber'];
    $SwiftCode = $_POST['SwiftCode'];
    $currency = $_POST['currency'];
    $BankName2 = $_POST['BankName2'];
    $BankBranch2 = $_POST['BankBranch2'];
    $BankAccountNumber2 = $_POST['BankAccountNumber2'];
    $SwiftCode2 = $_POST['SwiftCode2'];
    $currency2 = $_POST['currency2'];

    $data_array = array(
        'name' => $name,
        'email' => $email,
        'phoneNumber' => $phoneNumber,
        'phoneNumberOther' => $phoneNumberOther,
        'address' => $address,
        'contactPersonName' => $contactPersonName,
        'contactPersonJobTitle' => $contactPersonJobTitle,
        'contactPersonName2' => $contactPersonName2,
        'contactPersonJobTitle2' => $contactPersonJobTitle2,
        'bankingDetails' => [
            [
                'bankName' => $BankName,
                'bankBranch' => $BankBranch,
                'bankAccountNumber' => $BankAccountNumber,
                'swiftCode' => $SwiftCode,
                'currency' => $currency
            ],
            [
                'bankName' => $BankName2,
                'bankBranch' => $BankBranch2,
                'bankAccountNumber' => $BankAccountNumber2,
                'swiftCode' => $SwiftCode2,
                'currency' => $currency2
            ]
        ]
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7272/api/treasury/customer-info/create");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // convert headers to array
    $headers = headersToArray($headerStr);

    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard
                $_SESSION['info'] = "Customer Successfully created";
                audit($_SESSION['userid'], "Customer Info Successfully Created", $_SESSION['branch']);
                break;
            default:
                $_SESSION['error'] = 'Could not create Customer';
                audit($_SESSION['userid'], "Could not create Customer", $_SESSION['branch']);
        }
    } else {
        $_SESSION['error'] = 'Could not create Customer info' . "\n";
        audit($_SESSION['userid'], "Could not create Customer info", $_SESSION['branch']);
    }
    curl_close($ch);
}



function customer_list(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:7272/api/treasury/customer-info');
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

    function customer_info($id)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:7272/api/treasury/customer-info/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $transaction_response = curl_exec($ch);
        curl_close($ch);

        return json_decode($transaction_response, true);
    }

    // UPDATE CUSTOMER
    if (isset($_POST['update_customer_info'])) {

        // API endpoint URL
        $url = "http://localhost:7272/api/treasury/customer-info";

        // Data to send in the POST request
        $postData = array(
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phoneNumber' => $_POST['phoneNumber'],
            'phoneNumberOther' => $_POST['phoneNumberOther'],
            'address' => $_POST['address'],
            'contactPersonName' => $_POST['contactPersonName'],
            'contactPersonJobTitle' => $_POST['contactPersonJobTitle'],
            'BankName' => $_POST['BankName'],
            'BankBranch' => $_POST['BankBranch'],
            'BankAccountNumber' => $_POST['BankAccountNumber'],
            'SwiftCode' => $_POST['SwiftCode']
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
        if ($response) {
            echo '<script>window.location.href = "treasury_management.php?menu=main";</script>';
        }
    }

    // DELETE CUSTOMER
    if ($_GET['menu'] == 'delete_customer'){
        $id = $_GET['customerId'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost:7272/api/treasury/customer-info/". $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

        $server_response = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($server_response, true);

        if ($data !== null) {
            $table = $data;

        } else {
            echo '<script>window.location.href = "treasury_management.php?menu=main";</script>';
            echo "Error decoding JSON data";
        }
    }

function parseDate($dateStr, $format = 'd F Y') {
    if (empty($dateStr)) {
        error_log("Date string is empty.");
        return null;
    }
    $date = DateTime::createFromFormat($format, $dateStr);
    if ($date === false) {
        error_log("Date parsing failed for date: $dateStr with format: $format");
    }
    return $date ? $date->format('Y-m-d') : null;
}

if(isset($_POST['create_liability'])) {
    echo "Form is submitted<br>";

    // Collect form data and assign to variables
    $counterparty = $_POST['counterparty'] ?? "";
    $liability = $_POST['liability'] ?? "";
    $pa_status = $_POST['pa_status'] ?? "";
    $start_date = parseDate($_POST['start_date'] ?? "");
    $currency = $_POST['currency'] ?? "";
    $amount = $_POST['amount'] ?? "";
    $tenure = $_POST['tenure'] ?? "";
    $interest_rate = $_POST['interest_rate'] ?? "";

    $interest_frequency = $_POST['interest_frequency'] ?? "";
    $revolving = $_POST['revolving'] ?? "";
    $principal_repayment = $_POST['principal_repayment'] ?? "";
    $interest_repayment = $_POST['interest_repayment'] ?? "";
    $repayment_date = parseDate($_POST['repayment_date'] ?? "");
    $maturity_date = parseDate($_POST['maturity_date'] ?? "");
    $other_features = $_POST['other_features'] ?? "";

    echo "Data collected:<br>";
    echo "Counterparty: $counterparty<br>";
    echo "Liability: $liability<br>";
    echo "PA Status: $pa_status<br>";
    echo "Start Date: $start_date<br>";
    echo "Currency: $currency<br>";
    echo "Amount: $amount<br>";
    echo "Tenure: $tenure<br>";
    echo "Interest Rate: $interest_rate<br>";
    echo "Interest Frequency: $interest_frequency<br>";
    echo "Revolving: $revolving<br>";
    echo "Principal Repayment: $principal_repayment<br>";
    echo "Interest Repayment: $interest_repayment<br>";
    echo "Repayment Date: $repayment_date<br>";
    echo "Maturity Date: $maturity_date<br>";
    echo "Other Features: $other_features<br>";

    $url = "http://localhost:7272/api/treasury/liabilities/saveLiability";

    $data_array = array(
        'counterpart' => $counterparty,
        'liabilityType' => $liability,
        'paStatus' => $pa_status,
        'startDate' => $start_date,
        'currencyDenomination' => $currency,
        'investedAmount' => $amount,
        'tenorInDays' => $tenure,
        'interest' => $interest_rate,
        'interestFrequency' => $interest_frequency,
        'revolving' => $revolving,
        'principalRepaymentType' => $principal_repayment,
        'interestRepaymentType' => $interest_repayment,
        'repaymentDates' => $repayment_date,
        'maturityDate' => $maturity_date,
        'otherFeatures' => $other_features
    );

    echo "Data array created: <pre>" . print_r($data_array, true) . "</pre>";

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);

    if ($resp === false) {
        echo 'cURL error: ' . curl_error($ch);
        exit();
    }

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "HTTP Code: $http_code<br>";
    echo "Response Body: $bodyStr<br>";

    if ($http_code == 200) {
        $_SESSION['info'] = "Deal Note Created Successfully";
        audit($_SESSION['userid'], "Deal Note Created Successfully", $_SESSION['branch']);
    } else {
        $_SESSION['error'] = 'Failed to Create Deal Note';
        audit($_SESSION['userid'], "Failed to Create Deal Note", $_SESSION['branch']);
    }
    header('location: treasury_management.php?menu=main');
    exit();
}
echo "Debugging end";


function liabilities_list(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:7272/api/treasury/liabilities');
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

    function liability_by_id($id){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:7272/api/treasury/liabilities/'.$id);
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

    if (isset($_POST['create_deal_note'])) {

        $dnId = $_POST['liabilities'] ?? "";


        $url = "http://localhost:7272/api/treasury/dealnote/create";
        $data_array = array(
            'id' => $dnId,
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
                    $_SESSION['info'] = "Deal NOte Created Successfully";
                    audit($_SESSION['userid'], "Deal NOte Created Successfully", $_SESSION['branch']);

                    header('location: treasury_management.php?menu=main');
                    break;
                default:
                    $_SESSION['error'] = 'Failed to Create Deal NOte';
                    audit($_SESSION['userid'], "Failed to Create Deal NOte", $_SESSION['branch']);
                    header('location: treasury_management.php?menu=main');
            }
        } else {
            $_SESSION['error'] = 'Failed to Create Deal NOte.. Please try again!';
            audit($_SESSION['userid'], "Failed to approved Transaction Voucher", $_SESSION['branch']);
            header('location: treasury_management.php?menu=main');
        }
        curl_close($ch);
    }

//####################################### ----------------  START DEAL NOTES    -------------------- ########################################

function deal_notes(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7272/api/treasury/dealnote');
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

function deal_note($id)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7272/api/treasury/dealnote/' . $id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $transaction_response = curl_exec($ch);
    curl_close($ch);

    return json_decode($transaction_response, true);
}

function note_investment_statement($id){
    $dealNote = deal_note($id);

    $data = json_encode($dealNote);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7272/api/treasury/note_investment_statement");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);
    $error = curl_error($ch); // Added to capture any CURL errors
    curl_close($ch);

    if ($resp === false) {
        echo "CURL Error: " . $error; // Output any CURL errors
        return;
    }

    // Find the position of the first occurrence of "\r\n\r\n"
    $headerEnd = strpos($resp, "\r\n\r\n");

    // Extract the JSON content from the response body
    $jsonContent = substr($resp, $headerEnd + 4);

    $note_investment_statement = json_decode($jsonContent, true);

    if ($note_investment_statement !== null) {
        return $note_investment_statement;
    } else {
        echo "Error decoding JSON data";
        // Optionally, output the response body for debugging purposes
        echo "Response Body: " . $jsonContent;
    }
}




//####################################### ----------------  START DEAL NOTES    -------------------- ########################################

//####################################### ----------------  START DEAL NOTES    -------------------- ########################################


if(isset($_POST['create_asset'])) {

    $counterparty = $_POST['counterparty'] ?? "";
    $asset = $_POST['asset'] ?? "";
    $pa_status = $_POST['pa_status'] ?? "";
    $start_date = DateTime::createFromFormat('d F Y', $_POST['start_date'] ?? "")->format('Y-m-d') ?? null;
    $currency = $_POST['currency'] ?? "";
    $amount = $_POST['amount'] ?? "";
    $tenure = $_POST['tenure'] ?? "";
    $interest_rate = $_POST['interest_rate'] ?? "";

    $interest_frequency = $_POST['interest_frequency'] ?? "";
    $revolving = $_POST['revolving'] ?? "";
    $principal_repayment = $_POST['principal_repayment'] ?? "";
    $interest_repayment = $_POST['interest_repayment'] ?? "";
    $repayment_date = DateTime::createFromFormat('d F Y', $_POST['repayment_date'] ?? "")->format('Y-m-d') ?? null;
    $maturity_date = DateTime::createFromFormat('d F Y', $_POST['maturity_date'] ?? "")->format('Y-m-d') ?? null;
    $other_features = $_POST['other_features'] ?? "";

    $url = "http://localhost:7272/api/treasury/assets/saveAsset";

    $data_array = array(
        'counterpart' => $counterparty,
        'assetType' => $asset,
        'paStatus' => $pa_status,
        'startDate' => $start_date,
        'currencyDenomination' => $currency,
        'investedAmount' => $amount,
        'tenorInDays' => $tenure,
        'interest' => $interest_rate,

        'interestFrequency' => $interest_frequency,
        'revolving' => $revolving,
        'principalRepaymentType' => $principal_repayment,
        'interestRepaymentType' => $interest_repayment,
        'repaymentDates' => $repayment_date,
        'maturityDate' => $maturity_date,
        'otherFeatures' => $other_features
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
                $_SESSION['info'] = "Asset Created Successfully";
                audit($_SESSION['userid'], "Asset Created Successfully", $_SESSION['branch']);

                header('location: treasury_management.php?menu=main');
                break;
            default:
                $_SESSION['error'] = 'Failed to Create Asset';
                audit($_SESSION['userid'], "Failed to Create Asset", $_SESSION['branch']);
                header('location: treasury_management.php?menu=main');
        }
    } else {
        $_SESSION['error'] = 'Failed to Create Asset.. Please try again!';
        audit($_SESSION['userid'], "Failed to create Asset", $_SESSION['branch']);
        header('location: treasury_management.php?menu=main');
    }
    curl_close($ch);
}

function asset_list(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7272/api/treasury/assets/getAllAssets');
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

function asset_by_id($id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7272/api/treasury/assets/getAsset/'.$id);
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

if (isset($_POST['create_asset_deal_note'])) {

    $dnId = $_POST['liabilities'] ?? "";

    $url = "http://localhost:7272/api/treasury/assetDealnote/create";
    $data_array = array(
        'id' => $dnId,
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
                $_SESSION['info'] = "Deal NOte Created Successfully";
                audit($_SESSION['userid'], "Deal NOte Created Successfully", $_SESSION['branch']);

                header('location: treasury_management.php?menu=main');
                break;
            default:
                $_SESSION['error'] = 'Failed to Create Deal NOte';
                audit($_SESSION['userid'], "Failed to Create Deal NOte", $_SESSION['branch']);
                header('location: treasury_management.php?menu=main');
        }
    } else {
        $_SESSION['error'] = 'Failed to Create Deal NOte.. Please try again!';
        audit($_SESSION['userid'], "Failed to approved Transaction Voucher", $_SESSION['branch']);
        header('location: treasury_management.php?menu=main');
    }
    curl_close($ch);
}

function asset_deal_notes(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7272/api/treasury/assetDealnote');
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

function asset_deal_note($id)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7272/api/treasury/assetDealnote/' . $id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $transaction_response = curl_exec($ch);
    curl_close($ch);

    return json_decode($transaction_response, true);
}

function asset_note_investment_statement($id){

    $dealNote = asset_deal_note($id);

    $data = json_encode($dealNote);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7272/api/treasury/assetNoteInvestment/createNoteInvestment");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);
    $error = curl_error($ch); // Added to capture any CURL errors
    curl_close($ch);

    if ($resp === false) {
        echo "CURL Error: " . $error; // Output any CURL errors
        return;
    }

    // Find the position of the first occurrence of "\r\n\r\n"
    $headerEnd = strpos($resp, "\r\n\r\n");

    // Extract the JSON content from the response body
    $jsonContent = substr($resp, $headerEnd + 4);

    $note_investment_statement = json_decode($jsonContent, true);

    if ($note_investment_statement !== null) {
        return $note_investment_statement;
    } else {
        echo "Error decoding JSON data";
        // Optionally, output the response body for debugging purposes
        echo "Response Body: " . $jsonContent;
    }
}





//####################################### ----------------  EQUITIES    -------------------- ########################################

//####################################### ----------------  EQUITIES    -------------------- ########################################




function equities(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7272/api/treasury/equities/all');
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

function equity_by_id($id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7272/api/treasury/equities/id/'.$id);
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

if(isset($_POST['create_equity'])) {

    $counterpart = $_POST['counterpart'] ?? "";
    $agent = $_POST['agent'] ?? "";
    $currency = $_POST['currency'] ?? "";
    $numberOfShares = $_POST['numberOfShares'] ?? "";
    $pricePerShare = $_POST['pricePerShare'] ?? "";
    $transactionCosts = $_POST['transactionCosts'] ?? "";
    $dateOfAcquisition = $_POST['dateOfAcquisition'] ?? "";

    $url = "http://localhost:7272/api/treasury/equities/add";

    $data_array = array(
        'counterpart' => $counterpart,
        'agent' => $agent,
        'currency' => $currency,
        'numberOfShares' => $numberOfShares,
        'pricePerShare' => $pricePerShare,
        'transactionCosts' => $transactionCosts,
        'dateOfAcquisition' => $dateOfAcquisition
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
            case 200 :
                $_SESSION['info'] = "Equity Created Successfully";
//                audit($_SESSION['userid'], " Created Equity Successfully", $_SESSION['branch']);

                header('Location: special_assets_tracker.php?menu=main');
                break;
            default:
                $_SESSION['error'] = 'Failed to Create Equity';
                audit($_SESSION['userid'], "Failed to Create Equity", $_SESSION['branch']);
                header('Location: special_assets_tracker.php?menu=add_equity');
        }
    } else {
        $_SESSION['error'] = 'Failed to Create Equity.. Please try again!';
        audit($_SESSION['userid'], "Failed to create Equity", $_SESSION['branch']);
        header('Location: special_assets_tracker.php?menu=add_equity');
    }
    curl_close($ch);
}


if(isset($_POST['create_cash_bank_bal'])) {
    $source = $_POST['source'] ?? "";
    $bankAccount = $_POST['bankAccount'] ?? "";
    $balance = $_POST['balance'] ?? "";
    $attachment = $_FILES['attachment'] ?? null;

    $attachmentFiles = array();
    // Check if files were uploaded
    if(isset($_FILES['attachment'])) {
        // Loop through the uploaded files
        foreach ($_FILES['attachment']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['attachment']['name'][$key];
            $file_tmp = $_FILES['attachment']['tmp_name'][$key];

            // Check if a file was uploaded successfully
            if ($file_name != "") {
                $temp = explode(".", $file_name);
                $attachment = pathinfo($file_name, PATHINFO_FILENAME) . '_' . date('Y.m.d') . '.' . end($temp);
                $uploadfile = '../includes/file_uploads/treasury/' . $attachment;

                // Move the uploaded file to the destination folder
                if (move_uploaded_file($file_tmp, $uploadfile)) {
                    $attachmentFiles[] = $uploadfile;
                }
            }
        }
    }

    $url = "http://localhost:7272/api/treasury/assets/balances/createBank"; // Assuming this is the URL for adding new customer information

    $data_array = array(
        'source' => $source,
        'bankAccount' => $bankAccount,
        'balance' => $balance,
        'attachment' => $attachmentFiles
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);

    // Check for errors
    if(curl_errno($ch)) {
        $_SESSION['error'] = 'Failed to create bank information. Please try again!';
    } else {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code == 200) {
            $_SESSION['info'] = "Bank information created successfully";
            audit($_SESSION['userid'], " Created Bank Balance Successfully", $_SESSION['branch']);
            header('Location: special_assets_tracker.php?menu=main');
        } else {
            $_SESSION['error'] = 'Failed to create bank information';
        }
    }

    curl_close($ch);
}


// ##############################################             MANAGE BANK            ##################################

// ##############################################             MANAGE BANK            ##################################



if(isset($_POST['create_bank_info'])) {
    $bankName = $_POST['bankName'] ?? "";
    $accountNumber = $_POST['accountNumber'] ?? "";
    $branchName = $_POST['branchName'] ?? ""; // Assuming you want to include branchName
    $currency = $_POST['currency'] ?? "";
    $source = $_POST['source'] ?? "";
    $balance = $_POST['balance'] ?? "";
    $code = $_POST['code'] ?? ""; // Assuming you want to include code
    $files = $_POST['attachment'] ?? ""; // Assuming you want to include files

    $attachmentFile = ''; // Initialize variable to store file path

    // Check if a file was uploaded
    if(isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['attachment']['name'];
        $file_tmp = $_FILES['attachment']['tmp_name'];

        // Check if a file was uploaded successfully
        if ($file_name != "") {
            $temp = explode(".", $file_name);
            $attachment = pathinfo($file_name, PATHINFO_FILENAME) . '_' . date('Y.m.d') . '.' . end($temp);
            $attachmentFile = '../includes/file_uploads/treasury/' . $attachment; // Store the file path

            // Move the uploaded file to the destination folder
            if (move_uploaded_file($file_tmp, $attachmentFile)) {
                // File moved successfully
            } else {
                // File upload failed
                $_SESSION['error'] = 'Failed to move uploaded file';
                // Other error handling if needed
            }
        }
    }


    $url = "http://localhost:7272/api/treasury/assets/balances/createBank"; // Assuming this is the URL for adding new bank information

    $data_array = array(
        'bankName' => $bankName,
        'accountNumber' => $accountNumber,
        'branchName' => $branchName,
        'currency' => $currency,
        'source' => $source,
        'balance' => $balance,
        'code' => $code,
        'files' => $attachmentFile // Include file path in the data array
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

    // Convert headers to array
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200 :
                $_SESSION['info'] = "Bank information created successfully";
                audit($_SESSION['userid'], " Created Bank Balance Successfully", $_SESSION['branch']);
                header('Location: special_assets_tracker.php?menu=main');
                // Other logic here if needed
                break;
            default:
                $_SESSION['error'] = 'Failed to create bank information';
            // Other logic here if needed
        }
    } else {
        $_SESSION['error'] = 'Failed to create bank information. Please try again!';
        // Other logic here if needed
    }
    curl_close($ch);
}


if(isset($_POST['update_bank_info'])) {
    $id = $_POST['id'] ?? "";
    $bankName = $_POST['bankName'] ?? "";
    $currency = $_POST['currency'] ?? "";
    $balance = $_POST['balance'] ?? "";
    $source = $_POST['source'] ?? "";
    $files = $_POST['files'] ?? "";

    // Assuming the URL for updating data is different from the URL for creating
    $url = "http://localhost:7272/api/treasury/assets/balances/updateBankBalances";

    // Constructing the data array
    $data_array = array(
        'id' => $id,
        'bankName' => $bankName,
        'currency' => $currency,
        'balance' => $balance,
        'source' => $source,
        'files' => $files
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Change request type to PUT
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);

    // Convert headers to array
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200 :
                $_SESSION['info'] = "Bank information updated successfully";
                // Other logic here if needed
                break;
            default:
                $_SESSION['error'] = 'Failed to update bank information';
            // Other logic here if needed
        }
    } else {
        $_SESSION['error'] = 'Failed to update bank information. Please try again!';
        // Other logic here if needed
    }
    curl_close($ch);
}

function bank_list(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7272/api/treasury/assets/balances');
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

function bank_info($id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7272/api/treasury/assets/balances/getById/'.$id);
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


function delete_bank($id){

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7272/api/utg/treasury/assets/balances/" . $id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

    // Execute cURL request
    $server_response = curl_exec($ch);

    // Close cURL session
    curl_close($ch);

    // Check if there was an error in the cURL request
    if ($server_response === false) {
        echo "Error occurred during cURL request: " . curl_error($ch);
        return; // Exit function if there's an error
    }

    // Decode the JSON response
    $data = json_decode($server_response, true);

    // Check if JSON decoding was successful
    if ($data !== null) {
        // Handle the data as needed (e.g., display or process)
        // For example, you might redirect the user to a different page
        echo "Bank deleted successfully.";
        // You may add more actions here, such as redirecting the user
    } else {
        // Handle JSON decoding error
        echo "Error decoding JSON data";
        // Redirect the user to a different page
        echo '<script>window.location.href = "special_assets_tracker.php?menu=main";</script>';
    }
}



?>