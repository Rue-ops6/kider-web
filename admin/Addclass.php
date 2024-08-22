<?php
require_once "includes/logged.php";
require_once "includes/conn.php";
require_once "includes/helper.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(!empty($_POST["idtea"])){
	try {
        $sql = "INSERT INTO classes (`name`, `price`, `capacity`, `begAge`, `endAge`, `begTime`, `endTime`, `image`, `pub`, `idtea`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $name = $_POST['name'];
        $price = $_POST['price'];
        $capacity = $_POST['capacity'];
        $type = $_POST['type'];
        /*if(!empty($_POST['type'])) {
        }*/
        $begAge = $_POST['begAge'];
        $endAge = $_POST['endAge'];
        $begTime = $_POST['begTime'];
        $endTime = $_POST['endTime'];

		if (isset($_POST['pub'])) {
			$pub = 1;
		} else {
			$pub = 0;
		}		 #default as defined in sql instead bs hn7tagha 3l4an a2ol lw 1 hn3redha 3la elpage

    require_once "includes/addimg.php";

		$idtea = $_POST['idtea'];
    
        $stmt->execute([$name, $price, $capacity, $begAge, $endAge, $begTime, $endTime, $image_name, $pub, $idtea]);


        #echo "data inserted successfuly";
        header('Location: classes.php');
        die();
    } catch (PDOException $e) {
        $error = "Connection failed: " . $e->getMessage();
    }
} else {
	echo "Teacher name is required";
}
}

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
          <h2 class="fw-bold fs-2 mb-5 pb-2">Add Class</h2>
          <form action="" method="POST" class="px-md-5"  enctype="multipart/form-data">
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Class Name:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="e.g. Art & Design"
                  class="form-control py-2"
                  name="name"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Teacher:</label
              >
              <div class="col-md-10">
                <select id="" class="form-control py-1" name="idtea">
                  <option value="">Select teacher</option>
                  <?php
            foreach($teachers as $tea){
            ?>
              <option value="<?php echo $tea['idtea'] ?>"><?php echo $tea['fullname'] ?></option>
			      <?php
            }
            ?>
                </select>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Price:</label
              >
              <div class="col-md-10">
                <input
                  type="number"
                  step="0.1"
                  placeholder="Enter price"
                  class="form-control py-2"
                  name="price"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Capacity:</label
              >
              <div class="col-md-10">
                <input
                  type="number"
                  step="1"
                  placeholder="Enter catpacity"
                  class="form-control py-2"
                  name="capacity"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Age:</label
              >
              <div class="col-md-10">
                <label for="" class="form-label">From <input type="number" class="form-control" name="begAge"></label>
                <label for="" class="form-label">To <input type="number" class="form-control" name="endAge"></label>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Time:</label
              >
              <div class="col-md-10">
                <label for="" class="form-label">From <input type="time" class="form-control" name="begTime" ></label> <!--type="time"    ¡do not wait for the cursor to change into the writing integrator-wise, just use the num-tab! + the up n down for AM & PM -->

 <!-- <$?php if (!Page.IsPostBack) {
  for (int begTime = 0; begTime < 24; begTime++) {
      ddlhrs.Items.Add((begTime + 1).ToString());
  }
} ?>  -->
                <label for="" class="form-label">To <input type="time" class="form-control" name="endTime"></label> <!--type="time"    ¡do not wait for the cursor to change into the writing integrator-wise, just use the num-tab! + the up n down for AM & PM-->
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Published:</label
              >
              <div class="col-md-10">
                <input
                  type="checkbox"
                  class="form-check-input    btn mt-4 btn-secondary"
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
