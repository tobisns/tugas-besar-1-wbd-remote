<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/global.css">
    <!-- Page CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/user/login.css">
    <link rel="icon" type="image" sizes="64x64" href="<?= BASE_URL ?>/assets/images/logo.svg">
    <title>Log In</title>
</head>

<body>
    <div class="login-container">
        <form action="" method="post">
            <h1>Login</h1>
            <hr>
            <div class="username">
                <subtitle-1>Username</subtitle-1>
                <input type="text" required>
            </div>
            <div class="password">
                <subtitle-1>Password</subtitle-1>
                <input type="password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
            <div class="signup_link">
                <p>don't have an account yet? <a href="#">sign up</a></p>
            </div>
        </form>
    </div>
</body>

</html>
