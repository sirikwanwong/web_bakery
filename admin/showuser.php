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
        <link rel="stylesheet" href="./admin_css/showuser.css">
        <script>
            let http = new XMLHttpRequest();
            function showpage() {
                http.onreadystatechange = show;
                let npage = document.getElementById("page").value;
                console.log(npage);
                let url = "./admin_method/showuser_bn.php?page="+npage;
                http.open("GET", url);
                http.send();
            }
            function show(){
                let sh = document.getElementById("list");
                if(http.readyState==4 && http.status==200){
                    sh.innerHTML = http.responseText;
                }
            }
            function del_user(user){
                document.location = "./admin_method/showuser_bn.php?action=delete&user="+user;
            }
        </script>
    </head>
    
    <body onload="showpage()">
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
            <article class="list-contain">
                <header>USER</header>
                <select id="page" onchange="showpage()">
                <?php
                $stmt=$pdo->prepare("SELECT DISTINCT COUNT(*) AS cou FROM ลูกค้า");
                $stmt->execute();
                $cou=$stmt->fetch();
                if($cou["cou"]):
                $all_page=floor(($cou["cou"]/7)-0.01);
                for($x=0;$x<=$all_page;$x++):?>
                    <option value="<?=$x?>">Page <?=$x+1?></option>
                <?php endfor;
                else:?>
                    <option value="none">Page 1</option>
                <?php endif;?>
                </select>
                <div id="list"></div>
            </article>
        </section>
    </body>
</html>