<?php

function get_consumer_data(){
    $nationalId = "23037151F23";
    $ch = curl_init();

//    $url = "http://localhost:8100/xds/nationalId/" . urlencode($nationalId);
    $url = "http://localhost:8100/xds/nationalId/23037151F23";

    curl_setopt($ch, CURLOPT_URL, $url);
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

?>

<?php






//// Example usage
//$nationalId = "23037151F23"; // The national ID you want to query
//$consumerData = get_consumer_data($nationalId);
//
//// Debugging output (optional)
//echo "<pre>";
//print_r($consumerData);
//echo "</pre>";
//
//function saveConsumerData($nationalId){
//
//// URL to send the POST request to
//    $url = 'http://localhost:8100/xds/consumer?nationalId=' . $nationalId;
//
//// Data to send in the POST request
//    $data = array('nationalId' => $nationalId);
//
//// Initialize cURL
//    $ch = curl_init($url);
//
//// Set cURL options
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
//    curl_setopt($ch, CURLOPT_POST, true);           // Use POST method
//    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Set POST data
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // Set content type
//
//// Execute cURL request
//    $response = curl_exec($ch);
//
//// Check for errors
//    if (curl_errno($ch)) {
//        echo 'cURL error: ' . curl_error($ch);
//    } else {
//        // Display the response
//        echo 'Response: ' . $response;
//    }
//
//// Close cURL resource
//    curl_close($ch);
//
//
//}
//
//
//?>
