<?php include "../../connect.php"?>

<?php
$stmt=$pdo->prepare("UPDATE การจัดส่ง SET สถานะการจัดส่ง=? WHERE หมายเลขการจัดส่ง=?");
$stmt->bindParam(1, $_GET["stat"]);
$stmt->bindParam(2, $_GET["orderid"]);
$stmt->execute();
header("location:../showorder.php");
?>