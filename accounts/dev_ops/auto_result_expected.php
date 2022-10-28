<?php  
    require '../../config/includes.php';
    require 'session.php';

    $eventId = clean_int($_GET['eventId']);
    $catId = clean_int($_GET['catId']);

    $getCategories=selectCategories($eventId);
    $candidates = countCandidateResultByEventCategory($eventId, $catId);

    while ($category=$getCategories->fetch(PDO::FETCH_ASSOC)) {

        $judges = countActiveJudge($eventId, $catId);

        $criterias = countCriteria($catId);
        $expectedScoreCount = $candidates * $criterias * $judges;
    }

    echo $expectedScoreCount;
?>