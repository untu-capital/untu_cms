<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/parameter/all");
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

            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <div class="row">
                        <div class="col-10">
                            <h4 class="text-blue h4">Parameters</h4>
                        </div>
                        <div class="col-2">
                            <a class="btn-lg btn-block btn-success text-white text-center" href="requisitions.php?menu=add_parameter"><i class="icon-copy bi bi-plus-lg"></i>Add Parameter</a>
                        </div>
                    </div>
                </div>
                <div class="pb-20">
                    <table class="table hover table stripe multiple-select-row data-table-export nowrap">
                        <thead>
                        <tr>

                            <th class="table-plus datatable-nosort">Withholding Tax %</th>
                            <th class="table-plus datatable-nosort">Threshold for Cumulative Invoices</th>
                            <th class="table-plus datatable-nosort">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($table as $row):?>
                            <tr>

                                <td class="table-plus"><?php echo $row['tax']; ?></td>
                                <td class="table-plus"><?php echo $row['cumulative']; ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="requisitions.php?menu=update_parameter&id=<?php echo urlencode($row['id']); ?>"><i class="dw dw-edit2"></i> Edit</a>
                                            <form method="post" action="">
                                                <input hidden="hidden" name="id" value="<?php echo urlencode($row['id']); ?>">
                                                <button class="dropdown-item" name="delete_category" type="submit"><i class="dw dw-delete-3"></i>Delete</button>
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
