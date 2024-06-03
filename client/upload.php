<?php
if (isset($_GET['mediaUrl'])) {
    $mediaUrl = "https://www.uchat.com.au/media/whatsapp/312962595238468/437253872266931/1717410957730";
    $description = isset($_POST['name']) ? $_POST['name'] : 'No description';
    $userid = isset($_GET['userId']) ? $_GET['userId'] : 'No userId';

    // Fetch the image from the URL
    $imageContent = file_get_contents($mediaUrl);

    if ($imageContent !== false) {
        // Extract the file name from the URL
        $urlParts = explode('/', $mediaUrl);
        $originalFileName = end($urlParts);
        $temp = explode(".", $originalFileName);
        $newfilename = basename($originalFileName) . date('Y.m.d') . '.' . round(microtime(true)) . '.' . end($temp);

        // Save the image to the uploads folder
        $uploadPath = "../includes/file_uploads/clients/" . $newfilename;
        if (file_put_contents($uploadPath, $imageContent)) {
            // Prepare data for the API request
            $url = "http://localhost:7878/api/utg/ClientFileUpload/add";
            $data_array = array(
                'userId' => $userid,
                'fileName' => $newfilename,
                'fileType' => end($temp),
                'fileDescription' => $description,
                'fileDeleteStatus' => "AVAILABLE",
            );
            $data = json_encode($data_array);

            // Send data to the API endpoint
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $resp = curl_exec($ch);
            curl_close($ch);

            if ($resp) {
                echo "File uploaded and data sent to API successfully.";
            } else {
                echo "Failed to send data to API.";
            }
        } else {
            echo "Failed to save the file.";
        }
    } else {
        echo "Failed to fetch the image from the URL.";
    }
} else {
    echo "No media URL provided.";
}
?>
