<?php  
    include '../../config/includes.php';
    include 'session.php';

    $redirect = @$_GET['cd'];
    $catId = @$_GET['catId'];

    if (isset($_POST['cri_title'])) {
        $cri_title = clean_string($_POST['cri_title']);
        $cri_desc = clean_string($_POST['cri_desc']);
        $cri_min = clean_float($_POST['cri_min']);
        $cri_max = clean_float($_POST['cri_max']);
        $cri_percentage = clean_float($_POST['cri_percentage']);

        $update_data = updateCriteria($cri_title, $cri_desc, $cri_min, $cri_max, $cri_percentage, $redirect);

        if ($update_data == true) {
            header("location: criteria?rand=".my_rand_str(30)."&cd=$catId&note=cri_updated");
        }else{
            header("location: criteria?rand=".my_rand_str(30)."&cd=$catId&note=error");
        }
    }
?>