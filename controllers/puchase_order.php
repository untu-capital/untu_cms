<?php

function list_suppliers(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/supplier/all");
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


function list_categories(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/category/all");
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

function parameters(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/parameter/all");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($server_response, true);
    if ($data !== null) {
        return $data;
    } else {
        return null;
    }
}


function poBudget($path){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/budget".$path);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($server_response, true);
    if ($data !== null) {
        return $data;
    } else {
        return "Error decoding JSON data";
    }
}

if (isset($_POST['delete_budget'])){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/pos/budget/delete/'.$_POST['budgetId']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    curl_close($ch);
}


function list_department(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/department/all");
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











if(isset($_POST['update_po_budget'])){
    // API endpoint URL
    $url ="http://localhost:7878/api/utg/pos/budget/update";

    // Data to send in the POST request
    $postData = array(
        'id'=>  $_POST['budgetId'],
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
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

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

if(isset($_POST['update_po_role'])) {
    $user = $_POST['user'];
    $role = $_POST['role'];

    $data_array = array(
        'role' => $role
    );
    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/users/updatePoUserRole/".$user);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    curl_close($ch);

    audit($_SESSION['userid'], "Admin updated user ($user) Purchase Order Sys Role", $_SESSION['branch']);
}

if (isset($_GET['req_trans_id'])) {
    $req_trans_id = $_GET['req_trans_id'];
    $req_id = $_POST['req_id'];
    delete_po_transaction($req_trans_id);
    header('location: req_info.php?menu=req&req_id=' . $req_id);
}

function delete_po_transaction($req_trans_id, $req_id) {
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/poTransactions/deletePurchaseOrderTransaction/".$req_trans_id);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);

    // Execute cURL request
    $response = curl_exec($ch);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($response, 0, $headerSize);
    $bodyStr = substr($response, $headerSize);
    $headers = headersToArray($headerStr);

    // Check for errors and handle responses
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:
                $_SESSION['info'] = "Purchase Order Transaction deleted Successfully";
                audit($_SESSION['userid'], "Purchase Order Transaction deleted Successfully", $_SESSION['branch']);
                header('Location: req_info.php?menu=req&req_id=' .$req_id);
                break;
            default:
                $_SESSION['error'] = 'Failed to delete PO Transaction.';
                audit($_SESSION['userid'], "Failed to delete Purchase Order Transaction", $_SESSION['branch']);
                header("Location: req_info.php?menu=req&req_id=".$req_id);
        }
    } else {
        $_SESSION['error'] = 'Failed to delete Purchase Order Transaction.. Please try again!';
        audit($_SESSION['userid'], "Failed to delete Purchase Order Transaction", $_SESSION['branch']);
        header('Location: req_info.php?menu=req&req_id=' .$req_id);
    }

    // Close cURL connection
    curl_close($ch);
    header('Location: req_info.php?menu=req&req_id=' .$req_id);

}



