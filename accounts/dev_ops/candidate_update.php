<?php  
    include '../../config/includes.php';
    include 'session.php';

    $eventId = clean_int($_GET['eventId']);
    $canId = clean_int($_GET['canId']);

    if (isset($_POST['can_number'])) {
        $can_number = clean_int($_POST['can_number']);
        $name = clean_string($_POST['name']);
        $designation = clean_string($_POST['designation']);
        $event = clean_int($_POST['event']);

        $insert_data = updateCandidate($can_number, $name, $designation, $event, $canId);

        if ($insert_data == true) {
            header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=can_updated");
        }else{
            header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=error");
        }
    }
?>