<?php  
    require '../../config/includes.php';
    require 'session.php';

    $catId = @$_GET['catId'];
    $canId = @$_GET['canId'];

    if (checkIfExist("tabs_categories", "tabs_cat_id", $catId) > 0) {
        
        //check if belongs to events
        if (validateCategory($catId, $tabs_event_id) > 0) {

            if (getCategoryStatus($catId) != 0) {
                header("location: ./?note=cat_closed");
            } else {
                //nothing to do
            }

        }else{
            header("location: error?note=invalid");
        }
        
    } else {
        header("location: error?note=invalid");
    }

    if (checkIfExist("tabs_candidates", "tabs_can_id", $canId) > 0) {
        
        //check if belongs to events
        if (validateCandidate($canId, $tabs_event_id) > 0) {
            //nothing to do
        }else{
            header("location: error?note=invalid");
        }
        
    } else {
        header("location: error?note=invalid");
    }

    $title = "Judge ".$tabs_user_fullname;
    $upp_description = "
    <a href='category?rand=".my_rand_str(30)."&cd=$catId' class='text-decoration-none text-dark'>
    <i class='ti-angle-double-left'></i> ".getEventTitleByCatId($catId)."
    </a> 
    <span class='text-primary'>".getCategoryTitle($catId)."</span>
     - <span class='text-success'>".getCandidateName($canId)."</span>";
?>

<!DOCTYPE html>
<html lang="en">

<?php include '_head.php'; ?>

<body>
    <div class="container-scroller">
        
        <?php include '_navbar.php'; ?>
        
        <div class="container-fluid page-body-wrapper">

        <?php include '_sidebar.php'; ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <?php include '_breads.php'; ?>

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card mb-3 bg-warning">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="text-center">
                                                <?= "#".getCandidateNumber($canId)." ".getCandidateName($canId) ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <?php  
                                            $getCriteria=selectCriteria($catId);
                                            while ($criteria=$getCriteria->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <form 
                                            method="POST" 
                                            enctype="multipart/form-data" 
                                            action="submit_score?rand=<?= my_rand_str(30) ?>&criId=<?= $criteria['tabs_cri_id'] ?>&canId=<?= $canId ?>" 
                                            onsubmit="validate_<?= $criteria['tabs_cri_id'] ?>(this)">

                                                <h1 class="display-4 text-center">
                                                    <?= $criteria['tabs_cri_title'] ?>
                                                </h1>
                                                <p class="text-center text-primary">
                                                    <?= $criteria['tabs_cri_desc'] ?>
                                                </p>
                                                <p class="text-center">
                                                    please enter your score from <?= $criteria['tabs_cri_score_min']." - ".$criteria['tabs_cri_score_max'] ?>
                                                </p>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group pt-3">
                                                            <input 
                                                            type="range" 
                                                            class="form-range" 
                                                            min="<?= $criteria['tabs_cri_score_min'] ?>" 
                                                            max="<?= $criteria['tabs_cri_score_max'] ?>" 
                                                            step="1" 
                                                            id="range_<?= $criteria['tabs_cri_id'] ?>" 
                                                            onchange="rangeValue_<?= $criteria['tabs_cri_id'] ?>()">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input 
                                                            type="number" 
                                                            name="score" 
                                                            id="score_<?= $criteria['tabs_cri_id'] ?>" 
                                                            class="form-control text-center"
                                                            min="<?= $criteria['tabs_cri_score_min'] ?>" 
                                                            max="<?= $criteria['tabs_cri_score_max'] ?>" 
                                                            step="1" 
                                                            value="<?= getCandidateResultByCriteria($criteria['tabs_cri_id'], $catId, $canId, $tabs_user_id) ?>" 
                                                            autofocus 
                                                            required
                                                            onfocus="this.select()">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group text-center">
                                                            <button 
                                                            type="submit" 
                                                            id="submit_<?= $criteria['tabs_cri_id'] ?>" 
                                                            class="btn btn-primary">Submit Score </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>

                                            <script>

                                                function rangeValue_<?= $criteria['tabs_cri_id'] ?>(){
                                                    
                                                    var range = $("#range_<?= $criteria['tabs_cri_id'] ?>").val();

                                                    $("#score_<?= $criteria['tabs_cri_id'] ?>").val(range);

                                                }

                                                function validate_<?= $criteria['tabs_cri_id'] ?>(formObj){

                                                    formObj.submit_<?= $criteria['tabs_cri_id'] ?>.disabled = true;
                                                    formObj.submit_<?= $criteria['tabs_cri_id'] ?>.innerHTML = "processing ...";
                                                    return true;

                                                }
                                                 
                                            </script>
                                                
                                        <?php } ?>

                                        </div>

                                        <div class="col-md-4">
                                            <a href="previous?number=<?= getCandidateNumber($canId) ?>&catId=<?= $catId ?>&canId=<?= $canId ?>">
                                                <button 
                                                type="button" 
                                                class="btn btn-info">
                                                <i class="ti-angle-double-left"></i> Previous
                                                </button>
                                            </a>
                                        </div>

                                        <div class="col-md-4 text-center">
                                            <a href="category?rand=<?= my_rand_str(30) ?>&cd=<?= $catId ?>">
                                                <button 
                                                type="button" 
                                                class="btn btn-success" 
                                                title="click to go back to list of candidates ..."><i class="ti-list"></i> View List</button>
                                            </a>
                                        </div>

                                        <div class="col-md-4">
                                            <a href="next?number=<?= getCandidateNumber($canId) ?>&catId=<?= $catId ?>&canId=<?= $canId ?>">
                                                <button 
                                                type="button" 
                                                class="btn btn-info float-end">
                                                Next <i class="ti-angle-double-right"></i>
                                                </button>
                                            </a>
                                        </div>
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

    <?php include '_alerts.php'; ?>

</body>

</html>

