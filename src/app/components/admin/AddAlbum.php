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
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/addAlbum.css">

        <link rel="icon" type="image" sizes="64x64" href="<?= BASE_URL ?>/assets/images/logo.svg">

        <!-- JavaScript Constant and Variables -->
        <script type="text/javascript" defer>
            const DEBOUNCE_DELAY = "<?= DEBOUNCE_DELAY ?>";
            const STORAGE_URL = "<?= STORAGE_URL ?>";
        </script>
        <!-- JavaScript Library -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/debounce.js" defer></script>
        <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/utils.js" defer></script>
        <!-- JavaScript DOM and AJAX -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/admin/addAlbum.js" defer></script>
        <title>Admin</title>
    </head>
    <body>
    <div class="gradient-body">
        <div class="card">
            <header>
                <p class="h4">Add Album</p>
            </header>
            <hr class="horizontal-row"/>
            <form class="register-form">
                <div class="form-group">
                    <label for="album-name">album name</label>
                    <input type="text" name="name" placeholder="album name" id="album-name">
                    <p id="display-name-alert" class="alert-hide">Please fill out your display name first!</p>
                </div>
                <div class="form-group">
                    <label for="upload-date">upload date</label>
                    <input type="date" name="upload_date" id="upload-date">
                    <p id="username-alert" class="alert-hide">Please fill out your username first!</p>
                </div>
                <div class="form-group">
                    <p>album cover</p>
                    <div class="input-file">
                        <input type="file" name="cover_file" id="file-input" class="hidden-input" accept="image/*">
                        <label for="file-input" class="input-button">choose image</label>
                        <span id="file-name" class="file-name">no file selected</span>
                    </div>
                </div>
                <div class="form-button">
                    <p id="register-alert" class="alert-hide">Wrong username/password!</p>
                    <button type="submit" class="button black-button">Upload</button>
                </div>
                <?=
                    TokenMiddleware::getInputToken('add');
                ?>
            </form>
        </div>
    </body>
</html>