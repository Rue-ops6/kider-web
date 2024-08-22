<?php
#  When anyone contatcts us, it will be sent in 2 ways      
/* 
1)  one stored in DB by inserting the data into contact table
2)  the other is to sent to the email which is a hard process in local host thus we use php mailer 
src; https://phpgurukul.com/how-to-send-email-from-localhost-using-php/
Block 7; https://www.learningaboutelectronics.com/Articles/How-to-create-a-send-email-form-using-PHP-and-MySQL.php

*the page is open to the public tho that's why we protect it from python scripts via recaptcha demo
src; https://www.google.com/recaptcha/api2/demo*/


require_once "admin/includes/conn.php";
require_once "admin/includes/helper.php";
//contactform
if ($_SERVER["REQUEST_METHOD"] === "POST"){    # we write it even tho we are on the same page for the seek of the method
    //  dd($_POST[catID])
    try{   //are better use around anything sql-wise
    $sql = "INSERT INTO `appointment`(`gurdian`, `gemail`, `child`,  `chage`, `message`) VALUES (? ,? ,? ,?, ?);";
    $stmt = $conn->prepare($sql);

    $gurdian = $_POST['gurdian'];
    $gemail = $_POST['gemail'];

    $child = $_POST['child'];
    $chage = $_POST['chage'];

    $message = $_POST['message'];

    $stmt->execute([$gurdian, $gemail, $child, $chage, $message]);


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

        
        <!-- Appointment Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded">
                    <div class="row g-0">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="h-100 d-flex flex-column justify-content-center p-5">
                                <h1 class="mb-4">Make Appointment</h1>

                                
                                <form action="" method="POST">
                                <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="gname" placeholder="Gurdian Name" name="gurdian">
                                                <label for="gname">Gurdian Name</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="email" class="form-control border-0" id="gmail" placeholder="Gurdian Email"  name="gemail">
                                                <label for="gmail">Gurdian Email</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="cname" placeholder="Child Name"   name="child">
                                                <label for="cname">Child Name</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="cage" placeholder="Child Age"   name="chage'> 
                                                
                                                <label for="age">Child Age</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control border-0" placeholder="Leave a message here" id="message" style="height: 100px"  name="message"></textarea>
                                                <label for="message">Message</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
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
                                <img class="position-absolute w-100 h-100 rounded" src="img/appointment.jpg" style="object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Appointment End -->