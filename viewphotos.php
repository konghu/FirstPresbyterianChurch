<?php include 'head.php' ?>
<?php include 'navigation.php' ?>

<!--Get all records from this album-->
<?php
$albums =$mysqli->query("select * from albums where albumID = '".$_GET['aid']."' ");
$album =$albums->fetch_assoc();
$caption= $album['caption'];

$photos =$mysqli->query("select * from contains where albumID = '".$_GET['aid']."' ");
?>
<section id="event" class="home-section text-center bg-gray">

    <div class="heading-event">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="wow bounceInDown" data-wow-delay="0.4s">
                        <div class="section-heading">
                            <h2><?php echo $caption ?></h2>
                            <i class="fa fa-2x fa-angle-down"></i>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <?php
            if (isset($_SESSION['logged_user'])) {
                ?>
                <div class="hiddenContent">
            		<form action="viewphotos.php?aid=<?php echo $_GET['aid']?>" method="post">
                        <input type="submit" name="delete" value="Delete This Album" />
		            </form>
                </div>
            <?php
            }
            ?>

            <?php
            if (isset($_POST['delete'])) {

                //update DB
                $delete = $mysqli->query("DELETE FROM albums WHERE albumID = '".$_GET['aid']."';");

            while ($photo = $photos->fetch_assoc()) {
                $photoID = $photo['photoID'];
                $delete2 = $mysqli->query("DELETE FROM photos WHERE photoID = '".$photoID."' ");

            }


                $delete3 = $mysqli->query("DELETE FROM contains WHERE albumID = '".$_GET['aid']."' ");

                //feedback
                if ($delete && $delete2 && $delete3) {
                    echo '<script language="javascript">';
                    echo "window.location.href='events.php';";
                    echo '</script>';
                } else {
                    echo ('<div class="notice">Error: album could not be deleted. <a href="events.php">Go Back</a></div>');
                }
            }

            ?>


    <div class="container">
        <div class="row wow" data-wow-delay="1.5s">

    <?php
    while ($photo = $photos->fetch_assoc()) {
        $photoID = $photo['photoID'];
        $viewPhotos = $mysqli->query("select * from photos where photoID = '".$photoID."' ");
        $viewPhoto = $viewPhotos->fetch_assoc();
        ?>
            <div class="col-xs-6 col-md-4 albums-photo">
            <img class="img-rounded img-responsive albums-album" src="<?php echo $viewPhoto['url']?>">
            </div>
        <?php
    }

    ?>
        </div>
    </div>
</section>