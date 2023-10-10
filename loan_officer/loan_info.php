<?php
	include('../session/session.php');
	include('../includes/controllers.php');
	$nav_header = "Application Details";

    if(isset($_POST['assign_lo'])) {
        $assignTo =  $_POST['assignTo'];
        $assignedBy = $_SESSION['userId'];
        $loanId = $_POST['loanId'];
        $userId =  $_POST['userId'];
        $additional_remarks =  $_POST['additional_remarks'];
        $processLoanStatus = "uncompleted";
        $bmDateAssignLo = date("Y-m-d H:i:s");
        $pipelineStatus = "bm_assign_loan";

        assign_lo($assignTo, $assignedBy, $loanId, $userId, $additional_remarks, $processLoanStatus, $bmDateAssignLo, $pipelineStatus);
    }
?>

<?php
$resp = "";
if (isset($_POST['UploadAppraisal'])) {

    $id = $_POST["loan_id"];
    $userId = $_POST['userid'];

    $appraisal_files = appraisal_files($id);
    if($appraisal_files[0]['fileName'] ==""){
        if(isset($_FILES['file']['name'])){
            $uploadfile = '../includes/file_uploads/loan_officers/'.basename($_FILES['file']['name']);
            $description ='Assessment-File';
            //move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
            $temp = explode(".", $_FILES["file"]["name"]);
            $newfilename = basename($_FILES['file']['name']).date('Y.m.d').'.'.round(microtime(true)). '.' . end($temp) ;
            if(move_uploaded_file($_FILES["file"]["tmp_name"], "../includes/file_uploads/loan_officers/" . $newfilename)){
                $url = "http://localhost:7878/api/utg/appraisalFileUpload/save";
                $data_array = array(
                    'loanId'=> $id,
                    'userId' => $userId,
                    'fileName' => $newfilename,
                    'fileType'=> end($temp),
                    'fileDescription' => $description,
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

                $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                $headerStr = substr($resp, 0, $headerSize);
                $bodyStr = substr($resp, $headerSize);

                // convert headers to array
                $headers = headersToArray( $headerStr );

                if (!curl_errno($ch)) {
                    switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                        case 200:  # OK redirect to dashboard
                            header('location:loan_info.php?menu=loan&loan_id='.$id.'&userid='.$userId);
                            break;
                        default:
                            $_SESSION['error'] = 'Could not Upload file '. "\n";
                            header('location:loan_info.php?menu=loan&loan_id='.$id.'&userid='.$userId);
                    }
                } else {
                    $_SESSION['error'] = 'Update Status failed.. Please try again!'. "\n";
                    header('location:loan_info.php?menu=loan&loan_id='.$id.'&userid='.$userId);
                }
                curl_close($ch);
            }
        }
    } elseif ($appraisal_files[0]['fileName'] <>""){
        if(isset($_FILES['file']['name'])){
            $uploadfile = '../includes/file_uploads/loan_officers/'.basename($_FILES['file']['name']);
            $description ='Assessment-File';
            //move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
            $temp = explode(".", $_FILES["file"]["name"]);
            $newfilename = basename($_FILES['file']['name']).date('Y.m.d').'.'.round(microtime(true)). '.' . end($temp) ;
            if(move_uploaded_file($_FILES["file"]["tmp_name"], "../includes/file_uploads/loan_officers/" . $newfilename)){
                $url = "http://localhost:7878/api/utg/appraisalFileUpload/update/$id";
                $data_array = array(
                    'loanId'=> $id,
                    'userId' => $userId,
                    'fileName' => $newfilename,
                    'fileType'=> end($temp),
                    'fileDescription' => $description,
                );

                $data = json_encode($data_array);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
//                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true );
                $resp = curl_exec($ch);

                $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                $headerStr = substr($resp, 0, $headerSize);
                $bodyStr = substr($resp, $headerSize);

                // convert headers to array
                $headers = headersToArray( $headerStr );

                if (!curl_errno($ch)) {
                    switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                        case 200:  # OK redirect to dashboard
                            header('location:loan_info.php?menu=loan&loan_id='.$id.'&userid='.$userId);
                            break;
                        default:
                            $_SESSION['error'] = 'Could not Upload file '. "\n";
                            header('location:loan_info.php?menu=loan&loan_id='.$id.'&userid='.$userId);
                    }
                } else {
                    $_SESSION['error'] = 'Update Status failed.. Please try again!'. "\n";
                    header('location:loan_info.php?menu=loan&loan_id='.$id.'&userid='.$userId);

                }
                curl_close($ch);

            }
        }
    }
}
?>

<?php
if (isset($_POST['loanOfficerUploads'])) {
    $id = $_POST['loan_id'];
    $userId = $_POST['userid'];

    if(isset($_FILES['file']['name'])){
        $fileCount = count($_FILES['file']['name']); // Count of uploaded files

        for ($i = 0; $i < $fileCount; $i++) {
            $uploadfile = '../includes/file_uploads/loan_officers/' . basename($_FILES['file']['name'][$i]);
            $description = 'Assessment-File';

            $temp = explode(".", $_FILES["file"]["name"][$i]);
            $newfilename = basename($_FILES['file']['name'][$i]) . date('Y.m.d') . '.' . round(microtime(true)) . '.' . end($temp);

            if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], "../includes/file_uploads/loan_officers/" . $newfilename)) {
                $url = "http://localhost:7878/api/utg/assessmentFileUpload/add";
                $data_array = array(
                    'loanId' => $id,
                    'userId' => $userId,
                    'fileName' => $newfilename,
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
            }
        }

        header('location:loan_info.php?menu=loan&loan_id=' . $id . '&userid=' . $userId);
    }
}

?>

<?php
if(isset($_POST['markAsDone'])){
    $id = $_POST['loan_id'];
    $userId = $_POST['userid'];
    $assessment_status = $_POST['completed'];
    $fullName = $_POST['fullName'];
    $loDate = date("Y-m-d H:i:s");
    $pipelineStatus = "loan_officer_check_loan";


    updateLoanAssessmentStatus($id, $assessment_status, $fullName, $loDate, $pipelineStatus, $userId);
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

                <?php include('../includes/forms/view_loan_info.php'); ?>

                <?php include('../includes/tables/track_loans_progress_table.php'); ?>

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
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
	</body>
</html>
