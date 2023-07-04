<?php  
    require '../../config/includes.php';
    require 'session.php';

    $title = "Judge ".$tabs_user_fullname;
    $upp_description = 'Welcome to <span class="text-primary">'.getEventTitle($tabs_event_id).'</span>';
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
                                <div class="col-md-3 mb-4 stretch-card transparent">
                                    <div class="card card-dark-blue">
                                        <div class="card-body">
                                        <p class="fs-6 mb-2">Candidates</p>
                                        <p class="fw-bold mb-2">
                                            <span class="fs-3"><?= countCandidatesByEvent($tabs_event_id) ?></span>
                                        </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4 stretch-card transparent">
                                    <div class="card card-light-blue">
                                        <div class="card-body">
                                        <p class="fs-6 mb-2">Categories</p>
                                        <p class="fw-bold mb-2">
                                            <span class="fs-3"><?= countCategories($tabs_event_id) ?></span>
                                        </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row" id="load_categories"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4 class="text-uppercase card-title"><i class="ti-user"></i> our team</h4>
                                                </div>
                                                <div class="col-md-2">
                                                    <img src="../../images/um_logo.png" class="img-fluid" alt="">
                                                    <h5 class="text-center text-uppercase">UM DIGOS COLLEGE</h5>
                                                </div>
                                                <div class="col-md-2">
                                                    <img src="../../images/dtp_logo.png" class="img-fluid" alt="">
                                                    <h5 class="text-center text-uppercase">Department of Technical Programs</h5>
                                                </div>
                                                <div class="col-md-8">
                                                    <p class="mb-4" style="font-size: 17px; text-align: justify;">
                                                        The <span class="text-primary">UM Tabulation Team</span> is a highly skilled group dedicated to leveraging the power of data. Specializing in tabulation, we transform raw information into meaningful insights. With expertise in statistical analysis, data visualization, and database management, we excel at turning complex data into actionable knowledge. Collaborating closely with clients, we tailor our services to meet their specific needs, delivering accurate and timely results. Unlock the potential of your data with the UM Tabulation Team and experience the difference that meticulous analysis and insightful reporting can make.
                                                        <br><br>
                                                        At the core of our work lies a passion for data and a commitment to excellence. We believe that effective data analysis is essential for informed decision-making. By harnessing advanced tools and techniques, we provide valuable reports, charts, and graphs that enable businesses, organizations, and researchers to make data-driven choices. Our team's attention to detail and ability to handle large volumes of information ensure reliable and precise results. Experience the power of data with the UM Tabulation Team and empower your organization with actionable insights.
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

    <?php include '_alerts.php'; ?>

</body>

</html>

