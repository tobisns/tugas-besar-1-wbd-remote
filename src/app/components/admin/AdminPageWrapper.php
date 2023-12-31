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
            const STORAGE_URL = "<?= STORAGE_URL ?>";
            const BASE_URL = '<?= BASE_URL ?>';
        </script>


        <!-- JavaScript Library -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/debounce.js" defer></script>
        <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/utils.js" defer></script>
        <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/play.js" defer></script>
        <script type="text/javascript" defer>
            <?php
            $idMusic = null;
            if(isset($_SESSION["music"]["id"])){
                $idMusic = $_SESSION["music"]["id"];
            }
            ?>
            const id = "<?= $idMusic ?>";
        </script>
        <!-- JavaScript DOM and AJAX -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/admin/wrapper.js" defer></script>
        <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/admin/album.js" defer></script>
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
                            <form action="">
                                <input type="radio" name="switch-button" id="albums-button" class="switch-radio">
                                <label for="albums-button" class="switch-mode-button">Albums</label>
                                <input type="radio" name="switch-button" id="songs-button" checked="checked" class="switch-radio">
                                <label for="songs-button" class="switch-mode-button">Songs</label>
                            </form>
                        <?php else : ?>
                            <form action="">
                                <input type="radio" name="switch-button" id="albums-button" checked="checked" class="switch-radio">
                                <label for="albums-button" class="switch-mode-button">Albums</label>
                                <input type="radio" name="switch-button" id="songs-button" class="switch-radio">
                                <label for="songs-button" class="switch-mode-button">Songs</label>
                            </form>
                        <?php endif; ?>
                    </div>
                    <div id="dynamic-content-container">
                        <?php 
                        if($this->data['content'] == 'songs'){
                            require_once(dirname(__DIR__) . '/admin/Song.php');
                        } else {
                            require_once(dirname(__DIR__) . '/album/Album.php');
                        } 
                        ?>
                    </div>
                    <?=
                        TokenMiddleware::getInputToken('admin');
                    ?>
                </div>
            </div>
        </div>
        
        
    </body>
</html>