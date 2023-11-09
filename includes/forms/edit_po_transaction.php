
<?php

//$errors = array();
$req = req_trans("/getById/".$_GET['req_trans_id']);
// Escape user inputs for security
if(isset($_POST['Submit'])){
    $campaignname = $_POST['campaign_name'];
    $city = $_POST['city'];
    $branch = $_POST['branch'];
    $zonearea= $_POST['zone'];
    $sector = $_POST['sector'];
    $subsector = $_POST['subsector'];
    $valuechain = $_POST['value_chain'];
    $resourceneed = $_POST['resource_need'];
    $startdate = $_POST['start_date'];
    $enddate = $_POST['end_date'];
    $loanofficer = $_POST['loan_officer'];

    if ($enddate < $startdate) {
        // End date is greater than start date
        echo '<script>alert("End date must be greater than start date.");history.go(-1);</script>';
        // Add your desired logic here
    } else {
        $url = "http://localhost:7878/api/utg/api/market_campaigns";

        $data_array = array(
            'poName' => "UChat (Whatsapp Chatbot)",
            'poTotal' =>  "110",
            'notes' =>  "asdfghj"

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

        // Check HTTP status code
        if (!curl_errno($ch)) {
            // $_SESSION['info'] = "";
            // $_SESSION['error'] = "";
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:  # OK redirect to dashboard
                    ?>        <script>
                    $(function() {
                        $("#myModal").modal();//if you want you can have a timeout to hide the window after x seconds
                    });
                </script>
                    <?php

                    break;
                case 400:  # Bad Request
                    $decoded = json_decode($bodyStr);
                    foreach($decoded as $key => $val) {
                        //echo $key . ': ' . $val . '<br>';
                    }
                    // echo $val;
                    $_SESSION['error'] = "Failed. Please try again, ".$val;
                    header('location: campaign_and_marketing.php?menu=add_campaign');
                    break;

                case 401: # Unauthorixed - Bad credientials
                    $_SESSION['error'] = 'Application failed.. Please try again!';
                    header('location: campaign_and_marketing.php?menu=add_campaign');

                    break;
                default:
                    $_SESSION['error'] = 'Not able to send application'. "\n";
                    header('location: campaign_and_marketing.php?menu=add_campaign');
            }
        } else {
            $_SESSION['error'] = 'Application failed.. Please try again!'. "\n";
            header('location: campaign_and_marketing.php?menu=add_campaign');

        }
        curl_close($ch);
    }

}

?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h3 class="mb-20">Edit Transaction!</h3>
                <div class="mb-30 text-center">
                    <img src="../vendors/images/success.png" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-4">
                    <div class="input-group mb-0">
                        <a class="btn btn-danger btn-lg btn-block"  href="req_info.php?menu=main">Ok</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <h4 class="text-blue h4">Edit Transaction for: <?php echo $req['poItem'] ?> </h4>

    </div>
    <div class="wizard-content">

        <form action="" method="POST">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Item name</label>
                        <input type="text" class="form-control" name="item" id="item" value="<?php echo $req['poItem'] ?>" required>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Amount ($)</label>
                        <input type="number" class="form-control" name="amount" id="amount" value="<?php echo number_format($req['poQuantity'],'2','.',',') ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Currency</label>
                        <select class="custom-select2 form-control" name="currency" id="currency"  autocomplete="off" required style="width: 100%">
                            <option value="<?php echo $req['poCurrency'] ?>"><?php echo $req['poCurrency'] ?></option>
                            <option value="USD">USD</option>
                            <option value="ZWL">ZWL</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo $req['poQuantity'] ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Supplier</label>
                        <select class="custom-select2 form-control" name="supplier" id="supplier"  style="width: 100%" required>
                            <option value="<?php echo $req['poSupplier'] ?>"><?php $sup = suppliers("/".$req['poSupplier']);
                                echo $sup['name'] ; ?></option>
                            <?php
                                $suppliers = suppliers('/all');
                            foreach ($suppliers as $supplier) {
                                echo "<option value='$supplier[id]'>$supplier[name]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="custom-select2 form-control" name="category" id="category"  style="width: 100%" autocomplete="off" required>
                            <option value="<?php echo $req['poCategory'] ?>"><?php $cat = categories('/'.$req['poCategory']);
                                echo $cat['name'] ; ?></option>
                            <?php
                            $categories = categories('/all');
                            foreach ($categories as $category) {
                                echo "<option value='$category[id]'>$category[name]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <input class="form-control" type="hidden" name="req_trans_id" value="<?php echo $_GET['req_trans_id'] ?>" required>
                    <button type="submit" class="btn btn-danger" value="Submit" name="update_po_trans">Update Transaction</button>
                </div>
            </div>
        </form>

    </div>
</div>