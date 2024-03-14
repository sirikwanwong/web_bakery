<?php include "../connect.php"?>
<?php
session_start();
if(!isset($_SESSION["username"])){ //check ว่า login แล้วหรือยัง
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
        <link rel="stylesheet" href="./member_css/showorder.css">
        <script src="script.js" defer></script>
    </head>
    <script>
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
        <section class="order">
        <article class="order-table">
            <a href="./showorder.php">&#8920; ไปหน้าประวัติการสั่งซื้อ</a>
            <table>
                <tr>
                    <th>หมายเลขออเดอร์</th>
                    <th>ชื่อขนม</th>
                    <th>จำนวนชิ้น</th>
                    <th>ราคารวม</th>
                </tr>
            <?php
            // echo "<p>".$_GET["order"]."</p>";
            $stmt=$pdo->prepare("SELECT หมายเลขออเดอร์,ชื่อขนม,จำนวนชิ้น,วันที่สั่งOrder,วันที่รับขนม,ประเภทการชำระเงิน,SUM(การสั่งออเดอร์.จำนวนชิ้น*ขนม.ราคาขนม) AS ราคารวม FROM การสั่งออเดอร์ JOIN ขนม ON การสั่งออเดอร์.รหัสขนม=ขนม.รหัสขนม  WHERE หมายเลขออเดอร์= '".$_GET["order"]."' GROUP BY ขนม.ชื่อขนม");
            $stmt->execute();
            while($row=$stmt->fetch()):
            ?>
                <tr>
                    <td><?=$row["หมายเลขออเดอร์"]?></td>
                    <td><?=$row["ชื่อขนม"]?></td>
                    <td><?=$row["จำนวนชิ้น"]?></td>
                    <td><?=$row["ราคารวม"]?></td>
                </tr>
            <?php endwhile;?>
            </table>
            </article>
        </section>
    </body>
</html>