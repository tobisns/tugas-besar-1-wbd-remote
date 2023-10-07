<add_album class="in-page-admin">
    <head>
        <link rel="stylesheet" href="<?= BASE_URL ?>/styles/admin/album.css">
    </head>
    <body>
        <div class="album-container">
            <?php if(!$this->data['albums']) : ?>
                No albums available yet.
            <?php else : ?>
                <div class="album-grid">
                    <?php while ($album = pg_fetch_assoc($this->data['albums'])) : ?>
                        <a href="">
                            <div class="album">
                                <div class="album-cover">
                                    <?php if($album['cover_file'] == null) :?>
                                    <img src="<?= STORAGE_URL ?>/images/no_image.png" alt="no image!" class="cover-img">
                                    <? else : ?>
                                    <img src="<?= STORAGE_URL ?>/images/<?= $album['cover_file'] ?>" alt="<?= $album['name'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <label class="title"><?php echo $album['name']?></label>
                                </div>
                                <div>
                                    <label class="artist">Album1</label>
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
</add_album>