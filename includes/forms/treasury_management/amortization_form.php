
<div class="pd-20">
<!--    <button class="btn btn-lg btn-primary" type="submit" name="generate_amortization" id="showAmoFormButton"-->
<!--            style="margin-bottom: 15px;">Generate Amortisation Schedule-->
<!--    </button>-->
    <div class="pd-20 card-box mb-30">
        <form action="../includes/forms/treasury_management/amortization_pdf.php" method="POST" id="myAmoForm">
            <div class="clearfix">
                <h4 class="text-blue h4">Amortisation Schedule</h4>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Select Currency:</label>
                        <select class="custom-select2 form-control" name="currency" style="width: 100%; height: 38px">
                            <option value="USD">USD</option>
                            <option value="ZIG">ZiG</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Loan Size ($)</label>
                        <input type="number" class="form-control" name="amount" id="amount" required>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Interest Rate (%)</label>
                        <input type="number" class="form-control" name="interest" id="interest" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <label></label>
                    <select class="custom-select2 form-control" name="period" style="width: 100%; height: 38px">
                        <option value="annum">Per Year</option>
                        <option value="month">Per Month</option>
                        <option value="quarter">Per Quarter</option>
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">

                    <div class="form-group">
                        <label>Repayment Every:</label>
                        <input type="hidden" class="form-control" placeholder="1" value="1" name="repayment" id="repayment" required readonly>
                        <select class="custom-select2 form-control" name="repayments" style="width: 100%; height: 38px" required>
                            <option value="quarterly">Quarter</option>
                            <option value="yearly">Year</option>
                            <option value="monthly">Month</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Tenor (In Days):</label>
                            <input type="number" class="form-control" placeholder="Enter loan term" name="tenure" id="tenure" required>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Disbursement Date</label>
                        <input type="date" class="form-control" name="startDate" id="startDate" required>
                    </div>
                </div>

                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" value="amortisation" name="create_amortisation">Generate amortisation</button>
                </div>
            </div>
        </form>

    </div>
<!---->
<!--    <table class="table hover table stripe multiple-select-row data-table-export nowrap">-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th></th>-->
<!--            <th></th>-->
<!--            <th></th>-->
<!--            <th>Note Amount And</th>-->
<!--            <th> Balance</th>-->
<!--            <th>Total Cost of Note</th>-->
<!--            <th></th>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <th>#</th>-->
<!--            <th>Date</th>-->
<!--            <th># Days</th>-->
<!--            <th>Principal Bal</th>-->
<!--            <th>Principal Due</th>-->
<!--            <th>Interest Due</th>-->
<!--            <th>Repayment Due</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--            --><?php
//            // Check if amortization data is available
//            if (isset($amortisation_data['periods'])) {
//
//                foreach ($amortisation_data['periods'] as $period) {
//                    echo "<tr>";
//                    echo "<td>" . $period['period'] . "</td>";
//                    echo "<td>" . $period['date'] . "</td>";
//                    echo "<td>" . $period['days'] . "</td>";
//                    echo "<td>" . $period['principalBalance'] . "</td>";
//                    echo "<td>" . $period['principalDue'] . "</td>";
//                    echo "<td>" . $period['interestDue'] . "</td>";
//                    echo "<td>" . $period['repaymentDue'] . "</td>";
//                    echo "</tr>";
//                }
//            }
//            ?>
<!--        </tbody>-->
<!--    </table>-->

</div>