<div class="player">
    <div class="song-container">
        <div class="song-cover">
            <img class="cover-img" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
        </div>
        <div class="song-info">
            <h3>Song Title</h3>
            <subtitle-2>Artist Name</subtitle-2>
        </div>
        <div class="song-like">
            <img class="cover-img" src="<?= BASE_URL ?>/assets/images/icon_like_default.svg">
        </div>
    </div>

    <div class="play-container">
        <img class="play-button" src="<?= BASE_URL ?>/assets/images/play-button.svg" alt="play">
        <div class="play-tracker">
            <span class="start">0:00</span>
            <div class="bar">
                <input type="range" id="seek" min="0" max="100">
                <div class="bar2" id="bar2"></div>
                <div class="dot"></div>
            </div>
            <span class="end">3:23</span>
        </div>
    </div>

    <div class="volume-container">

    </div>
</div>