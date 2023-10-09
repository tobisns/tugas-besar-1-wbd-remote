<song class="in-page-admin">
<head>
    <!-- Page CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/admin/song.css">
</head>
<body>
        <div class="top-util-div">
            <div class="search-ico">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.0938 17.0938L22.7188 22.7188" stroke="#FEFEFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.0625 18.9688C14.9813 18.9688 18.9688 14.9813 18.9688 10.0625C18.9688 5.14371 14.9813 1.15625 10.0625 1.15625C5.14371 1.15625 1.15625 5.14371 1.15625 10.0625C1.15625 14.9813 5.14371 18.9688 10.0625 18.9688Z" stroke="#FEFEFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <form action="<?= BASE_URL ?>/admin/songs" class="search-form">
                <input type="text" name="search" class="search-bar">
                <select class="sort-list" name="sort" id="sort">
                    <option value="title asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'title asc') : ?> selected="selected" <?php endif; ?>>Title (A-Z)</option>
                    <option value="title desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'title desc') : ?> selected="selected" <?php endif; ?>>Title (Z-A)</option>
                    <option value="upload_date asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'upload_date asc') : ?> selected="selected" <?php endif; ?>>Release Date (Latest)</option>
                    <option value="upload_date desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'upload_date desc') : ?> selected="selected" <?php endif; ?>>Release Date (Earliest)</option>
                </select>
                <select class="filter-genre-list" name="filtergenre" id="filtergenre">
                    <option value="all">All genre</option>
                    
                    <?php while ($genres = pg_fetch_array($this->data['genres'])) : ?>
                        <option value="<?= $genres['genre'] ?>">
                            <?php echo $genres['genre']?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </form>
            <?php if($this->data['from_admin']) : ?>
            <button class="add-button" id="add-song">
                <div class="add-ico">
                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 8.51741H8V13.8408C8 14.4264 7.55 14.9055 7 14.9055C6.45 14.9055 6 14.4264 6 13.8408V8.51741H1C0.45 8.51741 0 8.03831 0 7.45274C0 6.86716 0.45 6.38806 1 6.38806H6V1.06468C6 0.479105 6.45 0 7 0C7.55 0 8 0.479105 8 1.06468V6.38806H13C13.55 6.38806 14 6.86716 14 7.45274C14 8.03831 13.55 8.51741 13 8.51741Z" fill="#31463E"/>
                    </svg>
                </div>
                Song
            </button>
            <?php endif; ?>
        </div>

        <div class="search-content">
            <?php if(!$this->data['musics']) : ?>
                No songs available yet.
            <?php else : ?>
                <?php while($music = pg_fetch_assoc($this->data['musics'])) : ?>
                    <div class="search-song-container">
                        <div class="search-song-cover">
                            <img class="cover-img" src="<?= STORAGE_URL ?>/images/<?= $music['cover_file'] ?>">
                        </div>
                        <h3 onclick="play(<?=$music['music_id']?>)" class="search-song-title"><?php echo $music['title'] ?></h3>
                        <h3 class="search-song-artist"><?php echo $music['name'] ?></h3>
                        <h3 class="search-song-duration"><?php echo $music['duration'] ?></h3>
                        <button class="edit-music" music_id="<?= $music['music_id'] ?>">edit</button>
                        <button class="delete-music" music_id="<?= $music['music_id'] ?>">delete</button>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    
    <div>
        <?php include(dirname(__DIR__) . '/template/Player.php') ?>
    </div>
</body>



</song>