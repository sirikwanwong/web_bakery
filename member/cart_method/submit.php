<?php include "../../connect.php"?>
<?php
session_start();

$stmt=$pdo->prepare("INSERT INTO การสั่งออเดอร์(`อันดับออเดอร์`,`หมายเลขออเดอร์`, `username`, `รหัสขนม`, `จำนวนชิ้น`, `วันที่สั่งOrder`, `วันที่รับขนม`, `ประเภทการชำระเงิน`) VALUES(?,?,?,?,?,?,?,?)");
foreach($_SESSION['cart'] as $item){
    $stmt->bindParam(1,$_GET['no_order']);
    $stmt->bindParam(2,$_GET['orderid']);
    $stmt->bindParam(3,$_SESSION['username']);
    $stmt->bindParam(4,$item['pid']);
    $stmt->bindParam(5,$item['qty']);
    $stmt->bindParam(6,$_GET['od_date']);
    $stmt->bindParam(7,$_GET['get_date']);
    $stmt->bindParam(8,$_GET['payment']);

    $stmt->execute();
}

unset($_SESSION['cart']);
header("location:../showorder.php");
?>