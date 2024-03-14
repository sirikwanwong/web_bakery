<?php include "../connect.php"?>
<?php
session_start();
$stmt=$pdo->prepare("SELECT * FROM ลูกค้า WHERE username=? AND password=?");
$stmt->bindParam(1,$_GET["username"]);
$stmt->bindParam(2,$_GET["password"]);
$stmt->execute();
$row=$stmt->fetch();
if(!empty($row)){
    session_regenerate_id();
    $_SESSION["username"]=$row["username"];
    $_SESSION["role"]="user";
    echo "valid";
}else{
    $stmt2=$pdo->prepare("SELECT * FROM พนักงาน WHERE am_username=? AND am_password=?");
    $stmt2->bindParam(1,$_GET["username"]);
    $stmt2->bindParam(2,$_GET["password"]);
    $stmt2->execute();
    $row=$stmt2->fetch();
    if(!empty($row)){
        session_regenerate_id();
        $_SESSION["username"]=$row["am_username"];
        $_SESSION["role"]="admin";
        echo "valid";
    }else{
        echo "invalid-password";
    }
}
?>