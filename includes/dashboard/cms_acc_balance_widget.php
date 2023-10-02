<?php
    $vault_acc = ["Harare", "HarareA", "Bulawayo", "Gweru", "Gokwe"];

    $branch_vaults = array_merge($vault_acc, ["All Branches Total"]);
    $widget_disburse = ["1100000", "1240000", "620000", "524000", "285000", "3210000"];
    $widget_pipeline = ["210000", "180000", "124000", "68000", "80000", "987000"];

?>

<!-- summary widget -->
<div class="row">
	<?php
        foreach ($branch_vaults as $branch_vault) {
        ?>
	<div class="col-xl-4 mb-30">
		<div class="card-box height-100-p widget-style1">
			<div class="d-flex flex-wrap align-items-center">
				<div class="widget-data">
					<div class="h4 mb-0"><?php echo $branch_vault; ?></div>
<!--					<div class="weight-600 font-14">Available Bal : --><?php //echo '$ ' . number_format($branch_vault['amount'], 2, '.', ','); ?><!--</div>-->
<!--                    <div class="weight-600 font-14">Set Limit : --><?php //echo '$ ' . number_format($branch_vault['amount'], 2, '.', ','); ?><!--</div>-->
				</div>
			</div>
            <br>
            <div class="pd-5 card-box">
                <div class="weight-600 font-18">Available Bal : <?php echo '$ ' . number_format($branch_vault['amount'], 2, '.', ','); ?></div>
<!--                <div class="progress mb-20">-->
<!--                    <div-->
<!--                            class="progress-bar bg-success progress-bar-striped progress-bar-animated"-->
<!--                            role="progressbar"-->
<!--                            style="width: 70%"-->
<!--                            aria-valuenow="0"-->
<!--                            aria-valuemin="0"-->
<!--                            aria-valuemax="100"-->
<!--                    ></div>-->
<!--                </div>-->
                <div class="weight-600 font-18">Vault Limit : <?php echo '$ ' . number_format($branch_vault['amount'], 2, '.', ','); ?></div>
<!--                <div class="progress mb-20">-->
<!--                    <div-->
<!--                            class="progress-bar progress-bar-striped progress-bar-animated"-->
<!--                            role="progressbar"-->
<!--                            style="width: 100%"-->
<!--                            aria-valuenow="25"-->
<!--                            aria-valuemin="0"-->
<!--                            aria-valuemax="100"-->
<!--                    ></div>-->
<!--                </div>-->
            </div>
		</div>
	</div>
	<?php }; ?>
</div>




