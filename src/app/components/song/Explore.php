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
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/song/explore.css">
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
    <!-- <div class="tab">
        <button class="tab-album">Album</button>
        <button class="tab-song">Song</button>
    </div> -->
    <div class="search-container">
        <form action="<?= BASE_URL ?>/song/search" METHOD="GET" class="search-form">
            <input class="search-bar" type="text" id="search" name="keyword" placeholder="Search songs and albums...">
            <div class="filter-type-container">
                <h4>Type: </h4>
                <select class="filter-type-list" name="filtertype" id="filtertype">
                    <option value="albums" <?php if (isset($_GET['filtertype']) && $_GET['filtertype'] == 'albums') : ?> selected="selected" <?php endif; ?>>Albums</option>
                    <option value="songs" <?php if (isset($_GET['filtertype']) && $_GET['filtertype'] == 'songs') : ?> selected="selected" <?php endif; ?>>Songs</option>
                </select>
            </div>
            <div class="filter-genre-container">
                <h4>Genre: </h4>
                <select class="filter-genre-list" name="filtergenre" id="filtergenre">
                    <option value="all">All genre</option>

                    <?php while ($genres = pg_fetch_array($this->data['genres'])) : ?>
                        <option value="<?= $genres['genre'] ?>">
                            <?php echo $genres['genre']?>
                        </option>
                    <?php endwhile; ?>

                </select>
            </div>
            <div class="sort-container">
                <h4>Sort: </h4>
                <select class="sort-list" name="sort" id="sort">
                    <option value="title asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'title asc') : ?> selected="selected" <?php endif; ?>>Title (A-Z)</option>
                    <option value="title desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'title desc') : ?> selected="selected" <?php endif; ?>>Title (Z-A)</option>
                    <option value="upload_date asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'upload_dateasc') : ?> selected="selected" <?php endif; ?>>Release Date (Latest)</option>
                    <option value="upload_date desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'upload_date desc') : ?> selected="selected" <?php endif; ?>>Release Date (Earliest)</option>
                </select>
            </div>
            <div class="search-button-container">
                <button type="submit" class="search-button">Search</button>
            </div>
        </form>
    </div>

    <div class="result-container">
        <?php 
            if($this->data['filtertype'] == 'songs'){
                require_once(dirname(__DIR__) . '/song/Song.php');
            } else {
                require_once(dirname(__DIR__) . '/album/Album.php');
            } 
        ?>

        
    </div>

</div>
<div>
    <?php include(dirname(__DIR__) . '/template/Player.php') ?>
</div>

<script src="<?= BASE_URL ?>/javascripts/song/explore.js"></script>

</html>
