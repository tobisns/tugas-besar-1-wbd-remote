<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/sidebar.css">
<div class="sidebar">
    <div class="head-logo">
        <img class="logo-icon" src="<?= BASE_URL ?>/assets/images/logo.svg" alt="muse logo">
    </div>

    <ul class="menu-page">
        <li class="home-bar">
            <a href="<?= BASE_URL ?>/home">
                <div class="home-container">
                    <img class="home-icon" src="<?= BASE_URL ?>/assets/images/icon_home_default.svg" alt="home">
                    <span class="home-text">Home</span>
                </div>
            </a>
        </li>
        <li class="explore-bar">
            <a href="#">
                <div class="explore-container">
                    <img class="explore-icon" src="<?= BASE_URL ?>/assets/images/icon_explore_default.svg" alt="explore">
                    <span class="explore-text">Explore</span>
                </div>
            </a>
        </li>
    </ul>
    <ul class="menu-user">
        <li class="profile-bar">
            <a href="<?= BASE_URL ?>/user">
                <div class="profile-container">
                    <img class="profile-icon" src="<?= BASE_URL ?>/assets/images/icon_profile_default.svg" alt="profile">
                    <span class="profile-text">Profile</span>
                </div>
            </a>
        </li>
        <li class="like-bar">
            <a href="#">
                <div class="like-container">
                    <img class="like-icon" src="<?= BASE_URL ?>/assets/images/icon_like_default.svg" alt="liked songs">
                    <span class="like-text">Liked Songs</span>
                </div>
            </a>
        </li>
        <li class="admin-bar">
            <a href="#">
                <div class="admin-container">
                    <img class="admin-icon" src="<?= BASE_URL ?>/assets/images/icon_admin_default.svg" alt="admin page">
                    <span class="admin-text">Admin</span>
                </div>
            </a>
        </li>
    </ul>
    <ul class="menu-log">
        <li class="login-bar">
            <a href="#">
                <div class="login-container">
                    <img class="login-icon" src="<?= BASE_URL ?>/assets/images/icon_login_default.svg" alt="login">
                    <span class="login-text">Login</span>
                </div>
            </a>
        </li>
        <li class="logout-bar">
            <form class="form-sidebar" action="<?= BASE_URL ?>/user/logout" method="post">
                <?=
                TokenMiddleware::getInputToken('logout');
                ?>
                <div class="logout-container">
                    <img class="logout-icon" src="<?= BASE_URL ?>/assets/images/icon_logout_default.svg" alt="logout">
                    <button class="logout-text">logout</button>
                </div>
            </form>
        </li>
    </ul>

</div>