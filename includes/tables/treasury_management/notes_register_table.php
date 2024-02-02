<?php

//    include('../../../includes/fpdf/fpdf.php');
?>

<div class="pd-20">
    <button class="btn btn-lg btn-primary" type="submit" name="add_deal_note" id="showFormButton"
            style="margin-bottom: 15px;">Create Deal Note
    </button>
    <div class="pd-20 card-box mb-30">
        <form action="" method="POST" id="myForm">
            <div class="clearfix">
                <h4 class="text-blue h4">Generate Deal Note</h4>
            </div>
            <div class="row">
                <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                        <label>Counterparty:</label>
                        <select class="custom-select2 form-control" name="counterparty"
                                style="width: 100%; height: 38px">
                            <option value="">Select Counterparty</option>
                            <?php
                            $branches = branch();
                            foreach ($branches as $branch) {
                                echo "<option value='$branch[id]'>$branch[branchName] Branch</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="form-group">
                        <label>Amount :<i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                        <input class="form-control" type="number" name="amount">
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>PA Status</label>
                        <select class="custom-select2 form-control" name="pa_status" style="width: 100%; height: 38px">
                            <option value="">Select Status</option>
                            <option value="yes">YES</option>
                            <option value="no">NO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Start Date: <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                        <div class="form-group row">
                            <div class="col">
                                <input class="form-control datetimepicker" placeholder="Select Start Date" type="text"
                                       name="start_date"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Tenure (months):<i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                        <input class="form-control" type="number" name="tenure">
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Interest Rate (%) :<i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                        <input class="form-control" type="number" name="interest_rate">
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Coupon Payment : <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                        <select class="custom-select2 form-control" name="coupon_payment"
                                style="width: 100%; height: 38px">
                            <option value="">Select Payment Method</option>
                            <option value="quarterly">Quarterly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Coupon Amount: <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                        <input class="form-control" placeholder="" type="number" name="coupon_amount"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Principal : <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                        <select class="custom-select2 form-control" name="principal" style="width: 100%; height: 38px">
                            <option value="">Select Option</option>
                            <option value="#">Bullet payment at Maturity</option>
                            <option value="#">Bullet payment at Maturity</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="form-group">
                        <label>Coupon Dates : </label>
                        <textarea type="text" name="coupon_dates" placeholder="[ Dates are auto generated ]"
                                  class="form-control" disabled></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" value="auth" name="auth">Submit</button>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" onclick="goBack()">Cancel</button>
                    </div>
                </div>
            </div>
        </form>

        <script>
            // Get references to the button and form
            var showFormButton = document.getElementById("showFormButton");
            var myForm = document.getElementById("myForm");

            // Add a click event listener to the button
            showFormButton.addEventListener("click", function () {
                // Show the form by changing its display style
                myForm.style.display = "block";
            });
        </script>

        <script>
            // JavaScript function to go back to the previous page
            function goBack() {
                window.history.back();
            }
        </script

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
<!--    <form action="" method="post">-->
<!--        <div style="display: flex; justify-content: end; margin-right: 5%">-->
<!--            <input class="btn btn-primary btn-lg" type="submit" value="Download Deal Note" name="generate_deal_note" id="submit">-->
<!--        </div>-->
<!--    </form>-->

</div>