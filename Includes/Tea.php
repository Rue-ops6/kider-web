
<?php
require_once "admin/includes/conn.php";
require_once "admin/includes/helper.php";

$sql2 = "SELECT * FROM `teachers` WHERE pub =1;";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$teachers = $stmt2->fetchAll();
#dd($teachers);
?>


        <!-- Team Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Popular Teachers</h1>
                    <p>Teachers play a multifaceted role in the education system, acting as educators, mentors, managers, and collaborators. Their responsibilities extend beyond mere instruction, encompassing the holistic development of students and fostering a supportive learning environment. Through their dedication and diverse skill sets, teachers significantly influence the academic achievements and personal growth of their students, preparing them for future challenges and opportunities.</p>
                </div>
                <div class="row g-4">

    <?php
    foreach ($teachers as $tea) {
    ?> 
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item position-relative">   <!-- ¡item! is predominantly the repeated item-->
                            <img class="img-fluid rounded-circle w-75" src="img/<?php echo $tea['image'] ?>" alt="" width= "50%">
                            <div class="team-text">
                                <h3><?php echo $tea['fullname'] ?></h3>
                                <p><?php echo $tea['Jobtitle'] ?></p>
                                <div class="d-flex align-items-center">
                                    <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
    <?php } ?>

                </div>
            </div>
        </div>
        <!-- Team End -->