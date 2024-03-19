<?php

?>
<!-- table widget -->

<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">
            Treasury User Accounts
        </h4>
    </div>

    <div class="pb-20">
        <table class="table hover table stripe multiple-select-row data-table-export nowrap">
            <thead>
            <tr>
                <th>Full name</th>
                <th>Username</th>
                <th>Role</th>
                <th>Phone Number</th>
                <th>Email Address</th>
                <th>Branch</th>
                <th class="datatable-nosort">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $users = cms_user();
            foreach($users as $user):?>
                <?php
                $roles = get_roles($user["cmsUser"]["role"]); ?>
                <tr>
                    <td><?= htmlspecialchars ($user["firstName"])." ".htmlspecialchars ($user["lastName"]) ?></td>
                    <td><?= htmlspecialchars ($user["username"]) ?></td>
                    <td><?= htmlspecialchars ($roles['name']) ?></td>
                    <td><?= htmlspecialchars ($user["contactDetail"]["mobileNumber"]) ?></td>
                    <td><?= htmlspecialchars ($user["contactDetail"]["emailAddress"]) ?></td>
                    <td><?= htmlspecialchars ($user["branch"]) ?></td>

                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="user_info.php?userid=<?=$user["id"] ?>"><i class="dw dw-edit2"></i> Edit</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<script src="../../vendors/scripts/core.js"></script>
<script src="../../vendors/scripts/script.min.js"></script>
<script src="../../vendors/scripts/process.js"></script>
<script src="../../vendors/scripts/layout-settings.js"></script>
<!--  -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>

