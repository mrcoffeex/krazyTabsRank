<!-- plugins:js -->
<script src="vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="vendors/chart.js/Chart.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="js/off-canvas.js"></script>
<script src="js/hoverable-collapse.js"></script>
<script src="js/template.js"></script>
<script src="js/settings.js"></script>
<script src="js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="js/jquery.cookie.js" type="ext/javascript"></script>
<script src="js/dashboard.js"></script>
<script src="js/Chart.roundedBarCharts.js"></script>
<script src="js/toastr.min.js"></script>
<!-- End custom js for this page-->

<script>
    //custom js here
	$("#tabs_log_username").focus();

    //toastr custom options
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": false,
	  "progressBar": true,
	  "positionClass": "toast-bottom-left",
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

	//validations
	function validate_login(formObj){
		formObj.e4ps_login.disabled = true;
		formObj.e4ps_login.innerHTML = "Checking credentials ...";
        return true;  
	}
</script>