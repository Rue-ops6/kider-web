<?php
require_once "includes/logged.php";
require_once "includes/conn.php";
require_once "includes/helper.php";

$sql = "SELECT * FROM `teachers`";
$stmt = $conn->prepare($sql);
$stmt->execute();

$teachers = $stmt->fetchAll();
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
          <h2 class="fw-bold fs-2 mb-5 pb-2">All Teachers</h2>
          <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Registration Date</th>
                <th scope="col">FullName</th>
                <th scope="col">Job Title</th>
                <th scope="col">Published</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
            <?php
            foreach ($teachers as $tea) {
            ?>
              <tr>

              <th scope="row"><?php $date=date_create($tea['regDate']); echo date_format($date,"d M Y");  #d is a number M is the letters of month and Y is the year with 4 numbers?></th> <!--echo $user['regDate']->format('d M Y'); 18 Jul 2024-->
                <td><?php echo $tea['fullname'] ?></td>
                <td><?php echo $tea['Jobtitle'] ?></td>
                <td><?php echo ($tea['pub'] == 1) ? "YES" : "NO"; ?></td> <!--Yes n no not 1 n 0--> 

                <td><a href="Updatetea.php?idtea=<?php echo $tea['idtea']?>" class="text-decoration-none"><i>✒️</i></a></td>
                <td><a href="includes/deltea.php?idtea=<?php echo $tea['idtea'] ?>" class="text-decoration-none"  onclick="return confirm('¡WARNING! you are about to del !!!?')"><img src="../img/trash-bin.png" alt="" style="max-width: 35px"></a></td>
              </tr>
              <?php
              } ?>
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
