<song class="in-page-explore">
    <head>
        <link rel="stylesheet" href="<?= BASE_URL ?>/styles/song/song.css">
    </head>
    <body>
        <div class="song-container">
            <?php if (!$this->data['songs']) : ?>
                No songs available yet.
            <?php else : ?>
                <div class="result-song-list">
                    <?php while ($song = pg_fetch_array($this->data['songs'])) : ?>
                        <a href="#">
                            <div class="result-song">
                                <div class="result-song-cover">
                                    <img class="result-cover-img" src="<?= STORAGE_URL ?>/images/<?= $song['cover_file'] ?>">
                                </div>
                                <div class="result-song-title"><?php echo $song['title']?></div>
                                <div class="new-song-artist"><?php echo $song['name']?></div>
                                <div class="result-song-genre"><?php echo $song['genre']?></h3>
                                <div class="result-song-duration"><?php echo $song['duration']?></h3>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>
        </div>
    </body>
</song>