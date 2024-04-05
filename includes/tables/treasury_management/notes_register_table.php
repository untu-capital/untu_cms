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
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Select Liability:</label>
                        <select class="custom-select2 form-control" name="liabilities" style="width: 100%; height: 38px">
                            <option value=""></option>
                            <?php
                            $deal_notes = liabilities_list();
                            foreach ($deal_notes as $data) {
                                echo "<option value='$data[id]'>$data[counterpart] - $data[liabilityType] </option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="form-group">
                        <label>Coupon Dates : </label>
                        <textarea type="text" name="coupon_dates" placeholder="[ Dates are auto generated ]" class="form-control" disabled></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" value="auth" name="create_deal_note">Submit</button>
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
        </script>

    </div>

    <table class="table hover table stripe multiple-select-row data-table-export nowrap">
        <thead>
        <tr>
<!--            <th>ID</th>-->
            <th>Investor</th>
            <th>Amount Disbursed</th>
            <th>Start Date</th>
            <th>Tenure</th>
            <th>Interest Rate (%)</th>
            <th>Coupon Payment</th>
            <th>Coupon Amount</th>
            <th>Principal</th>
            <th>Finance</th>
            <th>CEO</th>
            <th>Coupon Dates</th>
            <th class="datatable-nosort">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $deal_notes = deal_notes();
        foreach ($deal_notes as $data):
            ?>

            <tr>
<!--                <td>--><?php //echo date('d-M-Y', strtotime($data['createdAt'])); ?><!--</td>-->
                <td class="table-plus"><?php echo $data['counterParty'] . ' (' . $data['currency'] . ')'; ?></td>
                <td class="table-plus"><?php echo '$ '.number_format($data['amount'], 2); ?></td>
                <td class="table-plus"><?php echo $data['startDate']; ?></td>
                <td class="table-plus"><?php echo $data['tenure'].' Days'; ?></td>
                <td class="table-plus"><?php echo $data['interestRate']; ?></td>
                <td class="table-plus"><?php echo $data['couponPayment']; ?></td>
                <td class="table-plus"><?php echo '$ '.number_format($data['couponAmount'], 2); ?></td>
                <td class="table-plus"><?php echo $data['principal']; ?></td>
                <td>
                    <?php if ($data['finance_signing'] == "SIGNED") { ?>
                        <span class="badge badge-success" data-bgcolor="#2DB83D"
                              data-color="#fff"><?php echo "Signed"; ?></span>
                    <?php } elseif ($data['finance_signing'] == "DECLINED"){ ?>
                        <span class="badge badge-danger" data-color="#fff"><?php echo "Deal Note Declined"; ?></span>
                   <?php }else { ?>
                        <span class="badge badge-warning" data-color="#fff"><?php echo "Waiting for Signature"; ?></span>
                    <?php } ?>
                </td>
                <td>
                    <?php if ($data['ceo_signing'] == "SIGNED") { ?>
                        <span class="badge badge-success" data-bgcolor="#2DB83D"
                              data-color="#fff"><?php echo "Signed"; ?></span>
                    <?php } elseif ($data['ceo_signing'] == "DECLINED"){ ?>
                        <span class="badge badge-danger" data-color="#fff"><?php echo "Deal Note Declined"; ?></span>
                   <?php }else { ?>
                        <span class="badge badge-warning" data-color="#fff"><?php echo "Waiting for Signature"; ?></span>
                    <?php } ?>
                </td>

                <td class="table-plus">
                    <?php foreach ($data['couponDates'] as $date): ?>
                        <?php echo date('Y-m-d', strtotime($date)); ?><br>
                    <?php endforeach; ?>
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