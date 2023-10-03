<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="<?= BASE_URL ?>/styles/admin_base.css">
    </head>
    <div class="admin-background">
        <div style="padding-left: 45px; padding-right: 45px; padding-top: 10px; padding-bottom: 205px;">
            <div class="switch-mode">
                <input type="radio" name="switch-button" id="albums-button" checked="checked" class="switch-radio">
                <label for="albums-button" class="switch-mode-button">Albums</label>
                <input type="radio" name="switch-button" id="songs-button" class="switch-radio">
                <label for="songs-button" class="switch-mode-button">Songs</label>
            </div>
            <div id="dynamic-content-container">
                <?php include '../app/components/admin/AddAlbumPage.php';?>
            </div>
        </div>
        
    </div>
</html>