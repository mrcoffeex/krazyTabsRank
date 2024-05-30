<?php  
    require '../../config/includes.php';
    require 'session.php';

    $redirect = @$_GET['cd'];

    if (checkIfExist("tabs_categories", "tabs_cat_id", $redirect) > 0) {
        if (getCategoryStatus($redirect) != 0) {
            header("location: ./?note=cat_closed");
        } else {
            //check if belongs to events
            if (validateCategory($redirect, $tabs_event_id) > 0) {
                //nothing to do
            }else{
                header("location: error?note=invalid");
            }
        }
    }else {
        header("location: error?note=invalid");
    }

    $title = "Judge ".$tabs_user_fullname;
    $upp_description = "<a href='./' class='text-decoration-none text-dark'><i class='ti-angle-double-left'></i> ".getEventTitleByCatId($redirect)."</a> <span class='text-primary'>".getCategoryTitle($redirect)."</span>";
?>

<!DOCTYPE html>
<html lang="en">

<?php include '_head.php'; ?>
<script src="../../js/jquery.min.js"></script>

<body>
    <div class="container-scroller">
        
        <?php include '_navbar.php'; ?>
        
        <div class="container-fluid page-body-wrapper">

        <?php include '_sidebar.php'; ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <?php include '_breads.php'; ?>

                    <div class="row">

                        
                        <?php  
                            $getCriteria=selectCriteria($redirect);
                            while ($criteria=$getCriteria->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <div class="col-md-12 mb-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h3 class="text-bold mb-3">
                                        <?= $criteria['tabs_cri_title'] ?>
                                    </h3>
                                    <h5>
                                        <?= $criteria['tabs_cri_desc'] ?>
                                        <br>
                                        Scoring: <span class="text-primary"><?= $criteria['tabs_cri_score_min'] . " - " . $criteria['tabs_cri_score_max'] ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                                
                        
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="mb-4">
                                        <span class="text-primary"><?= getCategoryTitle($redirect) ?></span> Category <span style="font-size: 17px;">press TAB for next and SHIFT+TAB for previous</span>
                                        <span class="float-end">
                                            <input type="checkbox" name="showHideImage" id="showHideImage" checked>
                                            <label for="showHideImage" style="font-size: 17px;">Show/Hide Image</label>

                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showRanks">Show Ranks</button>
                                        </span>
                                    </h2>
                                    <form action="updateRanking?catId=<?= $redirect ?>" method="post" enctype="multipart/form-data" onsubmit="btnLoader(this.generateRank)">
                                    <div class="table-sorter-wrapper col-lg-12 table-responsive">
                                        <table class="table table-hover table-bordered border-dark" id="sortable-table-2">
                                            <thead>
                                                <tr class="table-dark">
                                                    <th class="sortStyle text-center"># <i class="ti-angle-down"></i></th>
                                                    <th class="sortStyle text-center">Candidate <i class="ti-angle-down"></i></th>
                                                    <?php  
                                                        //get criteria
                                                        $getCriHead=selectCriteria($redirect);
                                                        while ($criHead=$getCriHead->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                    <th class="sortStyle text-center" title="<?= $criHead['tabs_cri_title'] ?>">
                                                        <?= limitString($criHead['tabs_cri_title'], 30) ?> 
                                                        <span class="text-warning"><?= $criHead['tabs_cri_score_min']." - ".$criHead['tabs_cri_score_max'] ?></span>
                                                        <i class="ti-angle-down"></i>
                                                    </th>
                                                    <?php } ?>
                                                    <th class="sortStyle text-center">Rank <i class="ti-angle-down"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  
                                                    //populate candidates join to results scores condition with judge id (tabs_user_id)
                                                    $getCandidates=selectCandidatesByEvent($tabs_event_id);
                                                    while ($candidate=$getCandidates->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><h2><?= $candidate['tabs_can_number'] ?></h2></td>
                                                    <td class="text-center text-bold">
                                                        <h3 class="text-uppercase"><?= $candidate['tabs_can_name'] ?></h3>
                                                        <?php  
                                                            if (empty($candidate['tabs_can_image']) || $candidate['tabs_can_image'] == "empty") {
                                                                //nothing
                                                            } else {
                                                        ?>
                                                        <br><br>
                                                        <span class="canImages">
                                                            <img src="<?= previewImage($candidate['tabs_can_image'], '../../images/default_image.jpg', '../../uploads/') ?>" alt="image">
                                                        </span>
                                                        <?php } ?>
                                                    </td>

                                                    <?php  
                                                        //get criteria
                                                        $totalScore=0;
                                                        $getCriRow=selectCriteria($redirect);
                                                        while ($criRow=$getCriRow->fetch(PDO::FETCH_ASSOC)) {

                                                            $score = getCandidateResultByCriteria($criRow['tabs_cri_id'], $redirect, $candidate['tabs_can_id'], $tabs_user_id);

                                                            $totalScore += $score;
                                                    ?>
                                                        <td class="text-center p-0">
                                                            <input 
                                                            type="number" 
                                                            class="form-control text-center border border-light" 
                                                            min="<?= $criRow['tabs_cri_score_min'] ?>" 
                                                            max="<?= $criRow['tabs_cri_score_max'] ?>" 
                                                            step="0.01" 
                                                            name="result_<?= $candidate['tabs_can_id'] ?>" 
                                                            id="result_<?= $criRow['tabs_cri_id'] . $candidate['tabs_can_id'] ?>"
                                                            value="<?= getCandidateResultByCriteria($criRow['tabs_cri_id'], $redirect, $candidate['tabs_can_id'], $tabs_user_id) ?>" 
                                                            style="line-heigth: 3; font-size: 33px;" 
                                                            onkeyup="updateScore(<?= $candidate['tabs_can_id'] ?>, <?= $criRow['tabs_cri_id'] ?>, this.value)" 
                                                            autofocus required>

                                                            <input type="hidden" name="criId_<?= $candidate['tabs_can_id'] ?>" value="<?= $criRow['tabs_cri_id'] ?>" required>
                                                        </td>

                                                    <?php } ?>
                                                    <td class="text-center text-bold"><h2><?= getCandidateRank($candidate['tabs_can_id'], $tabs_event_id, $redirect, $tabs_user_id) ?></h2></td>
                                                    
                                                </tr>

                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row justify-content-center mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button type="submit" id="generateRank" class="btn btn-primary btn-lg btn-block text-uppercase">Submit and Generate Rank</button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <p class="text-center">Note: all score are autosaved but be sure to click the <span class="text-primary">SUBMIT AND GENERATE RANK</span> to identify your rankings.</p>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <?php include '_footer.php'; ?>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showRanks" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><i class="ti-bar-chart"></i> Ranking</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-sorter-wrapper col-lg-12 table-responsive">
                        <table class="table table-hover table-bordered border-dark">
                            <thead>
                                <tr class="table-dark">
                                    <th class="sortStyle text-center">#</th>
                                    <th class="sortStyle text-center">Candidate</th>
                                    <th class="sortStyle text-center">Rank</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                                    //populate candidates join to results scores condition with judge id (tabs_user_id)
                                    $getRanks=dbaselink()->prepare("SELECT * FROM tabs_results
                                                                    Where 
                                                                    tabs_cat_id = :tabs_cat_id AND
                                                                    tabs_event_id = :tabs_event_id AND
                                                                    tabs_user_id = :tabs_user_id
                                                                    Order By tabs_result_rank ASC");
                                    $getRanks->execute([
                                        'tabs_cat_id' => $redirect,
                                        'tabs_event_id' => $tabs_event_id,
                                        'tabs_user_id' => $tabs_user_id
                                    ]);
                                    while ($rank=$getRanks->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= getCandidateNumber($rank['tabs_can_id']) ?></td>
                                    <td class="text-center text-bold"><?= limitString(getCandidateName($rank['tabs_can_id']), 25) ?></td>
                                    <td class="text-center text-bold"><?= $rank['tabs_result_rank'] ?></td>
                                    
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '_scripts.php'; ?>
    
    
    <script type="text/javascript">

        $(document).ready(function () {

            function autoCloseLoader() {
                $.ajax({
                    type: "GET",
                    url: "auto_loader.php?catId=<?= $redirect ?>",
                    dataType: "html",              
                    success: function (response) {
                        
                        if (response == 0) {

                            console.log("category open");
                            
                        } else {

                            console.log("category close");
                            window.location.href = 'index?note=cat_closed';
                            
                        }

                        setTimeout(autoCloseLoader, 3000)
                    }
                });
            }

            autoCloseLoader();
        });
        
        function updateScore(canId, criId, score){

            $(document).ready(function(){

                $.get(
                    "auto_update_score.php?canId=" + canId + "&catId=<?= $redirect ?>&criId=" + criId, 
                    {score: score}, 
                    function(data){

                    setTimeout(function () {
                        
                        if (data == 0) {

                            //nothing to do here

                        } else if (data == 1) {

                            toastr.error('error');
                            $("#result_" + criId + canId).val("");

                        } else if (data == 2) {

                            //nothing to do here

                        } else if (data == 3) {

                            toastr.error('Exceeding max input');
                            $("#result_" + criId + canId).val("");

                        } else if (data == 4) {

                            window.location.href = 'index?note=cat_closed'

                        } else if (data == 5) {

                            toastr.error('Please put minimum input');
                            // $("#result_" + criId + canId).val("");

                        } else {

                            //nothing to do here

                        }

                    }, 700);

                });

            });
            
        }

        $(document).ready(function(){

            $('#showHideImage').change(function () {
                if ($(this).prop("checked")) {
                    $('.canImages').removeClass("d-none");
                    console.log("checked");
                }else{
                    $('.canImages').addClass("d-none");
                    console.log("unchecked");
                }
                console.log("changed");
            });

        });

    </script>

    <?php include '_alerts.php'; ?>

</body>

</html>

