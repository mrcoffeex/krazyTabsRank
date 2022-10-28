<?php  
    include '../../config/includes.php';
    include 'session.php';

    $redirect = @$_GET['cd'];

    if (isset($_POST['name'])) {
        $name = clean_string($_POST['name']);
        $username = clean_string($_POST['username']);
        $password = clean_string(encryptIt($_POST['password']));

        if (countUsernameDuplicatesExceptMine($username, $redirect) > 0) {
            header("location: users?rand=".my_rand_str(30)."&note=username_exists");
        }else{
            $update_data = updateUser($name, $username, $password, $redirect);

            if ($update_data == true) {
                header("location: users?rand=".my_rand_str(30)."&note=user_updated");
            }else{
                header("location: users?rand=".my_rand_str(30)."&note=error");
            }
        }
    }
?>