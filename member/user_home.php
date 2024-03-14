<?php include "../connect.php"?>
<?php
session_start();
if(!isset($_SESSION["username"])){ //check ว่า login แล้วหรือยัง
    header("location:../home.php");
}
if(!isset($_SESSION["cart"])){ //check ว่าตะกร้าว่าหรือไม่
    $_SESSION["cart"] = array();
}
?>
<html>
    <head>
        <title>Everyday Baked Bakery</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./member_css/home.css">
        <link rel="stylesheet" href="./member_css/card.css">
        <script src="script.js" defer></script>
    </head>
    <style>
        
    </style>
    <script>
        function add_quatity(x){
            let qua = document.getElementById("quatity_"+x);
            let value = parseInt(qua.value);
            console.log(qua);
            if(value < 1){
                console.log("value "+value);
                qua.value = 1;
            }
            if(value >= 1){
            value +=1;
            console.log("value + 1"+value);
            qua.value = value;
            }
        }
        function del_quatity(x){
            let qua = document.getElementById("quatity_"+x);
            let value = parseInt(qua.value);
            console.log(qua);
            if(value < 1){
                console.log("value "+value);
                qua.value = 1;
            }
            if(value > 1){
                value -=1;
            }
            console.log("value - 1"+value);
            qua.value = value;
        }
        let http = new XMLHttpRequest();
        function add(pid,ipname,ipprice,ipqty){
            let name = document.getElementById(ipname).value;
            let price = document.getElementById(ipprice).value;
            let qty = document.getElementById(ipqty).value;
            if(qty>0){
                http.onreadystatechange = result;
                let url = "./cart_method/cart.php?action=add&pid="+pid+"&name="+name+"&price="+price+"&qty="+qty;
                http.open("GET",url);
                http.send();
            }else{
                alert("จำนวนขนมที่สั่งไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง");
            }
        }
        function result(){
            if(http.readyState==4 && http.status==200){
                alert("เพิ่มขนม "+http.responseText+" เรียบร้อย");
            }
        }
    </script>
    <body>
        <header class="logo">everyday-baked-bakery
            <!-- bar for mobile -->
            <a href="#" class="toggle-button">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </a>
            <!-- bar for mobile -->
        </header>
        <nav class= "allbutton">
            <div class="button">
                <ul>
                    <li><a href="./user_home.php">HOME</a></li>
                    <li><a href="./menu.php">MENU</a></li>
                    <li><a href="./contactus.php">CONTACT US</a></li>
                    <li><a href="./basket.php" class="cart-button">BASKET </a></li>
                    <li><a class="user" href="#" >User : <?=$_SESSION["username"]?></a>
                    <ul>
                        <li><a href="./edit_profile.php">แก้ไขข้อมูลส่วนตัว</a></li>
                        <li><a href="./showorder.php">ประวัติการสั่งซื้อ</a></li>
                        <li><a href="./cart_method/logout.php">LOGOUT</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <section>
            <article class="card-content">
                <header>8 Recommended Menus</header>
                <?php
                $stmt=$pdo->prepare("SELECT ขนม.รหัสขนม,ชื่อขนม,ชนิดขนม,ประเภทตามเทศกาล,ราคาขนม,SUM(การสั่งออเดอร์.จำนวนชิ้น) AS จำนวนที่ถูกสั่ง 
                                    FROM การสั่งออเดอร์ JOIN ขนม ON การสั่งออเดอร์.รหัสขนม=ขนม.รหัสขนม 
                                    WHERE สถานะ='เปิด' GROUP BY ขนม.รหัสขนม ORDER BY จำนวนที่ถูกสั่ง DESC 
                                    LIMIT 0,8");
                $stmt->execute();
                $x=0;
                while($row=$stmt->fetch()):
                ?>
                    <div class="card">
                        <img src="../img/<?=$row["รหัสขนม"]?>.jpg" style="width:100%">
                        <input type="hidden">
                        <p class="name-menu"><?=$row["ชื่อขนม"]?></p>
                        <p class="dt_menu">ประเภท : <?=$row["ประเภทตามเทศกาล"]?><br></p>
                        <p class="dt_menu">ราคา : <?=$row["ราคาขนม"]?><br></p>
                        <p class="dt_menu">สถิติ : <?=$row["จำนวนที่ถูกสั่ง"]?><br></p>
                        <div class="quatity-button">
                            <input type="hidden" id="<?=$row["รหัสขนม"];?>" value="<?=$row["รหัสขนม"]?>">
                            <input type="hidden" id="<?=$row["รหัสขนม"]."_name";?>" value="<?=$row["ชื่อขนม"]?>">
                            <input type="hidden" id="<?=$row["รหัสขนม"]."_price";?>" value="<?=$row["ราคาขนม"]?>">
                            <button onclick="del_quatity(<?=$x?>)">-</button>
                            <input type="text" class="qty-cart" id="<?="quatity_".$x;?>" name="quatity" value="1" min="1">
                            <button onclick="add_quatity(<?=$x?>)">+</button>
                            <a class="order" onclick="add('<?=$row["รหัสขนม"];?>','<?=$row["รหัสขนม"]."_name";?>','<?=$row["รหัสขนม"]."_price";?>','<?="quatity_".$x;?>')">Order</a>
                        </div>
                    </div>
                <?php $x++;
            endwhile;?>
            </article>
        </section>
    </body>
</html>