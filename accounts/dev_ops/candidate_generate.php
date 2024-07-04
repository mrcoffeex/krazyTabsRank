<?php  
    include '../../config/includes.php';
    include 'session.php';

    $eventId = clean_int($_GET['eventId']);

    if (isset($_POST['candidates'])) {

        $candidates = clean_int($_POST['candidates']);
        $num=0;
        
        for ($i=1; $i <= $candidates; $i++) { 
            createCandidate($i, "Candidate_".$i, '', 'empty', $eventId);
            $num++;
        }

        if ($num == $candidates) {
            header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=can_added");
        }else{
            header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=error");
        }
        
    }
?>