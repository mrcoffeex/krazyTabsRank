<?php  
    require '../../config/includes.php';
    require 'session.php';

    $title = "Events";
    $upp_description = '<span class="text-primary">'.countEvents().'</span> results.';
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <a href="event_create_form">
                                            <button type="button" class="btn btn-success"><i class="ti-plus"></i> Create Event</button>
                                        </a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class="table-dark">
                                                    <th class="text-center">Results</th>
                                                    <th class="text-center">Categories</th>
                                                    <th class="text-center">Judges</th>   
                                                    <th class="text-center">Candidates</th>    
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Year</th>
                                                    <th class="text-center">Switch</th>
                                                    <th class="text-center">Edit</th>
                                                    <th class="text-center">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $getEvents=selectEvents();
                                                    while ($event=$getEvents->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <a href="event_results?rand=<?= my_rand_str(30) ?>&cd=<?= $event['tabs_event_id'] ?>" onclick="window.open(this.href, 'mywin', 'left=20, top=20, width=1366, height=768, toolbar=1, resizable=0'); return false;">
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-primary btn-sm">
                                                                <i class="ti-bar-chart"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-success btn-sm" 
                                                            onclick="window.location.href='category?rand=<?= my_rand_str(30) ?>&cd=<?= $event['tabs_event_id'] ?>'">
                                                            <i class="ti-list"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-info btn-sm" 
                                                            onclick="window.location.href='event_judges?rand=<?= my_rand_str(30) ?>&eventId=<?= $event['tabs_event_id'] ?>'">
                                                            <i class="ti-user"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-warning btn-sm" 
                                                            onclick="window.location.href='event_candidates?rand=<?= my_rand_str(30) ?>&eventId=<?= $event['tabs_event_id'] ?>'">
                                                            <i class="ti-crown"></i>
                                                        </button>
                                                    </td>
                                                    <td><?= $event['tabs_event_title']; ?></td>
                                                    <td><?= $event['tabs_event_desc']; ?></td>
                                                    <td><?= $event['tabs_event_year']; ?></td>
                                                    <td class="text-center">
                                                        <div class="form-switch">
                                                            <input 
                                                            class="form-check-input" 
                                                            type="checkbox" 
                                                            role="switch" 
                                                            value="updateSwitch" 
                                                            id="eventSwitch_<?= $event['tabs_event_id']; ?>"
                                                            onchange="updateSwitch_<?= $event['tabs_event_id']; ?>(this)" 
                                                            <?= eventCheckboxStatus($event['tabs_event_status']) ?> />
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="event_update_form?rand=<?= my_rand_str(30) ?>&eventId=<?= $event['tabs_event_id']; ?>">
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-info btn-sm" >
                                                                <i class="ti-pencil"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#delete_<?= $event['tabs_event_id']; ?>">
                                                            <i class="ti-close"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- edit -->
                                                <div class="modal fade" id="edit_<?= $event['tabs_event_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalLabel"><i class="ti-pencil"></i> Update Event</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form 
                                                                method="post" 
                                                                enctype="multipart/form-data" 
                                                                action="event_update?rand=<?= my_rand_str(30) ?>&cd=<?= $event['tabs_event_id'] ?>">

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
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- deactivate -->
                                                <div class="modal fade" id="delete_<?= $event['tabs_event_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalLabel"><i class="ti-close"></i> Delete Event</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form 
                                                                method="post" 
                                                                enctype="multipart/form-data" 
                                                                action="event_delete?rand=<?= my_rand_str(30) ?>&cd=<?= $event['tabs_event_id']; ?>">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>Enter password *</label>
                                                                    <input type="password" class="form-control" name="deletePassword" autofocus required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="text-danger">
                                                                        <b>Warning!</b> deleting this event will also deleting all the records inside it including <b>judges</b> / <b>candidates</b> / <b>scores</b>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" id="submit_delete_event" 
                                                                name="submit_delete_event" class="btn btn-danger">Delete</button>
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <script>
                                                    //switch
                                                    function updateSwitch_<?= $event['tabs_event_id']; ?>(input) {
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "event_switch.php?cd=<?= $event['tabs_event_id']; ?>",
                                                            data: "selected=" + input.value,
                                                            success: function(data) {
                                                                if (data == "ok") {
                                                                    toastr.success("Highlight Status changed");
                                                                } else {
                                                                    toastr.error("Error");
                                                                }
                                                            },
                                                            error: function() {
                                                                console.log("error");
                                                            }
                                                        });
                                                    }
                                                </script>

                                                <?php } ?>
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
    
    <!-- modals -->
    <div class="modal fade" id="add-event" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><i class="ti-plus"></i> Create Event</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="event_create" onsubmit="validateCreateEvent(this)">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Scoring Type</label>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" name="event_scoretype" id="event_scoretype0" value="0" checked required>
                                    Averaging
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" name="event_scoretype" id="event_scoretype1" value="1">
                                    Ranking
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="event_title" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="event_desc" rows="3" maxlength="255" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Year</label>
                        <input type="number" class="form-control" name="event_year" min="2022" max="2050" required>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="event_eliminate" id="event_eliminate" value="1" checked> Elimation
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Elimation Title</label>
                        <input type="text" class="form-control" name="event_eliminate_title" id="event_eliminate_title" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label>Elimation Candidate Count</label>
                        <input type="number" class="form-control" name="event_eliminate_num" id="event_eliminate_num" min="1" step="1" max="20" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit_create_event" class="btn btn-success">Create</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '_scripts.php'; ?>

    <?php include '_alerts.php'; ?>

</body>

</html>

