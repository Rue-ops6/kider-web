<?php
#echo "---del page---";
require_once "./logged.php";
require_once "./conn.php";
require_once "./helper.php";
#dd($_GET);

if (isset($_GET['id'])) {

    $sql = "DELETE FROM `classes` WHERE id = ?";
    $stmt = $conn->prepare($sql);

$id = $_GET['id'];

    $stmt->execute([$id]);


}
header('Location: ../classes.php');
//} else { #why repeat it tho
//	header('Location: ../classes.php');
	die();
//}
#echo "delclasses";

?>