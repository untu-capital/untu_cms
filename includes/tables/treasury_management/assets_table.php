<?php

//    include('../../../includes/fpdf/fpdf.php');
?>

<div class="pd-20">

    <table class="table hover table stripe nowrap checkbox-datatable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Client Name (USD/ZWL)</th>
            <th>Amount Disbursed</th>
            <th>Date Disbursed</th>
            <th>Repayment Dates</th>
            <th>Repayment Amount</th>
            <th>Receipts</th>
            <th>Amounts Due</th>
            <th>Net Receivables</th>
<!--            <th class="datatable-nosort">Action</th>-->
        </tr>
        </thead>
        <tbody>
        <?php
        $authorisation = authorisation("");
        foreach ($authorisation as $data):
            ?>
            <?php
            $authbranch = branch_by_id($data['branchId']);
            $authuser = user($data['userId']);
            ?>

            <tr>
                <td><?php echo date('d-M-Y', strtotime($data['createdAt'])); ?></td>
                <td class="table-plus"><?php echo $authuser['firstName'] . " " . $authuser['lastName']; ?></td>
                <td class="table-plus"><?php echo $data['authLevel']; ?></td>
                <td class="table-plus"><?php echo $data['authLevel']; ?></td>
                <td class="table-plus"><?php echo $data['authLevel']; ?></td>
                <td class="table-plus"><?php echo $data['authLevel']; ?></td>
                <td class="table-plus"><?php echo $data['authLevel']; ?></td>
                <td><?php echo $authbranch['branchName']; ?></td>
                <td>
                    <?php if ($data['branchStatus'] == 1) { ?>
                        <span class="badge badge-success" data-bgcolor="#2DB83D"
                              data-color="#fff"><?php echo "Signed"; ?></span>
                    <?php } else { ?>
                        <span class="badge badge-warning" data-color="#fff"><?php echo "Not Signed"; ?></span>
                    <?php } ?>
                </td>

<!--                <td>-->
<!--                    <div class="dropdown">-->
<!--                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"-->
<!--                           role="button" data-toggle="dropdown">-->
<!--                            <i class="dw dw-more"></i>-->
<!--                        </a>-->
<!--                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">-->
<!--                            <a class="dropdown-item" href="treasury_management.php?menu=download_deal_note&id=--><?php //= $data["id"] ?><!--&generate_deal_note=true"><i class="dw dw-download"></i>Download D.N</a>-->
<!--                            <a class="dropdown-item" href="treasury_management.php?menu=view_asset_statement&id=--><?php //= $data["id"] ?><!--"><i class="dw dw-view"></i>View Statement</a>-->
<!--                            <a class="dropdown-item" href="treasury_management.php?menu=sign_deal_note&id=--><?php //= $data["id"] ?><!--"><i class="dw dw-writing"></i> Sign Deal Note</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </td>-->
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>