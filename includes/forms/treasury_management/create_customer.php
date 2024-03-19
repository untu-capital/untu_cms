
<div class="main-container">
    <div class="pd-ltr-20">

        <?php if ($_GET['menu'] == "main") { ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('success')) {
                        // Display a popup or alert message
                        alert('Deleted successfully');
                    }
                });
            </script>
        <?php include('../includes/tables/treasury_management/customers.php'); ?>

        <?php }
        //<======= Add Customer Form=======>
        elseif ($_GET['menu'] == 'add_customer'){
        ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Add Customer Information Details</h4>
                    </div>
                </div>
                <hr>
                <div class="wizard-content">
                    <form method="POST" action="" class="tab-wizard wizard-circle wizard">
                        <h5>Counterparty Details</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name :</label>
                                        <input id="name" name="name" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address :</label>
                                        <input id="email" name="email" type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumber">Phone Number :</label>
                                        <input id="phoneNumber" name="phoneNumber" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumberOther">Phone Number (other) :</label>
                                        <input id="phoneNumberOther" name="phoneNumberOther" type="text"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Physical Address :</label>
                                        <textarea id="address" name="address" rows="4" type="text"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 2 -->
                        <h5>Contact Person</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contactPersonName">Full Name:</label>
                                        <input id="contactPersonName" name="contactPersonName" type="text"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contactPersonJobTitle">Job Title :</label>
                                        <input id="contactPersonJobTitle" name="contactPersonJobTitle" type="text"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 3 -->
                        <h5>Banking Details (ZWL)</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zwlBankName">Bank Name:</label>
                                        <input id="zwlBankName" name="zwlBankName" type="text" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="zwlBankBranch">Branch</label>
                                        <input id="zwlBankBranch" name="zwlBankBranch" type="text"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zwlBankAccountNumber">Account Number</label>
                                        <input id="zwlBankAccountNumber" name="zwlBankAccountNumber" type="number"
                                               class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="zwlSwiftCode">Swift Code :</label>
                                        <input id="zwlSwiftCode" name="zwlSwiftCode" class="form-control" type="text"/>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 3 -->
                        <h5>Banking Details (USD)</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usdBankName">Bank Name:</label>
                                        <input id="usdBankName" name="usdBankName" type="text" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="usdBankBranch">Branch</label>
                                        <input id="usdBankBranch" name="usdBankBranch" type="text"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usdBankAccountNumber">Account Number</label>
                                        <input id="usdBankAccountNumber" name="usdBankAccountNumber" type="number"
                                               class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="usdSwiftCode">Swift Code :</label>
                                        <input id="usdSwiftCode" name="usdSwiftCode" class="form-control" type="text"/>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <button class="btn btn-success" type="submit" name="create_customer_info">Save</button>
                            </div>
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <a href="treasury_management.php?menu=main" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'view_customer'){
        $data = getCustomerInfo($_GET['customerId']);
        ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Customer Information Details</h4>
                    </div>
                </div>
                <hr>
                <div class="wizard-content">
                    <form class="tab-wizard wizard-circle wizard">
                        <!-- Step 1 -->
                        <h5>Counterparty Details</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name :</label>
                                        <input id="name" name="name" type="text" class="form-control"
                                               value="<?php echo $data['name'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address :</label>
                                        <input id="email" name="email" type="text" class="form-control"
                                               value="<?php echo $data['email'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumber">Phone Number :</label>
                                        <input id="phoneNumber" name="phoneNumber" type="text" class="form-control"
                                               value="<?php echo $data['phoneNumber'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumberOther">Phone Number (other) :</label>
                                        <input id="phoneNumberOther" name="phoneNumberOther" type="text"
                                               class="form-control"
                                               value="<?php echo $data['phoneNumberOther'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Physical Address :</label>
                                        <textarea id="address" name="address" rows="4" type="text" class="form-control"
                                                  readonly="readonly"><?php echo $data['address'] ?? ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 2 -->
                        <h5>Contact Person</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contactPersonName">Full Name:</label>
                                        <input id="contactPersonName" name="contactPersonName" type="text"
                                               class="form-control"
                                               value="<?php echo $data['contactPersonName'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contactPersonJobTitle">Job Title :</label>
                                        <input id="contactPersonJobTitle" name="contactPersonJobTitle" type="text"
                                               class="form-control"
                                               value="<?php echo $data['contactPersonJobTitle'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 3 -->
                        <h5>Banking Details (ZWL)</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zwlBankName">Bank Name:</label>
                                        <input id="zwlBankName" name="zwlBankName" type="text" class="form-control"
                                               value="<?php echo $data['zwlBankName'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="zwlBankBranch">Branch</label>
                                        <input id="zwlBankBranch" name="zwlBankBranch" type="text" class="form-control"
                                               value="<?php echo $data['zwlBankBranch'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zwlBankAccountNumber">Account Number</label>
                                        <input id="zwlBankAccountNumber" name="zwlBankAccountNumber" type="number"
                                               class="form-control"
                                               value="<?php echo $data['zwlBankAccountNumber'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="zwlSwiftCode">Swift Code :</label>
                                        <input id="zwlSwiftCode" name="zwlSwiftCode" class="form-control" type="text"
                                               value="<?php echo $data['zwlSwiftCode'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 4 -->
                        <h5>Banking Details (USD)</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usdBankName">Bank Name:</label>
                                        <input id="usdBankName" name="usdBankName" type="text" class="form-control"
                                               value="<?php echo $data['usdBankName'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="usdBankBranch">Branch</label>
                                        <input id="usdBankBranch" name="usdBankBranch" type="text" class="form-control"
                                               value="<?php echo $data['usdBankBranch'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usdBankAccountNumber">Account Number</label>
                                        <input id="usdBankAccountNumber" name="usdBankAccountNumber" type="number"
                                               class="form-control"
                                               value="<?php echo $data['usdBankAccountNumber'] ?? ''; ?>"
                                               readonly="readonly"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="usdSwiftCode">Swift Code :</label>
                                        <input id="usdSwiftCode" name="usdSwiftCode" class="form-control" type="text"
                                               value="<?php echo $data['usdSwiftCode'] ?? '';
                                               ?>" readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <a href="treasury_management.php?menu=main" class="btn btn-primary">Back</a></div>
                        </div>
                    </form>
                </div>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'update_customer'){
        $data = getCustomerInfo($_GET['customerId']);
        ?>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Update Customer Information Details</h4>
                    </div>
                </div>
                <hr>
                <div class="wizard-content">
                    <form method="POST" action="" class="tab-wizard wizard-circle wizard">
                        <!-- Step 1 -->
                        <h5>Counterparty Details</h5>
                        <div class="col-md-6" hidden="hidden">
                            <div class="form-group">
                                <label for="id">Name :</label>
                                <input id="id" name="id" type="text" class="form-control"
                                       value="<?php echo $data['id'] ?? ''; ?>"
                                />
                            </div>
                        </div>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name :</label>
                                        <input id="name" name="name" type="text" class="form-control"
                                               value="<?php echo $data['name'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address :</label>
                                        <input id="email" name="email" type="text" class="form-control"
                                               value="<?php echo $data['email'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumber">Phone Number :</label>
                                        <input id="phoneNumber" name="phoneNumber" type="text" class="form-control"
                                               value="<?php echo $data['phoneNumber'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneNumberOther">Phone Number (other) :</label>
                                        <input id="phoneNumberOther" name="phoneNumberOther" type="text"
                                               class="form-control"
                                               value="<?php echo $data['phoneNumberOther'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Physical Address :</label>
                                        <textarea id="address" name="address" rows="4" type="text" class="form-control"><?php echo $data['address'] ?? ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 2 -->
                        <h5>Contact Person</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contactPersonName">Full Name:</label>
                                        <input id="contactPersonName" name="contactPersonName" type="text"
                                               class="form-control"
                                               value="<?php echo $data['contactPersonName'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contactPersonJobTitle">Job Title :</label>
                                        <input id="contactPersonJobTitle" name="contactPersonJobTitle" type="text"
                                               class="form-control"
                                               value="<?php echo $data['contactPersonJobTitle'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 3 -->
                        <h5>Banking Details (ZWL)</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zwlBankName">Bank Name:</label>
                                        <input id="zwlBankName" name="zwlBankName" type="text" class="form-control"
                                               value="<?php echo $data['zwlBankName'] ?? ''; ?>"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="zwlBankBranch">Branch</label>
                                        <input id="zwlBankBranch" name="zwlBankBranch" type="text" class="form-control"
                                               value="<?php echo $data['zwlBankBranch'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zwlBankAccountNumber">Account Number</label>
                                        <input id="zwlBankAccountNumber" name="zwlBankAccountNumber" type="number"
                                               class="form-control"
                                               value="<?php echo $data['zwlBankAccountNumber'] ?? ''; ?>"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="zwlSwiftCode">Swift Code :</label>
                                        <input id="zwlSwiftCode" name="zwlSwiftCode" class="form-control" type="text"
                                               value="<?php echo $data['zwlSwiftCode'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 4 -->
                        <h5>Banking Details (USD)</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usdBankName">Bank Name:</label>
                                        <input id="usdBankName" name="usdBankName" type="text" class="form-control"
                                               value="<?php echo $data['usdBankName'] ?? ''; ?>"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="usdBankBranch">Branch</label>
                                        <input id="usdBankBranch" name="usdBankBranch" type="text" class="form-control"
                                               value="<?php echo $data['usdBankBranch'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usdBankAccountNumber">Account Number</label>
                                        <input id="usdBankAccountNumber" name="usdBankAccountNumber" type="number"
                                               class="form-control"
                                               value="<?php echo $data['usdBankAccountNumber'] ?? ''; ?>"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="usdSwiftCode">Swift Code :</label>
                                        <input id="usdSwiftCode" name="usdSwiftCode" class="form-control" type="text"
                                               value="<?php echo $data['usdSwiftCode'] ?? ''; ?>"
                                        />
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <button class="btn btn-success" type="submit" name="update_customer_info">Save</button>
                            </div>
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <a href="treasury_management.php?menu=main" class="btn btn-primary">Cancel</a></div>
                        </div>
                    </form>
                </div>
            </div>

        <?php }
        elseif ($_GET['menu'] == 'delete_customer') { ?>
            <?php
            $id = $_GET['vaultId'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost:7878/api/utg/cms/vault/delete/" . $id);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

            $server_response = curl_exec($ch);

            curl_close($ch);
            $data = json_decode($server_response, true);

            if ($data !== null) {
                $table = $data;

            } else {
                echo '<script>window.location.href = "cash_management.php?menu=main";</script>';
                echo "Error decoding JSON data";
            }
            ?>

        <?php }
        ?>

    </div>
</div>
