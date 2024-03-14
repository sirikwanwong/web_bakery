<?php
session_start();

if(isset($_GET["action"])){
if($_GET["action"]=="add"){
    $pid=$_GET["pid"];

    $cart_item = array(
        'pid' => $pid,
        'name' => $_GET["name"],
        'price' => $_GET["price"],
        'qty' => $_GET["qty"]
    );
    if(array_key_exists($pid,$_SESSION['cart'])){
        $_SESSION['cart'][$pid]['qty'] += $_GET["qty"];
    }else{
        $_SESSION['cart'][$pid] = $cart_item;
    }
    echo $_GET["name"];
}else if($_GET["action"]=="update"){
    $_SESSION['cart'][$_GET["pid"]]['qty'] = $_GET["qua"];
}else if($_GET["action"]=="delete"){
    unset($_SESSION['cart'][$_GET["pid"]]);
}}
if(isset($_GET["showlist"])){
    ?>
    <tr>
        <th>ชื่อขนม</th>
        <th>ราคาต่อชิ้น</th>
        <th>จำนวน</th>
    </tr>
    <?php 
    $sum=0;
    foreach($_SESSION['cart'] as $item):
    $sum += $item['price'] * $item['qty'];?>
    <tr>
        <td><?=$item["name"]?></td>
        <td><?=$item["price"]?></td>
        <td class="quatity-td"><input type="number" id="<?=$item["pid"]?>" value="<?=$item["qty"]?>" min="1" max="9999" class="quatity-input" onchange="met_update('<?=$item["pid"]?>')"></td>
        <td><a onclick="met_delete('<?=$item["pid"]?>')">ลบ</a></td>
    </tr>
    <?php endforeach;?>
    <tr><td colspan="4">ราคารวม : <?=$sum?> บาท</td></tr>
<?php
}
?>