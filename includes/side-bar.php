<div class="left-side-bar">
			<div class="brand-logo">
				<a href="index.php">
					<img src="../vendors/images/untu-logo.png" alt="" class="dark-logo" />
					<img src="../vendors/images/untu-logo-white.png"alt="" class="light-logo"/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">

					<?php if ($check_role == "ROLE_LO"){ ?>

                        <ul id="accordion-menu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-house"></span
                                ><span class="mtext">Home</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="index.php">Dashboard</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"></span
                                ><span class="mtext">Loan Applications</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="loan_applications.php?state=unprocessed">New Applications</a></li>
                                    <li><a href="loan_applications.php?state=processed">Appraised Applications</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-folder"></span
                                ><span class="mtext">Pipeline Reporting</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="branch_pipeline_report.php">My Pipeline</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-textarea-resize"></span
                                ><span class="mtext">C.R.M</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="campaign_and_marketing.php?menu=main">Campaign and Marketing</a></li>
                                    <li><a href="lead_management.php?menu=main">Lead Management</a></li>
                                    <li><a href="client_retention.php">Client Retention</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="events_calendar.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-calendar4-week"></span
                                ><span class="mtext">Events Calendar</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-gear"></span
                                ><span class="mtext">Settings Page</span>
                                </a>
                                <ul class="submenu">
                                    <!--                                    <li><a href="../faq.php">FAQ</a></li>-->
                                    <li><a href="../includes/profile.php">Profile</a></li>
                                    <!--                                    <li><a href="../pricing-table.php">Pricing Tables</a></li>-->
                                </ul>
                            </li>
                        </ul>
                    <?php }
                    elseif ($check_role == "ROLE_FIN"){?>

                        <ul id="accordion-menu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-house"></span
                                ><span class="mtext">Home</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="index.php">Dashboard</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"></span
                                ><span class="mtext">Loan Applications</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="loan_applications.php?state=all">All Applications</a></li>
                                    <li><a href="loan_applications.php?state=progress">Applications In Progress</a></li>
                                    <li><a href="loan_applications.php?state=reject">Rejected Applications</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-table"></span
                                ><span class="mtext">Tickets</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="predisbursed_tickets.php">Ticket(s) Signing</a></li>
                                    <li><a href="signed_tickets.php">Signed Ticket(s)</a></li>
                                </ul>
                            </li>
                            <?php if ($_SESSION['poUser']['role'] != null){ ?>
                                <li class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle">
                                        <span class="micon bi bi-cash-stack"></span><span class="mtext">Purchase Order</span>
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="requisitions.php?menu=main">Requisitions</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($_SESSION['cmsUser']['role'] != null){ ?>
                                <li class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle">
                                        <span class="micon bi bi-cash-coin"></span><span class="mtext">Cash Management</span>
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="cash_management.php?menu=main">Dashboard</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-folder"></span
                                ><span class="mtext">Pipeline Reporting</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="branch_pipeline_report.php">Branch Reports</a></li>
                                    <li><a href="pipeline_report.php">Pipeline Summary Report</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-textarea-resize"></span
                                ><span class="mtext">C.R.M</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="campaign_and_marketing.php?menu=main">Campaign and Marketing</a></li>
                                    <li><a href="lead_management.php">Lead Management</a></li>
                                    <li><a href="client_retention.php">Client Retention</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="events_calendar.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-calendar4-week"></span
                                ><span class="mtext">Events Calendar</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-gear"></span
                                ><span class="mtext">Settings Page</span>
                                </a>
                                <ul class="submenu">
                                    <!--                                    <li><a href="../faq.php">FAQ</a></li>-->
                                    <li><a href="../includes/profile.php">Profile</a></li>
                                    <!--                                    <li><a href="../pricing-table.php">Pricing Tables</a></li>-->
                                </ul>
                            </li>
                        </ul>

                    <?php }
                    elseif ($check_role == "ROLE_BOARD")
                    {?>

                        <ul id="accordion-menu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-house"></span
                                ><span class="mtext">Home</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="index.php">Dashboard</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
		    						<span class="micon bi bi-file-earmark-text"></span><span class="mtext">Loan Applications</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="loan_applications.php?state=all">All Applications</a></li>
                                    <li><a href="loan_applications.php?state=progress">Applications In Progress</a></li>
                                    <li><a href="loan_applications.php?state=reject">Rejected Applications</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-layout-text-window-reverse"></span><span class="mtext">MCC Scheduling</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="schedule_meeting.php">Prep MCC Meeting</a></li>
                                    <li><a href="final_meeting.php">MCC Final Decision</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-table"></span><span class="mtext">Tickets</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="predisbursed_tickets.php">Ticket(s) Signing</a></li>
                                    <li><a href="signed_tickets.php">Signed Ticket(s)</a></li>
                                </ul>
                            </li>
                            <?php if ($_SESSION['poUser']['role'] != null){ ?>
                                <li class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle">
                                        <span class="micon bi bi-cash-stack"></span><span class="mtext">Purchase Order</span>
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="requisitions.php?menu=main">Requisitions</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($_SESSION['cmsUser']['role'] != null){ ?>
                                <li class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle">
                                        <span class="micon bi bi-cash-coin"></span><span class="mtext">Cash Management</span>
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="cash_management.php?menu=main">Dashboard</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-folder"></span
                                ><span class="mtext">Pipeline Reporting</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="branch_pipeline_report.php">Branch Reports</a></li>
                                    <li><a href="pipeline_report.php">Pipeline Summary Report</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-textarea-resize"></span
                                ><span class="mtext">C.R.M</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="campaign_and_marketing.php?menu=main">Campaign and Marketing</a></li>
                                    <li><a href="lead_management.php">Lead Management</a></li>
                                    <li><a href="client_retention.php">Client Retention</a></li>
                                </ul>
                            </li>
                            <?php if ($_SESSION['poUser']['role'] != null){ ?>
                                <li class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle">
                                        <span class="micon bi bi-cash-stack"></span><span class="mtext">Purchase Order</span>
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="requisitions.php?menu=main">Requisitions</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($_SESSION['cmsUser']['role'] != null){ ?>
                                <li class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle">
                                        <span class="micon bi bi-cash-coin"></span><span class="mtext">Cash Management</span>
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="cash_management.php?menu=main">Dashboard</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-folder"></span><span class="mtext">Clients Database</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="recoveries_tracker.php?menu=main">Dashboard</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="events_calendar.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-calendar4-week"></span><span class="mtext">Events Calendar</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-gear"></span><span class="mtext">Settings Page</span>
                                </a>
                                <ul class="submenu">
                                    <!--                                    <li><a href="../faq.php">FAQ</a></li>-->
                                    <li><a href="../includes/profile.php">Profile</a></li>
                                    <!--                                    <li><a href="../pricing-table.php">Pricing Tables</a></li>-->
                                </ul>
                            </li>
                        </ul>

					<?php }
                    elseif ($check_role == "ROLE_OP"){?>

					    <ul id="accordion-menu">
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-house"></span
								><span class="mtext">Home</span>
							</a>
							<ul class="submenu">
								<li><a href="index.php">Dashboard</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"></span
								><span class="mtext">Loan Applications</span>
							</a>
							<ul class="submenu">
								<li><a href="loan_applications.php?state=all">All Applications</a></li>
								<li><a href="loan_applications.php?state=progress">Applications In Progress</a></li>
								<li><a href="loan_applications.php?state=reject">Rejected Applications</a></li>
							</ul>
						</li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-layout-text-window-reverse"></span
                                ><span class="mtext">MCC Scheduling</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="schedule_meeting.php">Prep MCC Meeting</a></li>
                                <li><a href="final_meeting.php">MCC Final Decision</a></li>
                            </ul>
                        </li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-table"></span
								><span class="mtext">Tickets</span>
							</a>
							<ul class="submenu">
                                <li><a href="predisbursed_tickets.php">Ticket(s) Signing</a></li>
                                <li><a href="signed_tickets.php">Signed Ticket(s)</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-folder"></span
								><span class="mtext">Pipeline Reporting</span>
							</a>
							<ul class="submenu">
								<li><a href="branch_pipeline_report.php">Branch Reports</a></li>
								<li><a href="pipeline_report.php">Pipeline Summary Report</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-textarea-resize"></span
								><span class="mtext">C.R.M</span>
							</a>
							<ul class="submenu">
								<li><a href="campaign_and_marketing.php?menu=main">Campaign and Marketing</a></li>
								<li><a href="lead_management.php">Lead Management</a></li>
								<li><a href="client_retention.php">Client Retention</a></li>
							</ul>
						</li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-folder"></span
                            ><span class="mtext">Clients Database</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="clients_dataset.php?menu=main">Available List</a></li>
                                    <li><a href="clients_dataset.php?menu=assigned">Assigned Clients</a></li>
                                </ul>
                            </li>


                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon bi bi-cash-coin"></span><span class="mtext">Recoveries Tracker</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="recoveries_tracker.php?menu=main">Dashboard</a></li>
                                </ul>
                            </li>

						<li>
							<a href="events_calendar.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-calendar4-week"></span
								><span class="mtext">Events Calendar</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-gear"></span
								><span class="mtext">Settings Page</span>
							</a>
							<ul class="submenu">
								<!--                                    <li><a href="../faq.php">FAQ</a></li>-->
								<li><a href="../includes/profile.php">Profile</a></li>
								<!--                                    <li><a href="../pricing-table.php">Pricing Tables</a></li>-->
							</ul>
						</li>
					</ul>

                    <?php }
                    elseif ($check_role == "ROLE_ADMIN"){?>

                        <ul id="accordion-menu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-house"></span
                                ><span class="mtext">Home</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="index.php">Dashboard</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"></span
                                ><span class="mtext">Loan Applications</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="loan_applications.php?state=all">All Applications</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-folder"></span
                                ><span class="mtext">Activity Report(s)</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="login_reports.php">Access Logs</a></li>
                                    <li><a href="platform_usage_reports.php">Platform(s) Usage</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-textarea-resize"></span
                                ><span class="mtext">Manage Parameters</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="manage_parameters.php?menu=main">Edit Variables</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								    <span class="micon bi bi-cash-stack"></span><span class="mtext">Purchase Order</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="requisitions.php?menu=main">Requisitions</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon bi bi-cash-coin"></span><span class="mtext">Cash Management</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="cash_management.php?menu=main">Dashboard</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon bi bi-coin"></span><span class="mtext">Treasury Management</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="treasury_management.php?menu=main">Dashboard</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon bi bi-cash-coin"></span><span class="mtext">Recoveries Tracker</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="recoveries_tracker.php?menu=main">Dashboard</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-textarea-resize"></span
                                ><span class="mtext">Documents Manager</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="manage_documents.php?doc=assign_doc">Assigned Documents</a></li>
                                    <li><a href="manage_documents.php?doc=all_doc">All Documents</a></li>
                                    <li><a href="manage_documents.php?doc=doc_category">Document Categories</a></li>
                                    <li><a href="manage_documents.php?doc=doc_audit">Document Audit Trail</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="events_calendar.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-calendar4-week"></span
                                ><span class="mtext">Events Calendar</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-gear"></span
                                ><span class="mtext">Settings Page</span>
                                </a>
                                <ul class="submenu">
                                    <!--                                    <li><a href="../faq.php">FAQ</a></li>-->
                                    <li><a href="../includes/profile.php">Profile</a></li>
                                    <li><a href="../pricing-table.php">Web Content</a></li>
                                </ul>
                            </li>
                        </ul>

                    <?php }
                    elseif ($check_role == "ROLE_AUDIT"){?>

                        <ul id="accordion-menu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-house"></span
                                ><span class="mtext">Home</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="index.php">User List</a></li>
                                    <li><a href="access_logs.php">Access Logs</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								    <span class="micon bi bi-file-earmark-text"></span><span class="mtext">Loan Applications</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="loan_applications.php?state=all">All Applications</a></li>
                                    <li><a href="loan_applications.php?state=progress">Applications In Progress</a></li>
                                    <li><a href="loan_applications.php?state=reject">Rejected Applications</a></li>
                                </ul>
                            </li>
                            <?php if ($_SESSION['poUser']['role'] != null){ ?>
                                <li class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle">
                                        <span class="micon bi bi-cash-stack"></span><span class="mtext">Purchase Order</span>
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="requisitions.php?menu=main">Requisitions</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($_SESSION['cmsUser']['role'] != null){ ?>
                                <li class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle">
                                        <span class="micon bi bi-cash-coin"></span><span class="mtext">Cash Management</span>
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="cash_management.php?menu=main">Dashboard</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-folder"></span
                                ><span class="mtext">Pipeline Reporting</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="branch_pipeline_report.php">Branch Reports</a></li>
                                    <li><a href="pipeline_report.php">Pipeline Summary Report</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="events_calendar.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-calendar4-week"></span
                                ><span class="mtext">Events Calendar</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-gear"></span
                                ><span class="mtext">Settings Page</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="profile.php">Profile</a></li>
                                </ul>
                            </li>
                        </ul>

                    <?php }
                    elseif ($check_role == "ROLE_CA"){?>

                        <ul id="accordion-menu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-house"></span
                                ><span class="mtext">Home</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="index.php">Dashboard</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"></span
                                ><span class="mtext">Loan Applications</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="loan_applications.php?state=all">All Applications</a></li>
                                    <li><a href="loan_applications.php?state=progress">Applications In Progress</a></li>
                                    <li><a href="loan_applications.php?state=reject">Rejected Applications</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-layout-text-window-reverse"></span
                                ><span class="mtext">MCC Scheduling</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="schedule_meeting.php">Prep MCC Meeting</a></li>
                                    <li><a href="final_meeting.php">Conducted MCCs</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-table"></span
                                ><span class="mtext">Tickets</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="predisbursed_tickets.php">Ticket(s) Signing</a></li>
                                    <li><a href="signed_tickets.php">Signed Ticket(s)</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-folder"></span
                                ><span class="mtext">Pipeline Reporting</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="branch_pipeline_report.php">Branch Reports</a></li>
                                    <li><a href="pipeline_report.php">Pipeline Summary Report</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-textarea-resize"></span
                                ><span class="mtext">C.R.M</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="campaign_and_marketing.php?menu=main">Campaign and Marketing</a></li>
                                    <li><a href="lead_management.php">Lead Management</a></li>
                                    <li><a href="client_retention.php">Client Retention</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-folder"></span
                            ><span class="mtext">Clients Database</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="clients_dataset.php?menu=main">Available List</a></li>
                                    <li><a href="clients_dataset.php?menu=assigned">Assigned Clients</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon bi bi-cash-coin"></span><span class="mtext">Recoveries Tracker</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="recoveries_tracker.php?menu=main">Dashboard</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="events_calendar.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-calendar4-week"></span
                                ><span class="mtext">Events Calendar</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-gear"></span
                                ><span class="mtext">Settings Page</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="../includes/profile.php">Profile</a></li>
                                </ul>
                            </li>
                        </ul>

					<?php }
                    elseif ($check_role == "ROLE_BM"){?>

                        <ul id="accordion-menu">
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-house"></span
								><span class="mtext">Home</span>
							</a>
							<ul class="submenu">
								<li><a href="index.php">Dashboard</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"></span
								><span class="mtext">Loan Applications</span>
							</a>
							<ul class="submenu">
								<li><a href="loan_applications.php?state=all">All Applications</a></li>
								<li><a href="loan_applications.php?state=progress">Assign Loan Officer</a></li>
								<li><a href="loan_applications.php?state=reject">Rejected Applications</a></li>
							</ul>
						</li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-layout-text-window-reverse"></span
                                ><span class="mtext">BCC Scheduling</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="schedule_meeting.php">Schedule BCC Meeting</a></li>
                                <li><a href="bcc_final_decision.php">BCC Final Decision</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-table"></span
                                ><span class="mtext">Tickets</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="predisbursed_tickets.php">Ticket(s) Signing</a></li>
                                <li><a href="signed_tickets.php">Signed Ticket(s)</a></li>
                            </ul>
                        </li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-folder"></span
								><span class="mtext">Pipeline Reporting</span>
							</a>
							<ul class="submenu">
								<li><a href="branch_pipeline_report.php">Manage Pipeline Report</a></li>
								<li><a href="pipeline_report.php">Pipeline Summary Report</a></li>
							</ul>
                        </li>
                            <?php if ($_SESSION['poUser']['role'] != null){ ?>
                                <li class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle">
                                        <span class="micon bi bi-cash-stack"></span><span class="mtext">Purchase Order</span>
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="requisitions.php?menu=main">Requisitions</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($_SESSION['cmsUser']['role'] != null){ ?>
                                <li class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle">
                                        <span class="micon bi bi-cash-coin"></span><span class="mtext">Cash Management</span>
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="cash_management.php?menu=main">Dashboard</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-textarea-resize"></span
								><span class="mtext">C.R.M</span>
							</a>
							<ul class="submenu">
								<li><a href="campaign_and_marketing.php?menu=main">Campaign and Marketing</a></li>
								<li><a href="lead_management.php">Lead Management</a></li>
								<li><a href="client_retention.php">Client Retention</a></li>
							</ul>
						</li>

                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-cash-coin"></span><span class="mtext">Recoveries Tracker</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="recoveries_tracker.php?menu=main">Dashboard</a></li>
                            </ul>
                        </li>

						<li>
							<a href="events_calendar.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-calendar4-week"></span
								><span class="mtext">Events Calendar</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-gear"></span
								><span class="mtext">Settings Page</span>
							</a>
							<ul class="submenu">
								<!--                                    <li><a href="../faq.php">FAQ</a></li>-->
								<li><a href="../includes/profile.php">Profile</a></li>
								<!--                                    <li><a href="../pricing-table.php">Pricing Tables</a></li>-->
							</ul>
						</li>
					</ul>

                    <?php }
                    elseif ($check_role == "ROLE_BOCO"){?>

                        <ul id="accordion-menu">
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-house"></span
                                ><span class="mtext">Home</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="index.php">Dashboard</a></li>
                            </ul>
                        </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-house"></span
                                ><span class="mtext">Users</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="users.php">Users list</a></li>
                                </ul>
                            </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"></span
                                ><span class="mtext">Loan Applications</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="loan_applications.php?state=all">All Applications</a></li>
                                <li><a href="loan_applications.php?state=progress">Check Applications</a></li>
                                <li><a href="loan_applications.php?state=reject">Rejected Applications</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-table"></span
                                ><span class="mtext">Tickets</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="predisbursed_tickets.php">Pre-Disbursed Tickets</a></li>
                                <li><a href="signed_tickets.php">Ticket(s) Signing</a></li>
                            </ul>
                        </li>
                        <?php if ($_SESSION['poUser']['role'] != null){ ?>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon bi bi-cash-stack"></span><span class="mtext">Purchase Order</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="requisitions.php?menu=main">Requisitions</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($_SESSION['cmsUser']['role'] != null){ ?>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-cash-coin"></span><span class="mtext">Cash Management</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="cash_management.php?menu=main">Dashboard</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if ($_SESSION['tmsUser']['role'] != null){ ?>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon bi bi-cash-stack"></span><span class="mtext">Treasury Management</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="treasury_management.php?menu=main">Dashboard</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="events_calendar.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-calendar4-week"></span
                                ><span class="mtext">Events Calendar</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-gear"></span
                                ><span class="mtext">Settings Page</span>
                            </a>
                            <ul class="submenu">
                                <!--                                    <li><a href="../faq.php">FAQ</a></li>-->
                                <li><a href="../includes/profile.php">Profile</a></li>
                                <!--                                    <li><a href="../pricing-table.php">Pricing Tables</a></li>-->
                            </ul>
                        </li>
                    </ul>

                    <?php }
                    elseif ($check_role == "ROLE_CLIENT"){?>

                        <ul id="accordion-menu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-house"></span
                                ><span class="mtext">Home</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="index.php">Dashboard</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"></span
                                ><span class="mtext">Loan Applications</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="loan_applications.php?state=apply">Apply for a Loan</a></li>
                                    <li><a href="loan_applications.php?state=all">Applications History</a></li>
                                    <li><a href="kyc_documents.php">My Documents</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-table"></span
                                ><span class="mtext">Loan Statement(s)</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="repayment_schedule.php">Repayment Schedule</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="events_calendar.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-calendar4-week"></span
                                ><span class="mtext">Events Calendar</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-gear"></span
                                ><span class="mtext">Settings Page</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="../includes/profile.php">Profile</a></li>
                                </ul>
                            </li>
                        </ul>

                    <?php }
                    else {?>

					<?php } ?>
				</div>
			</div>
		</div>