<script type="text/javascript" defer>
    const username = "<?= $_SESSION["username"] ?>";
</script>
<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/delete.css">
<div id="popup" class="display-hidden popup">
    <div class="card">
        <p class="h5 popup-text">
            Are you sure want to delete your account ?
        </p>
        <div class="button-group">
            <button onclick="cancelpopup()" class="popup-button">
                cancel
            </button>
            <button onclick="callaxios()" class="popup-button-text">
                delete
            </button>
        </div>
    </div>
</div>