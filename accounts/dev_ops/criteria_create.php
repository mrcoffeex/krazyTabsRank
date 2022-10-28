<?php  
    include '../../config/includes.php';
    include 'session.php';

    $redirect = @$_GET['cd'];

    if (isset($_POST['cri_title'])) {
        $cri_title = clean_string($_POST['cri_title']);
        $cri_desc = clean_string($_POST['cri_desc']);
        $cri_min = clean_float($_POST['cri_min']);
        $cri_max = clean_float($_POST['cri_max']);
        $cri_percentage = clean_float($_POST['cri_percentage']);

        $insert_data = createCriteria($cri_title, $cri_desc, $cri_min, $cri_max, $cri_percentage, $redirect);

        if ($insert_data == true) {
            header("location: criteria?rand=".my_rand_str(30)."&cd=$redirect&note=cri_added");
        }else{
            header("location: criteria?rand=".my_rand_str(30)."&cd=$redirect&note=error");
        }
    }
?>