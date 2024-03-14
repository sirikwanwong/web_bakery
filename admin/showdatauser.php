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
        <link rel="stylesheet" href="./admin_css/showdatauser.css">
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
        <?php
        $stmt=$pdo->prepare("SELECT * FROM ลูกค้า WHERE username = ?");
        $stmt->bindParam(1, $_GET["user"]);
        $stmt->execute();
        if($row=$stmt->fetch()):
        ?>
         <article class = "background1">
            <span class = "info">
                USERNAME : <?=$row["username"]?><br><br>
                PASSWORD : <?=$row["password"]?><br>
            </span>
        </article>
        <article class = "background2">
            <span class = "info">
                ชื่อ : <?=$row["ชื่อลูกค้า"]?><br><br>
                เบอร์โทร : <?=$row["เบอร์ลูกค้า"]?><br><br>
                ที่อยู่ : <?=$row["ที่อยู่ลูกค้า"]?><br><br>
            </span>
        </article>
        <?php endif;?>
        <div class = "center">
        <button class = "button_back" type="button" onclick="history.back()">ย้อนกลับ</button>
        </div>
    </body>
</html>