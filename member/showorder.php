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
        <link rel="stylesheet" href="./member_css/showorder.css">
        <script src="script.js" defer></script>
    </head>
    <script>
        function showorder(order){
            console.log(order);
            document.location = "./showorder_sub.php?order="+order;
        }

        let http = new XMLHttpRequest();
        function send() {
            http.onreadystatechange = show;
            let npage = document.getElementById("page").value;
            let url = "./cart_method/showorder_method.php?page="+npage;
            http.open("GET", url);
            http.send();
        }

        function show() {
            let sh = document.getElementById("list");
            if(http.readyState==4 && http.status==200){
                console.log(http.responseText);
                sh.innerHTML = http.responseText;
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
        <section class="order">
            <article class="list-contain">
                <select id="page" onchange="send()">
                <?php
                $stmt=$pdo->prepare("SELECT DISTINCT COUNT(`หมายเลขออเดอร์`) AS cou FROM การสั่งออเดอร์ WHERE username='".$_SESSION["username"]."' GROUP BY `หมายเลขออเดอร์`");
                $stmt->execute();
                $cou=$stmt->fetch();
                if($cou["cou"]>0):
                $all_page=floor(($cou["cou"]/5)-0.01);
                for($x=0;$x<=$all_page;$x++):?>
                    <option value="<?=$x?>">Page <?=$x+1?></option>
                <?php endfor;
                else:?>
                    <option value="none">Page 1</option>
                <?php endif;?>
                </select>
                <table id="list"></table>
            </article>
        </section>
    </body>
</html>