<div class="invoice-wrap pd-30">
    <div class="invoice-box">
        <div class="invoice-header">
            <div class="row">
                <div class="col">
                    <br>
                    <p class="font-16 mb-5">
                        <strong class="weight-600">Untu Capital Limited <br> Harare </strong>
                    </p>
                </div>
                <div class="col text-center">
                    <div class="logo" style="width: 60%; height: 60%">
                        <img src="../vendors/images/logo.PNG" alt="" class="mx-auto d-block" />
                    </div>
                </div>

                <div class="col">
                    <br>
                    <p class="font-16 mb-5">
                        <strong class="weight-600">NLAC-009 </strong>
                    </p>
                </div>
            </div>
        </div>

        <?php $deal_note = deal_note($_GET['id']); ?>

        <!--                    <h4 class="text-center mb-30 weight-600">INVOICE</h4>-->
        <div class="row pb-30">
            <div class="col-md-5">
                <h5 class="mb-15"><?php echo $deal_note['liabilityType'] ?></h5>
                <p class="font-14 mb-5">
                    Investment Type : &nbsp;<strong class="weight-600">Fixed Rate Note</strong>
                </p>
                <p class="font-14 mb-5">
                    Interest Rate : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <strong class="weight-600"><?php echo $deal_note['interestRate'].' %' ?></strong>
                </p>
            </div>
            <div class="col-md-7">
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-left">
                            <p class="font-14 mb-5">Print Date</p>
                            <p class="font-14 mb-5">Account Name</p>
                            <p class="font-14 mb-5">Currency</p>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="text-right">
                            <p class="font-14 mb-5"><?php echo date("d.m.Y") ?></p>
                            <p class="font-14 mb-5"><strong class="weight-600"><?php echo $deal_note['counterParty'] ?></strong></p>
                            <p class="font-14 mb-5"><?php echo $deal_note['currency'] ?></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="invoice-desc pb-30">
            <table class="table ">
                <thead>
                <tr class="invoice-desc-head">
                    <th>Date</th>
                    <th>Transaction Type</th>
                    <th>Credit (USD)</th>
                    <th>Debit (USD)</th>
                    <th>Balance (USD)</th>
                </tr>
                </thead>
                <tbody>
                <?php $statements = note_investment_statement($_GET['id']);
                $total_debit = 0;
                    foreach ($statements as $statement){
                        $total_debit += $statement['debit']; ?>
                        <tr>
                            <td><?php
                                $date = DateTime::createFromFormat('Y-m-d', $statement['date'] ?? "")->format('d-M-Y') ?? null;
                                echo $date; ?></td>
                            <td><?php echo $statement['transactionType']; ?></td>
                            <td><?php echo $statement['credit']; ?></td>
                            <td><?php echo $statement['debit']; ?></td>
                            <td><?php echo $statement['balance']; ?></td>
                        </tr>
                <?php } ?>
                <tr>
                    <td class="table-plus"><strong class="weight-600">Closing Balance</strong></td>
                    <td></td>
                    <td><span class="weight-600" style="border-bottom: 3px double #000; display: inline-block;"><?php echo $statement['balance']; ?></span></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>

            <!--                        <br>-->
            <p class="font-18 mb-5"><strong class="weight-600 text-red-50">Summary</strong></p>

            <div class="row">
                <div class="col-3">
                    <p class="font-14 mb-5">Interest Paid:</p>
                    <p class="font-14 mb-5">Fees Paid:</p>
                    <p class="font-14 mb-5">Principal Paid:</p>
                </div>
                <div class="col-2">
                    <p class="font-14 mb-5 text-right">
                        <strong class="weight-600"><?php echo number_format($total_debit, 2); ?></strong>
                    </p>
                    <p class="font-14 mb-5 text-right">
                        <strong class="weight-600">-</strong>
                    </p>
                    <p class="font-14 mb-5 text-right">
                        <strong class="weight-600">-</strong>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-3" style="border-top: 1px solid #000; margin-top: 10px; padding-top: 10px;">
                    <p class="font-14 mb-5"><strong class="weight-600">Principal Balance:</strong></p>
                    <p class="font-14 mb-5">Interest Balance:</p>
                    <p class="font-14 mb-5">Outstanding Fees:</p>
                    <p class="font-14 mb-5"><strong class="weight-600">Total Balance:</strong></p>
                </div>
                <div class="col-2" style="border-top: 1px solid #000; margin-top: 10px; padding-top: 10px;">
                    <p class="font-14 mb-5 text-right">
                        <strong class="weight-600"><?php echo number_format($deal_note['amount'], 2); ?></strong>
                    </p>
                    <p class="font-14 mb-5 text-right">
                        <?php
                        $principal = $deal_note['amount'];
                        $balance = $statement['balance'];
                        $interest_balance = $balance-$principal;
                        ?>
                        <?php echo number_format($interest_balance, 2); ?>
                    </p>
                    <p class="font-14 mb-5 text-right">
                        -
                    </p>
                    <p class="font-14 mb-5 text-right">
                        <?php $total_bal = $principal + $interest_balance; ?>
                        <strong class="weight-600" style="border-bottom: 3px double #000; display: inline-block;"><?php echo number_format($total_bal, 2); ?></strong>
                    </p>
                </div>
            </div>

            <br>
            <p class="font-18 mb-5"><strong class="weight-600 text-red-50">Amortisation Schedule</strong></p>

        </div>
    </div>
</div>