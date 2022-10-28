<!-- plugins:js -->
<script src="../../vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="../../js/off-canvas.js"></script>
<script src="../../js/hoverable-collapse.js"></script>
<script src="../../js/template.js"></script>
<script src="../../js/settings.js"></script>
<script src="../../js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="../../js/jquery.cookie.js" type="ext/javascript"></script>
<script src="../../js/dashboard.js"></script>
<script src="../../js/toastr.min.js"></script>

<script src="../../js/jq.tablesort.js"></script>
<script src="../../js/tablesorter.js"></script>
<!-- End custom js for this page-->

<!-- js for jquery applicants-->
<script src="../../js/jquery.steps.min.js"></script>
<script src="../../js/jquery.validate.min.js"></script>
<script src="../../js/wizard.js"></script>
<!-- End js for jquery applicants-->

<script src="../../js/select2.js"></script>
<script src="../../vendors/select2/select2.min.js"></script>

<script>
    //custom js here

	//modal autofocus
    $(document).on('shown.bs.modal', function() {
      $(this).find('[autofocus]').focus();
      $(this).find('[autofocus]').select();
    });

	//validations

	// events
    
    //toastr custom options
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": false,
	  "progressBar": true,
	  "positionClass": "toast-top-right",
	  "preventDuplicates": false,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}

	$(document).ready(function () {

		function load_live_system_logs() {
			$.ajax({
				type: "GET",
				url: "auto_system_logs.php",
				dataType: "html",              
				success: function (response) {
					$("#live_system_logs").html(response);
					setTimeout(load_live_system_logs, 3000)
				}
			});
		}

		load_live_system_logs();
	});

	$(document).ready(function () {

		function load_live_system_logs_count() {
			$.ajax({
				type: "GET",
				url: "auto_system_logs_count.php",
				dataType: "html",              
				success: function (response) {
					$("#live_system_logs_count").html(response);
					setTimeout(load_live_system_logs_count, 3000)
				}
			});
		}

		load_live_system_logs_count();
	});

	$(document).ready(function () {

		function load_categories() {
			$.ajax({
				type: "GET",
				url: "auto_categories.php",
				dataType: "html",              
				success: function (response) {
					$("#load_categories").html(response);
					setTimeout(load_categories, 3000)
				}
			});
		}

		load_categories();
	});

</script>