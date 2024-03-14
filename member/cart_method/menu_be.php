<?php include "../../connect.php"?>
<?php
$fes = $_GET["festival"];
$stmt;
$count;
$text;if($fes=="all" && empty($_GET["name"])){      //เมื่อเลือกประเภทขนมเป็นทั้งหมดแต่ไม่ได้ใส่ชื่อขนม
    $stmt=$pdo->prepare("SELECT * FROM ขนม WHERE สถานะ = 'เปิด'");
    $stmt->execute();
}else if($fes=="all" && !empty($_GET["name"])){     //เมื่อเลือกประเภทขนมเป็นทั้งหมดและใส่ชื่อขนม
    $name = $_GET["name"];
    $stmt=$pdo->prepare("SELECT * FROM ขนม WHERE ชื่อขนม LIKE '%".$name."%' AND สถานะ = 'เปิด'");
    $stmt->execute();
}else if($fes!="all" && empty($_GET["name"])){       //เมื่อเลือกประเภทขนมอื่นๆที่ไม่ใช่ทั้งหมดแต่ไม่ใส่ชื่อขนม
    $stmt=$pdo->prepare("SELECT * FROM ขนม WHERE ประเภทตามเทศกาล='".$fes."' AND สถานะ = 'เปิด'");
    $stmt->execute();
}else if($fes!="all" && !empty($_GET["name"])){     //เมื่อเลือกประเภทขนมอื่นๆที่ไม่ใช่ทั้งหมดและใส่ชื่อขนม
    $name = $_GET["name"];
    $stmt=$pdo->prepare("SELECT * FROM ขนม WHERE ประเภทตามเทศกาล='".$fes."' AND ชื่อขนม LIKE '%".$name."%' AND สถานะ = 'เปิด'");
    $stmt->execute();
}
$x=0;

if($row=$stmt->fetch()):
do{
?>
<div class="card">
    <img src="../img/<?=$row["รหัสขนม"]?>.jpg" style="width:100%">
    <p class="name-menu"><?=$row["ชื่อขนม"]?></p>
    <p class="dt_menu">ประเภท : <?=$row["ประเภทตามเทศกาล"]?><br></p>
    <p class="dt_menu">ราคา : <?=$row["ราคาขนม"]?><br></p>
    <div class="quatity-button">
        <input type="hidden" id="<?=$row["รหัสขนม"];?>" value="<?=$row["รหัสขนม"]?>">
        <input type="hidden" id="<?=$row["รหัสขนม"]."_name";?>" value="<?=$row["ชื่อขนม"]?>">
        <input type="hidden" id="<?=$row["รหัสขนม"]."_price";?>" value="<?=$row["ราคาขนม"]?>">
        <button onclick="del_quatity(<?=$x?>)">-</button><input type="text" class="qty-cart" id="<?="quatity_".$x;?>" name="quatity" value="1"><button onclick="add_quatity(<?=$x?>)">+</button>
        <a class="order" onclick="add('<?=$row["รหัสขนม"];?>','<?=$row["รหัสขนม"]."_name";?>','<?=$row["รหัสขนม"]."_price";?>','<?="quatity_".$x;?>')">Order</a>
    </div>
</div>
<?php 
$x+=1;
}while($row=$stmt->fetch());
else:?>
    <div>ไม่พบรายการขนมที่ค้นหา</div>
<?php
endif;

?>