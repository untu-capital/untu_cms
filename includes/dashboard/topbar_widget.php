<!-- topbar title -->
<!-- <div class="row">
	<div class="col-md-6 col-sm-12">
		<div class="title">
			<h4>Dashboard</h4>
		</div>
		<nav aria-label="breadcrumb" role="navigation">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">
					Dashboard
				</li>
			</ol>
		</nav>
	</div>
	<div class="col-md-6 col-sm-12 text-right">
		<div class="dropdown">
			<a
				class="btn btn-primary dropdown-toggle"
				href="#"
				role="button"
				data-toggle="dropdown"
			>
				January 2018
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item" href="#">Export List</a>
				<a class="dropdown-item" href="#">Policies</a>
				<a class="dropdown-item" href="#">View Assets</a>
			</div>
		</div>
	</div>
</div> -->


<!-- <div class="xs-pd-20-10 pd-ltr-20"> -->
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4><?php echo $nav_header ?></h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">
										<?php echo $nav_header ?>
									</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
                            <form action="" method="post">
                                <div class="form-group row">
                                    <div class="col">
                                        <button class="btn btn-primary" type="submit" name="pick_range" role="button"><?php echo Date('d F Y'); ?></button>
                                    </div>
                                    <div class="col">
                                        <input class="form-control datetimepicker-range" placeholder="Select Range" type="text" name="date_range" />
                                    </div>
                                </div>
                            </form>
<!--							<div class="dropdown">-->
<!--								<a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">--><?php //echo Date('d F Y'); ?><!--</a>-->
<!--								<div class="dropdown-menu dropdown-menu-right">-->
<!--									<a class="dropdown-item" href="#">Export List</a>-->
<!--								</div>-->
<!--							</div>-->
						</div>
					</div>
				</div>