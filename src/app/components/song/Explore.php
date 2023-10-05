<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/global.css">
    <!-- Page CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/song/explore.css">
    <link rel="icon" type="image" sizes="64x64" href="<?= BASE_URL ?>/assets/images/logo.svg">
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/player.css">
    <!-- Icon Lib -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Explore</title>
</head>

<aside>
    <?php include(dirname(__DIR__) . '/template/Sidebar.php') ?>
</aside>
<div class="explorepage-container">
    <div class="search-container">
        <input class="search-bar" type="text" placeholder="Search songs and albums...">
        <div class="filter-genre-container">
            <h4>Genre: </h4>
            <select class="filter-genre-list" name="filter-genre-list[]">
                <option value="filter-genre-classic">Classic</option>
                <option value="filter-genre-jazz">Jazz</option>
                <option value="filter-genre-pop">Pop</option>
                <option value="filter-genre-rock">Rock</option>
            </select>
        </div>
        <div class="filter-artist-container">
            <h4>Artist: </h4>
            <select class="filter-artist-list" name="filter-artist-list[]">
                <option value="filter-artist-1">Dummy Artist 1</option>
                <option value="filter-artist-2">Dummy Artist 2</option>
                <option value="filter-artist-3">Dummy Artist 3</option>
                <option value="filter-artist-4">Dummy Artist 4</option>
            </select>
        </div>
        <div class="sort-container">
            <h4>Sort: </h4>
            <select class="sort-list" name="sort-list[]">
                <option value="sort-album-asc">Title (A-Z)</option>
                <option value="sort-album-desc">Title (Z-A)</option>
                <option value="sort-album-asc">Release Date (Latest)</option>
                <option value="sort-album-desc">Release Date (Earliest)</option>
            </select>
        </div>
    </div>

    <div class="search-content">
        <div class="search-song-container">
            <div class="search-song-cover">
                <img class="cover-img" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
            </div>
            <h3 class="search-song-title">Song Title</h3>
            <h3 class="search-song-artist">Artist Name</h3>
            <div class="search-song-like">
                <img class="cover-img" src="<?= BASE_URL ?>/assets/images/icon_like_default.svg">
            </div>
        </div>
    </div>
    

</div>
<div>
    <?php include(dirname(__DIR__) . '/template/Player.php') ?>
</div>

</html>
