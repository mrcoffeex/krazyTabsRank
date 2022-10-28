<?php

    require '../../config/includes.php';
    require 'session.php';

    $canId = clean_int($_GET['canId']);
    $catId = clean_int($_GET['catId']);
    $criId = clean_int($_GET['criId']);

    $criMax = getCriteriaMax($criId);

    $score = clean_float($_GET['score']);

	if (getCategoryStatus($catId) != 0) {

        print(4);

    } else {

        if (!empty($score)) {

            if ($score > $criMax) {
    
                print(3);
    
            } else {
                
                $insert_data = createResult($tabs_event_id, $catId, $criId, $tabs_user_id, $canId, $score);
    
                if ($insert_data == true) {
    
                    print(0);
    
                } else {
    
                    print(1);
    
                }
    
            }
    
        } else {
    
            print(2);
    
        }

    }
    
?>


