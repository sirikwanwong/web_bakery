<?php include "../../connect.php"?>
<?php
$page=$_GET["page"]*5;?>
<tr>
    <th>หมายเลขออเดอร์</th>
    <th>วันที่สั่งOrder</th>
    <th>วันที่รับขนม</th>
    <th>รูปPayment</th>
    <th>หมายเลขการจัดส่ง</th>
    <th>STATUS</th>
    <th>UPDATE STATUS</th>
</tr>
<?php
$stmt=$pdo->prepare("SELECT DISTINCT username,หมายเลขออเดอร์,วันที่รับขนม,วันที่สั่งorder,สถานะการจัดส่ง,การจัดส่ง.หมายเลขการจัดส่ง FROM การสั่งออเดอร์ LEFT JOIN การจัดส่ง ON การสั่งออเดอร์.หมายเลขการจัดส่ง=การจัดส่ง.หมายเลขการจัดส่ง ORDER BY อันดับออเดอร์ DESC  LIMIT $page,5");
$stmt->execute();
while($row=$stmt->fetch()):
?>
<tr class="show">
    <td><a href="./userorder_sub.php?user=<?=$row["username"]?>&order=<?=$row["หมายเลขออเดอร์"]?>"><?=$row["หมายเลขออเดอร์"]?></a></td>
    <td><?php
    $temp=explode("-", $row["วันที่สั่งorder"]);
    echo $temp[2]."-".$temp[1]."-".($temp[0]+543);
    ?></td>
    <td><?php
    $temp=explode("-", $row["วันที่รับขนม"]);
    echo $temp[2]."-".$temp[1]."-".($temp[0]+543);
    ?></td>
    <td><a class="payment" href="./showorder_sub.php?หมายเลขออเดอร์=<?=$row["หมายเลขออเดอร์"]?>">ดู</a></td>
    <td><?php
    if($row["หมายเลขการจัดส่ง"]==null):?>
        <form action="./admin_method/check_track.php" method="post">
        <input type="hidden" name="norder" value="<?=$row["หมายเลขออเดอร์"]?>">
        <input type='text' name="ntrack" pattern="[A-Za-z0-9]{10,16}" id="iptracking_<?=$row["หมายเลขออเดอร์"]?>" onblur="check_tracking('<?=$row["หมายเลขออเดอร์"]?>')"><input type='hidden' id="submitbt_<?=$row["หมายเลขออเดอร์"]?>"></form>
    <?php else:?>
        <?=$row["หมายเลขการจัดส่ง"]?>
    <?php endif;?></td>
    
    <td><?php
    if($row["สถานะการจัดส่ง"]==null){
        echo "รอการยืนยัน";
    }else{
        echo $row["สถานะการจัดส่ง"];
    }?></td>
    <td><?php
    if($row["สถานะการจัดส่ง"]==null):?>
        -
    <?php else: ?>
        <select id="sta_<?=$row['หมายเลขการจัดส่ง']?>">
            <option value="กำลังจัดเตรียม">กำลังจัดเตรียม</option>
            <option value="รอการจัดส่ง">รอการจัดส่ง</option>
            <option value="อยู่ระหว่างการจัดส่ง">อยู่ระหว่างการจัดส่ง</option>
            <option value="จัดส่งเรียบร้อย">จัดส่งเรียบร้อย</option>
        </select>
        <a class="OK" onclick="upd_status('<?=$row['หมายเลขการจัดส่ง']?>')">OK</a>
    <?php endif;?></td>
</tr>
<?php  endwhile;?>
