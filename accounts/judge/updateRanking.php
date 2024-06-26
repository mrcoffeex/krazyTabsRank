<?php  
    require '../../config/includes.php';
    require 'session.php';

    $catId = @$_GET['catId'];

    $getCandidates=selectCandidatesByEvent($tabs_event_id);
    while ($candidate=$getCandidates->fetch(PDO::FETCH_ASSOC)) {

        $score = $_POST["result_" . $candidate['tabs_can_id']];
        $criId = $_POST["criId_" . $candidate['tabs_can_id']];

        // insert all
        createResult($tabs_event_id, $catId, $criId, $tabs_user_id, $candidate['tabs_can_id'], $score);

    }

    $getScores=dbaselink()->prepare("SELECT * FROM tabs_results
                                        Where 
                                        tabs_cat_id = :tabs_cat_id AND
                                        tabs_event_id = :tabs_event_id AND
                                        tabs_user_id = :tabs_user_id
                                        Order By tabs_result_score DESC");
    $getScores->execute([
        'tabs_cat_id' => $catId,
        'tabs_event_id' => $tabs_event_id,
        'tabs_user_id' => $tabs_user_id
    ]);

    $candidates = array();

    while ($score=$getScores->fetch(PDO::FETCH_ASSOC)) {
    
        $candidates[] = array(
            'can_id' => $score['tabs_can_id'],
            'cri_id' => $score['tabs_cri_id'],
            'judge_id' => $score['tabs_user_id'],
            'score' => $score['tabs_result_score']
        );
    }
    
    usort($candidates, function($a, $b) {
        if ($b['score'] == $a['score']) {
            return 0;
        }
        return ($b['score'] < $a['score']) ? -1 : 1;
    });
    
    // ranking v1

    // $rank = 1;
    // $prevScore = null;
    // foreach ($candidates as $candidate) {

    //     $can_id = $candidate['can_id'];
    //     $cri_id = $candidate['cri_id'];
    //     $judge_id = $candidate['judge_id'];
    //     $total = $candidate['total'];

    //     if ($total != $prevScore) {
    //         $rank = $rank;
    //     }else{
    //         $rank = $rank - 1;
    //     }
    
    //     updateRank($can_id, $tabs_event_id, $catId, $judge_id, $rank);
    
    //     $rank++;
    //     $prevScore = $total;
    // }

    //ranking v2 with .5

    $rank = 1;
    $previousScore = null;
    $totalTied = 0;

    foreach ($candidates as &$candidate) {

        $can_id = $candidate['can_id'];
        $cri_id = $candidate['cri_id'];
        $judge_id = $candidate['judge_id'];

        if ($candidate['score'] != $previousScore) {
            $rank += $totalTied;
            $totalTied = 0;
        }

        updateRank($can_id, $tabs_event_id, $catId, $judge_id, $rank);

        $candidate['rank'] = $rank;
        $totalTied++;
        $previousScore = $candidate['score'];
        $ranks[] = $rank;
    }

    updateRankFinal($tabs_event_id, $catId, $tabs_user_id);

    header("location: category?rand=" . my_rand_str(39) . "&cd=$catId&note=submit");
    
?>