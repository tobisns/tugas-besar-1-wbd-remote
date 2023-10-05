<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/sidebar.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>/styles/admin/wrapper.css">

        <link rel="icon" type="image" sizes="64x64" href="<?= BASE_URL ?>/assets/images/logo.svg">

        <!-- JavaScript Constant and Variables -->
        <script type="text/javascript" defer>
            const DEBOUNCE_DELAY = "<?= DEBOUNCE_DELAY ?>";
        </script>
        <!-- JavaScript Library -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/debounce.js" defer></script>
        <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/utils.js" defer></script>
        <!-- JavaScript DOM and AJAX -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/admin/admin_wrapper.js" defer></script>
        <title>Admin</title>
    </head>
    <body>
        <div class="screen-base">
            <?php include(dirname(__DIR__) . '/template/Sidebar.php');?>
            <div class="admin-background">
                <div style="padding-left: 45px; padding-right: 45px; padding-top: 10px; padding-bottom: 205px;">
                    <div class="switch-mode">
                        <?php 
                        if($this->data['content'] == 'songs') : ?>
                            <input type="radio" name="switch-button" id="albums-button" class="switch-radio">
                            <label for="albums-button" class="switch-mode-button">Albums</label>
                            <input type="radio" name="switch-button" id="songs-button" checked="checked" class="switch-radio">
                            <label for="songs-button" class="switch-mode-button">Songs</label>
                        <?php else : ?>
                            <input type="radio" name="switch-button" id="albums-button" checked="checked" class="switch-radio">
                            <label for="albums-button" class="switch-mode-button">Albums</label>
                            <input type="radio" name="switch-button" id="songs-button" class="switch-radio">
                            <label for="songs-button" class="switch-mode-button">Songs</label>
                        <? endif; ?>
                    </div>
                    <div id="dynamic-content-container">
                        <?php 
                        if($this->data['content'] == 'songs'){
                            require_once(dirname(__DIR__) . '/admin/AddSongPage.php');
                        } else {
                            require_once(dirname(__DIR__) . '/admin/AddAlbumPage.php');
                        } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        
    </body>
</html>