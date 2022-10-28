<?php  
    include '../../config/includes.php';
    include 'session.php';

    $eventId = @$_GET['eventId'];

    if (isset($_POST['event_title'])) {
        $event_title = clean_string($_POST['event_title']);
        $event_desc = clean_string($_POST['event_desc']);
        $event_year = clean_int($_POST['event_year']);

        $update_data = updateEvent($event_title, $event_desc, $event_year, $eventId);

        if ($update_data == true) {
            header("location: event_update_form?rand=".my_rand_str(30)."&eventId=$eventId&note=event_updated");
        }else{
            header("location: event_update_form?rand=".my_rand_str(30)."&eventId=$eventId&note=error");
        }
    }
?>