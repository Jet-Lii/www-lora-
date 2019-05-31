<?php
      $baud = $_POST['baud'];
      $DataBit = $_POST['DataBit'];
      $CheckBit = $_POST['CheckBit'];
      $StopBit = $_POST['StopBit'];
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

        $result = mysql_query("update device set baud=$baud,DataBit=$DataBit,CheckBit=$CheckBit,StopBit=$StopBit where usrid='$usrid'");

        if($result){
            echo "1";
        }else{
            echo "2";
        }
    ?>
