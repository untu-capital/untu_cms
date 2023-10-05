<?php

//
//if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
//    $id = $_POST['id'];
//
//    // Initialize cURL session
//    $curl = curl_init();
//
//    // Set cURL options
//    curl_setopt($curl, CURLOPT_URL, 'http://localhost:7878/api/utg/branches/deleteBranch/' . $id); // Replace with the actual API endpoint
//    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE'); // Use DELETE method
//    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//
//    // Execute cURL request
//    $response = curl_exec($curl);
//
//    // Check for errors and handle the response
//    if ($response === 'success') {
//        // Record deleted successfully
//        echo 'success';
//    } else {
//        // Failed to delete the record
//        echo 'error';
//    }
//
//    // Close cURL session
//    curl_close($curl);
//} else {
//    // Invalid request
//    echo 'invalid_request';
//}
//
//
//<?php
//print_r($_POST['id']);
//
if(isset($_POST['delete'])) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/branches/deleteBranch/".$_POST['id']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        // Redirect to cashi_management.php
        header('Location: cash_management.php?menu=main&success=1');
        exit; // Make sure to exit to prevent further execution
    } else {
        echo 'DELETE request failed with HTTP code ' . $httpCode;
    }

}

if(isset($_POST['deleteAuth'])) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/cms_authorisation/".$_POST['id']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 204) {
        // Redirect to cashi_management.php
        header('Location: cash_management.php?menu=main&success=1');
        exit; // Make sure to exit to prevent further execution
    } else {
        echo 'DELETE request failed with HTTP code ' . $httpCode;
    }

}
?>