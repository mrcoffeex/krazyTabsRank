<?php 

    ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);  // 7 day cookie lifetime
	session_start();

	if(!isset($_SESSION['hotkopi_tabs_session_id'])){
        header("location: ../../");
    }else if ($_SESSION['hotkopi_tabs_session_type'] != 0) {
        header("location: ../../");
    }

    $user_id = $_SESSION['hotkopi_tabs_session_id'];
    $user_type = $_SESSION['hotkopi_tabs_session_type'];

    //find user
    $getuser=dbaselink()->prepare("SELECT tabs_username,
                                        tabs_password,
                                        tabs_user_id,
                                        tabs_full_name From tabs_users 
                                        Where 
                                        tabs_user_id = :session_user_id ");
    $getuser->execute([
        'session_user_id' => $user_id
    ]);
    $row=$getuser->fetch(PDO::FETCH_ASSOC);

    //user
    $tabs_user_fullname = $row['tabs_full_name'];
    $tabs_user_email = $row['tabs_username'];
    $tabs_user_id = $row['tabs_user_id'];

    //dates
    $datenow = date("Y-m-d H:i:s");
    $onlydate = date("Y-m-d");

    //configs
    $nav_logo = "../../images/logo-long.png";
    $nav_logo_mini = "../../images/logo.png";

?>