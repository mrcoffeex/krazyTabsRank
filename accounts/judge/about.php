<?php  
    require '../../config/includes.php';
    require 'session.php';

    $title = "About KrazyApps";
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
                                                    <h3 class="mb-4"><i class="ti-info-alt"></i> About Us</h3>

                                                    <div class="text-center">
                                                        <img class="img-fluid" src="../../images/krazyappsph.png" alt="krazyappsph logo">
                                                    </div>
                                                    
                                                    <p class="mb-4" style="font-size: 15px; text-align: justify;">
                                                    We create/provides solutions to companies and individuals in a way of apps/softwares. Since 2017 we created several apps and helped a few companies to improved their transactions when it comes to efficiency and accuracy. Aside from the great performance and flexibility of our services. We offer Krazy affordable rates in the market.
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Former/Current Clients:<br></h5>
                                                    <ul>
                                                        <li>Sunga Hospital (<span class="text-primary">Laboratory Results Information System</span>)</li>
                                                        <li>SchedSave.com (<span class="text-primary">Norway based</span>)</li>
                                                        <li>Goncar Security Academy (<span class="text-primary">Panabo/Tagum</span>)</li>
                                                        <li>Little Ambassador Learning Center</li>
                                                        <li>Taghoy Medical Clinic</li>
                                                        <li>RMB Rymars (<span class="text-primary">Davao</span>)</li>
                                                        <li>ASCU Hardware</li>
                                                        <li>HGS Hardware (<span class="text-primary">other 3 branches</span>)</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Solutions that we offer:<br></h5>
                                                    <ul>
                                                        <li>Automated Tabulation</li>
                                                        <li>Management Systems</li>
                                                        <li>Information Systems</li>
                                                        <li>Inventory Systems</li>
                                                        <li>Online Customized Apps</li>
                                                    </ul>
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

