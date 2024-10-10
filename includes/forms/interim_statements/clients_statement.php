
<?php if ($_GET['menu'] == "statement"){ ?>
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <h4 class="text-blue h4">Generate Interim Statement for Client</h4>
    </div>
    <form onsubmit="redirectToPdf(event)" method="POST">
        <section>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Enter Loan Account Number :</label>
                        <input type="number" class="form-control" name="acc_number" id="acc_number" required />
                    </div>
                </div>
            </div>
        </section>

        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <button type="submit" class="btn btn-danger">Generate Statement</button>
            </div>
        </div>
    </form>

    <script>
        function redirectToPdf(event) {
            event.preventDefault();  // Prevent form submission
            const accNumber = document.getElementById("acc_number").value;

            if (accNumber) {
                const url = `http://localhost:7878/api/utg/settlements/generateStyledStatementPdf/loanId/${accNumber}`;
                window.open(url, '_blank');  // Open in a new tab
            } else {
                alert("Please enter a loan account number.");
            }
        }
    </script>
</div>

<?php } else if ($_GET['menu'] == "reports") { ?>

    <?php
    function get_transaction_report($start_date, $end_date) {
        $url = "http://localhost:7878/api/utg/settlements/generateMaturedInterestsReport/$start_date/$end_date";

        // Initialize cURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the request
        $server_response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);

        // Decode the response into an associative array and return
        return json_decode($server_response, true);
    }
?>
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <h4 class="text-blue h4">Generate Interim Statement</h4>
        </div>

        <form method="post" action="interim_statements.php?menu=reports">
            <div class="form-group">
                <label>Start Date (YYYY-MM-DD):</label>
                <input type="date" class="form-control" name="start_date" id="start_date" required />
            </div>
            <div class="form-group">
                <label>End Date (YYYY-MM-DD):</label>
                <input type="date" class="form-control" name="end_date" id="end_date" required />
            </div>

            <button type="submit" class="btn btn-danger">Generate Report</button>
        </form>

        <h2 class="mt-5">Transaction Report</h2>
        <table class="table hover table stripe multiple-select-row data-table-export nowrap">
            <thead>
            <tr>
                <th>Transaction Date</th>
                <th>Description</th>
                <th>Amount</th>
<!--                <th>Cumulative Balance</th>-->
<!--                <th>Balance</th>-->
            </tr>
            </thead>
            <tbody>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get the start and end date from the form
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];

                // Fetch the transaction report data
                $transactions = get_transaction_report($start_date, $end_date);

                // Loop through each transaction and render it into the table
                foreach($transactions as $data): ?>
                    <tr>
                        <td><?= date('d-M-Y', strtotime($data['transactionDate'])) ?></td>
                        <td><?= htmlspecialchars($data["transactionDescription"]) ?></td>
                        <td><?= htmlspecialchars('$ ' . number_format($data["debit"], 2, '.', ',')) ?></td>
<!--                        <td>--><?php //= htmlspecialchars('$' . number_format($data["credit"], 2, '.', ',')) ?><!--</td>-->
<!--                        <td>--><?php //= htmlspecialchars('$ ' . number_format($data["balance"], 2, '.', ',')) ?><!--</td>-->
                    </tr>
                <?php endforeach; ?>
            <?php } ?>
            </tbody>
        </table>
    </div>

<?php } ?>