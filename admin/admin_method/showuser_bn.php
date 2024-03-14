<?php include "../../connect.php"?>
<?php
if(isset($_GET["action"]) && $_GET["action"]=='delete'){
    $deluser=$pdo->prepare("DELETE FROM ลูกค้า WHERE username='".$_GET["user"]."'");
    $deluser->execute();
    $delorder=$pdo->prepare("DELETE FROM การสั่งออเดอร์ WHERE username='".$_GET["user"]."'");
    $delorder->execute();
    header("location:../showuser.php");
}
if($_GET["page"]!="none"):
$page=$_GET["page"]*7;
$stmt=$pdo->prepare("SELECT * FROM ลูกค้า LIMIT $page,7");
$stmt->execute();
while($row=$stmt->fetch()):
?>
    <div class="showuser">
        <span class="shusername"><?=$row["username"]?> (<?=$row["ชื่อลูกค้า"]?>)</span>
        <a class="del" onclick="del_user('<?=$row["username"]?>')">ลบ</a>
        <a class="his" href="./userorder.php?user=<?=$row["username"]?>">ประวัติการซื้อ</a>
        <a class="info" href="./showdatauser.php?user=<?=$row["username"]?>">ข้อมูลลูกค้า</a>
        
    </div>
<?php endwhile;
else:?>
    <div class="showuser">
        ไม่มีรายการผู้ใช้
    </div>
<?php endif;?>