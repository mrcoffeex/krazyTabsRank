<?php 
    include '../../config/includes.php';
    require 'session.php';
    
    $title = "Error Page";
?>

<!DOCTYPE html>
<html lang="en">

<?php include '_head.php'; ?>

<body class="sidebar-dark">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
        <div class="row flex-grow">
          <div class="col-lg-7 mx-auto text-white">
            <div class="row align-items-center d-flex flex-row">
              <div class="col-lg-6 text-lg-right pr-lg-4">
                <h1 class="display-1 mb-0">404</h1>
              </div>
              <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                <h2>SORRY!</h2>
                <h3 class="font-weight-light">Something went wrong.</h3>
                <p><?= $_GET['note'] ?></p>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 text-center mt-xl-2">
                <a class="text-white font-weight-medium" href="javascript:history.go(-1)">Go Back</a>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 mt-xl-2">
                <p class="text-white font-weight-medium text-center"><?= $my_project_name; ?> © <?= date("Y"); ?> Crafted by <span class="text-e4ps-yellow">UM Digos | UM Digos ALUMNI<i class="ti-heart ms-1"></i></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php include '_scripts.php' ?>

  <?php include '_alerts.php' ?>

</body>

</html>
