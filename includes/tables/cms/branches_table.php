<!-- table widget -->


<?php
if(isset($_POST['delete'])) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/branches/deleteBranch/".$_POST['id']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $resp = curl_exec($ch);
    curl_close($ch);

}


$errors = array();


if(isset($_POST['Branch'])){
    $name = $_POST['name'];
    $status = $_POST['status'];
    $code = $_POST['code'];
    $direction = $_POST['direction'];
    $google = $_POST['google'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $branchcode = $_POST['branchcode'];
    $vault = $_POST['vault'];





    $url = "http://localhost:7878/api/utg/branches/addBranch";

    $data_array = array(

        'branchName'=> $name,
        'branchStatus' => $status,
        'branchAddress'=> $address,
        'branchTellPhone' => $phone,
        'googleMap'=> $google,
        'direactionsLink' => $direction,
        'code'=> $code,
        'vaultAccountNumber'=> $vault,
        'branchCode'=> $branchcode



    );

    $data = json_encode($data_array);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true );

    $resp = curl_exec($ch);

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerStr = substr($resp, 0, $headerSize);
    $bodyStr = substr($resp, $headerSize);

    // Check HTTP status code
    if (!curl_errno($ch)) {
        // $_SESSION['info'] = "";
        // $_SESSION['error'] = "";
        switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            case 200:  # OK redirect to dashboard
                header('cash_management.php?menu=main#branches');

                break;
            case 400:  # Bad Request
                $decoded = json_decode($bodyStr);
                foreach($decoded as $key => $val) {
                    //echo $key . ': ' . $val . '<br>';
                }
                // echo $val;
                $_SESSION['error'] = "Failed. Please try again, ".$val;
                header('location: cash_management.php?menu=main');
                break;

            case 401: # Unauthorixed - Bad credientials
                $_SESSION['error'] = 'Application failed.. Please try again!';
                header('location: cash_management.php?menu=main');

                break;
            default:
                $_SESSION['error'] = 'Not able to create Category'. "\n";
                header('location: cash_management.php?menu=main');
        }
    } else {
        $_SESSION['error'] = 'Application failed.. Please try again!'. "\n";
        header('location: cash_management.php?menu=main');

    }
    curl_close($ch);
}

?>




<div class="card-box">
    <div class="pd-20">
        <form action="cash_management.php?menu=add_branch" method="post">
           <button class="btn btn-lg btn-primary" type="submit" name="add_branch"  style="margin-bottom: 15px;">Add Branch</button>
        </form>






    </div>
    <!-- <div class="pb-20"> -->
    <table class="data-table table stripe hover multiple-select-row nowrap">
        <thead>
        <tr>
            <th>Creation Date</th>
            <th>Branch Name</th>
            <th>Branch Address</th>
            <th>Contact No.</th>
            <th>Valt Account No.</th>
            <th>Branch Code</th>
            <th>Status</th>
            <th class="datatable-nosort">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $branches = branch();
        foreach($branches as $data): ?>
            <tr>
                <td><?php echo date('d-M-Y', strtotime($data['createdAt'])) ;?></td>
                <td class="table-plus"><?php echo $data['branchName'] ;?></td>
                <td class="table-plus"><?php echo $data['branchAddress'] ;?></td>
                <td><?php echo $data['branchTellPhone'] ;?></td>
                <td><?php echo $data['vaultAccountNumber'] ;?></td>
                <td><?php echo $data['branchCode'] ;?></td>
                <td>
                    <?php if ($data['branchStatus'] == 1){ ?>
                        <span class="badge badge-success" data-bgcolor="#2DB83D" data-color="#fff"><?php echo "Active" ;?></span>
                    <?php } else { ?>
                        <span class="badge badge-warning" data-color="#fff"><?php echo "Disabled" ;?></span>
                    <?php } ?>
                </td>

                <td>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="cash_management.php">
                                <!-- Add your first dropdown item here if needed -->
                            </a>
                            <a class="dropdown-item" href="cash_management.php?menu=edit_branch&id=<?= $data["id"] ?>">
                                <i class="dw dw-edit2"></i> Edit
                            </a>
                            <form method="post" action="delete.php">
                                <input type="hidden" name="id" value="<?= $data["id"] ?>">
                                <button type="submit" name="delete" value="delete" class="dropdown-item">
                                    <i class="dw dw-delete-3"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- </div> -->
</div>
<!--<script>-->
<!--    function deleteRecord(id) {-->
<!--        if (confirm("Are you sure you want to delete this record?")) {-->
<!--            // Send an AJAX request to delete the record with the given ID-->
<!--            $.ajax({-->
<!--                url: 'delete.php', // Replace with the actual URL for deleting records-->
<!--                method: 'POST', // Use POST method-->
<!--                data: { id: id },-->
<!--                success: function(response) {-->
<!--                    // Handle the success response here-->
<!--                    if (response === 'success') {-->
<!--                        // Remove the table row from the DOM-->
<!--                        $('#row_' + id).remove();-->
<!--                    } else {-->
<!--                        alert('Failed to delete the record.');-->
<!--                    }-->
<!--                },-->
<!--                error: function() {-->
<!--                    alert('An error occurred while deleting the record.');-->
<!--                }-->
<!--            });-->
<!--        }-->
<!--    }-->
<!--</script>-->
