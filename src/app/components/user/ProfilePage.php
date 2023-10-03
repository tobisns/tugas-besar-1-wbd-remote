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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/profile.css">

    <title>Register</title>
</head>

<body>
<div class="green-body">
    <!-- Navbar -->
    <?php include(dirname(__DIR__) . '/template/Aside.php') ?>
    <div class="wrapper">
        <div class="profile-container">
            <div class="circular-pict">
                <img src="<?= BASE_URL ?>/assets/images/default-profpic.jpg" />
            </div>
            <div class="profile-bio">
                <p class="h3">
                    <?= $this->data['display-name'] ?>
                </p>
                <div class="inside">
                    <p>
                        <?= $this->data['username'] ?>
                    </p>
                    <img src="<?= BASE_URL ?>/assets/images/bullet.svg" />
                    <p>
                        <?= $this->data['phone-number'] ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="profile-edit">
            <header>
                <p class="h4 header">
                    Edit Profile
                </p>
            </header>
            <form class="edit-form">
                <div class="form-group">
                    <label for="display-name">New display name</label>
                    <input type="text" name="display-name" placeholder="display name" id="display-name">
                </div>
                <div class="form-group">
                    <label for="username">New username</label>
                    <input type="text" name="username" placeholder="username" id="username">
                </div>
                <div class="form-group">
                    <label for="phone-number">New phone number</label>
                    <input type="text" name="phone-number" placeholder="phone number" id="phone-number">
                </div>
                <div class="form-group">
                    <div class="form-group password">
                        <label for="password">New password</label>
                        <input type="text" name="password" placeholder="password" id="password">
                    </div>
                    <div class="form-group password">
                        <label for="confirm-password">confirm password</label>
                        <input type="text" name="confirm-password" placeholder="confirm password" id="confirm-password">
                        <p id="confirm-password-alert" class="alert-hide">Please fill out your confirm password first!</p>
                    </div>
                </div>
                <div class="form-group">
                    <p>New profile picture</p>
                    <div class="input-file">
                        <input type="file" id="file-input" class="hidden-input">
                        <label for="file-input" class="input-button">choose image</label>
                        <span id="file-name" class="file-name">no file selected</span>
                    </div>
                </div>
                <div class="form-button">
                    <button type="submit" class="button cancel-button">Cancel</button>
                    <button type="submit" class="button">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>