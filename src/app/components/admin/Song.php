<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/global.css">
    <!-- Page CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/admin/song.css">
    <link rel="icon" type="image" sizes="64x64" href="<?= BASE_URL ?>/assets/images/logo.svg">
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
    <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/admin/song.js" defer></script>
    <title>Explore</title>
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
            <form action="<?= BASE_URL ?>/admin/albums/1" class="search-form">
                <input type="text" name="search" class="search-bar">
            </form>
            <button class="add-button" id="add-song">
                <div class="add-ico">
                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 8.51741H8V13.8408C8 14.4264 7.55 14.9055 7 14.9055C6.45 14.9055 6 14.4264 6 13.8408V8.51741H1C0.45 8.51741 0 8.03831 0 7.45274C0 6.86716 0.45 6.38806 1 6.38806H6V1.06468C6 0.479105 6.45 0 7 0C7.55 0 8 0.479105 8 1.06468V6.38806H13C13.55 6.38806 14 6.86716 14 7.45274C14 8.03831 13.55 8.51741 13 8.51741Z" fill="#31463E"/>
                    </svg>
                </div>
                Song
            </button>
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
                        <h3 class="search-song-title"><?php echo $music['title'] ?></h3>
                        <h3 class="search-song-artist"><?php echo $music['name'] ?></h3>
                        <div class="search-song-like">
                            <img class="cover-img" src="<?= BASE_URL ?>/assets/images/icon_like_default.svg">
                        </div>
                        <button class="edit-music" music_id="<?= $music['music_id'] ?>">edit</button>
                        <button class="delete-music" music_id="<?= $music['music_id'] ?>">delete</button>
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