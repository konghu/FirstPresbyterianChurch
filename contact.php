<?php include 'head.php' ?>
<?php include 'navigation.php' ?>

<!-- Section: contact -->
<section id="contact" class="home-section text-center">
    <div class="heading-contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="wow bounceInDown" data-wow-delay="0.4s">
                        <div class="section-heading">
                            <h2>Get in touch</h2>
                            <i class="fa fa-2x fa-angle-down"></i>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="wow fadeInRight" data-wow-delay="0.2s">
            <div class="row">
                <div class="col-lg-8">
                    <div class="boxed-grey fadeInLeft" data-wow-delay="0.2s">

                        <div id="sendmessage">Your message has been sent. Thank you!</div>
                        <div id="errormessage"></div>
                        <form id="contact-form" action=""<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"" method="post" role="form" class="contactForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">
                                            Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                        <div class="validation"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">
                                            Email Address</label>
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">
                                            Subject</label>
                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                        <div class="validation"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">
                                            Message</label>
                                        <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                        <div class="validation"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-skin pull-right" id="btnContactUs">
                                        Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="widget-contact">
                        <h5>Address</h5>

                        <address>
                            <strong>42 East Main St.</strong><br>
                            <strong>Waterloo, NY 13165</strong><br>
                            <br>
                            <abbr title="Phone">P:</abbr> 315-539-3535
                        </address>

                        <address>
                            <strong>Email</strong><br>
                            <a href="mailto:#">sarahwest4@me.com</a>
                        </address>
                        <address>
                            <strong>We're on social network</strong><br>
                            <ul class="company-social">
                                <li class="social-facebook"><a href="https://www.facebook.com/FirstPresbyterianChurchOfWaterloo/ " target="_blank"><i class="fa fa-facebook"></i></a></li>
                            </ul>
                        </address>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Section: contact -->

    <!-- PHP Conditionals -->
<?php
if ((!empty($_POST["email"]))&&(!empty($_POST["message"]))&&(!empty($_POST["name"]))&&(!empty($_POST["subject"]))){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $subj=$_POST['subject'];
    $message=$_POST['message'];

    echo'
    <div class="container">
        <div class="wow bounceInDown" data-wow-delay="0.2s">
            <div class="row">
                <div class="col-lg-8">
                    <p>Your Submission:</p>';

    //mail function
    $to='sarahwest4@me.com';
    $messageDisplayed= "Name: ".$name."<br>"."Subject:"."$subj"."<br>"."Email Address: ".$email."<br>"."Message: ".$message;
    $message= "Name: ".$name."\n\n"."Email: ".$email."\n\n"."Message: ".$message;
    echo $messageDisplayed;
    mail($to, $subj, $message);
    echo"<h3>Thanks for your inquiry</h3>";
}
    echo'
                </div>
            </div>
        </div>
    </div>'

?>