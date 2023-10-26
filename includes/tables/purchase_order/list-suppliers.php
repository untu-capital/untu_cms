<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/pos/supplier/all");
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
                            <h4 class="text-blue h4">Suppliers</h4>
                        </div>
                        <div class="col-2">
                            <a class="btn-lg btn-block btn-success text-white text-center" href="requisitions.php?menu=add_supplier"><i class="icon-copy bi bi-plus-lg"></i>Add Supplier</a>
                        </div>
                    </div>
                </div>
                <div class="pb-20">
                    <table class="table hover table stripe multiple-select-row data-table-export nowrap">
                        <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Contact Person</th>
                            <th>Comment</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($table as $row):?>
                        <tr>
                            <td class="table-plus"><?php echo $row['name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['contactPerson']; ?></td>
                            <td><?php echo $row['comment']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="requisitions.php?menu=update_supplier&supplierId=<?php echo urlencode($row['id']); ?>"><i class="dw dw-edit2"></i> Edit</a>
                                        <form method="post" action="">
                                            <input type="hidden" name="supplierId" value="<?php echo urlencode($row['id']); ?>">
                                            <button class="dropdown-item" name="delete_supplier" onclick="return confirm('Are you sure you want to delete this supplier?');">
                                                <i class="dw dw-delete-3"></i>Delete
                                            </button>
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
        </div>
    </div>