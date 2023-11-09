<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">Ticket(s) Signing</h4>

    </div>
    <div class="pb-20 mb-30">
        <table class="table hover table stripe multiple-select-row data-table-export nowrap">
            <thead>
            <tr>
                <th class="table-plus datatable-nosort">Select</th>
                <th>Date Created</th>
                <th>Client Name</th>
                <th>Bsn Name</th>
                <th>Sector</th>
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
                $createDate = new DateTime($date);

                ?>

                <tr>
<!--                    <td>--><?php //= date(htmlspecialchars($ticket["ccDate"]), 'd-M-Y')?><!--</td>-->
                    <td><input type = "checkbox" name="checkArr[]" value="<?php echo $ticket['id'];?>"></td>
                    <td><?= date('d-M-Y', strtotime(htmlspecialchars($ticket["ccDate"]))); ?></td>
                    <td><?= htmlspecialchars ($ticket["firstName"]).' '.htmlspecialchars ($ticket["middleName"]).' '.htmlspecialchars ($ticket["lastName"]) ?></td>
                    <td><?= htmlspecialchars($ticket["businessName"])?></td>
                    <td><?= htmlspecialchars($ticket["industryCode"])?></td>
                    <td><?= '$ ' . number_format($ticket["meetingLoanAmount"], 2, '.', ',') ?></td>
                    <td><?= '$ ' . number_format($ticket["lessFees"], 2, '.', ',') ?></td>
                    <td><?= '$ ' . number_format($ticket["applicationFee"], 2, '.', ',') ?></td>
                    <td><?= '$ ' . number_format($ticket["meetingCashHandlingFee"], 2, '.', ',') ?></td>

                    <td><?= htmlspecialchars($ticket["meetingInterestRate"]." %")?></td>
                    <td><?= htmlspecialchars($ticket["meetingTenure"]).' months' ?></td>
                    <?php if ($_SESSION['role'] =="ROLE_BOCO"){ ?>
                        <td>
                            <?php
                            if ($ticket['bocoSignature'] != "Unsigned" && $ticket['finSignature'] != "Unsigned") {
                                if ($ticket["meetingLoanAmount"] >= 30000) {
                                    if ($ticket['bocoSignature'] != "Unsigned" && $ticket['boardSignature'] != "Unsigned") {
                                        echo "<label style='padding: 7px;' class='badge badge-success'>Ticket Ready</label>";
                                    } else {
                                        echo "<label style='padding: 7px;' class='badge badge-warning'>Waiting for Authorization</label>";
                                    }
                                } else {
                                    echo "<label style='padding: 7px;' class='badge badge-success'>Ticket Ready</label>";
                                }
                            } else if ($ticket['bocoSignature'] != "Unsigned" && $ticket['finSignature'] == "Unsigned") {
                                echo "<label style='padding: 7px;' class='badge badge-warning'>Waiting for Authorization</label>";
                            } else {
                                echo "<label style='padding: 7px;' class='badge badge-dark'>Updating Status</label>";
                            }
                            ?>
                        </td>

                    <?php } else{?>
                        <td><?php if($ticket[$xxSignature] == "Signed" ){
                                echo "<label style='padding: 7px;' class='badge badge-success'>Ticket Signed</label>";}
                            elseif($ticket[$xxSignature] == "Declined") {echo "<label style='padding: 7px;' class='badge badge-primary'>Ticket Declined</label>";}
                            else{echo "<label style='padding: 7px;' class='badge badge-warning'>Waiting for Signature</label>";}?>
                        </td>
                    <?php }?>
                    <td><?php $loan_officer = user(htmlspecialchars ($ticket["assignTo"]));
                        echo $loan_officer['firstName'].' '.$loan_officer['lastName'];?></td>
                    <td><a href = "ticket_info.php?menu=signing&loan_id=<?=$ticket["id"] ?>&userid=<?=$ticket["userId"] ?>" style="color: blue;">View</td>
                </tr>
            <?php endforeach;?>
            <?php
            if ($_SESSION['role'] == 'ROLE_BM'){
                $signed_tickets = loans($ca_decline_ticket);
                foreach($signed_tickets as $ticket):
                    $date = htmlspecialchars ($ticket["createdAt"]);
                    $createDate = new DateTime($date);

                    ?>

                    <tr>
                        <td><input type = "checkbox" name="checkArr[]" value="<?php echo $ticket['id'];?>"></td>
                        <td><?= htmlspecialchars ($ticket["firstName"]).' '.htmlspecialchars ($ticket["middleName"]).' '.htmlspecialchars ($ticket["lastName"]) ?></td>

                        <td><?= '$ ' . number_format($ticket["meetingLoanAmount"], 2, '.', ',') ?></td>
                        <td><?= '$ ' . number_format($ticket["lessFees"], 2, '.', ',') ?></td>
                        <td><?= '$ ' . number_format($ticket["applicationFee"], 2, '.', ',') ?></td>
                        <td><?= '$ ' . number_format($ticket["meetingCashHandlingFee"], 2, '.', ',') ?></td>

                        <td><?= htmlspecialchars($ticket["meetingInterestRate"]." %")?></td>
                        <td><?= htmlspecialchars($ticket["meetingTenure"]).' months' ?></td>
                        <?php if ($_SESSION['role'] =="ROLE_BOCO"){ ?>
                            <td>
                                <?php
                                if ($ticket['bocoSignature'] != "Unsigned" && $ticket['finSignature'] != "Unsigned") {
                                    if ($ticket["meetingLoanAmount"] >= 30000) {
                                        if ($ticket['bocoSignature'] != "Unsigned" && $ticket['boardSignature'] != "Unsigned") {
                                            echo "<label style='padding: 7px;' class='badge badge-success'>Ticket Ready</label>";
                                        } else {
                                            echo "<label style='padding: 7px;' class='badge badge-warning'>Waiting for Authorization</label>";
                                        }
                                    } else {
                                        echo "<label style='padding: 7px;' class='badge badge-success'>Ticket Ready</label>";
                                    }
                                } else if ($ticket['bocoSignature'] != "Unsigned" && $ticket['finSignature'] == "Unsigned") {
                                    echo "<label style='padding: 7px;' class='badge badge-warning'>Waiting for Authorization</label>";
                                } else {
                                    echo "<label style='padding: 7px;' class='badge badge-dark'>Updating Status</label>";
                                }
                                ?>
                            </td>


                        <?php } else{?>
                            <td><?php if($ticket[$xxSignature] == "Signed" ){
                                    echo "<label style='padding: 7px;' class='badge badge-success'>Ticket Signed</label>";}
                                elseif($ticket[$xxSignature] == "Declined") {echo "<label style='padding: 7px;' class='badge badge-primary'>Ticket Declined</label>";}
                                else{echo "<label style='padding: 7px;' class='badge badge-warning'>Waiting for Signature</label>";}?>
                            </td>
                        <?php }?>
                        <td><?php $loan_officer = user(htmlspecialchars ($ticket["assignTo"]));
                            echo $loan_officer['firstName'].' '.$loan_officer['lastName'];?></td>
                        <td><a href = "ticket_info.php?menu=signing&loan_id=<?=$ticket["id"] ?>&userid=<?=$ticket["userId"] ?>" style="color: blue;">View</td>
                    </tr>
                <?php endforeach; }?>
            </tbody>
        </table>
        <form action="" method="post">
            <div style="display: flex; justify-content: end; margin-right: 5%">
                <input class="btn btn-primary btn-lg" type = "submit" value = "Create Ticket" name="generate" id = "submit">
            </div>
        </form>
    </div>

</div>

<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">Unauthorised Ticket(s)</h4>

    </div>
    <div class="pb-20 mb-30">
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
            $signed_tickets = loans($decline_ticket);
            foreach($signed_tickets as $ticket):
                $date = htmlspecialchars ($ticket["createdAt"]);
                $createDate = new DateTime($date);

                ?>

                <tr>
                    <td><input type = "checkbox" name="checkArr[]" value="<?php echo $ticket['id'];?>"></td>
                    <td><?= htmlspecialchars ($ticket["firstName"]).' '.htmlspecialchars ($ticket["middleName"]).' '.htmlspecialchars ($ticket["lastName"]) ?></td>

                    <td><?= '$ ' . number_format($ticket["meetingLoanAmount"], 2, '.', ',') ?></td>
                    <td><?= '$ ' . number_format($ticket["lessFees"], 2, '.', ',') ?></td>
                    <td><?= '$ ' . number_format($ticket["applicationFee"], 2, '.', ',') ?></td>
                    <td><?= '$ ' . number_format($ticket["meetingCashHandlingFee"], 2, '.', ',') ?></td>

                    <td><?= htmlspecialchars($ticket["meetingInterestRate"]." %")?></td>
                    <td><?= htmlspecialchars($ticket["meetingTenure"]).' months' ?></td>
                    <?php if ($_SESSION['role'] =="ROLE_BOCO"){ ?>
                        <td>
                            <?php
                            if ($ticket['bocoSignature'] != "Unsigned" && $ticket['finSignature'] != "Unsigned") {
                                if ($ticket["meetingLoanAmount"] >= 30000) {
                                    if ($ticket['bocoSignature'] != "Unsigned" && $ticket['boardSignature'] != "Unsigned") {
                                        echo "<label style='padding: 7px;' class='badge badge-success'>Ticket Ready</label>";
                                    } else {
                                        echo "<label style='padding: 7px;' class='badge badge-warning'>Waiting for Authorization</label>";
                                    }
                                } else {
                                    echo "<label style='padding: 7px;' class='badge badge-success'>Ticket Ready</label>";
                                }
                            } else if ($ticket['bocoSignature'] != "Unsigned" && $ticket['finSignature'] == "Unsigned") {
                                echo "<label style='padding: 7px;' class='badge badge-warning'>Waiting for Authorization</label>";
                            } else {
                                echo "<label style='padding: 7px;' class='badge badge-dark'>Updating Status</label>";
                            }
                            ?>
                        </td>

                    <?php } else{?>
                        <td><?php if($ticket[$xxSignature] == "Signed" ){
                                echo "<label style='padding: 7px;' class='badge badge-success'>Ticket Signed</label>";}
                            elseif($ticket[$xxSignature] == "Declined") {echo "<label style='padding: 7px;' class='badge badge-primary'>Ticket Awaiting Corrections</label>";}
                            else{echo "<label style='padding: 7px;' class='badge badge-warning'>Waiting for Signature</label>";}?>
                        </td>
                    <?php }?>
                    <td><?php $loan_officer = user(htmlspecialchars ($ticket["assignTo"]));
                        echo $loan_officer['firstName'].' '.$loan_officer['lastName'];?></td>
                    <td><a href = "ticket_info.php?menu=signing&loan_id=<?=$ticket["id"] ?>&userid=<?=$ticket["userId"] ?>" style="color: blue;">View</td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

    </div>

</div>