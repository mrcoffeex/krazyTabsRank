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
                                                    The <span class="text-primary">UM Tabulation Team</span> is a highly skilled group dedicated to leveraging the power of data. Specializing in tabulation, we transform raw information into meaningful insights. With expertise in statistical analysis, data visualization, and database management, we excel at turning complex data into actionable knowledge. Collaborating closely with clients, we tailor our services to meet their specific needs, delivering accurate and timely results. Unlock the potential of your data with the UM Tabulation Team and experience the difference that meticulous analysis and insightful reporting can make.
                                                    <br><br>
                                                    At the core of our work lies a passion for data and a commitment to excellence. We believe that effective data analysis is essential for informed decision-making. By harnessing advanced tools and techniques, we provide valuable reports, charts, and graphs that enable businesses, organizations, and researchers to make data-driven choices. Our team's attention to detail and ability to handle large volumes of information ensure reliable and precise results. Experience the power of data with the UM Tabulation Team and empower your organization with actionable insights.
                                                    </p>
                                                </div>
                                                <div class="col-md-12">
                                                    <p style="font-weight: bold;">
                                                        Email:&nbsp;
                                                        <span class="text-primary">jmdelima@umindanao.edu.ph</span>&nbsp;
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

