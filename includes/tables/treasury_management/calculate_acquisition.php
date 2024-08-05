<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <!-- Export Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row">
                    <div class="col-8">
                        <h4 class="text-blue h4">Calculate Acquisition</h4>
                    </div>
                    <div class="col-2">
                        <a class="btn-lg btn-block btn-success text-white text-center"
                           href="special_assets_tracker.php?menu=add_equity"><i
                                class="icon-copy bi bi-plus-lg"></i>
                            Add
                        </a>
                    </div>
                    <div class="col-2">
                        <a class="btn-lg btn-block btn-primary text-white text-center"
                           href="special_assets_tracker.php?menu=main"><i
                                class="icon-copy bi bi-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="pd-20">
                <div class="wizard-content">
                    <form method="POST" action="" class="tab-wizard wizard-circle wizard">
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Counter :</label>
                                        <select id="type" class="form-select form-control"
                                                aria-label="Default select example">
                                            <option value="USD">USD</option>
                                            <option value="ZIG">ZIG</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Inter Market Bank Rate :</label>
                                        <input id="email" name="email" type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <h5>Price Per Share</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zwlBankName">ZIG:</label>
                                        <input id="zwlBankName" name="zwlBankName" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zwlBankName">USD:</label>
                                        <input id="zwlBankName" name="zwlBankName" type="text" class="form-control"/>
                                    </div>

                                </div>
                            </div>
                        </section>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <button class="btn btn-success" type="submit" name="create_customer_info">Calculate
                                </button>
                            </div>
                            <div class="col-sm-12 col-md-2 col-form-label">
                                <button class="btn btn-primary" type="submit" name="create_customer_info">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="pb-20">
                <table class="table hover table stripe multiple-select-row data-table-export nowrap">
                    <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Counter</th>
                        <th>Agent</th>
                        <th>Currency</th>
                        <th>Date of Acquisition</th>
                        <th>Number of Shares</th>
                        <th>Price Per Share (ZIG)</th>
                        <th>Transaction Cost</th>
                        <th>Acquisition</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $data = customer_list();
                    foreach ($data as $row):?>
                        <tr>
                            <td class="table-plus"><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phoneNumber']; ?></td>
                            <td><?php echo $row['phoneNumberOther']; ?></td>
                            <td><?php echo $row['phoneNumberOther']; ?></td>
                            <td><?php echo $row['phoneNumberOther']; ?></td>
                            <td><?php echo $row['phoneNumberOther']; ?></td>
                            <td><?php echo $row['phoneNumberOther']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Export Datatable End -->
    </div>
</div>