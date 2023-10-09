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
        <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/admin/addSongToAlbum.js" defer></script>
        <title>Admin</title>
    </head>
    <body>
    <div class="gradient-body">
        <div class="card">
            <header>
                <p class="h4">Add Song To Album</p>
            </header>
            <hr class="horizontal-row"/>
            <form class="register-form">
                <div class="form-group">
                    <label for="song-title">song title</label>
                    <input type="text" name="song title" id="song-title">
                    <input type="hidden" id="selectedSongId" name="song_id">
                    <p id="username-alert" class="alert-hide">Please fill out your username first!</p>
                    <div id="searchResults"></div>
                </div>
                <div class="form-button">
                    <p id="register-alert" class="alert-hide">Wrong username/password!</p>
                    <button type="submit" class="button black-button" album_id="<?= $this->data['album_id']?>" id="submit">Upload</button>
                </div>
                <?=
                    TokenMiddleware::getInputToken('add');
                ?>
            </form>
        </div>
    </body>
</html>