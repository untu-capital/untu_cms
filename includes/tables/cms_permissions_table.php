<?php

?>
<!-- table widget -->

<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">
            Assigning Vault Permissions
        </h4>
    </div>

    <div class="pb-20">
        <table class="table hover table stripe multiple-select-row data-table-export nowrap">
            <thead>
            <tr>
                <th>Date</th>
                <th>Full name</th>
                <th>Username</th>
                <th>Vault Name</th>
                <th>Vault Account</th>
                <th>Vault Type</th>
                <th>Branch</th>
                <th class="datatable-nosort">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $permissions = cms_vault_permissions();
            foreach($permissions as $permission):
                $user = user($permission["userid"]);
                $cmsBranch = $user["cmsUser"]["role"]; ?>
                <tr>
                    <td><?php echo date('d-M-Y', strtotime($permission['createdAt'])) ;?></td>
                    <td><?= htmlspecialchars ($user["firstName"])." ".htmlspecialchars ($user["lastName"]) ?></td>
                    <td><?= htmlspecialchars ($user["username"]) ?></td>
                    <td><?= htmlspecialchars ($permission['vault_acc_name']) ?></td>
                    <td><?= htmlspecialchars ($permission["vault_acc_code"]) ?></td>
                    <td><?= htmlspecialchars ($permission["vault_acc_type"]) ?></td>
                    <td><?= htmlspecialchars ($user["branch"]) ?></td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <form method="post" action="">
                                    <input class="form-control" type="hidden" name="id" required value="<?php echo $permission['id'] ?>">
                                    <button class="dropdown-item" type="submit" name="revoke_permission" ><i class="dw dw-delete-3"></i> Revoke Permission </button>
                                </form>
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
<noscript
><iframe
        src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
        height="0"
        width="0"
        style="display: none; visibility: hidden"
    ></iframe
    ></noscript>

