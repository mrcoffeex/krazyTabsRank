<?php  
    include '../../config/includes.php';
    include 'session.php';

    $redirect = clean_int($_GET['cd']);

    if (isset($_POST['submit_delete_event'])) {

        $deletePassword = clean_string($_POST['deletePassword']);

        if (encryptIt($deletePassword) == $row['tabs_password']) {
            
            $delete_data = deleteEventRecords($redirect);

            if ($delete_data == true) {
                header("location: events?rand=".my_rand_str(30)."&note=event_deleted");
            }else{
                header("location: events?rand=".my_rand_str(30)."&note=error");
            }

        } else {
            header("location: events?rand=".my_rand_str(30)."&note=mismatch");
        }

    }
?>