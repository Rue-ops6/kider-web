<?php
#echo "---del page---";
require_once "./logged.php";
require_once "./conn.php";
require_once "./helper.php";
#dd($_GET);

if (isset($_GET['idtea'])) {

    $sql = "DELETE FROM `teachers` WHERE idtea = ?";
    $stmt = $conn->prepare($sql);

$idtea = $_GET['idtea'];

    $stmt->execute([$idtea]);


}
header('Location: ../teachers.php');
//} else { #why repeat it tho
//	header('Location: ../teachers.php');
	die();
//}
#echo "deltea";

?>