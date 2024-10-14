<?php
include ('../constants/constants.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']['name'])) {
        // Use forward slashes or double backslashes for Windows paths
        $uploadDir = '..\\includes\\file_uploads\\clients\\';
        $description = $_POST['name'];
        $userid = $_POST['userId'];

        // Ensure upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $temp = explode(".", $_FILES["file"]["name"]);
        $newfilename = basename($_FILES['file']['name']) . date('Y.m.d') . '.' . round(microtime(true)) . '.' . end($temp);
        $uploadfile = $uploadDir . $newfilename;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadfile)) {
            $url = $server_ip_address . "/api/utg/ClientFileUpload/add";
            $data_array = array(
                'userId' => $userid,
                'fileName' => $newfilename,
                'fileType' => end($temp),
                'fileDescription' => $description,
                'fileDeleteStatus' => "AVAILABLE",
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
            curl_close($ch);

            if ($resp) {
                echo "File uploaded and data saved successfully.";
            } else {
                echo "File uploaded but data not saved.";
            }
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "No file uploaded.";
    }
} else {
    echo "Invalid request method.";
}


//	 if (isset($_POST['Upload'])) {
//         if(isset($_FILES['file']['name'])){
//            $uploadfile = '../includes/file_uploads/clients/'.basename($_FILES['file']['name']);
//            $description = $_POST['name'];
//            $userid = $_POST['userId'];
//            //move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
//            $temp = explode(".", $_FILES["file"]["name"]);
//            $newfilename = basename($_FILES['file']['name']).date('Y.m.d').'.'.round(microtime(true)). '.' . end($temp) ;
//            if(move_uploaded_file($_FILES["file"]["tmp_name"], "../includes/file_uploads/clients/" . $newfilename)){
//                $url = $server_ip_address."/api/utg/ClientFileUpload/add";
//            $data_array = array(
//                'userId' => $userid,
//                'fileName' => $newfilename,
//                'fileType'=> end($temp),
//                'fileDescription' => $description,
//                'fileDeleteStatus' => "AVAILABLE",
//            );
//            $data = json_encode($data_array);
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL, $url);
//            curl_setopt($ch, CURLOPT_POST, true);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_HEADER, true );
//            $resp = curl_exec($ch);
//            curl_close($ch);
//
//            }
//         }
//     }

	// $db = mysqli_connect('localhost','root','','userdata');
	// if (!$db) {
	// 	echo "Database connection faild";
	// }

	// $image = $_FILES['file']['name'];
	// $name = $_POST['name'];

	// $imagePath = 'uploads/'.$image;
	// $tmp_name = $_FILES['file']['tmp_name'];

	// move_uploaded_file($tmp_name, $imagePath);
	// $db->query("INSERT INTO person(name,image)VALUES('".$name."','".$image."')");


?>