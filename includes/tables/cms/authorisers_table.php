<!-- table widget -->
<style>
    /* Hide the form initially */
    #myForm {
        display: none;
    }
</style>


<?php

$errors = array();


if(isset($_POST['auth'])){
    $branch = $_POST['branch'];
    $auth = $_POST['role'];
    $name = $_POST['name'];







    $url = "http://localhost:7878/api/utg/cms/cms_authorisation/addAuthorisation";

    $data_array = array(


        'branchName' => $branch,
        'branchId' => $branch,
        'authLevel' => $auth,
        'userId'=> $name,



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
                ?>        <script>
                $(function() {
                    $("#myModal").modal();//if you want you can have a timeout to hide the window after x seconds
                });
            </script>
                <?php

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




<div class="pd-20">

    <button class="btn btn-lg btn-primary" type="submit" name="add_branch" id="showFormButton" style="margin-bottom: 15px;">Add Authoriser</button>


    <div class="pd-20 card-box mb-30">



        <form action="" method="POST" id="myForm">
            <div class="clearfix">
                <h4 class="text-blue h4">Authoriser</h4>

            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Branch Name</label>
                        <select class="custom-select form-control"name="branch" required>
                            <option value="">Select Branch</option>
                            <?php
                            $branches = branch();
                            foreach ($branches as $branch) {
                                echo "<option value='$branch[id]'>$branch[branchName] Branch</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Authirisation Level <i class="mdi mdi-subdirectory-arrow-left:"></i></label>
                        <select class="custom-select form-control" name="role">
                            <option value="">Select Level</option>
                            <option value="Initiator" name="role">Initiator</option>
                            <option value="First Approver" name="role" >First Approver</option>
                            <option value="Second Approver" name="role" >Second Approver</option>
                        </select>
                    </div>
                </div
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Name</label>
                        <select class="custom-select form-control"name="name" id="name" required>
                            <option value="">Select Name</option>
                            <?php
                            $users = users();
                            foreach ($users as $user) {
                                echo "<option value='$user[id]'>$user[firstName] $user[lastName] </option>";
                            }
                            ?>
                        </select>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-1 col-sm-12">
                        <div class="form-group">

                            <button type="submit" class="btn btn-primary" value="auth" name="auth">Submit</button>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">

                            <button  class="btn btn-primary"onclick="goBack()">Cancel</button>

                        </div>
                    </div>
                </div>

        </form>



        <script>
            // Get references to the button and form
            var showFormButton = document.getElementById("showFormButton");
            var myForm = document.getElementById("myForm");

            // Add a click event listener to the button
            showFormButton.addEventListener("click", function() {
                // Show the form by changing its display style
                myForm.style.display = "block";
            });
        </script>

        <script>
            // JavaScript function to go back to the previous page
            function goBack() {
                window.history.back();
            }
        </script

    </div>


    <!-- <div class="pb-20"> -->
    <table class="data-table table stripe hover multiple-select-row nowrap">
        <thead>
        <tr>
            <th>Creation Date</th>
            <th>Name</th>
            <th>Athaurisation Level</th>
            <th>Branch</th>

            <th class="datatable-nosort">Action</th>
        </tr>
        </thead>
        <tbody>


        <?php
        $authorisation = authorisation();
        foreach($authorisation as $data):

            ?>
            <?php
            $authbranch = authbranch($data['branchId']);

            $authuser = user($data['userId']);


            ?>

            <tr>
                <td><?php echo date('d-M-Y', strtotime($data['createdAt'])) ;?></td>
                <td class="table-plus"><?php echo $authuser['firstName'] . $authuser['lastName'];?></td>
                <td class="table-plus"><?php echo $data['authLevel'] ;?></td>
                <td><?php echo $authbranch['branchName'] ;?></td>


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
                            <a class="dropdown-item" href="cash_management.php">

                                <a class="dropdown-item" href="cash_management.php?menu=edit_authorities&id=<?=$data["id"] ?>" ><i class="dw dw-edit2"></i> Edit</a>

                                <form method="post" action="delete.php">
                                    <input type="hidden" name="id" value="<?= $data["id"] ?>">
                                    <button type="submit" name="deleteAuth" value="deleteAuth" class="dropdown-item"><i class="dw dw-edit2"></i> Delete</button>
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