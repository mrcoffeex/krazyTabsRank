<?php  
    require '../../config/includes.php';
    require 'session.php';

    $title = "Event Image";
    $upp_description = "This image will display in the landing page ...";
?>

<!DOCTYPE html>
<html lang="en">

<?php include '_head.php'; ?>
<link rel="stylesheet" href="../../vendors/dropify/dropify.min.css">

<body>
    <div class="container-scroller">
        
        <?php include '_navbar.php'; ?>
        
        <div class="container-fluid page-body-wrapper">

        <?php include '_sidebar.php'; ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <?php include '_breads.php'; ?>
                  
                        <div class="col-md-12 transparent">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="mb-4"><i class="ti-image"></i> Current Image</h3>

                                                    <div class="text-center">
                                                        <img class="img-fluid" src="../../uploads/<?= $my_event_image ?>" alt="krazyappsph logo">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <form action="event_image_update" enctype="multipart/form-data" method="post" onsubmit="validateUpdateImage(this)">

                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h4 class="card-title d-flex">Update IMG</h4>
                                                                <input type="file" class="dropify" accept="image/png, image/gif, image/jpeg" name="eventImage" required>

                                                                <button type="submit" class="btn btn-primary mt-3" name="submitImage" id="submitImage">Submit Changes</button>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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

    <?php include '_scripts.php'; ?>
    <script src="../../vendors/dropify/dropify.min.js"></script>
    <script src="../../js/dropify.js"></script>
    <?php include '_alerts.php'; ?>

</body>

</html>

