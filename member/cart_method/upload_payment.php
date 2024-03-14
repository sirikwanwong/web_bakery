<?php include "../../connect.php"?>
<?php
if($_FILES['file']['tmp_name']!=""){
    $filename = $_GET["order"].".jpg";
    $location = "../../img/payment/".$filename;
    // echo $location;
    move_uploaded_file($_FILES['file']['tmp_name'],$location);
    header("location:../showorder.php");
}
?>