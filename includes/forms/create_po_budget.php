<?php
if (isset($_POST['create_budget'])) {
    // API endpoint URL
    $url = "http://localhost:7878/api/utg/pos/budget/save";

    // Data to send in the POST request
    $postData = array(
        'category' => $_POST['category'],
        'year' => $_POST['year'],
        'amount' => array_sum(array(
            $_POST['january'],
            $_POST['february'],
            $_POST['march'],
            $_POST['april'],
            $_POST['may'],
            $_POST['june'],
            $_POST['july'],
            $_POST['august'],
            $_POST['september'],
            $_POST['october'],
            $_POST['november'],
            $_POST['december']
        )),
        'january' => $_POST['january'],
        'february' => $_POST['february'],
        'march' => $_POST['march'],
        'april' => $_POST['april'],
        'may' => $_POST['may'],
        'june' => $_POST['june'],
        'july' => $_POST['july'],
        'august' => $_POST['august'],
        'september' => $_POST['september'],
        'october' => $_POST['october'],
        'november' => $_POST['november'],
        'december' => $_POST['december'],
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
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        switch ($http_code) {
            case 201:  # OK redirect to dashboard
                ?>
                <script>
                    $(function () {
                        $("#myModal").modal();//if you want you can have a timeout to hide the window after x seconds
                    });
                </script>
                <?php
                break;
            default:
                $_SESSION['error'] = 'Not able to save budget' . "\n";
                header('location: requisitions.php?menu=main');
        }
    } else {
        $_SESSION['error'] = 'Budget creation failed.. Please try again!' . "\n";
        header('location: requisitions.php?menu=main');
    }
    curl_close($ch);
}
?>

<!-- Default Basic Forms Start -->
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Add Budget</h4>
        </div>
    </div>
    <form method="POST" action="">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Category Name</label>
                    <select class="custom-select2 form-control" name="category" style="width: 100%; height: 38px">
                        <optgroup label="Categories">
                            <option value="" >Please Select Category</option>
                            <option value="All" >All Categories</option>
                            <?php
                            $categories = categories('/all');
                            foreach ($categories as $row):?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Year</label>
                    <select class="custom-select2 form-control" name="year" style="width: 100%; height: 38px">
                        <optgroup label="Year" id="year">
                            <?php
                            $currentYear = date("Y");
                            $startYear = $currentYear - 10;
                            $endYear = $currentYear + 10;
                            for ($year = $startYear; $year <= $endYear; $year++) {
                                $selected = ($year == $currentYear) ? 'selected' : '';
                                echo "<option value=\"$year\" $selected>$year</option>";
                            }
                            ?>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Total</label>
                    <input type="number" class="form-control" name="amount" id="totalAmount" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>January</label>
                    <input type="number" class="form-control" required name="january" id="january">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>February</label>
                    <input type="number" class="form-control" required name="february" id="february">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>March</label>
                    <input type="number" class="form-control" required name="march" id="march">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>April</label>
                    <input type="number" class="form-control" required name="april" id="april">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>May</label>
                    <input type="number" class="form-control" required name="may" id="may">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>June</label>
                    <input type="number" class="form-control" required name="june" id="june">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>July</label>
                    <input type="number" class="form-control" required name="july" id="july">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>August</label>
                    <input type="number" class="form-control" required name="august" id="august">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>September</label>
                    <input type="number" class="form-control" required name="september" id="september">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>October</label>
                    <input type="number" class="form-control" required name="october" id="october">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>November</label>
                    <input type="number" class="form-control" required name="november" id="november">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>December</label>
                    <input type="number" class="form-control" required name="december" id="december">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 col-md-2 col-form-label">
                <button class="btn btn-success" type="submit" name="create_budget">Save</button>
            </div>
            <div class="col-sm-12 col-md-2 col-form-label">
                <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('.custom-select2').select2();

            function calculateTotal() {
                var total = 0;
                $("input[type='number']").not("#totalAmount").each(function() {
                    var value = $(this).val();
                    if ($.isNumeric(value)) {
                        total += parseFloat(value);
                    }
                });
                $("#totalAmount").val(total);
            }

            $("input[type='number']").on('input', function() {
                calculateTotal();
            });

            // Calculate total on page load if values are pre-filled
            calculateTotal();
        });
    </script>
</div>
<!-- Default Basic Forms End -->
