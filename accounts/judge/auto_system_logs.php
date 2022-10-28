<?php  
    require '../../config/includes.php';
    require 'session.php';

    //get system logs
    $getsystemlogs=dbaselink()->prepare("SELECT e4ps_notif_type,
                                        e4ps_notif_date, 
                                        e4ps_notif_text 
                                        From 
                                        e4ps_notification 
                                        Order By 
                                        e4ps_notif_id DESC LIMIT 17");
    $getsystemlogs->execute();
    while ($systemlogs=$getsystemlogs->fetch(PDO::FETCH_ASSOC)) {
        
        echo '
        <tr>
            <td class="p-2 '.get_system_logs_skin($systemlogs['e4ps_notif_type']).' text-center col-sm-2">
                '.get_date_status(date("Y-m-d", strtotime($systemlogs['e4ps_notif_date']))).'
            </td>
            <td class="p-2 col-sm-10">
                '.$systemlogs['e4ps_notif_text'].'
            </td>
        </tr>
        ';

    }
?>