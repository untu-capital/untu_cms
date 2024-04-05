<!--################################################################################################################################################################-->

<!--###############  -------------------------------------------     TREASURY MANAGEMENT SYSTEM      -----------------------------------------  ####################-->

<!--################################################################################################################################################################-->


<?php
if(isset($_POST['create_customer_info'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $phoneNumberOther = $_POST['phoneNumberOther'];
    $address = $_POST['address'];
    $contactPersonName = $_POST['contactPersonName'];
    $contactPersonJobTitle = $_POST['contactPersonJobTitle'];
    $BankName = $_POST['BankName'];
    $BankBranch = $_POST['BankBranch'];
    $BankAccountNumber = $_POST['BankAccountNumber'];
    $SwiftCode = $_POST['SwiftCode'];
    $currency = $_POST['currency'];

    $data_array = array(
        'name' => $name,
        'email' => $email,
        'phoneNumber' => $phoneNumber,
        'phoneNumberOther' => $phoneNumberOther,
        'address' => $address,
        'contactPersonName' => $contactPersonName,
        'contactPersonJobTitle' => $contactPersonJobTitle,
        'bankName' => $BankName,
        'bankBranch' => $BankBranch,
        'bankAccountNumber' => $BankAccountNumber,
        'swiftCode' => $SwiftCode,
        'currency' => $currency
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7272/api/treasury/customer-info/create");
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
                $_SESSION['info'] = "Customer Successfully created";
                audit($_SESSION['userid'], "Customer Info Successfully Created", $_SESSION['branch']);
                break;
            default:
                $_SESSION['error'] = 'Could not create Customer';
                audit($_SESSION['userid'], "Could not create Customer", $_SESSION['branch']);
        }
    }
    else {
        $_SESSION['error'] = 'Could not create Customer info'. "\n";
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


    if(isset($_POST['create_liability'])) {

        // Collect form data and assign to variables
        $counterparty = $_POST['counterparty'] ?? "";
        $liability = $_POST['liability'] ?? "";
        $pa_status = $_POST['pa_status'] ?? "";
        $start_date = date('Y-m-d', $_POST['start_date'] ?? "");
        $currency = $_POST['currency'] ?? "";
        $amount = $_POST['amount'] ?? "";
        $tenure = $_POST['tenure'] ?? "";
        $interest_rate = $_POST['interest_rate'] ?? "";

        $interest_frequency = $_POST['interest_frequency'] ?? "";
        $revolving = $_POST['revolving'] ?? "";
        $principal_repayment = $_POST['principal_repayment'] ?? "";
        $interest_repayment = $_POST['interest_repayment'] ?? "";
        $repayment_date = date('Y-m-d', $_POST['repayment_date'] ?? "");
        $maturity_date = date('Y-m-d', $_POST['maturity_date'] ?? "");
        $principal_at = $_POST['principal_at'] ?? "";
        $other_features = $_POST['other_features'] ?? "";

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
            'principalAt' => $principal_at,
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
            'counterParty' => $dnId,
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

?>