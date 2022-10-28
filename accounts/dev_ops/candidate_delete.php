<?php  
    include '../../config/includes.php';
    include 'session.php';

    $eventId = clean_int($_GET['eventId']);
    $canId = clean_int($_GET['canId']);

    if (isset($_POST['submit_delete_can'])) {

        $delete_data = deleteCandidate($canId);

        if ($delete_data == "has_record") {
            header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=has_record");
        } else {
            if ($delete_data == true) {
                header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=can_deleted");
            }else{
                header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=error");
            }
        }
        
    }
?>