<?php  
    require '../../config/includes.php';
    require 'session.php';

    $catId = clean_int($_GET['catId']);

    if (isset($_POST['catId'])) {


        $eventId = getEventIdByCatId($catId);
        $getCandidates=getCandidateResultByEventCategory($eventId, $catId);
        while ($candidate=$getCandidates->fetch(PDO::FETCH_ASSOC)) {

            $canId = $candidate['tabs_can_id'];
            $totalRank = getCandidateTotalRanks($eventId, $catId, $canId);

            $candidates[] = array(
                'can_id' => $candidate['tabs_can_id'],
                'score' => $totalRank
            );

        }

        usort($candidates, function($a, $b) {
            return $a['score'] - $b['score'];
        });

        $rank = 1;
        $previousScore = null;
        $totalTied = 0;

        foreach ($candidates as &$candidate) {

            $can_id = $candidate['can_id'];

            if ($candidate['score'] != $previousScore) {
                $rank += $totalTied;
                $totalTied = 0;
            }

            updateCatRank($can_id, $eventId, $catId, $rank);

            $candidate['rank'] = $rank;
            $totalTied++;
            $previousScore = $candidate['score'];
            $ranks[] = $rank;
        }

        updateCatRankFinal($eventId, $catId);

        header("location: category_results?rand=" . my_rand_str(30) . "&cd=$catId&note=success");

    } else {
        header("location: category_results?rand=" . my_rand_str(30) . "&cd=$catId&note=invalid");
    }
    
?>