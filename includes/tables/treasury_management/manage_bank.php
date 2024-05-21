<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <!-- Export Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row">
                    <div class="col-10">
                        <h4 class="text-blue h4">Manage Bank</h4>
                    </div>
                    <div class="col-2">
                        <a class="btn-lg btn-block btn-success text-white text-center"
                           href="special_assets_tracker.php?menu=add_bank"><i
                                    class="icon-copy bi bi-plus-lg"></i>
                            Add
                        </a>
                    </div>
                </div>
            </div>
            <div class="pb-20">
                <table class="table hover table stripe multiple-select-row data-table-export nowrap">
                    <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Code</th>
                        <th>Bank Name</th>
                        <th>Account Number</th>
                        <th>Branch</th>
                        <th>Currency</th>
                        <th>Balance</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $data = bank_list();
                    foreach ($data as $row):?>
                        <tr>
                            <td class="table-plus"><?php echo $row['code']; ?></td>
                            <td><?php echo $row['bankName']; ?></td>
                            <td><?php echo $row['accountNumber']; ?></td>
                            <td><?php echo $row['branchName']; ?></td>
                            <td><?php echo $row['currency']; ?></td>
                            <td><?php echo $row['balance']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="special_assets_tracker.php?menu=view_bank&bankId=<?php echo urlencode($row['id']); ?>"><i class="dw dw-eye"></i> View </a>
                                        <a class="dropdown-item" href="special_assets_tracker.php?menu=update_bank&bankId=<?php echo urlencode($row['id']); ?>"><i class="dw dw-edit2"></i> Edit </a>
<!--                                        <a class="dropdown-item" href="special_assets_tracker.php?menu=delete_bank&bankId=--><?php //echo urlencode($row['id']); ?><!--"><i class="dw dw-delete-3"></i>Delete</a>-->
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
    </div>
</div>