
        <?php include('includes/dashboard/small_summary_widget.php'); ?>

        <div class="row clearfix progress-box">
            <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <div class="progress-box text-center">
                        <input type="text" class="knob dial1" value="80" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#1b00ff" data-angleOffset="180" readonly/>
                        <h5 class="text-blue padding-top-10 h5">Upcoming Receipts</h5>
                        <span class="d-block">8 <i class="fa fa-line-chart text-blue"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <div class="progress-box text-center">
                        <input type="text" class="knob dial2" value="70" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#00e091" data-angleOffset="180" readonly/>
                        <h5 class="text-light-green padding-top-10 h5">Upcoming Payments</h5>
                        <span class="d-block">7 <i class="fa text-light-green fa-line-chart"></i></span>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-7 col-md-12 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <h4 class="mb-30 h4">Share price  Trend</h4>
                    <div id="compliance-trend" class="compliance-trend"></div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <h4 class="mb-30 h4">Records</h4>
                    <div id="chart" class="chart"></div>
                </div>
            </div>
        </div>

    <div class="bg-white pd-20 card-box mb-30">
        <div id="chart2"></div>
    </div>

