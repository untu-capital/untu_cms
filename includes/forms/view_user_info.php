    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 card-box">
            <?php $user = user($_GET['userid']); ?>
            <h5 class="h4 text-blue mb-20">Client: <?php echo $user["firstName"].' '.$user["lastName"];?></h5>
            <div class="tab">
                <ul class="nav nav-pills " role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-blue" data-toggle="tab" href="#personal_info" role="tab" aria-selected="true" >
                            Personal Info
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-blue" data-toggle="tab" href="#user_activity" role="tab" aria-selected="false">
                            User Activities
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="personal_info" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="card card-box ">
                                    <div class="card-body"><h5 class="card-title text-blue" style="text-decoration: underline;">Personal Information</h5>
                                        <p class="card-text">
                                            <li><b>Full name:</b> <?php echo $user["firstName"] ?> <?php echo $user["lastName"] ?></li>
                                            <li><b>Username:</b> <?php echo $user["username"] ?></li>
                                            <li><b>Email Address:</b> <?php echo $user["contactDetail"]["emailAddress"] ?></li>
                                            <li><b>Contact Info:</b> <?php echo $user["contactDetail"]["mobileNumber"] ?></li>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="card card-box">
                                    <div class="card-body">
                                        <h5 class="card-title text-blue" style="text-decoration: underline;">User Properties</h5>
                                        <p class="card-text">
                                            <li><b style="padding-right: 35px;">User role</b>: <?php echo $user["roles"][0]["description"] ?></li>
                                            <li><b style="padding-right: 15px;">Branch</b>: <?php echo  $user["branch"] ?></li>
                                            <li><b style="padding-right: 15px;">Credit Commit</b>: <?php echo  $user["creditCommitGroup"] ?></li>
                                            <li><b style="padding-right: 10px;">Status</b>:
                                                <?php if($user['verified'] == 1){
                                                    echo "<label style='padding: 6px;' class='badge badge-success'>Verified</label>";
                                                }
                                                else{
                                                    echo "<label style='padding: 6px;' class='badge badge-warning'>Not Verified</label>";  }
                                                ?>
                                            </li>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body"><h5 class="card-title text-blue">Update user Info</h5>

                                <table class="table table-striped table-bordered">
                                <tr>
                                    <th>User Role</th>
                                    <th>User Branch</th>
                                    <th>Commit Group</th>
<!--                                    <th>Reset Password</th>-->
                                    <th>Delete User</th>
                                </tr>
                                <tr>
                                    <td><?= $user["roles"][0]["name"]?></td>
                                    <td><?= $user["branch"] ?></td>
                                    <td><?= $user["creditCommitGroup"] ?></td>
<!--                                    <td>-->
<!--                                        <input class="form-control" type="text" name="new_password" placeholder="Type new password">-->
<!--                                        <input class="form-control" type="hidden" name="userid" required value="--><?php //echo $_GET['userid'] ?><!--">-->
<!--                                        <button class="btn btn-success" type = "submit" name= "change_password" >Change Password</button>-->
<!--                                    </td>-->
                                    <td class="text-blue"><?= "DEACTIVATE USER" ?></td>
                                </tr>
                                <?php $user = user($_GET['userid']); ?>
                                    <tr>
                                        <td>
                                            <form method="post" action="">
                                                <select id="userRole" onchange="Status()" class="btn btn-clipboard" name="update_user_role" autocomplete="off">
                                                    <option>Select Role</option>
                                                    <?php $roles_data = roles();
                                                    foreach ($roles_data as $role) {echo "<option value='$role[id]'>$role[name]</option>";} ?>
                                                </select>
                                                <input class="form-control" type="hidden" name="userid" required value="<?php echo $_GET['userid'] ?>">
                                                <button class="btn btn-success" type = "submit" name= "updateUserRole">Update</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" action="">
                                                <select id="userBranch" onchange="Status()" class="btn btn-clipboard" name="update_user_branch" autocomplete="off">
                                                    <option>Select Branch</option>
                                                    <?php $branch_data = branch();
                                                    foreach ($branch_data as $branch) {
                                                        echo "<option value='$branch[branchName]'>$branch[branchName]</option>";} ?>
                                                </select>
                                                <input class="form-control" type="hidden" name="userid" required value="<?php echo $_GET['userid'] ?>">
                                                <button class="btn btn-success" type = "submit" name= "updateUserBranch" >Update</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" action="">
                                                <select id="setCommit" onchange="chooseCommit()" class="btn btn-clipboard" name="credit_commit_group" autocomplete="off" placeholder="" >
                                                    <option>Select Credit Commit</option>
                                                    <option value="branch"> Branch Credit Commit </option>
                                                    <option value="management"> Management Credit Commit </option>
                                                    <option value="head_office"> HO Credit Commit </option>
                                                    <option value="board"> Board Credit Commit </option>
                                                </select>
                                                <input class="form-control" type="hidden" name="userid" required value="<?php echo $_GET['userid'] ?>">
                                                <button class="btn btn-success" type = "submit" name= "creditCommitGroup" >Update</button>
                                            </form>
                                        </td>
<!--                                        <td>-->
<!--                                            <form method="post" action="">-->
<!--                                                <input class="form-control" type="hidden" name="userid" required value="--><?php //echo $_GET['userid'] ?><!--">-->
<!--                                                <button class="btn btn-success" type = "submit" name= "change_password" >Change Password</button>-->
<!--                                            </form>-->
<!--                                        </td>-->
                                        <td>
                                            <button class="btn btn-danger" type = "submit" name= "delete"  onclick="return confirm('Are you sure you want to delete the user?')">Delete User</button>
                                        </td>
                                    </tr>
                            </table>
                            <form method="post" action="">
                                <input class="form-control" type="text" name="new_password" placeholder="Type new password">
                                <input class="form-control" type="hidden" name="userid" required value="<?php echo $_GET['userid'] ?>">
                                <button class="btn btn-success" type = "submit" name= "change_password" >Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
