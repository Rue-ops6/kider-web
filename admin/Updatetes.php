<?php
#echo "-- Up-2-date page---";
require_once "includes/logged.php";
require_once "includes/conn.php";
require_once "includes/helper.php";
#dd($_GET);

#updating the data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    try {                   //try & catch is better used w/ sql codes to be more secured
    #dd($_POST);
    $sql = "UPDATE `testimonials` SET `fullname`=? ,`Jobtitle`=? ,`comment`=? ,`pub`=? ,`image`=? WHERE id =?;";   #to update even the unchanged ones
    $stmt = $conn->prepare($sql);

    $fullname = $_POST['fullname'];
    $Jobtitle = $_POST['Jobtitle'];
    $comment = $_POST['comment'];

    if (isset($_POST['pub'])) {
        $pub = 1;
    } else {
        $pub = 0; #'cuz if it wasn't checked it will get us an error unless we put it in an if function
    }


    #var_dump($_POST); #after updating as the POST is for that case it shows what it carries
    #update image
    $oldImage = $_POST['oldImage'];  #if no updated image were given
    require_once "includes/Updateimg.php";

    $id = $_POST['id'];

    $stmt->execute([$fullname, $Jobtitle, $comment, $pub, $image_name, $id]);
    echo "data is up-2-date";
}  catch (PDOException $e) {
  $error = "Connection failed: " . $e->getMessage();
}
}

#summons the data of the chosing tes throgh its id
if (isset($_GET['id'])) {
// query parameters?id=1   if ($_SERVER["REQUEST_METHOD"] === "GET") {
    try {
        $sql = "SELECT * FROM `testimonials` WHERE id = ?;";
        $stmt = $conn->prepare($sql);

        $id = $_GET['id'];

        $stmt->execute([$id]);
        $tes = $stmt->fetch();

        if ($tes === false) {
            header('Location: ./testimonials.php'); //when done redirect to a the main page of its kind
            die();
        }
        #dd($tes);
    } catch (PDOException $e) {
        $error = "Connection failed: " . $e->getMessage();
    }
} else {
    header('Location: ./testimonials.php');
    die();
}
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
          <h2 class="fw-bold fs-2 mb-5 pb-2">Edit Testimonial</h2>

	      <!-- enctype="multipart/form-data; to be capable of updating image -->
	      <form action="" method="POST" class="px-md-5" enctype="multipart/form-data">
	      <!-- This part for the GET section that shows the data of the selected id to be readable as the main method is POST
	      and as an input for the id and oldImage variables-->
	      <!-- ¡YO THAT'S WHY IT HAS TO BE AFTER THE FORM METHOD LMFAO! -->
	      <input type="hidden" name="id" value="<?php echo $id ?>">
	      <input type="hidden" name="oldImage" value="<?php echo $tes['image'] ?>">  <!--we call it here in hidden by it id $item-->

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
                  value="<?php echo $tes['fullname'] ?>"
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
                  value="<?php echo $tes['Jobtitle'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Comment:</label
              >
              <div class="col-md-10">
                <textarea
                  id=""
                  cols="30"
                  rows="5"
                  class="form-control py-2"
                  name="comment"
                ><?php echo $tes['comment'] ?></textarea>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Published:</label
              >
              <div class="col-md-10">
                <input
                  type="checkbox"
                  class="form-check-input   btn mt-4 btn-secondary"  <?php echo ($tes['pub'] == 1) ? "checked" : " "; ?>
                  style="padding: 0.7rem"
                  name="pub"
                  value="<?php echo $tes['pub'] ?>"
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
                  value="<?php echo $tes['image'] ?>"
                />
              </div>
            </div>
            <div class="row justify-content-end">
              <div class="col-md-10">
<!-- the original img -->
                <img
                  src="../img/<?php echo $tes['image'] ?>"
                  alt="testimonial-image"
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
