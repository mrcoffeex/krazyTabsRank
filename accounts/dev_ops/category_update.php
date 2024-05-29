<?php  
    include '../../config/includes.php';
    include 'session.php';

    $redirect = @$_GET['cd'];
    $eventId = @$_GET['eventId'];

    if (isset($_POST['cat_title'])) {
        $cat_title = clean_string($_POST['cat_title']);

        $update_data = updateCategory($cat_title, 0, $redirect);

        if ($update_data == true) {
            header("location: category?rand=".my_rand_str(30)."&cd=$eventId&note=cat_updated");
        }else{
            header("location: category?rand=".my_rand_str(30)."&cd=$eventId&note=error");
        }
    }
?>