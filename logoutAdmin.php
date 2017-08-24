<?php require 'head.php';?>
<?php require 'navigation.php';?>

<section class="home-section text-center">
    <div class="heading-contact">
        <div class="container">
<?php
//user is logged in
if (isset($_SESSION['logged_user'])) {

    //log user out
    unset($_SESSION['logged_user']);
    echo '<div class="notice">You have successfully been logged out.</div>
           <div> <a href="index.php"> Home</a> </div>';

}
//user is not logged in
else {
    echo '<div class="notice">No user is currently logged in.<a href="loginAdmin.php"> Log in here.</a></div>';
}
?>
        </div>
    </div>
</section>
