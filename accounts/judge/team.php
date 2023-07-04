<?php  
    require '../../config/includes.php';
    require 'session.php';

    $title = "UM Tabulation Team";
    $upp_description = "Good. Better. Krazy!";
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
                  
                        <div class="col-md-12 transparent">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="mb-4"><i class="ti-info-alt"></i> Our Team</h3>

                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <img src="../../images/um_logo.png" class="img-fluid" alt="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <img src="../../images/dtp_logo.png" class="img-fluid" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <p class="mb-4" style="font-size: 15px; text-align: justify;">
                                                    We create/provides solutions to companies and individuals in a way of apps/softwares. Since 2017 we created several apps and helped a few companies to improved their transactions when it comes to efficiency and accuracy. Aside from the great performance and flexibility of our services. We offer Krazy affordable rates in the market.
                                                    </p>
                                                </div>
                                                <div class="col-md-12">
                                                    <p style="font-weight: bold;">
                                                        Email:&nbsp;
                                                        <span class="text-primary">krazyappsph@gmail.com</span>&nbsp;
                                                        Cel #:&nbsp;
                                                        <span class="text-primary">0912 161 0673</span>&nbsp;
                                                    </p>
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

</body>

</html>

