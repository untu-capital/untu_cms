 <!-- basic table  Start -->
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h4 class="text-blue h4">Loan Officer Productivity</h4>
                <p><code></code></p>
            </div>

        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Applicant Name</th>
                    <th scope="col">Bsn Sector</th>
                    <th scope="col">Repeat/New</th>
                    <th scope="col">Sought Loan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Loan Officer</th>
                    <th scope="col">Branch Name</th>
<!--                    <th scope="col">Action</th>-->
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i =1;
                    $applicants = '';
                    if ($_SESSION['role'] == "ROLE_BM"){
                        $applicants = branch_pipeline_report(str_replace(' ','%20',$_SESSION['branch']));
                    } else {
                        $applicants = applicants();
                    }

                    foreach ($applicants as $data) {?>
                        <tr>
                        <td><?php echo date("d-M-Y", strtotime($data['createdAt'])); ?></td>
                        <td><?php echo $data['applicant']; ?></td>
                        <td><?php echo $data['sector']; ?></td>
                        <td><?php echo $data['repeatClient']; ?></td>
                        <td><?php echo $data['soughtLoan']; ?></td>
                        <td><?php echo $data['loanStatus']; ?></td>
                        <td>
                            <?php
                            $user = user($data['loanOfficer']);
                            echo $user['firstName']." ".$user['lastName']; ?>
                        </td>
                            <td><?php echo $data['branchName']; ?></td>
                        </tr>
                    <?php $i++; } ?>
            </tbody>
        </table>
    </div>
    <!-- basic table  End -->