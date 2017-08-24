<?php require 'head.php'; ?>
<?php require 'navigation.php'; ?>

<section class="home-section text-center">
    <div class="heading-about">
        <div class="container">
            <?php
            if (isset($_SESSION['logged_user'])) {
                echo '
            <form action="uploadPhotos.php" method="post" enctype="multipart/form-data">
                <input type="file" name="newphoto"/>
                <select name="album">';
                ?>
                <?php
                $albums = $mysqli->query("select * from albums");
                while ($album = $albums->fetch_assoc()) {
                    ?>
                    <option value=<?php echo $album['albumID'] ?>><?php echo $album['date'] ?></option>
                    <?php
                }
                ?>
                <?php
                echo '
                </select>
                <input type="submit" name="upload"/>
            </form>'
                ?>

                <?php
                if (isset($_POST['upload'])) {

                    //check if a file has been selected
                    if (!empty($_FILES['newphoto'])) {

                        $newPhoto = $_FILES['newphoto'];

                        //sanitize originalName for URL
                        $originalName = $newPhoto['name'];
                        $originalName = filter_var($originalName, FILTER_SANITIZE_STRING);


                        //check that there are no errors
                        if ($newPhoto['error'] == 0) {
                            //upload selected file
                            $tempName = $newPhoto['tmp_name'];
                            move_uploaded_file($tempName, "img/albums/$originalName");
                            $url = "img/albums/$originalName";
                            $aID = $_POST['album'];
                            $note = $_POST['note'];
                            $mysqli->query("INSERT INTO photos VALUES (DEFAULT, '$note', '$url')");

                            $test = $mysqli->query("select * from photos");
                            $tempId = 0;
                            while ($t = $test->fetch_assoc()) {
                                $tempId = $t ["photoID"];
                            }

                            $mysqli->query("INSERT INTO contains VALUES (DEFAULT, '$aID', '$tempId' )");


                            print("Photo successfully uploaded.\n");
                        }
                    } //error
                    else {
                        print("Error: The file could not be uploaded.\n");
                    }
                }
            } else {
                echo '<div> Please log in first. <a href="loginAdmin.php">Log in here</a></div>';
            }
            ?>
        </div>
    </div>
</section>