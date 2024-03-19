
<div class="pd-20">
<!--    <button class="btn btn-lg btn-primary" type="submit" name="generate_amortization" id="showAmoFormButton"-->
<!--            style="margin-bottom: 15px;">Generate Amortisation Schedule-->
<!--    </button>-->
    <div class="pd-20 card-box mb-30">
        <form action="" method="POST" id="myAmoForm">
            <div class="clearfix">
                <h4 class="text-blue h4">Amortisation Schedule</h4>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Select Currency:</label>
                        <select class="custom-select2 form-control" name="currency" style="width: 100%; height: 38px">
                            <option value=""></option>
                            <option value="usd">USD</option>
                            <option value="zwl">ZWL</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Loan Size ($)</label>
                        <input type="number" class="form-control " name="amount" id="amount" required>
                    </div>
                </div>


                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Interest Rate (%)</label>
                        <input type="number" class="form-control " name="interest" id="interest" required>
                    </div>
                </div>

<!--            </div>-->
<!--            <div class="row">-->
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Loan Term & Frequency:</label>
                        <div class="row">
                            <div class="col-md-8">
                                <input type="number" class="form-control" placeholder="Enter loan term" name="tenure" id="tenure" required>
                            </div>
                            <div class="col-md-4">
                                <select class="custom-select2 form-control" name="tenure_freq" style="width: 100%; height: 38px">
                                    <option value="-- Select an option --"></option>
                                    <option value="day">Days</option>
                                    <option value="week">Weeks</option>
                                    <option value="month">Months</option>
                                    <option value="year">Years</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Repayment Every:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="number" class="form-control" value="1" placeholder="1" name="repayment" id="repayment" required>
                            </div>
                            <div class="col-md-6">
                                <select class="custom-select2 form-control" name="repayment_freq" style="width: 100%; height: 38px" required>
                                    <option value="">-- Select an option --</option>
                                    <option value="day">Days</option>
                                    <option value="week">Weeks</option>
                                    <option value="month">Months</option>
                                    <option value="year">Years</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Disbursement Date</label>
                        <input type="text" class="form-control date-picker" name="disbursement_date" id="disbursement_date" readonly required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" value="auth" name="auth">Submit</button>
                    </div>
                </div>
            </div>
        </form>

        <script>
            // Get references to the button and form
            var showAmoFormButton = document.getElementById("showAmoFormButton");
            var myAmoForm = document.getElementById("myAmoForm");

            // Add a click event listener to the button
            showAmoFormButton.addEventListener("click", function () {
                // Show the form by changing its display style
                myAmoForm.style.display = "block";
            });
        </script>

        <script>
            // JavaScript function to go back to the previous page
            function goBack() {
                window.history.back();
            }
        </script>

    </div>

    <table class="table hover table stripe multiple-select-row data-table-export nowrap">
        <thead>
        <tr>
            <th>ID</th>
            <th>Investor (USD/ZWL)</th>
            <th>Amount Disbursed</th>
            <th>Disbursement Date</th>
            <th>Maturity Date</th>
            <th>Tenure (months)</th>
            <th>Rate (%)</th>
            <th>Signing</th>
            <th class="datatable-nosort">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $authorisation = authorisation("");
        foreach ($authorisation as $data):
            ?>
            <?php
            $authbranch = branch_by_id($data['branchId']);
            $authuser = user($data['userId']);
            ?>

            <tr>
                <td><?php echo date('d-M-Y', strtotime($data['createdAt'])); ?></td>
                <td class="table-plus"><?php echo $authuser['firstName'] . " " . $authuser['lastName']; ?></td>
                <td class="table-plus"><?php echo $data['authLevel']; ?></td>
                <td class="table-plus"><?php echo $data['authLevel']; ?></td>
                <td class="table-plus"><?php echo $data['authLevel']; ?></td>
                <td class="table-plus"><?php echo $data['authLevel']; ?></td>
                <td><?php echo $authbranch['branchName']; ?></td>
                <td>
                    <?php if ($data['branchStatus'] == 1) { ?>
                        <span class="badge badge-success" data-bgcolor="#2DB83D"
                              data-color="#fff"><?php echo "Signed"; ?></span>
                    <?php } else { ?>
                        <span class="badge badge-warning" data-color="#fff"><?php echo "Not Signed"; ?></span>
                    <?php } ?>
                </td>

                <td>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                           role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="treasury_management.php?menu=download_deal_note&id=<?= $data["id"] ?>&generate_deal_note=true"><i class="dw dw-download"></i>Download D.N</a>

                            <a class="dropdown-item" href="treasury_management.php?menu=view_statement&id=<?= $data["id"] ?>"><i class="dw dw-view"></i>View Statement</a>
                            <a class="dropdown-item" href="treasury_management.php?menu=sign_deal_note&id=<?= $data["id"] ?>"><i class="dw dw-writing"></i> Sign Deal Note</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>