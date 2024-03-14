<?php include "../../connect.php"?>
<?php
$stmt = $pdo->prepare("SELECT ชื่อพนักงาน,เบอร์พนักงาน,am_username FROM พนักงาน");
$stmt->execute();
$data = array();
while($row = $stmt->fetch()){
    $item = array();
    $item['am_username']=$row['am_username'];
    $item['ชื่อพนักงาน']=$row['ชื่อพนักงาน'];
    $item['เบอร์พนักงาน']=$row['เบอร์พนักงาน'];
    array_push($data,$item);
    unset($item);
}
echo json_encode($data);
?>