<?php  
    //put alerts here
    $currpage = str_replace('.php', '', basename($_SERVER['PHP_SELF']));

    $note = @$_GET['note'];

    if ($note == "error" && $currpage == "index") {
        echo "
            <script>
                toastr.error('Error');
            </script>
        ";
    }else if ($note == "noexist" && $currpage == "index") {
        echo "
            <script>
                toastr.error('Either username or password is incorrect');
            </script>
        ";
    }else if ($note == "suspended" && $currpage == "index") {
        echo "
            <script>
                toastr.error('Account is suspended');
            </script>
        ";
    }else if ($note == "not_string" && $currpage == "error") {
        echo "
            <script>
                toastr.error('Input is not a string');
            </script>
        ";
    }else if ($note == "not_post_email" && $currpage == "error") {
        echo "
            <script>
                toastr.error('Input is not a POST email');
            </script>
        ";
    }else if ($note == "not_get_email" && $currpage == "error") {
        echo "
            <script>
                toastr.error('Input is not a GET email');
            </script>
        ";
    }else if ($note == "not_post_int" && $currpage == "error") {
        echo "
            <script>
                toastr.error('Input is not a POST integer');
            </script>
        ";
    }else if ($note == "not_get_int" && $currpage == "error") {
        echo "
            <script>
                toastr.error('Input is not a GET integer');
            </script>
        ";
    }else{
        echo "";
    }
?>