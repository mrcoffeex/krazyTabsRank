<?php  
    require '../../config/includes.php';
    require 'session.php';

    $catId = clean_int($_GET['catId']);

    echo countCategoryResults($catId);
?>