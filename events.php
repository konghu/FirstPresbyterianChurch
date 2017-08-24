<?php include 'head.php' ?>
<?php include 'navigation.php' ?>
<!-- Section: events -->


<section id="event" class="home-section text-center bg-gray">

    <div class="heading-event">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="wow rotateIn" data-wow-delay="0.4s">
                        <div class="section-heading">
                            <h2>Our Events</h2>
                            <i class="fa fa-2x fa-angle-down"></i>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row wow" data-wow-delay="1.5s">
            <?php
            //Display all albums
            $albums = $mysqli->query('SELECT * FROM albums');

            while ($album = $albums->fetch_assoc()) {
                $albumID = $album['albumID'];
                $caption = $album['caption'];
                $date = $album['date'];
                $minuteID = $album['minuteID'];

                $photos = $mysqli->query("select * from contains where albumID = '" . $albumID . "' ");
                $photo = $photos->fetch_assoc();
                $photoID = $photo['photoID'];
                $viewPhotos = $mysqli->query("select * from photos where photoID = '" . $photoID . "' ");
                $viewPhoto = $viewPhotos->fetch_assoc();
                ?>

                <div class="col-xs-6 col-md-6 albums-gallery">
                    <div>
                        <p><?php echo $caption ?></p>

                        <a href="viewphotos.php?aid=<?php echo $albumID; ?>">
                            <img class="img-thumbnail img-responsive albums-album" src="<?php echo $viewPhoto['url'] ?>">
                        </a>

                        <div class="event-desc">
                            <h5><?php echo $date ?></h5>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>

        </div>
    </div>

    <?php
    if (isset($_GET['aid'])) {
        $photos = $mysqli->query("select * from contains where albumID = '" . $_GET['aid'] . "' ");
        while ($photo = $photos->fetch_assoc()) {
            $photoID = $photo['photoID'];
            $viewPhotos = $mysqli->query("select * from photos where photoID = '" . $photoID . "' ");
            $viewPhoto = $viewPhotos->fetch_assoc();
            ?>
            <div class="col-md-4 ">
                <img class="photos" src="<?php echo $viewPhoto['url'] ?>">
            </div>
            <?php
        }
    }

    ?>
</section>
<!-- /Section: events -->