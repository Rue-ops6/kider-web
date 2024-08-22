

<?php
require_once "admin/includes/conn.php";
require_once "admin/includes/helper.php";

$sql3 = "SELECT * FROM `testimonials` WHERE pub =1;";
$stmt3 = $conn->prepare($sql3);
$stmt3->execute();
$testimonials = $stmt3->fetchAll();
#dd($testimonials);
?>



        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Our Clients Say!</h1>
                    <p>They have been responsive, innovative and worked seamlessly with us for over six years. Perfect for ongoing updates.</p>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    
                <?php
    foreach ($testimonials as $tes) {
    ?>
                <div class="testimonial-item bg-light rounded p-5">   <!-- ¡item! is predominantly the repeated item-->
                        <p class="fs-5"><?php echo $tes['comment'] ?></p>
                        <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="img/<?php echo $tes['image'] ?>" style="width: 90px; height: 90px;">
                            <div class="ps-3">
                                <h3 class="mb-1"><?php echo $tes['fullname'] ?></h3>
                                <span><?php echo $tes['Jobtitle'] ?></span>
                            </div>
                            <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->