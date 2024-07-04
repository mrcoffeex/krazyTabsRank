<?php

    require '../../config/includes.php';
    require 'session.php';

    $getJudges=selectJudges();
    while ($judge=$getJudges->fetch(PDO::FETCH_ASSOC)) {

        if ($judge['tabs_user_current'] == "category") {
            $judgeClass="badge badge-danger";
        } else {
            $judgeClass="badge badge-primary";
        }
?>
    
    <div class="<?= $judgeClass ?>"><?= $judge['tabs_username'] . " - " . $judge['tabs_full_name'] ?></div>


<?php } ?>
