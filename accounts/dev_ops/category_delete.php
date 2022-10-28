<?php  
    include '../../config/includes.php';
    include 'session.php';

    $redirect = @$_GET['cd'];
    $eventId = @$_GET['eventId'];

    if (isset($_POST['submit_delete_category'])) {

        $delete_data = deleteCategory($redirect);

        if ($delete_data == true) {
            header("location: category?rand=".my_rand_str(30)."&cd=$eventId&note=cat_deleted");
        }else{
            header("location: category?rand=".my_rand_str(30)."&cd=$eventId&note=error");
        }
    }
?>