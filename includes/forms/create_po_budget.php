
<!-- Default Basic Forms Start -->
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Add Budget</h4>
        </div>
    </div>
    <form method="POST" action="">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Category Name</label>
                    <select class="custom-select2 form-control" name="category" style="width: 100%; height: 38px">
                        <optgroup label="Categories">
                            <option value="" >Please Select Category</option>
                            <option value="All" >All Categories</option>
                            <?php
                            $categories = categories();
                            foreach ($categories as $row):?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Year</label>
                    <select class="custom-select2 form-control" name="year" style="width: 100%; height: 38px">
                        <optgroup label="Year" id="year">
                            <?php
                            // Get the current year using PHP
                            $currentYear = date("Y");

                            // Define a range of years (e.g., 10 years back to 10 years ahead)
                            $startYear = $currentYear - 10;
                            $endYear = $currentYear + 10;

                            // Generate options for the select dropdown
                            for ($year = $startYear; $year <= $endYear; $year++) {
                                // Set the selected attribute for the current year
                                $selected = ($year == $currentYear) ? 'selected' : '';

                                // Output the option element
                                echo "<option value=\"$year\" $selected>$year</option>";
                            }
                            ?>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Total</label>
                    <input type="number" class="form-control" name="total">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>January</label>
                    <input type="number" class="form-control" required name="january">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>February</label>
                    <input type="number" class="form-control" required name="february">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>March</label>
                    <input type="number" class="form-control" required name="march">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>April</label>
                    <input type="number" class="form-control" required name="april">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>May</label>
                    <input type="number" class="form-control" required name="may">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>June</label>
                    <input type="number" class="form-control" required name="june">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>July</label>
                    <input type="number" class="form-control" required name="july">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>August</label>
                    <input type="number" class="form-control" required name="august">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>September</label>
                    <input type="number" class="form-control" required name="september">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>October</label>
                    <input type="number" class="form-control" required name="october">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>November</label>
                    <input type="number" class="form-control" required name="november">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>December</label>
                    <input type="number" class="form-control" required name="december">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 col-md-2 col-form-label">
                <button class="btn btn-success" type="submit" name="create_category">Save</button>
            </div>
            <div class="col-sm-12 col-md-2 col-form-label">
                <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </form>
</div>
<!-- Default Basic Forms End -->


