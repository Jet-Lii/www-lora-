<?php
  $usrid = $_POST['usrid'];

  $link = mysql_connect('127.0.0.1', 'root', '123');
  if (!$link) {
  die('Not connected : ' . mysql_error());
  }
  // make foo the current db
  $db_selected = mysql_select_db('mytest', $link);
  if (!$db_selected) {
  die ('Can\'t use foo : ' . mysql_error());
  }

  $sql = mysql_query("select * from Modbus where usrid='$usrid'");
  if($row = mysql_fetch_array($sql))
  {
    $array=array("name"=>$row['cmd']);
    echo json_encode($array);
  }

?>
