<?php
#  When anyone contatcts us, it will be sent in 2 ways      
/* 
1)  one stored in DB by inserting the data into contact table
2)  the other is to sent to the email which is a hard process in local host thus we use php mailer 
src; https://phpgurukul.com/how-to-send-email-from-localhost-using-php/
Block 7; https://www.learningaboutelectronics.com/Articles/How-to-create-a-send-email-form-using-PHP-and-MySQL.php

*the page is open to the public tho that's why we protect it from python scripts via recaptcha demo
src; https://www.google.com/recaptcha/api2/demo*/



// require_once "includes/logged.php";
require_once "admin/includes/conn.php";
require_once "admin/includes/helper.php";
//contactform
if ($_SERVER["REQUEST_METHOD"] === "POST"){    # we write it even tho we are on the same page for the seek of the method
    //  dd($_POST[catID])
    try{   //are better use around anything sql-wise
    $sql = "INSERT INTO `contact`(`name`, `email`, `subject`, `message`) VALUES (? ,? ,? ,? );";
    $stmt = $conn->prepare($sql);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $stmt->execute([$name, $email, $subject, $message]);


/*Block 7 -the original 
$from = "example@gmail.com";
$msg= "Dear $first_name $last_name,\n$body";
mail($email, $subject, $msg, 'From:' . $from);
echo 'Email sent to: ' . $email. '<br>';
}
Block 7 */
$msg= "Dear $name,\n$message"; # we wrote it as; $msg= "Dear $name, $email, $subject,\n$message";
mail( $email, $subject, $message); 
echo 'Email sent to: ' . $email. '<br>';


} catch(PDOException $e){
    $erorr = "Connection failed: " . $e->getMessage();
   }
}
  ?>


<!-- either this php mailer or Block 7-->
<!-- <#?php require_once  "./localhost-email/index.php"; ?> -->

<!-- recaptcha demo -->
<!-- <#?php   require_once "/includes/recaptcha.php";    ?> -->



        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Get In Touch</h1>
                    <p>We value communication with our school community and are here to address your questions, concerns, and feedback. Please feel free to reach out to us through any of the following channels: </p>
                </div>
                <div class="row g-4 mb-5">
                    <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                            <i class="fa fa-map-marker-alt fa-2x text-primary"></i>
                        </div>
                        <h6>123st., NYC, USA</h6>
                    </div>
                    <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                            <i class="fa fa-envelope-open fa-2x text-primary"></i>
                        </div>
                        <h6>info@example.com</h6>
                    </div>
                    <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.5s">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                            <i class="fa fa-phone-alt fa-2x text-primary"></i>
                        </div>
                        <h6>+00 353 1 344 1111</h6>
                    </div>
                </div>
                <div class="bg-light rounded">
                    <div class="row g-0">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="h-100 d-flex flex-column justify-content-center p-5">
                                <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>


                                    <form action="" method="POST">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="name" placeholder="Your Name"   name="name">
                                                <label for="name">Your Name</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="email" class="form-control border-0" id="email" placeholder="Your Email"   name="email">
                                                <label for="email">Your Email</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="subject" placeholder="Subject"   name="subject">
                                                <label for="subject">Subject</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control border-0" placeholder="Leave a message here" id="message" style="height: 100px"   name="message"></textarea>
                                                <label for="message">Message</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                                <?php
if (isset($error)) {
    ?>
      <div style="color: #ee0002; padding: 5px;">
        <?php echo $error ?>
      </div>
      <?php
}
?>


                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                            <div class="position-relative h-100">
                                <iframe class="position-relative rounded w-100 h-100"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                                frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false"
                                tabindex="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->