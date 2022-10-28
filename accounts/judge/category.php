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
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <span class="text-bold"><?= $criteria['tabs_cri_title'] ?></span><br>
                                    <?= $criteria['tabs_cri_desc'] ?><br>
                                    Scoring: <span class="text-primary"><?= $criteria['tabs_cri_score_min'] . " - " . $criteria['tabs_cri_score_max'] ?></span>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                                
                        
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title text-center">
                                        <span class="text-primary"><?= getCategoryTitle($redirect) ?></span> Category
                                    </h3>
                                    <div class="table-sorter-wrapper col-lg-12 table-responsive">
                                        <table class="table table-hover table-bordered" id="sortable-table-1">
                                            <thead>
                                                <tr class="table-dark">
                                                    <th class="sortStyle text-center"># <i class="ti-angle-down"></i></th>
                                                    <th class="sortStyle">Candidate <i class="ti-angle-down"></i></th>
                                                    <?php  
                                                        //get criteria
                                                        $getCriHead=selectCriteria($redirect);
                                                        while ($criHead=$getCriHead->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                    <th class="sortStyle text-center">
                                                        <?= $criHead['tabs_cri_title'] ?> 
                                                        <span class="text-warning"><?= $criHead['tabs_cri_score_min']." - ".$criHead['tabs_cri_score_max'] ?></span>
                                                        <i class="ti-angle-down"></i>
                                                    </th>
                                                    <?php } ?>
                                                    <th class="sortStyle text-center">Total <i class="ti-angle-down"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  
                                                    //populate candidates join to results scores condition with judge id (tabs_user_id)
                                                    $getCandidates=selectCandidatesByEvent($tabs_event_id);
                                                    while ($candidate=$getCandidates->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $candidate['tabs_can_number'] ?></td>
                                                    <td><?= $candidate['tabs_can_name'] ?></td>

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
                                                            class="form-control form-control-sm text-center border border-light" 
                                                            min="<?= $criRow['tabs_cri_score_min'] ?>" 
                                                            max="<?= $criRow['tabs_cri_score_max'] ?>" 
                                                            step="1" 
                                                            id="result_<?= $criRow['tabs_cri_id'] ?>" 
                                                            value="<?= getCandidateResultByCriteria($criRow['tabs_cri_id'], $redirect, $candidate['tabs_can_id'], $tabs_user_id) ?>" 
                                                            onkeyup="updateScore(<?= $candidate['tabs_can_id'] ?>, <?= $criRow['tabs_cri_id'] ?>, this.value)" autofocus>
                                                        </td>

                                                    <?php } ?>
                                                    <td class="text-center text-bold"><span id="totalScore_<?= $candidate['tabs_can_id'] ?>"><?= $totalScore ?></span></td>
                                                    
                                                </tr>

                                                <script>

                                                    $(document).ready(function () {

                                                        function loadTotalScore_<?= $candidate['tabs_can_id'] ?>() {
                                                            $.ajax({
                                                                type: "GET",
                                                                url: "auto_total_score.php?canId=<?= $candidate['tabs_can_id'] ?>&catId=<?= $redirect ?>",
                                                                dataType: "html",              
                                                                success: function (response) {
                                                                    $("#totalScore_<?= $candidate['tabs_can_id'] ?>").html(response);
                                                                    setTimeout(loadTotalScore_<?= $candidate['tabs_can_id'] ?>, 1000)
                                                                }
                                                            });
                                                        }

                                                        loadTotalScore_<?= $candidate['tabs_can_id'] ?>();
                                                    });

                                                </script>

                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <?php include '_footer.php'; ?>

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

                        } else if (data == 2) {

                            //nothing to do here

                        } else if (data == 3) {

                            toastr.error('Exceeding max input');

                        } else if (data == 4) {

                            window.location.href = 'index?note=cat_closed'

                        } else {

                            //nothing to do here

                        }

                    }, 700);

                });

            });
            
        }

    </script>

    <?php include '_alerts.php'; ?>

</body>

</html>

