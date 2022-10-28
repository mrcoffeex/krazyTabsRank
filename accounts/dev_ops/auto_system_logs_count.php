<?php  
    require '../../config/includes.php';
    require 'session.php';

    //count system logs
    echo count_system_logs($onlydate, $onlydate);
?>