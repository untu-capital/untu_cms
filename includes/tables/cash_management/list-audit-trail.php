
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">

        <!-- Export Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row">
                    <div class="col-10">
                        <h4 class="text-blue h4">Audit Trail Reports</h4>
                    </div>
                </div>
            </div>
            <div class="pb-20">
                <table class="table hover multiple-select-row data-table-export nowrap">
                    <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Date</th>
                        <th>Action Performed</th>
                        <th>Action Level</th>
                        <th>From Vault</th>
                        <th>To Vault</th>
                        <th>Branch</th>
                        <th>User Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $cms_trail = cmsAuditTrail();
                        foreach ($cms_trail as $row):?>
                        <tr>
                            <td><?php
                                $timestamp = strtotime($row['createdAt']);
                                echo date("d-m-Y, g:i a", $timestamp); ?>
                            </td>
                            <td><?php echo $row['action']; ?></td>
                            <td><?php echo $row['auth_level']; ?></td>
                            <td><?php echo $row['from_account']; ?></td>
                            <td><?php echo $row['to_account']; ?></td>
                            <td><?php echo $row['branch']; ?></td>
                            <td><?php echo $row['role']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Export Datatable End -->
    </div>
</div>