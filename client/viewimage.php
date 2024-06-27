<?php
include ('../constants/constants.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $server_ip_address.'/api/utg/ClientFileUpload/get/' . $userid);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);

    $client_file_uploads = json_decode($server_response, true);

    $result = array();
    foreach ($client_file_uploads as $application) {
        // Ensure 'fileName' and 'fileDescription' are not null
        if (isset($application['fileName']) && isset($application['fileDescription'])) {
            $result[] = array(
                'imagePath' => $application['fileName'],
                'fileDescription' => $application['fileDescription']
            );
        }
    }

    header('Content-Type: application/json');
    echo json_encode($result);
} else {
    echo json_encode(array('error' => 'User ID not provided'));
}
?>
