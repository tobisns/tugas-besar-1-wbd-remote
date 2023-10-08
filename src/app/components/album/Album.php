<album class="in-page-admin">
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
            <form action="<?= BASE_URL ?>/admin/albums/1" class="search-form">
                <input type="text" name="search" class="search-bar">
            </form>
            <?php if($this->data['from_admin']) : ?>
            <button class="add-button">
                <div class="add-ico">
                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 8.51741H8V13.8408C8 14.4264 7.55 14.9055 7 14.9055C6.45 14.9055 6 14.4264 6 13.8408V8.51741H1C0.45 8.51741 0 8.03831 0 7.45274C0 6.86716 0.45 6.38806 1 6.38806H6V1.06468C6 0.479105 6.45 0 7 0C7.55 0 8 0.479105 8 1.06468V6.38806H13C13.55 6.38806 14 6.86716 14 7.45274C14 8.03831 13.55 8.51741 13 8.51741Z" fill="#31463E"/>
                    </svg>
                </div>
                Album
            </button>
            <?php endif; ?>
        </div>
        <div class="album-container">
            <?php if(!$this->data['albums']) : ?>
                No albums available yet.
            <?php else : ?>
                <div class="album-grid">
                    <?php while ($album = pg_fetch_assoc($this->data['albums'])) : ?>
                        <?php if($this->data['from_admin']) : ?>
                            <a href="<?= BASE_URL ?>/album/album_details/<?= $album['album_id'] ?>?admin=true">
                        <?php else : ?>
                            <a href="<?= BASE_URL ?>/album/album_details/<?= $album['album_id'] ?>">
                        <?php endif; ?>
                            <div class="album">
                                <div class="album-cover">
                                    <?php if($album['cover_file'] == null) :?>
                                    <img src="<?= STORAGE_URL ?>/images/no_image.png" alt="no image!" class="cover-img">
                                    <? else : ?>
                                    <img src="<?= STORAGE_URL ?>/images/<?= $album['cover_file'] ?>" alt="<?= $album['name'] ?> " class="cover-img">
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <label class="title"><?php echo $album['name']?></label>
                                </div>
                                <div>
                                    <label class="upload_date"><?php echo $album['upload_date']?></label>
                                </div>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>
                <div class="pagination">
                    <?php if($this->data['current_page'] > 1 ) : ?>
                        <button class="prev-button">
                            <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.875 0.9375L0 7.57875L7.875 14.0625V8.8125H21V6.1875H7.875V0.9375Z" fill="#74B18F"/>
                            </svg>
                            prev
                        </button>
                    <?php endif; ?>
                    <?php if($this->data['total_page'] > 10) : ?>
                        <?php if($this->data['current_page'] <= 5) : ?>
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <button class=pagination-button><?php echo  $i;?></button>
                            <?php endfor; ?>
                        <?php else : ?>
                            <button class=pagination-button>1</button>
                            <button class=pagination-button>2</button>
                            <label>...</label>
                            <button class=pagination-button><?php echo  min($this->data['total_page'] - 4,$this->data['current_page'])-2;?></button>
                            <button class=pagination-button><?php echo  min($this->data['total_page'] - 4,$this->data['current_page'])-1;?></button>
                        <?php endif; ?>
                        <?php if(!($this->data['current_page'] <= 5 || $this->data['current_page'] >= $this->data['total_page'] - 4)) : ?>
                            <button class=pagination-button><?php echo  $this->data['current_page'];?></button>
                        <?php endif; ?>
                        <?php if($this->data['current_page'] >= $this->data['total_page'] - 4) : ?>
                            <?php for ($i = min($this->data['total_page'] - 4,$this->data['current_page']); $i <= $this->data['total_page']; $i++) : ?>
                                <button class=pagination-button><?php echo  $i;?></button>
                            <?php endfor; ?>
                        <?php else : ?>
                                <button class=pagination-button><?php echo  max(5,$this->data['current_page']) + 1;?></button>
                                <button class=pagination-button><?php echo  max(5, $this->data['current_page']) + 2;?></button>
                                <label>...</label>
                                <button class=pagination-button><?php echo  $this->data['total_page']-1;?></button>
                                <button class=pagination-button><?php echo  $this->data['total_page'];?></button>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php for ($i = 1; $i <= $this->data['total_page']; $i++) : ?>
                            <button class=pagination-button><?php echo  $i;?></button>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <?php if($this->data['current_page'] < $this->data['total_page']) : ?>
                        <button class="next-button">
                            next
                            <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.125 0.9375L21 7.57875L13.125 14.0625V8.8125H0V6.1875H13.125V0.9375Z" fill="#74B18F"/>
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </body>
</album>