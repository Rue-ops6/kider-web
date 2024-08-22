<?php
session_start(); //a secured cookie

require_once "includes/conn.php";
require_once "includes/helper.php";

if (isset($_SESSION['logged']) && ($_SESSION['logged'] === true)) {
    header('Location: classes.php');
    die();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $username = $_POST['username'];
        $pwd = $_POST['pwd'];

        $sql = "SELECT * FROM `users` WHERE username = ? And active = 1;";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);

        $user = $stmt->fetch();
        #dd($user);

        if ($user === false) {
            #echo "user not found";
            $error = "user not found";
        } elseif (password_verify($pwd, $user['pwd'])) {
            //echo "login success";
            $_SESSION['logged'] = true;
            #$_SESSION['name'] = users['name'];

            header('Location: classes.php');
            die();
        } else {
            #echo "password incorrect";
            $error = "user not found";
        }
    } catch (PDOException $e) {
        $error = "Connection failed: " . $e->getMessage();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login/Registeration</title>
  <link rel="stylesheet" href="css/main.min.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-dark">
  <div class="container" >
    <div class="row justify-content-center mt-5">
      <div class="col-lg-5 main position-relative mt-5 d-flex flex-column align-items-center">
        <h2 class="text-white mt-5 fw-bold">Login Form</h2>

        <form action="" method="POST" class="mt-3 w-100 px-3">
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Username</label>
            <input type="text" placeholder="Username" class="form-control form-control-input py-2" name="username">
          </div>
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Password</label>
            <input type="password" placeholder="Password" class="form-control form-control-input py-2" name="pwd">
          </div>
          <button class="btn my-4 bg-light fs-5 fw-bold w-100 border-0 py-2">Log in</button>
          <a href="- reg.php" class="text-center d-block fs-4 text-white mb-5">Don't have account?</a>
        </form>
      </div>
    </div>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>