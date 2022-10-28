<?php
    require '../../config/includes.php';
    require 'session.php';  
?>

<div class="col-md-12 mb-3">
    <h1 class="display-4">
        <i class="ti-clipboard"></i> Categories
        <span class="float-end">
            <span class="badge badge-primary">Open Category</span>
            <span class="badge badge-danger">Close Category</span>
        </span>
    </h1>
</div>

<?php     
    //populate categories
    $getCategories = selectCategories($tabs_event_id);
    while ($category=$getCategories->fetch(PDO::FETCH_ASSOC)) {
?>

<div class="col-md-3 mb-4 stretch-card transparent">
    <div class="card <?= categoryStatusColor($category['tabs_cat_status']) ?>">
        <div class="card-body">
            <p class="fs-6 mb-1 text-center">
                <?= $category['tabs_cat_title'] ?>
            </p>
        </div>
        <a href="<?= categoryStatusLink($category['tabs_cat_status'], $category['tabs_cat_id']) ?>" class="stretched-link" title="click to open this category ..."></a>
    </div>
</div>

<?php } ?>


