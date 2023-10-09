<script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/play.js" defer></script>
<!-- JavaScript Constant and Variables -->
<script type="text/javascript" defer>
    <?php
        $idMusic = null;
        if(isset($_SESSION["music"]["id"])){
            $idMusic = $_SESSION["music"]["id"];
        }
    ?>
    const id = "<?= $idMusic ?>";
</script>
<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/player.css">
<div class="player">
    <div class="song-container">
        <div class="song-cover">
            <img class="cover-img" src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
        </div>
        <div class="song-info">
            <h3 class="title">Song Title</h3>
            <p class="artist">Artist Name</p>
        </div>
    </div>

    <div class="play-container">
        <div class="controls">
            <img onclick="playpause()" id="play-button" class="fa-pause" src="<?= BASE_URL ?>/assets/images/play-button.svg" alt="play">
        </div>
        <div class="song-line">
            <p class="progress-value">00:00</p>
            <input type="range" id="seek" min="0" max="100">
            <p class="max-value">00:00</p>
        </div>

        <audio controls id="song">
            <source src="" type="audio/mpeg">
        </audio>
    </div>

    <div class="volume-container">
        <img id="speaker" src="<?= BASE_URL ?>/assets/images/speaker.svg" alt="play">
        <input type="range" id="volume" min="0" max="100">
    </div>
</div>