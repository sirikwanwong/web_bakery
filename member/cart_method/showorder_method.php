<?php include "../../connect.php"?>
<?php
session_start();
?>
<tr>
    <th>หมายเลขออเดอร์</th>
    <th>วันที่สั่งOrder</th>
    <th>วันที่รับขนม</th>
    <th>ราคารวม</th>
    <th>สถานะการจัดส่ง</th>
    <th>ADD SLIP</th>
</tr>
<?php
if($_GET["page"]!="none"):
$page=$_GET["page"]*5;
$stmt=$pdo->prepare("SELECT หมายเลขออเดอร์,วันที่รับขนม,วันที่สั่งorder,SUM(การสั่งออเดอร์.จำนวนชิ้น*ขนม.ราคาขนม) AS ราคารวม,การจัดส่ง.สถานะการจัดส่ง FROM การสั่งออเดอร์ JOIN ขนม ON การสั่งออเดอร์.รหัสขนม=ขนม.รหัสขนม LEFT JOIN การจัดส่ง ON การสั่งออเดอร์.หมายเลขการจัดส่ง=การจัดส่ง.หมายเลขการจัดส่ง WHERE username = '".$_SESSION["username"]."'  GROUP BY อันดับออเดอร์ LIMIT $page,7");
$stmt->execute();
while($row=$stmt->fetch()):
?>
    <tr>
        <td><a onclick="showorder('<?=$row["หมายเลขออเดอร์"]?>')"><?=$row["หมายเลขออเดอร์"]?></a></td>
        <td><?php
        $temp=explode("-", $row["วันที่สั่งorder"]);
        echo $temp[2]."-".$temp[1]."-".($temp[0]+543);
        ?></td>
        <td><?php
        $temp=explode("-", $row["วันที่รับขนม"]);
        echo $temp[2]."-".$temp[1]."-".($temp[0]+543);
        ?></td>
        <td><?=$row["ราคารวม"]?></td>
        <td><?php
        if($row["สถานะการจัดส่ง"]==null){
        if(file_exists("../../img/payment/".$row['หมายเลขออเดอร์'].".jpg")):?>
        เพิ่มรูปแล้ว
        <?php else:?>
        รอการชำระเงิน
        <?php endif;
        }else{?>
        <?=$row["สถานะการจัดส่ง"]?>
        <?php }?>

    </td>
        <td><?php
        if($row["สถานะการจัดส่ง"]==null):?>
            <form action="./cart_method/upload_payment.php?order=<?=$row["หมายเลขออเดอร์"]?>" method="post" enctype="multipart/form-data"><input type="file" name="file"><input type="submit"></form>
        <?php else:?>
            ชำระแล้ว
        <?php endif;?>
        </td>
    </tr>
<?php endwhile;
else:?>
<tr>
    <td colspan="6">ยังไม่มีรายการสั่งออเดอร์</td>
</tr>
<?php endif;?>