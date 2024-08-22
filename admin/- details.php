<?php
require_once "includes/logged.php";
require_once "includes/conn.php";
require_once "includes/helper.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET['id'])) {
        #if (!empty($_POST["idtea"])) {
        try {

            $sql = "SELECT * FROM `classes` WHERE id = ? AND pub =1;";
            $stmt = $conn->prepare($sql);

            $id = $_GET['id'];
            $stmt->execute([$id]);
            $class = $stmt->fetch();

            #dd($class);
            if ($class === false) { #lazem b3ad ma 3rft el class
                header('Location: ./- index.php');
                die();
            }

            // selected class
            $sqltea = "SELECT * FROM `teachers` Where idtea = ?;";
            $stmttea = $conn->prepare($sqltea);
            $idtea = $class['idtea'];
            $stmttea->execute([$idtea]);
            $tea = $stmttea->fetch();

            // related class with same teacher but not repeated
            // $sqlCat = "SELECT * FROM `classes` Where idtea = ? AND pub = 1 AND id != ?;";
            // $stmttea = $conn->prepare($sqltea);
            // $teaid = $class['idtea'];
            // $stmttea->execute([$idtea, $id]);
            // $tea = $stmttea->fetchAll();
            #dd($tea);

        } catch (PDOException $e) {
            $error = "Connection failed: " . $e->getMessage();
        }

    } else {
        header('Location: ./- index.php');
    } #die();
}
#}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/main.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <main>
      <?php
require_once "includes/NAVbar.php";
?>

      <div class="container my-5">
        <div class="bg-light p-5 rounded">
          <form method="GET" action="" class="m-auto" style="max-width:600px" enctype="multipart/form-data">
          <div class="card bg-light border-0">
            <div class="row justify-content-center">
              <div class="col-lg-4 col-md-6 col-10">
                <img src="../img/<?php echo $class['image'] ?>" alt="" class="card-img" width= "100%"/>
              </div>
              <div class="col-lg-8 col-md-6 col-12 card-body">
                <div class="mb-4 text-center py-2">
                  <h2 class="fw-semibold bg-light card-header"><?php echo $class['name'] ?></h2>
                </div>
                <div class="mb-4">
                  <p class="card-text">
                    <span class="fw-bold" <?php echo $tea['idtea'] ?>>Teacher:</span> <?php echo $tea['fullname'] ?>
                  </p>
                </div>
                <div class="mb-4">
                  <p class="card-text">
                    <span class="fw-bold">Price:</span> <?php echo $class['price'] ?> $
                  </p>
                </div>
                <div class="mb-4">
                  <p class="card-text">
                    <span class="fw-bold">Published:</span> <?php echo ($class['pub'] === 1) ? "YES" : "NO"; ?>
                  </p>
                </div>
                <div class="row">
                  <div class="col-md-4" style="border-top: 3px solid #198754">
                    <p class="text-success fs-5 fw-bold lh-1 pt-2">Age:</p>
                    <p class="lh-1 fw-bold"> <?php echo $class['begAge'] ?> - <?php echo $class['endAge'] ?> Years</p>
                  </div>
                  <div class="col-md-4" style="border-top: 3px solid #fe5d37">
                    <p class="text-primary fs-5 fw-bold lh-1 pt-2">Time:</p>
                    <p class="lh-1 fw-bold"> <?php $date=date_create($class['begTime']); echo date_format($date,"h : i A");?> - <?php $date=date_create($class['endTime']); echo date_format($date,"h : i A"); ?> <!--h for 12 hours i for minutes and A for uppercase AM n PM-->
                    </p>
                  </div>
                  <div class="col-md-4" style="border-top: 3px solid #ffc107">
                    <p class="text-warning fs-5 fw-bold lh-1 pt-2">Capacity:</p>
                    <p class="lh-1 fw-bold"> <?php echo $class['capacity'] ?> kids</p>
                  </div>
                </div>
                <div class="text-md-end">
                  
                <!-- hash in link to get to a specific part -->
                  <a href="classes.php"   
                    class="btn mt-4 btn-primary text-white fs-5 fw-bold border-0 py-2 px-md-5"
                  >
                    Back to classes
                </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
    <?php
if (isset($error)) {
    ?>
          <div style="color: #ee0002; padding: 5px;">
            <?php echo $error ?>
          </div>
          <?php
}
?>
  </body>
</html>
