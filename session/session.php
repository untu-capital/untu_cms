<?php 
//  error_reporting(0);

require_once "controllerUserData.php"; 

$ch = curl_init();

$userid = $_SESSION['userid'];
// $userrole = $_SESSION['userid'];

if($userid == false){
    header('Location: ../login_signup/login.php');
}else{

    $url = "http://localhost:7878/api/utg/users/getUser/$userid";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $resp = curl_exec($ch);

    if($e = curl_error($ch)) {
    }
    else {
        $decoded = json_decode($resp, true);
        $_SESSION['userId'] = $decoded['id'];
        $_SESSION['email'] = $decoded['contactDetail']['emailAddress'];
        $_SESSION['username'] = $decoded['username'];
        $_SESSION['mobile'] = $decoded['contactDetail']['mobileNumber'];
        $_SESSION['branch'] = $decoded['branch'];
        $_SESSION['fullname'] =  $decoded['firstName'] ." ". $decoded['lastName'];
        $_SESSION['firstname'] = $decoded['firstName'];
        $_SESSION['lastname'] = $decoded['lastName'];
        $_SESSION['role'] = $decoded['roles'][0]['name'];
//        $_SESSION['cms_role'] = $decoded['roles'][0]['name'];
        $_SESSION['musoniClientId'] = $decoded['musoniClientId'];
        $_SESSION['cmsUser'] = $decoded['cmsUser'];

        $check_role = $_SESSION['role'];

        $_SESSION['audit'] = $audit;

        $board_limit = 20000;
        $credit_limit = 2000;
        $operations_limit = 8001;
                
    }
    curl_close($ch);
}

?>
 
