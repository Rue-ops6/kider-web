<?php
#echo "---del page---";
require_once "./logged.php";
require_once "./conn.php";
require_once "./helper.php";
#dd($_GET);

if (isset($_GET['id'])) {

    $sql = "DELETE FROM `testimonials` WHERE id = ?";
    $stmt = $conn->prepare($sql);

$id = $_GET['id'];

    $stmt->execute([$id]);

}
header('Location: ../testimonials.php');
//} else { #why repeat it tho
//	header('Location: ../testimonials.php');
	die();
//}

#echo "deltes";

?>