<?php  
    include '../../config/includes.php';
    include 'session.php';

    $redirect = @$_GET['cd'];

    if (isset($_POST['cat_title'])) {
        $cat_title = clean_string($_POST['cat_title']);

        $insert_data = createCategory($cat_title, 0, $redirect);

        if ($insert_data == true) {
            header("location: category?rand=".my_rand_str(30)."&cd=$redirect&note=cat_added");
        }else{
            header("location: category?rand=".my_rand_str(30)."&cd=$redirect&note=error");
        }
    }
?>