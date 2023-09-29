<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/audit-trails/all");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_response = curl_exec($ch);

curl_close($ch);
$data = json_decode($server_response, true);
// Check if the JSON decoding was successful
if ($data !== null) {
    $table = $data;

} else {
    echo "Error decoding JSON data";
}
?>

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

                        <th class="table-plus datatable-nosort">Initiator</th>
                        <th>Amount</th>
                        <th>From Vault</th>
                        <th>To Vault</th>
                        <th>Initiated At</th>

                        <th>First Approved By</th>
                        <th>First Approved At</th>

                        <th>Second Approved By</th>
                        <th>Second Approved At</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($table as $row):?>

                        <tr>
                            <td class="table-plus"><?php echo $row['initiator']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td><?php echo $row['fromVault']; ?></td>
                            <td><?php echo $row['toVault']; ?></td>
                            <td><?php
                                $timestamp = strtotime($row['initiatedAt']);
                                echo date("F j, Y, g:i a", $timestamp); ?></td>

                            <td><?php echo $row['firstApprover']; ?></td>
                            <td><?php
                                $timestamp = strtotime($row['firstApprovedAt']);
                                echo date("F j, Y, g:i a", $timestamp) ? $row['firstApprover'] != null : $row['firstApprovedAt']  ; ?></td>

                            <td><?php echo $row['secondApprover']; ?></td>
                            <td><?php
                                $timestamp = strtotime($row['secondApprovedAt']);
                                echo date("F j, Y, g:i a", $timestamp) ? $row['secondApprover'] != null : $row['secondApprovedAt']  ; ?></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Export Datatable End -->
    </div>
</div>