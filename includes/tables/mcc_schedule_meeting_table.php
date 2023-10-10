<!-- table widget -->

<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">
            Conducted Meeting(s)
        </h4>
    </div>
    <div class="pb-20">
        <table class="data-table table stripe hover multiple-select-row nowrap">
            <thead>
            <tr>
                <th>Applied On</th>
                <th>Name</th>
                <th>Bsn Sector</th>
                <th>Loan Amount</th>
                <th>Tenure</th>
                <th>Boco</th>
                <th>Loan Officer</th>
                <th>Stage</th>
                <th class="datatable-nosort">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $mcc_schedule_meeting = loans($final_meeting);
            foreach ($mcc_schedule_meeting as $schedule):
                // Define the role-specific criteria
                $displayRow = false;

                if ($_SESSION['role'] == "ROLE_BOARD" && $schedule['meetingLoanAmount'] >= 20000) {
                    $displayRow = true;
                } elseif ($_SESSION['role'] == "ROLE_CA" && $schedule['meetingLoanAmount'] <= 8000) {
                    $displayRow = true;
                } elseif ($_SESSION['role'] == "ROLE_OP" && $schedule['meetingLoanAmount'] > 8000 && $schedule['meetingLoanAmount'] < 20000) {
                    $displayRow = true;
                }

                if ($displayRow):
                    ?>
                    <tr>
                        <td><?php echo convertDateFormat($schedule['createdAt']); ?></td>
                        <td class="table-plus"><?php echo $schedule['firstName']; ?> <?php echo $schedule['lastName']; ?></td>
                        <td><?php echo $schedule['industryCode']; ?></td>
                        <td><?php echo "$ " . $schedule['meetingLoanAmount'] . ".00"; ?></td>
                        <td><?php echo $schedule['meetingTenure'] . " months"; ?></td>
                        <td>
                            <?php
                            $boco = user($schedule['loanStatusAssigner']);
                            echo $boco['firstName'] . " " . $boco['lastName'];
                            ?>
                        </td>
                        <td><?php echo $schedule['processedBy']; ?></td>
                        <td><?php echo $schedule['pipelineStatus']; ?></td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="loan_info.php?menu=mcc_final&loan_id=<?php echo $schedule['id']; ?>&userid=<?php echo $schedule['userId']; ?>"><i class="dw dw-note"></i>Schedule Meeting</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
                endif;
            endforeach;
            ?>
            </tbody>
        </table>



    </div>
</div>
<?php if ($_SESSION['role'] == "ROLE_CA" && $escalated_meeting !=""){ ?>
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">
                Escalated Application to MCC
            </h4>
        </div>
        <div class="pb-20">
            <table class="data-table table stripe hover multiple-select-row nowrap">
                <thead>
                    <tr>
                        <th>Applied On</th>
                        <th>Name</th>
                        <th>Bsn Sector</th>
                        <th>Loan Amount</th>
                        <th>Tenure</th>
                        <th>Boco</th>
                        <th>Loan Officer</th>
                        <th>Stage</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $mcc_schedule_meeting = loans($escalated_meeting);
                        foreach ($mcc_schedule_meeting as $schedule): ?>
                    <tr>
                        <td><?php echo convertDateFormat($schedule['createdAt']); ?></td>
                        <td class="table-plus"><?php echo $schedule['firstName']; ?> <?php echo $schedule['lastName']; ?></td>
                        <td><?php echo $schedule['industryCode']; ?></td>
                        <td><?php echo "$ ".$schedule['meetingLoanAmount'].".00"; ?></td>
                        <td><?php echo $schedule['meetingTenure']." months"; ?></td>
                        <td><?php $boco = user($schedule['loanStatusAssigner']);
                            echo $boco['firstName']." ".$boco['lastName'];
    //                        echo $schedule['loanStatusAssigner']; ?><!--</td>-->
                        <td><?php echo $schedule['processedBy']; ?></td>
<!--                        <td>--><?php //echo $schedule['pipelineStatus']; ?><!--</td>-->
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="loan_info.php?menu=mcc_final&loan_id=<?php echo $schedule['id']; ?>&userid=<?php echo $schedule['userId'] ;?>"><i class="dw dw-note"></i>Schedule Meeting</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php }?>
