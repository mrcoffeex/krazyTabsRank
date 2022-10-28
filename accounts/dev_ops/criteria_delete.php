<?php  
    include '../../config/includes.php';
    include 'session.php';

    $redirect = @$_GET['cd'];
    $catId = @$_GET['catId'];

    if (isset($_POST['submit_delete_criteria'])) {

        $delete_data = deleteCriteria($redirect);

        if ($delete_data == true) {
            header("location: criteria?rand=".my_rand_str(30)."&cd=$catId&note=cri_deleted");
        }else{
            header("location: criteria?rand=".my_rand_str(30)."&cd=$catId&note=error");
        }
    }
?>