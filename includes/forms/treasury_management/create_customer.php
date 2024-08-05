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
            <h5>Banking Details</h5>
            <section>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="BankName">Bank Name:</label>
                            <input id="BankName" name="BankName" type="text" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="BankBranch">Branch</label>
                            <input id="BankBranch" name="BankBranch" type="text"
                                   class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="BankAccountNumber">Account Number</label>
                            <input id="BankAccountNumber" name="BankAccountNumber" type="number"
                                   class="form-control"/>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="SwiftCode">Swift Code :</label>
                                <input id="SwiftCode" name="SwiftCode" class="form-control" type="text"/>
                            </div>
                            <div class="form-group col-6">
                                <label for="currency">Currency Denomination</label>
                                <select class="custom-select2 form-control" name="currency" autocomplete="off" style="width: 100%; height: 38px" >
                                    <option value="USD">USD</option>
                                    <option value="ZIG">ZIG</option>
                                </select>
                            </div>
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