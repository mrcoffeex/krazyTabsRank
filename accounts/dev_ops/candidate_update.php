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

        $canImage = ezImageUpload("can_image", "../../uploads/");

        if ($canImage == "error") {
            header("location: event_candidates?rand=".my_rand_str(30)."&note=invalid_upload");
        } else {

            if ($canImage == "empty" || $canImage == "") {
                $canImage = getCandidateImage($canId);
            }else{
                $canImage = $canImage;
            }

            $request = updateCandidate($can_number, $name, $designation, $canImage, $event, $canId);

            if ($request == true) {
                header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=can_updated");
            }else{
                header("location: event_candidates?rand=".my_rand_str(30)."&eventId=$eventId&note=error");
            }

        }

    }
?>