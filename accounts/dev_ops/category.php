<?php  
    require '../../config/includes.php';
    require 'session.php';

    $redirect = @$_GET['cd'];

    $title = getEventTitle($redirect)." Categories";
    $upp_description = '<span class="text-primary">'.countCategories($redirect).'</span> results.';
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
                                        <a href="events">
                                            <button type="button" class="btn btn-dark btn-sm">go back</button>
                                        </a>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-category"><i class="ti-plus"></i> Create Category</button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class="table-dark">   
                                                    <th class="text-center">Results</th>
                                                    <th class="text-center">Criteria</th>
                                                    <th>Title</th>
                                                    <th>Event</th>
                                                    <th>%</th>
                                                    <th class="text-center">Switch</th>
                                                    <th class="text-center">Reset</th>
                                                    <th class="text-center">Edit</th>
                                                    <th class="text-center">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $total=0;
                                                    $getCategory = selectCategories($redirect);
                                                    while ($category=$getCategory->fetch(PDO::FETCH_ASSOC)) {
                                                        $total += $category['tabs_cat_percentage'];

                                                        if ($total == 100) {
                                                            $textColor = "text-success";
                                                        } else {
                                                            $textColor = "text-danger";
                                                        }
                                                        
                                                ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <a href="category_results?rand=<?= my_rand_str(30) ?>&cd=<?= $category['tabs_cat_id'] ?>" onclick="window.open(this.href, 'mywin', 'left=20, top=20, width=1366, height=768, toolbar=1, resizable=0'); return false;">
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-primary btn-sm">
                                                                <i class="ti-bar-chart"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="criteria?rand=<?= my_rand_str(30) ?>&cd=<?= $category['tabs_cat_id'] ?>" onclick="window.open(this.href, 'mywin', 'left=20, top=20, width=1366, height=768, toolbar=1, resizable=0'); return false;">
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-success btn-sm">
                                                                <i class="ti-list"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td><?= $category['tabs_cat_title'] ?></td>
                                                    <td><?= getEventTitle($category['tabs_event_id']) ?></td>
                                                    <td><?= $category['tabs_cat_percentage']." %" ?></td>
                                                    <td class="text-center">
                                                        <div class="form-switch">
                                                            <input 
                                                            class="form-check-input" 
                                                            type="checkbox" 
                                                            role="switch" 
                                                            value="updateSwitch" 
                                                            id="catSwitch_<?= $category['tabs_cat_id']; ?>"
                                                            onchange="updateSwitch_<?= $category['tabs_cat_id']; ?>(this)" 
                                                            <?= categoryCheckboxStatus($category['tabs_cat_status']) ?> />
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-warning btn-sm" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#reset_<?= $category['tabs_cat_id']; ?>">
                                                            <i class="ti-reload"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-info btn-sm" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#edit_<?= $category['tabs_cat_id']; ?>">
                                                            <i class="ti-pencil"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#delete_<?= $category['tabs_cat_id']; ?>">
                                                            <i class="ti-close"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- reset -->
                                                <div class="modal fade" id="reset_<?= $category['tabs_cat_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalLabel"><i class="ti-reload"></i> Reset Category Result</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form 
                                                                method="post" 
                                                                enctype="multipart/form-data" 
                                                                action="category_reset?rand=<?= my_rand_str(30) ?>&cd=<?= $category['tabs_cat_id']; ?>&eventId=<?= $redirect ?>">
                                                            <div class="modal-body">
                                                                <p class="text-center">
                                                                    Trying to reset <br>
                                                                    <span class="text-warning"><?= $category['tabs_cat_title'] ?> Category</span>
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                name="submit_reset_category" class="btn btn-warning">Reset</button>
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- edit -->
                                                <div class="modal fade" id="edit_<?= $category['tabs_cat_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalLabel"><i class="ti-pencil"></i> Update Category</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form 
                                                                method="post" 
                                                                enctype="multipart/form-data" 
                                                                action="category_update?rand=<?= my_rand_str(30) ?>&cd=<?= $category['tabs_cat_id'] ?>&eventId=<?= $redirect ?>">

                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>Title</label>
                                                                    <input type="text" class="form-control" name="cat_title" value="<?= $category['tabs_cat_title'] ?>" autofocus required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Overall Percentage %</label>
                                                                    <input type="number" class="form-control" name="cat_percentage" min="0" step="0.01" value="<?= $category['tabs_cat_percentage'] ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="submit_update_category" class="btn btn-info">Update</button>
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- delete -->
                                                <div class="modal fade" id="delete_<?= $category['tabs_cat_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalLabel"><i class="ti-close"></i> Delete Category</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form 
                                                                method="post" 
                                                                enctype="multipart/form-data" 
                                                                action="category_delete?rand=<?= my_rand_str(30) ?>&cd=<?= $category['tabs_cat_id']; ?>&eventId=<?= $redirect ?>">
                                                            <div class="modal-body">
                                                                <p class="text-center">
                                                                    Trying to delete <br>
                                                                    <span class="text-danger"><?= $category['tabs_cat_title']; ?></span>
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                name="submit_delete_category" class="btn btn-danger">Delete</button>
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <script>
                                                    //switch
                                                    function updateSwitch_<?= $category['tabs_cat_id']; ?>(input) {
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "category_switch.php?cd=<?= $category['tabs_cat_id']; ?>",
                                                            data: "selected=" + input.value,
                                                            success: function(data) {
                                                                if (data == "ok") {
                                                                    toastr.success("Status changed");
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

                                                <tr>
                                                    <td class="text-center <?= $textColor ?>" colspan="4">Total Percentage</td>
                                                    <td class="<?= $textColor ?>"><?= $total ?> %</td>
                                                    <td colspan="4"></td>
                                                </tr>

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
    <div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><i class="ti-plus"></i> Create Category for <?= getEventTitle($redirect) ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="category_create?rand=<?= my_rand_str(30) ?>&cd=<?= $redirect ?>" onsubmit="validateCreateCategory(this)">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="cat_title" autofocus required>
                    </div>
                    <div class="form-group">
                        <label>Overall Percentage %</label>
                        <input type="number" class="form-control" name="cat_percentage" min="0" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit_create_category" class="btn btn-success">Create</button>
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

