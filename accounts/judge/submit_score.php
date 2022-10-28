<?php  
    require '../../config/includes.php';
    require 'session.php';

    //event_id in session
    //cat_id
    //cri_id
    //user_id in session
    //can_id
    
    //score
    //created
    //updated

    $criId = @$_GET['criId'];
    $canId = @$_GET['canId'];

    $catId = getCategoryByCriteriaId($criId);

    if (isset($_POST['score'])) {

        $score = clean_float($_POST['score']);

        $insert_data = createResult($tabs_event_id, $catId, $criId, $tabs_user_id, $canId, $score);

        if ($insert_data == true) {
            header("location: rate?rand=".my_rand_str(30)."&catId=$catId&canId=$canId&note=score_submit");
        }else{
            header("location: rate?rand=".my_rand_str(30)."&catId=$catId&canId=$canId&note=error");
        }
    }

    
?>