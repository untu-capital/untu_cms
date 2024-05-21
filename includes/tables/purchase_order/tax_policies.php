<div class="card-box mb-30">
    <div class="pd-20">
        <?php if ($_SESSION['role'] != "ROLE_LO") { ?>
            <form action="requisitions.php?menu=add_policy" method="post">
                <button class="btn btn-lg btn-primary" type="submit" name="add_target" style="margin-bottom: 15px;">Add Tax Policy</button>
            </form>
        <?php } ?>

    </div>
    <table class="data-table table stripe hover multiple-select-row nowrap">
        <thead>
        <tr>
            <th>Creation Date</th>
            <th>Description</th>
            <th class="datatable-nosort">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $market_campaigns = get_tax_policies();
        foreach($market_campaigns as $data):

            $end_date = htmlspecialchars($data["createdAt"]);
            $formatted_end_date = date("Y-m-d", strtotime($end_date));

            $current_date = date("Y-m-d"); // Get the current date
            $status = htmlspecialchars($data["campaignStatus"]);

            $row_class = '';
            if ($formatted_end_date < $current_date && $status == "open") {
                $row_class = 'expired';
            }
            ?>

            <tr class="<?php echo $row_class; ?>">
                <td><?= htmlspecialchars($formatted_end_date) ?></td>
                <td><?= htmlspecialchars($data["description"]) ?></td>

                <td>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="requisitions.php?menu=update_policy&policyId=<?php echo urlencode($data['id']); ?>"><i class="dw dw-edit2"></i> Edit</a>
                            <form method="post" action="">
                                <input type="hidden" name="policyId" value="<?php echo urlencode($data['id']); ?>">
                                <button class="dropdown-item" name="delete_policy" onclick="return confirm('Are you sure you want to delete this policy?');">
                                    <i class="dw dw-delete-3"></i>Delete
                                </button>
                            </form>
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