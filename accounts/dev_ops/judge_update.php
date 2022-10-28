<?php  
    include '../../config/includes.php';
    include 'session.php';

    $eventId = clean_int($_GET['eventId']);
    $judgeId = clean_int($_GET['judgeId']);

    if (isset($_POST['name'])) {
        $name = clean_string($_POST['name']);
        $username = clean_string($_POST['username']);
        $password = clean_string(encryptIt($_POST['password']));
        $event = clean_int($_POST['event']);

        if (countUsernameDuplicatesExceptMine($username, $judgeId) > 0) {
            header("location: event_judges?rand=".my_rand_str(30)."&eventId=$eventId&note=username_exists");
        }else{
            $update_data = updateJudge($name, $username, $password, $event, $judgeId);
    
            if ($update_data == true) {
                header("location: event_judges?rand=".my_rand_str(30)."&eventId=$eventId&note=judge_updated");
            }else{
                header("location: event_judges?rand=".my_rand_str(30)."&eventId=$eventId&note=error");
            }
        }
    }
?>