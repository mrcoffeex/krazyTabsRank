<?php  
    include '../../config/includes.php';
    include 'session.php';

    $redirect = @$_GET['cd'];

    if (isset($_POST['cat_title'])) {
        $cat_title = clean_string($_POST['cat_title']);
        $cat_percentage = clean_float($_POST['cat_percentage']);

        $insert_data = createCategory($cat_title, $cat_percentage, $redirect);

        if ($insert_data == true) {
            header("location: category?rand=".my_rand_str(30)."&cd=$redirect&note=cat_added");
        }else{
            header("location: category?rand=".my_rand_str(30)."&cd=$redirect&note=error");
        }
    }
?>