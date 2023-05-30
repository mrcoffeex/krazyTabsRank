<?php  
    include '../../config/includes.php';
    include 'session.php';

    $eventId = clean_int($_GET['eventId']);

    if (isset($_POST['can_number'])) {
        $can_number = clean_int($_POST['can_number']);
        $name = clean_string($_POST['name']);
        $designation = clean_string($_POST['designation']);

        $canImage = ezImageUpload("can_image", "../../uploads/");

        if ($canImage == "error") {
            header("location: event_candidates?rand=".my_rand_str(30)."&note=invalid_upload");
        } else {

            if (checkCandidateNumberIfExist($eventId, $can_number) > 0) {
                header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=can_duplicate");
            } else {
                $insert_data = createCandidate($can_number, $name, $designation, $canImage, $eventId);
    
                if ($insert_data == true) {
                    header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=can_added");
                }else{
                    header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=error");
                }
            }

        }
        
    }
?>