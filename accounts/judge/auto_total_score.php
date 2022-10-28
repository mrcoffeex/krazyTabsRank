<?php

    require '../../config/includes.php';
    require 'session.php';

    $canId = clean_int($_GET['canId']);
    $catId = clean_int($_GET['catId']);

    //get criteria
    $totalScore=0;
    $getCriRow=selectCriteria($catId);
    while ($criRow=$getCriRow->fetch(PDO::FETCH_ASSOC)) {

        $score = getCandidateResultByCriteria($criRow['tabs_cri_id'], $catId, $canId, $tabs_user_id);

        $totalScore += $score;
    }
    
    echo $totalScore;
?>


