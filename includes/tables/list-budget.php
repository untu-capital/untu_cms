
<div class="card-box mb-30">
    <div class="pd-20">
        <div class="row">
            <div class="col-10">
                <h4 class="text-blue h4">Budget Forecast</h4>
            </div>
            <div class="col-2">
                <a class="btn-lg btn-block btn-success text-white" href="requisitions.php?menu=create_budget">Add Budget</a>
            </div>
        </div>
    </div>
    <div class="pb-20">
        <?php
        // Placeholder for fetching expenditures data
        // Replace with actual code to fetch expenditure data
        function fetchExpenditures() {
            // This function should return an associative array of expenditures by month
            // Example:
            return [
                'january' => 1000,
                'february' => 1200,
                'march' => 800,
                'april' => 1500,
                'may' => 1100,
                'june' => 900,
                'july' => 1300,
                'august' => 0,
                'september' => 0,
                'october' => 0,
                'november' => 0,
                'december' => 0,
            ];
        }

        $budgets = poBudget('/all');
        $expenditures = fetchExpenditures();
        ?>

        <table class="table hover table stripe multiple-select-row data-table-export nowrap">
            <thead>
            <tr>
                <th>Date</th>
                <th>Month</th>
                <th>Budget</th>
                <th>Expenditure</th>
                <th>Variance</th>
                <th style="font-size: 12px;padding: 0px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($budgets as $row): ?>
                <?php
                // Mapping months to their corresponding field names
                $months = [
                    'january', 'february', 'march', 'april', 'may', 'june',
                    'july', 'august', 'september', 'october', 'november', 'december'
                ];

                // Iterating over each month to display budget and expenditure
                foreach ($months as $month):
                    $budgetAmount = $row[$month];
                    $expenditureAmount = $expenditures[$month];
                    $variance = $budgetAmount - $expenditureAmount;
                    ?>
                    <tr>
                        <td style="font-size: 12px; padding: 0px;"><?php echo date('d-m-Y', strtotime($row['createdAt'])); ?></td>
                        <td style="font-size: 12px; padding: 0px;"><?php echo ucfirst($month); ?></td>
                        <td style="font-size: 12px; padding: 0px;"><?php echo $budgetAmount; ?></td>
                        <td style="font-size: 12px; padding: 0px;"><?php echo $expenditureAmount; ?></td>
                        <td>
                            <?php if ($variance >= 0): ?>
                                <span class="badge badge-success" data-bgcolor="#2DB83D" data-color="#fff"><?php echo number_format($variance, 2, '.', ','); ?></span>
                            <?php else: ?>
                                <span class="badge badge-warning" data-color="#fff"><?php echo number_format($variance, 2, '.', ','); ?></span>
                            <?php endif; ?>
                        </td>
                        <td style="font-size: 12px; padding: 0px;">
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="requisitions.php?menu=update_budget&budgetId=<?php echo urlencode($row['id']); ?>"><i class="dw dw-edit2"></i> Edit</a>
                                    <form method="post" action="">
                                        <input hidden="hidden" name="budgetId" value="<?php echo urlencode($row['id']); ?>">
                                        <button name="delete_budget" type="submit" class="dropdown-item"><i class="dw dw-delete-3"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>
<!-- Export Datatable End -->