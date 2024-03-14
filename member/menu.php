<?php include "../connect.php"?>
<?php
session_start();
if(!isset($_SESSION["username"])){ 
    header("location:../home.php");
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
        <link rel="stylesheet" href="./member_css/menu.css">
        <link rel="stylesheet" href="./member_css/card.css">
        <script src="script.js" defer></script>
    </head>
    <script>
        let http = new XMLHttpRequest();
        function send(){
            http.onreadystatechange = show;
            let name = document.getElementById("menuname").value;
            let festival = document.getElementById("festival").value;
            let n = name.replace(/ +/g, ' ');
            let url;
            if(n==" " || n==""){
                url = "./cart_method/menu_be.php?festival="+festival;
            }else{
                url = "./cart_method/menu_be.php?name="+n+"&festival="+festival;
            }
            http.open("GET",url);
            http.send();
        }
        function show() {
            if(http.readyState==4 && http.status==200){
                console.log("bn "+http.responseText);
                let dessert = document.getElementById("showlist");
                dessert.innerHTML = http.responseText;
            }
        }
        function add_quatity(x){
            let qua = document.getElementById("quatity_"+x);
            let value = parseInt(qua.value);
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
            if(value < 1){
                console.log("value "+value);
                qua.value = 1;
            }
            if(value > 1){
            value -=1;
            console.log("value - 1"+value);
            qua.value = value;
            }
        }
        function add(pid,ipname,ipprice,ipqty){
            let name = document.getElementById(ipname).value;
            let price = document.getElementById(ipprice).value;
            let qty = document.getElementById(ipqty).value;
            http.onreadystatechange = result;
            let url = "./cart_method/cart.php?action=add&pid="+pid+"&name="+name+"&price="+price+"&qty="+qty;
            http.open("GET",url);
            http.send();
        }
        function result(){
            if(http.readyState==4 && http.status==200){
                alert("เพิ่มขนม "+http.responseText+" เรียบร้อย");
            }
        }
    </script>
    <body onload="send()">
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
            <article class="input">
                ชื่อขนม <input type="text" placeholder="ใส่ชื่อขนม" id="menuname" name="menuname" onchange="send()">
                ประเภท <select name="festival" id="festival" onchange="send()">
                    <option value="all">ทั้งหมด</option>
                    <?php
                    $stmt=$pdo->prepare("SELECT DISTINCT `ประเภทตามเทศกาล` FROM `ขนม`");
                    $stmt->execute();
                    while($row=$stmt->fetch()):
                    ?>
                    <option value="<?=$row["ประเภทตามเทศกาล"]?>"><?=$row["ประเภทตามเทศกาล"]?></option>
                    <?php endwhile;?>
                </select>
            </article>
            <article class="card-content" id="showlist"> 
            </article>
        </section>
    </body>
</html>