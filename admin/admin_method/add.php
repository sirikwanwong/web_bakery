<?php include "../../connect.php";

if(isset($_GET["action"]) && $_GET["action"]=="check"){
    $stmt=$pdo->prepare("SELECT * FROM ขนม WHERE รหัสขนม = ?");
    $stmt->bindParam(1,$_GET["pid"]);
    $stmt->execute();
    if($stmt->fetch()){
        echo "notpass";
    }else{
        echo "pass";
    }
}else{
    $stmt=$pdo->prepare("INSERT INTO ขนม(รหัสขนม,ชื่อขนม,ราคาขนม,ชนิดขนม,ประเภทตามเทศกาล,สถานะ) VALUES (?,?,?,?,?,'เปิด')");
    $stmt->bindParam(1, $_POST["pid"]);
    $stmt->bindParam(2, $_POST["pname"]);
    $stmt->bindParam(3, $_POST["price"]);
    $stmt->bindParam(4, $_POST["typ"]);
    $stmt->bindParam(5, $_POST["fes"]);
    $stmt->execute();
    $filename = $_POST["pid"].".jpg";
    $location = "../../img/".$filename;
    if(move_uploaded_file($_FILES['menuimg']['tmp_name'],$location)){
        header("location:../showmenu.php");
    }
}
?>