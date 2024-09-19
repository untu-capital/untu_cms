<div class="card-box mb-30">
    <div class="pd-20">

        <div class="table-responsive">
            <?php
//            error_reporting(E_ALL);
//            ini_set('display_errors', 1);

            // Example usage
            $xdsData = get_consumer_data();

            if (is_array($xdsData) && !empty($xdsData)) {
                $consumer = $xdsData;
            } else {
                echo "No data available.";
                return;
            }
            ?>

            <!-- Summary Section -->
            <h4>Personal Summary</h4>
            <table class="table table-bordered table-striped" style="margin: 2%;">
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Consumer ID</td>
                    <td><?php echo isset($consumer["consumerId"]) ? htmlspecialchars($consumer["consumerId"]) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <td>National ID</td>
                    <td><?php echo isset($consumer["natId"]) ? htmlspecialchars($consumer["natId"]) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <td>Surname</td>
                    <td><?php echo isset($consumer["surname"]) ? htmlspecialchars($consumer["surname"]) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><?php echo isset($consumer["firstName"]) ? htmlspecialchars($consumer["firstName"]) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><?php echo isset($consumer["gender"]) ? htmlspecialchars($consumer["gender"]) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><?php echo isset($consumer["dob"]) ? htmlspecialchars(date("Y-m-d", strtotime($consumer["dob"]))) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <td>Rating</td>
                    <td><?php echo isset($consumer["rating"]) ? htmlspecialchars($consumer["rating"]) : 'N/A'; ?></td>
                </tr>
                </tbody>
            </table>

            <!-- Financial Summary Section -->
            <h3>Financial Summary</h3>
            <table class="table table-bordered table-striped" style="margin: 2%;">
                <thead>
                <tr>
                    <th>Total Accounts</th>
                    <th>Total Good Accounts</th>
                    <th>Total Overdue Accounts</th>
                    <th>Total Current Balances</th>
                    <th>Total Loans Drawn</th>
                    <th>Total Installments</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo isset($consumer["totalAccounts"]) ? htmlspecialchars($consumer["totalAccounts"]) : 'N/A'; ?></td>
                    <td><?php echo isset($consumer["totalGoodAccounts"]) ? htmlspecialchars($consumer["totalGoodAccounts"]) : 'N/A'; ?></td>
                    <td><?php echo isset($consumer["totalOverdueAccounts"]) ? htmlspecialchars($consumer["totalOverdueAccounts"]) : 'N/A'; ?></td>
                    <td><?php echo isset($consumer["totalCurrentBalances"]) ? "$" . number_format($consumer["totalCurrentBalances"], 2) : 'N/A'; ?></td>
                    <td><?php echo isset($consumer["totalLoansDrawn"]) ? "$" . number_format($consumer["totalLoansDrawn"], 2) : 'N/A'; ?></td>
                    <td><?php echo isset($consumer["totalInstallments"]) ? "$" . number_format($consumer["totalInstallments"], 2) : 'N/A'; ?></td>
                </tr>
                </tbody>
            </table>

            <!-- Accounts Section -->
            <h3>Accounts</h3>
            <?php if (!empty($consumer["accounts"])): ?>
                <table class="table table-bordered table-striped" style="margin: 2%;">
                    <thead>
                    <tr>
                        <th>Account No</th>
                        <th>Account Type</th>
                        <th>Date Opened</th>
                        <th>Current Balance</th>
                        <th>Status</th>
                        <th>Subscriber</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($consumer["accounts"] as $account): ?>
                        <tr>
                            <td><?php echo isset($account["accountNo"]) ? htmlspecialchars($account["accountNo"]) : 'N/A'; ?></td>
                            <td><?php echo isset($account["accountType"]) ? htmlspecialchars($account["accountType"]) : 'N/A'; ?></td>
                            <td><?php echo isset($account["dateOpened"]) ? htmlspecialchars(date("Y-m-d", strtotime($account["dateOpened"]))) : 'N/A'; ?></td>
                            <td><?php echo isset($account["currentBalance"]) ? "$" . number_format($account["currentBalance"], 2) : 'N/A'; ?></td>
                            <td><?php echo isset($account["accountStatus"]) ? htmlspecialchars($account["accountStatus"]) : 'N/A'; ?></td>
                            <td><?php echo isset($account["subscriber"]) ? htmlspecialchars($account["subscriber"]) : 'N/A'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No accounts available.</p>
            <?php endif; ?>

            <!-- Adverse Accounts Section -->
            <h3>Adverse Accounts</h3>
            <?php if (!empty($consumer["adverseAccounts"])): ?>
                <table class="table table-bordered table-striped" style="margin: 2%;">
                    <thead>
                    <tr>
                        <th>Account No</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($consumer["adverseAccounts"] as $adverseAccount): ?>
                        <tr>
                            <td><?php echo isset($adverseAccount["accountNo"]) ? htmlspecialchars($adverseAccount["accountNo"]) : 'N/A'; ?></td>
                            <td><?php echo isset($adverseAccount["amount"]) ? "$" . number_format($adverseAccount["amount"], 2) : 'N/A'; ?></td>
                            <td><?php echo isset($adverseAccount["status"]) ? htmlspecialchars($adverseAccount["status"]) : 'N/A'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No adverse accounts available.</p>
            <?php endif; ?>

            <!-- Addresses Section -->
            <h3>Addresses</h3>
            <?php if (!empty($consumer["addresses"])): ?>
                <table class="table table-bordered table-striped" style="margin: 2%;">
                    <thead>
                    <tr>
                        <th>Address 1</th>
                        <th>Address 2</th>
                        <th>Address 3</th>
                        <th>Address 4</th>
                        <th>Last Update Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($consumer["addresses"] as $address): ?>
                        <tr>
                            <td><?php echo isset($address["address1"]) ? htmlspecialchars($address["address1"]) : 'N/A'; ?></td>
                            <td><?php echo !empty($address["address2"]) ? htmlspecialchars($address["address2"]) : 'N/A'; ?></td>
                            <td><?php echo !empty($address["address3"]) ? htmlspecialchars($address["address3"]) : 'N/A'; ?></td>
                            <td><?php echo !empty($address["address4"]) ? htmlspecialchars($address["address4"]) : 'N/A'; ?></td>
                            <td><?php echo isset($address["lastUpdateDate"]) ? htmlspecialchars(date("Y-m-d", strtotime($address["lastUpdateDate"]))) : 'N/A'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No addresses available.</p>
            <?php endif; ?>

            <!-- Contacts Section -->
            <h3>Contacts</h3>
            <?php if (!empty($consumer["contacts"])): ?>
                <table class="table table-bordered table-striped" style="margin: 2%;">
                    <thead>
                    <tr>
                        <th>Contact Type</th>
                        <th>Telephone</th>
                        <th>Last Update Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($consumer["contacts"] as $contact): ?>
                        <tr>
                            <td><?php echo isset($contact["contactType"]) ? htmlspecialchars($contact["contactType"]) : 'N/A'; ?></td>
                            <td><?php echo isset($contact["telephone"]) ? htmlspecialchars($contact["telephone"]) : 'N/A'; ?></td>
                            <td><?php echo isset($contact["lastUpdateDate"]) ? htmlspecialchars(date("Y-m-d", strtotime($contact["lastUpdateDate"]))) : 'N/A'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No contacts available.</p>
            <?php endif; ?>
        </div>

    </div>
</div>
