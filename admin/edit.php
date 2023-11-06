<?php
include('../session/session.php');
include ('check_role.php');
include('../includes/controllers.php');
$nav_header = "Marketing & Campaigns";

$market_campaign_by_id = market_campaign_by_id($_GET['id']);


function updateZones($id, $name, $description) {
    $url = "http://localhost:7878/api/utg/zones/update/" . $id;
    $data_array = array(
        'name' => $name,
        'description' => $description,
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
    $headers = headersToArray($headerStr);

    if (!curl_errno($ch)) {
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:
                audit($_SESSION['userid'], "Zone Updated Successfully! - ".$id, $_SESSION['branch']);
                // Success: Show a success modal using JavaScript
                echo '<script>
                 alert("Zone Updated Successfully!");
        // Add code to display a modal here
                    </script>';
                break;

            case 400:
                // Handle other cases (e.g., 400 Bad Request) as before
                $decoded = json_decode($bodyStr);
                foreach ($decoded as $key => $val) {
                    echo $key . ': ' . $val . '<br>';
                }
                echo $val;
                $_SESSION['error'] = "Failed. Please try again, " . $val;
                audit($_SESSION['userid'], "Failed to Sign Ticket! - " . $id, $_SESSION['branch']);
                header('location: edit.php?menu=zones');
                break;
            default:
                $_SESSION['error'] = 'Could not update Loan status ' . "\n";
                audit($_SESSION['userid'], "Failed to Sign Ticket! - " . $id, $_SESSION['branch']);
                header('location: edit.php?menu=zones');
        }
    } else {
        $_SESSION['error'] = 'Update failed.. Please try again!' . "\n";
        audit($_SESSION['userid'], "Failed to Update Zone! - " . $id, $_SESSION['branch']);
        header('location: edit.php?menu=zones');
    }
    curl_close($ch);
}

if(isset($_POST['Zones'])) {
    $id = $_POST['id'];
    $name = $_POST['zone'];
    $description = $_POST['description'];

    updateZones($id, $name, $description);
}


// Update City


function updateCity($id,$name ,$description){

    $url = "http://localhost:7878/api/utg/cities/update/".$id;
    $data_array = array(
        'name' => $name,
        'description' => $description,

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
            case 200:
                audit($_SESSION['userid'], "Zone Updated Successfully! - ".$id, $_SESSION['branch']);
                // Success: Show a success modal using JavaScript
                echo '<script>
                 alert("City Updated Successfully!");
        // Add code to display a modal here
                    </script>';
                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    echo $key . ': ' . $val . '<br>';
                }
                echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                audit($_SESSION['userid'], "Failed to Update City! - ".$id, $_SESSION['branch']);
                header('location: edit.php?menu=cities');
                break;
            default:
                $_SESSION['error'] = 'Could not update Loan status '. "\n";
                audit($_SESSION['userid'], "Failed to Update TargetTicket! - ".$id, $_SESSION['branch']);
                header('location: edit.php?menu=cities');
        }
    } else {
        $_SESSION['error'] = 'Update failed.. Please try again!'. "\n";
        audit($_SESSION['userid'], "Failed to Update Zone! - ".$id, $_SESSION['branch']);
        header('location: edit.php?menu=cities');
    }
    curl_close($ch);
}
if(isset($_POST['City'])) {
    $id = $_POST['id'];
    $name = $_POST['city'];
    $description = $_POST['description'];

    updateCity($id, $name, $description);
}



// Update Target

function updateTarget($id,$branch ,$target){

    $url = "http://localhost:7878/api/utg/targets/update/".$id;
    $data_array = array(
        'branch' => $branch,
        'target' => $target,

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
            case 200:
                audit($_SESSION['userid'], "Target Updated Successfully! - ".$id, $_SESSION['branch']);
                // Success: Show a success modal using JavaScript
                echo '<script>
                 alert("Target Updated Successfully!");
        // Add code to display a modal here
                    </script>';
                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    echo $key . ': ' . $val . '<br>';
                }
                echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                audit($_SESSION['userid'], "Failed to Update Target! - ".$id, $_SESSION['branch']);
                header('location: edit.php?menu=target');
                break;
            default:
                $_SESSION['error'] = 'Could not update Targets '. "\n";
                audit($_SESSION['userid'], "Failed to Update Target! - ".$id, $_SESSION['branch']);
                header('location: edit.php?menu=target');
        }
    } else {
        $_SESSION['error'] = 'Update failed.. Please try again!'. "\n";
        audit($_SESSION['userid'], "Failed to Update Target! - ".$id, $_SESSION['branch']);
        header('location: edit.php?menu=target');
    }
    curl_close($ch);
}
if(isset($_POST['Target'])) {
    $id = $_POST['id'];
    $branch = $_POST['branch'];
    $target = $_POST['target'];

    updateTarget($id, $branch, $target);
}

// Update Sector
function updateSector($id,$name ,$subSector){

    $url = "http://localhost:7878/api/utg/industries/update/".$id;
    $data_array = array(
        'name' => $name,
        'subSector' => $subSector,

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
            case 200:
                audit($_SESSION['userid'], "Sector Updated Successfully! - ".$id, $_SESSION['branch']);
                // Success: Show a success modal using JavaScript
                echo '<script>
                 alert("Sector Updated Successfully!");
        // Add code to display a modal here
                    </script>';
                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    echo $key . ': ' . $val . '<br>';
                }
                echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                audit($_SESSION['userid'], "Failed to Update Industry! - ".$id, $_SESSION['branch']);
                header('location: edit.php?menu=sector');
                break;
            default:
                $_SESSION['error'] = 'Could not update Sector '. "\n";
                audit($_SESSION['userid'], "Failed to Update Sector! - ".$id, $_SESSION['branch']);
                header('location: edit.php?menu=sector');
        }
    } else {
        $_SESSION['error'] = 'Update failed.. Please try again!'. "\n";
        audit($_SESSION['userid'], "Failed to Update Sector! - ".$id, $_SESSION['branch']);
        header('location: edit.php?menu=sector');
    }
    curl_close($ch);
}
if(isset($_POST['Sector'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $subSector = $_POST['subsector'];

    updateSector($id, $name, $subSector);
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


        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 card-box">
                <h5 class="h4 text-blue mb-20">Edit</h5>

                <?php if ($_GET['menu'] == 'cities'){ ?>



                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix">
                            <h4 class="text-blue h4">Edit City</h4>

                        </div>

                        <div class="wizard-content">

                            <form action="" method="POST">
                                <?php  $cities_by_id = cities_by_id($_GET['id']); ?>
                                <div class="row">

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>City Name</label>
                                            <input type="text" class="form-control" value="<?=$cities_by_id['name'] ?>" name="city" id="city" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>City Discription</label>
                                            <input type="text" class="form-control" name="description" value="<?=$cities_by_id["description"]?>" id="description" required>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">

                                            <input type="hidden" class="form-control" name="id" value="<?=$cities_by_id["id"]?>" id="id" required>
                                        </div>
                                    </div>

                                </div>



                                <div class="col-md-6 col-sm-12">

                                    <?php

                                    ?>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger" value="City" name="City">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                <?php }



                elseif ($_GET['menu'] == 'zones'){ ?>



                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix">
                            <h4 class="text-blue h4">Edit Zone</h4>

                        </div>
                        <div class="wizard-content">

                            <form action="" method="POST">

                                <?php  $zones_by_id = zones_by_id($_GET['id']); ?>
                                <div class="row">

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Zone Name</label>
                                            <input type="text" class="form-control" value="<?=$zones_by_id['name'] ?>" name="zone" id="zone" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Zone Discription</label>
                                            <input type="text" class="form-control" value="<?=$zones_by_id['description'] ?>"name="description" id="discription" required>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" value="<?=$zones_by_id['id'] ?>" name="id" id="id" required>
                                        </div>
                                    </div>


                                </div>



                                <div class="row">


                                </div>



                                <div class="col-md-6 col-sm-12">

                                    <?php
                                    //                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    //                    $start_date = $_POST["start_date"];
                                    //                    $end_date = $_POST["end_date"];
                                    //
                                    //                    if ($end_date > $start_date) {
                                    //                        // End date is greater than start date
                                    //                        echo "End date is greater than start date.";
                                    //                        // Add your desired logic here
                                    //                    } else {
                                    //                        // End date is not greater than start date
                                    //                        echo "End date must be greater than start date.";
                                    //                        // Add your desired logic here
                                    //                    }
                                    //                }
                                    ?>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger" value="Zones" name="Zones">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>


                <?php } elseif($_GET['menu'] == 'target'){ ?>

                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix">
                            <h4 class="text-blue h4">Edit Branch Target</h4>

                        </div>
                        <div class="wizard-content">

                            <form action="" method="POST">
                                <?php  $targets_by_id = targets_by_id($_GET['id']); ?>
                                <div class="row">

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Branch Name</label>
                                            <select class="custom-select form-control"name="branch" value="<?=$targets_by_id['branch'] ?>" id="branch" required>

                                                <?php
                                                $branches = branch();
                                                foreach ($branches as $branch) {
                                                    echo "<option value='$branch[branchName]'>$branch[branchName] Branch</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Branch Target</label>
                                            <input type="text" class="form-control" name="target"  value="<?=$targets_by_id['target'] ?>" id="target" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">

                                            <input type="hidden" class="form-control" name="id"  value="<?=$targets_by_id['id'] ?>" id="id" required>
                                        </div>
                                    </div>

                                </div>



                                <div class="col-md-6 col-sm-12">


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger" value="Target" name="Target">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                <?php } elseif($_GET['menu'] == 'sector'){ ?>




                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix">
                            <h4 class="text-blue h4">Edit Sector</h4>

                        </div>
                        <div class="wizard-content">

                            <form action="" method="POST">
                                <?php  $sectors_by_id = sectors_by_id($_GET['id']); ?>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Sector Name</label>
                                            <input type="text" class="form-control" value="<?=$sectors_by_id['name'] ?>" name="name" id="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Sub Sector <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                                            <input type="text" class="form-control" name="subsector" value="<?=$sectors_by_id['subSector'] ?>" id="subsector" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">

                                            <input type="hidden" class="form-control" value="<?=$sectors_by_id['id'] ?>" name="id" id="id" required>
                                        </div>
                                    </div>

                                </div>




                                <div class="col-md-6 col-sm-12">

                                    <?php
                                    //                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    //                    $start_date = $_POST["start_date"];
                                    //                    $end_date = $_POST["end_date"];
                                    //
                                    //                    if ($end_date > $start_date) {
                                    //                        // End date is greater than start date
                                    //                        echo "End date is greater than start date.";
                                    //                        // Add your desired logic here
                                    //                    } else {
                                    //                        // End date is not greater than start date
                                    //                        echo "End date must be greater than start date.";
                                    //                        // Add your desired logic here
                                    //                    }
                                    //                }
                                    ?>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger" value="Sector" name="Sector">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                <?php } ?>

                <!--                                <div class="tab-pane fade" id="status" role="tabpanel">-->
                <!--                                    --><?php //include('../includes/tables/lead_status_table.php'); ?>
                <!--                                </div>-->

            </div>





        </div>
    </div>






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
