
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
        <link rel="stylesheet" href="./member_css/contactus.css">
        <script src="script.js" defer></script>
        <script>
            let http = new XMLHttpRequest();
            function send() {
                http.onreadystatechange = show;
                let url = "./cart_method/contact_bn.php";
                http.open("GET", url);
                http.send();
            }
            function show() {
                let admin = document.getElementById("admin");
                if(http.readyState==4 && http.status==200){
                    let obj = JSON.parse(http.responseText);
                    console.log(obj);
                    obj.forEach((item)=>{
                        let d = document.createElement("div");
                        let image = document.createElement("img");
                        let br = document.createElement("br");
                        d.className="img";
                        image.src="../member_photo/"+item.am_username+".jpg";
                        image.width="150";
                        d.appendChild(image);
                        d.appendChild(br);
                        let d2 = document.createElement("div");
                        d2.className="text";
                        d2.innerHTML="ชื่อพนักงาน: "+item.ชื่อพนักงาน+"<br/>เบอร์โทร: "+item.เบอร์พนักงาน+"<br/>";
                        d.appendChild(d2);
                        admin.appendChild(d);
                    });
                }
            }
        </script>
    </head>
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
        <h1>ช่องทางการติดต่อ</h1>
        <h2></h2>
        <article id="admin">
        </article>
        
        <h3></h3>
        <footer class = "background">
            <i class="fa fa-facebook-official" aria-hidden="true"></i>
            <span class = "info">
                EveryBakedBakery
            </span>
            <br> 
            <i class="fa fa-instagram" aria-hidden="true"></i>
            <span class = "info">
                everybaked_bakery
            </span>
            <br>
            <i class="fa fa-phone" aria-hidden="true"></i>
            <span class = "info">
                090-000-0000
            </span>
            <br>
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <span class = "info">
                48 ซอย วัดมัชฌันติการาม,แขวง วงศ์สว่าง เขตบางซื่อ จังหวัดกรุงเทพมหานคร 10800
            </span>
        </footer>
        
        
        
    </body>
</html>
