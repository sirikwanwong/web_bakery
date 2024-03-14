<?php include "../connect.php";
session_start();
if(!isset($_SESSION["username"])){
    header("location:../home.php");
}
?>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Everyday Baked Bakery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./member_css/home.css">
    <link rel="stylesheet" href="./member_css/edit_profile.css">
    <script src="script.js" defer></script>
    <style>
    </style>
    <script>
    </script>
    </head>
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
    <section class="edit-box">
        <?php
        $stmt=$pdo->prepare("SELECT * FROM ลูกค้า WHERE username='".$_SESSION["username"]."'");
        $stmt->execute();
        $row=$stmt->fetch();
        ?>
        <form action="./cart_method/submit_edit.php" method="post">
        <input type="hidden" name="username" value="<?=$row["username"]?>">
            Name : <input type="text" name="ชื่อลูกค้า" placeholder="ชื่อภาษาไทย" pattern="(([A-Z]|[a-z])[a-z]{,19}|^[ก-๏]{2,19})" value="<?=$row["ชื่อลูกค้า"]?>" required> * <br>
            Tel : <input type="text" name="เบอร์ลูกค้า" placeholder="081-2345678" pattern="0[0-9]{2}-[0-9]{7}" value="<?=$row["เบอร์ลูกค้า"]?>" required> * <br>
            <span class="input-address">Address : <textarea name="ที่อยู่ลูกค้า" required><?=$row["ที่อยู่ลูกค้า"]?></textarea> * </span><br>
            <div class="submit-box"><input class="submit" type="submit" value="Change"></div>
        </form>
    </section>
    </body>
</html>