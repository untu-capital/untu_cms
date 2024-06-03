<?php	
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/ClientFileUpload/get/'.$_GET['userid'].'/DELETED');
    // curl_setopt($ch, CURLOPT_URL, 'http://localhost:7878/api/utg/ClientFileUpload/get/61a98ded-d784-42ac-a88a-283cbba890cc');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);
    curl_close($ch);
    $client_file_uploads = json_decode($server_response, true);

    foreach($client_file_uploads as $application):
        
        $arr[] = '{imagePath:'.$application['fileName'].'}';

    endforeach;

    print(json_encode($client_file_uploads));

?>