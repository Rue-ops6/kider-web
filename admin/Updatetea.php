<?php
#echo "-- Up-2-date page---";
require_once "includes/logged.php";
require_once "includes/conn.php";
require_once "includes/helper.php";
#dd($_GET);

#updating the data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['idtea'])) {
    try { //try n catch is better used w/ sql codes to be more secured
        #dd($_POST);
        $sql = "UPDATE `teachers` SET `idtea`=? ,`fullname`=? ,`Jobtitle`=? ,`pub`=? ,`image`=? WHERE idtea =?;"; #to update even the unchanged ones
        $stmt = $conn->prepare($sql);

        #it's not AUTO_INCREMENT thus we shall put it in consedration
        $idtea = $_POST['idtea'];
        $fullname = $_POST['fullname'];
        $Jobtitle = $_POST['Jobtitle'];

        if (isset($_POST['pub'])) {
            $pub = 1;
        } else {
            $pub = 0; #'cuz if it wasn't checked it will get us an error unless we put it in an if function
        }

        #var_dump($_POST); #after updating as the POST is for that case it shows what it carries
        #update image
        $oldImage = $_POST['oldImage'];  #if no updated image were given
        require_once "includes/Updateimg.php";

        $idtea = $_POST['idtea'];

        $stmt->execute([$idtea, $fullname, $Jobtitle, $pub, $image_name, $idtea]);
        echo "data is up-2-date";
    } catch (PDOException $e) {
        $error = "Connection failed: " . $e->getMessage();
    }
}

#summons the data of the chosing tea throgh its id
if (isset($_GET['idtea'])) {
// query parameters?id=1   if ($_SERVER["REQUEST_METHOD"] === "GET") {
    try {
        $sql = "SELECT * FROM `teachers` WHERE idtea = ?;";
        $stmt = $conn->prepare($sql);

        $idtea = $_GET['idtea'];

        $stmt->execute([$idtea]);
        $tea = $stmt->fetch();

        if ($tea === false) {
            header('Location: ./teachers.php'); //when done redirect to a the main page of its kind
            die();
        }
        #dd($tea);

    } catch (PDOException $e) {
        $error = "Connection failed: " . $e->getMessage();
    }
} else {
    header('Location: ./teachers.php');
    die();
}
?>


<!-- still summoning the data by giving'em values to appear-->
<!DOCTYPE html>  <!--The declaration should be the very first thing in the HTML file. No whitespace nor nothing-->
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
      <?php require_once "includes/NAVbar.php";?>
      <div class="container my-5">
        <div class="bg-light p-5 rounded">
          <h2 class="fw-bold fs-2 mb-5 pb-2">Edit Teacher</h2>

	      <!-- enctype="multipart/form-data; to be capable of updating image -->
	      <form action="" method="POST" class="px-md-5"  enctype="multipart/form-data">
	      <!-- This part for the GET section that shows the data of the selected id to be readable as the main method is POST
	      and as an input for the id and oldImage variables -->
	      <!-- ¡YO THAT'S WHY IT HAS TO BE AFTER THE FORM METHOD LMFAO! -->
	      <!-- <input type="hidden" name="idtea" value="<#?php echo $idtea ?>"> -->  <!-- already called downstream-->
	      <input type="hidden" name="oldImage" value="<?php echo $tea['image'] ?>">  <!--we call it here in hidden by it id $item-->

          <!-- it's not AUTO_INCREMENT thus we shall show it -->
          <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Update the id no.:</label
              >
              <div class="col-md-10">
                <input
                  type="integer"
                  placeholder="e.g. 6"
                  class="form-control py-2"
                  name="idtea"
                  value="<?php echo $tea['idtea'] ?>"
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
                  value="<?php echo $tea['fullname'] ?>"
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
                  value="<?php echo $tea['Jobtitle'] ?>"
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
    class="form-check-input   btn mt-4 btn-secondary"
    <?php echo ($tea['pub'] == 1) ? "checked" : ""; ?>
    style="padding: 0.7rem"
    name="pub"
    value="<?php echo $tea['pub']; ?>"
  />
</div>
            </div>
            <hr />
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Image:</label
              >
              <div class="col-md-10">
                <input
                  type="file"
                  class="form-control"
                  style="padding: 0.7rem"
                  name="image"
                  value="<?php echo $tea['image'] ?>"
                />
              </div>
            </div>
            <div class="row justify-content-end">
              <div class="col-md-10">
                <!-- the original img -->
                <img
                  src="../img/<?php echo $tea['image'] ?>"
                  alt="teacher-image"
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



<!--  The InstallTrigger interface is deprecated and will be removed in the future. It was used in the past to install web applications using the Chrome Web Store or other installable platforms. -->
<!-- if ('serviceWorker' in navigator) {
  window.addEventListener('load', function() {
    navigator.serviceWorker.register('/service-worker.js')
      .then(function(registration) {
        console.log('Service Worker registered with scope:', registration.scope);
      })
      .catch(function(error) {
        console.log('Error registering Service Worker:', error);
      });
  });
} -->