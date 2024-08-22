<?php
#echo "-- Up-2-date page---";
require_once "includes/logged.php";
require_once "includes/conn.php";
require_once "includes/helper.php";
#dd($_GET);

#updating the data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
     #if (!empty($_POST["idtea"])) {
     try {                   //try & catch is better used w/ sql codes to be more secured
    //$error = "classes name is required";
    //dd($_POST);
    $sql = 'UPDATE `classes` SET `name`=? ,`price`=? ,`capacity`=? ,`begAge`=? ,`endAge`=? ,`begTime`=? ,`endTime`=? ,`pub`=?,`image`=? ,`idtea`=? WHERE `id` =?;';   #to update even the unchanged ones
    $stmt = $conn->prepare($sql);

    $name = $_POST['name'];
    $price = $_POST['price'];
    $capacity = $_POST['capacity'];
    #if(!empty($_POST['id'])) {
    
    $begAge = $_POST['begAge'];
    $endAge = $_POST['endAge'];
    $begTime = $_POST['begTime'];
    $endTime = $_POST['endTime'];

    if (isset($_POST['pub'])) {
        $pub = 1;
    } else {
        $pub = 0;  #'cuz if it wasn't checked it will get us an error unless we put it in an if function
    } #default as defined in sql instead bs hn7tagha 3l4an a2ol lw 1 hn3redha 3la elpage


    #var_dump($_POST); #after updating as the POST is for that case it shows what it carries
    #update image
    $oldImage = $_POST['oldImage']; #if no updated image were given
    require_once "includes/Updateimg.php";

    #update the teacher as well as the class as they are in a relation
    $idtea = $_POST['idtea'];

    $id = $_POST['id'];

    $stmt->execute([$name, $price, $capacity, $begAge, $endAge, $begTime, $endTime, $pub, $image_name, $idtea, $id]);
    echo "data is up-2-date";
  }  catch (PDOException $e) {
    $error = "Connection failed: " . $e->getMessage();
  }
  }
// } else {
//      echo "Teacher name is required";
// }

#summons the data of the chosing class throgh its id
if (isset($_GET['id'])) {
//    if ($_SERVER["REQUEST_METHOD"] === "GET") {
    try {
        $sql = "SELECT * FROM `classes` WHERE id = ?;";
        $stmt = $conn->prepare($sql);
        $id = $_GET['id'];
#require_once "includes/addimg.php";
        $stmt->execute([$id]);
        $class = $stmt->fetch();

        if ($class === false) {
            header('Location: ./classes.php'); //when done redirect to a the main page of its kind
            die();
        }
#dd($class);
    } catch (PDOException $e) {
        $error = "Connection failed: " . $e->getMessage();
    }
} else {
    header('Location: ./classes.php');
    die();
}

#showing the data of the teacher through its id from the relation
$sqltea = "SELECT * FROM teachers";
$stmttea = $conn->prepare($sqltea);
$stmttea->execute();
$teachers = $stmttea->fetchAll();
#dd($teachers);

?>


<!-- still summoning the data by giving'em values to appear-->
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
          <h2 class="fw-bold fs-2 mb-5 pb-2">Edit Class</h2>

	      <!-- enctype="multipart/form-data; to be capable of updating image -->
	      <form action="" method="POST" class="px-md-5" enctype="multipart/form-data">
	      <!-- This part for the GET section that shows the data of the selected id to be readable as the main method is POST
	      and as an input for the id and oldImage variables -->
        	      <!-- ¡YO THAT'S WHY IT HAS TO BE AFTER THE FORM METHOD LMFAO! -->
	      <input type="hidden" name="id" value="<?php echo $id ?>">
	      <!-- <input type="hidden" name="idtea" value="<#?php echo $idtea ?>">  is already given downwards-->
	      <input type="hidden" name="oldImage" value="<?php echo $class['image'] ?>">  <!--we call it here in hidden by it id $item-->

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
                  value="<?php echo $class['name'] ?>"
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
foreach ($teachers as $tea) {
    ?>
    <!-- showing the data of the teacher through its idtea from the relation as it equals the idtea in the class table-->
              <option value="<?php echo $tea['idtea'] ?>" <?php echo ($tea['idtea'] == $class['idtea']) ? "selected" : ""; ?>><?php echo $tea["fullname"] ?></option>
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
                  value="<?php echo $class['price'] ?>"
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
                  value="<?php echo $class['capacity'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Age:</label
              >
              <div class="col-md-10">
                <label for="" class="form-label">From <input type="number" class="form-control" name="begAge" value="<?php echo $class['begAge'] ?>"></label>
                <label for="" class="form-label">To <input type="number" class="form-control" name="endAge" value="<?php echo $class['endAge'] ?>"></label>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Time:</label
              >
              <div class="col-md-10">
                <label for="" class="form-label">From <input type="time" class="form-control" name="begTime" value="<?php echo $class['begTime'] ?>"></label> <!--type="time"    ¡do not wait for the cursor to change into the writing integrator-wise, just use the num-tab! + the up n down for AM & PM -->
                <label for="" class="form-label">To <input type="time" class="form-control" name="endTime" value="<?php echo $class['endTime'] ?>"></label> <!--type="time"    ¡do not wait for the cursor to change into the writing integrator-wise, just use the num-tab! + the up n down for AM & PM -->
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Published:</label
              >
              <div class="col-md-10">
                <input
                  type="checkbox"
                  class="form-check-input   btn mt-4 btn-secondary" <?php echo ($class['pub'] === 1) ? "checked" : " "; ?>
                  style="padding: 0.7rem;"
                  name="pub"
                  value="<?php echo $class['pub'] ?>"
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
                  value="<?php echo $class['image'] ?>"
                />
              </div>
            </div>
            <div class="row justify-content-end">
              <div class="col-md-10">
                <!-- the original img -->
                <img
                  src="../img/<?php echo $class['image'] ?>"
                  alt="class-image"
                  style="max-width: 150px"
                />

              </div>
            </div>
            <div class="text-md-end">
            <button
              class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5"
            >
            Update
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
