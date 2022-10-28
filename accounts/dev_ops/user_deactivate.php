<?php  
    include '../../config/includes.php';
    include 'session.php';

    $redirect = @$_GET['cd'];

    if (isset($_POST['submit_deactivate_user'])) {

        $update_data = deactivateUser($redirect);

        if ($update_data == true) {
            header("location: users?rand=".my_rand_str(30)."&note=user_deactivate");
        }else{
            header("location: users?rand=".my_rand_str(30)."&note=error");
        }
    }
?>