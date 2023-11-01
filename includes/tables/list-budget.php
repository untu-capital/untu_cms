
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
            <table class="table hover table stripe multiple-select-row data-table-export nowrap">
            <thead >
            <tr>
                <th  style="font-size: 12px; padding: 0px;" class="table-plus datatable-nosort">Category</th>
                <th  style="font-size: 12px;padding: 0px;">Year</th>
                <th  style="font-size: 12px;padding: 0px;">Jan</th>
                <th  style="font-size: 12px;padding: 0px;">Feb</th>
                <th  style="font-size: 12px;padding: 0px;">Mar</th>
                <th  style="font-size: 12px;padding: 0px;">Apr</th>
                <th  style="font-size: 12px;padding: 0px;">May</th>
                <th  style="font-size: 12px;padding: 0px;">Jun</th>
                <th  style="font-size: 12px;padding: 0px;">Jul</th>
                <th  style="font-size: 12px;padding: 0px;">Aug</th>
                <th  style="font-size: 12px;padding: 0px;">Sep</th>
                <th  style="font-size: 12px;padding: 0px;">Oct</th>
                <th  style="font-size: 12px;padding: 0px;">Nov</th>
                <th  style="font-size: 12px;padding: 0px;">Dec</th>
                <th  style="font-size: 12px;padding: 0px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $budgets = poBudget('/all');
                foreach ($budgets as $row):?>
                <tr>
                    <td  style="font-size: 12px; padding: 0px;" class="table-plus"><?php echo $row['category']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['year']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['january']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['february']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['march']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['april']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['may']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['june']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['july']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['august']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['september']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['october']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['november']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['december']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;">
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="requisitions.php?menu=update_budget&budgetId=<?php echo urlencode($row['id']); ?>"><i class="dw dw-edit2"></i> Edit</a>
                                <form method="post" action="">
                                    <input hidden="hidden" name="budgetId" value="<?php echo urlencode($row['id']); ?>">
                                    <button name="delete_budget" type="submit" class="dropdown-item"><i class="dw dw-delete-3"></i>Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Export Datatable End -->