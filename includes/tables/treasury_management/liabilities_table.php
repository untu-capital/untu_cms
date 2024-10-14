<?php

//    include('../../../includes/fpdf/fpdf.php');
?>

<div class="pd-20">

    <table class="table hover table stripe multiple-select-row data-table-export nowrap">
        <thead>
        <tr>
            <th>Counterparty</th>
            <th>Liability Type</th>
            <th>Interest</th>
            <th>Tenor In Days</th>
            <th>Invested Amount</th>
            <th>PA Status</th>
<!--            <th>Interest Frequency</th>-->
            <th>Principal Repayment Type</th>
            <th>Start Date</th>
<!--            <th>Maturity Date</th>-->
<!--            <th>Repayment Dates</th>-->
            <th>Revolving</th>
            <th class="datatable-nosort">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $liabilities = liabilities_list();
        foreach ($liabilities as $data):
            ?>
            <tr>
                <td class="table-plus"><?php echo $data['counterpart']; ?></td>
                <td class="table-plus"><?php echo $data['liabilityType'].' ( '.$data['currencyDenomination'].' )'; ?></td>
                <td class="table-plus"><?php echo $data['interest'].' %'; ?></td>
                <td class="table-plus"><?php echo $data['tenorInDays']; ?></td>
                <td class="table-plus"><?php echo $data['investedAmount']; ?></td>
                <td class="table-plus"><?php echo $data['paStatus']; ?></td>
<!--                <td class="table-plus">--><?php //echo $data['interestFrequency']; ?><!--</td>-->
                <td class="table-plus"><?php echo $data['principalRepaymentType']; ?></td>
                <td class="table-plus"><?php echo $data['startDate']; ?></td>
<!--                <td class="table-plus">--><?php //echo $data['maturityDate']; ?><!--</td>-->
<!--                <td class="table-plus">--><?php //echo $data['repaymentDates']; ?><!--</td>-->
                <td class="table-plus"><?php echo $data['revolving']; ?></td>
<!--                <td>-->
<!--                    --><?php //if ($data['branchStatus'] == 1) { ?>
<!--                        <span class="badge badge-success" data-bgcolor="#2DB83D"-->
<!--                              data-color="#fff">--><?php //echo "Signed"; ?><!--</span>-->
<!--                    --><?php //} else { ?>
<!--                        <span class="badge badge-warning" data-color="#fff">--><?php //echo "Not Signed"; ?><!--</span>-->
<!--                    --><?php //} ?>
<!--                </td>-->

                <td>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                           role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
<!--                            <a class="dropdown-item" href="treasury_management.php?menu=download_deal_note&id=--><?php //= $data["id"] ?><!--&generate_deal_note=true"><i class="dw dw-download"></i>Download D.N</a>-->
<!--                            <a class="dropdown-item" href="treasury_management.php?menu=view_statement&id=--><?php //= $data["id"] ?><!--"><i class="dw dw-view"></i>View Statement</a>-->
<!--                            <a class="dropdown-item" href="treasury_management.php?menu=sign_deal_note&id=--><?php //= $data["id"] ?><!--"><i class="dw dw-writing"></i> Sign Deal Note</a>-->
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>