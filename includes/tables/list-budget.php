
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
                <th >Date</th>
                <th >Budget</th>
                <th >Expenditure</th>
                <th >Variance</th>

                <th  style="font-size: 12px;padding: 0px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $budgets = poBudget('/all');
                foreach ($budgets as $row):?>
                <tr>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo date('d-m-Y',$row['createdAt']); ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['budget']; ?></td>
                    <td  style="font-size: 12px; padding: 0px;"><?php echo $row['expenses']; ?></td>
                    <td>
                        <?php if ($row['variance'] >= 0){ ?>
                            <span class="badge badge-success" data-bgcolor="#2DB83D" data-color="#fff"><?php echo number_format($row['variance'],'2','.',',') ;?></span>
                        <?php } else { ?>
                            <span class="badge badge-warning" data-color="#fff"><?php echo number_format($row['variance'],'2','.',',') ;?></span>
                        <?php } ?>
                    </td>
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