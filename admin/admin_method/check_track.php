<?php include "../../connect.php";?>
<?php
session_start();
if(isset($_GET["action"]) && $_GET["action"]=="check"){
$stmt=$pdo->prepare("SELECT * FROM การจัดส่ง WHERE หมายเลขการจัดส่ง=?");
$stmt->bindParam(1, $_GET["tracking"]);
$stmt->execute();
if($stmt->fetch() || $_GET["tracking"]==""){
    echo "notpass";
}else{
    echo "pass";
}
}else{
// echo "<p>".$_POST["ntrack"]."</p>";
$stmt=$pdo->prepare("INSERT INTO การจัดส่ง(หมายเลขการจัดส่ง, am_username, สถานะการจัดส่ง) VALUES (?,?,'กำลังจัดเตรียม')");
$stmt->bindParam(1, $_POST["ntrack"]);
$stmt->bindParam(2, $_SESSION["username"]);
$stmt->execute();

$stmt=$pdo->prepare("UPDATE การสั่งออเดอร์ SET หมายเลขการจัดส่ง=? WHERE หมายเลขออเดอร์=?");
$stmt->bindParam(1, $_POST["ntrack"]);
$stmt->bindParam(2, $_POST["norder"]);
$stmt->execute();
header("location:../showorder.php");
}

?>