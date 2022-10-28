<?php  
    //put alerts here
    $currpage = str_replace('.php', '', basename($_SERVER['PHP_SELF']));

    $note = @$_GET['note'];

    if ($note == "error") {
        echo "
            <script>
                toastr.error('Error');
            </script>
        ";
    }else if ($note == "cat_closed" && $currpage == "index") {
        echo "
            <script>
                toastr.error('Category Closed');
            </script>
        ";
    }else if ($note == "invalid" && $currpage == "error") {
        echo "
            <script>
                toastr.error('Invalid Action');
            </script>
        ";
    }else if ($note == "score_submit" && $currpage == "rate") {
        echo "
            <script>
                toastr.success('Score has been saved');
            </script>
        ";
    }else if ($note == "list_start" && $currpage == "rate") {
        echo "
            <script>
                toastr.error('Candidates starts here');
            </script>
        ";
    }else if ($note == "list_end" && $currpage == "rate") {
        echo "
            <script>
                toastr.error('No more candidates');
            </script>
        ";
    }else{
        echo "";
    }
?>