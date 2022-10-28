<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo me-5" href="./"><img src="<?= $nav_logo; ?>" class="me-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="./"><img src="<?= $nav_logo_mini; ?>" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
                <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class="input-group-text" id="search">
                        <?= $my_project_name ?>
                        </span>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <img src="../../images/profile-default.jpg" alt="profile"/>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a href="#" class="dropdown-item">
                        <i class="ti-user text-primary"></i>
                        <?= $tabs_user_fullname ?>
                    </a>
                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#accountSettings">
                        <i class="ti-settings text-primary"></i>
                        Account Settings
                    </a>
                    <a href="logout" class="dropdown-item">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
    </div>
</nav>

    <!-- modal for account settings -->
    <div class="modal fade" id="accountSettings" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><i class="ti-settings"></i> Account Settings</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="account_update" onsubmit="validateUpdateAccount(this)">
                <div class="modal-body">
                    <div class="form-group">
                        <label>AccountName</label>
                        <input type="text" class="form-control" name="tabsName" id="tabsName" value="<?= $tabs_user_fullname ?>" autofocus required onfocus="let value = this.value; this.value = null; this.value=value">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="tabsUsername" id="tabsUsername" value="<?= $tabs_user_email ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="tabsPassword" id="tabsPassword" value="<?= decryptIt($row['tabs_password']) ?>" required>
                    </div>
                    <div class="form-check form-check-primary">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"
                        onclick="showPassword()">
                        Show Password
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit_update_account" class="btn btn-info">Update</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>