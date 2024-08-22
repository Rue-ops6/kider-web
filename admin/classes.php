<?php
require_once "includes/logged.php";
require_once "includes/conn.php";
require_once "includes/helper.php";

$sql = "SELECT * FROM `classes`";
$stmt = $conn->prepare($sql);
$stmt->execute();

$classes = $stmt->fetchAll();
#dd($classes);


$sqltea = "SELECT * FROM `teachers`";
$stmttea = $conn->prepare($sqltea);
$stmttea->execute();
$teachers = $stmttea->fetchAll();
#dd($teachers);
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
          <h2 class="fw-bold fs-2 mb-5 pb-2">All Classes</h2>
          <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Registration Date</th>
                <th scope="col">Class Name</th>
                <th scope="col">Teacher</th>
                <th scope="col">Published</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
            <?php
            foreach ($classes as $class) {
              foreach ($teachers as $tea) {
                if ($class['idtea'] == $tea['idtea']) {   #identyfying the $tea and its id's relatiion with class
            ?>
              <tr>

              <th scope="row"><?php $date=date_create($class['regDate']); echo date_format($date,"d M Y"); #d is a number M is the letters of month and Y is the year with 4 numbers?></th> <!--echo $user['regDate']->format('d M Y'); 18 Jul 2024-->
                <td><?php echo $class['name'] ?></td>
                <!-- <#?php      #can be done encircling the teacher relation but I'd like to abridge the code whenever I can
                               foreach ($teachers as $tea) {
                                if ($class['idtea'] == $tea['idtea']) {
            ?> -->
                            <td value="<?php echo $class['idtea']?>"><?php echo $tea['fullname'] ?></td>
                            <!-- <#?php
              }  } 
              ?> -->
                <td><?php echo ($class['pub'] == 1) ? "YES" : "NO"; ?></td> <!--Yes n no not 1 n 0--> 

                <td><a href="Updateclass.php?id=<?php echo $class['id']?>" class="text-decoration-none"><i>✒️</i></a></td>
                <td><a href="includes/delclass.php?id=<?php echo $class['id'] ?>" class="text-decoration-none"  onclick="return confirm('¡WARNING! you are about to del !!!?')"><img src="../img/trash-bin.png" alt="" style="max-width: 35px"></a></td>
              </tr>
              <?php
              } } }
              ?>
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
