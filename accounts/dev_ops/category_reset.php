<?php  
    include '../../config/includes.php';
    include 'session.php';

    $redirect = @$_GET['cd'];
    $eventId = @$_GET['eventId'];

    if (isset($_POST['submit_reset_category'])) {

        $delete_data = resetCategoryResults($redirect);

        if ($delete_data == true) {
            header("location: category?rand=".my_rand_str(30)."&cd=$eventId&note=cat_reset");
        }else{
            header("location: category?rand=".my_rand_str(30)."&cd=$eventId&note=error");
        }
    }
?>