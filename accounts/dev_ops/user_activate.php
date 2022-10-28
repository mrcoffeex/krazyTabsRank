<?php  
    include '../../config/includes.php';
    include 'session.php';

    $redirect = @$_GET['cd'];

    if (isset($_POST['submit_activate_user'])) {

        $update_data = activateUser($redirect);

        if ($update_data == true) {
            header("location: users?rand=".my_rand_str(30)."&note=user_activate");
        }else{
            header("location: users?rand=".my_rand_str(30)."&note=error");
        }
    }
?>