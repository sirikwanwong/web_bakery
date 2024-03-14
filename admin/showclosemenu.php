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
        <link rel="stylesheet" href="./admin_css/showmenu.css">
    </head>
    <script>
        let http = new XMLHttpRequest();
        function send() {
            http.onreadystatechange = show;
            let npage = document.getElementById("page").value;
            let url = "./admin_method/showclosemenu_bn.php?page="+npage;
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

        function open_menu(pid) {
            if(confirm("ต้องการเปิดรายการขนมรหัส "+pid+" ใช่หรือไม่")==true){
            document.location = "./admin_method/close_open.php?action=open&pid="+pid;
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
        <section class="order">
            <article class="list-contain">
                <header>MENU</header>
                <select id="page" onchange="send()">
                <?php
                $stmt=$pdo->prepare("SELECT COUNT(*) AS cou FROM ขนม WHERE สถานะ='ปิด'");
                $stmt->execute();
                $cou=$stmt->fetch();
                if($cou["cou"]>0):
                $all_page=floor(($cou["cou"]/7)-0.01);
                echo "<script>console.log(".$cou["cou"].")</script>";
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