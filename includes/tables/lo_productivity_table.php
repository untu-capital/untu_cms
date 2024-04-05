<!-- basic table  Start -->
<div class="pd-20 card-box mb-30">
    <div class="clearfix mb-20">
        <div class="pull-left">
            <h4 class="text-blue h4">Loan Officer Productivity</h4>
            <p><code></code></p>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Branch</th>
                <th scope="col">Loan Officer</th>
                <th scope="col">Disbursed</th>
                <th scope="col">Pipeline Cases</th>
                <th scope="col">Total</th>
                <th scope="col">Average Target</th>
                <th scope="col">Variance</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $cnt = 1;
        $productivity_reports = lo_productivity_report();
        foreach ($productivity_reports as $productivity) {
            // Check if the user role is ROLE_BM and branch name matches with session branch
            if ($_SESSION['role'] === "ROLE_BM" ) {
                if ($productivity['branchName'] === $_SESSION['branch']){
                ?>
                <tr>
                    <th scope="row"><?php echo $cnt; ?></th>
                    <td><?php echo $productivity['branchName']; ?></td>
                    <td>
                        <?php
                        $user = user($productivity['loanOfficer']);
                        echo $user['firstName'] . ' ' . $user['lastName'];
                        ?>
                    </td>
                    <td><?php echo $productivity['disbursed']; ?></td>
                    <td><?php echo $productivity['pipelineCases']; ?></td>
                    <td><?php echo $productivity['total']; ?></td>
                    <td><?php echo $productivity['averageTarget']; ?></td>
                    <td><?php echo $productivity['variance']; ?></td>
                </tr>
                <?php
                $cnt++;
            } } else {
                // If the condition is not met, print all <tr> elements
                ?>
                <tr>
                    <th scope="row"><?php echo $cnt; ?></th>
                    <td><?php echo $productivity['branchName']; ?></td>
                    <td>
                        <?php
                        $user = user($productivity['loanOfficer']);
                        echo $user['firstName'] . ' ' . $user['lastName'];
                        ?>
                    </td>
                    <td><?php echo $productivity['disbursed']; ?></td>
                    <td><?php echo $productivity['pipelineCases']; ?></td>
                    <td><?php echo $productivity['total']; ?></td>
                    <td><?php echo $productivity['averageTarget']; ?></td>
                    <td><?php echo $productivity['variance']; ?></td>
                </tr>
                <?php
                $cnt++;
            }
        }
        ?>
        </tbody>

    </table>
    <div class="collapse collapse-box" id="basic-table">
        <div class="code-box">
            <div class="clearfix">
                <a
                    href="javascript:;"
                    class="btn btn-primary btn-sm code-copy pull-left"
                    data-clipboard-target="#basic-table-code"
                    ><i class="fa fa-clipboard"></i> Copy Code</a
                >
                <a
                    href="#basic-table"
                    class="btn btn-primary btn-sm pull-right"
                    rel="content-y"
                    data-toggle="collapse"
                    role="button"
                    ><i class="fa fa-eye-slash"></i> Hide Code</a
                >
            </div>
            <pre><code class="xml copy-pre" id="basic-table-code">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                    </tr>
                    </tbody>
                </table>
            </code></pre>
        </div>
    </div>
</div>
<!-- basic table  End -->