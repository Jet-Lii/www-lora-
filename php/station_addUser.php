<?php
  $usrid = $_POST['usrid'];
  $type = $_POST['type'];
  $mode = $_POST['mode'];

  $link = mysql_connect('127.0.0.1', 'root', '123');
  if (!$link) {
  die('Not connected : ' . mysql_error());
  }
  // make foo the current db
  $db_selected = mysql_select_db('mytest', $link);
  if (!$db_selected) {
  die ('Can\'t use foo : ' . mysql_error());
  }

  $sql = mysql_query("select * from device where usrid='$usrid'");
  $row_sql = mysql_fetch_assoc($sql);
  if($row_sql){
    echo "1";
  }else{
  	$result = mysql_query("insert into device(usrid,type,mode,status,baud,DataBit,CheckBit,StopBit) values('$usrid','$type','$mode',0,'115200',8,0,10)");
  	// $result = mysql_query("insert into deviceid(usrid,deviceid,command,status) values('$usrid','$deviceid',1,2)");
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    echo "2";
  }
?>
