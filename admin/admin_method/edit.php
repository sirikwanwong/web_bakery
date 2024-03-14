<?php include "../../connect.php";

if($_FILES['menuimg']['tmp_name']!=""){
    $filename = $_POST["pid"].".jpg";
    $location = "../../img/".$filename;
    move_uploaded_file($_FILES['menuimg']['tmp_name'],$location);
}
$stmt=$pdo->prepare("UPDATE ขนม SET ชื่อขนม=? ,ราคาขนม=?, ชนิดขนม=?, ประเภทตามเทศกาล=? WHERE รหัสขนม=?");
$stmt->bindParam(1, $_POST["pname"]);
$stmt->bindParam(2, $_POST["price"]);
$stmt->bindParam(3, $_POST["typ"]);
$stmt->bindParam(4, $_POST["fes"]);
$stmt->bindParam(5, $_POST["pid"]);
$stmt->execute();
header("location:../showmenu.php");
?>