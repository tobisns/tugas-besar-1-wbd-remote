<album class="in-page-explore">
    <head>
        <!-- Page CSS -->
        <link rel="stylesheet" href="<?= BASE_URL ?>/styles/explore/exploreAlbum.css">
    </head>
    <body>
        <div class="top-util-div">
            <div class="search-container">
                <form action="<?= BASE_URL ?>/explore/albums/1" class="search-form">
                    <input class="search-bar" type="text" id="search" name="search" placeholder="Search...">
    
                    <div class="sort-container">
                        <h4>Sort: </h4>
                        <select class="sort-list" name="sort" id="sort">
                            <option value="name asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'name asc') : ?> selected="selected" <?php endif; ?>>Title (A-Z)</option>
                            <option value="name desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'name desc') : ?> selected="selected" <?php endif; ?>>Title (Z-A)</option>
                            <option value="upload_date asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'upload_date asc') : ?> selected="selected" <?php endif; ?>>Release Date (Latest)</option>
                            <option value="upload_date desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'upload_date desc') : ?> selected="selected" <?php endif; ?>>Release Date (Earliest)</option>
                        </select>
                    </div>
                    <div class="filter-genre-container">
                        <h4>Genre: </h4>
                        <select class="filter-genre-list" name="filtergenre" id="filtergenre">
                            <option value="all">All genre</option>
                            
                            <?php while ($genres = pg_fetch_array($this->data['genres'])) : ?>
                                <option value="<?= $genres['genre'] ?>">
                                    <?php echo $genres['genre']?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </form>
            </div>
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