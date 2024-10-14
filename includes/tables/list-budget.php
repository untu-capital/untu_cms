
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


        <?php
            $currentYear = date('Y');
            $selectedYear = isset($_GET['year']) ? $_GET['year'] : $currentYear;
            $selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'all';

            // Function to fetch categories, replace with your actual function
            function fetchCategories() {
                return [
                    ['id' => 1, 'name' => 'Payroll'],
                    ['id' => 2, 'name' => 'Marketing'],
                    ['id' => 3, 'name' => 'Operations'],
                    // Add more categories as needed
                ];
            }

            $categories = fetchCategories();
        ?>

        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Year *</label>
                            <select class="custom-select2 form-control" name="year" style="width: 100%; height: 38px" required>
                                <?php for ($year = $currentYear; $year >= $currentYear - 10; $year--): ?>
                                    <option value="<?php echo $year; ?>" <?php echo ($year == $selectedYear) ? 'selected' : ''; ?>>
                                        <?php echo $year; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Category *</label>
                            <select class="custom-select2 form-control" name="category" style="width: 100%; height: 38px" required>
                                <option value="all" <?php echo ('all' == $selectedCategory) ? 'selected' : ''; ?>>All</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>" <?php echo ($category['id'] == $selectedCategory) ? 'selected' : ''; ?>>
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <br>
                        <button type="submit" class="btn btn-primary btn-block">Filter</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
            $filteredBudgets = array_filter($budgets, function ($budget) use ($selectedYear, $selectedCategory) {
            $matchesYear = $budget['year'] == $selectedYear;
            $matchesCategory = $selectedCategory == 'all' || $budget['category'] == $selectedCategory;
            return $matchesYear && $matchesCategory;
            });
        ?>

        <table class="table hover table stripe multiple-select-row data-table-export nowrap">
            <thead>
            <tr>
                <th>Category</th>
                <th>Month</th>
                <th>Budget</th>
                <th>Actual</th>
                <th>Variance</th>
<!--                <th style="font-size: 12px;padding: 0px;">Actions</th>-->
            </tr>
            </thead>
            <tbody>
            <?php foreach ($filteredBudgets as $row): ?>
                <?php
                $months = [
                    'january', 'february', 'march', 'april', 'may', 'june',
                    'july', 'august', 'september', 'october', 'november', 'december'
                ];

                foreach ($months as $month):
                    $budgetAmount = $row[$month];
                    $expenditureAmount = $expenditures[$month];
                    $variance = $budgetAmount - $expenditureAmount;
                    ?>
                    <tr>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo ucfirst($month); ?></td>
                        <td><?php echo $budgetAmount; ?></td>
                        <td><?php echo $expenditureAmount; ?></td>
                        <td>
                            <?php if ($variance >= 0): ?>
                                <span class="badge badge-success" data-bgcolor="#2DB83D" data-color="#fff"><?php echo number_format($variance, 2, '.', ','); ?></span>
                            <?php else: ?>
                                <span class="badge badge-warning" data-color="#fff"><?php echo number_format($variance, 2, '.', ','); ?></span>
                            <?php endif; ?>
                        </td>
<!--                        <td style="font-size: 12px; padding: 0px;">-->
<!--                            <div class="dropdown">-->
<!--                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">-->
<!--                                    <i class="dw dw-more"></i>-->
<!--                                </a>-->
<!--                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">-->
<!--                                    <a class="dropdown-item" href="requisitions.php?menu=update_budget&budgetId=--><?php //echo urlencode($row['id']); ?><!--"><i class="dw dw-edit2"></i> Edit</a>-->
<!--                                    <form method="post" action="">-->
<!--                                        <input hidden="hidden" name="budgetId" value="--><?php //echo urlencode($row['id']); ?><!--">-->
<!--                                        <button name="delete_budget" type="submit" class="dropdown-item"><i class="dw dw-delete-3"></i> Delete</button>-->
<!--                                    </form>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </td>-->
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>
<!-- Export Datatable End -->