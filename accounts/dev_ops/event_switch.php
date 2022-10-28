<?php  
    require '../../config/includes.php';
    require 'session.php';

    $redirect = @$_GET['cd'];

    if (isset($_POST['selected'])) {

        //update status
        $update_data = updateEventStatus($redirect);

        if ($update_data == true) {
            echo "ok";
        }else{
            echo "error";
        }
    }
?>