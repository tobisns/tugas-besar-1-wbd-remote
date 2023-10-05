<add_song class="in-page-admin">
    <body>
        <h1>MUSIC</h1>
        <?php
            $result = $this->data['songs'];
            if(!$result) {
                echo 'ok';
            } else {
                while ($row = pg_fetch_assoc($result)) {
                    // Access data from the row
                    $id = $row['album_id'];
                    $name = $row['name'];
                    $date = $row['upload_date'];
                
                    // Display the data
                    echo "ID: $id, Name: $name, Date: $date<br>";
                }
            }
        ?>
    </body>
</add_song>