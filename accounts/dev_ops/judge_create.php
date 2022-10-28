<?php  
    include '../../config/includes.php';
    include 'session.php';

    $eventId = clean_string($_GET['eventId']);

    if (isset($_POST['name'])) {
        $name = clean_string($_POST['name']);
        $username = clean_string($_POST['username']);

        if (checkIfExist("tabs_users", "tabs_username", $username) > 0) {
            header("location: event_judges?rand=".my_rand_str(30)."&eventId=$eventId&note=username_exists");
        }else{
            $insert_data = createJudge($name, $username, $eventId);
    
            if ($insert_data == true) {
                header("location: event_judges?rand=".my_rand_str(30)."&eventId=$eventId&note=judge_added");
            }else{
                header("location: event_judges?rand=".my_rand_str(30)."&eventId=$eventId&note=error");
            }
        }
    }
?>