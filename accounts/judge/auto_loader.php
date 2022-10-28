<?php

    require '../../config/includes.php';
    require 'session.php';

    $catId = clean_int($_GET['catId']);

    if (getCategoryStatus($catId) != 0) {
        print(1);
    } else {
        print(0);
    }
?>


