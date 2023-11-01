<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">Manage Pre-disbursement Tickets</h4>

    </div>
    <form method="post" action="">
    <div class="pb-20">
        <table class="table hover table stripe multiple-select-row data-table-export nowrap">
            <thead>
            <tr>
                <th class="table-plus datatable-nosort">Select</th>
                <th>Applied On: </th>
                <th>Full name</th>
                <th>Loan Amount</th>
<!--                <th>Approved Loan Amount</th>-->
                <th>Tenure</th>
<!--                <th>Approved Tenure Period</th>-->
                <th>Status</th>
                <th>Loan Officer: </th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $predisbursements = loans($predisbursement_ticket);
            foreach($predisbursements as $ticket):
                $date = htmlspecialchars ($ticket["createdAt"]);
                $createDate = new DateTime($date); ?>

                <tr>
                    <td><input type ="checkbox" name="checkArr[]" id="customCheck2-1" value="<?php echo $ticket['id'];?>"></td>
                    <td><?= $createDate->format('d-M-Y') ?></td>
                    <td><?= htmlspecialchars ($ticket["firstName"]).' '.htmlspecialchars ($ticket["middleName"]).' '.htmlspecialchars ($ticket["lastName"]) ?></td>
<!--                    <td>--><?php //= '$' . number_format(htmlspecialchars ($ticket["loanAmount"] ), 2, '.', ',');?><!--</td>-->
                    <td><?= '$' . number_format(htmlspecialchars ($ticket["meetingLoanAmount"] ), 2, '.', ',');?></td>
<!--                    <td>--><?php //= htmlspecialchars($ticket["tenure"]).' months' ?><!--</td>-->
                    <td><?= htmlspecialchars($ticket["meetingTenure"]).' months' ?></td>
<!--                    --><?php //if ($_SESSION['role'] == "ROLE_BOCO"){ ?>
                    <td><?php if($ticket['lessFees'] != "" && $ticket['applicationFee'] != ""){
                            echo "<label style='padding: 7px;' class='badge badge-success'>File Ready</label>";}
                        else if($ticket['lessFees'] == "" && $ticket['applicationFee'] == ""){
                            echo "<label style='padding: 7px;' class='badge badge-danger'>File Not Ready</label>";}
                        else{
                            echo "<label style='padding: 7px;' class='badge badge-warning'>Unchecked</label>";
                        }?>
                    </td>
<!--                    --><?php //}elseif($_SESSION['role'] == "ROLE_BM"){?>
<!--                        <td>--><?php //if($ticket['bmSignature'] == "Signed" ){
//                                echo "<label style='padding: 7px;' class='badge badge-success'>Ticket Signed</label>";}
//                            elseif($ticket['bmSignature'] == "Declined") {echo "<label style='padding: 7px;' class='badge badge-primary'>Ticket Declined</label>";}
//                            else{echo "<label style='padding: 7px;' class='badge badge-warning'>Waiting for Signature</label>";}?><!--</td>-->
<!--                    --><?php //} ?>

                    <td><?php $loan_officer = user(htmlspecialchars ($ticket["assignTo"]));
                        echo $loan_officer['firstName'].' '.$loan_officer['lastName'];?></td>
                    <td><a href = "loan_info.php?menu=predisbursement&loan_id=<?=$ticket["id"] ?>&userid=<?=$ticket["userId"] ?>" style="color: blue;">View</td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <input class="form-control" type="hidden" name="userId" required value="<?php echo $_SESSION['userId'] ?>">
    <input class="form-control" type="hidden" name="fullName" required value="<?php echo $_SESSION['fullname'] ?>">
    <input class="form-control" type="hidden" name="bocoSignature" required value="Signed">
        <div style="display: flex; justify-content: end; margin-right: 5%">
            <button class="btn btn-success btn-lg text-right mb-20" type ="submit" name="sign_ticket" id ="submit">Sign Ticket</button>
        </div>
</form>
</div>