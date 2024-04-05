
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Loan Information</h4>
            <p class="mb-30">Loan Pipeline Record</p>
        </div>

    </div>
    <form action="" method="post" >
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Applicant</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="applicant" id="applicant" placeholder="Full Name" required/>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Sector</label>
            <div class="col-sm-12 col-md-10">
                <select class="custom-select2 col-12" name="sector" id="sector" style="width: 100%; height: 38px" required>
                    <option value="">Select Sector</option>
                    <?php
                    $bsn_sector = bsn_sector();
                    foreach ($bsn_sector as $bsn) {
                        echo "<option value='$bsn[name]'>$bsn[name]</option>";
                    }
                    ?>

                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Repeat</label>
            <div class="col-sm-12 col-md-10">
                <select class="custom-select2 col-12" name="repeat_client" id="repeat_client" style="width: 100%; height: 38px" required>
                    <option value="New">New</option>
                    <option value="Repeat">Repeat</option>

                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Sought Loan (USD $)</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="number" name="sought_loan" id="sought_loan" placeholder="1000" required/>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Loan Status</label>
            <div class="col-sm-12 col-md-10">
                <select class="custom-select2 col-12" name="loan_status" id="loan_status" style="width: 100%; height: 38px" required>
                    <option value="Prospect">Prospect</option>
                    <option value="Assessment">Assessment</option>
                    <option value="Pending Disbursement">Pending Disbursement</option>
                    <option value="Disbursement">Disbursed</option>
                </select>
            </div>
        </div>

        <div class="form-group row" hidden="hidden">
            <label class="col-sm-12 col-md-2 col-form-label">Loan Officer</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="loan_officer" id="loan_officer" placeholder="<?php echo $_SESSION['userId']?>" value="<?php echo $_SESSION['userId']?>" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"></label>
            <div class="col-sm-12 col-md-10">
                <button type="submit" class="btn btn-danger" value="Submit" name="add_to_pipeline">Submit</button>
            </div>

    </form>

</div>