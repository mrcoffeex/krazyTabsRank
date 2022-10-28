<?php  
    require '../../config/includes.php';
    require 'session.php';

    $number = @$_GET['number'];
    $catId = @$_GET['catId'];
    $canId = @$_GET['canId'];

    $nextNumber = $number - 1;

    //get canId of next number using event_id
    $nextCandidateId = getCandidateIdByNumber($tabs_event_id, $nextNumber);

    if ($nextCandidateId == 0) {
        header("location: rate?rand=".my_rand_str(30)."&catId=$catId&canId=$canId&note=list_start");
    }else{
        header("location: rate?rand=".my_rand_str(30)."&catId=$catId&canId=$nextCandidateId");
    }
    
?>