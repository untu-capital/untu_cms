<?php

?>
<!-- table widget -->

<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">
            Recoveries
        </h4>
    </div>

    <div class="pb-20">
        <table class="table hover table stripe multiple-select-row data-table-export nowrap">
            <thead>
            <tr>
                <th>Office</th>
                <th>Loan Officer Name</th>
                <th>Client Name</th>
                <th>Amount</th>
                <th>Principal</th>
                <th>Total Due</th>
                <th>Days In Arrears</th>
                <th>Day Since Payment</th>
                <th>Status</th>
                <th class="datatable-nosort">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $petty_cash = cms_petty_cash_payments();
            foreach($petty_cash as $petty):
                $user = user($petty["userid"]);
                 ?>
                <tr>
                    <td>Bulawayo Recoveries</td>
                    <td>Simbarashe Bare</td>
                    <td>Melody Mupenzwa</td>

                    <td>$6600</td>
                    <td>$6600</td>
                    <td>$7 951</td>
                    <td>1295</td>
                    <td>1280</td>

<!--                    <td>--><?php //= htmlspecialchars ($petty["count"]) ?><!--</td>-->
                    <td>
                        <!-- <span class="badge badge-pill" data-bgcolor="#FF0000" data-color="#fff">
						<?= htmlspecialchars ($petty["status"]) ?></span> -->

                        <?php if ($petty["status"] =="Approved") {
                            echo "<label style='padding: 7px;' class='badge badge-success'>On Track</label>";
                        } else {
                            echo "<label style='padding: 7px;' class='badge badge-danger'>Off Track</label>";
                        }
                        ?>
                    </td>

                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="recovery_info.php"><i class="dw dw-eye"></i> View</a>


                                <!--                                <form method="post" action="">-->
<!--                                    <input class="form-control" type="hidden" name="id" required value="--><?php //echo $petty['id'] ?><!--">-->
<!--                                    <button class="dropdown-item" type="submit" name="revoke_permission" ><i class="dw dw-delete-3"></i> Approve </button>-->
<!--                                </form>-->
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

