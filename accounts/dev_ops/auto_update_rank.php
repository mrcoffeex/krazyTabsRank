<?php

    require '../../config/includes.php';
    require 'session.php';

    $canId = clean_int($_GET['canId']);
    $catId = clean_int($_GET['catId']);
    $eventId = clean_int($_GET['eventId']);
    $judgeId = clean_int($_GET['judgeId']);

    $rank = clean_float($_GET['rank']);

	//update rank

    $updateData = updateRank($canId, $eventId, $catId, $judgeId, $rank);

    if ($updateData == true) {
        
        print(0);

    } else {
        print(1);
    }
    
    
?>


