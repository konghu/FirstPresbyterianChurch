<?php require 'head.php'; ?>
<?php require 'navigation.php'; ?>

    <section class="home-section text-center">
        <div class="heading-contact">
            <div class="container">

                <?php
                //check if user logged in
                if (isset($_SESSION['logged_user'])) {
                    echo '<div class="notice">You\'re now logged in, ' . $_SESSION['logged_user'] . '.';
                    echo '<a href="logoutAdmin.php"> Log Out</a>';
                } //not logged in
                else {
                    //show login form
                    echo '<div class="login">
                    <form action="loginAdmin.php" method="post">
                        Username
                        <input class="username" type="text" name="username" placeholder="Username">
                        Password
                        <input class="password" type="password" name="password" placeholder="Password">
                        <input class="submit" type="submit" value="Submit">
                    </form>
                </div>';

                    //error
                    if (empty($_POST['username']) || empty($_POST['password'])) {
                        echo '<div class="notice">Please enter a valid username and password.</div>';
                    } //no error
                    else {
                        //filter input and hash password
                        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
                        $hashed_password = hash("sha256", $password);

                        //lookup in database
                        $query = "SELECT * FROM users WHERE username = '$username'";
                        $result = $mysqli->query($query);

                        //user is in the database
                        if ($result && $result->num_rows == 1) {
                            $_SESSION['logged_user'] = $username;

                            echo '<script language="javascript">';
                            echo "window.location.href='loginAdmin.php';";
                            echo '</script>';
                        } //not in database
                        else {
                            echo '<div class="notice">We couldn\'t find that username and password.</div>';
                        }
                    }
                }

                ?>
            </div>
        </div>
    </section>

<?php
//database admin functionalities
if (isset($_SESSION['logged_user'])) {
    echo '<div>
            <a href="createAlbums.php"> Create an Album </a>
            </div>
            <div>
            <a href="uploadPhotos.php">Upload some Photos</a>
</div>';
}
?>