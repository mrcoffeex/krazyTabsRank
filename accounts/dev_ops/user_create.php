<?php  
    include '../../config/includes.php';
    include 'session.php';

    if (isset($_POST['name'])) {
        $name = clean_string($_POST['name']);
        $username = clean_string($_POST['username']);

        if (checkIfExist("tabs_users", "tabs_username", $username) > 0) {
            header("location: users?rand=".my_rand_str(30)."&note=username_exists");
        }else{
            $insert_data = createUser($name, $username);

            if ($insert_data == true) {
                header("location: users?rand=".my_rand_str(30)."&note=user_added");
            }else{
                header("location: users?rand=".my_rand_str(30)."&note=error");
            }
        }
    }
?>