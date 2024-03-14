<?php include "../../connect.php"?>
<?php
if($_GET["page"]!="none"):
$page=$_GET["page"]*7;?>
<tr>
    <th>รหัสขนม</th>
    <th>ชื่อขนม</th>
    <th>ราคาขนม</th>
    <th>ชนิดขนม</th>
    <th>ประเภท</th>
    <th colspan="2">option</th>
</tr>
<?php
$stmt=$pdo->prepare("SELECT * FROM ขนม WHERE สถานะ = 'เปิด' LIMIT $page,7");
$stmt->execute();
if($_GET["page"]==0):?>
<tr><td colspan="7" onclick="addmenu()" class="addmenu">+</td></tr>
<?php endif;
while($row=$stmt->fetch()):
?>
    <tr>
        <td><?=$row["รหัสขนม"]?></td>
        <td><?=$row["ชื่อขนม"]?></td>
        <td><?=$row["ราคาขนม"]?></td>
        <td><?=$row["ชนิดขนม"]?></td>
        <td><?=$row["ประเภทตามเทศกาล"]?></td>
        <td><a class="menubt" onclick="edi_menu('<?=$row["รหัสขนม"]?>')">แก้ไข</a></td>
        <td><a class="menubt" onclick="close_menu('<?=$row["รหัสขนม"]?>')">ปิด</a></td>
    </tr>
<?php endwhile;
else:?>
    <tr>
        <th colspan="7">ไม่มีรายการขนมที่ถูกเปิด</th>
    </tr>
<?php endif;?>