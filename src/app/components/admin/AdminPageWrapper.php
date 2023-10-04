<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="<?= BASE_URL ?>/styles/admin/wrapper.css">
        <link rel="icon" type="image" sizes="64x64" href="<?= BASE_URL ?>/assets/images/logo.svg">
        <title>Admin</title>
    </head>
    <body>
        <div class="screen-base">
            <?php include(dirname(__DIR__) . '/template/Sidebar.php');?>
            <div class="admin-background">
                <div style="padding-left: 45px; padding-right: 45px; padding-top: 10px; padding-bottom: 205px;">
                    <div class="switch-mode">
                        <input type="radio" name="switch-button" id="albums-button" checked="checked" class="switch-radio">
                        <label for="albums-button" class="switch-mode-button">Albums</label>
                        <input type="radio" name="switch-button" id="songs-button" class="switch-radio">
                        <label for="songs-button" class="switch-mode-button">Songs</label>
                    </div>
                    <div id="dynamic-content-container">
                        <?php include(dirname(__DIR__) . '/admin/AddAlbumPage.php');?>
                    </div>
                </div>
            </div>
        </div>
        
        
    </body>
</html>