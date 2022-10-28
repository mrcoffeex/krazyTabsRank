<?php  
    require '../../config/includes.php';
    require 'session.php';

    $title = "Users";
    $upp_description = '<span class="text-primary">'.countUsers().'</span> results.';
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
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-user"><i class="ti-plus"></i> Create User</button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class="table-dark">
                                                    <th class="text-center">Edit</th>
                                                    <th class="text-center">Activate</th>
                                                    <th class="text-center">DeActivate</th>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Registered</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $getusers=selectUsers();
                                                    while ($user=$getusers->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-info btn-sm" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#edit_<?= $user['tabs_user_id']; ?>">
                                                            <i class="ti-pencil"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-success btn-sm"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#activate_<?= $user['tabs_user_id']; ?>">
                                                            <i class="ti-check"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#deactivate_<?= $user['tabs_user_id']; ?>">
                                                            <i class="ti-close"></i>
                                                        </button>
                                                    </td>
                                                    <td><?= $user['tabs_full_name']; ?></td>
                                                    <td><?= $user['tabs_username']; ?></td>
                                                    <td><?= user_type($user['tabs_user_type']) ?></td>
                                                    <td><?= statusUser($user['tabs_user_status']); ?></td>
                                                    <td><?= proper_date($user['tabs_user_created']); ?></td>
                                                </tr>

                                                <!-- edit -->
                                                <div class="modal fade" id="edit_<?= $user['tabs_user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalLabel"><i class="ti-pencil"></i> Update User</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form 
                                                                method="post" 
                                                                enctype="multipart/form-data" 
                                                                action="user_update?rand=<?= my_rand_str(30) ?>&cd=<?= $user['tabs_user_id'] ?>">

                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control" name="name" value="<?= $user['tabs_full_name'] ?>" autofocus required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Username</label>
                                                                    <input type="text" class="form-control" name="username" value="<?= $user['tabs_username'] ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Password</label>
                                                                    <input type="password" class="form-control" name="password" id="password_<?= $user['tabs_user_id'] ?>" value="<?= decryptIt($user['tabs_password']) ?>" required>
                                                                </div>
                                                                <div class="form-check form-check-primary">
                                                                    <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input"
                                                                    onclick="showPassword_<?= $user['tabs_user_id'] ?>()">
                                                                    Show Password
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" id="submit_update_user" class="btn btn-info">Update</button>
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- activate -->
                                                <div class="modal fade" id="activate_<?= $user['tabs_user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalLabel"><i class="ti-close"></i> Activate User</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form 
                                                                method="post" 
                                                                enctype="multipart/form-data" 
                                                                action="user_activate?rand=<?= my_rand_str(30) ?>&cd=<?= $user['tabs_user_id']; ?>">
                                                            <div class="modal-body">
                                                                <p class="text-center">
                                                                    Trying to activate <br>
                                                                    <span class="text-success"><?= $user['tabs_username']; ?></span>
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" id="submit_activate_user" 
                                                                name="submit_activate_user" class="btn btn-success">Activate</button>
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- deactivate -->
                                                <div class="modal fade" id="deactivate_<?= $user['tabs_user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalLabel"><i class="ti-close"></i> DeActivate User</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form 
                                                                method="post" 
                                                                enctype="multipart/form-data" 
                                                                action="user_deactivate?rand=<?= my_rand_str(30) ?>&cd=<?= $user['tabs_user_id']; ?>">
                                                            <div class="modal-body">
                                                                <p class="text-center">
                                                                    Trying to deactivate <br>
                                                                    <span class="text-danger"><?= $user['tabs_username']; ?></span>
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" id="submit_deactivate_user" 
                                                                name="submit_deactivate_user" class="btn btn-danger">DeActivate</button>
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <script>
                                                    
                                                    function showPassword_<?= $user['tabs_user_id'] ?>() {
                                                        
                                                        var x = document.getElementById("password_<?= $user['tabs_user_id'] ?>");

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
    <div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><i class="ti-plus"></i> Create User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="user_create" onsubmit="validateCreateUser(this)">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" autofocus required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit_create_user" class="btn btn-success">Create</button>
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

