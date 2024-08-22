<?php
require_once "includes/logged.php";
require_once "includes/conn.php";
require_once "includes/helper.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $sql = "INSERT INTO teachers(`idtea`, `fullname`, `Jobtitle`, `pub`, `image`) VALUES (?, ?, ?, ?, ?);";
        $stmt = $conn->prepare($sql);
        #it's not AUTO_INCREMENT thus we can set it ourself
        $idtea = $_POST['idtea'];

        $fullname = $_POST['fullname'];
        $Jobtitle = $_POST['Jobtitle'];

		if (isset($_POST['pub'])) {
			$pub = 1;
		} else {
			$pub = 0;
		}		

    require_once "includes/addimg.php";

        $stmt->execute([$idtea, $fullname, $Jobtitle, $pub, $image_name]);

        echo "data inserted successfuly";
        header('Location: teachers.php');
        die();
    } catch (PDOException $e) {
        $error = "Connection failed: " . $e->getMessage();
    }
}
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
          <h2 class="fw-bold fs-2 mb-5 pb-2">Add Teacher</h2>
          <form action="" method="POST" class="px-md-5" enctype="multipart/form-data">
          
          <!-- it's not AUTO_INCREMENT thus we can set it ourself -->
          <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Set an id no.:</label
              >
              <div class="col-md-10">
                <input
                  type="integer"
                  placeholder="e.g. 6"
                  class="form-control py-2"
                  name="idtea"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Fullname:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="e.g. John Doe"
                  class="form-control py-2"
                  name="fullname"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Job Title:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="e.g. Content Creator"
                  class="form-control py-2"
                  name="Jobtitle"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Published:</label
              >
              <div class="col-md-10">
                <input
                  type="checkbox"
                  class="form-check-input  btn mt-4 btn-secondary"
                  style="padding: 0.7rem;"
                  name="pub"
                />
              </div>
            </div>
            <hr>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Image:</label
              >
              <div class="col-md-10">
                <input
                  type="file"
                  class="form-control"
                  style="padding: 0.7rem;"
                  name="image"
                />
              </div>
            </div>
            <div class="text-md-end">
            <button
              class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5"
            >
            Insert 
            </button>
          </div>
          </form>
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
