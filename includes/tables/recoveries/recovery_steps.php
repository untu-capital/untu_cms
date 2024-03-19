<?php

?>


<table class="table table-striped">
    <thead>
    <?php $steps = get_next_steps($_GET['recovery_id']); ?>
    <tr>
        <th scope="col">Loan ID</th>
        <th scope="col">Summons</th>
        <th scope="col">Default Judgement</th>
        <th scope="col">Write of Execution</th>
        <th scope="col">Property Disposal</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo $steps['loanId']; ?></td>
        <td><?php echo $steps['summons']; ?></td>
        <td><?php echo $steps['defaultJudgement']; ?></td>
        <td><?php echo $steps['writeOfExecution']; ?></td>
        <td><?php echo $steps['propertyDisposal']; ?></td>

    </tr>
    </tbody>
</table>

