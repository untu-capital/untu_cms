<?php
    include('../session/session.php');
include ('check_role.php');
    include('charts_data.php');
    include ('../includes/controllers.php');
    $nav_header = "Loan Applications";
?>
<!DOCTYPE html>
<html>
<!-- HTML HEAD -->
<?php
include('../includes/header.php');
?>
	<!-- HTML HEAD -->
	<?php
        $resp = "";
		if (isset($_POST['Upload'])) {
			if(isset($_FILES['file']['name'])){
				$uploadfile = '../includes/file_uploads/clients/'.basename($_FILES['file']['name']);
				$description = $_POST['description'];
				//move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
				$temp = explode(".", $_FILES["file"]["name"]);
				$newfilename = basename($_FILES['file']['name']).date('Y.m.d').'.'.round(microtime(true)). '.' . end($temp) ;
				if(move_uploaded_file($_FILES["file"]["tmp_name"], "../includes/file_uploads/clients/" . $newfilename)){
					$url = "http://localhost:7878/api/utg/ClientFileUpload/add";
				$data_array = array(
					'userId' => $_SESSION['userId'],
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
				curl_close($ch);
				}
			}
		}
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

                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4">My KYC Documents</h4>
                        </div>
                    </div>


                    <div class="row">
                        <?php
                        $client_file_uploads = client_file_uploads($_SESSION['userId']);
                        foreach ($client_file_uploads as $application):
                            ?>

                            <div class="col-lg-3 col-md-4 col-sm-12 mb-20">
                                <div class="card card-box">
                                    <?php
                                    $fileName = $application['fileName'];
                                    $lastFourLetters = substr($fileName, -4);
                                    $isImage = ($lastFourLetters === ".jpg" || $lastFourLetters === ".png" || $lastFourLetters === ".svg" || $lastFourLetters === "jpeg");
                                    $isVideo = ($lastFourLetters === ".mp4" || $lastFourLetters === ".mov" || $lastFourLetters === ".avi");
                                    ?>

                                    <?php if ($isImage): ?>
                                        <img src="../includes/file_uploads/clients/<?php echo htmlspecialchars($fileName); ?>" class="card-img-top" alt="Default Image" onerror="this.src='../vendors/images/modal-img1.jpg';" style="height: 200px;">
                                    <?php elseif ($isVideo): ?>
                                        <video style="height: 200px; width: 100%; display: block;" src="../includes/file_uploads/clients/<?php echo $fileName; ?>" controls></video>
                                    <?php else: ?>
                                        <img src="../vendors/images/modal-img1.jpg" class="card-img-top" alt="Default Image" style="height: 200px;">
                                    <?php endif; ?>

                                    <div class="card-body">
                                        <h5 class="card-title weight-500">
                                            <a name="downloadfile" download="<?php echo htmlspecialchars($application['fileName']) ?>" href="../includes/file_uploads/clients/<?php echo htmlspecialchars($application['fileName']) ?>" style="color: black;">Download</a>
                                        </h5>
                                        <p class="card-text"><?php echo htmlspecialchars($application['fileDescription']) ?></p>
                                        <!--                                        <a name="downloadfile" class="btn btn-primary" download="--><?php //echo htmlspecialchars($application['fileName']) ?><!--" href="../includes/file_uploads/clients/--><?php //echo htmlspecialchars($application['fileName']) ?><!--">Download</a>-->
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="pd-20 card-box mb-30">
						<div class="clearfix mb-20">
							<div class="pull-left">
								<h3 class="text-blue h4">Upload KYC Documents</h3>
								<p></p>
								<ul>
                                    <h6>Please make sure the following Documents are uploaded : </h6>
                                    <li>Clear picture of National ID </li>
                                    <li>Business registration forms / License of operation </li>
                                    <li>Detailed images of the business (including fixed assets)</li>
                                    <li>Videos showing around the premises</li>
                                </ul>
							</div>
							
						</div>
						<form action="" enctype="multipart/form-data" method="post">
							<div class="form-group">
								<label>Upload KYC Document </label>
                                <input type="file" class="form-control-file form-control height-auto" name="file" id="file" required/>
							</div>

                            <div class="form-group">
                                <label>Document Description</label>
                                <input class="form-control" type="text" name="description" id="description" placeholder="Document Description" required>
                            </div>

							<div class="fallback">
							<label class="col-sm-12 col-md-2 col-form-label"></label>
							<div class="col-sm-12 col-md-10">
							<button  type="submit" class="btn btn-danger" value="Upload" name="Upload" >Submit KYC Document</button>

							</div>
						</form>
					</div>
				</div>

				<?php include('../includes/footer.php');?>
			</div>


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
