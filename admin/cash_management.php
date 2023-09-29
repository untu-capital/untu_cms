<?php
include('../session/session.php');
include('../includes/controllers.php');
$state = $_GET['state'];
$nav_header = "Cash Management";

$url ='';
if ($state == 'progress'){$url = '/loanStatus/ACCEPTED';}
elseif($state == 'reject'){$url = '/loanStatus/REJECTED';}
else {$url;}

?>

<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/branches/getAllBranches");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_response = curl_exec($ch);

curl_close($ch);
$data = json_decode($server_response, true);
// Check if the JSON decoding was successful
if ($data !== null) {
    $branches = $data;

} else {
    echo "Error decoding JSON data";
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
                    <li class="nav-item">
                        <a class="nav-link active text-blue" data-toggle="tab" href="#requisitions" role="tab" aria-selected="true" >
                            Cash Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-blue" data-toggle="tab" href="#vaults" role="tab" aria-selected="false">
                            Vaults
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-blue" data-toggle="tab" href="#auditTrail" role="tab" aria-selected="false" >
                            Audit Trail
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="requisitions" role="tabpanel">
                        <?php include('../includes/tables/cash_management/requisitions_table.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="vaults" role="tabpanel">
                        <?php include('../includes/tables/cash_management/list_vaults.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="auditTrail" role="tabpanel">
                        <?php include('../includes/tables/cash_management/list-audit-trail.php'); ?>
                    </div>
                </div>
            </div>
        <?php }
        elseif ($_GET['menu'] == 'add_vault'){?>
            <?php
            if(isset($_POST['create'])){
                // API endpoint URL
                $url ="http://localhost:7878/api/utg/cms/vault/save";

                // Data to send in the POST request
                $postData = array(
                    'account' => $_POST['account'],
                    'name' => $_POST['name'],
                    'type' => $_POST['type'],
                    'branchId' => $_POST['branch'],
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
                if($response){
                    echo '<script>window.location.href = "http://localhost/untu-systems/admin/cash_management.php?menu=main&tabId=vaults";</script>';
                }
            }
            ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Add Vault</h4>
                    </div>
                </div>
                <form method="POST" action="cash_management.php?menu=add_vault">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Account</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="account" placeholder="Vault Account" required/></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="name" placeholder="Vault Name" required/></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Type</label>
                        <div class="col-sm-12 col-md-10">
                            <select
                                    class="custom-select2 form-control"
                                    name="type"
                                    style="width: 100%; height: 38px"
                            >
                                <optgroup label="Types">
                                    <option value="" >Select Vault Type</option>
                                    <option value="Petty Cash">Petty Cash</option>
                                    <option value="Internal Vault">Internal Vault</option>
                                    <option value="External Vault">External Vault</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Branch</label>
                        <div class="col-sm-12 col-md-10">
                            <select
                                    class="custom-select2 form-control"
                                    name="branch"
                                    style="width: 100%; height: 38px"
                            >
                                <optgroup label="Branches">
                                    <option value="" >Select Branch</option>
                                    <?php foreach ($branches as $branch):?>
                                        <option value="<?php echo $branch['id']; ?>"><?php echo $branch['branchName']; ?></option>
                                    <option>Harare</option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button class="btn btn-success" type="submit" name="create">Save</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="cash_management.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'update_vault'){ ?>

            <?php

            $id = $_GET['vaultId'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/vault/get/" . $id);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_response = curl_exec($ch);

            curl_close($ch);
            $data = json_decode($server_response, true);
            // Check if the JSON decoding was successful
            if ($data !== null) {
                $table = $data;

            }
            else {
                echo '<script>window.location.href = "http://localhost/untu-systems/admin/cash_management.php?menu=main#vaults";</script>';
                echo "Error decoding JSON data";
            }

            if (isset($_POST['vault'])) {
                // API endpoint URL
                $url = "http://localhost:7878/api/utg/cms/vault/update";
                // Data to send in the POST request
                $postData = array(
                    'id' => $_POST['id'],
                    'account' => $_POST['account'],
                    'name' => $_POST['vaultName'],
                    'type' => $_POST['type'],
                    'branchId' => $_POST['branch'],
                );

                $data = json_encode($postData);
                echo $data;
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


            }
            ?>

            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Update Vault</h4>
                    </div>
                </div>
                <form method="POST" action="cash_management.php?menu=update_vault">
                    <input name="id" value="<?php echo $table['id'] ?>" hidden="hidden">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Account</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="account" placeholder="Vault Account" value="<?php echo $table['account'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="vaultName" placeholder="Vault Account" value="<?php echo $table['name'] ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Vault Type</label>
                        <div class="col-sm-12 col-md-10">
                            <select
                                    class="custom-select2 form-control"
                                    name="type"
                                    style="width: 100%; height: 38px"
                            >
                                <optgroup label="Types">
                                    <option value="<?php echo $table['type'] ?>" ><?php echo $table['type'] ?></option>
                                    <option value="Petty Cash">Petty Cash</option>
                                    <option value="Internal Vault">Internal Vault</option>
                                    <option value="External Vault">External Vault</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Branch</label>
                        <div class="col-sm-12 col-md-10">
                            <select
                                    class="custom-select2 form-control"
                                    name="branch"
                                    style="width: 100%; height: 38px"
                            >
                                <optgroup label="Branches">
                                    <option value="<?php echo $table['branch']['id'] ?>" ><?php echo $table['branch']['branchName'] ?></option>
                                    <?php foreach ($branches as $branch):?>
                                        <option value="<?php echo $branch['id']; ?>"><?php echo $branch['branchName']; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <button class="btn btn-success" type="submit" name="vault">Update</button>
                        </div>
                        <div class="col-sm-12 col-md-2 col-form-label">
                            <a href="cash_management.php?menu=main" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
            <!-- Default Basic Forms End -->

        <?php }
        elseif ($_GET['menu'] == 'delete_vault'){ ?>

            <?php
            $id = $_GET['vaultId'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/vault/delete/". $id);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

            $server_response = curl_exec($ch);

            curl_close($ch);
            $data = json_decode($server_response, true);

            if ($data !== null) {
                $table = $data;

            } else {
                echo '<script>window.location.href = "http://localhost/untu-systems/admin/cash_management.php?menu=main";</script>';
                echo "Error decoding JSON data";
            }
            ?>

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
