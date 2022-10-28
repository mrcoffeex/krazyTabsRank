var timer;

$(document).ready(function(){

    clearTimeout(timer);
    var ms = 1000; // milliseconds

    $.get("auto_update_score.php?canId=<?= $candidate['tabs_can_id'] ?>&catId=<?= $redirect ?>&criId=<?= $criRow['tabs_cri_id'] ?>", {score: $(this).val()}, function(data){
        timer = setTimeout(function() {
            toastr.success('score updated');
        }, ms);
    });

});