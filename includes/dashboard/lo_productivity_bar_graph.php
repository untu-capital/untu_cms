<?php
    function getLoanOfficersList() {
        $productivity_charts = getLoTotalPipelineAndDisbursements();
        $loan_officers = [];

        foreach ($productivity_charts as $data){
            $loan_officer = user($data['loanOfficer']);
            $loan_officers[] = $loan_officer['firstName'].' '.$loan_officer['lastName'];
        }

        // Convert loan officer IDs to a list format
        $loan_officers_list = array_values(array_unique($loan_officers));

        return $loan_officers_list;
    }

    function getTotalDisbursedList() {
        $productivity_charts = getLoTotalPipelineAndDisbursements();
        $total_disbursed = [];

        foreach ($productivity_charts as $data){
            $total_disbursed[] = $data['totalDisbursed'];
        }

        // Convert loan officer IDs to a list format
        $total_disbursed_list = array_values(array_unique($total_disbursed));

        return $total_disbursed_list;
    }

    function getTotalPipelineList() {
        $productivity_charts = getLoTotalPipelineAndDisbursements();
        $total_pipeline = [];

        foreach ($productivity_charts as $data){
            $total_pipeline[] = $data['totalPipeline'];
        }

        // Convert loan officer IDs to a list format
        $total_pipeline_list = array_values(array_unique($total_pipeline));

        return $total_pipeline_list;
    }


$_SESSION['loanOfficersList'] = getLoanOfficersList();
$_SESSION['totalDisbursedList'] = getTotalDisbursedList();
$_SESSION['totalPipelineList'] = getTotalPipelineList();



?>




<div class="bg-white pd-20 card-box mb-30">
    <h4 class="h4 text-blue">Productivity Chart</h4>
    <div id="chart3"></div>
</div>

<script>
    // Retrieve loan officers list from PHP session and assign it to a JavaScript variable
    var loanOfficersList = <?php echo json_encode($_SESSION['loanOfficersList']); ?>;
    var totalDisbursedList = <?php echo json_encode($_SESSION['totalDisbursedList']); ?>;
    var totalPipelineList = <?php echo json_encode($_SESSION['totalPipelineList']); ?>;
</script>