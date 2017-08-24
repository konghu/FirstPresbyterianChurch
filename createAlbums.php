<?php require 'head.php';?>
<?php require 'navigation.php';?>

<?php
echo '
<section class="home-section text-center">
    <div class="heading-about">
        <div class="container">';

if(isset($_SESSION['logged_user'])) {

    echo '
        <section class="home-section text-center">
            <div class="heading-about">
                <div class="container">
                    <form action="createAlbums.php" method="post">
                        <input type="text" name="caption" placeholder="Caption">
                        <input type="date" name="date">
                        <p class="info">Caption</p>
                        <input class="submit" name="submit" type="submit" value="Submit">
                    </form>';

    //Check if form was submitted
    if (isset($_POST['submit'])) {
        //Get injection-safe _POST data
        $caption = htmlentities($_POST['caption']);
        $caption = filter_var($caption, FILTER_SANITIZE_STRING);

        $date = htmlentities($_POST['date']);

        $insertAlbums = $mysqli->query("INSERT INTO albums VALUES (DEFAULT , '$caption','$date', '0' )");

        $mysqli->query("update albums set minuteID = albumID ");

        echo '<div> Album successfully added. </div>';
        echo '<div><a href="uploadPhotos.php">Now upload some photos</a></div>';
    }
}

else{
    echo '<div> Please log in first. <a href="loginAdmin.php">Log in here</a></div>';
}

    echo '
        </div>
    </div>
</section>';
?>

