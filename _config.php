<?php  
    require 'config/includes.php';

    session_start();

    if (isset($_SESSION['hotkopi_tabs_session_id'])) {

        if($_SESSION['hotkopi_tabs_session_type'] == "0"){
            header("location: accounts/dev_ops/");
        }else if($_SESSION['hotkopi_tabs_session_type'] == "1"){
            header("location: accounts/judge/");
        }else{
            session_destroy();
        }
    }

?>