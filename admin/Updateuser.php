<?php
#echo "-- Up-2-date page---";
require_once "includes/logged.php";
require_once "includes/conn.php";
require_once "includes/helper.php";
#dd($_GET);

#updating the data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {

    try {                   //try & catch is better used w/ sql codes to be more secured
    // Use the $user['id'] value

    #dd($_POST);
    $sql = "UPDATE `users` SET `fullname`=? ,`username`=? ,`email`=? ,`pwd`=? ,`phone`=? ,`active`=? WHERE id =?;";   #to update even the unchanged ones
    $stmt = $conn->prepare($sql);

    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT); #cypher password (encryption)
    $phone = $_POST['phone'];

    if (isset($_POST['active'])) {
        $active = 1;
    } else {
        $active = 0;  #'cuz if it wasn't checked it will get us an error unless we put it in an if function
    }

    #var_dump($_POST); #after updating as the POST is for that case it shows what it carries
    $id = $_POST['id'];

    $stmt->execute([$fullname, $username, $email, $pwd, $phone, $active, $id]);
    echo "data is up-2-date";

  } catch (PDOException $e) {
    $error = "Connection failed: " . $e->getMessage();
} 
}


#summons the data of the chosing user throgh its id
if (isset($_GET['id'])) {
// query parameters?id=1   if ($_SERVER["REQUEST_METHOD"] === "GET") {
     try {
        // if (isset($id)) {
        $sql = "SELECT * FROM `users` WHERE id = ?;";
        $stmt = $conn->prepare($sql);
        $id = $_GET['id'];
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        // } else {
        //     header('Location: ./users.php');
        //     die();
        // }

        if ($user === false) {
            header('Location: ./users.php'); //when done redirect to a the main page of its kind
            die();
        }
        #dd($user);
    } catch (PDOException $e) {
        $error = "Connection failed: " . $e->getMessage();
    }
} else {
    header('Location: ./users.php');
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
    <?php require_once "includes/NAVbar.php";?>
      <div class="container my-5">
        <div class="bg-light p-5 rounded">
          <h2 class="fw-bold fs-2 mb-5 pb-2">Edit User</h2>

	      <form method="POST" action="" class="px-5"> 
	      <!-- This part for the GET section that shows the data of the selected id to be readable as the main method is POST 
	      and as an input for the id variable-->
	      <!-- ¡YO THAT'S WHY IT HAS TO BE AFTER THE FORM METHOD LMFAO! -->
	      <input type="hidden" name="id" value="<?php echo $id ?>">

            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Fullname:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="e.g. John Doe"
                  class="form-control py-2"
                  name="fullname"
                  value="<?php echo $user['fullname'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Username:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="Username"
                  class="form-control py-2"
                  name="username"
                  value="<?php echo $user['username'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Email:</label
              >
              <div class="col-md-10">
                <input
                  type="email"
                  placeholder="email@example.com"
                  class="form-control py-2"
                  name="email"
                  value="<?php echo $user['email'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Password:</label
              >
              <div class="col-md-10">
                <input
                  type="password"
                  placeholder="Password"
                  class="form-control py-2"
                  name="pwd"
                  value="<?php echo $user['pwd'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Phone:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="+20133332323"
                  class="form-control py-2"
                  name="phone"
                  value="<?php echo $user['phone'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-end"
                >Active:</label
              >
              <div class="col-md-10">
                <input
                  type="checkbox"
                  class="form-check-input    btn mt-4 btn-secondary"  <?php echo ($user['active'] == 1) ? "checked" : " "; ?>
                  style="padding: 0.7rem;"
                  name="active"
                  value="<?php echo $user['active'] ?>"
                />
              </div>
            </div>
            <div class="text-end">
            <button
              class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5" type="submit"
            >
            Update
            </button>
            <!-- <input type="submit" value="Submit"> -->
          </div>
          </form>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
    <?php
if (isset($error)) {
    echo '<div style="color: #ee0002; padding: 5px;">' . htmlspecialchars($error) . '</div>'; # Escaping Output: Used htmlspecialchars to prevent XSS by escaping output.
}?>
  </body>
</html>
