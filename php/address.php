<?php
$key = $_POST['key'];  //获取值
require_once('config.php');
$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
$sql = "SELECT * FROM geocities WHERE Country_RegionCodeISO=$key LIMIT 6  ";
$statement = $pdo->query($sql);
$x = 0;
while ($row = $statement->fetch()) {
    $address[$x] = $row['AsciiName'];
    $x++;
}

if(!empty($address)){ //有值，组装数据
    $result['status'] = 200;
    $result['data'] = $address;
}else{  //无值，返回状态码220
    $result['status'] = 220;
}


echo json_encode($result);  //返回JSON数据
?>

