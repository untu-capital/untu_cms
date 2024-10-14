
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h3 class="mb-20">Liability added Succesfully!</h3>
                <div class="mb-30 text-center">
                    <img src="../vendors/images/success.png"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-4">
                    <div class="input-group mb-0">
                        <a class="btn btn-danger btn-lg btn-block" href="treasury_management.php?menu=main">Ok</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <h4 class="text-blue h4">Liability Form</h4>
    </div>
    <div class="wizard-content">

        <form action="" method="POST">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Counterparty:</label>
                        <select class="custom-select2 form-control" name="counterparty"
                                style="width: 100%; height: 38px">
                            <option value="">Select Counterparty</option>
                            <?php
                            $counterparties = customer_list();
                            foreach ($counterparties as $counterparty) {
                                echo "<option value='$counterparty[name]'>$counterparty[name]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label>Type of Liability</label>
                        <select class="custom-select2 form-control" name="liability" id="liability" style="width: 100%; height: 38px" required>
                            <option value="MTN">MTN</option>
                            <option value="RECEIVABLE">Receivable</option>
                            <option value="SHORT_TERM_DEBT">Short Term Debt</option>
                            <option value="LONG_TERM_DEBT">Long Term Debt</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>PA Status</label>
                        <select class="custom-select2 form-control" name="pa_status" style="width: 100%; height: 38px">
                            <option value="">Select Status</option>
                            <option value="YES">YES</option>
                            <option value="NO">NO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Start Date: <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                                <input class="form-control date-picker" placeholder="Select Start Date" type="text" name="start_date" required/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Currency ($)</label>
                        <select class="custom-select2 form-control" name="currency" id="currency"
                                style="width: 100%; height: 38px" required>
<!--                            <option value=null>Select Option</option>-->
                            <option value="USD">USD</option>
                            <option value="ZIG">ZiG</option>
                        </select>
                    </div>
                </div>


                <div class="col-md-2 col-sm-6">
                    <div class="form-group">
                        <label>Invested Amount :<i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                        <input class="form-control" type="number" name="amount" required>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Tenor (days):<i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                        <input class="form-control" type="number" name="tenure">
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Interest Rate (%) :<i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                        <input class="form-control" type="number" step="0.01" name="interest_rate">
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Interest Frequency:<i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                        <select class="custom-select2 form-control" name="interest_frequency" id="interest_frequency" style="width: 100%; height: 38px" required>
                            <option value="YEARLY">Yearly</option>
                            <option value="MONTHLY">Monthly</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Revolving</label>
                        <select class="custom-select2 form-control" name="revolving" id="revolving"
                                style="width: 100%; height: 38px" required>
                            <option value="">Select Option</option>
                            <option value="YES">Yes</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Principal Repayment Type</label>
                        <select class="custom-select2 form-control" name="principal_repayment" id="principal_repayment"
                                style="width: 100%; height: 38px" required>
                            <option value="MONTHLY">Monthly</option>
                            <option value="QUARTERLY">Quarterly</option>
                            <option value="MATURITY">At Maturity</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Interest Repayment Type</label>
                        <select class="custom-select2 form-control" name="interest_repayment" id="interest-repayment" style="width: 100%; height: 38px" required>
                            <option value=null>Select Option</option>
                            <option value="MONTHLY">Monthly</option>
                            <option value="QUARTERLY">Quarterly</option>
                            <option value="MATURITY">Maturity</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Repayment Date</label>
                        <input type="text" class="form-control date-picker" name="repayment_date" id="maturity_date" readonly required>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Maturity Date</label>
                        <input type="text" class="form-control date-picker" name="maturity_date" id="maturity_date" readonly required>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <p><strong class="weight-600">Other Features</strong></p>
                        <input type="file" id="myFile" name="other_features">
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block" value="Submit" name="create_liability">CREATE LIABILITY</button>
                </div>
            </div>
        </form>

    </div>
</div>

<div class="pd-20 card-box mb-30">
    <?php include('../includes/tables/treasury_management/liabilities_table.php'); ?>
</div>









