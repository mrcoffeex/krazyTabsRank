<?php 

    $currentPage = str_replace('.php', '', basename($_SERVER['PHP_SELF']));
    updateUserCurrent($tabs_user_id, $currentPage);

?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="./">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="about">
                <i class="ti-info-alt menu-icon"></i>
                <span class="menu-title">About <span class="text-primary">KrazyApps</span></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="team">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">UM Tabulation Team</span>
            </a>
        </li>
    </ul>
</nav>