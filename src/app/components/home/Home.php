<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/global.css">
    <!-- Page CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/home/home.css">
    <link rel="icon" type="image" sizes="64x64" href="<?= BASE_URL ?>/assets/images/logo.svg">
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/player.css">
    <title>Home</title>
</head>

<aside>
    <?php include(dirname(__DIR__) . '/template/Sidebar.php') ?>
</aside>
<div class="homepage-container">
    <h1>Hello!</h1>
    <h2>New Album Release</h2>
    <div class="new-album-container">
        <div class="new-album">
            <img class="new-album-cover" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
            <h3 class="new-album-title">Album Title</h3>
            <subtitle-2 class="new-album-artist">Artist Name</subtitle-2>
        </div>
        <div class="new-album">
            <img class="new-album-cover" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
            <h3 class="new-album-title">Album Title</h3>
            <subtitle-2 class="new-album-artist">Artist Name</subtitle-2>
        </div>
        <div class="new-album">
            <img class="new-album-cover" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
            <h3 class="new-album-title">Album Title</h3>
            <subtitle-2 class="new-album-artist">Artist Name</subtitle-2>
        </div>
        <div class="new-album">
            <img class="new-album-cover" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
            <h3 class="new-album-title">Album Title</h3>
            <subtitle-2 class="new-album-artist">Artist Name</subtitle-2>
        </div>
        <div class="new-album">
            <img class="new-album-cover" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
            <h3 class="new-album-title">Album Title</h3>
            <subtitle-2 class="new-album-artist">Artist Name</subtitle-2>
        </div>
        <div class="new-album">
            <img class="new-album-cover" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
            <h3 class="new-album-title">Album Title</h3>
            <subtitle-2 class="new-album-artist">Artist Name</subtitle-2>
        </div>
    </div>
    <h2>New Song Release</h2>
    <div class="new-song-container">
        <div class="new-song">
            <img class="new-song-cover" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
            <h3 class="new-song-title">Song Title</h3>
            <subtitle-2 class="new-song-artist">Artist Name</subtitle-2>
        </div>
        <div class="new-song">
            <img class="new-song-cover" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
            <h3 class="new-song-title">Song Title</h3>
            <subtitle-2 class="new-song-artist">Artist Name</subtitle-2>
        </div>
        <div class="new-song">
            <img class="new-song-cover" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
            <h3 class="new-song-title">Song Title</h3>
            <subtitle-2 class="new-song-artist">Artist Name</subtitle-2>
        </div>
        <div class="new-song">
            <img class="new-song-cover" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
            <h3 class="new-song-title">Song Title</h3>
            <subtitle-2 class="new-song-artist">Artist Name</subtitle-2>
        </div>
        <div class="new-song">
            <img class="new-song-cover" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
            <h3 class="new-song-title">Song Title</h3>
            <subtitle-2 class="new-song-artist">Artist Name</subtitle-2>
        </div>
        <div class="new-song">
            <img class="new-song-cover" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
            <h3 class="new-song-title">Song Title</h3>
            <subtitle-2 class="new-song-artist">Artist Name</subtitle-2>
        </div>
    </div>
</div>
<div>
    <?php include(dirname(__DIR__) . '/template/Player.php') ?>
</div>

</html>
