<?php  
    include '../../config/includes.php';
    include 'session.php';

    $eventId = clean_int($_GET['eventId']);

    if (isset($_POST['judges'])) {

        $judges = $_POST['judges'];
        $event = clean_int($_POST['event']);

        if (empty($judges)) {

            header("location: event_judges?rand=".my_rand_str(30)."&eventId=$eventId&note=empty");

        } else {
            
            foreach ($judges as $judge) {
            
                //transfer sequence
                $updateData = transferJudge($judge, $event);
    
            }

            if ($updateData == true) {
                header("location: event_judges?rand=".my_rand_str(30)."&eventId=$eventId&note=judge_transfer");
            }else{
                header("location: event_judges?rand=".my_rand_str(30)."&eventId=$eventId&note=error");
            }

        }

    }else{
        header("location: event_judges?rand=".my_rand_str(30)."&eventId=$eventId&note=empty");
    }
?>