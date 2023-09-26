<!-- table widget -->

<?php 
//    TODO: change variables
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/credit_application_client_datasets/branchName/Harare");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_response = curl_exec($ch);

    curl_close($ch);

    $data = json_decode($server_response, true);

    $selectedRows = array();

    if (isset($_GET['update'])) {
      $checked = $_POST['check'];
       $_SESSION['checked'] = $checked ;

       print_r($checked);
      foreach($checked as $key=>$value)
      {
        echo $value;
        if($value=="on"){

          $seleceteRows[] = array(
            $value
          );
        }
        // <a href = "single_sms.php?userid=<?=$checked " style="color: red;">
        header("location:bulk_message.php?userid=$checked");
      }
    }


    if (isset($_POST['Submit'])) {
        $ch = curl_init();
        //error_reporting(0);
        $phoneNumber = $_POST['phoneNumber'];
        $message = $_POST['message'];
        curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/sms/single/0784315526/" . $message);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($server_response, true);
    }

?>
<div class="card-box mb-30">
	<div class="pd-20">
		<h4 class="text-blue h4">Old Customers</h4>
		<form action="bulk_message.php" method="get">
         <!-- <button type="submit" class="btn btn-danger btn-lg" name="update">Send Bulk SMS</button> -->
		</div>
	<div class="pb-20">



</script>
	<p id="phoneNumberDisplay"></p>
		<table class="data-table table stripe hover multiple-select-row nowrap">
			<thead>
				<tr>
				    <th>Select</th>
					<th >Full Name</th>
<!--					<th>Last Name</th>					-->
					<th>Contact No.</th>
					<th>Date Of Birth</th>						
					<th>Business Sector</th>
                    <th>Loan Amount</th>
                    <th>Loan Product</th>
                    <th>Branch</th>
                    <th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($data as $application):?>
				<tr>
				    <td> <input type="checkbox" class="checkbox" id="exampleCheck1" value="<?php echo $application ['phoneNumber']; ?>" name="check[]"></td>
					<td><?= htmlspecialchars ($application["firstName"]." ".$application["lastName"]) ?></td>
<!--                    <td>--><?php //= htmlspecialchars ($application["lastName"]) ?><!--</td>-->
					<td><?= htmlspecialchars ($application["phoneNumber"]) ?></td>
                    <td>
                        <?php
                        try {
                            $dateOfBirth = DateTime::createFromFormat('d/m/Y', $application["dateOfBirth"]);
                            if ($dateOfBirth instanceof DateTime) {
                                echo htmlspecialchars($dateOfBirth->format('d M Y'));
                            } else {
                                echo 'Invalid date';
                            }
                        } catch (Exception $e) {
                            echo 'Invalid date';
                        }
                        ?>
                    </td>
                    <td><?= htmlspecialchars ($application["businessSector"]) ?></td>
                    <td><?= htmlspecialchars ('$ ' . number_format($application["loanAmount"], 2, '.', ',')) ?></td>
                    <td><?= htmlspecialchars ($application["loanProduct"]) ?></td>
                    <td><?= htmlspecialchars ($application["branch"]) ?></td>
					<td>
						<div class="dropdown">
							<a
								class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
								<i class="dw dw-more"></i>
							</a>
							<div
								class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href="edit-clients-data.php?id=<?=$application["id"] ?>"
									><i class="dw dw-eye"></i> Edit</a>
								<a class="dropdown-item" href="view-dataset.php?id=<?=$application["id"] ?>"><i class="dw dw-edit2"></i> View</a>

								<!-- <a class="dropdown-item" href="#"
									><i class="dw dw-delete-3"></i> Close</a
								>
								<a class="dropdown-item" href="#"
									><i class="dw dw-delete-3"></i> Delete</a
								> -->
								<a class="dropdown-item" href="lead-management" href="#" data-backdrop="static" data-toggle="modal" data-target="#login-modal"><i class="dw dw-eye"></i> Send SMS</a>
							</div>
							</form>




							<div class="modal fade" id="login-modal"
									tabindex="-1" role="dialog"
									aria-labelledby="myLargeModalLabel"	aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div
												class="login-box bg-white box-shadow border-radius-10"
											>
												<div class="login-title">
													<h2 class="text-center text-primary">
														Sent a Message
													</h2>
												</div>
												<form action="" method="POST">
													<div class="select-role">
														<div
															class="btn-group btn-group-toggle"
															data-toggle="buttons"
														>
		
	
														</div>
													</div>

													<div class="tab-pane fade show active" id="client_details" role="tabpanel" aria-labelledby="client-details-tab">
                                            <a class="list-group-item"><b style="padding-right: 100px;">Fullname</b>: <?= $application["firstName"] ?> <?= $application["lastName"] ?></a>
                                            <a class="list-group-item"><b style="padding-right: 65px;">Business Sector</b>: <?= $application["businessSector"] ?></a>
                                            <a class="list-group-item"><b style="padding-right: 65px;">Phone Number</b>: <?= $application["phoneNumber"] ?></a>
                                            
                                            <a class="list-group-item"><b style="padding-right: 90px;">User Branch</b>: <?= $application["branch"] ?></a>
													</div>
													<div class="form-group">
												<label>Message :</label>
												<input class="form-control" type="hidden" name="phoneNumber" required value="<?php echo $application["phoneNumber"] ?>">
												
											         </div>
													 <textarea class="form-control"id= "message" name="message"></textarea>
													<div class="form-group"> </div>
													<div class="row pb-30">
														<div class="col-6">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" class="custom-control-input" id="customCheck1"/>
															</div>
														</div>
													
													</div>
													<div class="row">
													    <div class="col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-danger" value="Submit" name="Submit">Submit</button>
                                                           </div>
                                                        </div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
						</div>
					</td>
				</tr>
				<?php
			 endforeach;?>

            <button id="submitBtn" class="btn btn-danger btn-lg"> Send Bulk Message</button>

            <script>
                // JavaScript code to handle checkbox selection and form submission
                document.getElementById("submitBtn").addEventListener("click", function() {
                    var checkboxes = document.getElementsByClassName("checkbox");
                    var checkedArray = [];

                    // Loop through the checkboxes to find the checked ones
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].checked) {
                            checkedArray.push(checkboxes[i].value);
                        }
                    }

                    if (checkedArray.length > 0) {
                        // Convert the checkedArray to a string to pass as a query parameter
                        var queryString = "?phoneNumbers=" + checkedArray.join(",");

                        // Redirect to page2.php with the query string
                        window.location.href = "bulk_message.php" + queryString;
                    } else {
                        alert("No phone numbers were selected.");
                    }
                });
            </script>

			</tbody>
		</table>
	</div>
</div>
<p id="phoneNumberDisplay"></p>

<script>
  function showCheckedPhoneNumbers() {
    var checkboxes = document.getElementsByName("check[]");
    var checkedPhoneNumbers = [];

    checkboxes.forEach(function (checkbox) {
      if (checkbox.checked) {
        checkedPhoneNumbers.push(checkbox.value);
      }
    });

    var phoneNumberDisplay = document.getElementById("phoneNumberDisplay");
    phoneNumberDisplay.textContent = checkedPhoneNumbers.join(", ");
  }
</script>