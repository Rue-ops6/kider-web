<?php
require_once "includes/conn.php";
require_once "includes/helper.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $sql = "INSERT INTO users(`active`, `fullname`, `username`, `email`, `pwd`, `phone`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);  #cypher password (encryption)
        $phone = $_POST['phone'];

        if (isset($_POST['active'])) {
          $active = 1;   #administrator
        } else {
          $active = 0;   #blocked
        }

        $stmt->execute([$active, $fullname, $username, $email, $pwd, $phone]);
        #echo "data inserted successfuly";

        header('Location: - login.php');
        die();
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
      <form action="" method="POST" class="mt-3 w-100 px-3">
      <h2 class="text-white mt-5 fw-bold"><div align="center"> Registeration Form <input type="checkbox" name="active" id="" class="form-check-input" > </div></h2>
      <div class="form-group mb-3">

            <label for="" class="text-white form-label">Fullname* </label> <div class="form-group mb-3 row"> 
            <input type="text" placeholder="e.g. John Doe" class="form-control form-control-input py-2" name="fullname" required>
          </div>
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Username*</label>
            <input type="text" placeholder="Username" class="form-control form-control-input py-2" name="username" required>
          </div>
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Email*</label>
            <input type="email" placeholder="Email" class="form-control form-control-input py-2" name="email" required>
          </div>
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Password*</label>
            <input type="password" placeholder="Password" class="form-control form-control-input py-2" name="pwd" required>
          </div>
          <div class="form-group mb-3">
            <label for="" class="text-white form-label">Phone</label>
            <input type="text" placeholder="e.g. +2011423253" class="form-control form-control-input py-2" name="phone">
          </div>

          <button class="btn my-4 bg-light fs-5 fw-bold w-100 border-0 py-2">Register</button>
          <a href="- login.php" class="text-center d-block fs-4 text-white mb-5">Already have account?</a>
        </form>
      </div>
    </div>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>