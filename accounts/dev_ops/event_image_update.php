<?php  
    require '../../config/includes.php';
    require 'session.php';

    if (isset($_FILES['eventImage']['name'])) {
        
        $eventImage = ezImageUpload("eventImage", "../../uploads/");

        if ($eventImage == "error") {
            header("location: event_image?rand=".my_rand_str(30)."&note=invalid_upload");
        } else {
            //proceed
            $updateImage = updateEventImage($eventImage);

            if ($updateImage) {
                header("location: event_image?rand=".my_rand_str(30)."&note=updated");
            } else {
                header("location: event_image?rand=".my_rand_str(30)."&note=error");
            }
            
        }

    } else {
        header("location: event_image?rand=".my_rand_str(30)."&note=invalid");
    }
    
?>