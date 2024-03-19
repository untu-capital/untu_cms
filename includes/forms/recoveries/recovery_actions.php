<form method="post" action="">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <h5 class="card-title text-blue" style="text-decoration: underline;">Cause Of Arrears</h5>
                <textarea type="text" id="arrears" name="arrears" required="required" maxlength = "40" minlength="4" class="form-control">Cause Of Arrears</textarea>
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <h5 class="card-title text-blue" style="text-decoration: underline;">Agreed Action Points</h5>
                <textarea type="text" id="action_point" name="action_point" required="required" class="form-control">Agreed action Point</textarea>
            </div>
        </div>
    </div>


    <table class="table table-striped table-bordered" id="table_field">
        <tr>
            <th>Updated On:</th>
            <th>Cause of Arrears</th>
            <th>Agreed Action Points</th>
            <th>Comment</th>
<!--            <th>Repayment Type</th>-->
            <th>Agreed Amount</th>
            <th>Handed over To</th>
<!--            <th>Status</th>-->
            <th>Start Date</th>

        </tr>

        <?php $recovery_actionPlans = recovery_actionPlans($_GET['recovery_id']);
            foreach ($recovery_actionPlans as $data):
                ?>
        <tr>
            <td><?php echo (new DateTime($data['createdAt']))->format('d F Y'); ?></td>
            <td><?php echo $data['causeOfArrears']; ?></td>
            <td><?php echo $data['agreedActionPoints']; ?></td>
<!--            <td>--><?php //echo $data['comments']; ?><!--</td>-->
            <td><?php echo $data['repaymentType']; ?></td>
            <td><?php echo "$" . number_format($data['agreedAmount'], 2); ?></td>
            <td><?php echo $data['legalEntity'];?></td>
<!--            <td>--><?php //echo $data['status'] ;?><!--</td>-->
            <td><?php echo isset($data['startDate']) ? (new DateTime($data['startDate']))->format('d M Y') : ''; ?></td>


        </tr>
        <?php endforeach; ?>

        <?php $last_action = last_saved_action_plan($_GET['recovery_id']); ?>
        <tr>
            <td><input class="form-control" type="text" name="created_at" disabled value="<?php echo date("d M Y");?>"></td>

            <td><?php echo $last_action['causeOfArrears']; ?></td>
            <td><?php echo $last_action['agreedActionPoints']; ?></td>
<!--            <td><input class="form-control" type="text" name="comments" placeholder="--><?php //echo $last_action['comments']; ?><!--"></td>-->

            <td>
                <select class="custom-select2 form-control" name="repaymentType" autocomplete="off" style="width: 100%; height: 38px" >
                    <option value="WEEKLY"<?php if ($last_action['repaymentType'] === 'WEEKLY') echo ' selected'; ?>>Weekly payments</option>
                    <option value="MONTHLY"<?php if ($last_action['repaymentType'] === 'MONTHLY') echo ' selected'; ?>>Monthly payments</option>
                    <option value="LITIGATION"<?php if ($last_action['repaymentType'] === 'LITIGATION') echo ' selected'; ?>>Litigation</option>
                </select>
            </td>
            <td>
                <input class="form-control" type="number" placeholder="<?php echo $last_action['agreedAmount']; ?>" name="agreed_amount">
            </td>
            <td>
                <select class="custom-select2 form-control" name="legal" autocomplete="off" style="width: 100%; height: 38px" >
                    <option value="branch"<?php if ($last_action['legalEntity'] === 'branch') echo ' selected'; ?>>Branch</option>
                    <option value="collectors"<?php if ($last_action['legalEntity'] === 'collectors') echo ' selected'; ?>>Collectors</option>
                    <option value="danziger"<?php if ($last_action['legalEntity'] === 'danziger') echo ' selected'; ?>>Danziger</option>
                    <option value="nyamundanda"<?php if ($last_action['legalEntity'] === 'nyamundanda') echo ' selected'; ?>>Nyamundanda</option>
                </select>
            </td>
<!--            <td>-->
<!--                <select class="custom-select2 form-control" name="status" autocomplete="off" style="width: 100%; height: 38px">-->
<!--                    <option value="PENDING"--><?php //if ($last_action['status'] === 'PENDING') echo ' selected'; ?><!--On Track</option>-->
<!--                    <option value="ON_TRACK"--><?php //if ($last_action['status'] === 'ON_TRACK') echo ' selected'; ?><!--On Track</option>-->
<!--                    <option value="OFF_TRACK"--><?php //if ($last_action['status'] === 'OFF_TRACK') echo ' selected'; ?><!--Off Track</option>-->
<!--                </select>-->
<!--            </td>-->

<!--            <td><input class="form-control" type="number" name="movement" placeholder="--><?php //echo $last_action['movement']; ?><!--"></td>-->

            <td>
                <input class="form-control date-picker" type="text" name="start_date" placeholder="<?php echo $last_action['startDate']; ?>">
            </td>

        </tr>


    </table>
    <input class="form-control" type="hidden" name="loanId" required value="<?php echo $_GET['recovery_id'] ?>">
    <button class="btn btn-success btn-lg btn-block" type = "submit" name= "set_recovery_actions">Click To Update </button>
    <br><br>
</form>