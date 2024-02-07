<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <!-- Export Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-blue h4">Expected Loan Repayments</h4>
                    </div>
                </div>
            </div>
            <div class="pb-20">
                <table class="table hover table stripe multiple-select-row data-table-export nowrap">
                    <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Loan Id</th>
                        <th>Date</th>
                        <th>Amount(USD)</th>
                        <th>Amount(ZWL)</th>
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
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Export Datatable End -->
    </div>
</div>