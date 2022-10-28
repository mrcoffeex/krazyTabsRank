<?php  
    require '../../config/includes.php';
    require 'session.php';

    $eventId = clean_int($_GET['eventId']);

    $title = getEventTitle($eventId)." Candidates";
    $upp_description = '<span class="text-primary">'.countCandidatesByEvent($eventId).'</span> results.';
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
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-can"><i class="ti-plus"></i> Create Candidate</button>

                                        <button 
                                        tpye="button" 
                                        class="btn btn-primary float-end" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#transfer-candidates">
                                            <i class="ti-exchange-vertical"></i> Transfer Candidates
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class="table-dark">
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Designation</th>
                                                    <th>Event</th>
                                                    <th class="text-center">Edit</th>
                                                    <th class="text-center">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $getCandidates=selectCandidatesByEvent($eventId);
                                                    while ($candidate=$getCandidates->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td><?= $candidate['tabs_can_number']; ?></td>
                                                    <td><?= $candidate['tabs_can_name']; ?></td>
                                                    <td><?= $candidate['tabs_can_desc']; ?></td>
                                                    <td><?= getEventTitle($candidate['tabs_event_id']); ?></td>
                                                    <td class="text-center">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-info btn-sm" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#edit_<?= $candidate['tabs_can_id']; ?>">
                                                            <i class="ti-pencil"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#delete_<?= $candidate['tabs_can_id'] ?>">
                                                            <i class="ti-close"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- edit -->
                                                <div class="modal fade" id="edit_<?= $candidate['tabs_can_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalLabel"><i class="ti-pencil"></i> Update Candidate</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form 
                                                                method="post" 
                                                                enctype="multipart/form-data" 
                                                                action="candidate_update?rand=<?= my_rand_str(30) ?>&eventId=<?= $eventId ?>&canId=<?= $candidate['tabs_can_id'] ?>">

                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>Number</label>
                                                                    <input type="number" class="form-control" name="can_number" min="1" step="1" value="<?= $candidate['tabs_can_number'] ?>" autofocus required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control" name="name" value="<?= $candidate['tabs_can_name'] ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Designation</label>
                                                                    <input type="text" class="form-control" name="designation" value="<?= $candidate['tabs_can_desc'] ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Event</label>
                                                                    <select name="event" class="form-control" required>
                                                                        <option value="<?= $candidate['tabs_event_id'] ?>"><?= getEventTitle($candidate['tabs_event_id']) ?></option>
                                                                        <?php  
                                                                            //populate events
                                                                            $getEvents = selectEvents();
                                                                            while ($event=$getEvents->fetch(PDO::FETCH_ASSOC)) {
                                                                                echo "<option value='".$event['tabs_event_id']."'>".$event['tabs_event_title']."</option>";
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div> 
                                                            <div class="modal-footer">
                                                                <button type="submit" id="submit_update_can" class="btn btn-info">Update</button>
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            </div>     
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- delete -->
                                                <div class="modal fade" id="delete_<?= $candidate['tabs_can_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalLabel"><i class="ti-close"></i> Delete Candidate</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form 
                                                                method="post" 
                                                                enctype="multipart/form-data" 
                                                                action="candidate_delete?rand=<?= my_rand_str(30) ?>&eventId=<?= $eventId ?>&canId=<?= $candidate['tabs_can_id'] ?>">
                                                            <div class="modal-body">
                                                                <p class="text-center">
                                                                    Trying to delete <br>
                                                                    <span class="text-danger"><?= $candidate['tabs_can_name']; ?></span>
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" id="submit_delete_can" 
                                                                name="submit_delete_can" class="btn btn-danger">Delete</button>
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

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
    <div class="modal fade" id="add-can" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><i class="ti-plus"></i> Create Candidate</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="candidate_create?eventId=<?= $eventId ?>" onsubmit="validateCreateCandidate(this)">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Number</label>
                        <input type="number" class="form-control" name="can_number" min="1" step="1" autofocus required>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" class="form-control" name="designation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit_create_can" class="btn btn-success">Create</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="transfer-candidates" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><i class="ti-exchange-vertical"></i> Transfer Candidates</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="candidate_transfer?eventId=<?= $eventId ?>" onsubmit="validateTransferCandidate(this)">
                <div class="modal-body">
                    <p class="text-uppercase text-bold mb-3">select candidates to transfer</p>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="selectAllCandidates" id="selectAllCandidates" value="all"> Select All
                        </label>
                    </div>
                    <?php 
                        $getCandidates=selectCandidatesByEvent($eventId);
                        while ($candidate=$getCandidates->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="candidates[]" id="<?= $candidate['tabs_can_id'] ?>" value="<?= $candidate['tabs_can_id'] ?>"> <?= $candidate['tabs_can_number'] . " - " . $candidate['tabs_can_name'] ?>
                        </label>
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <label>Select Event</label>
                        <select name="event" class="form-control" required>
                            <option></option>
                            <?php  
                                //populate events
                                $getEvents = selectEvents();
                                while ($event=$getEvents->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='".$event['tabs_event_id']."'>".$event['tabs_event_title']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit_transfer_candidate" class="btn btn-primary">Transfer</button>
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

