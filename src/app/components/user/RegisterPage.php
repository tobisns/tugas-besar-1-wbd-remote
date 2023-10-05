<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/globals.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
    <!-- Specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/register.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const DEBOUNCE_DELAY = "<?= DEBOUNCE_DELAY ?>";
    </script>
    <!-- JavaScript Library -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/debounce.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/utils.js" defer></script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/user/register.js" defer></script>
    <title>Register</title>
</head>

<body>
<div class="black-body">
    <!-- Navbar -->
    <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
    <div class="gradient-body">
        <div class="card">
            <header>
                <p class="h4">Sign Up</p>
            </header>
            <hr class="horizontal-row"/>
            <form class="register-form">
                <div class="form-group">
                    <label for="display-name">display name</label>
                    <input type="text" name="display-name" placeholder="display name" id="display-name">
                    <p id="display-name-alert" class="alert-hide">Please fill out your display name first!</p>
                </div>
                <div class="form-group">
                    <label for="username">username</label>
                    <input type="text" name="username" placeholder="username" id="username">
                    <p id="username-alert" class="alert-hide">Please fill out your username first!</p>
                </div>
                <div class="form-group">
                    <label for="phone-number">phone number</label>
                    <input type="text" name="phone-number" placeholder="phone number" id="phone-number">
                    <p id="phone-number-alert" class="alert-hide">Please fill out your phone number first!</p>
                </div>
                <div class="form-group">
                    <div class="form-group password">
                        <label for="password">password</label>
                        <input type="password" name="password" placeholder="password" id="password">
                        <p id="password-alert" class="alert-hide">Please fill out your password first!</p>
                    </div>
                    <div class="form-group password">
                        <label for="confirm-password">confirm password</label>
                        <input type="password" name="confirm-password" placeholder="confirm password" id="confirm-password">
                        <p id="confirm-password-alert" class="alert-hide">Please fill out your confirm password first!</p>
                    </div>
                </div>
                <div class="form-group">
                    <p>profile picture</p>
                    <div class="input-file">
                        <input type="file" name="cover" id="file-input" class="hidden-input" accept="image/*">
                        <label for="file-input" class="input-button">choose image</label>
                        <span id="file-name" class="file-name">no file selected</span>
                    </div>
                </div>
                <div class="form-button">
                    <p id="register-alert" class="alert-hide">Wrong username/password!</p>
                    <button type="submit" class="button black-button">Sign up</button>
                </div>
                <?=
                    TokenMiddleware::getInputToken('register');
                ?>
            </form>
        </div>
    </div>
</div>
</body>

</html>