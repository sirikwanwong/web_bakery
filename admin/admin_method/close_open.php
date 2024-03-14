<?php include "../../connect.php";

$stmt;
if(isset($_GET["action"]) && $_GET["action"]=="close"){
$stmt=$pdo->prepare("UPDATE ขนม SET สถานะ = 'ปิด' WHERE รหัสขนม=?");
$stmt->bindParam(1, $_GET["pid"]);
$stmt->execute();
header("location:../showmenu.php");
}else if(isset($_GET["action"]) && $_GET["action"]=="open"){
$stmt=$pdo->prepare("UPDATE ขนม SET สถานะ = 'เปิด' WHERE รหัสขนม=?");
$stmt->bindParam(1, $_GET["pid"]);
$stmt->execute();
header("location:../showclosemenu.php");
}
?>