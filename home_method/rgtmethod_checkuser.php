<?php include "../connect.php"?>
<?php
    $stmt=$pdo->prepare("SELECT * FROM ลูกค้า WHERE username = ?");
    $stmt->bindParam(1,$_GET["username"]);
    $stmt->execute();
    $row=$stmt->fetch();
    if(empty($row)){
        $stmt2=$pdo->prepare("SELECT * FROM พนักงาน WHERE am_username = ?");
        $stmt2->bindParam(1,$_GET["username"]);
        $stmt2->execute();
        $row=$stmt2->fetch();
        if(empty($row)){
            echo "valid-user";
        }else{
            echo "invalid-user";
        }
    }else{
        echo "invalid-user";
    }
?>