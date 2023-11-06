<?php
    $vault_accs = vaults("all");
    $vaults = array_merge($vault_accs, ["Total Vaults Balances"]);
//    $vaults = array_merge($vault_accs);

    if ($_SESSION['branch'] != "Head Office"){
        $vaults = vaults("byBranch/$_SESSION[branch]");
    }
//
//    $widget_disburse = ["1100000", "1240000", "620000", "524000", "285000", "3210000"];
//    $widget_pipeline = ["210000", "180000", "124000", "68000", "80000", "987000"];

?>

<!-- summary widget -->
<div class="row">
	<?php
        foreach ($vaults as $vault) {
        ?>
	<div class="col-xl-4 mb-30">
		<div class="card-box height-100-p widget-style1">
			<div class="d-flex flex-wrap align-items-center">
				<div class="widget-data">
					<div class="weight-600 font-16 mb-0"><?php echo $vault['name']."($vault[account])"; ?></div>
<!--					<div class="weight-600 font-14">Available Bal : --><?php //echo '$ ' . number_format($branch_vault['amount'], 2, '.', ','); ?><!--</div>-->
<!--                    <div class="weight-600 font-14">Set Limit : --><?php //echo '$ ' . number_format($branch_vault['amount'], 2, '.', ','); ?><!--</div>-->
				</div>
			</div>
            <br>
            <div class="pd-5 card-box">
                <div class="weight-600 font-16">Available Bal : <?php echo '$ ' . number_format(pastel_acc_balances($vault['account']),'2','.',','); ?></div>
                <div class="progress mb-20">
                    <?php if ((pastel_acc_balances($vault['account'])/$vault['maxAmount'])*100 <= 60) {
                        $color = 'bg-success';
                    } elseif ((pastel_acc_balances($vault['account'])/$vault['maxAmount'])*100 > 60 && (pastel_acc_balances($vault['account'])/$vault['maxAmount'])*100 <= 80){
                        $color = 'bg-warning';
                    } elseif ((pastel_acc_balances($vault['account'])/$vault['maxAmount'])*100 > 80 && (pastel_acc_balances($vault['account'])/$vault['maxAmount'])*100 <= 90){
                        $color = 'bg-orange';
                    } else {
                        $color = '';
                    }?>
                    <div class="progress-bar <?php echo $color; ?> progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo (pastel_acc_balances($vault['account'])/$vault['maxAmount'])*100?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="weight-600 font-16">Vault Limit : <?php echo '$ ' . number_format($vault['maxAmount'], 2, '.', ','); ?></div>
                <div class="progress mb-20">
                    <div
                            class="progress-bar bg-info progress-bar-striped progress-bar-animated"
                            role="progressbar"
                            style="width: 100%"
                            aria-valuenow="25"
                            aria-valuemin="0"
                            aria-valuemax="100"
                    ></div>
                </div>
            </div>
		</div>
	</div>
	<?php }; ?>
</div>




