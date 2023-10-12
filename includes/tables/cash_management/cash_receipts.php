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
                            <h4 class="text-blue h4">Cash Receipts</h4>
                        </div>
<!--                        <div class="col-2">-->
<!--                            <a class="btn-lg btn-block btn-success text-white text-center" href="cash_management.php?menu=add_vault"><i class="icon-copy bi bi-plus-lg"></i>Add Vault</a>-->
<!--                        </div>-->
                    </div>
                </div>
                <div class="pb-20">
                    <table class="table hover table stripe multiple-select-row data-table-export nowrap">
                        <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Trans Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Currency</th>
                            <th>Reference</th>
                            <th>To Account</th>
                            <th>From Account</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $cash_receipts = cash_receipts('all');
                            foreach ($cash_receipts as $row):?>
                        <tr>
                            <td class="table-plus"><?php echo $row['transactionDate']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo '$ ' . number_format($row['amount'], 2, '.', ','); ?></td>
                            <td><?php echo $row['currency']; ?></td>
                            <td><?php echo $row['reference']; ?></td>
                            <td><?php echo $row['toAccount']; ?></td>
                            <td><?php echo $row['fromAccount']; ?></td>
                            <td><?php if ($row['synced'] == 1) {
                                    echo "<label style='padding: 7px;' class='badge badge-success'>POSTED</label>";}
                                else{echo "<label style='padding: 7px;' class='badge badge-warning'>QUEUED</label>";}?>
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