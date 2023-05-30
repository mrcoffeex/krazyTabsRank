<?php  
    require '../../config/includes.php';
    require 'session.php';

    $redirect = @$_GET['cd'];

    $title = getEventTitle($redirect)." Results";
    $upp_description = '<span class="text-primary">'.countCategories($redirect).'</span> Categories';
?>

<!DOCTYPE html>
<html lang="en">

<?php include '_head.php'; ?>

<body id="print-page-scale">
    <div class="container-scroller">
        
        <div class="container-fluid page-body-wrapper" style="padding-top: 0px;">

            <div class="main-panel" style="width: 100%;">
                <div class="content-wrapper">
                    
                <div class="row mb-3">
                    <div class="col-md-12"> 
                        <div class="row">
                            <div class="col-12 col-xl-8 mb-2 mb-xl-0">
                                <h3 class="font-weight-bold"><?= $title; ?></h3>
                                <h6 class="font-weight-normal mb-0"><?= $upp_description ?></h6>
                            </div>
                            <div class="col-12 col-xl-4 no-print">
                                <div class="justify-content-end d-flex">
                                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                        <button class="btn btn-success" type="button" onclick="window.print()">
                                            Print Result
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-sorter-wrapper col-lg-12 table-responsive">
                                        <table class="table table-hover table-bordered" id="sortable-table-1">
                                            <thead>
                                                <tr>
                                                    <th class="sortStyle p-2 text-center"># <i class="ti-angle-down"></th>
                                                    <th class="sortStyle p-2 text-center">Candidate <i class="ti-angle-down"></th>
                                                    <?php  
                                                        //populate judeges
                                                        $getCategoryHeaders=selectCategories($redirect);
                                                        while ($categoryHead=$getCategoryHeaders->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                    <th class="sortStyle p-2 text-center" title="<?= getCategoryTitle($categoryHead['tabs_cat_id']) ?>">
                                                        <?= limitString(getCategoryTitle($categoryHead['tabs_cat_id']), 12) ?> Rank <i class="ti-angle-down"></i> 
                                                    </th>
                                                    <?php } ?>
                                                    <th class="sortStyle p-2 text-center">Total <i class="ti-angle-down"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    //populate candidates
                                                    $getCandidates=getCandidateResultByEvent($redirect);
                                                    while ($catList=$getCandidates->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td class="p-2 text-center"><?= getCandidateNumber($catList['tabs_can_id']) ?></td>
                                                    <td class="p-2 text-center"><?= getCandidateName($catList['tabs_can_id']) ?></td>
                                                    <?php  
                                                        //populate judeges
                                                        $totalRank=0;
                                                        $getCategories=selectCategories($redirect);
                                                        while ($category=$getCategories->fetch(PDO::FETCH_ASSOC)) {

                                                            $catRank = getCandidateCatRank($catList['tabs_can_id'], $redirect, $category['tabs_cat_id']);

                                                            $totalRank += $catRank;
                                                            
                                                    ?>
                                                    <td class="p-2 text-center"><?= $catRank; ?></td>
                                                    <?php } ?>

                                                    <td class="p-2 text-center"><?= $totalRank ?></td>
                                                </tr>
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

    <?php include '_alerts.php'; ?>

</body>

</html>

