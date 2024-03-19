<?php
include('../session/session.php');
include('check_role.php');
include('../includes/controllers.php');
$state = $_GET['state'];
$nav_header = "Requisitions";

$url = '';
if ($state == 'progress') {
    $url = '/loanStatus/ACCEPTED';
} elseif ($state == 'reject') {
    $url = '/loanStatus/REJECTED';
} else {
    $url;
}
$requisitionsUrl = "";

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

        <?php if ($_GET['menu'] == 'main') { ?>
            <div class="tab">
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-blue" data-toggle="tab" href="#requisitions" role="tab"
                           aria-selected="true">
                            Requisitions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-blue" data-toggle="tab" href="#suppliers" role="tab"
                           aria-selected="false">
                            Suppliers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-blue" data-toggle="tab" href="#categories" role="tab"
                           aria-selected="false">
                            Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-blue" data-toggle="tab" href="#budgets" role="tab"
                           aria-selected="false">
                            Budgets Vs. Expenditure
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-blue" data-toggle="tab" href="#po_user_role" role="tab"
                           aria-selected="false">
                            PO User Roles
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

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="requisitions" role="tabpanel">
                        <?php include('../includes/tables/purchase_order/requisitions_table.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="suppliers" role="tabpanel">
                        <?php include('../includes/tables/purchase_order/list-suppliers.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="categories" role="tabpanel">
                        <?php include('../includes/tables/purchase_order/list-categories.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="budgets" role="tabpanel">
                        <?php include('../includes/tables/list-budget.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="po_user_role" role="tabpanel">

                        <form method="post" action="">
                            <div class="row">
                                <div class="pd-20 col-4">
                                    <div class="form-group">
                                        <br>
                                        <label>Select User :</label>
                                        <select class="custom-select2 form-control" data-style="btn-outline-primary"
                                                data-size="5" name="user" style="width: 100%; height: 38px">
                                            <optgroup label="Pick a user">
                                                <?php
                                                $users = untuStaff();
                                                foreach ($users as $user) {
                                                    echo "<option value='$user[id]'>$user[firstName] $user[lastName]</option>";
                                                } ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="pd-20 col-4">
                                    <div class="form-group">
                                        <br>
                                        <label>Select P.O Role :</label>
                                        <select class="custom-select2 form-control" data-style="btn-outline-primary"
                                                data-size="5" name="role" style="width: 100%; height: 38px">
                                            <optgroup label="Assign Role">
                                                <option value="">Unassign Role</option>
                                                ;
                                                <?php
                                                $roles = roles();
                                                foreach ($roles as $role) {
                                                    echo "<option value='$role[id]'>$role[description] ($role[name])</option>";
                                                } ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="pd-20 col-4">
                                    <div class="form-group">
                                        <br>
                                        <label> .</label>
                                        <button type="submit" name="update_po_role"
                                                class="btn btn-success btn-lg btn-block">Update Role
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <?php include('../includes/tables/purchase_order/po_users_table.php'); ?>
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
                </div>
            </div>
        <?php } elseif ($_GET['menu'] == 'add_requisition') {


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
                            <input class="form-control" type="text" name="name" placeholder="Enter Requisition Name"
                                   required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <input class="form-control" type="hidden" name="po_number" value="<?php echo $poNumber; ?>"
                                   required/>
                            <button class="btn btn-success" type="submit" name="create_requisition">Save</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>

        <?php } elseif ($_GET['menu'] == 'add_supplier') { ?>
            <?php
            if (isset($_POST['create'])) {
                // API endpoint URL
                $url = "http://localhost:7878/api/utg/pos/supplier/save";

                // Data to send in the POST request
                $postData = array(
                    'name' => $_POST['name'],
                    'address' => $_POST['address'],
                    'phone' => $_POST['phone'],
                    'contactPerson' => $_POST['contactPerson'],
                    'comment' => $_POST['comment']
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

//                header("Location: list_vaults.php");
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
                        <div class="col-sm-12 col-md-10"><input class="form-control" type="text" name="name"
                                                                placeholder="Supplier Name" required/></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Address</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="address" type="text" placeholder="Address" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Contact Person</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="contactPerson" type="text" placeholder="Contact Person"
                                   required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Comment</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="comment" type="text" placeholder="Comment" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Telephone</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="phone" placeholder="+263 700 000 000" type="tel"
                                   required/>
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

        <?php } elseif ($_GET['menu'] == 'update_supplier') { ?>

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
                    'comment' => $_POST['comment']
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

//                header("Location: list_vaults.php");
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
                            <input class="form-control" type="text" name="name" placeholder="Supplier Name"
                                   value="<?php echo $table['name'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Address</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="address" type="text" placeholder="Address"
                                   value="<?php echo $table['address'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Contact Person</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="contactPerson" type="text" placeholder="Contact Person"
                                   value="<?php echo $table['contactPerson'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Comment</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="comment" type="text" placeholder="Comment"
                                   value="<?php echo $table['comment'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Telephone</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="phone" placeholder="+263 700 000 000" type="tel"
                                   value="<?php echo $table['phone'] ?>" required/>
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

        <?php } elseif ($_GET['menu'] == 'create_budget') {

            include('../includes/forms/create_po_budget.php');

        } elseif ($_GET['menu'] == 'update_budget') {

            include('../includes/forms/update_po_budget.php');

            ?>


        <?php } elseif ($_GET['menu'] == 'add_department') { ?>
            <?php
            if (isset($_POST['create'])) {
                // API endpoint URL
                $url = "http://localhost:7878/api/utg/pos/department/save";

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
                curl_setopt($ch, CURLOPT_HEADER, true);
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

        <?php } elseif ($_GET['menu'] == 'update_department') { ?>

            <?php
            $id = $_GET['id'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/department/" . $id);
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

            if (isset($_POST['update'])) {
                // API endpoint URL
                $url = "http://localhost:7878/api/utg/pos/department/update";

                // Data to send in the POST request
                $postData = array(
                    'id' => $_POST['id'],
                    'name' => $_POST['name'],
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
                            <input class="form-control" type="text" name="name" value="<?php echo $table['name'] ?>"
                                   required/>
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

        <?php } elseif ($_GET['menu'] == 'add_category') { ?>

            <?php
            if (isset($_POST['create'])) {
                // API endpoint URL
                $url = "http://localhost:7878/api/utg/pos/category/save";

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
                curl_setopt($ch, CURLOPT_HEADER, true);

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

        <?php } elseif ($_GET['menu'] == 'update_category') { ?>

            <?php
            $id = $_GET['id'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/category/" . $id);
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

            if (isset($_POST['update'])) {
                // API endpoint URL
                $url = "http://localhost:7878/api/utg/pos/category/update";

                // Data to send in the POST request
                $postData = array(
                    'id' => $_POST['id'],
                    'name' => $_POST['name'],
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
                            <input class="form-control" type="text" name="name" value="<?php echo $table['name'] ?>"
                                   required/>
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

        <?php } elseif ($_GET['menu'] == 'add_budget') { ?>

        <?php } elseif ($_GET['menu'] == 'add_department') {
            ?>

        <?php } ?>

        <?php include('../includes/footer.php'); ?>
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
>
    <iframe
            src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
            height="0"
            width="0"
            style="display: none; visibility: hidden"
    ></iframe
    >
</noscript>
<!-- End Google Tag Manager (noscript) -->

</body>
</html>
