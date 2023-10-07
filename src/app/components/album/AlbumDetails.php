<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/global.css">
    <!-- Page CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/admin/albumDetails.css">
    <link rel="icon" type="image" sizes="64x64" href="<?= BASE_URL ?>/assets/images/logo.svg">
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/player.css">
    <!-- Icon Lib -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Explore</title>
</head>
<body>
    <aside>
        <?php include(dirname(__DIR__) . '/template/Sidebar.php') ?>
    </aside>
    <div class="explorepage-container">
        <div class="top-div">
            <div class="album-cover">
                <?php if($this->data['album']['cover_file'] == null) :?>
                <img src="<?= STORAGE_URL ?>/images/no_image.png" alt="no image!" class="cover-img">
                <? else : ?>
                <img src="<?= STORAGE_URL ?>/images/<?= $this->data['album']['cover_file'] ?>" alt="<?= $this->data['album']['name'] ?> " class="cover-img">
                <?php endif; ?>
            </div>
            <div class="album-text">
                <?php echo $this->data['album']['name'] ?>
            </div>
        </div>
        <div class="search-container">
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
            <?php if(!$this->data['musics']) : ?>
                No songs available yet.
            <?php else : ?>
                <?php while($music = pg_fetch_assoc($this->data['musics'])) : ?>
                    <a href="">
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
                    </a>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        

    </div>
</body>

<div>
    <?php include(dirname(__DIR__) . '/template/Player.php') ?>
</div>

</html>
