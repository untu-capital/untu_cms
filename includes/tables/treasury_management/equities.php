<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <!-- Export Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row">
                    <div class="col-8">
                        <h4 class="text-blue h4">Equities</h4>
                    </div>
                    <div class="col-2">
                        <a class="btn-lg btn-block btn-success text-white text-center"
                           href="special_assets_tracker.php?menu=add_equity"><i
                                    class="icon-copy bi bi-plus-lg"></i>
                            Add
                        </a>
                    </div>
                    <div class="col-2">
                        <a class="btn-lg btn-block btn-success text-white text-center"
                           href="special_assets_tracker.php?menu=calculate_acquisition"><i
                                    class="icon-copy bi bi-calculator"></i>
                            Calculate Acquisition
                        </a>
                    </div>
                </div>
            </div>
            <div class="pb-20">
                <table class="table hover table stripe multiple-select-row data-table-export nowrap">
                    <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Counter</th>
                        <th>Agent</th>
                        <th>Currency</th>
                        <th>Date of Acquisition</th>
                        <th>Number of Shares</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $data = listCustomerInfo();
                    foreach ($data as $row):?>
                        <tr>
                            <td class="table-plus"><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phoneNumber']; ?></td>
                            <td><?php echo $row['phoneNumberOther']; ?></td>
                            <td><?php echo $row['phoneNumberOther']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <a
                                            class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                            href="#"
                                            role="button"
                                            data-toggle="dropdown"
                                    >
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div
                                            class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                                    >
                                        <a class="dropdown-item"
                                           href="special_assets_tracker.php?menu=view_equity&customerId=<?php echo urlencode($row['id']); ?>"
                                        ><i class="dw dw-eye"></i> View </a>
                                        <a class="dropdown-item"
                                           href="special_assets_tracker.php?menu=update_equity&customerId=<?php echo urlencode($row['id']); ?>"
                                        ><i class="dw dw-edit2"></i> Edit </a>
                                        <a class="dropdown-item"
                                           href="special_assets_tracker.php?menu=delete_equity&customerId=<?php echo urlencode($row['id']); ?>"
                                        ><i class="dw dw-delete-3"></i>
                                            Delete</a>

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