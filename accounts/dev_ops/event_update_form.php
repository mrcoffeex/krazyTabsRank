<?php  
    require '../../config/includes.php';
    require 'session.php';

    $eventId = @$_GET['eventId'];

    if (checkIfExist("tabs_events", "tabs_event_id", $eventId) > 0) {
        
        //nothing to do
        $getEvent=selectEventsById($eventId);
        $event=$getEvent->fetch(PDO::FETCH_ASSOC);
        
    } else {
        header("location: error?note=invalid");
    }

    $title = "Update Event";
    $upp_description = $event['tabs_event_title'];
?>

<!DOCTYPE html>
<html lang="en">

<?php include '_head.php'; ?>

<body>
    <div class="container-scroller">
        
        <?php include '_navbar.php'; ?>
        
        <div class="container-fluid page-body-wrapper">

        <?php include '_sidebar.php'; ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <?php include '_breads.php'; ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <form 
                                        method="post" 
                                        enctype="multipart/form-data" 
                                        action="event_update?rand=<?= my_rand_str(30) ?>&eventId=<?= $eventId ?>">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" name="event_title" maxlength="255" value="<?= $event['tabs_event_title'] ?>" autofocus required>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" name="event_desc" rows="3" maxlength="255" required><?= $event['tabs_event_desc'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Year</label>
                                                <input type="number" class="form-control" name="event_year" min="2022" max="2050" value="<?= $event['tabs_event_year'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="submit_update_event" class="btn btn-info">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"><i class="ti-file"></i> Event Details</h3>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class="table-dark">
                                                    <th>Column</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Title</td>
                                                    <td class="text-bold"><?= $event['tabs_event_title'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Description</td>
                                                    <td class="text-bold"><?= $event['tabs_event_desc'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Year</td>
                                                    <td class="text-bold"><?= $event['tabs_event_year'] ?></td>
                                                </tr>
                                            </tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <?php include '_footer.php'; ?>

                </div>
            </div>
        </div>
    </div>

    <?php include '_scripts.php'; ?>

    <?php include '_alerts.php'; ?>

</body>

</html>

