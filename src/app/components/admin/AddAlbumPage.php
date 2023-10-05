<add_album class="in-page-admin">
    <head>
        <link rel="stylesheet" href="<?= BASE_URL ?>/styles/admin/album.css">
    </head>
    <body>
        <div class="top-util-div">
            <div class="search-ico">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.0938 17.0938L22.7188 22.7188" stroke="#FEFEFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.0625 18.9688C14.9813 18.9688 18.9688 14.9813 18.9688 10.0625C18.9688 5.14371 14.9813 1.15625 10.0625 1.15625C5.14371 1.15625 1.15625 5.14371 1.15625 10.0625C1.15625 14.9813 5.14371 18.9688 10.0625 18.9688Z" stroke="#FEFEFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <form action="" class="search-form">
                <input type="text" name="search" class="search-bar">
            </form>
            <button class="add-button">
                <div class="add-ico">
                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 8.51741H8V13.8408C8 14.4264 7.55 14.9055 7 14.9055C6.45 14.9055 6 14.4264 6 13.8408V8.51741H1C0.45 8.51741 0 8.03831 0 7.45274C0 6.86716 0.45 6.38806 1 6.38806H6V1.06468C6 0.479105 6.45 0 7 0C7.55 0 8 0.479105 8 1.06468V6.38806H13C13.55 6.38806 14 6.86716 14 7.45274C14 8.03831 13.55 8.51741 13 8.51741Z" fill="#31463E"/>
                    </svg>
                </div>
                Album
            </button>
        </div>
        <div class="album-container">
            <div class="album-grid">
                <div class="album">
                    <div class="album-cover"></div>
                    <div>
                        <label class="title">Album1</label>
                    </div>
                    <div>
                        <label class="artist">Album1</label>
                    </div>
                </div>
                <div class="album">
                    <div class="album-cover"></div>
                    <div>
                        <label class="title">Album2</label>
                    </div>
                    <div>
                        <label class="artist">Album1</label>
                    </div>
                </div>
                <div class="album">
                    <div class="album-cover"></div>
                    <div>
                        <label class="title">Album3</label>
                    </div>
                    <div>
                        <label class="artist">Album1</label>
                    </div>
                </div>
                <div class="album">
                    <div class="album-cover"></div>
                    <div>
                        <label class="title">Album4</label>
                    </div>
                    <div>
                        <label class="artist">Album1</label>
                    </div>
                </div>
                <div class="album">
                    <div class="album-cover"></div>
                    <div>
                        <label class="title">Album5</label>
                    </div>
                    <div>
                        <label class="artist">Album1</label>
                    </div>
                </div>
            </div>
            <div class="pagination"></div>
        </div>
    </body>
    
</add_album>
