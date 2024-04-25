<?php
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/vault/get/all");
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//$server_response = curl_exec($ch);
//
//curl_close($ch);
//$data = json_decode($server_response, true);
//// Check if the JSON decoding was successful
//if ($data !== null) {
//    $table = $data;
//
//} else {
//    echo "Error decoding JSON data";
//}
//?>

    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <div class="row">
                        <div class="col-10">
                            <h4 class="text-blue h4">Vaults</h4>
                        </div>
                        <div class="col-2">
                            <a class="btn-lg btn-block btn-success text-white text-center" href="cash_management.php?menu=add_vault"><i class="icon-copy bi bi-plus-lg"></i>Add Vault</a>
                        </div>
                    </div>
                </div>
                <div class="pb-20">
                    <table  class="table hover table stripe multiple-select-row data-table-export nowrap">
                        <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Account</th>
                            <th>Type</th>
                            <th>Code</th>
                            <th>name</th>
                            <th>Branch</th>
                            <th>Max Amount</th>
                            <th>Current Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $vaults = vaults('all');
                            foreach ($vaults as $row):?>
                        <tr>
                            <td class="table-plus"><?php echo $row['account']; ?></td>
                            <td><?php echo $row['type']; ?></td>
                            <td><?php echo $row['code']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['branch']['branchName']; ?></td>
                            <td><?php echo '$ ' . number_format($row['maxAmount'], 2, '.', ','); ?></td>
                            <td><?php echo '$ ' . number_format($row['currentAmount'], 2, '.', ','); ?></td>
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
                                           href="cash_management.php?menu=update_vault&vaultId=<?php echo urlencode($row['id']); ?>"

                                        ><i class="dw dw-edit2"></i> Edit Vault</a>

                                        <a class="dropdown-item"
                                           href="cash_management.php?menu=delete_vault&vaultId=<?php echo urlencode($row['id']); ?>"

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