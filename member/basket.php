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
        <link rel="stylesheet" href="./member_css/basket.css">
        <script src="script.js" defer></script>
        <script>
        let http = new XMLHttpRequest();
        window.onload = function() {//คำนวณราคาเมื่อมีการเปิดหน้าตะกร้า
            http.onreadystatechange = sum;
            let url = "./cart_method/cart.php?showlist=true";
            http.open("GET",url);
            http.send();
        }
        function met_update(pid){
            console.log(pid);
            http.onreadystatechange = sum;//คำนวณราคาเมื่อมีการ update จำนวนการสั่ง Order
            let qua = document.getElementById(pid).value;
            console.log(qua);
            let url = "./cart_method/cart.php?showlist=true&action=update&pid="+pid+"&qua="+qua;
            http.open("GET",url);
            http.send();
        }
        function sum(){//แสดงราคาเมื่อคำนวณเรียบร้อย
            if(http.readyState == 4 && http.status == 200){
                let res = document.getElementById("list-basket");
                // console.log(http.responseText);
                res.innerHTML = http.responseText;
            }
        }
        function met_delete(pid){//ลบรายการขนมที่ไม่ต้องการ
            console.log(pid);
            http.onreadystatechange = sum;//คำนวณราคาเมื่อมีการลบขนมใน Order
            let qua = document.getElementById(pid).value;
            console.log(qua);
            let url = "./cart_method/cart.php?showlist=true&action=delete&pid="+pid;
            http.open("GET",url);
            http.send();
        }
        let payment="Prompt_pay";
        function radiochange(a){
            payment = document.getElementById(a).value;
            let set = document.getElementById("showpayment");
            if(payment=="Prompt_pay"){
                set.innerHTML = '<img src="../img/payment/Prompt_pay.jpg" width="50%">';
            }else{
                set.innerHTML = '<b>ธนาคาร กสิกรไทย <br>เลขที่บัญชี : 123-4-56789-1 <br>ชื่อบัญชี : every baked bakery</b>';
            }
        }
        function order_submit(){ //ทำงานเมื่อกดยืนยันการสั่ง
            let get_date = document.getElementById("get_date").value;
            let date = new Date();
            let nowdate = date.toISOString().split('T')[0];                                 //หาวันที่ในวันที่สั่งขนม
            date.setDate(date.getDate()+7);                                                 //เปลี่ยนวันที่ไปอีก 7 วัน
            let newdate = date.toISOString().split('T')[0];                                 //เอาวันที่อีก 7 วันข้างหน้า
            if(get_date!="" && get_date > nowdate && get_date >= newdate){
                // console.log("pass");
                <?php
                $stmt=$pdo->prepare("SELECT DISTINCT อันดับออเดอร์ FROM การสั่งออเดอร์ ORDER BY อันดับออเดอร์ DESC");
                $stmt->execute();
                $row=$stmt->fetch();
                echo "let order = ".$row["อันดับออเดอร์"].";";
                echo "let countarr = ".count($_SESSION['cart']).";";                        //นับ Array ของ SESSION['cart']
                ?>
                let no_order = order + 1;
                let orderid="";
                if(parseInt(no_order/10)== 0){
                    orderid = "OD00"+no_order;
                }else if(parseInt(no_order/100)==0){
                    orderid = "OD0"+no_order;
                }else{
                    orderid = "OD"+no_order;
                }
                if(countarr > 0){
                document.location = "./cart_method/submit.php?no_order="+no_order+"&orderid="+orderid+"&od_date="+nowdate+"&get_date="+get_date+"&payment="+payment;
                }else{
                    alert("กรุณาเลือกรายการขนมก่อนที่จะกดสั่งออเดอร์");
                }
            }else{
                let err = document.getElementById("error");
                err.className = "wrong";
            }

        }
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
        <section class="order">
            <header>ORDER</header>
            <article class="basket-table">
            <table id="list-basket">
            </table>
            <fieldset class="other">
                <legend>ช่องทางการชำระเงิน</legend>
                <input id="payment2" name="payment" type="radio" value="Prompt_pay" onclick="radiochange(id)" checked>Prompt pay
                <input id="payment3" name="payment" type="radio" value="Internet Banking" onclick="radiochange(id)">Internet Banking
                <div id="showpayment"><img src="../img/payment/Prompt_pay.jpg" width="50%"></div>
            </fieldset>
            <fieldset class="other">
                <legend>วันที่ต้องการรับขนม</legend>
                <div id="error">*กรุณาใส่วันที่รับขนมก่อนนับจากวันสั่งอย่างน้อย 7 วัน</div>
                <input type="date" id="get_date" value="">
                
            </fieldset>
            
            <button onclick="order_submit()" class="accept">ยืนยัน</button>
            </article>
        </section>
    </body>
</html>