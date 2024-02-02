

<?php
session_start();

// Check if last activity was set
if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > 1800) {
    session_unset(); // unset $_SESSION variable
    session_destroy(); // destroy session data in storage
    header("Location: login.php"); // redirect to login page
}
$_SESSION['last_activity'] = time(); // update last activity time stamp


// require "connection.php";
$audit = "";
$errors = array();

function session($val){
    $ch = curl_init();

    // $userid = $_SESSION['userid'];

    if($val == false){
        header('Location: login.php');
    }else{

        $url = "http://localhost:7878/api/utg/users/$val";

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
            $_SESSION['role'] = $decoded['roles'][0]['name'];
            $_SESSION['branch'] = $decoded['branch'];
            $_SESSION['fullname'] =  $decoded['firstName'] ." ". $decoded['lastName'];

        }

        curl_close($ch);
    }
}

function audits($userid, $activity, $branch) {
    $data_array = array(
        'userid'=> $userid,
        'branch'=> $branch,
        'role'=> $_SESSION['role'],
        'activity'=> $activity,
        'deviceInfo'=> $_SERVER['HTTP_USER_AGENT'],
        'ipAddress'=> $_SERVER['REMOTE_ADDR']
    );
    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/access_logs");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);
    curl_close($ch);

//    return "Log recorded successfully";
}
//#################------------------------------    HTPP registration function: -----------------------------#####################//

function curlreg($firstname, $lastname, $username, $email, $mobile, $password) {
    // $_SESSION['info'] = "";
    // $_SESSION['error'] = "";

    $url = "http://localhost:7878/api/utg/auth/signup";
    $firstname = trim($firstname);
    $lastname = trim($lastname);
    $email = trim($email);
    // $username = trim($username);

    $data_array = array(
        'firstName' => $firstname,
        'lastName' => $lastname,
        'username' => $username,
        'email' => $email,
        'mobileNumber' => $mobile,
        'password' => $password,
        'role' => "false"
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

    // how big are the headers
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // convert headers to array
    $headers = headersToArray( $headerStr );

    // echo "CUSTOM_HEADER: ".$headers['CUSTOM_HEADER']."<br>";
    // echo "API_REQUEST_COUNTER: ".$headers['API_REQUEST_COUNTER']."<br>";
    // echo "API_REQUEST_LIMIT: ".$headers['API_REQUEST_LIMIT']."<br>";

    // Check HTTP status code
    if (!curl_errno($ch)) {
        // $_SESSION['info'] = "";
        // $_SESSION['error'] = "";
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
        case 201:  # OK redirect to dashboard
            $decoded = json_decode($bodyStr);
            foreach($decoded as $key => $val) {
            echo $key . ': ' . $val . '<br>';
         }
            // echo $val;
            $_SESSION['info'] = $val.", We've sent a verification code to the phone number you provided.";
            audits($_SESSION['userid'], "User Registration Successful", $_SESSION['branch']);
            header('location: ../login_signup/login.php');
        break;
        case 400:  # Bad Request
            $decoded = json_decode($bodyStr);
            foreach($decoded as $key => $val) {
            //echo $key . ': ' . $val . '<br>';
         }
        $_SESSION['errors'] = $val;
            audits($_SESSION['userid'], "User Registration Failed", $_SESSION['branch']);
        header('location: ../login_signup/register.php');

        break;

        case 401: # Unauthorixed - Bad credientials
            $_SESSION['error'] = 'Registration failed.. Please try again!';
            audits($_SESSION['userid'], "User Registration Failed", $_SESSION['branch']);
             header('location: ../login_signup/register.php');

        break;
        default:
            $decoded = json_decode($bodyStr);
            // foreach($decoded as $key => $val) {
            // echo $key . ': ' . $val . '<br>';
            // }
        $_SESSION['error'] = 'Unexpected error, Please try again '. "\n";
            audits($_SESSION['userid'], "User Registration Failed", $_SESSION['branch']);
        // header('location: login.php#signup');
        }
    } else {
        $_SESSION['error'] = 'Login Failed'. "\n";
        audits($_SESSION['userid'], "User Registration Failed", $_SESSION['branch']);
        // header('location: login.php#signup');

    }
    curl_close($ch);
}

    function headersToArray($str)
    {
        $headers = array();
        $headersTmpArray = explode( "\r\n" , $str );
        for ( $i = 0 ; $i < count( $headersTmpArray ) ; ++$i )
        {
            // we dont care about the two \r\n lines at the end of the headers
            if ( strlen( $headersTmpArray[$i] ) > 0 )
            {
                // the headers start with HTTP status codes, which do not contain a colon so we can filter them out too
                if ( strpos( $headersTmpArray[$i] , ":" ) )
                {
                    $headerName = substr( $headersTmpArray[$i] , 0 , strpos( $headersTmpArray[$i] , ":" ) );
                    $headerValue = substr( $headersTmpArray[$i] , strpos( $headersTmpArray[$i] , ":" )+1 );
                    $headers[$headerName] = $headerValue;
                }
            }
        }
        return $headers;
    }
//}

//#################------------------------------    HTTP login function: -----------------------------#####################//

function curllogin($email, $password) {

    $url = "http://localhost:7878/api/utg/auth/login";
    $email = trim($email);

    $data_array = array(
        'username' => $email,
        'password' => $password
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

    // how big are the headers
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // convert headers to array
    $headers = headersToArray( $headerStr );

    // Check HTTP status code
    if (!curl_errno($ch)) {

        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
        case 200:  # OK redirect to dashboard
            $decoded = json_decode($bodyStr);
            foreach($decoded as $key => $val) {
                //echo $key . ': ' . $val . '<br>';}
                $_SESSION['userid'] = $val;
            }
            session($val);

            audits($_SESSION['userid'], "User Login Successful", $_SESSION['branch']);

            // $_SESSION['info'] = " Login Successful";

            if ($_SESSION['role'] == 'ROLE_CLIENT'){
               header('location: ../client/index.php?state=all');
            }
            elseif($_SESSION['role'] == 'ROLE_BOCO'){
                header('location: ../boco/index.php');
            }
            elseif($_SESSION['role'] == 'ROLE_BM'){
                header('location: ../bm/index.php');
            }
            elseif($_SESSION['role'] == 'ROLE_LO'){
                header('location: ../loan_officer/index.php');
            }
            elseif($_SESSION['role'] == 'ROLE_ADMIN'){
                header('location: ../admin/index.php');

            }
            elseif($_SESSION['role'] == 'ROLE_CA'){
                header('location: ../credit/index.php');
            }
            elseif($_SESSION['role'] == 'ROLE_CM'){
                header('location: ../cm/index.php');
            }
            elseif($_SESSION['role'] == 'ROLE_FIN'){
                header('location: ../finance/index.php');
            }
            elseif($_SESSION['role'] == 'ROLE_BOARD'){
                header('location: ../board/index.php');
            }
            elseif($_SESSION['role'] == 'ROLE_AUDIT'){
                header('location: ../audit/index.php');
            }
            elseif($_SESSION['role'] == 'ROLE_OP'){
                header('location: ../operations/index.php');
            }else{
                header('location: ../login_signup/login.php');
            }

        break;
        case 401: # Unauthorixed - Bad credientials
            // $decoded = json_decode($bodyStr);
            // foreach($decoded as $key => $val) {
            //     //echo $key . ': ' . $val . '<br>';
            // }
            $_SESSION['error'] = 'Please input correct password or username';
            audits($_SESSION['userid'], "User Login Failed", $_SESSION['branch']);
            header('location: ../login_signup/login.php');
        break;
        case 422: # Unauthorixed - Bad credientials
            $decoded = json_decode($bodyStr);
            foreach($decoded as $key => $val) {
               //echo $key . ': ' . $val . '<br>';
           }
        // $_SESSION['error'] = 'Please input correct password or username';
            // header('location: login.php');
           $_SESSION['error'] = ' Please enter OTP sent to your phone number to verify your account';
            audits($_SESSION['userid'], "User Login Failed", $_SESSION['branch']);
            header('location: ../login_signup/login.php');
        break;
        default:
            $_SESSION['error'] = 'Unexpected error, Please retry '. "\n";
            audits($_SESSION['userid'], "User Login Failed", $_SESSION['branch']);
            header('location: ../login_signup/login.php');
    }
    } else {
            $_SESSION['error'] = 'Login Failed '. "\n";
        audits($_SESSION['userid'], "User Login Failed", $_SESSION['branch']);
            header('location: ../login_signup/login.php');
      }
    curl_close($ch);
}

//#################------------------------------    HTTP confirm-code function: -----------------------------#####################//
function curlconfirm($otp_code, $username) {

    // $verificationCode = '1087418666';
    // $username = 'Ronaldchiweshe';
    // $_SESSION['info'] = "";
   $urls = "http://localhost:7878/api/utg/auth/confirm_account?code=" . $otp_code . "&username=" . $username;

   $url = str_replace(" ","%20",$urls);

   $ch = curl_init();

   $data = json_encode((object) null);

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_HEADER, true );

   $resp = curl_exec($ch);

   // how big are the headers
   $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
   $headerStr = substr($resp, 0, $headerSize);
   $bodyStr = substr($resp, $headerSize);

   // convert headers to array
   $headers = headersToArray( $headerStr );

   // Check HTTP status code
   if (!curl_errno($ch)) {

       switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
       case 200:  # OK redirect to dashboard
           $decoded = json_decode($bodyStr);
           foreach($decoded as $key => $val) {
               //echo $key . ': ' . $val . '<br>';
           }
           $_SESSION['info'] = $val." - You can now Login";
           audits($_SESSION['userid'], "User Confirmation Successful", $_SESSION['branch']);
           header('location: login.php');
       break;
       case 400: # Unauthorixed - Bad credientials
            $decoded = json_decode($bodyStr);
           foreach($decoded as $key => $val) {
               //echo $key . ': ' . $val . '<br>';
           }
           $_SESSION['error'] = $val;
           audits($_SESSION['userid'], "User Confirmation Failed", $_SESSION['branch']);
           //header('location: user-otp.php#signup');
       break;
       case 404: # Unauthorixed - Bad credientials
            $decoded = json_decode($bodyStr);
           foreach($decoded as $key => $val) {
            //    echo $key . ': ' . $val . '<br>';
           }
           $_SESSION['error'] = $val;
           audits($_SESSION['userid'], "User Confirmation Failed", $_SESSION['branch']);
           //header('location: user-otp.php#signup');
       break;
       default:
           $_SESSION['error'] = 'Unexpected error '. "\n";
           audits($_SESSION['userid'], "User Confirmation Failed", $_SESSION['branch']);
           //header('location: user-otp.php#signup');
   }
   } else {
           $_SESSION['error'] = 'Confirmation Failed'. "\n";
       audits($_SESSION['userid'], "User Confirmation Failed", $_SESSION['branch']);
           header('location: user-otp.php#signup');
     }
   curl_close($ch);
}

//#################------------------------------    HTTP check-mail function: -----------------------------#####################//

function curlcheck_mobile($mobile){
    $url = "http://localhost:7878/api/utg/auth/check_mobile?mobile=" . $mobile ;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );
    $resp = curl_exec($ch);

    // how big are the headers
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // convert headers to array
    $headers = headersToArray( $headerStr );
    // echo $bodyStr;

    // Check HTTP status code
    if (!curl_errno($ch)) {

        $decoded = json_decode($bodyStr);
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
        case 200:  # OK redirect to dashboard

        // SEND AFORGOT PASSWORD RESET HERE!!!

        curlsend_mail($mobile);

        // $_SESSION['info'] = "We've sent a verification code to the email you provideds : $email";
        // header('location: reset-code.php');
        break;
        case 400: # Unauthorixed - Bad credientials
        $errorMsg = 'Error occured';
           // $_SESSION['error'] = "Invalid email address";
            foreach($decoded as $key => $val) {
                //echo $key . ': ' . $val . '<br>';

                if ($key == 'message') {
                   $errorMsg = $val;
                }
            }
           $_SESSION['error'] = $errorMsg;
            //header('location: login.php');
        break;
        default:
            $_SESSION['error'] = 'Unexpected Error occured';
            //header('location: login.php');
    }
    } else {
            $_SESSION['error'] = 'Reset Password Failed' . "\n";
            //header('location: login.php');
      }
    curl_close($ch);
}


//#################------------------------------    HTTP send-mail function: -----------------------------#####################//

function curlsend_mail($mobile) {

   // $email = 'randakelvin@gmail.com';

    $url = "http://localhost:7878/api/utg/auth/forgot_password_mobile?mobile=".$mobile;

    $ch = curl_init();

   $data = json_encode((object) null);

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_HEADER, true );

   $resp = curl_exec($ch);

   // how big are the headers
   $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
   $headerStr = substr($resp, 0, $headerSize);
   $bodyStr = substr($resp, $headerSize);

   // convert headers to array
   $headers = headersToArray( $headerStr );

   // Check HTTP status code
   if (!curl_errno($ch)) {

    switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {

        case 200:  # OK redirect to dashboard
        $decoded = json_decode($bodyStr);
           foreach($decoded as $key => $val) {
            //    echo $key . ': ' . $val . '<br>';
           }
        //    $_SESSION['info'] = $val;
            $_SESSION['info'] = "We've sent a verification code to the mobile number you provided : $mobile";
            header('location: new-password.php');
        break;

        case 400: # Unauthorixed - Bad credientials
            $decoded = json_decode($bodyStr);
            foreach($decoded as $key => $val) {
            //echo $key . ': ' . $val . '<br>';
        }
            $_SESSION['error'] = $val;
            //header('location: user-otp.php#signup');
       break;

       default:
           $_SESSION['error'] = 'Unexpected error '. "\n";
           //header('location: user-otp.php#signup');
   }
   } else {
           $_SESSION['error'] = 'Sending email Failed - '. $http_code. "\n";
           // header('location: user-otp.php#signup');
     }
   curl_close($ch);
}

//#################------------------------------ HTTP reset-password function: -----------------------------#####################//

function curlreset($token, $password){
    // $url = "http://localhost:7878/api/utg/auth/reset_password?token=".$token;

    // $token = 'gWGPXlKSZ3tzgV1UZL3WNXvddkcuTg';
    // $password = 'randakelvin@gmail.com';

    $url = "http://localhost:7878/api/utg/auth/reset_password?token=" . $token . "&password=" . $password;

    $data_array = array(
        'token' => $token,
        'password' => $password
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

    // how big are the headers
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // convert headers to array
    $headers = headersToArray( $headerStr );
    // echo $bodyStr;

    // Check HTTP status code
    if (!curl_errno($ch)) {

        $decoded = json_decode($bodyStr);
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
        case 200:  # OK redirect to dashboard
            // $decoded = json_decode($bodyStr);
            // foreach($decoded as $key => $val) {
            //     echo $key . ': ' . $val . '<br>';
            // }
            $_SESSION['info'] = "Your password has been reset.. You can now login ";
            audits($_SESSION['userid'], "Password Reset Successful", $_SESSION['branch']);
            header('location: login.php');
        break;
        case 400: # Unauthorixed - Bad credientials
            foreach($decoded as $key => $val) {
                // echo $key . ': ' . $val . '<br>';
            }
            $_SESSION['error'] = "Password Reset failed.. Try again!";
            audits($_SESSION['userid'], "Password Reset Failed", $_SESSION['branch']);
            header('location: login.php?token='.$val);
        break;
        default:
            $_SESSION['error'] = 'Unexpected Error occured : '. "\n";
            audits($_SESSION['userid'], "Password Reset Failed", $_SESSION['branch']);
            //header('location: login.php');
    }
    } else {
            $_SESSION['error'] = 'Reset Password Failed' . "\n";
        audits($_SESSION['userid'], "Password Reset Failed", $_SESSION['branch']);
            //header('location: login.php');
      }
    curl_close($ch);
}

//#################------------------------------ HTTP function: -----------------------------#####################//

    //if user signup button
    if(isset($_POST['signup'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        // $email = $_POST['email'];
        $email = isset($_POST['email']) ? $_POST['email'] : "credit.application@untucapital.co.zw";
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }

        // Send HTTP REQUEST TO BACKEND
        curlreg($firstname, $lastname, $username, $email, $mobile, $password);

        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['username'] = $username;
        // header('location: user-otp.php');
        exit();

    }

    //if user click verification code submit button
    if(isset($_POST['check'])){
        //$_SESSION['info'] = "";
        $otp_code = $_POST['otp'];
        $username = $_POST['username'];
        //$username = $_GET['userid'];

        // Send HTTP REQUEST TO BACKEND
        curlconfirm($otp_code, $username);

    }



    //if user click login button
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        // Send HTTP REQUEST TO BACKEND
        curllogin($email, $password);
    }


    //if user click continue button in forgot password form
    if(isset($_POST['check-mobile-number'])){
        $mobile = $_POST['mobile'];
        $_SESSION['mobile'] = $mobile;
        curlcheck_mobile($mobile);
    }


    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = $_POST['otp'];
        $email = $_SESSION['email'];
    }


    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $token = $_POST['token'];
        if($password !== $cpassword){
            echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Confirm password not matched!.. Please make sure your passwords match');
                        window.location.href='new-password.php?token=$token';
                    </script>");
            ?>
            <?php
            // header('location: new-password.php?token='.$token);
        }else{

            // getting this token using session
            curlreset($token, $password);

        }
    }

?>