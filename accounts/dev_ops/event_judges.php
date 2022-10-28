<?php  
    require '../../config/includes.php';
    require 'session.php';

    $eventId = clean_int($_GET['eventId']);

    $title = getEventTitle($eventId)." Judges";
    $upp_description = '<span class="text-primary">'.countJudgesByEvent($eventId).'</span> results.';
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
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-judge"><i class="ti-plus"></i> Create Judge</button>

                                        <button 
                                        tpye="button" 
                                        class="btn btn-primary float-end" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#transfer-judge">
                                            <i class="ti-exchange-vertical"></i> Transfer Judges
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class="table-dark">
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Event</th>
                                                    <th class="text-center">Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $getJudges=selectJudgesByEvent($eventId);
                                                    while ($judge=$getJudges->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td><?= $judge['tabs_full_name'] ?></td>
                                                    <td><?= $judge['tabs_username'] ?></td>
                                                    <td><?= getEventTitle($judge['tabs_event_id']) ?></td>
                                                    <td class="text-center">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-info btn-sm" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#edit_<?= $judge['tabs_user_id']; ?>">
                                                            <i class="ti-pencil"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- edit -->
                                                <div class="modal fade" id="edit_<?= $judge['tabs_user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalLabel"><i class="ti-pencil"></i> Update Judge</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form 
                                                                method="post" 
                                                                enctype="multipart/form-data" 
                                                                action="judge_update?rand=<?= my_rand_str(30) ?>&eventId=<?= $eventId ?>&judgeId=<?= $judge['tabs_user_id'] ?>">

                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control" name="name" minlength="6" maxlength="255" value="<?= $judge['tabs_full_name'] ?>" autofocus required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Username</label>
                                                                    <input type="text" class="form-control" name="username" minlength="6" maxlength="16" value="<?= $judge['tabs_username'] ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Password</label>
                                                                    <input type="password" class="form-control" name="password" minlength="6" maxlength="16" id="password_<?= $judge['tabs_user_id'] ?>" value="<?= decryptIt($judge['tabs_password']) ?>" required>
                                                                </div>
                                                                <div class="form-check form-check-primary">
                                                                    <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input"
                                                                    onclick="showPassword_<?= $judge['tabs_user_id'] ?>()">
                                                                    Show Password
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Event</label>
                                                                    <select name="event" class="form-control" required>
                                                                        <option value="<?= $judge['tabs_event_id'] ?>"><?= getEventTitle($judge['tabs_event_id']) ?></option>
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
                                                                <button type="submit" name="submit_update_judge" class="btn btn-info">Update</button>
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            </div>           
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <script>
                                                    
                                                    function showPassword_<?= $judge['tabs_user_id'] ?>() {
                                                        
                                                        var x = document.getElementById("password_<?= $judge['tabs_user_id'] ?>");

                                                        if (x.type === "password") {
                                                            x.type = "text";
                                                        } else {
                                                            x.type = "password";
                                                        }
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
    <div class="modal fade" id="add-judge" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><i class="ti-plus"></i> Create Judge</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="judge_create?eventId=<?= $eventId ?>" onsubmit="validateCreateJudge(this)">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" minlength="6" maxlength="255" autofocus required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" minlength="6" maxlength="16" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit_create_judge" class="btn btn-success">Create</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="transfer-judge" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><i class="ti-exchange-vertical"></i> Transfer Judge</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="judge_transfer?eventId=<?= $eventId ?>" onsubmit="validateTransferJudge(this)">
                <div class="modal-body">
                    <p class="text-uppercase text-bold mb-3">select judges to transfer</p>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="selectAllJudges" id="selectAllJudges" value="all"> Select All
                        </label>
                    </div>
                    <?php 
                        $getJudges=selectJudgesByEvent($eventId);
                        while ($judge=$getJudges->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="judges[]" id="<?= $judge['tabs_user_id'] ?>" value="<?= $judge['tabs_user_id'] ?>"> <?= $judge['tabs_full_name'] ?>
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
                    <button type="submit" id="submit_transfer_judge" class="btn btn-primary">Transfer</button>
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

