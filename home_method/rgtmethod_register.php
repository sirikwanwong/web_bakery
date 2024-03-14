<?php include "../connect.php"?>
<?php
$stmt=$pdo->prepare("INSERT INTO ลูกค้า (username,password,ชื่อลูกค้า,เบอร์ลูกค้า,ที่อยู่ลูกค้า) VALUES(?,?,?,?,?)");
$stmt->bindParam(1,$_POST["user"]);
$stmt->bindParam(2,$_POST["pass"]);
$stmt->bindParam(3,$_POST["name"]);
$stmt->bindParam(4,$_POST["tel"]);
$stmt->bindParam(5,$_POST["address"]);
$stmt->execute();

header("location:../home.php");
?>