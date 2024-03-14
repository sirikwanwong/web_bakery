<?php include "connect.php"?>
<?php
session_start();
if(isset($_SESSION["username"])){
    if($_SESSION["role"]=="user"){
        header("location:./member/user_home.php");
    }
    if($_SESSION["role"]=="admin"){
        header("location:./admin/admin_home.php");
    }
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="./main_css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">
    <script>
        let httpReq;
        let uservalid="invalid";
        httpReq = new XMLHttpRequest();
        function user_check(){
            let error = document.getElementById("valid");
            let user = document.getElementById("user").value;
            if(user!=""){
            httpReq.onreadystatechange = display_usercheck;
            let url = "./home_method/lnmethod_checkuser.php?username="+user;
            httpReq.open("GET",url);
            httpReq.send();
            }else{
                uservalid="invalid";
                error.className = "none";
                error.innerHTML = "";
            }
        }
        function display_usercheck(){
            if(httpReq.readyState==4 && httpReq.status==200){   //AJAX
                
                let error = document.getElementById("valid");
                console.log(httpReq.responseText);
               
                if(httpReq.responseText=="notfound-user"){
                    uservalid="invalid" //เกิดเมื่อใส่ username ถูกแล้ว แล้วแก้ให้ผิดอีกรอบ
                    error.innerHTML = "Username not found. Please try again";
                    error.className = "wrong";
                }else{
                    if(httpReq.responseText=="found-user"){
                        uservalid="valid";
                        error.className = "none";
                        error.innerHTML = "";
                    }
                }
                console.log(uservalid);
            }
        }
        function login_check(){
            console.log("login_check");
            console.log(uservalid);
            if(uservalid == "valid"){
                let user = document.getElementById("user").value;
                let pass = document.getElementById("pass").value;
                // console.log("user  "+user);
                // console.log("pass  "+pass);
                httpReq.onreadystatechange = display_err;
                let url = "./home_method/lnmethod_login.php?username="+user+"&password="+pass;
                httpReq.open("GET",url);
                httpReq.send();
            }else{
                let error = document.getElementById("valid");
                error.innerHTML = "Username not found. Please try again";
                error.className = "wrong";
            }
        }
        function display_err(){
            // console.log("httpReq.responseText  "+httpReq.responseText);
            if(httpReq.readyState==4 && httpReq.status==200){
                if(httpReq.responseText=="invalid-password"){
                    let error = document.getElementById("valid");
                    error.innerHTML = "Wrong Password. Please try again";
                    error.className = "wrong";
                }else{
                    if(httpReq.responseText=="valid"){
                        document.location = "./home_method/split_page.php";
                    }
                }
            }
        }   
    </script>
</head>
<body>
    <header class="logo">
        everyday-baked-bakery
    </header>
    <section class="login-box">
        <article class="login-body">
            <div id="valid" class="valid"></div>
                Username : <input type="text" name="username" id="user" onblur="user_check()"><br>
                Password : <input type="password" name="password" id="pass"><br>
                <input type="button" class="submit" value="Login" onclick="login_check()">
            <hr>
            Need an account? <a href="./register.html">Register</a>
        </article>
    </section>
</body>
</html>