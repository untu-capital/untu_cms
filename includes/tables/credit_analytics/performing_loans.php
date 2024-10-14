<!-- table widget -->
<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">Performing Loans</h4>
    </div>
    <div class="pb-20">
        <table class="data-table table stripe hover multiple-select-row nowrap">
            <thead>
            <tr>
                <th class="table-plus datatable-nosort">Account No</th>
                <th>Client Name</th>
                <th>Mobile Number</th>
                <th>Loan Officer</th>
                <th>Principal</th>
                <th>No. of Repayments</th>
                <th>Days in Arrears</th>
            </tr>
            </thead>
            <tbody>
            <?php
            function get_performing_loans() {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/musoni/getLoansByFilter/300/10000/10");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_response = curl_exec($ch);
                curl_close($ch);
                $data = json_decode($server_response, true);
                if ($data !== null && is_array($data)) {
                    return $data;
                } else {
                    return [];
                }
            }


            $performing_loans = get_performing_loans(); // Method to fetch performing loans
            foreach($performing_loans as $loan):
                ?>
                <tr>
                    <td class="table-plus"><?= htmlspecialchars($loan->getAccountNo()) ?></td>
                    <td><?= htmlspecialchars($loan->getClientName()) ?></td>
                    <td><?= htmlspecialchars($loan->getClientMobile()) ?></td>
                    <td><?= htmlspecialchars($loan->getLoanOfficerName()) ?></td>
                    <td><?= htmlspecialchars($loan->getPrincipal()) ?></td>
                    <td><?= htmlspecialchars($loan->getNumberOfRepayments()) ?></td>
                    <td><?= htmlspecialchars($loan->getDaysInArrears()) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
