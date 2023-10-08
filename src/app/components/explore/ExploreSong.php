<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/global.css">
    <!-- Page CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/explore/exploreSong.css">
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/assets/images/favicon.ico">
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/player.css">
    <!-- Icon Lib -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const DEBOUNCE_DELAY = "<?= DEBOUNCE_DELAY ?>";
        const STORAGE_URL = "<?= STORAGE_URL ?>";
    </script>
    <!-- JavaScript Library -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/debounce.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/utils.js" defer></script>
    <!-- JavaScript DOM and AJAX -->
    <!-- <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/admin/song.js" defer></script> -->
    <title>Explore Song</title>
</head>

<body>
<div class="explorepage-container">
        <div class="top-util-div">
            <div class="search-ico">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.0938 17.0938L22.7188 22.7188" stroke="#FEFEFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.0625 18.9688C14.9813 18.9688 18.9688 14.9813 18.9688 10.0625C18.9688 5.14371 14.9813 1.15625 10.0625 1.15625C5.14371 1.15625 1.15625 5.14371 1.15625 10.0625C1.15625 14.9813 5.14371 18.9688 10.0625 18.9688Z" stroke="#FEFEFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="search-container">
                <form action="<?= BASE_URL ?>/explore/songs/1" METHOD="GET" class="search-form">
                    <input class="search-bar" type="text" id="search" name="search" placeholder="Search...">

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
                            <option value="upload_date asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'upload_date asc') : ?> selected="selected" <?php endif; ?>>Release Date (Latest)</option>
                            <option value="upload_date desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'upload_date desc') : ?> selected="selected" <?php endif; ?>>Release Date (Earliest)</option>
                        </select>
                    </div>
                    <div class="search-button-container">
                        <button type="submit" class="search-button">Search</button>
                    </div>
                </form>
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
                                <img class="cover-img" src="<?= STORAGE_URL ?>/images/<?= $song['cover_file'] ?>">
                            </div>
                            <h3 class="search-song-title"><?php echo $music['title'] ?></h3>
                            <h3 class="search-song-artist"><?php echo $music['name'] ?></h3>
                            <h3 class="search-song-genre"><?php echo $music['genre'] ?></h3>
                            <h3 class="search-song-duration"><?php echo $music['duration'] ?></h3>
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