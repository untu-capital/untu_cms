<?php
include('../session/session.php');
include ('check_role.php');
include('../includes/controllers.php');
include('../controllers/puchase_order.php');
$nav_header = "Purchase Order Details";
?>

<!DOCTYPE html>
<html>
<!-- HTML HEAD -->
<?php
include('../includes/header.php');
?>
<!-- /HTML HEAD -->
<body>

<!-- Top NavBar -->
<?php include('../includes/top-nav-bar.php'); ?>
<!-- Top NavBar -->

<?php include('../includes/right-sidebar.php'); ?>

<!-- sidebar-left -->
<?php include('../includes/side-bar.php'); ?>
<!-- /sidebar-left -->
<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="pd-ltr-20">

        <?php include('../includes/dashboard/topbar_widget.php'); ?>

        <?php include('../includes/forms/view_req_info.php'); ?>

        <?php include('../includes/footer.php');?>
    </div>
</div>

<!-- js -->
<script src="../vendors/scripts/core.js"></script>
<script src="../vendors/scripts/script.min.js"></script>
<script src="../vendors/scripts/process.js"></script>
<script src="../vendors/scripts/layout-settings.js"></script>
<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="../vendors/scripts/dashboard.js"></script>

<!-- buttons for Export datatable -->
<script src="../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="../src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="../src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="../src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="../src/plugins/datatables/js/pdfmake.min.js"></script>
<script src="../src/plugins/datatables/js/vfs_fonts.js"></script>
<!-- Datatable Setting js -->
<script src="../vendors/scripts/datatable-setting.js"></script>

<!--        <script>-->
<!--            $(document).ready(function() {-->
<!--                $('#add_transaction').on('submit', function(event) {-->
<!--                    event.preventDefault(); // Prevent the default form submission behavior-->
<!---->
<!--                    // Serialize the form data-->
<!--                    var formData = $(this).serialize();-->
<!---->
<!--                    // Send the form data to the server using AJAX-->
<!--                    $.ajax({-->
<!--                        type: 'POST',-->
<!--                        url: 'view_req_info.php', // Replace with the actual server-side script URL-->
<!--                        data: formData,-->
<!--                        success: function(response) {-->
<!--                            // Handle the response from the server here (if needed)-->
<!--                            // For example, you can update the page content without a full refresh-->
<!--                            // You can also clear the form or provide a success message-->
<!--                            console.log('Form submitted successfully');-->
<!--                        },-->
<!--                        error: function(error) {-->
<!--                            // Handle any errors that occur during the AJAX request-->
<!--                            console.error('Error:', error);-->
<!--                        }-->
<!--                    });-->
<!--                });-->
<!--            });-->
<!--        </script>-->


<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

</body>
</html>
