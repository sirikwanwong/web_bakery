<?php session_start();
if($_SESSION["role"]=="user"){
    header("location:../member/user_home.php");
}elseif($_SESSION["role"]=="admin"){
    header("location:../admin/admin_home.php");
}

?>