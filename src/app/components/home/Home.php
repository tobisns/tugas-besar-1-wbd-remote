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
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/home/home.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/template/sidebar.css">
    <!-- Utils JS -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/lib/utils.js" defer></script>
    <!-- Home JS -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/home/home.js" defer></script>

    <title>Home</title>
</head>

<aside>
    <?php include(dirname(__DIR__) . '/template/Sidebar.php') ?>
</aside>
<div class="homepage-container">
    <h1>Hello!</h1>
    <h2>New Album Release</h2>
    <div class="new-album-list">
        <?php while ($album = pg_fetch_array($this->data['albums'])) : ?>
            <a href="#">
                <div class="new-album">
                    <img class="new-album-cover" src="<?= STORAGE_URL ?>/images/<?= $album['cover_file'] ?>">
                    <div class="new-album-title"><?php echo $album['name']?></div>
                    <!-- <div class="new-album-artist">${value.artist}</div> -->
                </div>
            </a>
        <?php endwhile; ?>
    </div>
    <h2>New Song Release</h2>
    <div class="new-song-container">
        <?php for ($i = 0; $i < 6; $i++) { ?>
            <div class="new-song" onclick="play(<?=$i?>)">
                <img class="new-song-cover"  src="<?= BASE_URL ?>/assets/images/default-profpic.jpg">
                <h3 class="new-song-title">Song Title</h3>
                <subtitle-2 class="new-song-artist">Artist Name</subtitle-2>
            </div>
        <?php }?>
    </div>
</div>
<div>
    <?php include(dirname(__DIR__) . '/template/Player.php') ?>
</div>

<!-- <script src="<?= BASE_URL ?>/javascripts/home/home.js"></script> -->

</html>
