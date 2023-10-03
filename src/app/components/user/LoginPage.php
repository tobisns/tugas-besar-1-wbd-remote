<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/globals.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
    <!-- Specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/login.css">

    <title>Login</title>
</head>

<body>
    <div class="black-body">
        <!-- Navbar -->
        <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
        <div class="gradient-body">
            <div class="card">
                <header>
                    <p class="h4">Log in to Muse</p>
                </header>
                <hr class="horizontal-row"/>
                <form class="login-form">
                    <div class="form-group">
                        <label for="username">Email or username</label>
                        <input type="text" name="username" placeholder="Username" id="username">
                        <p id="username-alert" class="alert-hide">Please fill out your username first!</p>
                    </div>
                    <div class="form-group">
                        <label for="password">Enter your password!</label>
                        <input type="password" name="password" placeholder="Password" id="password" autocomplete="on">
                        <p id="password-alert" class="alert-hide">Please fill out your password first!</p>
                    </div>
                    <div class="form-button">
                        <p id="login-alert" class="alert-hide">Wrong username/password!</p>
                        <button type="submit" class="button black-button">Log in</button>
                    </div>
                </form>
                <div class="form-hyperlink">
                    <p class="button">Don't have an account? <a href="<?= BASE_URL ?>/user/register">Register</a>.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>