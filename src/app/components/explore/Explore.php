<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico">
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/global.css">
    <!-- Page CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/explore/explore.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/player.css">
    <!-- Icon Lib -->
        <!-- JavaScript Constant and Variables -->
        <script type="text/javascript" defer>
        const DEBOUNCE_DELAY = "<?= DEBOUNCE_DELAY ?>";
        const STORAGE_URL = "<?= STORAGE_URL ?>";
    </script>
    <!-- JavaScript Library -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/debounce.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/utils.js" defer></script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/explore/explore.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/explore/exploreAlbum.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/explore/exploreSong.js" defer></script>
    
    <title>Explore</title>
</head>

<aside>
    <?php include(dirname(__DIR__) . '/template/Sidebar.php') ?>
</aside>
<div class="explorepage-container">
    <div class="switch-mode">
        <?php if($this->data['content'] == 'songs') : ?>
            <form action="">
                <input type="radio" name="switch-button" id="albums-button" class="switch-radio">
                <label for="albums-button" class="switch-mode-button">Albums</label>
                <input type="radio" name="switch-button" id="songs-button" checked="checked" class="switch-radio">
                <label for="songs-button" class="switch-mode-button">Songs</label>
                <?= TokenMiddleware::getInputToken('explore') ?>
            </form>
        <?php else : ?>
            <form action="">
                <input type="radio" name="switch-button" id="albums-button" checked="checked" class="switch-radio">
                <label for="albums-button" class="switch-mode-button">Albums</label>
                <input type="radio" name="switch-button" id="songs-button" class="switch-radio">
                <label for="songs-button" class="switch-mode-button">Songs</label>
                <?= TokenMiddleware::getInputToken('explore') ?>
            </form>
        <? endif; ?>
    </div>    

    <div id="dynamic-content-container">
        <?php 
        if($this->data['content'] == 'songs'){
            require_once(dirname(__DIR__) . '/explore/ExploreSong.php');
        } else {
            require_once(dirname(__DIR__) . '/explore/ExploreAlbum.php');
        } 
        ?>
    </div>

</div>
</html>
