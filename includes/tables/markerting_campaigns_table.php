
<div class="card-box mb-30">
    <div class="pd-20">
        <?php if ($_SESSION['role'] != "ROLE_LO") { ?>
        <form action="campaign_and_marketing.php?menu=add_campaign" method="post">
            <button class="btn btn-lg btn-primary" type="submit" name="add_campaign" style="margin-bottom: 15px;">Add Campaign</button>
        </form>
        <?php } ?>

    </div>
    <table class="data-table table stripe hover multiple-select-row nowrap">
        <thead>
        <tr>
            <th>Campaign Name</th>
            <th>Area/Place</th>
            <th>Target Audience</th>
            <th>Goal/Objective</th>
            <th>Key Performance Indicators</th>
            <th>Campaign Period</th>
<!--            <th>LoanOfficer</th>-->
            <th>Status</th>
            <th class="datatable-nosort">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $market_campaigns = market_campaigns();
        foreach($market_campaigns as $data):

            $end_date = htmlspecialchars($data["endDate"]);
            $formatted_end_date = date("Y-m-d", strtotime($end_date));

            $current_date = date("Y-m-d"); // Get the current date
            $status = htmlspecialchars($data["campaignStatus"]);

            $row_class = '';
            if ($formatted_end_date < $current_date && $status == "open") {
                $row_class = 'expired';
            }
            ?>

            <tr class="<?php echo $row_class; ?>">
                <td><?= htmlspecialchars($data["campaignName"]) ?></td>
                <td><?= htmlspecialchars($data["venue"]) ?></td>
                <td><?= htmlspecialchars($data["targetAudience"]) ?></td>
                <td><?= htmlspecialchars($data["objectives"]) ?></td>
                <td><?= htmlspecialchars($data["keyPerformanceIndicator"]) ?></td>
                <td><?php echo date('d-M-Y', strtotime($data['startDate']))." To ".date('d-M-Y', strtotime($data['endDate'])) ;?></td>
<!--                <td>--><?php //= htmlspecialchars($data["allocatedLoanOfficer"]) ?><!--</td>-->
                <td>
                    <?php if ($status == "open") {
                        echo "<label style='padding: 7px;' class='badge badge-success'>Open</label>";
                    } else {
                        echo "<label style='padding: 7px;' class='badge badge-danger'>Closed</label>";
                    } ?>
                </td>
                <td>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="view_campaign.php?id=<?= $data["id"] ?>"><i class="dw dw-eye"></i> View</a>
                            <?php if ($_SESSION['role'] == "ROLE_LO" && $data['campaignStatus'] == "open"){ ?>
                                <a class="dropdown-item" href="lead_management.php?menu=add_lead&id=<?=$data["id"] ?>"><i class="dw dw-edit2"></i> Add Lead</a>
                            <?PHP } ?>
<!--                            <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Close</a>-->
<!--                            <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>-->
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- CSS styles -->
<style> .expired { background-color: #FAA0A0; /* Set the background color for expired rows */ } </style>