<?php  
    include '../../config/includes.php';
    include 'session.php';

    $eventId = clean_int($_GET['eventId']);

    if (isset($_POST['candidates'])) {

        $candidates = $_POST['candidates'];
        $event = clean_int($_POST['event']);

        if (empty($candidates)) {

            header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=empty");

        } else {
            
            foreach ($candidates as $candidate) {
            
                //transfer sequence
                $updateData = transferCandidate($candidate, $event);
    
            }

            if ($updateData == true) {
                header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=candidate_transfer");
            }else{
                header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=error");
            }

        }

    }else{
        header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=empty");
    }
?>