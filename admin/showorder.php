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
        <link rel="stylesheet" href="./admin_css/showorder.css">
        <script>
            let http = new XMLHttpRequest();
            function send() {
            http.onreadystatechange = show;
            let npage = document.getElementById("page").value;
            let url = "./admin_method/showorder_bn.php?page="+npage;
            http.open("GET", url);
            http.send();
        }

        function show() {
            let sh = document.getElementById("list");
            if(http.readyState==4 && http.status==200){
                // console.log(http.responseText);
                sh.innerHTML = http.responseText;
            }
        }
        
        function upd_status(orderid){
            let value = document.getElementById("sta_"+orderid).value;
            console.log(value);
            console.log("orderid : "+orderid);
            if(confirm("ต้องการ Update สถานะการจัดส่งเป็น '"+value+"' ของหมายเลขการจัดส่ง '"+orderid+"' ใช่หรือไม่")==true){
                document.location = "./admin_method/update_delivery.php?orderid="+orderid+"&stat="+value;
            }
        }
        let order;
        function check_tracking(iptrack) {
            order = iptrack;
            http.onreadystatechange = res_tracking;
            console.log(order);
            console.log("iptracking_"+order);
            let value = document.getElementById("iptracking_"+order).value;
            let url = "./admin_method/check_track.php?action=check&tracking="+value;
            http.open("GET", url);
            http.send();
        }
        function res_tracking() {
            let inp = document.getElementById("iptracking_"+order);
            let sho = document.getElementById("submitbt_"+order);
            if(http.readyState==4 && http.status==200){
                console.log(http.responseText);
                if(http.responseText=="pass"){
                    sho.type="submit";
                    inp.className="pass";
                }else{
                    sho.type="hidden";
                    inp.className="wrong";
                }
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
            <article class="all-contain">
                <header>MANAGE ORDER</header>
                <select id="page" onchange="send()">
                <?php
                $stmt=$pdo->prepare("SELECT COUNT(DISTINCT `อันดับออเดอร์`) AS cou FROM การสั่งออเดอร์");
                $stmt->execute();
                $cou=$stmt->fetch();
                $all_page=floor(($cou["cou"]/5)-0.01);
                for($x=0;$x<=$all_page;$x++):?>
                    <option value="<?=$x?>">Page <?=$x+1?></option>
                <?php endfor;?>
                </select>
                <table id="list"></table>
            </article>
        </section>
</body>
</html>