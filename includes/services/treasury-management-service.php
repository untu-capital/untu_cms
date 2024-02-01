<?php
//<==========START CUSTOMER SERVICE=========>

// CREATE CUSTOMER
if (isset($_POST['create_customer_info'])) {

    // API endpoint URL
    $url = "http://localhost:7878/api/utg/treasury_management/customer-info";

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
        'zwlBankName' => $_POST['zwlBankName'],
        'zwlBankBranch' => $_POST['zwlBankBranch'],
        'zwlBankAccountNumber' => $_POST['zwlBankAccountNumber'],
        'zwlSwiftCode' => $_POST['zwlSwiftCode'],
        'usdBankName' => $_POST['usdBankName'],
        'usdBankBranch' => $_POST['usdBankBranch'],
        'usdBankAccountNumber' => $_POST['usdBankAccountNumber'],
        'usdSwiftCode' => $_POST['usdSwiftCode']
    );

    $data = json_encode($postData);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);

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

// READ CUSTOMER
function getCustomerInfo($id)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/treasury_management/customer-info/' . $id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $transaction_response = curl_exec($ch);
    curl_close($ch);

    return json_decode($transaction_response, true);
}

// LIST CUSTOMERS
function listCustomerInfo()
{
    $url = "http://localhost:7878/api/utg/treasury_management/customer-info";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    return json_decode($server_response, true);
}

// UPDATE CUSTOMER
if (isset($_POST['update_customer_info'])) {

    // API endpoint URL
    $url = "http://localhost:7878/api/utg/treasury_management/customer-info";

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
        'zwlBankName' => $_POST['zwlBankName'],
        'zwlBankBranch' => $_POST['zwlBankBranch'],
        'zwlBankAccountNumber' => $_POST['zwlBankAccountNumber'],
        'zwlSwiftCode' => $_POST['zwlSwiftCode'],
        'usdBankName' => $_POST['usdBankName'],
        'usdBankBranch' => $_POST['usdBankBranch'],
        'usdBankAccountNumber' => $_POST['usdBankAccountNumber'],
        'usdSwiftCode' => $_POST['usdSwiftCode']
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
if ($_GET['menu'] == 'delete_customer'){ ?>

    <?php
    $id = $_GET['customerId'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/treasury_management/customer-info/". $id);
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
    ?>

<?php }

//<==========END CUSTOMER SERVICE=========>
?>