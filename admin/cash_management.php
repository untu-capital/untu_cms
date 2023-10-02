<?php
include('../session/session.php');
include('charts_data.php');
$nav_header = "Cash Management Dashboard";

include('../includes/controllers.php');

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

        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 card-box">
                <h5 class="h4 text-blue mb-20">CMS Configurations</h5>
                <div class="tab">
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#acc_balance" role="tab" aria-selected="true">Account Balances</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#assign_role" role="tab" aria-selected="false">Assign CMS Role</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#vault_auth" role="tab" aria-selected="false">Vaults Authorization</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="acc_balance" role="tabpanel">
                            <div class="pd-20">
                                <?php include('../includes/dashboard/cms_acc_balance_widget.php'); ?>
                            </div>
                        </div>
                        <div class="tab-pane fade row" id="assign_role" role="tabpanel">

                            <form method="post" action="">
                                <div class="row">
                                    <div class="pd-20 col-4">
                                        <div class="form-group">
                                            <br>
                                            <label>Select User :</label>
                                            <select class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="user" style="width: 100%; height: 38px">
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
                                            <label>Select CMS Role :</label>
                                            <select class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="role" style="width: 100%; height: 38px">
                                                <optgroup label="Assign Role">
                                                    <option value="">Unassign Role</option>;
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
                                            <button type="submit" name="update_cms_role" class="btn btn-success btn-lg btn-block">Update Role</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <?php include('../includes/tables/cms_users_table.php'); ?>
                        </div>

                        <div class="tab-pane fade" id="vault_auth" role="tabpanel">
                            <form method="post" action="">
                                <div class="row">
                                    <div class="pd-20 col-4">
                                        <div class="form-group">
                                            <br>
                                            <label>Select User :</label>
                                            <select class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="user" style="width: 100%; height: 38px">
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

                                    <div class="pd-20 col-3">
                                        <div class="form-group">
                                            <br>
                                            <label>Select Vault Type :</label>
                                            <select class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="vault_type" style="width: 100%; height: 38px">
                                                <optgroup label="Select Vault Type">
<!--                                                    <option value="">Unassign Role</option>;-->
                                                    <?php
                                                    $roles = roles();
                                                    foreach ($roles as $role) {
                                                        echo "<option value='$role[id]'>$role[description] ($role[name])</option>";
                                                    } ?>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="pd-20 col-3">
                                        <div class="form-group">
                                            <br>
                                            <label>Select Vault Account :</label>
                                            <select class="custom-select2 form-control" data-style="btn-outline-primary" data-size="5" name="vault_acc" style="width: 100%; height: 38px">
                                                <optgroup label="Select Vault Account">
                                                    <option value="">Unassign Role</option>;
                                                    <?php
                                                    $roles = roles();
                                                    foreach ($roles as $role) {
                                                        echo "<option value='$role[id]'>$role[description] ($role[name])</option>";
                                                    } ?>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2 pd-20 form-group">
                                        <br>
                                        <label>.</label>
                                        <input class="form-control" type="hidden" name="userid" required value="<?php echo $_SESSION['userid'] ?>">
                                        <button type="submit" name="add_vault_permissions" class="btn btn-success btn-lg btn-block">Grant Permission</button>
                                    </div>
                                </div>
                            </form>
                            <?php include('../includes/tables/cms_permissions_table.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--        --><?php //include('../includes/tables/users_table.php'); ?>

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
<script>
    //var disbursementData = <?php //echo json_encode($disbursement_data); ?>//;
    //var targetData = <?php //echo json_encode($target_data); ?>//;
    //var disbursementRate = <?php //echo json_encode($disbursement_rate); ?>//;
</script>
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
