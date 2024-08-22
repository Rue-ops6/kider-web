

<?php
require_once "admin/includes/conn.php";
require_once "admin/includes/helper.php";

$sql1 = "SELECT * FROM `classes` WHERE pub =1;";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$classes = $stmt1->fetchAll();
#dd($classes);

$sql2 = "SELECT * FROM `teachers` WHERE pub =1;";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$teachers = $stmt2->fetchAll();
#dd($teachers);
?>



        <!-- Classes Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">School Classes</h1>
                    <p>School classes are designed to provide a comprehensive education that prepares students for future academic pursuits, careers, and informed citizenship. Core subjects build foundational knowledge and skills, while elective and specialized courses allow students to explore interests and develop specific talents. Through a balanced curriculum, students gain the tools needed for personal and professional success.</p>
                </div>
                <div class="row g-4">
    <?php
foreach ($classes as $class) {
    foreach ($teachers as $tea) {
        if ($class['idtea'] == $tea['idtea']) { #identyfying the $tea and its id's relatiion with class
            ?>
<!-- /* Three columns side by side */ -->
<!-- <style>
html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

</style> -->
                                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s"> <!--data-wow-delay="0.3s"  is putting effects after 0.3 seconds for the item to pop-out-->
                    <div class="classes-item">  <!-- ¡item! is predominantly the repeated item-->
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="img/<?php echo $class['image'] ?>" alt="" width= "50%">
                            </div>
                            <!-- <div class="bg-light rounded p-4 pt-5 mt-n5"> -->
                                <a class="d-block text-center h3 mt-3 mb-4" href="admin/- details.php?id=<?php echo $class['id'] ?>"> <?php echo $class['name'] ?> </a>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle flex-shrink-0" src="img/<?php echo $tea['image'] ?>" alt="" style="width: 45px; height: 45px;">
                                        <div class="ms-3">

                                            <h6 class="text-primary mb-1"><?php echo $tea['fullname'] ?></h6>
                                            <small>Teacher</small>
                                        </div>
                                    </div>
                                    <span class="bg-primary text-white rounded-pill py-2 px-3" href=""><?php echo $class['price'] ?> $</span>
                                </div>
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Age:</h6>
                                            <small><?php echo $class['begAge'] ?> - <?php echo $class['endAge'] ?> Years</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-success pt-2">
                                            <h6 class="text-success mb-1">Time:</h6>

                                            <small> <?php $date = date_create($class['begTime']); echo date_format($date, "h : i A"); echo " - <br> "; $date = date_create($class['endTime']); echo date_format($date, "h : i A");?> </small> <!--h for 12 hours i for minutes and A for uppercase AM n PM-->
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Capacity:</h6>
                                            <small><?php echo $class['capacity'] ?> Kids</small>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    <?php
}
    }
}
?>
                </div>
            </div>
        </div>
        <!-- Classes End -->