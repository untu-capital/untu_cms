<?php
    include('../session/session.php');
    include ('check_role.php');
    include('../includes/controllers.php');
include('../controllers/puchase_order.php');
    $state = $_GET['state'];
    $nav_header = "Requisitions";

    $url ='';
    if ($state == 'progress'){$url = '/loanStatus/ACCEPTED';}
    elseif($state == 'reject'){$url = '/loanStatus/REJECTED';}
    else {$url;}
    $requisitionsUrl = "/userid/".$_SESSION['userId'];

?>

<?php
$resp = "";
if (isset($_POST['upload_supplier_docs'])) {
    if(isset($_FILES['file']['name'])){
        $uploadfile = '../includes/file_uploads/supplier/'.basename($_FILES['file']['name']);
        $description = $_POST['description'];
        //move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
        $temp = explode(".", $_FILES["file"]["name"]);
        $newfilename = basename($_FILES['file']['name']).date('Y.m.d').'.'.round(microtime(true)). '.' . end($temp) ;
        if(move_uploaded_file($_FILES["file"]["tmp_name"], "../includes/file_uploads/supplier/" . $newfilename)){
            $url = "http://localhost:7878/api/utg/ClientFileUpload/add";
            $data_array = array(
                'userId' => $_GET['supplierId'],
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

        <?php if ($_GET['menu'] == 'main'){?>
        <div class="tab">
            <ul class="nav nav-pills" role="tablist">
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link active text-blue" data-toggle="tab" href="#myrequisitions" role="tab" aria-selected="true" >-->
<!--                        My Requisitions-->
<!--                    </a>-->
<!--                </li>-->
                <li class="nav-item">
                    <a class="nav-link text-blue active" data-toggle="tab" href="#requisitions" role="tab" aria-selected="true" >
                        Incoming Requisitions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-blue" data-toggle="tab" href="#allrequisitions" role="tab" aria-selected="true">All requisitions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-blue" data-toggle="tab" href="#suppliers" role="tab" aria-selected="false">
                        Suppliers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-blue" data-toggle="tab" href="#categories" role="tab" aria-selected="false" >
                        Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-blue" data-toggle="tab" href="#budgets" role="tab" aria-selected="false" >
                        Budgets Vs. Expenditure
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-blue" data-toggle="tab" href="#po_user_role" role="tab"
                       aria-selected="false">
                        PO Users list
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-blue" data-toggle="tab" href="#departments" role="tab"
                       aria-selected="false">
                        Departments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-blue" data-toggle="tab" href="#branches" role="tab"
                       aria-selected="false">
                        Bsn Sectors
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-blue" data-toggle="tab" href="#reports" role="tab"
                       aria-selected="false">
                        Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-blue" data-toggle="tab" href="#parameters" role="tab"
                       aria-selected="false">
                        Tax Threshold
                    </a>
                </li>

            </ul>
            <div class="tab-content">
<!--                <div class="tab-pane fade show active" id="myrequisitions" role="tabpanel">-->
<!--                    --><?php //$requisitionsUrl = "/userid/".$_SESSION['userId'];
//                        include('../includes/tables/purchase_order/requisitions_table.php'); ?>
<!--                </div>-->
                <div class="tab-pane fade show active" id="requisitions" role="tabpanel">
                    <?php  $requisitionsUrl = "/approverId/".$_SESSION['userId'];
                        include('../includes/tables/purchase_order/requisitions_table.php'); ?>
                </div>
                <div class="tab-pane fade" id="allrequisitions" role="tabpanel">
                    <?php
                    $requisitionsUrl = "";
                    include('../includes/tables/purchase_order/requisitions_table.php'); ?>
                </div>
                <div class="tab-pane fade" id="suppliers" role="tabpanel">
                    <?php include('../includes/tables/purchase_order/list-suppliers.php'); ?>
                </div>
                <div class="tab-pane fade" id="po_user_role" role="tabpanel">
                    <?php include('../includes/tables/purchase_order/po_users_table.php'); ?>
                </div>
                <div class="tab-pane fade" id="categories" role="tabpanel">
                    <?php include('../includes/tables/purchase_order/list-categories.php'); ?>
                </div>
                <div class="tab-pane fade" id="budgets" role="tabpanel">
                    <?php include('../includes/tables/list-budget.php'); ?>
                </div>
                <div class="tab-pane fade" id="departments" role="tabpanel">
                    <?php include('../includes/tables/purchase_order/list-department.php'); ?>
                </div>
                <div class="tab-pane fade" id="branches" role="tabpanel">
                    <?php include('../includes/tables/business_sector_table.php'); ?>
                </div>
                <div class="tab-pane fade" id="reports" role="tabpanel">
                    <?php include('../includes/tables/purchase_order/report_table.php'); ?>
                </div>
                <div class="tab-pane fade" id="parameters" role="tabpanel">
                    <?php include('../includes/tables/purchase_order/parameters.php'); ?>
                </div>
            </div>
        </div>
        <?php } elseif ($_GET['menu'] == 'add_requisition'){


            // Call the requisitions function to get the data
            $requisitionsData = requisitions('');

            $lastKnownNumber = 0;
            foreach ($requisitionsData as $requisition) {
                $poNumber = $requisition['poNumber'];
                $number = intval(str_replace("P", "", $poNumber));
                if ($number > $lastKnownNumber) {
                    $lastKnownNumber = $number;
                }
            }
            $nextNumber = $lastKnownNumber + 1;
            $poNumber = "P" . str_pad($nextNumber, 6, "0", STR_PAD_LEFT);


            ?>

            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Create Purchase Order</h4>
                    </div>
                </div>
                <form method="POST" action="">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Requisition Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="name" placeholder="Enter Requisition Name" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <input class="form-control" type="hidden" name="po_number" value="<?php echo $poNumber; ?>" required/>
                            <button class="btn btn-success" type="submit" name="create_requisition">Save</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'add_supplier'){?>
            <?php
            if(isset($_POST['create'])){
                // API endpoint URL
                $url ="http://localhost:7878/api/utg/pos/supplier/save";

                // Data to send in the POST request
                $postData = array(
                    'name' => $_POST['name'],
                    'address' => $_POST['address'],
                    'phone' => $_POST['phone'],
                    'contactPerson' => $_POST['contactPerson'],
                    'comment' => $_POST['comment'],
                    'taxClearance' => $_POST['tax_clearance'],

                    'bsn_type' => $_POST['bsn_type'],
                    'bsn_reg_number' => $_POST['bsn_reg_number'],
                    'banking_info' => $_POST['banking_info'],
                    'tax_id_number' => $_POST['tax_id_number']
                );

                $data = json_encode($postData);

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true );

                // Execute the POST request and store the response in a variable
                $response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'Curl error: ' . curl_error($ch);
                }

                // Close cURL session
                curl_close($ch);

//                header("Location: list_customers.php");
//                exit;
            }
            ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Add Supplier</h4>
                    </div>
                </div>
                
                <form method="POST" action="requisitions.php?menu=add_supplier">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-12 col-md-10"><input class="form-control" type="text" name="name" placeholder="Supplier Name (Co. name)" required/></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Address</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="address" type="text" placeholder="Address (Co. address)" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Contact Person</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="contactPerson" type="text" placeholder="Contact Person" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Contact No.</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="phone" placeholder="+263 700 000 000" type="tel" required/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Business Type</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="bsn_type" type="text" placeholder="Enter Business Type" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Business Registration No.</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="bsn_reg_number" placeholder="Enter Business Registration Number" type="text" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Banking Information</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="banking_info" type="text" placeholder="Banking Information" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Tax Identification Number</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="tax_id_number" placeholder="Enter Tax Identification Number" type="text" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Description</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="comment" type="text" placeholder="Description" />
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button class="btn btn-success" type="submit" name="create">Save</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'update_supplier'){ ?>

            <?php
            $id = $_GET['supplierId'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/supplier/" . $id);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_response = curl_exec($ch);

            curl_close($ch);
            $data = json_decode($server_response, true);
            // Check if the JSON decoding was successful
            if ($data !== null) {
                $table = $data;

            } else {
                echo "Error decoding JSON data";
            }

            if (isset($_POST['supplier'])) {
                // API endpoint URL
                $url = "http://localhost:7878/api/utg/pos/supplier/update";

                // Data to send in the POST request
                $postData = array(
                    'id' => $_POST['id'],
                    'name' => $_POST['name'],
                    'address' => $_POST['address'],
                    'phone' => $_POST['phone'],
                    'contactPerson' => $_POST['contactPerson'],
                    'comment' => $_POST['comment'],
                    'taxClearance' => $_POST['tax_clearance']
                );

                $data = json_encode($postData);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

                // Execute the POST request and store the response in a variable
                $response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'Curl error: ' . curl_error($ch);
                }

                // Close cURL session
                curl_close($ch);

//                header("Location: list_customers.php");
//                exit;
            }
            ?>

            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Update Supplier</h4>
                    </div>
                </div>
                <form method="POST" action="requisitions.php?menu=main">
                    <input name="id" value="<?php echo $table['id'] ?>" hidden="hidden">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="name" placeholder="Supplier Name" value="<?php echo $table['name'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Address</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="address" type="text" placeholder="Address" value="<?php echo $table['address'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Contact Person</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="contactPerson" type="text" placeholder="Contact Person" value="<?php echo $table['contactPerson'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Description</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="comment" type="text" placeholder="Description" value="<?php echo $table['comment'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Telephone</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="phone" placeholder="+263 700 000 000" type="tel" value="<?php echo $table['phone'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Tax Clearance</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select2 form-control" name="tax_clearance" style="width: 100%; height: 38px">
                                <optgroup>
                                    <option value="Yes" >Yes</option>
                                    <option value="No" >No</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button class="btn btn-success" type="submit" name="supplier">Save</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
            <!-- Default Basic Forms End -->

            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Supplier Documents</h4>
                    </div>
                </div>


                <div class="row">
                    <?php
                    $supplier_file_uploads = client_file_uploads($_GET['supplierId']);
                    foreach ($supplier_file_uploads as $application):
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
                                    <img src="../includes/file_uploads/supplier/<?php echo htmlspecialchars($fileName); ?>" class="card-img-top" alt="Default Image" onerror="this.src='../vendors/images/modal-img1.jpg';" style="height: 200px;">
                                <?php elseif ($isVideo): ?>
                                    <video style="height: 200px; width: 100%; display: block;" src="../includes/file_uploads/supplier/<?php echo $fileName; ?>" controls></video>
                                <?php else: ?>
                                    <img src="../vendors/images/modal-img1.jpg" class="card-img-top" alt="Default Image" style="height: 200px;">
                                <?php endif; ?>

                                <div class="card-body">
                                    <h5 class="card-title weight-500">
                                        <a name="downloadfile" download="<?php echo htmlspecialchars($application['fileName']) ?>" href="../includes/file_uploads/supplier/<?php echo htmlspecialchars($application['fileName']) ?>" style="color: black;">Download</a>
                                    </h5>
                                    <p class="card-text"><?php echo htmlspecialchars($application['fileDescription']) ?></p>
                                    <!--                                        <a name="downloadfile" class="btn btn-primary" download="--><?php //echo htmlspecialchars($application['fileName']) ?><!--" href="../includes/file_uploads/supplier/--><?php //echo htmlspecialchars($application['fileName']) ?><!--">Download</a>-->
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h3 class="text-blue h4">Upload Supplier Documents</h3>
                        <p></p>
                        <ul>
                            <h6>Please make sure the following Documents are provided : </h6>
                            <li>Banking details </li>
                            <li>Contracts </li>
                            <li>Service agreements</li>
                            <li>Other billing justifications</li>
                        </ul>
                    </div>

                </div>
                <form action="" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label>Upload Document </label>
                        <input type="file" class="form-control-file form-control height-auto" name="file" id="file" required/>
                    </div>

                    <div class="form-group">
                        <label>Document Description</label>
                        <input class="form-control" type="text" name="description" id="description" placeholder="Document Description" required>
                    </div>

                    <div class="fallback">
                        <label class="col-sm-12 col-md-2 col-form-label"></label>
                        <div class="col-sm-12 col-md-10">
                            <button  type="submit" class="btn btn-danger" value="Upload" name="upload_supplier_docs" >Submit Document</button>

                        </div>
                </form>
            </div>


        <?php }
        elseif ($_GET['menu'] == 'add_policy'){
            ?>
            <?php
            if (isset($_POST['create'])) {
                // API endpoint URL
                $url = "http://localhost:7878/api/utg/pos/tax_policy";

                // Data to send in the POST request
                $postData = array(
                    'description' => $_POST['description'],
                );

                $data = json_encode($postData);

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true);

                // Execute the POST request and store the response in a variable
                $response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'Curl error: ' . curl_error($ch);
                }

                // Close cURL session
                curl_close($ch);

//                header("Location: list_customers.php");
//                exit;
            }
            ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Add Tax Policy</h4>
                    </div>
                </div>
                <form method="POST" action="requisitions.php?menu=add_policy">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-12 col-md-10">
                            <label for="description" hidden="hidden"></label>
                            <input id="description" class="form-control" type="text" name="description"
                                   placeholder="Tax Policy" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button class="btn btn-success" type="submit" name="create">Save</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'update_policy'){ ?>

            <?php
            $id = $_GET['policyId'];
            $ch = curl_init();
            $url = "http://localhost:7878/api/utg/pos/tax_policy/" . $id;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_response = curl_exec($ch);

            curl_close($ch);
            $data = json_decode($server_response, true);
            // Check if the JSON decoding was successful
            if ($data !== null) {
                $table = $data;
            } else {
                echo "Error decoding JSON data";
            }

            if (isset($_POST['supplier'])) {
                // API endpoint URL
                $url = "http://localhost:7878/api/utg/pos/tax_policy";

                // Data to send in the POST request
                $postData = array(
                    'id' => $_POST['id'],
                    'description' => $_POST['description'],
                );

                $data = json_encode($postData);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

                // Execute the POST request and store the response in a variable
                $response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'Curl error: ' . curl_error($ch);
                }

                // Close cURL session
                curl_close($ch);

//                header("Location: list_customers.php");
//                exit;
            }
            ?>

            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Update Policy</h4>
                    </div>
                </div>
                <form method="POST" action="requisitions.php?menu=update_policy">
                    <input name="id" value="<?php echo $table['id'] ?>" hidden="hidden">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-12 col-md-10">
                            <label for="description" hidden="hidden"></label>
                            <input id="description" class="form-control" type="text" name="description"
                                   placeholder="Tax Policy" value="<?php echo $table['description'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button class="btn btn-success" type="submit" name="supplier">Save</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
            <!-- Default Basic Forms End -->

        <?php }
        elseif ($_GET['menu'] == 'create_budget'){
            include('../includes/forms/create_po_budget.php');
        }
        elseif ($_GET['menu'] == 'update_budget'){

                    include('../includes/forms/update_po_budget.php');

            ?>



        <?php }
        elseif ($_GET['menu'] == 'add_department'){?>
            <?php
            if(isset($_POST['create'])){
                // API endpoint URL
                $url ="http://localhost:7878/api/utg/pos/department/save";

                // Data to send in the POST request
                $postData = array(
                    'name' => $_POST['name'],
                );

                $data = json_encode($postData);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true );
                // Execute the POST request and store the response in a variable
                $response = curl_exec($ch);
                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'Curl error: ' . curl_error($ch);
                }

                // Close cURL session
                curl_close($ch);
            }
            ?>

            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Add Department</h4>
                    </div>
                </div>
                <form method="POST" action="requisitions.php?menu=add_department">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="name" placeholder="Department Name" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button class="btn btn-success" type="submit" name="create">Save</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Default Basic Forms End -->

        <?php }
        elseif ($_GET['menu'] == 'update_department'){?>

            <?php
            $id = $_GET['id'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/department/". $id);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_response = curl_exec($ch);

            curl_close($ch);
            $data = json_decode($server_response, true);
            // Check if the JSON decoding was successful
            if ($data !== null) {
                $table = $data;

            } else {
                echo "Error decoding JSON data";
            }

            if(isset($_POST['update'])){
                // API endpoint URL
                $url ="http://localhost:7878/api/utg/pos/department/update";

                // Data to send in the POST request
                $postData = array(
                    'id'=>  $_POST['id'],
                    'name' => $_POST['name'],
                );

                $data = json_encode($postData);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true );
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

                // Execute the POST request and store the response in a variable
                $response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'Curl error: ' . curl_error($ch);
                }

                // Close cURL session
                curl_close($ch);

//                header("Location: list-audit-trail.php");
//                exit;
            }
            ?>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Update Department</h4>
                    </div>
                </div>
                <form method="POST" action="requisitions.php?menu=main">
                    <input name="id" value="<?php echo $table['id'] ?>" hidden="hidden">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="name" value="<?php echo $table['name'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button name="update" class="btn btn-success" type="submit">Update</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Default Basic Forms End -->

        <?php }
        elseif ($_GET['menu'] == 'add_category'){?>

            <?php
            if(isset($_POST['create'])){
                // API endpoint URL
                $url ="http://localhost:7878/api/utg/pos/category/save";

                // Data to send in the POST request
                $postData = array(
                    'name' => $_POST['name'],
                );

                $data = json_encode($postData);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true );

                // Execute the POST request and store the response in a variable
                $response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'Curl error: ' . curl_error($ch);
                }

                // Close cURL session
                curl_close($ch);

//                header("Location: list-categories.php");
//                exit;
            }
            ?>

            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Add Category</h4>
                    </div>
                </div>
                <form method="POST" action="requisitions.php?menu=add_category">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="name" placeholder="Category Name" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button class="btn btn-success" type="submit" name="create">Save</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'update_category'){?>

            <?php
            $id = $_GET['id'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/category/". $id);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_response = curl_exec($ch);

            curl_close($ch);
            $data = json_decode($server_response, true);
            // Check if the JSON decoding was successful
            if ($data !== null) {
                $table = $data;

            } else {
                echo "Error decoding JSON data";
            }

            if(isset($_POST['update'])){
                // API endpoint URL
                $url ="http://localhost:7878/api/utg/pos/category/update";

                // Data to send in the POST request
                $postData = array(
                    'id'=>  $_POST['id'],
                    'name' => $_POST['name'],
                );

                $data = json_encode($postData);

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true );
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

                // Execute the POST request and store the response in a variable
                $response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'Curl error: ' . curl_error($ch);
                }

                // Close cURL session
                curl_close($ch);

//                header("Location: list-categories.php");
//                exit;
            }
            ?>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Update Category</h4>
                    </div>
                </div>
                <form method="post" action="requisitions.php?menu=main">
                    <input name="id" value="<?php echo $table['id'] ?>" hidden="hidden">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="name" value="<?php echo $table['name'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button name="update" class="btn btn-success" type="submit">Update</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Default Basic Forms End -->

        <?php }
        elseif ($_GET['menu'] == 'add_parameter') { ?>

            <?php
        if (isset($_POST['create'])) {
            // API endpoint URL
            $url = "http://localhost:7878/api/utg/pos/parameter/save";

            // Data to send in the POST request
            $postData = array(
                'tax' => $_POST['tax'],
                'cumulative' => $_POST['cumulative'],
            );

            $data = json_encode($postData);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);

            // Execute the POST request and store the response in a variable
            $response = curl_exec($ch);

            // Check for cURL errors
        if (!curl_errno($ch)) {
            // $_SESSION['info'] = "";
            // $_SESSION['error'] = "";
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
        case 201:  # OK redirect to dashboard
            ?>
            <script>
                $(function () {
                    $("#myModal").modal();//if you want you can have a timeout to hide the window after x seconds
                });
            </script>
        <?php

        break;
        case 400:  # Bad Request
            $decoded = json_decode($bodyStr);
            foreach ($decoded as $key => $val) {
                //echo $key . ': ' . $val . '<br>';
            }
            // echo $val;
            $_SESSION['error'] = "Failed. Please try again, " . $val;
            header('location: campaign_and_marketing.php?menu=add_campaign');
            break;

        case 401: # Unauthorixed - Bad credientials
            $_SESSION['error'] = 'Application failed.. Please try again!';
            header('location: requisitions.php?menu=main');

            break;
        default:
            $_SESSION['error'] = 'Not able to send application' . "\n";
            header('location: requisitions.php?menu=main');
        }
        } else {
            $_SESSION['error'] = 'Application failed.. Please try again!' . "\n";
            header('location: requisitions.php?menu=main');

        }
        curl_close($ch);


        //                header("Location: list-categories.php");
        //                exit;
        }
        ?>


            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center font-18">
                            <h3 class="mb-20">Parameter Created Successfully!</h3>
                            <div class="mb-30 text-center">
                                <img src="../vendors/images/success.png"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center"> <!-- Full width column for button -->
                                <div class="input-group mb-3 d-flex justify-content-center">
                                    <a class="btn btn-danger btn-lg" href="requisitions.php?menu=main">Ok</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-3"> <!-- Full width column with margin top -->
                                <!-- Leave some space below the button -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Add Parameters</h4>
                    </div>
                </div>
                <form method="POST" action="requisitions.php?menu=add_parameter">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Threshold For Cumulative Invoices</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="cumulative" placeholder="TCI" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Withholding Tax Percentage</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="tax" placeholder="Tax Percentage" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button class="btn btn-success" type="submit" name="create">Save</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>


        <?php }
        elseif ($_GET['menu'] == 'update_parameter') { ?>

        <?php
        $id = $_GET['id'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/parameter/" . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_response = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($server_response, true);
        // Check if the JSON decoding was successful
        if ($data !== null) {
            $table = $data;

        }

        if (isset($_POST['parameter'])) {
        // API endpoint URL
        $url = "http://localhost:7878/api/utg/pos/parameter/update";

        // Data to send in the POST request
        $postData = array(
            'id' => $_POST['id'],
            'tax' => $_POST['tax'],
            'cumulative' => $_POST['cumulative'],
        );

        $data = json_encode($postData);

        $ch = curl_init();


        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

        // Execute the POST request and store the response in a variable
        $response = curl_exec($ch);

        // Check for cURL errors
        if (!curl_errno($ch)) {
        // $_SESSION['info'] = "";
        // $_SESSION['error'] = "";
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
        case 200:  # OK redirect to dashboard
        ?>
            <script>
                $(function () {
                    $("#myModal").modal();//if you want you can have a timeout to hide the window after x seconds
                });
            </script>
        <?php

        break;
        case 400:  # Bad Request
            $decoded = json_decode($bodyStr);
            foreach ($decoded as $key => $val) {
                //echo $key . ': ' . $val . '<br>';
            }
            // echo $val;
            $_SESSION['error'] = "Failed. Please try again, " . $val;
            header('location: campaign_and_marketing.php?menu=add_campaign');
            break;

        case 401: # Unauthorixed - Bad credientials
            $_SESSION['error'] = 'Application failed.. Please try again!';
            header('location: requisitions.php?menu=main');

            break;
        default:
            $_SESSION['error'] = 'Not able to send application' . "\n";
            header('location: requisitions.php?menu=main');
        }
        } else {
            $_SESSION['error'] = 'Application failed.. Please try again!' . "\n";
            header('location: requisitions.php?menu=main');

        }
        curl_close($ch);

        //                header("Location: requisitions.php?menu=main");
        //                exit;
        }
        ?>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center font-18">
                            <h3 class="mb-20">Parameter Updated Successfully!</h3>
                            <div class="mb-30 text-center">
                                <img src="../vendors/images/success.png"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center"> <!-- Full width column for button -->
                                <div class="input-group mb-3 d-flex justify-content-center">
                                    <a class="btn btn-danger btn-lg" href="requisitions.php?menu=main">Ok</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-3"> <!-- Full width column with margin top -->
                                <!-- Leave some space below the button -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Update Parameters</h4>
                    </div>
                </div>
                <form method="post" action="requisitions.php?menu=update_parameter">
                    <input name="id" value="<?php echo $table['id'] ?>" hidden="hidden">


                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Threshold For Cumulative Invoices</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="cumulative" placeholder="TCI"
                                   value="<?php echo $table['cumulative'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Withholding Tax Percentage</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="tax" placeholder="Tax Percentage"
                                   value="<?php echo $table['tax'] ?>" required/>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button name="parameter" class="btn btn-success" type="submit">Update</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Default Basic Forms End -->

        <?php }
        ?>

        <?php include('../includes/footer.php');?>
    </div>
</div>

<!-- js -->
<script src="../vendors/scripts/core.js"></script>
<script src="../vendors/scripts/script.min.js"></script>
<script src="../vendors/scripts/process.js"></script>
<script src="../vendors/scripts/layout-settings.js"></script>
<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>

<!-- js -->
<script src="../src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="../src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
<script src="../vendors/scripts/highchart-setting.js"></script>

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
