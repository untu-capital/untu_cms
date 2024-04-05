 <!-- basic table  Start -->
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h4 class="text-blue h4">Loan Officer Productivity</h4>
                <p><code></code></p>
            </div>

        </div>
<!--        <table class="table table-bordered">-->
        <table class="table hover table stripe multiple-select-row data-table-export nowrap">
            <thead>
                <tr>
<!--                    <th>#</th>-->
                    <th scope="col">Date</th>
                    <th scope="col">Applicant Name</th>
                    <th scope="col">Bsn Sector</th>
                    <th scope="col">Repeat/New</th>
                    <th scope="col">Sought Loan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Loan Officer</th>
<!--                    <th scope="col">%age</th>-->
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $i = 1;
            $applicants = lo_pipelines($_SESSION['userId']);
            foreach ($applicants as $data) {?>
                <tr>
                    <td><?php echo date("d-M-Y", strtotime($data['dateRecorded'])); ?></td>
                    <td><?php echo $data['applicant']; ?></td>
                    <td><?php echo $data['sector']; ?></td>
                    <td><?php echo $data['repeatClient']; ?></td>
                    <td><?php echo $data['soughtLoan']; ?></td>
                    <td><?php echo $data['loanStatus']; ?></td>
                    <td><?php $user = user($data['loanOfficer']); echo $user['firstName']." ".$user['lastName']; ?></td>
                    <td>
                        <!-- Large modal -->
                        <div class="col-md-4 col-sm-12 mb-30">
                            <a href="#" class="update-link" data-toggle="modal" data-target="#bd-example-modal-lg-<?php echo $i; ?>">
                                <b>Update</b>
                            </a>
                        </div>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" >
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-4 col-form-label">Applicant</label>
                                        <div class="col-sm-12 col-md-8">
                                            <input class="form-control" type="text" name="applicant" id="applicant" placeholder="<?php echo $data['applicant']; ?>" value="<?php echo $data['applicant']; ?>" required/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-4 col-form-label">Sector</label>
                                        <div class="col-sm-12 col-md-8">
                                            <select class="custom-select2 col-12" name="sector" id="sector" style="width: 100%; height: 38px" required>
                                                <option value="<?php echo $data['sector']; ?>"><?php echo $data['sector']; ?></option>
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
                                        <label class="col-sm-12 col-md-4 col-form-label">Repeat</label>
                                        <div class="col-sm-12 col-md-8">
                                            <select class="custom-select2 col-12" name="repeat_client" id="repeat_client" style="width: 100%; height: 38px" required>
                                                <option value="<?php echo $data['repeatClient']; ?>"><?php echo $data['repeatClient']; ?></option>
                                                <option value="New">New</option>
                                                <option value="Repeat">Repeat</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-4 col-form-label">Sought Loan (USD $)</label>
                                        <div class="col-sm-12 col-md-8">
                                            <input class="form-control" type="number" name="sought_loan" id="sought_loan" placeholder="<?php echo $data['soughtLoan']; ?>" value="<?php echo $data['soughtLoan'];?>" required/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-4 col-form-label">Loan Status</label>
                                        <div class="col-sm-12 col-md-8">
                                            <select class="custom-select2 col-12" name="loan_status" id="loan_status" style="width: 100%; height: 38px" required>
                                                <option value="<?php echo $data['loanStatus']; ?>"><?php echo $data['loanStatus']; ?></option>
                                                <option value="Prospect">Prospect</option>
                                                <option value="Assessment">Assessment</option>
                                                <option value="Pending Disbursement">Pending Disbursement</option>
                                                <option value="Disbursement">Disbursed</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" hidden>
                                        <label class="col-sm-12 col-md-4 col-form-label">Loan Officer</label>
                                        <div class="col-sm-12 col-md-8">
                                            <input class="form-control" type="text" name="loan_officer" id="loan_officer" placeholder="<?php echo $user['firstName']." ".$user['lastName'];?>" value="<?php echo $data['loanOfficer']?>" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-4 col-form-label"></label>
                                        <div class="col-sm-12 col-md-8">
                                            <input class="form-control" type="hidden" name="pipeline_id" value="<?php echo $data['id']?>" />
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" value="Submit" name="update_pipeline">Save changes</button>
<!--                                            <button type="submit" class="btn btn-danger" value="Submit" name="update_pipeline">Submit</button>-->
                                        </div>

                                </form>
                            </div>
<!--                            <div class="modal-footer">-->
<!--                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                                <button type="button" class="btn btn-primary">Save changes</button>-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>
                <?php $i++; } ?>
            </tbody>

        </table>
    </div>
    <!-- basic table  End -->