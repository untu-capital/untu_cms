<?php
include('../session/session.php');
include ('check_role.php');
include('../includes/controllers.php');
$nav_header = "User Details";

if(isset($_POST['updateUserRole'])) {
    $id = $_POST['userid'];
    $update_user_role =  $_POST['update_user_role'];

    $url = "http://localhost:7878/api/utg/users/updateUserRole/".$id;
    $data_array = array(
        "roles" => array (
            array("id" => $update_user_role)));

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // convert headers to array
    $headers = headersToArray( $headerStr );
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard
                $_SESSION['info'] = "Status updated successfully";
                header('location: user_info.php?userid='.$id);
                break;
            default:
                $_SESSION['error'] = 'Could not update Loan status '. "\n";
                header('location: user_info.php?userid='.$id);
        }
    } else {
        $_SESSION['error'] = 'Update Status failed.. Please try again!'. "\n";
        header('location: user_info.php?userid='.$id);

    }
    curl_close($ch);
}

if(isset($_POST['change_password'])) {
    $id = $_POST['userid'];
    $update_user_password =  $_POST['new_password'];

    $url = "http://localhost:7878/api/utg/users/updateUserPassword/$id";
    $data_array = array(
        'password' => $update_user_password
    );
    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);

    $resp = curl_exec($ch);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);
    // convert headers to array
    $headers = headersToArray( $headerStr );
    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard
                $_SESSION['info'] = "Password updated successfully";
                header('location: user_info.php?userid='.$id);
                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    echo $key . ': ' . $val . '<br>';}
                echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                header('location: user_info.php?userid='.$id);
                break;

            case 401: # Unauthorixed - Bad credientials
                $_SESSION['error'] = 'Update password failed';
                header('location: user_info.php?userid='.$id);

                break;
            default:
                $_SESSION['error'] = 'Could not update password '. "\n";
                header('location: user_info.php?userid='.$id);
        }
    } else {
        $_SESSION['error'] = 'Update password failed.. Please try again!'. "\n";
        header('location: user_info.php?userid='.$id);
    }
    curl_close($ch);
}

if(isset($_POST['delete'])) {
    $id = $_POST['userid'];
    $urlDelete = "http://localhost:7878/api/utg/users/deleteUser/".$id;
    $ch = curl_init($urlDelete);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE'); // curl_setopt($ch, CURLOPT_PUT, true); - for PUT
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'some_data');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
    $result = curl_exec($ch);

    header('location: tables.php');
    alert("Deleted Successfully");
}

if(isset($_POST['updateUserBranch'])) {
    // $assignTo = mysqli_real_escape_string($con, $_POST['assignTo']);
    $id = $_POST['userid'];
    $update_user_branch =  $_POST['update_user_branch'];

    $url = "http://localhost:7878/api/utg/users/updateUserBranch/".$id;

    $data_array = array(
        'branch' => $update_user_branch

    );
    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // convert headers to array
    $headers = headersToArray( $headerStr );

    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard

                $_SESSION['info'] = "User branch updated successfully";

                header('location: user_info.php?userid='.$id);
                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    echo $key . ': ' . $val . '<br>';
                }
                echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                header('location: user_info.php?userid='.$id);
                break;

            case 401: # Unauthorixed - Bad credientials
                $_SESSION['error'] = 'Update Status failed';
                header('location: user_info.php?userid='.$id);

                break;
            default:
                $_SESSION['error'] = 'Could not update user branch '. "\n";
                header('location: user_info.php?userid='.$id);
        }
    } else {
        $_SESSION['error'] = 'Update Status failed.. Please try again!'. "\n";
        header('location: user_info.php?userid='.$id);

    }
    curl_close($ch);
}

if(isset($_POST['creditCommitGroup'])) {
    $id = $_POST['userid'];
    $creditCommitGroup =  $_POST['credit_commit_group'];

    $url = "http://localhost:7878/api/utg/users/updateUserGroup/".$id;

    $data_array = array(
        'creditCommitGroup' => $creditCommitGroup
    );

    $data = json_encode($data_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // convert headers to array
    $headers = headersToArray( $headerStr );

    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard

                $_SESSION['info'] = "User group updated successfully";

                header('location: user_info.php?userid='.$id);
                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    echo $key . ': ' . $val . '<br>';
                }
                echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                header('location: user_info.php?userid='.$id);
                break;

            case 401: # Unauthorixed - Bad credientials
                $_SESSION['error'] = 'Update Status failed';
                header('location: user_info.php?userid='.$id);

                break;
            default:
                $_SESSION['error'] = 'Could not update user branch '. "\n";
                header('location: user_info.php?userid='.$id);
        }
    } else {
        $_SESSION['error'] = 'Update Status failed.. Please try again!'. "\n";
        header('location: user_info.php?userid='.$id);

    }
    curl_close($ch);
}


?>

<!DOCTYPE html>
<html>
<!-- HTML HEAD -->
<?php
include('../includes/header.php');
?>
<!-- /HTML HEAD -->
<body>

<!-- Top NavBar -->
<?php include('../includes/top-nav-bar.php'); ?>
<!-- Top NavBar -->

<?php include('../includes/right-sidebar.php'); ?>

<!-- sidebar-left -->
<?php include('../includes/side-bar.php'); ?>
<!-- /sidebar-left -->
<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="pd-ltr-20">

        <?php include('../includes/dashboard/topbar_widget.php'); ?>

        <?php include('../includes/forms/view_user_info.php'); ?>

        <?php include('../includes/footer.php');?>
    </div>
</div>

<!-- js -->
<script src="../vendors/scripts/core.js"></script>
<script src="../vendors/scripts/script.min.js"></script>
<script src="../vendors/scripts/process.js"></script>
<script src="../vendors/scripts/layout-settings.js"></script>
<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="../vendors/scripts/dashboard.js"></script>

<!-- buttons for Export datatable -->
<script src="../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="../src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="../src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="../src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="../src/plugins/datatables/js/pdfmake.min.js"></script>
<script src="../src/plugins/datatables/js/vfs_fonts.js"></script>
<!-- Datatable Setting js -->
<script src="../vendors/scripts/datatable-setting.js"></script>

<!-- Google Tag Manager (noscript) -->
<noscript
><iframe
            src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
            height="0"
            width="0"
            style="display: none; visibility: hidden"
    ></iframe
    ></noscript>
<!-- End Google Tag Manager (noscript) -->

</body>
</html>
