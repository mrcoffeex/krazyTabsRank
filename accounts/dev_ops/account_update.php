<?php  
    include '../../config/includes.php';
    include 'session.php';

    if (isset($_POST['tabsName'])) {
        $name = clean_string($_POST['tabsName']);
        $username = clean_string($_POST['tabsUsername']);
        $password = clean_string(encryptIt($_POST['tabsPassword']));

        if (countUsernameDuplicatesExceptMine($username, $tabs_user_id) > 0) {
            header("location: users?rand=".my_rand_str(30)."&note=username_exists");
        }else{
            $update_data = updateUser($name, $username, $password, $tabs_user_id);

            if ($update_data == true) {
                header("location: ".$_SERVER['HTTP_REFERER']."?rand=".my_rand_str(30)."&note=account_updated");
            }else{
                header("location: ".$_SERVER['HTTP_REFERER']."?rand=".my_rand_str(30)."&note=error");
            }
        }
    }
?>