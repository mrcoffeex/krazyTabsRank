<!-- plugins:js -->
<script src="../../vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="../../vendors/chart.js/Chart.min.js"></script>
<!-- End plugin js for this page -->
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
<script src="../../js/Chart.roundedBarCharts.js"></script>
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
	function validateCreateUser(formObj){
		formObj.submit_create_user.disabled = true;
		formObj.submit_create_user.innerHTML = "processing ...";
		return true;  
	}

	function validateCreateEvent(formObj){
		formObj.submit_create_event.disabled = true;
		formObj.submit_create_event.innerHTML = "processing ...";
		return true;  
	}

	function validateCreateJudge(formObj){
		formObj.submit_create_judge.disabled = true;
		formObj.submit_create_judge.innerHTML = "processing ...";
		return true;  
	}

	function validateCreateCandidate(formObj){
		formObj.submit_create_can.disabled = true;
		formObj.submit_create_can.innerHTML = "processing ...";
		return true;  
	}

	function validateCreateCategory(formObj){
		formObj.submit_create_category.disabled = true;
		formObj.submit_create_category.innerHTML = "processing ...";
		return true;  
	}

	function validateCreateCriteria(formObj){
		formObj.submit_create_criteria.disabled = true;
		formObj.submit_create_criteria.innerHTML = "processing ...";
		return true;  
	}

	function validateUpdateAccount(formObj){
		formObj.submit_update_account.disabled = true;
		formObj.submit_update_account.innerHTML = "processing ...";
		return true;  
	}

	function validateUpdateImage(formObj){
		formObj.submitImage.disabled = true;
		formObj.submitImage.innerHTML = "processing ...";
		return true;  
	}

	function validateTransferJudge(formObj){
		formObj.submit_transfer_judge.disabled = true;
		formObj.submit_transfer_judge.innerHTML = "processing ...";
		return true;  
	}

	function validateTransferCandidate(formObj){
		formObj.submit_transfer_candidate.disabled = true;
		formObj.submit_transfer_candidate.innerHTML = "processing ...";
		return true;  
	}

	// events
	$("#tabsName").focus();

	function showPassword() {
                                                        
		var x = document.getElementById("tabsPassword");

		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
    
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
		
		$('#selectAllJudges').click(function(){

			if ($('#selectAllJudges').prop('checked')) {

				console.log('checked');
				$('input:checkbox').not(this).prop('checked', true);

			} else {
				console.log('unchecked');
				$('input:checkbox').not(this).prop('checked', false);
			}

		});

	});

	$(document).ready(function () {
		
		$('#selectAllCandidates').click(function(){

			if ($('#selectAllCandidates').prop('checked')) {

				console.log('checked');
				$('input:checkbox').not(this).prop('checked', true);

			} else {
				console.log('unchecked');
				$('input:checkbox').not(this).prop('checked', false);
			}

		});

	});

</script>