
<!-- Default Basic Forms Start -->
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Update Budget</h4>
        </div>
    </div>
    <form method="POST" action="">
        <?php $po_budget = poBudget("/".$_GET['budgetId']) ?>
        <input name="budgetId" value="<?php echo $po_budget['id'] ?>" hidden="hidden">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Category Name</label>
                    <input value="<?php echo $po_budget['category'] ?>" placeholder="category name" type="text" class="form-control" required name="category">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Year</label>
                    <input value="<?php echo $po_budget['year'] ?>" placeholder="2023" type="text" class="form-control" required name="year">
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
                    <input value="<?php echo $po_budget['january'] ?>" type="number" class="form-control" required name="january">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>February</label>
                    <input value="<?php echo $po_budget['february'] ?>" type="number" class="form-control" required name="february">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>March</label>
                    <input value="<?php echo $po_budget['march'] ?>" type="number" class="form-control" required name="march">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>April</label>
                    <input value="<?php echo $po_budget['april'] ?>" type="number" class="form-control" required name="april">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>May</label>
                    <input value="<?php echo $po_budget['may'] ?>" type="number" class="form-control" required name="may">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>June</label>
                    <input value="<?php echo $po_budget['june'] ?>" type="number" class="form-control" required name="june">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>July</label>
                    <input value="<?php echo $po_budget['july'] ?>" type="number" class="form-control" required name="july">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>August</label>
                    <input value="<?php echo $po_budget['august'] ?>" type="number" class="form-control" required name="august">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>September</label>
                    <input value="<?php echo $po_budget['september'] ?>" type="number" class="form-control" required name="september">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>October</label>
                    <input value="<?php echo $po_budget['october'] ?>" type="number" class="form-control" required name="october">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>November</label>
                    <input value="<?php echo $po_budget['november'] ?>" type="number" class="form-control" required name="november">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>December</label>
                    <input value="<?php echo $po_budget['december'] ?>" type="number" class="form-control" required name="december">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 col-md-2 col-form-label">
                <button name="update_po_budget" class="btn btn-success" type="submit">Update</button>
            </div>
            <div class="col-sm-12 col-md-2 col-form-label">
                <a href="requisitions.php?menu=main" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </form>
</div>
<!-- Default Basic Forms End -->
