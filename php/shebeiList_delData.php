<?php
// 获取到发送过来的usrid
$usrid = $_POST['usrid'];
//echo $time;
$link = mysql_connect('127.0.0.1', 'root', '123');
if (!$link) {
die('Not connected : ' . mysql_error());
}

// make foo the current db
$db_selected = mysql_select_db('mytest', $link);

$sql = mysql_query("delete from device where usrid='$usrid'");
$sql = mysql_query("delete from Modbus where usrid='$usrid'");

if($sql){
    echo "1";
}else{
    echo "2";
}
?>
