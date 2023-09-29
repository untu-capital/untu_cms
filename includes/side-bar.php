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
                    <?php } elseif ($check_role == "ROLE_FIN"){?>

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
                                    <li><a href="schedule_meeting.php">Schedule MCC Meeting</a></li>
                                    <li><a href="mcc_final_decision.php">MCC Final Decision</a></li>
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

                    <?php } elseif ($check_role == "ROLE_BOARD"){?>

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
                                    <li><a href="schedule_meeting.php">Schedule MCC Meeting</a></li>
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
                            <span class="micon bi bi-folder"></span><span class="mtext">Clients Database</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="clients_dataset.php?menu=main">Available List</a></li>
                                    <li><a href="clients_dataset.php?menu=assigned">Assigned Clients</a></li>
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

					<?php } elseif ($check_role == "ROLE_OP"){?>

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
                                <li><a href="schedule_meeting.php">Schedule MCC Meeting</a></li>
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

                    <?php } elseif ($check_role == "ROLE_ADMIN"){?>

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
                                    <span class="micon bi bi-cash-stack"></span><span class="mtext">Cash Management</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="cash_management.php?menu=main">CMS</a></li>
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

                    <?php } elseif ($check_role == "ROLE_AUDIT"){?>

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
                                    <li><a href="schedule_meeting.php">Schedule MCC Meeting</a></li>
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

                    <?php } elseif ($check_role == "ROLE_CA"){?>

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
                                    <li><a href="schedule_meeting.php">Schedule MCC Meeting</a></li>
                                    <li><a href="final_meeting.php">Contacted MCCs</a></li>
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

					<?php } elseif ($check_role == "ROLE_BM"){?>

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

                    <?php } elseif ($check_role == "ROLE_BOCO"){?>

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

                    <?php } elseif ($check_role == "ROLE_CLIENT"){?>

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
<!--                                    <li><a href="signed_tickets.php">Ticket(s) Signing</a></li>-->
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

                    <?php } else {?>

					    <ul id="accordion-menu">
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-house"></span
								><span class="mtext">Home</span>
							</a>
							<ul class="submenu">
								<li><a href="../index.php">Dashboard</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-table"></span
								><span class="mtext">Loan Applications</span>
							</a>
							<ul class="submenu">
								<li><a href="../datatable.php">New Applications</a></li>
								<li><a href="../datatable.php">Checked Applications</a></li>
								<li><a href="../datatable.php">All Applications</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-textarea-resize"></span
								><span class="mtext">Forms</span>
							</a>
							<ul class="submenu">
								<li><a href="../form-basic.php">Form Basic</a></li>
								<li>
									<a href="../advanced-components.php">Advanced Components</a>
								</li>
								<li><a href="../form-wizard.php">Form Wizard</a></li>
								<li><a href="../html5-editor.php">HTML5 Editor</a></li>
								<li><a href="../form-pickers.php">Form Pickers</a></li>
								<li><a href="../image-cropper.php">Image Cropper</a></li>
								<li><a href="../image-dropzone.php">Image Dropzone</a></li>
							</ul>
						</li>
						<li>
							<a href="../calendar.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-calendar4-week"></span
								><span class="mtext">Calendar</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-archive"></span
								><span class="mtext"> UI Elements </span>
							</a>
							<ul class="submenu">
								<li><a href="../ui-buttons.php">Buttons</a></li>
								<li><a href="../ui-cards.php">Cards</a></li>
								<li><a href="../ui-cards-hover.php">Cards Hover</a></li>
								<li><a href="../ui-modals.php">Modals</a></li>
								<li><a href="../ui-tabs.php">Tabs</a></li>
								<li>
									<a href="../ui-tooltip-popover.php">Tooltip &amp; Popover</a>
								</li>
								<li><a href="../ui-sweet-alert.php">Sweet Alert</a></li>
								<li><a href="../ui-notification.php">Notification</a></li>
								<li><a href="../ui-timeline.php">Timeline</a></li>
								<li><a href="../ui-progressbar.php">Progressbar</a></li>
								<li><a href="../ui-typography.php">Typography</a></li>
								<li><a href="../ui-list-group.php">List group</a></li>
								<li><a href="../ui-range-slider.php">Range slider</a></li>
								<li><a href="../ui-carousel.php">Carousel</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-command"></span
								><span class="mtext">Icons</span>
							</a>
							<ul class="submenu">
								<li><a href="../bootstrap-icon.php">Bootstrap Icons</a></li>
								<li><a href="../font-awesome.php">FontAwesome Icons</a></li>
								<li><a href="../foundation.php">Foundation Icons</a></li>
								<li><a href="../ionicons.php">Ionicons Icons</a></li>
								<li><a href="../themify.php">Themify Icons</a></li>
								<li><a href="../custom-icon.php">Custom Icons</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-pie-chart"></span
								><span class="mtext">Charts</span>
							</a>
							<ul class="submenu">
								<li><a href="../highchart.php">Highchart</a></li>
								<li><a href="../knob-chart.php">jQuery Knob</a></li>
								<li><a href="../jvectormap.php">jvectormap</a></li>
								<li><a href="../apexcharts.php">Apexcharts</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"></span
								><span class="mtext">Additional Pages</span>
							</a>
							<ul class="submenu">
								<li><a href="../video-player.php">Video Player</a></li>
								<li><a href="../login.php">Login</a></li>
								<li><a href="../forgot-password.php">Forgot Password</a></li>
								<li><a href="../reset-password.php">Reset Password</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-bug"></span
								><span class="mtext">Error Pages</span>
							</a>
							<ul class="submenu">
								<li><a href="../400.php">400</a></li>
								<li><a href="../403.php">403</a></li>
								<li><a href="../404.php">404</a></li>
								<li><a href="../500.php">500</a></li>
								<li><a href="../503.php">503</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-back"></span
								><span class="mtext">Extra Pages</span>
							</a>
							<ul class="submenu">
								<li><a href="../blank.php">Blank</a></li>
								<li><a href="../contact-directory.php">Contact Directory</a></li>
								<li><a href="../blog.php">Blog</a></li>
								<li><a href="../blog-detail.php">Blog Detail</a></li>
								<li><a href="../product.php">Product</a></li>
								<li><a href="../product-detail.php">Product Detail</a></li>
								<!--                                    <li><a href="../faq.php">FAQ</a></li>-->
								<li><a href="../includes/profile.php">Profile</a></li>
								<li><a href="../gallery.php">Gallery</a></li>
								<!--                                    <li><a href="../pricing-table.php">Pricing Tables</a></li>-->
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-hdd-stack"></span
								><span class="mtext">Multi Level Menu</span>
							</a>
							<ul class="submenu">
								<li><a href="javascript:;">Level 1</a></li>
								<li><a href="javascript:;">Level 1</a></li>
								<li><a href="javascript:;">Level 1</a></li>
								<li class="dropdown">
									<a href="javascript:;" class="dropdown-toggle">
										<span class="micon fa fa-plug"></span
										><span class="mtext">Level 2</span>
									</a>
									<ul class="submenu child">
										<li><a href="javascript:;">Level 2</a></li>
										<li><a href="javascript:;">Level 2</a></li>
									</ul>
								</li>
								<li><a href="javascript:;">Level 1</a></li>
								<li><a href="javascript:;">Level 1</a></li>
								<li><a href="javascript:;">Level 1</a></li>
							</ul>
						</li>
						<li>
							<a href="../sitemap.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-diagram-3"></span
								><span class="mtext">Sitemap</span>
							</a>
						</li>
						<li>
							<a href="../chat.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-chat-right-dots"></span
								><span class="mtext">Chat</span>
							</a>
						</li>
						<li>
							<a href="../invoice.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-receipt-cutoff"></span
								><span class="mtext">Invoice</span>
							</a>
						</li>
						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<div class="sidebar-small-cap">Extra</div>
						</li>
						<li>
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-pdf"></span
								><span class="mtext">Documentation</span>
							</a>
							<ul class="submenu">
								<li><a href="../introduction.php">Introduction</a></li>
								<li><a href="../getting-started.php">Getting Started</a></li>
								<li><a href="../color-settings.php">Color Settings</a></li>
								<li>
									<a href="../third-party-plugins.php">Third Party Plugins</a>
								</li>
							</ul>
						</li>
						<li>
							<a
								href="https://dropways.github.io/deskapp-free-single-page-website-template/"
								target="_blank"
								class="dropdown-toggle no-arrow"
							>
								<span class="micon bi bi-layout-text-window-reverse"></span>
								<span class="mtext"
									>Landing Page
									<img src="../vendors/images/coming-soon.png" alt="" width="25"
								/></span>
							</a>
						</li>
					</ul>

					<?php } ?>
				</div>
			</div>
		</div>