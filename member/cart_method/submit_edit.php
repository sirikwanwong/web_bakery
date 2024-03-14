<?php include "../../connect.php" ?>
<?php
    $stmt = $pdo->prepare("UPDATE ลูกค้า SET ชื่อลูกค้า=?,เบอร์ลูกค้า=?,ที่อยู่ลูกค้า=? WHERE username=?");
    $stmt->bindParam(1, $_POST["ชื่อลูกค้า"]);
    $stmt->bindParam(2, $_POST["เบอร์ลูกค้า"]);
    $stmt->bindParam(3, $_POST["ที่อยู่ลูกค้า"]);
    $stmt->bindParam(4, $_POST["username"]);
    if ($stmt->execute()){
        header("location:../user_home.php");
    }
?>
