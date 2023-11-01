<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">Manage Disbursement Tickets</h4>

    </div>
    <div class="pb-20 mb-30">
        <form action="" method="post">
            <table class="table hover table stripe multiple-select-row data-table-export nowrap">
                <thead>
                <tr>
                    <th class="table-plus datatable-nosort">Select</th>
                    <th>Client Name</th>
                    <th>Loan Amount</th>
                    <th>Less Fees</th>
                    <th>Application Fee</th>
                    <th>Cash Handling Fee</th>
                    <th>Interest(%)</th>
                    <th>Tenure</th>
                    <th>Status</th>
                    <th>Loan Officer: </th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $signed_tickets = loans($sign_ticket);
                foreach($signed_tickets as $ticket):
                    $date = htmlspecialchars ($ticket["createdAt"]);
                    $createDate = new DateTime($date); ?>
                    <tr>
                        <td><input type = "checkbox" name="checkArr[]" value="<?php echo $ticket['id'];?>"></td>
                        <td><?= htmlspecialchars ($ticket["firstName"]).' '.htmlspecialchars ($ticket["middleName"]).' '.htmlspecialchars ($ticket["lastName"]) ?></td>
                        <td><?= '$ '.htmlspecialchars ($ticket["meetingLoanAmount"] ).'.00'?></td>
                        <td><?= htmlspecialchars($ticket["lessFees"])?></td>
                        <td><?= htmlspecialchars($ticket["applicationFee"])?></td>
                        <td><?= htmlspecialchars($ticket["meetingCashHandlingFee"])?></td>
                        <td><?= htmlspecialchars($ticket["meetingInterestRate"]." %")?></td>
                        <td><?= htmlspecialchars($ticket["meetingTenure"]).' months' ?></td>
                        <td><?php if($ticket[$xxSignature] == "Signed" ){
                                echo "<label style='padding: 7px;' class='badge badge-success'>Ticket Signed</label>";}
                            elseif($ticket[$xxSignature ] == "Unsigned") {echo "<label style='padding: 7px;' class='badge badge-primary'>Ticket Reverted</label>";}
                            else{echo "<label style='padding: 7px;' class='badge badge-warning'>Waiting for Signature</label>";}?>
                        </td>
                        <td><?php $loan_officer = user(htmlspecialchars ($ticket["assignTo"]));
                            echo $loan_officer['firstName'].' '.$loan_officer['lastName'];?></td>
                        <td><a href = "ticket_info.php?menu=signing&loan_id=<?=$ticket["id"] ?>&userid=<?=$ticket["userId"] ?>" style="color: blue;">View</td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <input class="form-control" type="hidden" name="userId" required value="<?php echo $_SESSION['userid'] ?>">
            <input class="form-control" type="hidden" name="fullName" required value="<?php echo $_SESSION['fullname'] ?>">

            <div style="display: flex; justify-content: flex-end; margin-right: 5%">
                <div class="custom-control custom-radio mb-5" style="display: flex; flex-direction: column; align-items: flex-start; margin-right: 10px;">
                    <div>
                        <input class="custom-control-input" type="radio" id="authorise" name="<?php echo $xxSignature ?>" value="Signed" onclick="enableButton()">
                        <label class="custom-control-label" for="authorise">Authorise</label>
                    </div>
                    <div>
                        <input class="custom-control-input" type="radio" id="decline" name="<?php echo $xxSignature ?>" value="Unsigned" onclick="enableButton()">
                        <label class="custom-control-label" for="decline">Revert</label>
                    </div>
                </div>
                <button class="btn btn-success" id="submitBtn" type="submit" name="<?php echo $xx_sign_ticket ?>" disabled>Sign Ticket(s)</button>
            </div>

            <script>
                function enableButton() {
                    const authorise = document.getElementById('authorise');
                    const decline = document.getElementById('decline');
                    const submitBtn = document.getElementById('submitBtn');

                    if (authorise.checked || decline.checked) {
                        submitBtn.disabled = false;
                    } else {
                        submitBtn.disabled = true;
                    }
                }
            </script>
        </form>
    </div>

</div>