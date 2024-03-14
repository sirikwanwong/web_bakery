<?php include "../connect.php"?>
<?php
session_start();
if(!isset($_SESSION["username"])){ //check ว่า login แล้วหรือยัง
    header("location:../home.php");
}
if($_SESSION["role"]=="user"){
    header("location:../member/user_home.php");
}
?>
<html>
    <head>
        <title>Everyday Baked Bakery</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <script src="script.js" defer></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./admin_css/home.css">
        <link rel="stylesheet" href="./admin_css/userorder.css">
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
                    <li><a href="./admin_home.php">MOST BUY</a></li>
                    <li><a href="./showuser.php">USER</a></li>
                    <li><a href="./showmenu.php">MENU</a></li>
                    <li><a href="./showorder.php">ORDER </a></li>
                    <li><a href="#" >ADMIN : <?=$_SESSION["username"]?> +</a>
                    <ul>
                        <li><a href="./showclosemenu.php">CLOSE MENU</a></li>
                        <li><a href="./admin_method/logout.php">LOGOUT</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <section>
            <article class="most-contain">
                <header>USER THE MOST BUY</header>
                <table>
                    <tr>
                        <th>อันดับ</th>
                        <th>Username</th>
                        <th>ชื่อลูกค้า</th>
                        <th>จำนวนเงิน</th>
                    </tr>
                <?php
                $stmt=$pdo->prepare("SELECT ชื่อลูกค้า,ลูกค้า.username,SUM(การสั่งออเดอร์.จำนวนชิ้น*ขนม.ราคาขนม) AS จำนวนเงินสูงสุด FROM การสั่งออเดอร์ JOIN ลูกค้า ON การสั่งออเดอร์.username=ลูกค้า.username JOIN ขนม ON ขนม.รหัสขนม=การสั่งออเดอร์.รหัสขนม GROUP BY username ORDER BY จำนวนเงินสูงสุด DESC");
                $stmt->execute();
                for($x=1;$x<=5;$x++):
                    $row=$stmt->fetch();
                ?>
                    <tr class="showorder">
                        <td class="number"><?=$x?></td>
                        <td><a href="./userorder.php?user=<?=$row["username"]?>"><?=$row["username"]?></a></td>
                        <td><?=$row["ชื่อลูกค้า"]?></td>
                        <td><?=$row["จำนวนเงินสูงสุด"]?></td>
                    </tr>
                <?php endfor;?>
                </table>
            </article>
        </section>
    </body>
</html>