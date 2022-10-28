<?php

    require '../../config/includes.php';
    require 'session.php';

    $canId = clean_int($_GET['canId']);
    $catId = clean_int($_GET['catId']);
    $eventId = clean_int($_GET['eventId']);

    $catRank = clean_float($_GET['catRank']);

	//update rank

    $updateData = updateCatRank($canId, $eventId, $catId, $catRank);

    if ($updateData == true) {
        
        print(0);

    } else {
        print(1);
    }
    
    
?>


